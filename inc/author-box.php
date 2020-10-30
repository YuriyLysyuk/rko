<?php
/**
 * Customize author box
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.3.13
 **/

// add_filter( 'genesis_author_box', 'ly_author_box', 10, 6 );
/**
 * Customize Author Box
 * @link http://www.billerickson.net/code/customize-author-box
 *
 */
function ly_author_box(
  $output,
  $context,
  $pattern,
  $gravatar,
  $title,
  $description
) {
  $output = '';

  // Обертка .author-info
  $output .= '<div class="author-info">';

  // Об авторе
  $output .= '<div class="author-box">';
  $output .= get_avatar(get_the_author_meta('email'), 100);
  $name = get_the_author();
  $output .= '<p class="h5">' . $name . '</p>';
  $output .=
    '<p class="author-desc">' . get_the_author_meta('description') . '</p>';
  $output .= '</div>';

  // Услуги автора
  //$output .= '<div class="author-service">';
  //$output .= '<p class="h5">Нашли ответ на свой вопрос?</p>';
  //$output .= '<p>Узнайте мнение женщин в комментариях ниже, они с радостью поделятся с вами своим опытом.</p>';
  //$output .= '<hr>';
  //$output .= '<p>Или задайте вопрос лично мне, я обязательно вам отвечу.</p>';
  //$output .= '<p><a href="'. get_site_url() .'/consultation/" class="button button-small">Задать вопрос врачу</a></p>';

  // Услуги автора
  //$output .= '</div>';

  // Обертка .author-info
  $output .= '</div>';

  return $output;
}

/**
 * Add Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param object $user
 */
function ly_custom_avatar_field($user)
{
  ?>
	<h2>Индивидуальный аватар</h2>
	<span class="description">Введи относительный URL для аватара, размещенного в папке Uploads, "/" в начале обязателен. Например: "/avatar.jpg". Он перепишет Gravatar, или покажет этот аватар если Граватар отключен. <br /><strong>Аватар должен быть 200x200 пикселей.</strong></span>
	<table class="form-table">
	<tr>
	<th scope="row"><label for="ly_custom_avatar">URL в папке Uploads:</label></th>
	<td>
	<input type="text" name="ly_custom_avatar" id="ly_custom_avatar" value="<?php echo esc_url_raw(
   get_the_author_meta('ly_custom_avatar', $user->ID)
 ); ?>" /><br />
	</td>
	</tr>
	</table>
	<?php
}
add_action('show_user_profile', 'ly_custom_avatar_field');
add_action('edit_user_profile', 'ly_custom_avatar_field');

/**
 * Save Custom Avatar Field
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 * @param int $user_id
 */
function ly_save_custom_avatar_field($user_id)
{
  if (current_user_can('edit_user', $user_id)) {
    update_usermeta(
      $user_id,
      'ly_custom_avatar',
      esc_url_raw($_POST['ly_custom_avatar'])
    );
  }
}
add_action('personal_options_update', 'ly_save_custom_avatar_field');
add_action('edit_user_profile_update', 'ly_save_custom_avatar_field');

/**
 * Use Custom Avatar if Provided
 * @author Bill Erickson
 * @link http://www.billerickson.net/wordpress-custom-avatar/
 *
 */
function ly_gravatar_filter($avatar, $id_or_email, $size, $default, $alt)
{
  // If provided an email and it doesn't exist as WP user, return avatar since there can't be a custom avatar
  $email = is_object($id_or_email)
    ? $id_or_email->comment_author_email
    : $id_or_email;
  if (is_email($email) && !email_exists($email)) {
    return $avatar;
  }

  // Проверяем, аноним ли это, если да то аватарку не показываем
  //if ( (isset( $id_or_email->comment_ID )) && ($id_or_email->user_id == 0)) return '';

  //$custom_avatar = get_the_author_meta('ly_custom_avatar', $id_or_email->user_id);
  $custom_avatar = get_the_author_meta('ly_custom_avatar');

  // Достаем URL папки загрузки
  $upload_dir = wp_get_upload_dir();

  if ($custom_avatar) {
    $return =
      '<img src="' .
      $upload_dir['baseurl'] .
      $custom_avatar .
      '" width="' .
      $size .
      '" height="' .
      $size .
      '" alt="' .
      $alt .
      '" class="avatar" />';
  } elseif ($avatar) {
    $return = $avatar;
  } else {
    $return = 'ololo';
  }
  return $return;
}
add_filter('get_avatar', 'ly_gravatar_filter', 10, 5);

/*
 * Yoast SEO в разметке автора для получения URL аватара использует get_avatar_url()
 * Эта функция добавляет поддержку кастомного аватара
 *
 */
function custom_modify_get_avatar($args, $id_or_email)
{
  $customAvatar = get_the_author_meta(
    'ly_custom_avatar',
    $id_or_email->user_id
  );

  // Достаем URL папки загрузки
  $uploadDir = wp_get_upload_dir();

  if ($customAvatar) {
    $customAvatarUrl = $uploadDir['baseurl'] . $customAvatar;
    if (!empty($customAvatarUrl)) {
      $args['url'] = $customAvatarUrl;
    }
  }
  return $args;
}
add_filter('pre_get_avatar_data', 'custom_modify_get_avatar', 10, 2);
