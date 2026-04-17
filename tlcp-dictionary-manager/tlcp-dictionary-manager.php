<?php
/**
 * Plugin Name: TLCP Dictionary Manager
 * Plugin URI:  https://github.com/launchpad516/tlcp
 * Description: Admin UI to add, edit, delete, and bulk-import terms for the Legal Clarity dictionary.
 * Version:     1.0.0
 * Author:      The Legal Clarity Project
 * License:     GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// ── Helpers ─────────────────────────────────────────────────────────────────

function tlcp_dm_dict_dir() {
    return get_template_directory() . '/inc/data/dictionary';
}

function tlcp_dm_php_str( $val ) {
    return "'" . str_replace( array( '\\', "'" ), array( '\\\\', "\\'" ), $val ) . "'";
}

function tlcp_dm_get_terms_for_letter( $letter ) {
    $file = tlcp_dm_dict_dir() . '/' . strtolower( $letter ) . '.php';
    if ( ! file_exists( $file ) ) { return array(); }
    $data = include $file;
    return is_array( $data ) ? $data : array();
}

function tlcp_dm_save_terms_for_letter( $letter, array $terms ) {
    usort( $terms, function ( $a, $b ) {
        return strcasecmp( $a['term'], $b['term'] );
    } );

    $out   = array();
    $out[] = '<?php';
    $out[] = 'if ( ! defined( \'ABSPATH\' ) ) { exit; }';
    $out[] = '';
    $out[] = 'return array(';
    foreach ( $terms as $t ) {
        $out[] = "\tarray(";
        $out[] = "\t\t'term'       => " . tlcp_dm_php_str( $t['term'] ) . ',';
        $out[] = "\t\t'pos'        => " . tlcp_dm_php_str( $t['pos'] ?? '' ) . ',';
        $out[] = "\t\t'definition' => " . tlcp_dm_php_str( $t['definition'] ?? '' ) . ',';
        $out[] = "\t\t'example'    => " . tlcp_dm_php_str( $t['example'] ?? '' ) . ',';
        $out[] = "\t),";
    }
    $out[] = ');';

    $dir = tlcp_dm_dict_dir();
    if ( ! is_dir( $dir ) ) {
        wp_mkdir_p( $dir );
    }

    return file_put_contents( $dir . '/' . strtolower( $letter ) . '.php', implode( "\n", $out ) . "\n" ) !== false;
}

function tlcp_dm_get_all_terms() {
    $all = array();
    foreach ( range( 'A', 'Z' ) as $letter ) {
        foreach ( tlcp_dm_get_terms_for_letter( $letter ) as $t ) {
            $t['_letter'] = $letter;
            $all[]        = $t;
        }
    }
    usort( $all, function ( $a, $b ) {
        return strcasecmp( $a['term'], $b['term'] );
    } );
    return $all;
}

function tlcp_dm_term_letter( $term_name ) {
    $first = strtoupper( substr( ltrim( $term_name ), 0, 1 ) );
    return preg_match( '/[A-Z]/', $first ) ? $first : 'A';
}

/**
 * Save or overwrite a single term (deduplicates by term name, case-insensitive).
 */
function tlcp_dm_save_term( array $data ) {
    $term_name = trim( $data['term'] );
    $new_letter = tlcp_dm_term_letter( $term_name );
    $old_letter = strtoupper( $data['_old_letter'] ?? '' );

    $entry = array(
        'term'       => $term_name,
        'pos'        => sanitize_text_field( $data['pos'] ?? '' ),
        'definition' => sanitize_textarea_field( $data['definition'] ?? '' ),
        'example'    => sanitize_textarea_field( $data['example'] ?? '' ),
    );

    // If the first letter changed, remove from old file
    if ( $old_letter && $old_letter !== $new_letter ) {
        $old_terms = array_values( array_filter(
            tlcp_dm_get_terms_for_letter( $old_letter ),
            function ( $t ) use ( $term_name ) {
                return strcasecmp( $t['term'], $term_name ) !== 0;
            }
        ) );
        tlcp_dm_save_terms_for_letter( $old_letter, $old_terms );
    }

    // Load terms for target letter, replace or append
    $terms = tlcp_dm_get_terms_for_letter( $new_letter );
    $found = false;
    foreach ( $terms as &$t ) {
        if ( strcasecmp( $t['term'], $term_name ) === 0 ) {
            $t     = $entry;
            $found = true;
            break;
        }
    }
    unset( $t );
    if ( ! $found ) {
        $terms[] = $entry;
    }

    return tlcp_dm_save_terms_for_letter( $new_letter, $terms );
}

