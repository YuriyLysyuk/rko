<?php
/**
 * Header search partial
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.3
**/
?>
<div class="header-search">
	<div class="wrap">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<input type="search" class="search-field" placeholder="Найти на сайте&hellip;" value="<?php echo get_search_query(); ?>" name="s">
			</label>
			<button type="submit" class="search-submit"><?php echo ea_icon(array('icon' => 'search'));?></button>
		</form>
	</div>
</div>