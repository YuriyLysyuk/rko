<?php
/**
 * Search
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
 **/

/**
 * Custom search form
 *
 */

function ea_search_form()
{
  ob_start();
  get_template_part('searchform');
  return ob_get_clean();
}
add_filter('genesis_search_form', 'ea_search_form');

/**
 * Добавляем кнопку поиска в главное меню
 *
 */
function ea_primary_menu_extras($menu, $args)
{
  if ('primary' == $args->theme_location) {
    $menu .=
      '<li class="menu-item search"><button href="#" class="search-toggle">' .
      ea_icon(array('icon' => 'search', 'size' => 16, 'class' => 'open')) .
      ea_icon(array('icon' => 'close', 'size' => 16, 'class' => 'close')) .
      '</button></li>';
  }
  return $menu;
}
add_filter('wp_nav_menu_items', 'ea_primary_menu_extras', 10, 2);

/**
 * Добавляем форму поиска
 *
 */
function ly_header_search()
{
  get_template_part('partials/headersearch');
}
add_action('genesis_after_header', 'ly_header_search', 12);
