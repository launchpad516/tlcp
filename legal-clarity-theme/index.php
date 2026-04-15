<?php
/**
 * Main template — fallback / blog index.
 *
 * @package LegalClarity
 */

get_header(); ?>

<section class="page-hero">
    <div class="container">
        <h1><?php echo is_home() ? 'Insights' : wp_get_document_title(); ?></h1>
        <p class="lead">Articles, guides, and explainers to help you navigate the legal world with clarity.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="article-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="article-image">
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="article-body">
                            <?php $cats = get_the_category(); if ( ! empty( $cats ) ) : ?>
                                <div class="article-category"><?php echo esc_html( $cats[0]->name ); ?></div>
                            <?php endif; ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="article-date"><?php echo esc_html( get_the_date() ); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="text-center mt-xl">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="text-center">
                <h2>No articles yet</h2>
                <p class="lead" style="margin: 0 auto;">Check back soon — new insights and guides are added regularly.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
