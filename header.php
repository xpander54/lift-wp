<?php global $smof_data; ?><!DOCTYPE HTML>
<html <?php language_attributes('html')?>>
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php if(@$smof_data['custom_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo @$smof_data['custom_favicon']; ?>"><?php } ?>
	<?php wp_head(); ?>
    <?php
    global $load_styles_directly;
    if (isset($load_styles_directly) AND $load_styles_directly)
    {
        get_template_part('templates/colors_css');
    }
    ?>
</head>
<?php
$body_background_styles_text = '';

$body_background_image = (@$smof_data['body_background_image'] != '')?@$smof_data['body_background_image']:'';
if (rwmb_meta('us_body_background_image') != '')
{
	$body_background_img_id = preg_replace('/[^\d]/', '', rwmb_meta('us_body_background_image'));
	$body_background_img = wp_get_attachment_image_src($body_background_img_id, 'full');
    $body_background_image = $body_background_img[0];

}

if ($body_background_image != '')
{
	$body_background_styles = array( 'background-image' => 'url('.$body_background_image.')');

	$body_background_image_stretch = (@$smof_data['body_background_image_stretch'] == 1)?TRUE:FALSE;
	if (rwmb_meta('us_body_background_image_stretch') == 'yes') {
		$body_background_image_stretch = TRUE;
	} elseif (rwmb_meta('us_body_background_image_stretch') == 'no') {
		$body_background_image_stretch = FALSE;
	}
	if ($body_background_image_stretch) {
		$body_background_styles['background-size'] = 'cover';
	}

	if (@$smof_data['body_background_image_repeat'] != '') {
		$baclgroundRepeatCss = array(
			'Repeat' => 'repeat',
			'Repeat Horizontally' => 'repeat-x',
			'Repeat Vertically' => 'repeat-y',
			'Do Not Repeat' => 'no-repeat',
		);
		$body_background_styles['background-repeat'] = $baclgroundRepeatCss[@$smof_data['body_background_image_repeat']];
	}
	if (rwmb_meta('us_body_background_image_repeat') != '') {
		$body_background_styles['background-repeat'] = rwmb_meta('us_body_background_image_repeat');
	}

	if (@$smof_data['body_background_image_position'] != '') {
		$body_background_styles['background-position'] = @$smof_data['body_background_image_position'];
	}
	if (rwmb_meta('us_body_background_image_position') != '') {
		$body_background_styles['background-position'] = rwmb_meta('us_body_background_image_position');
	}

	if (@$smof_data['body_background_image_attachment'] == 'Background is fixed with regard to the viewport') {

		$body_background_styles['background-attachment'] = 'fixed';
	}
	if (rwmb_meta('us_body_background_image_attachment') != '') {
		$body_background_styles['background-attachment'] = rwmb_meta('us_body_background_image_attachment');
	}

	foreach ($body_background_styles as $body_background_style => $body_background_style_val)
	{
		$body_background_styles_text .= $body_background_style.': '.$body_background_style_val.';';
	}
}
?>
<body <?php body_class('l-body'); ?> <?php echo  ($body_background_styles_text != '')?' style="'.$body_background_styles_text.'"':''; ?>>

<?php
if (defined('IS_FULLWIDTH') AND IS_FULLWIDTH)
{
	$sidebar_position_class = 'col_cont';
}
elseif (defined('IS_POST') AND IS_POST)
{
	$sidebar_position_class = (@$smof_data['post_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
elseif (defined('IS_BLOG') AND IS_BLOG)
{
	$sidebar_position_class = (@$smof_data['blog_sidebar_pos'] == 'Right')?'col_contside':'col_sidecont';
}
else
{
	$sidebar_position_class = (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right')?'col_contside':'col_sidecont';
}
$layout_class = (@$smof_data['layout'] == 'Wide')?'type_wide':'type_boxed';

$extended_header_class = '';
if (@$smof_data['header_is_extended'] == 1) {
	$extended_header_class = ' headertype_extended';
}

$header_position_class = '';
if (@$smof_data['header_is_sticky'] == 1) {
	$header_position_class = ' headerpos_fixed';
}
?>
<!-- CANVAS -->
<div class="l-canvas <?php echo $layout_class.' '.$sidebar_position_class.$extended_header_class.$header_position_class; ?>">
	<div class="l-canvas-h">

		<!-- HEADER -->
		<div class="l-header type_fixed">
			<div class="l-header-h">

				<div class="l-subheader at_top">
					<div class="l-subheader-h i-cf">
					<?php if (@$smof_data['header_is_extended'] == 1) { ?>
					<?php if (@$smof_data['header_phone'] != '' OR @$smof_data['header_email'] != '') { ?>
						<div class="w-contacts">
							<div class="w-contacts-h">
								<div class="w-contacts-list">
								<?php if (@$smof_data['header_phone'] != '') { ?>
									<div class="w-contacts-item for_phone">
										<i class="fa fa-phone"></i>
										<span class="w-contacts-item-name"><?php echo __('Phone', 'us'); ?>:</span>
										<span class="w-contacts-item-value"><?php echo $smof_data['header_phone']; ?></span>
									</div>
								<?php } ?>
								<?php if (@$smof_data['header_email'] != '') { ?>
									<div class="w-contacts-item for_email">
										<i class="fa fa-envelope"></i>
										<span class="w-contacts-item-name"><?php echo __('Email', 'us'); ?>:</span>
										<span class="w-contacts-item-value"><a href="mailto:<?php echo $smof_data['header_email']; ?>"><?php echo $smof_data['header_email']; ?></a></span>
									</div>
								<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php if ($smof_data['header_show_language']) { get_template_part('templates/lang_switcher'); } ?>
						<div class="w-socials">
							<div class="w-socials-h">
								<div class="w-socials-list">
								<?php
								$socials = array (
									'email' => 'Email',
									'facebook' => 'Facebook',
									'twitter' => 'Twitter',
									'google' => 'Google+',
									'linkedin' => 'LinkedIn',
									'youtube' => 'YouTube',
									'vimeo' => 'Vimeo',
									'flickr' => 'Flickr',
									'instagram' => 'Instagram',
									'behance' => 'Behance',
									'pinterest' => 'Pinterest',
									'skype' => 'Skype',
									'tumblr' => 'Tumblr',
									'dribbble' => 'Dribbble',
									'vk' => 'Vkontakte',
									'rss' => 'RSS',
								);

								$output = '';
								foreach ($socials as $social_key => $social)
								{
									if (@$smof_data['header_social_'.$social_key] != '')
									{
										if ($social_key == 'email')
										{
											$output .= '<div class="w-socials-item '.$social_key.'">
														<a class="w-socials-item-link" href="mailto:'.$smof_data['header_social_'.$social_key].'">
															<i class="fa fa-envelope"></i>
														</a>
														<div class="w-socials-item-popup">
															<div class="w-socials-item-popup-h">
																<span class="w-socials-item-popup-text">'.$social.'</span>
															</div>
														</div>
														</div>';

										}
										elseif ($social_key == 'google')
										{
											$output .= '<div class="w-socials-item gplus">
														<a class="w-socials-item-link" target="_blank" href="'.$smof_data['header_social_'.$social_key].'">
															<i class="fa fa-google-plus"></i>
														</a>
														<div class="w-socials-item-popup">
															<div class="w-socials-item-popup-h">
																<span class="w-socials-item-popup-text">'.$social.'</span>
															</div>
														</div>
														</div>';

										}
										elseif ($social_key == 'youtube')
										{
											$output .= '<div class="w-socials-item '.$social_key.'">
														<a class="w-socials-item-link" target="_blank" href="'.$smof_data['header_social_'.$social_key].'">
															<i class="fa fa-youtube-play"></i>
														</a>
														<div class="w-socials-item-popup">
															<div class="w-socials-item-popup-h">
																<span class="w-socials-item-popup-text">'.$social.'</span>
															</div>
														</div>
														</div>';

										}
										elseif ($social_key == 'vimeo')
										{
											$output .= '<div class="w-socials-item '.$social_key.'">
														<a class="w-socials-item-link" target="_blank" href="'.$smof_data['header_social_'.$social_key].'">
															<i class="fa fa-vimeo-square"></i>
														</a>
														<div class="w-socials-item-popup">
															<div class="w-socials-item-popup-h">
																<span class="w-socials-item-popup-text">'.$social.'</span>
															</div>
														</div>
														</div>';

										}
										else
										{
											$output .= '<div class="w-socials-item '.$social_key.'">
														<a class="w-socials-item-link" target="_blank" href="'.$smof_data['header_social_'.$social_key].'">
															<i class="fa fa-'.$social_key.'"></i>
														</a>
														<div class="w-socials-item-popup">
															<div class="w-socials-item-popup-h">
																<span class="w-socials-item-popup-text">'.$social.'</span>
															</div>
														</div>
														</div>';
										}

									}
								}

								echo $output;
								?>
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
				<div class="l-subheader at_middle">
					<div class="l-subheader-h i-widgets i-cf">

						<div class="w-logo <?php if (@$smof_data['logo_as_text'] == 1) { echo ' with_title'; } ?>">
							<a class="w-logo-link" href="<?php if (function_exists('icl_get_home_url')) echo icl_get_home_url(); else echo esc_url(home_url('/')); ?>">
								<img class="w-logo-img" src="<?php echo (@$smof_data['custom_logo'])?@$smof_data['custom_logo']:get_template_directory_uri().'/img/logo_3.png';?>"  alt="<?php bloginfo('name'); ?>">
								<span class="w-logo-title"><?php if (@$smof_data['logo_text'] != '') { echo @$smof_data['logo_text']; } else { bloginfo('name'); } ?></span>
							</a>
						</div>

						<?php if (@$smof_data['header_show_search']) { ?>
						<div class="w-search submit_inside">
							<div class="w-search-h">
								<a class="w-search-show" href="javascript:void(0)"><i class="fa fa-search"></i></a>
								<form class="w-search-form show_hidden" action="<?php echo home_url( '/' ); ?>">
									<?php if (@ICL_LANGUAGE_CODE != '' AND @ICL_LANGUAGE_CODE != 'ICL_LANGUAGE_CODE') { ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"><?php } ?>
									<div class="w-search-input">
											<input type="text" value="" name="s" placeholder="<?php echo __( 'enter the query', 'us' ); ?>"/>
									</div>
									<div class="w-search-submit">
										<input type="submit" id="searchsubmit"  value="<?php echo __( 'Search', 'us' ); ?>" />
										<i class="fa fa-search"></i>
									</div>
									<a class="w-search-close" href="javascript:void(0)" title="Close search"> &#10005; </a>
								</form>
							</div>
						</div>
						<?php } ?>

						<!-- NAV -->
						<nav class="w-nav">
							<div class="w-nav-h">
								<div class="w-nav-control">
									<i class="fa fa-bars"></i>
								</div>
								<div class="w-nav-list layout_hor width_auto float_right level_1">
									<?php wp_nav_menu(
										array(
											'theme_location' => 'astra_main_menu',
											'container'       => 'div',
											'container_class' => 'w-nav-list-h',
											'walker' => new Walker_Nav_Menu_us(),
											'items_wrap' => '%3$s',
											'fallback_cb' => false,

										));
									?>
								</div>
							</div>
						</nav><!-- /NAV -->

					</div>
				</div>

			</div>
		</div>
		<!-- /HEADER -->

		<!-- MAIN -->
		<div class="l-main">
			<div class="l-main-h">



