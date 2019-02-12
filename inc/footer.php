<?php
/**
 * Footer
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Widget in Footer
//remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
//add_action( 'genesis_footer', 'genesis_footer_widget_areas', 9 );

// Remove Edit link
//add_filter( 'genesis_sidebar_title_output', '__return_false' );

//* Change the footer text
add_filter('genesis_footer_creds_text', 'ly_footer_creds_filter');

function ly_footer_creds_filter( $creds ) {
	$creds = 'Все права защищены [footer_copyright] &middot; etidni.help';
	return $creds;
}