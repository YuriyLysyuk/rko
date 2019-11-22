<?php
/**
 * Footer
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
**/

// Удаляем стандартный футер но не разметку
remove_action( 'genesis_footer', 'genesis_do_footer' );

/**
 * Add Footer Widget to Genesis
 *
 * 
 */
add_action( 'widgets_init', 'ly_extra_widgets' );

// Add in new Widget area
function ly_extra_widgets() {	
	genesis_register_sidebar( array(
		'id'            => 'footer-section',
		'name'          => __( 'Footer', 'Genesis' ),
		'description'   => __( 'This is the general footer area', 'Genesis' ),
		'before_widget' => '<div class="footer-section">',
	  'after_widget'  => '</div>',
	));
}

add_action('genesis_footer','ly_footer_widget');	
// Position the Footer Area
function ly_footer_widget() {
	genesis_widget_area ('footer-section', array(
		'before' => '',
		'after'  => '',
	));
}