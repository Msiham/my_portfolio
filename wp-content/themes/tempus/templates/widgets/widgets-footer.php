<?php
/**
 * Widgets template part
 */
?>

<?php if ( is_active_sidebar('tempus_footer_sidebar') ) : ?>
	<div class="sixteen columns">
		<?php dynamic_sidebar('tempus_footer_sidebar'); ?>
	</div>
<?php endif; ?>
