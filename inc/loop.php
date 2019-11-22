<?php
/**
 * Loop
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

/**
 * Use Archive Loop
 *
 */
function ea_use_archive_loop() {

	if( ! is_singular() ) {
		add_action( 'genesis_loop', 'ea_archive_loop' );
		remove_action( 'genesis_loop', 'genesis_do_loop' );
	}
}
add_action( 'template_redirect', 'ea_use_archive_loop', 20 );

/**
 * Archive Loop
 * Uses template partials
 */
function ea_archive_loop() {

	global $loop_counter;
	global $loop_image_view;
	global $loop_image_size;

	$loop_counter = 0;
	$loop_image_view = '';
	$loop_image_size = '';

	if ( have_posts() ) {

		do_action( 'genesis_before_while' );

		while ( have_posts() ) {

			the_post();
			do_action( 'genesis_before_entry' );

			// Классы для grid
			if ($loop_counter < 3) {
				$loop_image_view = ' large';
				$loop_image_size = 'medium';

			} else {
				$loop_image_view = ' image-left';
				$loop_image_size = 'thumbnail';
			}

			// Template part
			$partial = apply_filters( 'ea_loop_partial', 'archive' );
			$context = apply_filters( 'ea_loop_partial_context', is_search() ? 'search' : get_post_type() );
			get_template_part( 'partials/' . $partial, $context );

			do_action( 'genesis_after_entry' );

			$loop_counter++;
		}

		do_action( 'genesis_after_endwhile' );

	} else {

		remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
		get_template_part( 'partials/' . 'archive', 'none' );
		
		do_action( 'genesis_loop_else' );

	}
}
