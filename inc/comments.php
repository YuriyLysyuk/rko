<?php
/**
 * Customize comments
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function etidni_comment_text( $args ) {
	$args['title_reply_before']   = '<p id="reply-title" class="comment-reply-title h3">';
	$args['title_reply']          = 'Ответить';
	$args['title_reply_after']    = '</p>';
	$args['label_submit']         = 'Отправить комментарий';
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';
	$args['fields']['url']  = '';
	return $args;
}
add_filter( 'comment_form_defaults', 'etidni_comment_text' );

//* Modify the author says text in comments
add_filter( 'comment_author_says_text', 'ly_comment_author_says_text' );

function ly_comment_author_says_text() {
	return '';
}

// Modify comments title text in comments
add_filter( 'genesis_title_comments', 'ly_genesis_title_comments' );

function ly_genesis_title_comments() {
	$title = '<p class="h3">Комментарии</p>';
	return $title;
}