<?php
/**
 * 404 template.
 *
 * @package LegalClarity
 */

get_header(); ?>

<section class="section">
    <div class="container text-center" style="padding: 4rem 0;">
        <div class="eyebrow">Error 404</div>
        <h1>Page not found</h1>
        <p class="lead" style="margin: 0 auto 2rem;">The page you’re looking for doesn’t exist or has moved. Try searching the dictionary or heading back home.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Return Home</a>
        <a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>" class="btn btn-outline" style="margin-left: 0.5rem;">Explore Dictionary</a>
    </div>
</section>

<?php get_footer();
