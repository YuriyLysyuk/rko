<?php
/**
 * Customize author box
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

add_filter( 'genesis_author_box', 'ly_author_box', 10, 6 );
/**
 * Customize Author Box
 * 
 */
function ly_author_box( $output, $context, $pattern, $gravatar, $title, $description ) {
	$output = '';

	// Обертка .author-info
	$output .= '<div class="author-info">';

	// Об авторе
	$output .= '<div class="author-box" itemprop="author" itemscope="" itemtype="https://schema.org/Person">';
	$output .= get_avatar( get_the_author_meta( 'email' ), 100 );
	$name = get_the_author();
	$output .= '<p class="h4" itemprop="name">' . $name . '</p>';
	$output .= '<p class="author-desc" itemprop="description">' . get_the_author_meta( 'description' ) . '</p>';
	$output .= '</div>';

	// Услуги автора
	$output .= '<div class="author-service">';
	$output .= '<p class="h5">Нашли ответ на свой вопрос?</p>';
	$output .= '<p>Cпросите женщин в комментариях ниже, они с радостью поделятся с вами своим опытом.</p>';
	$output .= '<hr>';
	$output .= '<p>Или задайте вопрос лично мне, я обязательно вам отвечу.</p>';
	$output .= '<p><a href="'. get_site_url() .'/consultation/" class="button button-small">Задать вопрос врачу</a></p>';	
	
	// Услуги автора
	$output .= '</div>';

	// Обертка .author-info
	$output .= '</div>';

	return $output;
}