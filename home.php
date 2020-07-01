<?php
/**
 * Home article list
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.3.0
 **/

// Заголовок для страницы блога
add_action('genesis_before_loop', 'rko_blog_title');
function rko_blog_title()
{
  echo '<header class="archive-description posts-page-description"><h1 class="archive-title">Блог</h1></header>';
}

// Build the page using the archive template
require get_stylesheet_directory() . '/archive.php';
