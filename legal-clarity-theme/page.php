<?php
/**
 * Default page template.
 *
 * @package LegalClarity
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <section class="page-hero">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <article class="prose">
                <?php the_content(); ?>
            </article>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer();
