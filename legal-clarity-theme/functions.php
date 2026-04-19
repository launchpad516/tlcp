<?php
/**
 * The Legal Clarity Project - Theme Functions
 *
 * @package LegalClarity
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'TLCP_VERSION', '1.0.0' );
define( 'TLCP_DIR', get_template_directory() );
define( 'TLCP_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function tlcp_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'customize-selective-refresh-widgets' );

    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'legal-clarity' ),
        'footer'  => __( 'Footer Navigation', 'legal-clarity' ),
    ) );
}
add_action( 'after_setup_theme', 'tlcp_setup' );

/**
 * Enqueue styles and scripts.
 */
function tlcp_enqueue_assets() {
    // Google Fonts (Cormorant Garamond + Inter)
    wp_enqueue_style(
        'tlcp-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600&display=swap',
        array(),
        null
    );

    wp_enqueue_style( 'tlcp-style', get_stylesheet_uri(), array( 'tlcp-fonts' ), TLCP_VERSION );

    wp_enqueue_script( 'tlcp-main', TLCP_URI . '/assets/js/main.js', array(), TLCP_VERSION, true );

    if ( is_page_template( 'page-templates/page-dictionary.php' ) ) {
        wp_enqueue_script( 'tlcp-dictionary', TLCP_URI . '/assets/js/dictionary.js', array(), TLCP_VERSION, true );
    }

    if ( is_page_template( 'page-templates/page-know-your-rights.php' ) ) {
        wp_enqueue_script( 'tlcp-know-your-rights', TLCP_URI . '/assets/js/know-your-rights.js', array(), TLCP_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'tlcp_enqueue_assets' );

/**
 * Load data and helpers.
 */
require_once TLCP_DIR . '/inc/data-helpers.php';
require_once TLCP_DIR . '/inc/theme-setup.php';
require_once TLCP_DIR . '/inc/contact-handler.php';

/**
 * Add favicon.
 */
function tlcp_favicon() {
    ?>
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url( TLCP_URI . '/assets/images/favicon.svg' ); ?>">
    <?php
}
add_action( 'wp_head', 'tlcp_favicon' );

/**
 * Helper: render an SVG icon.
 */
function tlcp_icon( $name, $size = 24 ) {
    $icons = array(
        'search' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>',
        'menu'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
        'book'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/><circle cx="14" cy="11" r="2.5"/><path d="m16 13 1.5 1.5"/></svg>',
        'shield' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
        'bulb'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 0-4 12.7V17h8v-2.3A7 7 0 0 0 12 2z"/></svg>',
        'chat'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
        'twitter'=> '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8a8.5 8.5 0 0 1-2.4.7 4.1 4.1 0 0 0 1.8-2.3 8.3 8.3 0 0 1-2.6 1 4.1 4.1 0 0 0-7 3.7 11.7 11.7 0 0 1-8.5-4.3 4.1 4.1 0 0 0 1.3 5.5A4.1 4.1 0 0 1 3 9.6v.1a4.1 4.1 0 0 0 3.3 4A4.2 4.2 0 0 1 5 14a4.1 4.1 0 0 0 3.8 2.9A8.3 8.3 0 0 1 2 18.6 11.7 11.7 0 0 0 8.3 20c7.5 0 11.7-6.3 11.7-11.7v-.5A8.4 8.4 0 0 0 22 5.8z"/></svg>',
        'facebook'=> '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 9H16V6h-2.5C11.6 6 10 7.6 10 9.5V11H8v3h2v8h3v-8h2.5L16 11h-3V9.5c0-.3.2-.5.5-.5z"/></svg>',
        'linkedin'=> '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM8 18H5v-9h3v9zM6.5 7.7a1.7 1.7 0 1 1 0-3.4 1.7 1.7 0 0 1 0 3.4zM18 18h-3v-4.7c0-1.1 0-2.5-1.5-2.5s-1.8 1.2-1.8 2.4V18h-3v-9h2.9v1.2a3.1 3.1 0 0 1 2.8-1.5c3 0 3.6 2 3.6 4.5V18z"/></svg>',
        'youtube' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.5 7.1a2.6 2.6 0 0 0-1.8-1.8C19 5 12 5 12 5s-7 0-8.7.3a2.6 2.6 0 0 0-1.8 1.8A27 27 0 0 0 1 12a27 27 0 0 0 .5 4.9 2.6 2.6 0 0 0 1.8 1.8C5 19 12 19 12 19s7 0 8.7-.3a2.6 2.6 0 0 0 1.8-1.8A27 27 0 0 0 23 12a27 27 0 0 0-.5-4.9zM10 15.5v-7l6 3.5-6 3.5z"/></svg>',
    );
    if ( ! isset( $icons[ $name ] ) ) return '';
    $style = 'width:' . intval( $size ) . 'px;height:' . intval( $size ) . 'px;';
    return '<span class="icon" style="' . esc_attr( $style ) . '">' . $icons[ $name ] . '</span>';
}

/**
 * Get the site logo as an inline SVG / image reference.
 */
function tlcp_logo_html( $full = true ) {
    $img = TLCP_URI . '/assets/images/logo.svg';
    if ( $full ) {
        return '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img src="' . esc_url( $img ) . '" alt="The Legal Clarity Project" /><span class="site-logo-text"><span class="site-logo-top">The Legal Clarity</span><span class="site-logo-bot">Project</span></span></a>';
    }
    return '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img src="' . esc_url( $img ) . '" alt="TLCP" /></a>';
}
