<?php
/**
 * Search form
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php echo __( 'Search on site', 'rko' );?>&hellip;" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo __( 'Search on site', 'rko' );?>" />
	</label>
	<button type="submit" class="search-submit"><?php echo ea_icon( array( 'icon' => 'search', 'title' => 'Найти' ) );?></button>
</form>