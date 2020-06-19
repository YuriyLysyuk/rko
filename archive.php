<?php
/**
 * Archive
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.3.0
 **/

/**
 * Blog Archive Body Class
 *
 */
function ea_blog_archive_body_class($classes)
{
  if (!is_search()) {
    $classes[] = 'archive';
  }
  return $classes;
}
add_filter('body_class', 'ea_blog_archive_body_class');

// На страницах пагинации в архивах убираем заголовок и описание
if (is_paged()) {
  remove_action(
    'genesis_archive_title_descriptions',
    'genesis_do_archive_headings_headline',
    10,
    3
  );
  remove_action(
    'genesis_archive_title_descriptions',
    'genesis_do_archive_headings_intro_text',
    12,
    3
  );
}

genesis();
