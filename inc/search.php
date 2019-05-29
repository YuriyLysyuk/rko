<?php
/**
 * Search
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Custom search form
 *
 */

function ea_search_form() {
	ob_start();
	get_template_part( 'searchform' );
	return ob_get_clean();
}
add_filter( 'genesis_search_form', 'ea_search_form' );

/**
 * Добавляем кнопку поиска в главное меню
 *
 */
function ea_primary_menu_extras( $menu, $args ) {
  if( 'primary' == $args->theme_location )
    $menu .= '<li class="menu-item search"><button href="#" class="search-toggle">' . ea_icon(array('icon' => 'search')) . '</button></li>';
  return $menu;
}
add_filter( 'wp_nav_menu_items', 'ea_primary_menu_extras', 10, 2 );

/**
 * Добавляем форму поиска
 *
 */
function ly_header_search() {	
  get_search_form();	
}	
add_action( 'genesis_after_header', 'ly_header_search', 12 );

/**
 * Добавляем форму поиска
 *
 */
function ly_nav_mobile() {	
  echo '<div class="nav-mobile"><button class="search-toggle">' . ea_icon(array('icon' => 'search', 'size' => '32')) . '<span class="screen-reader-text">Поиск</span></button>';

  echo '<button class="mobile-menu-toggle"><span class="open">' . ea_icon(array('icon' => 'menu', 'size' => '32')) .'</span><span class="close">' . ea_icon(array('icon' => 'close', 'size' => '32')) .'</span><span class="screen-reader-text">Переключатель меню</span></button></div>';
}	
add_action( 'genesis_header', 'ly_nav_mobile', 10 );
