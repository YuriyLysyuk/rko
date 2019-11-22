<?php
/**
 * Search Results
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/**
 * Search header
 *
 */
function ea_search_header() {
	do_action( 'genesis_archive_title_descriptions', esc_html__( 'Search Results', 'rko' ), get_search_form( false ), 'search-description' );
}
add_action( 'genesis_before_loop', 'ea_search_header', 15 );

// Build the page using the archive template
require get_stylesheet_directory() . '/archive.php';
