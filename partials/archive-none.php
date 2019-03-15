<?php
/**
 * 404 / No Results partial
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/


echo '<section class="no-results not-found">';

	echo '<header class="entry-header"><p class="h4">Ничего не найдено :(</p></header>';
	echo '<div class="entry-content">';

	if ( is_search() ) {

		echo '<p>К сожалению, по вашему запросу мы ничего не нашли, попробуйте изменить вопрос.</p>';

	} else {

		echo '<p>Страница которую вы ищете не существует. Вы можете перейти на <a href="' . esc_url( home_url( "/" ) ) .'">главную страницу</a>. Или воспользутесь поиском ниже.</p>';
		$search_form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( "/" ) ) .'">';
		$search_form.= '<label>';
		$search_form.= '<input type="search" class="search-field" placeholder="Найти на сайте&hellip;" value="'. get_search_query() .'" name="s" title="Поиск по сайту">';
		$search_form.= '</label>';
		$search_form.= '<button type="submit" class="search-submit">'. ea_icon(array('icon' => 'search')) .'</button>';
		$search_form.= '</form>';
		echo $search_form;
	}

	echo '</div>';
echo '</section>';
