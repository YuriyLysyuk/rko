<?php
/**
 * Back to top button
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3.2
**/

// Вывод кнопки
function rko_back_to_top_button() {
	echo '<a class="to-top-button" href="#top">'. ea_icon(array('icon' => 'navigate-up', 'size' => 26)) .'</a>';
}

add_action('wp_footer','rko_back_to_top_button');	