<?php
/**
 * Page
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
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

genesis();