function tlcp_dm_delete_term( $term_name ) {
    $letter = tlcp_dm_term_letter( $term_name );
    $terms  = array_values( array_filter(
        tlcp_dm_get_terms_for_letter( $letter ),
        function ( $t ) use ( $term_name ) {
            return strcasecmp( $t['term'], $term_name ) !== 0;
        }
    ) );
    return tlcp_dm_save_terms_for_letter( $letter, $terms );
}

/**
 * Parse CSV text into an array of term arrays.
 * Accepts optional header row. Columns: term, pos, definition, example.
 */
function tlcp_dm_parse_csv( $text ) {
    $lines  = preg_split( '/\r\n|\r|\n/', trim( $text ) );
    $keys   = array( 'term', 'pos', 'definition', 'example' );
    $result = array();

    foreach ( $lines as $i => $line ) {
        $line = trim( $line );
        if ( empty( $line ) ) { continue; }

        $row = str_getcsv( $line );

        // Skip header row
        if ( $i === 0 && isset( $row[0] ) && strtolower( trim( $row[0] ) ) === 'term' ) {
            continue;
        }

        if ( count( $row ) < 3 ) { continue; } // minimum: term + definition + something

        $entry = array();
        foreach ( $keys as $idx => $key ) {
            $entry[ $key ] = isset( $row[ $idx ] ) ? trim( $row[ $idx ] ) : '';
        }

        if ( ! empty( $entry['term'] ) && ! empty( $entry['definition'] ) ) {
            $result[] = $entry;
        }
    }

    return $result;
}

// ── Admin Menu ───────────────────────────────────────────────────────────────

add_action( 'admin_menu', function () {
    add_menu_page(
        'Dictionary Manager',
        'Dictionary',
        'manage_options',
        'tlcp-dictionary',
        'tlcp_dm_page_list',
        'dashicons-book-alt',
        30
    );
    add_submenu_page( 'tlcp-dictionary', 'All Terms',    'All Terms',    'manage_options', 'tlcp-dictionary',        'tlcp_dm_page_list' );
    add_submenu_page( 'tlcp-dictionary', 'Add Term',     'Add Term',     'manage_options', 'tlcp-dictionary-add',    'tlcp_dm_page_edit' );
    add_submenu_page( 'tlcp-dictionary', 'Import Terms', 'Import Terms', 'manage_options', 'tlcp-dictionary-import', 'tlcp_dm_page_import' );
} );

// ── Shared notice helper ─────────────────────────────────────────────────────

function tlcp_dm_dir_notice() {
    $dir = tlcp_dm_dict_dir();
    if ( ! is_dir( $dir ) || ! is_writable( $dir ) ) {
        echo '<div class="notice notice-warning"><p><strong>Dictionary folder is not writable.</strong> Check permissions on <code>' . esc_html( $dir ) . '</code>.</p></div>';
    }
}

// ── Page: All Terms ──────────────────────────────────────────────────────────

