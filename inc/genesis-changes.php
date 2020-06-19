<?php
/**
 * Genesis Changes
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

// Theme Supports
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'site-inner', 'footer-widgets', 'footer' ) );
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );
add_theme_support( 'genesis-footer-widgets', 3 );

// h1 on home
// add_filter( 'genesis_site_title_wrap', function( $wrap ) { return is_front_page() ? 'h1' : $wrap; } );

// Remove admin bar styling
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

// Remove Genesis Favicon (use site icon instead)
remove_action( 'wp_head', 'genesis_load_favicon' );


remove_action( 'wp_head', 'genesis_do_meta_pingback' );

// Remove Header Description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

/// Remove unused sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Remove layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );

// Remove layout metaboxes
remove_theme_support( 'genesis-inpost-layouts' );
remove_theme_support( 'genesis-archive-layouts' );

// Use full width layout 
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Убираем хлебные крошки
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');

// Add New Sidebars
// genesis_register_widget_area( array( 'id' => 'blog-sidebar', 'name' => 'Blog Sidebar' ) );

/**
 * Remove Genesis Templates
 *
 */
function ea_remove_genesis_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'ea_remove_genesis_templates' );

/** 
 * Удаляем ссылку на главную с лого на главной странице
 *
 */
function ly_unlink_logo( $title, $inside, $wrap ) {
		if (is_front_page()) {
			$inside = sprintf( '%s', get_bloginfo( 'name' ) );
		}

    return sprintf( '<%1$s class="site-title" itemprop="headline">%2$s</%1$s>', $wrap, $inside );
}

// add_filter( 'genesis_seo_title', 'ly_unlink_logo', 10, 3 );

// Убираем вывод ссылок категории и меток в посте для записи
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
