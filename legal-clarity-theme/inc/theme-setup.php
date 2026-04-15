<?php
/**
 * Automatic page creation on theme activation.
 *
 * @package LegalClarity
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Pages to auto-create with their slugs, titles, and templates.
 */
function tlcp_default_pages() {
    return array(
        'home' => array(
            'title'    => 'Home',
            'template' => '',
        ),
        'dictionary' => array(
            'title'    => 'Dictionary',
            'template' => 'page-templates/page-dictionary.php',
        ),
        'know-your-rights' => array(
            'title'    => 'Know Your Rights',
            'template' => 'page-templates/page-know-your-rights.php',
        ),
        'insights' => array(
            'title'    => 'Insights',
            'template' => '',
        ),
        'about' => array(
            'title'    => 'About',
            'template' => 'page-templates/page-about.php',
        ),
        'contribute' => array(
            'title'    => 'Contribute',
            'template' => 'page-templates/page-contribute.php',
        ),
        'contact' => array(
            'title'    => 'Contact',
            'template' => 'page-templates/page-contact.php',
        ),
        'faq' => array(
            'title'    => 'Frequently Asked Questions',
            'template' => 'page-templates/page-faq.php',
        ),
        'privacy-policy' => array(
            'title'    => 'Privacy Policy',
            'template' => 'page-templates/page-privacy.php',
        ),
        'terms-and-conditions' => array(
            'title'    => 'Terms and Conditions',
            'template' => 'page-templates/page-terms.php',
        ),
        'accessibility' => array(
            'title'    => 'Accessibility Statement',
            'template' => 'page-templates/page-accessibility.php',
        ),
        'citation-guide' => array(
            'title'    => 'Citation Guide',
            'template' => 'page-templates/page-citation-guide.php',
        ),
    );
}

/**
 * Create pages when the theme is activated.
 */
function tlcp_activate_theme() {
    $pages = tlcp_default_pages();

    foreach ( $pages as $slug => $data ) {
        $existing = get_page_by_path( $slug );
        if ( $existing ) { continue; }

        $args = array(
            'post_title'   => $data['title'],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        );

        $page_id = wp_insert_post( $args );

        if ( ! is_wp_error( $page_id ) && $page_id && ! empty( $data['template'] ) ) {
            update_post_meta( $page_id, '_wp_page_template', $data['template'] );
        }
    }

    // Set Home as front page.
    $home = get_page_by_path( 'home' );
    $blog = get_page_by_path( 'insights' );

    if ( $home ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home->ID );
    }
    if ( $blog ) {
        update_option( 'page_for_posts', $blog->ID );
    }

    // Create primary menu.
    tlcp_create_primary_menu();

    // Mark setup complete.
    update_option( 'tlcp_setup_complete', '1' );

    // Flush rewrite rules.
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'tlcp_activate_theme' );

/**
 * Create the primary navigation menu.
 */
function tlcp_create_primary_menu() {
    $menu_name = 'Primary Menu';
    $menu      = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu ) {
        $menu_id = wp_create_nav_menu( $menu_name );
    } else {
        $menu_id = $menu->term_id;
    }

    // Clear existing menu items.
    $items = wp_get_nav_menu_items( $menu_id );
    if ( $items ) {
        foreach ( $items as $item ) {
            wp_delete_post( $item->ID, true );
        }
    }

    $menu_items = array( 'home', 'dictionary', 'know-your-rights', 'insights', 'about' );

    foreach ( $menu_items as $slug ) {
        $page = get_page_by_path( $slug );
        if ( $page ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => $page->post_title,
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $page->ID,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
            ) );
        }
    }

    // Assign menu to primary location.
    $locations            = get_theme_mod( 'nav_menu_locations' );
    $locations['primary'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Admin notice after activation.
 */
function tlcp_activation_notice() {
    if ( get_option( 'tlcp_setup_complete' ) === '1' && ! get_option( 'tlcp_notice_dismissed' ) ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong>The Legal Clarity Project theme is set up!</strong> All pages have been created and the navigation menu is ready. You can start editing content under <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>">Pages</a>.</p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'tlcp_activation_notice' );
