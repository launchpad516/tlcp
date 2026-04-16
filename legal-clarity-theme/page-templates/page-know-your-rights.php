<?php
/**
 * Template Name: Know Your Rights
 *
 * @package LegalClarity
 */

get_header();

$amendments = tlcp_get_amendments();
$categories = tlcp_get_rights_categories();
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

<section class="section">
    <div class="container">
        <h2>Rights by Situation</h2>
        <?php if ( empty( $categories ) ) : ?>
            <div class="dict-empty">
                <h2>Content is loading</h2>
                <p class="lead" style="margin: 0 auto;">Rights categories will appear here as content is added.</p>
            </div>
        <?php else : ?>
            <div class="rights-grid">
                <?php foreach ( $categories as $cat ) :
                    $slug    = isset( $cat['slug'] ) ? $cat['slug'] : sanitize_title( $cat['title'] ?? '' );
                    $icon    = isset( $cat['icon'] ) ? $cat['icon'] : 'info';
                    $title   = isset( $cat['title'] ) ? $cat['title'] : '';
                    $summary = isset( $cat['summary'] ) ? $cat['summary'] : '';
                ?>
                    <article class="rights-card">
                        <div class="rights-card-icon"><?php echo tlcp_icon( $icon, 32 ); ?></div>
                        <h3 class="rights-card-title"><?php echo esc_html( $title ); ?></h3>
                        <?php if ( $summary ) : ?>
                            <p class="rights-card-summary"><?php echo esc_html( $summary ); ?></p>
                        <?php endif; ?>
                        <a class="btn btn-secondary rights-card-link" href="<?php echo esc_url( '#rights-' . $slug ); ?>">Read scenarios</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Scenarios in Detail</h2>
        <?php if ( empty( $categories ) ) : ?>
            <div class="dict-empty">
                <p class="lead" style="margin: 0 auto;">Scenarios will appear here as content is added.</p>
            </div>
        <?php else : ?>
            <?php foreach ( $categories as $cat ) :
                $slug      = isset( $cat['slug'] ) ? $cat['slug'] : sanitize_title( $cat['title'] ?? '' );
                $title     = isset( $cat['title'] ) ? $cat['title'] : '';
                $scenarios = isset( $cat['scenarios'] ) && is_array( $cat['scenarios'] ) ? $cat['scenarios'] : array();
            ?>
                <div class="scenario-group">
                    <h2 id="<?php echo esc_attr( 'rights-' . $slug ); ?>" class="scenario-group-heading"><?php echo esc_html( $title ); ?></h2>

                    <?php if ( empty( $scenarios ) ) : ?>
                        <p class="scenario-empty">Scenarios for this category are being written.</p>
                    <?php else : ?>
                        <?php foreach ( $scenarios as $scenario ) :
                            $situation  = isset( $scenario['situation'] ) ? $scenario['situation'] : '';
                            $right      = isset( $scenario['right'] ) ? $scenario['right'] : '';
                            $action     = isset( $scenario['action'] ) ? $scenario['action'] : '';
                            $related    = isset( $scenario['amendments'] ) && is_array( $scenario['amendments'] ) ? $scenario['amendments'] : array();
                        ?>
                            <article class="scenario">
                                <?php if ( $situation ) : ?>
                                    <h3 class="scenario-situation"><?php echo esc_html( $situation ); ?></h3>
                                <?php endif; ?>
                                <?php if ( $right ) : ?>
                                    <p class="scenario-right"><strong>Your right:</strong> <?php echo esc_html( $right ); ?></p>
                                <?php endif; ?>
                                <?php if ( $action ) : ?>
                                    <p class="scenario-action"><strong>What to do:</strong> <?php echo esc_html( $action ); ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $related ) ) : ?>
                                    <p class="scenario-related"><strong>Related amendments:</strong>
                                        <?php
                                        $links = array();
                                        foreach ( $related as $num ) {
                                            $n = (int) $num;
                                            if ( $n > 0 ) {
                                                $links[] = '<a href="' . esc_url( '#amendment-' . $n ) . '">' . esc_html( $n ) . '</a>';
                                            }
                                        }
                                        echo wp_kses( implode( ', ', $links ), array( 'a' => array( 'href' => array() ) ) );
                                        ?>
                                    </p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>The 27 Amendments, Explained</h2>
        <p class="section-intro">Every amendment to the United States Constitution, with its original text, a plain-English translation, and the key points to remember.</p>

        <?php if ( empty( $amendments ) ) : ?>
            <div class="dict-empty">
                <h2>Content is loading</h2>
                <p class="lead" style="margin: 0 auto;">The amendments list will appear here as content is added.</p>
            </div>
        <?php else : ?>
            <div class="amendments-list">
                <?php foreach ( $amendments as $amendment ) :
                    $number     = isset( $amendment['number'] ) ? (int) $amendment['number'] : 0;
                    $roman      = isset( $amendment['roman'] ) ? $amendment['roman'] : '';
                    $am_title   = isset( $amendment['title'] ) ? $amendment['title'] : '';
                    $year       = isset( $amendment['year'] ) ? $amendment['year'] : '';
                    $text       = isset( $amendment['text'] ) ? $amendment['text'] : '';
                    $plain      = isset( $amendment['plain'] ) ? $amendment['plain'] : '';
                    $key_points = isset( $amendment['key_points'] ) && is_array( $amendment['key_points'] ) ? $amendment['key_points'] : array();
                ?>
                    <article class="amendment" id="<?php echo esc_attr( 'amendment-' . $number ); ?>">
                        <div class="amendment-head">
                            <?php if ( $roman ) : ?>
                                <span class="amendment-roman"><?php echo esc_html( $roman ); ?></span>
                            <?php endif; ?>
                            <span class="amendment-number">Amendment <?php echo esc_html( $number ); ?></span>
                            <?php if ( $am_title ) : ?>
                                <span class="amendment-title"><?php echo esc_html( $am_title ); ?></span>
                            <?php endif; ?>
                            <?php if ( $year ) : ?>
                                <span class="amendment-year"><?php echo esc_html( $year ); ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ( $text ) : ?>
                            <details class="amendment-original">
                                <summary>Original text</summary>
                                <blockquote><?php echo esc_html( $text ); ?></blockquote>
                            </details>
                        <?php endif; ?>

                        <?php if ( $plain ) : ?>
                            <div class="amendment-plain">
                                <h4>In plain English</h4>
                                <p><?php echo esc_html( $plain ); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $key_points ) ) : ?>
                            <ul class="amendment-points">
                                <?php foreach ( $key_points as $point ) : ?>
                                    <li><?php echo esc_html( $point ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
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
