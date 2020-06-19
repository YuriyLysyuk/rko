<?php
/**
 * Template Name: Главная
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.3.0
 **/

// Если доступны функции плагина аплодисментов или шаринга
if (
  function_exists('rkocf_wpapplaud') ||
  function_exists('ADDTOANY_SHARE_SAVE_KIT')
) {
  global $post;

  // Проверяем, отключен ли вывод аплодисментов для страницы
  $applaudExclude = get_post_meta($post->ID, '_wp_applaud_exclude', true);
  // Проверяем, отключен ли вывод кнопок шаринга для страницы
  $sharingDisabled = get_post_meta($post->ID, 'sharing_disabled', true);
  // Если что-либо включено из кнопок шаринга или аплодисментов
  if (!$applaudExclude || !$sharingDisabled) {
    // Добавляем поддержку футера для страницы, в который они будут выводиться
    add_post_type_support('page', 'genesis-entry-meta-after-content');
  }
}

function rko_front_page_CTA()
{
  $post_id = get_the_ID();

  $title = get_field('front_page_cta_title');
  if (empty($title)) {
    $title = get_the_title($post_id);
  }

  $description = get_field('front_page_cta_description');
  $button = get_field('front_page_cta_button');
  $svg = get_field('front_page_cta_svg');

  echo '<div class="front-page-cta">';
  echo '<h1>' . esc_html($title) . '</h1>';
  echo wpautop($description);
  echo $button;
  echo $svg;
  echo '</div>';
}
add_action('genesis_after_header', 'rko_front_page_CTA', 12);

// Убираем стандартный h1 страницы
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);
remove_action('genesis_entry_header', 'genesis_do_post_title');

get_header();

do_action('genesis_before_content');

genesis_markup([
  'open' => '<main %s>',
  'context' => 'content',
]);

do_action('genesis_before_loop');

do_action('genesis_loop');

do_action('genesis_after_loop');

genesis_markup([
  'close' => '</main>', // End .content.
  'context' => 'content',
]);

get_footer();
