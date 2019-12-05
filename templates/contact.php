<?php
/**
 * Template Name: Контакт
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.1.0
**/

// Full width layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove default Genesis elements
add_filter( 'genesis_markup_site-inner', '__return_null' );

add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

get_header ();

get_footer ();