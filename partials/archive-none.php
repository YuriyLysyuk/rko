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

		echo '<p>Кажется, мы не можем найти то, что вы ищете. Возможно поиск вам поможет.</p>';
	}

	echo '</div>';
echo '</section>';
