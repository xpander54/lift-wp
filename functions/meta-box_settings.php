<?php

$prefix = 'us_';

$slider_revolution = array(0 => 'No Slider');


$header_titlebar_fileds = array (
	array(
		'name'		=> 'Title Bar',
		'id'		=> $prefix . "titlebar",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Captions and Breadcrumbs',
			'caption_only' => 'Captions only',
			'hide' => 'Hide',
		),
	),

	array(
		'name'		=> 'Small caption (shown next to Page Title)',
		'id'		=> $prefix . 'subtitle',
		'clone'		=> false,
		'type'		=> 'text',
		'std'		=> '',
//		'desc'		=> 'Small caption is shown next to Page Title',
	),
	array(
		'name'		=> 'Title Bar Color Style',
		'id'		=> $prefix . "titlebar_color",
		'type'		=> 'select',
//		'desc'		=> 'Header takes more space. Use this when you want bigger image to show as Header Background. Active Slider always expands the header.',
		'options'	=> array(
			'' => 'Default',
			'alternate' => 'Alternate',
			'primary' => 'Primary Color',
		),
	),

	array(
		'name'		=> 'Title Bar Background Image',
		'id'		=> $prefix . "titlebar_image",
		'type'		=> 'image_advanced',
		'max_file_uploads'	=> 1,

	),
	array(
		'name'		=> 'Title Bar Background Image Size',
		'id'		=> $prefix . "titlebar_image_stretch",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default',
			'stretch' => 'Stretch to 100% width',
//				'hide' => 'Hide',
		),
//			'desc'		=> 'Stretch the loaded image to 100% width',
	),

);

$footer_fields = array(

	array(
		'name'		=> 'Diplay the Subfooter Widgets',
		'id'		=> $prefix . "show_subfooter_widgets",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'yes' => 'Show',
			'no' => 'Hide',
		),
	),
	array(
		'name'		=> 'Diplay the Footer (copyright and menu)',
		'id'		=> $prefix . "show_footer",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'yes' => 'Show',
			'no' => 'Hide',
		),
	),

);

$page_common_fields = array(
	array(
		'name'		=> 'Body Background Image',
		'id'		=> $prefix . "body_background_image",
		'type'		=> 'image_advanced',
		'max_file_uploads'	=> 1,
	),
	array(
		'name'		=> 'Stretch Body Background Image',
		'id'		=> $prefix . "body_background_image_stretch",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'yes' => 'Yes',
			'no' => 'No',
		),
	),
	array(
		'name'		=> 'Body Background Repeat',
		'id'		=> $prefix . "body_background_image_repeat",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'repeat' => 'Repeat',
			'repeat-x' => 'Repeat Horizontally',
			'repeat-y' => 'Repeat Vertically',
			'no-repeat' => 'Do Not Repeat',
		),
	),
	array(
		'name'		=> 'Body Background Position',
		'id'		=> $prefix . "body_background_image_position",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'top center' => 'top center',
			'top left' => 'top left',
			'top right' => 'top right',
			'bottom center' => 'bottom center',
			'bottom left' => 'bottom left',
			'bottom right' => 'bottom right',
			'center center' => 'center center',
			'center left' => 'center left',
			'center right' => 'center right',
		),
	),
	array(
		'name'		=> 'Body Background Attachment',
		'id'		=> $prefix . "body_background_image_attachment",
		'type'		=> 'select',
		'options'	=> array(
			'' => 'Default (set at Theme Options)',
			'scroll' => 'Background scrolls along with the body',
			'fixed' => 'Background is fixed with regard to the viewport',
		),
	),
);


$meta_boxes[] = array(
	'id' => 'astra_page_portfolio_header_settings',
	'title' => 'Page Header Settings',
	'pages' => array('page', 'us_portfolio'),
	'context' => 'side',
	'priority' => 'default',

	// List of meta fields
	'fields' => $header_titlebar_fileds,
);

$meta_boxes[] = array(
	'id' => 'astra_page_main_settings',
	'title' => 'Page Settings',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array_merge(
		array (
			array(
				'before' => '<div class="meta-box-conditional meta-box-page-portfolio">',
				'after' => '</div>',
				'name' => 'Show Portfolio Filters',
				'id' => $prefix . "portfolio_filter",
				'type' => 'checkbox',
				'std' => true,
			),
			array(
				'before' => '<div class="meta-box-conditional meta-box-page-portfolio">',
				'after' => '</div>',
				'name' => 'Select Portfolio Categories',
				'id' => $prefix . "portfolio_categories",
				'type' => 'taxonomy',
				'options' => array(
					'taxonomy' => 'us_portfolio_category',
					'type' => 'checkbox_list',
				),
				'desc' => 'Optional: Choose what portfolio category you want to display on this page (If Portfolio Template chosen).<br>Note: If none is chosen, all Portfolio Categories are shown.'
			),
		),
		$page_common_fields
	),
);


$meta_boxes[] = array(
	'id' => 'client_settings',
	'title' => 'Client Settings',
	'pages' => array('us_client'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Client URL',
			'id'		=> $prefix . 'client_url',
			'type'		=> 'text',
			'std'		=> '',
		),
		array(
			'name'		=> 'Open URL in new Tab',
			'id'		=> $prefix . "client_new_tab",
			'type'		=> 'checkbox',
			'std'		=> false,
		),
	),
);


$meta_boxes[] = array(
	'id' => 'post_layout_settings',
	'title' => 'Post Settings',
	'pages' => array('post'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => $page_common_fields,
);


$meta_boxes[] = array(
	'id' => 'portfolio_layout_settings',
	'title' => 'Portfolio Project Settings',
	'pages' => array('us_portfolio'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => $page_common_fields

);

$meta_boxes[] = array(
	'id' => 'astra_common_footer_settings',
	'title' => 'Footer Settings',
	'pages' => array( 'post', 'page', 'us_portfolio'),
	'context' => 'side',
	'priority' => 'default',

	// List of meta fields
	'fields' => $footer_fields

);

function us_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'us_register_meta_boxes' );