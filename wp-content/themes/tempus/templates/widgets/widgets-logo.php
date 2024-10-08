<?php
/**
 * Logo template part
 */
?>

<?php	if ( function_exists('ot_get_option') && ot_get_option('logo_upload') ) { ?>
	<a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr(bloginfo('name')); ?>" class="logo-image" rel="home">
		<img src="<?php echo esc_url( ot_get_option('logo_upload') ); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" class="logo-image" />
	</a>
<?php } else { ?>

	<?php if ( function_exists('ot_get_option') && ot_get_option('logo_text') ) { ?>
		<h1 class="logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php echo esc_attr( ot_get_option('logo_text', 'Tempus') ); ?></a>
		</h1>
	<?php } elseif ( !function_exists('ot_get_option') || function_exists('ot_get_option') && ot_get_option('logo_text') == '' ) { ?>
		<h1 class="logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php esc_attr_e('Tempus', 'tempus' ); ?></a>
		</h1>
	<?php }

} ?>
