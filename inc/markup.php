<?php
/**
 * Markup
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3.2
**/



/**
 * Add '.nav-menu' class to nav menus
 *
 * @param string $open, opening markup
 * @param array $args, markup args
 * @return string
 */
function ea_nav_menu_class( $open, $args ) {
	$open = str_replace( $args['context'], $args['context'] . ' nav-menu', $open );
	return $open;
}
add_filter( 'genesis_markup_nav-primary_open', 'ea_nav_menu_class', 10, 2 );
add_filter( 'genesis_markup_nav-secondary_open', 'ea_nav_menu_class', 10, 2 );

/**
 * Change '.content-sidebar-wrap' to '.content-area'
 *
 * @param string $open, opening markup
 * @param array $args, markup args
 * @return string
 */
function ea_change_content_sidebar_wrap( $attributes ) {
	$attributes['class'] = 'content-area';
	return $attributes;
}
add_filter( 'genesis_attr_content-sidebar-wrap', 'ea_change_content_sidebar_wrap' );

/**
 * Change '.content' to '.site-main'
 *
 * @param string $open, opening markup
 * @param array $args, markup args
 * @return string
 */
function ea_change_content( $attributes ) {
	$attributes['class'] = 'site-main';
	return $attributes;
}
add_filter( 'genesis_attr_content', 'ea_change_content' );

/**
 * Add '#top' to body for Back To Top Button
 *
 */
function rko_add_top_id( $attributes ) {
	$attributes['id'] = 'top';
	return $attributes;
}
add_filter( 'genesis_attr_body', 'rko_add_top_id' );

/**
 * Add #main-content to .site-inner
 *
 */
function ea_site_inner_id( $attributes ) {
	$attributes['id'] = 'main-content';
	return $attributes;
}
add_filter( 'genesis_attr_site-inner', 'ea_site_inner_id' );

/**
 * Remove padding from .site-inner
 *
 */
function ea_site_inner_no_padding( $attributes ) {
	$attributes['class'] .= ' full';
	return $attributes;
}
//add_filter( 'genesis_attr_site-inner', 'ea_site_inner_no_padding' );

/**
 * Archive Description markup
 *
 */
function ea_archive_description_markup( $markup ) {
	return str_replace( array( '<div', '</div' ), array( '<header', '</header' ), $markup );
}
add_filter( 'genesis_markup_posts-page-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_posts-page-description_close', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_taxonomy-archive-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_taxonomy-archive-description_close', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_author-archive-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_author-archive-description_close', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_cpt-archive-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_cpt-archive-description_close', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_date-archive-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_date-archive-description_close', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_search-description_open', 'ea_archive_description_markup' );
add_filter( 'genesis_markup_search-description_close', 'ea_archive_description_markup' );

/**
 * Archive Pagination markup
 *
 */
function ea_archive_pagination_markup( $markup ) {
	return str_replace( array( '<div', '</div' ), array( '<nav', '</nav' ), $markup );
}
add_filter( 'genesis_markup_archive-pagination_open', 'ea_archive_pagination_markup' );
add_filter( 'genesis_markup_archive-pagination_close', 'ea_archive_pagination_markup' );

add_filter( 'genesis_attr_cpt-archive-description', 'genesis_attributes_cpt_archive_description' );

/**
 * Search Header Classes
 *
 */
function ea_search_header_classes( $attributes ) {
	$attributes['class'] = 'archive-description search-description';
	return $attributes;
}
add_filter( 'genesis_attr_search-description', 'ea_search_header_classes' );

