<?php
/**
 * 404 / No Results partial
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/


echo '<section class="no-results not-found">';
	echo '<p class="h4">' . esc_html__( 'Nothing Found :(', 'rko' ) . '</p>';
	echo '<div class="entry-content">';

	if ( is_search() ) {
		echo '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rko' ) . '</p>';

	} else {

		echo '<p>' . esc_html__( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'rko' ) . '</p>';
		get_search_form();
	}

	echo '</div>';
echo '</section>';
