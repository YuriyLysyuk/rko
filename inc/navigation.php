<?php
/**
 * Navigation
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

// Primary Nav in Header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

/**
 * Мобильное меню с формой поиска
 *
 */
function rko_mobile_menu() {	
  echo '<nav class="nav-mobile">';
  	echo '<button class="search-toggle">';
  		echo ea_icon(array('icon' => 'search', 'size' => 16));
		echo '</button>';
	
		echo '<button class="mobile-menu-toggle">';
			echo ea_icon(array('icon' => 'menu', 'size' => 16, 'class' => 'open'));
			echo ea_icon(array('icon' => 'close', 'size' => 16, 'class' => 'close'));
		echo '</button>';
		echo '</nav>';
}	
add_action( 'genesis_header', 'rko_mobile_menu', 11 );

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function ea_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = ea_icon( array( 'icon' => 'navigate-down', 'size' => 16 ) );

		$output .= sprintf(
			'<button class="submenu-expand" tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'ea_nav_add_dropdown_icons', 10, 4 );

