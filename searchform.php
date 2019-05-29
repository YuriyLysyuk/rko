<?php
/**
 * Search form
 *
 * @package      rko
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/
?>
<div class="header-search">
	<div class="wrap">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<input type="search" class="search-field" placeholder="Найти на сайте&hellip;" value="<?php echo get_search_query(); ?>" name="s" title="Поиск по сайту">
			</label>
			<button type="submit" class="search-submit"><?php echo ea_icon(array('icon' => 'search'));?></button>
		</form>
	</div>
</div>