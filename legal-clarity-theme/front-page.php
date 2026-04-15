<?php
/**
 * Homepage Template
 *
 * @package LegalClarity
 */

get_header(); ?>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <h1>Making Legal Language Clear and Accessible</h1>
                <p>We break down complex legal terms and concepts so you can understand your rights and obligations.</p>

                <form class="hero-search" action="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>" method="get">
                    <input type="text" name="q" placeholder="Search the Legal Dictionary…" aria-label="Search the dictionary">
                    <button type="submit" aria-label="Search"><?php echo tlcp_icon( 'search', 18 ); ?></button>
                </form>
            </div>

            <div class="hero-graphic" aria-hidden="true">
                <img src="<?php echo esc_url( TLCP_URI . '/assets/images/hero-graphic.svg' ); ?>" alt="" onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

<!-- Feature Cards -->
<section class="features">
    <div class="container">
        <div class="grid grid-4">
            <div class="feature-card">
                <div class="feature-icon"><?php echo tlcp_icon( 'book', 48 ); ?></div>
                <h3>Search the Dictionary</h3>
                <p>Find clear, concise definitions of legal terms and phrases instantly.</p>
                <a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>" class="btn btn-primary btn-sm">Explore the Dictionary</a>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><?php echo tlcp_icon( 'shield', 48 ); ?></div>
                <h3>Know Your Rights</h3>
                <p>Learn about your rights in various legal situations and how to protect them.</p>
                <a href="<?php echo esc_url( home_url( '/know-your-rights/' ) ); ?>" class="btn btn-secondary btn-sm">Understand Your Rights</a>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><?php echo tlcp_icon( 'bulb', 48 ); ?></div>
                <h3>Legal Insights</h3>
                <p>Read articles and guides to gain clarity on important legal topics.</p>
                <a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" class="btn btn-primary btn-sm">Read the Articles</a>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><?php echo tlcp_icon( 'chat', 48 ); ?></div>
                <h3>Get Involved</h3>
                <p>Help us make the law more accessible by contributing your expertise.</p>
                <a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>" class="btn btn-primary btn-sm">Get Involved</a>
            </div>
        </div>
    </div>
</section>

<!-- Popular Terms -->
<section class="popular-terms">
    <div class="container">
        <div class="popular-layout">
            <div>
                <h2>Popular Legal Terms Explained</h2>
                <div class="popular-terms-list">
                    <?php
                    $popular = tlcp_get_popular_terms();
                    foreach ( $popular as $term ) : ?>
                        <div class="popular-term">
                            <h3><?php echo esc_html( $term['term'] ); ?></h3>
                            <p><?php echo esc_html( $term['definition'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-xl">
                    <a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>" class="btn btn-outline btn-sm">Browse the full dictionary</a>
                </div>
            </div>

            <aside class="contribute-card">
                <h3>Contribute to The Legal Clarity Project</h3>
                <p>Join us in our mission to make the law clear for everyone. Share your legal expertise and help us explain complex terms.</p>
                <a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>" class="btn btn-primary btn-sm">Contribute</a>
            </aside>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="articles">
    <div class="container">
        <h2 style="margin-bottom: 2rem;">Latest Articles</h2>

        <?php
        $posts = get_posts( array(
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        ) );

        if ( ! empty( $posts ) ) : ?>
            <div class="grid grid-3">
                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                    <article class="article-card">
                        <?php if ( has_post_thumbnail( $post ) ) : ?>
                            <a href="<?php the_permalink(); ?>" class="article-image"><?php the_post_thumbnail( 'medium_large' ); ?></a>
                        <?php endif; ?>
                        <div class="article-body">
                            <?php $cats = get_the_category( $post->ID ); if ( ! empty( $cats ) ) : ?>
                                <div class="article-category"><?php echo esc_html( strtoupper( $cats[0]->name ) ); ?></div>
                            <?php endif; ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="article-date"><?php echo esc_html( get_the_date( '', $post ) ); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">Read More</a>
                        </div>
                    </article>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div class="grid grid-3">
                <?php
                $placeholders = array(
                    array(
                        'category' => 'Know Your Rights',
                        'title'    => 'What to Do if You’re Pulled Over: Understanding Your Rights',
                        'date'     => 'Coming soon',
                    ),
                    array(
                        'category' => 'Legal Insights',
                        'title'    => 'The Basics of Contract Law: Key Concepts Simplified',
                        'date'     => 'Coming soon',
                    ),
                    array(
                        'category' => 'Legal Insights',
                        'title'    => 'Understanding Due Process: Your Fundamental Rights Explained',
                        'date'     => 'Coming soon',
                    ),
                );
                foreach ( $placeholders as $p ) : ?>
                    <article class="article-card">
                        <div class="article-image" style="background: linear-gradient(135deg, #1a2e5a, #2563eb); aspect-ratio: 16/10;"></div>
                        <div class="article-body">
                            <div class="article-category"><?php echo esc_html( strtoupper( $p['category'] ) ); ?></div>
                            <h3><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h3>
                            <div class="article-date"><?php echo esc_html( $p['date'] ); ?></div>
                            <a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" class="btn btn-outline btn-sm">Read More</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
