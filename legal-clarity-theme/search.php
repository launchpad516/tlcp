<?php
/**
 * Search results template.
 *
 * @package LegalClarity
 */

get_header(); ?>

<section class="page-hero">
    <div class="container">
        <h1>Search Results</h1>
        <?php if ( get_search_query() ) : ?>
            <p class="lead">Results for: <strong>“<?php echo esc_html( get_search_query() ); ?>”</strong></p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="article-card">
                        <div class="article-body">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="article-date"><?php echo esc_html( get_the_date() ); ?></div>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 22 ); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <div class="text-center mt-xl"><?php the_posts_pagination(); ?></div>
        <?php else : ?>
            <div class="text-center">
                <h2>No results found</h2>
                <p class="lead" style="margin: 0 auto;">Try a different keyword, or explore the <a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>">Dictionary</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
