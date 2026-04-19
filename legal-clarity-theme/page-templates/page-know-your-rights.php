<?php
/**
 * Template Name: Know Your Rights
 *
 * @package LegalClarity
 */

get_header();

$amendments     = tlcp_get_amendments();
$categories     = tlcp_get_rights_categories();
$first_cat_slug = ! empty( $categories ) ? $categories[0]['slug'] : '';
$first_amd_num  = ! empty( $amendments ) ? (int) $amendments[0]['number'] : 0;
?>

<section class="page-hero">
    <div class="container">
        <div class="eyebrow">The Constitution and Your Rights</div>
        <h1>Know Your Rights</h1>
        <p class="lead">Your rights in plain English. Understand the Constitution, the amendments, and how they apply to everyday situations &mdash; at home, at work, on the street, and online.</p>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="prose">
            <p>This section is organized in two parts. The first walks through everyday scenarios, grouped by the situations you are most likely to encounter &mdash; an encounter with police, a question about free speech, a concern at work or school. Each scenario explains what your right actually is and what you can do in the moment.</p>
            <p>The second part is a plain-English walkthrough of all 27 amendments to the United States Constitution. You will find the original text, a translation into everyday language, and a short list of key points. The two parts are cross-linked, so you can move between a real-world situation and the amendment it draws from.</p>
        </div>
    </div>
</section>

