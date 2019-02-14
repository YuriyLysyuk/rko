<?php
/**
 * Footer
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
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

// Сделаем косой стиль футера
function ly_kosoy_footer() {
	echo '<svg class="footer-angle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon fill="#f5f5f5" points="0,100 100,0 100,100"></polygon></svg>';
}

add_action('genesis_footer','ly_kosoy_footer');	
