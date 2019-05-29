<?php
/**
 * WP-polls customize
 *
 * @package rko
 * @since 1.0.0
 */

if ( function_exists( 'poll_scripts' ) ) {
	/**
   *  Disable script's and style's WP-polls
   */
  add_action( 'wp_enqueue_scripts', 'ly_deregister_scripts_wp_polls' );

  function ly_deregister_scripts_wp_polls() {
    wp_deregister_style( 'wp-polls' );
  }
}