function tlcp_dm_page_list() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }

    $notice = '';

    if ( isset( $_GET['action'], $_GET['term'] ) && $_GET['action'] === 'delete' ) {
        check_admin_referer( 'tlcp_dm_delete_' . $_GET['term'] );
        $term_to_delete = sanitize_text_field( wp_unslash( $_GET['term'] ) );
        $notice = tlcp_dm_delete_term( $term_to_delete )
            ? '<div class="notice notice-success is-dismissible"><p>Term deleted.</p></div>'
            : '<div class="notice notice-error"><p>Could not delete — check folder permissions.</p></div>';
    }

    $search = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
    $all    = tlcp_dm_get_all_terms();

    if ( $search ) {
        $all = array_values( array_filter( $all, function ( $t ) use ( $search ) {
            return stripos( $t['term'], $search ) !== false
                || stripos( $t['definition'] ?? '', $search ) !== false;
        } ) );
    }

    $per_page    = 50;
    $total       = count( $all );
    $paged       = max( 1, isset( $_GET['paged'] ) ? intval( $_GET['paged'] ) : 1 );
    $total_pages = max( 1, (int) ceil( $total / $per_page ) );
    $page_items  = array_slice( $all, ( $paged - 1 ) * $per_page, $per_page );
    $list_base   = admin_url( 'admin.php?page=tlcp-dictionary' ) . ( $search ? '&s=' . urlencode( $search ) : '' );
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Dictionary Terms</h1>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tlcp-dictionary-add' ) ); ?>" class="page-title-action">Add New</a>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tlcp-dictionary-import' ) ); ?>" class="page-title-action">Import</a>
        <hr class="wp-header-end">
        <?php tlcp_dm_dir_notice(); echo $notice; ?>

        <form method="get" action="">
            <input type="hidden" name="page" value="tlcp-dictionary">
            <p class="search-box">
                <input type="search" name="s" value="<?php echo esc_attr( $search ); ?>" placeholder="Search terms…" style="width:260px;">
                <?php submit_button( 'Search', 'secondary', '', false ); ?>
                <?php if ( $search ) : ?> <a href="<?php echo esc_url( admin_url( 'admin.php?page=tlcp-dictionary' ) ); ?>" class="button">Clear</a><?php endif; ?>
            </p>
        </form>

        <p><?php echo esc_html( number_format( $total ) ); ?> term<?php echo 1 !== $total ? 's' : ''; ?><?php echo $search ? ' matching "' . esc_html( $search ) . '"' : ' total'; ?></p>

        <table class="wp-list-table widefat striped">
            <thead>
                <tr><th>Term</th><th>Part of Speech</th><th style="width:45%">Definition</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php if ( empty( $page_items ) ) : ?>
                <tr><td colspan="4">No terms found.</td></tr>
            <?php else : ?>
                <?php foreach ( $page_items as $t ) :
                    $edit_url   = add_query_arg( array( 'page' => 'tlcp-dictionary-add', 'edit' => rawurlencode( $t['term'] ) ), admin_url( 'admin.php' ) );
                    $delete_url = wp_nonce_url(
                        add_query_arg( array( 'page' => 'tlcp-dictionary', 'action' => 'delete', 'term' => rawurlencode( $t['term'] ) ), admin_url( 'admin.php' ) ),
                        'tlcp_dm_delete_' . $t['term']
                    );
                ?>
                    <tr>
                        <td><strong><?php echo esc_html( $t['term'] ); ?></strong></td>
                        <td><?php echo esc_html( $t['pos'] ?? '' ); ?></td>
                        <td><?php echo esc_html( wp_trim_words( $t['definition'] ?? '', 18, '…' ) ); ?></td>
                        <td>
                            <a href="<?php echo esc_url( $edit_url ); ?>">Edit</a>
                            &nbsp;|&nbsp;
                            <a href="<?php echo esc_url( $delete_url ); ?>"
                               onclick="return confirm('Delete the term &quot;<?php echo esc_js( $t['term'] ); ?>&quot;? This cannot be undone.')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <?php if ( $total_pages > 1 ) : ?>
        <div class="tablenav bottom"><div class="tablenav-pages">
            <?php echo paginate_links( array(
                'base'    => add_query_arg( 'paged', '%#%', $list_base ),
                'format'  => '',
                'current' => $paged,
                'total'   => $total_pages,
            ) ); ?>
        </div></div>
        <?php endif; ?>
    </div>
    <?php
}

