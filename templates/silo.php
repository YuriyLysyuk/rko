<?php
/**
 * Template Name: Silo
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Full width layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// На главной странице
if (is_front_page()) {
	
	// Remove post title area
	remove_action( 'genesis_entry_header', 'genesis_do_post_title'                 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open',  5  );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	/**
	 * Use h1 for site title
	 *
	 */
	function ea_h1_for_site_title( $wrap ) {
		return 'h1';
	}
	add_filter( 'genesis_site_title_wrap', 'ea_h1_for_site_title' );

	/**
	 * Добавляем блок поиска на главную страницу
	 *
	 */
	add_action( 'genesis_after_header', 'ly_search_block' );

	function ly_search_block() {

		$search_form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( "/" ) ) .'">';
		$search_form.= '<label>';
		$search_form.= '<input type="search" class="search-field" placeholder="Что вас беспокоит?" value="'. get_search_query() .'" name="s" title="Что вас беспокоит?">';
		$search_form.= '</label>';
		$search_form.= '<button type="submit" class="search-submit">'. ea_icon(array('icon' => 'search')) .'</button>';
		$search_form.= '</form>';

		$ask_question = '<p>или</p>';
		$ask_question.= '<p><a href="'. esc_url( home_url( "/" ).'consultation/' ). '" class="button button-small">Задайте личный вопрос врачу</a></p>';

		$title = sprintf( '<header class="main-page-search"><div class="wrap"><p class="h1">%s</p><p>%s</p>%s%s</div></header>', 'Все о месячных и менструальном цикле', 'Мы собрали в одном месте популярные ответы на вопросы о менструации и женском цикле.<br>Попробуйте найти готовый ответ.', $search_form, $ask_question );

		echo $title;

	}

	/**
	 * Показать 12 последних постов на главной странице 
	 * (использую так как на старом шаблоне было 12 ссылок на последние публикации)
	 *
	 */
	add_action( 'genesis_after_entry', 'ly_display_last_posts_on_front_page' );

	function ly_display_last_posts_on_front_page() {
	  $loop = new WP_Query( array(
	    'post_type' 			=> 'post',
	    'post_status'			=> 'publish',
	    'posts_per_page'	=> 11,
	    'order' 					=> 'DESC',
	    'orderby' 				=> 'date',
	  ) );
	  
	  if( $loop->have_posts() ): 
  		global $loop_counter;
			global $loop_image_view;
			global $loop_image_size;

			$loop_counter = 0;
			$loop_image_view = '';
			$loop_image_size = '';
	    echo '<h2 class="header">Популярные вопросы</h2>';
	    echo '';
	    while( $loop->have_posts() ): $loop->the_post();

				// Классы для grid
				if ($loop_counter < 3) {
					$loop_image_view = ' large';
					$loop_image_size = 'medium';

				} else {
					$loop_image_view = ' image-left';
					$loop_image_size = 'thumbnail';
				}
	      get_template_part( 'partials/archive' );
	      $loop_counter++;
	    endwhile;
	    echo '';
	  endif;
	  wp_reset_postdata();
	}

} // На главной странице

/**
	* Вывод последних пяти дочерних опубликованных страниц для текущей
	*
	*/
	// add_action( 'genesis_before_footer', 'ly_recent_page' );

	function ly_recent_page() {
		global $post;

		$args = array(
			'sort_order'   => 'DESC',
			'sort_column'  => 'ID',
			'hierarchical' => 0,
			'meta_key'     => '_wp_page_template',
			'meta_value'   => 'templates/silo.php',
			'child_of'     => get_the_ID(),
			'number'			 => 5,
			'post_type'    => 'page',
			'post_status'  => 'publish',
		); 

		// У главной страницы нет дочерних, поэтому обнулим параметр запроса
		if (is_front_page()) {
			$args['child_of'] = 0;
		}

		$pages = get_pages( $args );
		
		foreach( $pages as $post ){
			setup_postdata( $post );
			get_template_part( 'partials/archive' );
		} 

		wp_reset_postdata();
	}

genesis();