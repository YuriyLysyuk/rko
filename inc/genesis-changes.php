<?php
/**
 * Genesis Changes
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Theme Supports
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-responsive-viewport' );
// add_theme_support( 'genesis-footer-widgets', 3 );
add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'site-inner', 'footer' ) );
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );
add_theme_support( 'genesis-inpost-layouts' );
add_theme_support( 'genesis-archive-layouts' );

// Adds support for accessibility.

add_theme_support(
	'genesis-accessibility', array(
		//'404-page',
	//	'drop-down-menu',
		//'headings',
		//'rems',
		//'search-form',
		//'screen-reader-text',
	)
);


// Remove admin bar styling
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

// Remove Edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

// Remove Genesis Favicon (use site icon instead)
remove_action( 'wp_head', 'genesis_load_favicon' );

// Remove Header Description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Remove sidebar layouts
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_theme_support( 'genesis-inpost-layouts' );
remove_theme_support( 'genesis-archive-layouts' );

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
 * Modify Post Info
 *
 */
function ly_post_info_filter($post_info) {
	$author = '<span class="entry-author"><span class="label">автор</span>';
	$author .= get_the_author();
	$author .= '</span>';

	$modified_time = '<span class="entry-date"><span class="label">обновлено</span>';
	$modified_time .= '[post_modified_date format="F j, Y"]';
	$modified_time .= '</span>';

	$comments = '<span class="entry-comments-link"><span class="label">обсуждение</span>';
	$comments .= '[post_comments zero="Нет комментариев" one="1 комментарий" more="% комментариев" hide_if_off="disabled"]';
	$comments .= '</span>';

	$post_info = $author . $modified_time . $comments;

	return $post_info;
}
add_filter('genesis_post_info', 'ly_post_info_filter');