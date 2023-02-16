<?php
/**
 * Customize comments
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
 **/

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function rko_comment_text($args)
{
  $args['title_reply'] = __('Leave A Reply', 'rko');
  $args['label_submit'] = __('Post Comment', 'rko');
  $args['comment_notes_before'] = '';
  $args['comment_notes_after'] = '';
  $args['title_reply_before'] =
    '<div id="reply-title" class="h3 comment-reply-title">';
  $args['title_reply_after'] = '</div>';
  return $args;
}
add_filter('comment_form_defaults', 'rko_comment_text');

/**
 * Удаляет поле "Сайт" из формы комментирования для незарегистрированных пользователей.
 *
 */
function rko_comment_form_default_add_my_fields($fields)
{
  unset($fields['url']);

  return $fields;
}
add_filter(
  'comment_form_default_fields',
  'rko_comment_form_default_add_my_fields'
);

/**
 * Modify the author says text in comments
 *
 */
function ly_comment_author_says_text()
{
  return '';
}
add_filter('comment_author_says_text', 'ly_comment_author_says_text');

/**
 * Modify comments title text in comments
 *
 */
function ly_genesis_title_comments()
{
  $title = '<div class="h3">' . __('Comments', 'rko') . '</div>';
  return $title;
}
add_filter( 'genesis_title_comments', 'ly_genesis_title_comments' );

/**
 * Кнопка отблагодарить со ссылкой на донат
 */
function comment_reply_link_args_filter( $args, $comment ) {

	$comment_user = get_user_by( 'email', $comment->comment_author_email );

	if ( user_can( $comment_user, 'manage_options' ) ) {
		$thanks_url = $GLOBALS['rko']['thanks']['url'];
		$thanks_link = '<a class="comment-donate-link" href="' . $thanks_url . '" rel="nofollow" target="_blank">Отблагодарить</a>';

		$args['after'] = $thanks_link . $args['after'];
	}

	return $args;
}
add_filter( 'comment_reply_link_args', 'comment_reply_link_args_filter', 10, 2 );
