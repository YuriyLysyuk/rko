<?php
/**
 * Russian Date
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

function russian_date( $tdate = '' ) {
	if ( substr_count($tdate , '---') > 0 ) return str_replace('---', '', $tdate);

	$treplace = array (
		"Январь" => "января",
		"Февраль" => "февраля",
		"Март" => "марта",
		"Апрель" => "апреля",
		"Май" => "мая",
		"Июнь" => "июня",
		"Июль" => "июля",
		"Август" => "августа",
		"Сентябрь" => "сентября",
		"Октябрь" => "октября",
		"Ноябрь" => "ноября",
		"Декабрь" => "декабря",

		"January" => "января",
		"February" => "февраля",
		"March" => "марта",
		"April" => "апреля",
		"May" => "мая",
		"June" => "июня",
		"July" => "июля",
		"August" => "августа",
		"September" => "сентября",
		"October" => "октября",
		"November" => "ноября",
		"December" => "декабря", 

		"Sunday" => "воскресенье",
		"Monday" => "понедельник",
		"Tuesday" => "вторник",
		"Wednesday" => "среда",
		"Thursday" => "четверг",
		"Friday" => "пятница",
		"Saturday" => "суббота",

		"Sun" => "вос.",
		"Mon" => "пон.",
		"Tue" => "вт.",
		"Wed" => "ср.",
		"Thu" => "чет.",
		"Fri" => "пят.",
		"Sat" => "суб.",

		"th" => "",
		"st" => "",
		"nd" => "",
		"rd" => ""
	);
	return strtr($tdate, $treplace);
}

add_filter('get_post_time', 'russian_date');
add_filter('get_post_modified_time', 'russian_date');
add_filter('get_the_modified_time', 'russian_date');
add_filter('get_the_modified_date', 'russian_date');
add_filter('get_comment_date', 'russian_date');
add_filter('get_comment_time', 'russian_date');
add_filter('get_the_date', 'russian_date');
add_filter('get_the_time', 'russian_date');