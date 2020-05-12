<?php
/**
 * Functions
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.1.0
**/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 1200;

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function rko_global_enqueues() {

	// javascript
	wp_enqueue_script( 'rko-global', get_stylesheet_directory_uri() . '/assets/js/global.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global.min.js' ), true );

	// css
	wp_dequeue_style( 'rko' );
	// wp_enqueue_style( 'rko-fonts', rko_theme_fonts_url() );
	wp_enqueue_style( 'rko-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', array(), CHILD_THEME_VERSION );

	// Move jQuery to footer
	if( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		
		// jquery из директории сайта
		// wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/assets/js/jquery-3.3.1.min.js', false, NULL, true );
		
		// jquery из cdn гугла
		// wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, NULL, true );

		// стандартный jquery wordpress
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Dequeue jQuery Migrate
	 * 
	 */
	function ea_dequeue_jquery_migrate( &$scripts ){
		if( !is_admin() ) {
			$scripts->remove( 'jquery');
			$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
		}
	}

	//  Включить, если используется стандартный jquery
	add_filter( 'wp_default_scripts', 'ea_dequeue_jquery_migrate' );
}
add_action( 'wp_enqueue_scripts', 'rko_global_enqueues' );

/**
 * Gutenberg scripts and styles
 *
 */
function rko_gutenberg_scripts() {
	// wp_enqueue_style( 'rko-fonts', rko_theme_fonts_url() );
	wp_enqueue_script( 'rko-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'rko_gutenberg_scripts' );

/**
 * Theme Fonts URL
 *
 */
// function rko_theme_fonts_url() {
// 	$font_families = apply_filters( 'rko_theme_fonts', array( 'Roboto:400,400i,700,700i' ) );
// 	$query_args = array(
// 		'family' => implode( '|', $font_families ),
// 		'subset' => 'cyrillic,cyrillic-ext',
// 	);
// 	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
// 	return esc_url_raw( $fonts_url );
// }

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function rko_setup() {

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.min.css' ) );

	// Includes
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
	//include_once( get_stylesheet_directory() . '/inc/custom-logo.php' );
  include_once( get_stylesheet_directory() . '/inc/tinymce.php' );
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/search.php' );
	include_once( get_stylesheet_directory() . '/inc/comments.php' );
	include_once( get_stylesheet_directory() . '/inc/russian_date.php' );
	//include_once( get_stylesheet_directory() . '/inc/amp.php' );
	//include_once( get_stylesheet_directory() . '/inc/display-posts.php' );
	include_once( get_stylesheet_directory() . '/inc/wpforms.php' );
	include_once( get_stylesheet_directory() . '/inc/back-to-top.php' );
	include_once( get_stylesheet_directory() . '/inc/author-box.php' );
	//include_once( get_stylesheet_directory() . '/inc/footer.php' );
	//include_once( get_stylesheet_directory() . '/inc/wp-polls.php' );
	//include_once( get_stylesheet_directory() . '/inc/wp-testme.php' );
	//include_once( get_stylesheet_directory() . '/inc/wp-postratings.php' );


	//include_once( get_stylesheet_directory() . '/inc/debug.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.min.css' );

	// Image Sizes
	// add_image_size( 'rko_featured', 400, 100, true );

	// Gutenberg
	
	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'rko' ),
			'shortName' => __( 'S', 'rko' ),
			'size'      => 12,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'rko' ),
			'shortName' => __( 'M', 'rko' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'rko' ),
			'shortName' => __( 'L', 'rko' ),
			'size'      => 22,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'rko' ),
			'slug'  => 'blue',
			'color'	=> '#59BACC',
		),
		array(
			'name'  => __( 'Green', 'rko' ),
			'slug'  => 'green',
			'color' => '#58AD69',
		),
		array(
			'name'  => __( 'Orange', 'rko' ),
			'slug'  => 'orange',
			'color' => '#FFBC49',
		),
		array(
			'name'	=> __( 'Red', 'rko' ),
			'slug'	=> 'red',
			'color'	=> '#E2574C',
		),
	) );

}
add_action( 'genesis_setup', 'rko_setup', 15 );

function rko_load_theme_textdomain() {
  load_theme_textdomain( 'rko', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'rko_load_theme_textdomain' );

/**
 * Add favicon
 *
 */
function rko_favicon() {

	// generics
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-32.png" sizes="32x32">';
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-128.png" sizes="128x128">';
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-192.png" sizes="192x192">';

	// Android
	echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-196.png" sizes="196x196">';

	// iOS
	echo '<link rel="apple-touch-icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-152.png" sizes="152x152">';
	echo '<link rel="apple-touch-icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-167.png" sizes="167x167">';
	echo '<link rel="apple-touch-icon" href="' . get_stylesheet_directory_uri() . '/assets/images/favicon-180.png" sizes="180x180">';
}
add_action( 'wp_head', 'rko_favicon' );


// РАЗОБРАТЬ

/**
 * Включаем асинхронную загрузку некоторых скриптов
 *
 */

function rko_add_async_attribute($tag, $handle) {
   // добавьте дескрипторы (названия) скриптов в массив ниже
   $scripts_to_async = array('eafl-public', 'rko-global', 'comment-reply');
   
   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async src', $tag);
      }
   }
   return $tag;
}

add_filter('script_loader_tag', 'rko_add_async_attribute', 10, 2);


/** 
 * Modify Post Info ПРОДОЛЖИТЬ ОТСЮДА! ЭТО НУЖНО ПЕРЕНЕСТИ
 *
 */
function ly_post_info_filter($post_info) {
	$author = '<span class="entry-author">';
	$author .= get_avatar( get_the_author_meta( 'email' ), 50 );
	$author .= '<span><span class="label">автор</span>';
	$author .= get_the_author();
	$author .= '</span></span>';

	$modified_time = '<span class="entry-date"><span class="label">обновлено</span>';
	$modified_time .= '[post_modified_date format="j F Y"]';
	$modified_time .= '</span>';

	$comments = '<span class="entry-comments-link"><span class="label">вопросы и ответы</span>';
	$comments .= '[post_comments zero="Нет комментариев" one="1 комментарий" more="% комментариев" hide_if_off="disabled"]';
	$comments .= '</span>';

	$post_info = $author . $modified_time . $comments;

	return $post_info;
}
add_filter('genesis_post_info', 'ly_post_info_filter');

// Выводим в качестве отрывка дискрипшен из Yoast
// Если его нет, то выводим стандартный.
add_action( 'the_excerpt', 'ly_modify_the_excerpt' );

function ly_modify_the_excerpt( $post_excerpt ) {
	if (!has_excerpt()) {
		$my_descr = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
		if ( !empty($my_descr) ) {
			return '<p>'.$my_descr.'</p>';
		}
	}
	
	return $post_excerpt;
}

// Сделаем косой стиль футера
function rko_kosoy_footer() {
	echo '<svg class="footer-angle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon fill="#212121" points="0,100 100,0 100,100"></polygon></svg>';
}

add_action('genesis_footer','rko_kosoy_footer');

// Выводим контактную форму в футере если выбран соответствующий метабокс в настройках страницы
function rko_acf_footer_form() {

	// Получаем ID формы в настройках
	$footer_form_id = get_field( 'footer_form_id' );

	// Если id формы не введен и не установлен плагин WPForms – ничего не выводить
	if (!empty($footer_form_id) && function_exists( 'wpforms' )) {
		get_template_part( 'partials/footer-contact-form' );
	}

}

add_action('genesis_before_footer','rko_acf_footer_form');	

