<?php
/**
 * Data helpers: load dictionary terms, amendments, etc.
 *
 * @package LegalClarity
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Load all dictionary terms across A–Z.
 *
 * @return array Indexed array of terms with keys: letter, term, pos, definition, example.
 */
function tlcp_get_dictionary() {
    static $cache = null;
    if ( null !== $cache ) { return $cache; }

    $cache = array();
    $dir   = TLCP_DIR . '/inc/data/dictionary';

    if ( ! is_dir( $dir ) ) { return $cache; }

    foreach ( range( 'A', 'Z' ) as $letter ) {
        $file = $dir . '/' . strtolower( $letter ) . '.php';
        if ( file_exists( $file ) ) {
            $terms = include $file;
            if ( is_array( $terms ) ) {
                foreach ( $terms as $term ) {
                    if ( ! isset( $term['letter'] ) ) { $term['letter'] = $letter; }
                    $cache[] = $term;
                }
            }
        }
    }
    return $cache;
}

/**
 * Get dictionary terms grouped by their first letter.
 */
function tlcp_get_dictionary_by_letter() {
    $terms   = tlcp_get_dictionary();
    $grouped = array();
    foreach ( $terms as $t ) {
        $letter               = isset( $t['letter'] ) ? strtoupper( $t['letter'] ) : strtoupper( substr( $t['term'], 0, 1 ) );
        $grouped[ $letter ][] = $t;
    }
    ksort( $grouped );
    return $grouped;
}

/**
 * Get a few popular/highlighted terms for the homepage.
 */
function tlcp_get_popular_terms() {
    return array(
        array(
            'term'       => 'Affidavit',
            'definition' => 'A written statement confirmed by oath or affirmation, used as evidence in court.',
        ),
        array(
            'term'       => 'Due Process',
            'definition' => 'The fair treatment through the normal judicial system, especially as a citizen’s entitlement.',
        ),
        array(
            'term'       => 'Estoppel',
            'definition' => 'A legal principle that prevents someone from arguing something contrary to a claim they previously made.',
        ),
    );
}

/**
 * Get all amendments data.
 */
function tlcp_get_amendments() {
    $file = TLCP_DIR . '/inc/data/amendments.php';
    if ( file_exists( $file ) ) {
        return include $file;
    }
    return array();
}

/**
 * Get all "Know Your Rights" categories.
 */
function tlcp_get_rights_categories() {
    $file = TLCP_DIR . '/inc/data/rights.php';
    if ( file_exists( $file ) ) {
        return include $file;
    }
    return array();
}
