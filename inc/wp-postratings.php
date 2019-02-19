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
		$disabled_post_ratings = false;
		$disabled_post_ratings = apply_filters( 'ly_post_ratings_show', $disabled_post_ratings );
		if (!$disabled_post_ratings) {
			return the_ratings();
		}
    
	}

	// Отключаем вывод разметки Article и оставляем только рейтинг
	add_filter( 'wp_postratings_schema_itemtype', '__return_false' );

	// На каких страницах не показывать рейтинг
	// Эта функция добавлена в плагин my-custom-functions для удобства добавления новых страниц
	/*
	add_filter( 'ly_post_ratings_show', 'ly_post_ratings_disabled');
	 
	function ly_post_ratings_disabled( $disabled_post_ratings ) {
	    if (is_page(
			array(
				'o-proekte',
	            'karta-sajta'
				)
			)) {
		$disabled_post_ratings = true;
		}
		return $disabled_post_ratings;
	}
	*/
}