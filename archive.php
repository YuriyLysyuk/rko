<?php
/**
 * Archive
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Blog Archive Body Class
 *
 */
function ea_blog_archive_body_class( $classes ) {
	if (!is_search()) {
		$classes[] = 'archive';
	}
	
	return $classes;
}
add_filter( 'body_class', 'ea_blog_archive_body_class' );

// На страницах пагинации в архивах убираем заголовок и описание
if (is_paged()) {
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline', 10, 3 );
	remove_action ( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_intro_text', 12, 3 );
}

if (is_search()) {
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

	remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	add_action( 'genesis_before_while', 'genesis_do_search_title' );
}


function genesis_do_search_title() {

	$search_form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( "/" ) ) .'">';
	$search_form.= '<label>';
	$search_form.= '<input type="search" class="search-field" placeholder="Найти на сайте&hellip;" value="'. get_search_query() .'" name="s" title="Поиск по сайту">';
	$search_form.= '</label>';
	$search_form.= '<button type="submit" class="search-submit">'. ea_icon(array('icon' => 'search')) .'</button>';
	$search_form.= '</form>';

	$title = sprintf( '<header class="archive-description search-archive-description"><h1 class="archive-title">%s</h1>%s</header>', apply_filters( 'genesis_search_title_text', 'Результаты поиска' ), $search_form );

	echo $title;

}

// На странице поиска когда нет результатов, убираем стандартный вывод и выводим header и  partials/arhive-none.php
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
add_action( 'genesis_loop_else', 'genesis_do_search_title' );

genesis();