<section class="section" id="rights-by-situation">
    <div class="container">
        <h2 class="kyr-section-heading">Rights by Situation</h2>
        <p class="section-intro">Tap a situation below to jump straight into the relevant scenarios.</p>

        <?php if ( empty( $categories ) ) : ?>
            <div class="dict-empty">
                <h3>Content is loading</h3>
                <p class="lead">Rights categories will appear here as content is added.</p>
            </div>
        <?php else : ?>
            <div class="rights-grid">
                <?php foreach ( $categories as $cat ) :
                    $slug    = isset( $cat['slug'] ) ? $cat['slug'] : sanitize_title( $cat['title'] ?? '' );
                    $icon    = isset( $cat['icon'] ) ? $cat['icon'] : 'shield';
                    $title   = isset( $cat['title'] ) ? $cat['title'] : '';
                    $summary = isset( $cat['summary'] ) ? $cat['summary'] : '';
                ?>
                    <article class="rights-card">
                        <div class="rights-card-icon"><?php echo tlcp_icon( $icon, 40 ); ?></div>
                        <h3 class="rights-card-title"><?php echo esc_html( $title ); ?></h3>
                        <?php if ( $summary ) : ?>
                            <p class="rights-card-summary"><?php echo esc_html( $summary ); ?></p>
                        <?php endif; ?>
                        <a class="btn btn-secondary btn-sm rights-card-link"
                           href="<?php echo esc_url( '#scenario-panel-' . $slug ); ?>"
                           data-scenario-target="<?php echo esc_attr( $slug ); ?>">
                            Read scenarios
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Scenario tabs -->
            <div class="scenario-tabs" data-tabs="scenarios" id="scenario-tabs">
                <div class="scenario-tabs-nav" role="tablist" aria-label="Rights scenarios by situation">
                    <?php foreach ( $categories as $cat ) :
                        $slug    = isset( $cat['slug'] ) ? $cat['slug'] : sanitize_title( $cat['title'] ?? '' );
                        $icon    = isset( $cat['icon'] ) ? $cat['icon'] : 'shield';
                        $title   = isset( $cat['title'] ) ? $cat['title'] : '';
                        $active  = $slug === $first_cat_slug;
                    ?>
                        <button type="button"
                                class="scenario-tab<?php echo $active ? ' is-active' : ''; ?>"
                                role="tab"
                                id="<?php echo esc_attr( 'scenario-tab-' . $slug ); ?>"
                                aria-controls="<?php echo esc_attr( 'scenario-panel-' . $slug ); ?>"
                                aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
                                tabindex="<?php echo $active ? '0' : '-1'; ?>">
                            <span class="scenario-tab-icon"><?php echo tlcp_icon( $icon, 18 ); ?></span>
                            <span class="scenario-tab-label"><?php echo esc_html( $title ); ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="scenario-tabs-panels">
                    <?php foreach ( $categories as $cat ) :
                        $slug      = isset( $cat['slug'] ) ? $cat['slug'] : sanitize_title( $cat['title'] ?? '' );
                        $title     = isset( $cat['title'] ) ? $cat['title'] : '';
                        $summary   = isset( $cat['summary'] ) ? $cat['summary'] : '';
                        $scenarios = isset( $cat['scenarios'] ) && is_array( $cat['scenarios'] ) ? $cat['scenarios'] : array();
                        $related   = isset( $cat['related_amendments'] ) && is_array( $cat['related_amendments'] ) ? $cat['related_amendments'] : array();
                        $active    = $slug === $first_cat_slug;
                    ?>
                        <div class="scenario-panel<?php echo $active ? ' is-active' : ''; ?>"
                             id="<?php echo esc_attr( 'scenario-panel-' . $slug ); ?>"
                             role="tabpanel"
                             aria-labelledby="<?php echo esc_attr( 'scenario-tab-' . $slug ); ?>"
                             tabindex="0">
                            <div class="scenario-panel-head">
                                <h3><?php echo esc_html( $title ); ?></h3>
                                <?php if ( $summary ) : ?>
                                    <p class="scenario-panel-summary"><?php echo esc_html( $summary ); ?></p>
                                <?php endif; ?>
                            </div>

                            <?php if ( empty( $scenarios ) ) : ?>
                                <p class="scenario-empty">Scenarios for this category are being written.</p>
                            <?php else : ?>
                                <ol class="scenario-list">
                                    <?php foreach ( $scenarios as $scenario ) :
                                        $situation = isset( $scenario['situation'] ) ? $scenario['situation'] : '';
                                        $right     = isset( $scenario['right'] ) ? $scenario['right'] : '';
                                        $action    = isset( $scenario['action'] ) ? $scenario['action'] : '';
                                    ?>
                                        <li class="scenario">
                                            <?php if ( $situation ) : ?>
                                                <h4 class="scenario-situation"><?php echo esc_html( $situation ); ?></h4>
                                            <?php endif; ?>
                                            <?php if ( $right ) : ?>
                                                <p class="scenario-right"><strong>Your right:</strong> <?php echo esc_html( $right ); ?></p>
                                            <?php endif; ?>
                                            <?php if ( $action ) : ?>
                                                <p class="scenario-action"><strong>What to do:</strong> <?php echo esc_html( $action ); ?></p>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            <?php endif; ?>

                            <?php if ( ! empty( $related ) ) : ?>
                                <p class="scenario-related">
                                    <strong>Related amendments:</strong>
                                    <?php
                                    $links = array();
                                    foreach ( $related as $num ) {
                                        $n = (int) $num;
                                        if ( $n > 0 ) {
                                            $links[] = '<a href="' . esc_url( '#amendment-tab-' . $n ) . '" data-amendment-target="' . esc_attr( $n ) . '">' . esc_html( $n ) . '</a>';
                                        }
                                    }
                                    echo wp_kses( implode( ', ', $links ), array( 'a' => array( 'href' => array(), 'data-amendment-target' => array() ) ) );
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section" id="amendments-section">
    <div class="container">
        <h2 class="kyr-section-heading">The 27 Amendments, Explained</h2>
        <p class="section-intro">Every amendment with its original text, a plain-English translation, and the key points to remember. Browse the list on the left and read the detail on the right.</p>

        <?php if ( empty( $amendments ) ) : ?>
            <div class="dict-empty">
                <h3>Content is loading</h3>
                <p class="lead">The amendments list will appear here as content is added.</p>
            </div>
        <?php else : ?>
            <div class="amendments-tabs" data-tabs="amendments">
                <div class="amendments-tabs-nav" role="tablist" aria-orientation="vertical" aria-label="Constitutional amendments">
                    <?php foreach ( $amendments as $amendment ) :
                        $number   = isset( $amendment['number'] ) ? (int) $amendment['number'] : 0;
                        $am_title = isset( $amendment['title'] ) ? $amendment['title'] : '';
                        $year     = isset( $amendment['year'] ) ? $amendment['year'] : '';
                        $active   = $number === $first_amd_num;
                    ?>
                        <button type="button"
                                class="amendment-tab<?php echo $active ? ' is-active' : ''; ?>"
                                role="tab"
                                id="<?php echo esc_attr( 'amendment-tab-' . $number ); ?>"
                                aria-controls="<?php echo esc_attr( 'amendment-panel-' . $number ); ?>"
                                aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
                                tabindex="<?php echo $active ? '0' : '-1'; ?>">
                            <span class="amendment-tab-label">Amendment <?php echo esc_html( $number ); ?></span>
                            <?php if ( $am_title ) : ?>
                                <span class="amendment-tab-title"><?php echo esc_html( $am_title ); ?></span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="amendments-tabs-panels">
                    <?php foreach ( $amendments as $amendment ) :
                        $number     = isset( $amendment['number'] ) ? (int) $amendment['number'] : 0;
                        $roman      = isset( $amendment['roman'] ) ? $amendment['roman'] : '';
                        $am_title   = isset( $amendment['title'] ) ? $amendment['title'] : '';
                        $year       = isset( $amendment['year'] ) ? $amendment['year'] : '';
                        $text       = isset( $amendment['text'] ) ? $amendment['text'] : '';
                        $plain      = isset( $amendment['plain'] ) ? $amendment['plain'] : '';
                        $key_points = isset( $amendment['key_points'] ) && is_array( $amendment['key_points'] ) ? $amendment['key_points'] : array();
                        $active     = $number === $first_amd_num;
                    ?>
                        <article class="amendment-panel<?php echo $active ? ' is-active' : ''; ?>"
                                 id="<?php echo esc_attr( 'amendment-panel-' . $number ); ?>"
                                 role="tabpanel"
                                 aria-labelledby="<?php echo esc_attr( 'amendment-tab-' . $number ); ?>"
                                 tabindex="0">
                            <header class="amendment-panel-head">
                                <?php if ( $roman ) : ?>
                                    <span class="amendment-panel-roman" aria-hidden="true"><?php echo esc_html( $roman ); ?></span>
                                <?php endif; ?>
                                <div class="amendment-panel-meta">
                                    <span class="amendment-panel-eyebrow">Amendment <?php echo esc_html( $number ); ?><?php if ( $year ) : ?> &middot; Ratified <?php echo esc_html( $year ); endif; ?></span>
                                    <?php if ( $am_title ) : ?>
                                        <h3 class="amendment-panel-title"><?php echo esc_html( $am_title ); ?></h3>
                                    <?php endif; ?>
                                </div>
                            </header>

                            <?php if ( $plain ) : ?>
                                <div class="amendment-panel-plain">
                                    <h4>In plain English</h4>
                                    <p><?php echo esc_html( $plain ); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $key_points ) ) : ?>
                                <div class="amendment-panel-points">
                                    <h4>Key points</h4>
                                    <ul>
                                        <?php foreach ( $key_points as $point ) : ?>
                                            <li><?php echo esc_html( $point ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if ( $text ) : ?>
                                <details class="amendment-panel-original">
                                    <summary>Show original text</summary>
                                    <blockquote><?php echo esc_html( $text ); ?></blockquote>
                                </details>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container container-narrow">
        <div class="callout">
            <h2>Have a word you don't recognize?</h2>
            <p>The Legal Clarity Dictionary breaks down legal terms into plain language, with real-world examples.</p>
            <p><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>">Open the dictionary</a></p>
        </div>
    </div>
</section>

<?php get_footer();
