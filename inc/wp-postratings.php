<?php
/**
 * WP-Postratings customize
 *
 * @package lyt
 * @since 1.0.0
 */

/** 
 * Добавляем рейтинг в мета данные после статьи
 * 
 */
if ( function_exists( 'the_ratings' ) ) {
	add_action( 'genesis_entry_footer', 'ly_post_ratings' );

	function ly_post_ratings() {

    return the_ratings();
	}

	// Отключаем вывод разметки Article и оставляем только рейтинг
	add_filter( 'wp_postratings_schema_itemtype', '__return_false' );

}
