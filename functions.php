<?php
/**
 * Functions
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 1280;

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function etidni_setup() {

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/dist/css/main.min.css' ) );

	// Includes
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
  include_once( get_stylesheet_directory() . '/inc/tinymce.php' );
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/search.php' );
	include_once( get_stylesheet_directory() . '/inc/footer.php' );
	include_once( get_stylesheet_directory() . '/inc/wp-polls.php' );
	include_once( get_stylesheet_directory() . '/inc/wp-testme.php' );
	include_once( get_stylesheet_directory() . '/inc/wp-postratings.php' );
	include_once( get_stylesheet_directory() . '/inc/author-box.php' );
	include_once( get_stylesheet_directory() . '/inc/comments.php' );
	include_once( get_stylesheet_directory() . '/inc/russian_date.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'dist/css/editor-style.css' );

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
			'name'      => __( 'small', 'Etidni' ),
			'shortName' => __( 'S', 'Etidni' ),
			'size'      => 12,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'Etidni' ),
			'shortName' => __( 'M', 'Etidni' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'Etidni' ),
			'shortName' => __( 'L', 'Etidni' ),
			'size'      => 20,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'Etidni' ),
			'slug'  => 'blue',
			'color'	=> '#4374c4',
		),
		array(
			'name'  => __( 'Green', 'Etidni' ),
			'slug'  => 'green',
			'color' => '#00c851',
		),
		array(
			'name'  => __( 'Orange', 'Etidni' ),
			'slug'  => 'orange',
			'color' => '#fb3',
		),
		array(
			'name'	=> __( 'Red', 'Etidni' ),
			'slug'	=> 'red',
			'color'	=> '#ff3547',
		),
		array(
			'name'	=> __( 'White', 'Etidni' ),
			'slug'	=> 'white',
			'color'	=> '#fff',
		),
		array(
			'name'	=> __( 'Grey', 'Etidni' ),
			'slug'	=> 'grey',
			'color'	=> '#333',
		),
		array(
			'name'	=> __( 'Black', 'Etidni' ),
			'slug'	=> 'black',
			'color'	=> '#000',
		),
	) );

}
add_action( 'genesis_setup', 'etidni_setup', 15 );

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function etidni_global_enqueues() {

	// javascript
	wp_enqueue_script( 'etidni-script', get_stylesheet_directory_uri() . '/dist/js/scripts.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/dist/js/scripts.min.js' ), true );

	// убираем стили Gutenberg
	// wp_dequeue_style( 'wp-block-library' );

	// css
  wp_dequeue_style( 'child-theme' );
  wp_enqueue_style( 'etidni-style', get_stylesheet_directory_uri() . '/dist/css/main.min.css', array(), CHILD_THEME_VERSION );

	// Move jQuery to footer
	if( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		// wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/dist/js/jquery-3.3.1.min.js', false, NULL, true );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, NULL, true );
		wp_enqueue_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'etidni_global_enqueues' );

/**
 * Включаем асинхронную загрузку некоторых скриптов
 *
 */
function etidni_add_async_attribute($tag, $handle) {
   // добавьте дескрипторы (названия) скриптов в массив ниже
   $scripts_to_async = array('etidni-script');
   
   foreach($scripts_to_async as $async_script) {
      if ($async_script === $handle) {
         return str_replace(' src', ' async src', $tag);
      }
   }
   return $tag;
}

add_filter('script_loader_tag', 'etidni_add_async_attribute', 10, 2);

/**
 * Template Hierarchy
 *
 */
function etidni_template_hierarchy( $template ) {
	if( is_home() || is_search() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'etidni_template_hierarchy' );

/**
 * Add favicon
 *
 */
function ly_favicon() {
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/dist/images/favicon-152.png">';
	echo '<!--[if IE]><link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/dist/images/favicon.ico"><![endif]-->';	
}
add_action( 'wp_head', 'ly_favicon' );
