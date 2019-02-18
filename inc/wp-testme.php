<?php
/**
 * WP-TestMe customize
 *
 * @package lyt
 * @since 1.0.0
 */

if ( function_exists( 'testme_css_theme' ) ) {
	/**
   *  Disable script's and style's WP-TestMe
   */
	remove_action('wp_head', 'testme_css_theme');
}