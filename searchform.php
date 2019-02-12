<?php
/**
 * Search form
 *
 * @package      Etidni
 * @author       Yuriy Lysyuk
 * @since        1.0.0
 * @license      GPL-2.0+
**/
?>
<div class="header-search">
	<div class="wrap">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<span class="screen-reader-text">Search for</span>
				<input type="search" class="search-field" placeholder="Поиск по сайту&hellip;" value="<?php echo get_search_query(); ?>" name="s" title="Search for">
			</label>
			<button type="submit" class="search-submit"><?php echo ea_icon(array('icon' => 'search'));?></button>
		</form>
	</div>
</div>