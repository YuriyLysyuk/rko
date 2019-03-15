<?php
/**
 * Search result partial
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="post-summary search-result">';

	echo '<h2 class="h4 entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

	echo '<p class="entry-date">';
		echo the_modified_date('j F Y');
	echo '</p>';

	the_excerpt();


echo '</article>';
