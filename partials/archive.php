<?php
/**
 * Archive partial
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/
global $loop_image_view;
global $loop_image_size;

echo '<article class="post-summary'.$loop_image_view.'">';

	echo '<a class="entry-image-link" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . get_the_post_thumbnail( get_the_ID() , $loop_image_size ) . '</a>';
	
	echo '<p class="entry-date">';
		echo the_modified_date('j F Y');
	echo '</p>';

	echo '<h3 class="h4 entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

	the_excerpt();

echo '</article>';