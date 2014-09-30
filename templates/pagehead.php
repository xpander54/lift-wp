<?php
if (in_array(rwmb_meta('us_titlebar'), array('', 'caption_only'))) {
	$color_class = $background_styles = '';
	if (in_array(rwmb_meta('us_titlebar_color'), array('primary', 'alternate'))) {
		$color_class = ' color_'.rwmb_meta('us_titlebar_color');
	}
	$titlebar_image = '';
	if (rwmb_meta('us_titlebar_image') != '')
	{
		$titlebar_img_id = preg_replace('/[^\d]/', '', rwmb_meta('us_titlebar_image'));
		$titlebar_img = wp_get_attachment_image_src($titlebar_img_id, 'full');
        $titlebar_image = $titlebar_img[0];
	}
	if ($titlebar_image != '')
	{
		$background_styles =  'background-image: url('.$titlebar_image.');';

		if (rwmb_meta('us_titlebar_image_stretch') == 'stretch') {
			$background_styles .= ' background-size: cover;';
		}
	}
	?>
	<div class="l-submain for_pagehead<?php echo $color_class; ?>"<?php echo  ($background_styles != '')?' style="'.$background_styles.'"':''; ?>>
		<div class="l-submain-h g-html i-cf">
			<div class="w-pagehead">
				<h1><?php the_title(); ?></h1>
				<p><?php echo rwmb_meta('us_subtitle') ?></p>
				<?php if (rwmb_meta('us_titlebar') == '') { ?>
					<!-- breadcrums -->
					<?php us_breadcrumbs(); ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
}