// ── Page: Add / Edit Term ────────────────────────────────────────────────────

function tlcp_dm_page_edit() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }

    $notice   = '';
    $editing  = isset( $_GET['edit'] ) ? sanitize_text_field( wp_unslash( $_GET['edit'] ) ) : '';
    $existing = array( 'term' => '', 'pos' => '', 'definition' => '', 'example' => '' );

    if ( $editing ) {
        foreach ( tlcp_dm_get_terms_for_letter( tlcp_dm_term_letter( $editing ) ) as $t ) {
            if ( strcasecmp( $t['term'], $editing ) === 0 ) {
                $existing = $t;
                break;
            }
        }
    }

    if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['tlcp_dm_save'] ) ) {
        check_admin_referer( 'tlcp_dm_save_term' );

        $pos_raw = sanitize_text_field( wp_unslash( $_POST['pos_custom'] ?? '' ) );
        if ( empty( $pos_raw ) ) {
            $pos_raw = sanitize_text_field( wp_unslash( $_POST['pos'] ?? '' ) );
        }

        $data = array(
            'term'        => sanitize_text_field( wp_unslash( $_POST['term'] ?? '' ) ),
            'pos'         => $pos_raw,
            'definition'  => sanitize_textarea_field( wp_unslash( $_POST['definition'] ?? '' ) ),
            'example'     => sanitize_textarea_field( wp_unslash( $_POST['example'] ?? '' ) ),
            '_old_letter' => sanitize_text_field( wp_unslash( $_POST['_old_letter'] ?? '' ) ),
        );

        if ( empty( $data['term'] ) ) {
            $notice = '<div class="notice notice-error"><p>Term name is required.</p></div>';
        } elseif ( empty( $data['definition'] ) ) {
            $notice = '<div class="notice notice-error"><p>Definition is required.</p></div>';
        } else {
            if ( tlcp_dm_save_term( $data ) ) {
                $notice   = '<div class="notice notice-success"><p>Term <strong>' . esc_html( $data['term'] ) . '</strong> saved.</p></div>';
                $editing  = $data['term'];
                $existing = $data;
            } else {
                $notice = '<div class="notice notice-error"><p>Could not save — check that the dictionary folder is writable.</p></div>';
            }
        }
    }

    $pos_options = array( 'noun', 'verb', 'adjective', 'adverb', 'phrase', 'abbreviation' );
    $cur_pos     = $existing['pos'] ?? '';
    $is_custom   = $cur_pos && ! in_array( $cur_pos, $pos_options, true );
    ?>
    <div class="wrap">
        <h1><?php echo $editing ? 'Edit Term' : 'Add New Term'; ?></h1>
        <?php tlcp_dm_dir_notice(); echo $notice; ?>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=tlcp-dictionary' ) ); ?>">← Back to All Terms</a>

        <form method="post" action="" style="margin-top:16px;">
            <?php wp_nonce_field( 'tlcp_dm_save_term' ); ?>
            <input type="hidden" name="tlcp_dm_save" value="1">
            <input type="hidden" name="_old_letter" value="<?php echo esc_attr( $editing ? tlcp_dm_term_letter( $editing ) : '' ); ?>">

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="term">Term <span aria-hidden="true" style="color:red">*</span></label></th>
                    <td>
                        <input type="text" id="term" name="term" value="<?php echo esc_attr( $existing['term'] ); ?>" class="regular-text" required>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pos">Part of Speech</label></th>
                    <td>
                        <select id="pos" name="pos">
                            <option value="">— select —</option>
                            <?php foreach ( $pos_options as $opt ) : ?>
                                <option value="<?php echo esc_attr( $opt ); ?>" <?php selected( ! $is_custom && $cur_pos === $opt ); ?>><?php echo esc_html( ucfirst( $opt ) ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        &nbsp; or &nbsp;
                        <input type="text" name="pos_custom" placeholder="custom…" style="width:140px;"
                               value="<?php echo $is_custom ? esc_attr( $cur_pos ) : ''; ?>">
                        <p class="description">Use the dropdown <em>or</em> type a custom value — whichever is filled in wins.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="definition">Definition <span aria-hidden="true" style="color:red">*</span></label></th>
                    <td>
                        <textarea id="definition" name="definition" rows="4" class="large-text" required><?php echo esc_textarea( $existing['definition'] ?? '' ); ?></textarea>
                        <p class="description">Plain-English explanation, ideally under 30 words.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="example">Example</label></th>
                    <td>
                        <textarea id="example" name="example" rows="3" class="large-text"><?php echo esc_textarea( $existing['example'] ?? '' ); ?></textarea>
                        <p class="description">A short sentence showing the term used in a real situation.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button( $editing ? 'Update Term' : 'Add Term' ); ?>
        </form>
    </div>
    <?php
}

