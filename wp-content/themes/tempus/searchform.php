<?php
/**
 * The template for search form
 */
?>

<div class="search-form search-side">
	<form id="searchform" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<input class="search-input" placeholder="<?php esc_attr_e('Search...', 'tempus'); ?>" type="text" value="" name="s" id="s" />
		<input class="search-submit" type="submit" value="" />
	</form>
</div>
