<?php
/**
 * Single post template.
 *
 * @package LegalClarity
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <section class="page-hero">
        <div class="container container-narrow">
            <?php $cats = get_the_category(); if ( ! empty( $cats ) ) : ?>
                <div class="eyebrow"><?php echo esc_html( $cats[0]->name ); ?></div>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
            <p class="lead"><?php echo esc_html( get_the_date() ); ?></p>
        </div>
    </section>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="container container-narrow" style="margin-top: 2rem;">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
    <?php endif; ?>

    <section class="section">
        <div class="container">
            <article class="prose">
                <?php the_content(); ?>
            </article>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer();
