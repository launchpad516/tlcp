<?php
/**
 * Site Header
 *
 * @package LegalClarity
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container site-header-inner">
        <?php echo tlcp_logo_html(); ?>

        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <?php echo tlcp_icon( 'menu' ); ?>
        </button>

        <nav class="site-nav" aria-label="Primary">
            <ul class="site-nav-list">
                <?php
                $nav_items = array(
                    'home'             => array( 'Home', home_url( '/' ) ),
                    'dictionary'       => array( 'Dictionary', home_url( '/dictionary/' ) ),
                    'know-your-rights' => array( 'Know Your Rights', home_url( '/know-your-rights/' ) ),
                    'insights'         => array( 'Insights', home_url( '/insights/' ) ),
                    'about'            => array( 'About', home_url( '/about/' ) ),
                );
                foreach ( $nav_items as $slug => $item ) {
                    $current = is_page( $slug ) || ( 'home' === $slug && is_front_page() );
                    $class   = $current ? ' class="active"' : '';
                    printf( '<li><a href="%s"%s>%s</a></li>', esc_url( $item[1] ), $class, esc_html( $item[0] ) );
                }
                ?>
                <li><a href="<?php echo esc_url( home_url( '/dictionary/' ) ); ?>" class="btn btn-secondary btn-sm">Explore the Dictionary</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="site-main">
