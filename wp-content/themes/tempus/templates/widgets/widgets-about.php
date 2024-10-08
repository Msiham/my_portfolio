<?php
/**
 * Widgets template part
 */

$about_style = ot_get_option('about_style');
$about_picture = ot_get_option('about_picture');
$about_URL = ot_get_option('about_URL');
$about_color = (ot_get_option('about_color')) ? 'style="color:' . esc_attr(ot_get_option('about_color')) . ';"' : ''; ?>

<?php if ( $about_color ) {
  tempus_about_color();
} ?>

<div class="about-me wow fadeIn <?php echo esc_attr($about_style); ?> <?php if ( 'text-right' == $about_style || 'text-left' == $about_style ) { echo 'container'; } ?>">

	<?php if ( 'text-right' == $about_style || 'text-left' == $about_style ) { ?>

		<div class="about-picture">

		  <div class="about-picture-inner" style="background-image:url(<?php echo esc_url($about_picture); ?>);"></div>

	<?php } else { ?>

		<div class="about-picture" style="background-image:url(<?php echo esc_url($about_picture); ?>);">

	<?php } ?>

	    <div class="about-info">

	      <h2 <?php echo $about_color; ?>><?php echo esc_attr(ot_get_option('about_title')); ?></h2>

	      <p <?php echo $about_color; ?>><?php echo wpautop(ot_get_option('about_text')); ?></p>

				<?php if ($about_URL) { ?>

	      	<a href="<?php echo esc_url($about_URL); ?>" class="contact-btn" <?php echo $about_color; ?>><?php echo esc_attr(ot_get_option('about_URL_text')); ?></a>

				<?php } ?>

	    </div>

      <style>
        .about-info p {
          color: <?php echo esc_attr(ot_get_option('about_color')); ?>
        }
      </style>

		</div>

</div>