// ── Page: Import ─────────────────────────────────────────────────────────────

function tlcp_dm_page_import() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }

    $notice  = '';
    $step    = 'form';
    $preview = array();

    if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
        check_admin_referer( 'tlcp_dm_import' );

        // ── Step 1: preview ──────────────────────────────────────────────────
        if ( isset( $_POST['tlcp_dm_preview'] ) ) {
            $csv_text = '';

            if ( ! empty( $_FILES['csv_file']['tmp_name'] ) ) {
                $csv_text = file_get_contents( sanitize_text_field( $_FILES['csv_file']['tmp_name'] ) );
            }
            if ( empty( $csv_text ) && ! empty( $_POST['csv_text'] ) ) {
                $csv_text = wp_unslash( $_POST['csv_text'] );
            }

            if ( empty( $csv_text ) ) {
                $notice = '<div class="notice notice-error"><p>Please upload a file or paste CSV content.</p></div>';
            } else {
                $preview = tlcp_dm_parse_csv( $csv_text );
                if ( empty( $preview ) ) {
                    $notice = '<div class="notice notice-error"><p>No valid terms found. Make sure each row has at least a term and a definition.</p></div>';
                } else {
                    $step = 'preview';
                    set_transient( 'tlcp_dm_preview_' . get_current_user_id(), $preview, 600 );
                }
            }
        }

        // ── Step 2: confirm ──────────────────────────────────────────────────
        if ( isset( $_POST['tlcp_dm_confirm'] ) ) {
            $preview = get_transient( 'tlcp_dm_preview_' . get_current_user_id() );
            delete_transient( 'tlcp_dm_preview_' . get_current_user_id() );

            if ( empty( $preview ) ) {
                $notice = '<div class="notice notice-error"><p>Session expired — please start the import again.</p></div>';
            } else {
                $added   = 0;
                $updated = 0;
                $errors  = 0;

                // Group by letter to minimise file reads
                $by_letter = array();
                foreach ( $preview as $row ) {
                    $by_letter[ tlcp_dm_term_letter( $row['term'] ) ][] = $row;
                }

                foreach ( $by_letter as $letter => $rows ) {
                    $existing = tlcp_dm_get_terms_for_letter( $letter );

                    // Build a lowercase-keyed index for fast dedup lookup
                    $index = array();
                    foreach ( $existing as $k => $t ) {
                        $index[ strtolower( $t['term'] ) ] = $k;
                    }

                    foreach ( $rows as $row ) {
                        $key   = strtolower( trim( $row['term'] ) );
                        $entry = array(
                            'term'       => sanitize_text_field( $row['term'] ),
                            'pos'        => sanitize_text_field( $row['pos'] ),
                            'definition' => sanitize_textarea_field( $row['definition'] ),
                            'example'    => sanitize_textarea_field( $row['example'] ),
                        );
                        if ( isset( $index[ $key ] ) ) {
                            $existing[ $index[ $key ] ] = $entry;
                            $updated++;
                        } else {
                            $existing[] = $entry;
                            $added++;
                        }
                    }

                    if ( ! tlcp_dm_save_terms_for_letter( $letter, $existing ) ) {
                        $errors++;
                    }
                }

                $msg  = sprintf( '%d term%s added, %d updated.', $added, 1 !== $added ? 's' : '', $updated );
                if ( $errors ) {
                    $msg   .= " Warning: {$errors} file(s) could not be written — check folder permissions.";
                    $type   = 'notice-warning';
                } else {
                    $type = 'notice-success';
                }
                $notice = '<div class="notice ' . $type . '"><p>' . esc_html( $msg ) . '</p></div>';
            }
        }
    }

    // Restore preview from transient if step wasn't set by POST
    if ( 'preview' === $step && empty( $preview ) ) {
        $preview = get_transient( 'tlcp_dm_preview_' . get_current_user_id() ) ?: array();
    }
    ?>
    <div class="wrap">
        <h1>Import Dictionary Terms</h1>
        <?php tlcp_dm_dir_notice(); echo $notice; ?>

        <?php if ( 'preview' === $step && ! empty( $preview ) ) : ?>

            <h2>Preview — <?php echo esc_html( number_format( count( $preview ) ) ); ?> term<?php echo count( $preview ) !== 1 ? 's' : ''; ?></h2>
            <p>Existing terms with the same name will be <strong>overwritten</strong>. New terms will be added.</p>

            <div style="max-height:400px;overflow-y:auto;border:1px solid #ccd0d4;margin-bottom:16px;">
                <table class="wp-list-table widefat striped" style="margin:0;">
                    <thead>
                        <tr><th>Term</th><th>Part of Speech</th><th>Definition</th><th>Example</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $preview as $row ) : ?>
                            <tr>
                                <td><?php echo esc_html( $row['term'] ); ?></td>
                                <td><?php echo esc_html( $row['pos'] ); ?></td>
                                <td><?php echo esc_html( wp_trim_words( $row['definition'], 15, '…' ) ); ?></td>
                                <td><?php echo esc_html( wp_trim_words( $row['example'], 10, '…' ) ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <form method="post" action="">
                <?php wp_nonce_field( 'tlcp_dm_import' ); ?>
                <button type="submit" name="tlcp_dm_confirm" class="button button-primary">Confirm &amp; Import</button>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=tlcp-dictionary-import' ) ); ?>" class="button">Cancel</a>
            </form>

        <?php else : ?>

            <p>Upload a CSV or paste CSV text below. If a term already exists it will be <strong>overwritten</strong>; new terms will be added.</p>

            <h2 style="margin-top:24px;">Format</h2>
            <p>Four columns: <code>term</code>, <code>pos</code>, <code>definition</code>, <code>example</code>. The header row is optional. <code>pos</code> and <code>example</code> can be left blank.</p>
            <pre style="background:#f6f7f7;padding:12px 16px;display:inline-block;border:1px solid #ddd;border-radius:4px;">term,pos,definition,example
Habeas Corpus,noun,"A court order requiring a person be brought before a judge.",The prisoner filed for habeas corpus after three years without trial.
Indictment,noun,"A formal charge issued by a grand jury.",The grand jury returned an indictment for fraud.
Lien,,A legal claim against property as security for a debt.,The bank placed a lien on the house until the loan was repaid.</pre>

            <form method="post" action="" enctype="multipart/form-data" style="margin-top:24px;">
                <?php wp_nonce_field( 'tlcp_dm_import' ); ?>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="csv_file">Upload CSV file</label></th>
                        <td>
                            <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt">
                            <p class="description">.csv or .txt, UTF-8 encoded.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="csv_text">— or paste CSV —</label></th>
                        <td>
                            <textarea id="csv_text" name="csv_text" rows="12" class="large-text"
                                      placeholder="term,pos,definition,example&#10;Habeas Corpus,noun,A court order requiring a person be brought before a judge.,The prisoner filed for habeas corpus after three years without trial."></textarea>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="tlcp_dm_preview" class="button button-primary">Preview Import</button>
            </form>

        <?php endif; ?>
    </div>
    <?php
}
