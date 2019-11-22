<?php
/**
 * Debug functions
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/

/**
 * Список идентификаторов стилей
 *
 */
function list_loaded_styles( $tag, $handle, $src ){
	// filter...
	echo 'Стиль: ' . $handle . '<br>';
	return $tag;
}

add_filter( 'style_loader_tag', 'list_loaded_styles', 10, 3 );

/**
 * Список идентификаторов скриптов
 *
 */

function list_loaded_scripts( $tag, $handle, $src ){
	// filter...
	echo 'Скрипт: ' . $handle . '<br>';
	return $tag;
}

add_filter( 'script_loader_tag', 'list_loaded_scripts', 10, 3 );