<?php

$post_categories = array('' => 'All');
if (function_exists('get_categories')) {
    $post_categories_raw = get_categories("hierarchical=0");
    foreach ($post_categories_raw as $post_category_raw)
    {
        $post_categories[$post_category_raw->slug] = $post_category_raw->name;
    }
}
$portfolio_categories = array('' => 'All');
if (function_exists('get_categories')) {
    $portfolio_categories_raw = get_categories("taxonomy=us_portfolio_category&hierarchical=0");
    foreach ($portfolio_categories_raw as $portfolio_category_raw)
    {
        $portfolio_categories[$portfolio_category_raw->slug] = $portfolio_category_raw->name;
    }
}
/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'text' => array(
			'std' => 'Click me',
			'type' => 'text',
			'label' => 'Button Label',
			'desc' => '',
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button Link',
			'desc' => 'Add the button\'s url eg http://example.com'
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button Icon (optional)',
			'desc' => 'FontAwesome Icon name. <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of icons</a>',
		),
		'align' => array(
			'type' => 'select',
			'label' => 'Button Position',
			'desc' => '',
			'options' => array(
				'left' => 'Align left',
				'center' => 'Align center',
				'right' => 'Align right',
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => 'Button Color',
			'desc' => '',
			'options' => array(
				'default' => 'Default (theme color)',
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'outline' => 'Outlined with Transparent Background',
				'pink' => 'Pink',
				'blue' => 'Blue',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'purple' => 'Purple',
				'red' => 'Red',
				'lime' => 'Lime',
				'navy' => 'Navy',
				'cream' => 'Cream',
				'brown' => 'Brown',
				'midnight' => 'Midnight',
				'teal' => 'Teal',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Button Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
		'target' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Button Link Target',
			'desc' => '',
			'options' => array(
				'_self' => 'Same window',
				'_blank' => 'New window',
			)
		),
	),
	'shortcode' => '[vc_button url="{{url}}" text="{{text}}" size="{{size}}" align="{{align}}" type="{{type}}" icon="{{icon}}"  color="{{color}}" target="{{target}}"]',
	'popup_title' => 'Insert Button shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Alert Type',
			'desc' => 'Select the alert\'s type',
			'options' => array(
				'info' => 'Notification (grey)',
				'attention' => 'Attention (yellow)',
				'success' => 'Success (green)',
				'error' => 'Error (red)',
			)
		),
		'content' => array(
			'std' => 'Alert Text',
			'type' => 'textarea',
			'label' => 'Alert Text',
			'desc' => 'Add the alert\'s text',
		)
		
	),
	'shortcode' => '[vc_message type="{{type}}"] {{content}} [/vc_message]',
	'popup_title' => 'Insert Message Box shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['tabs'] = array(
    'params' => array(
		'timeline' => array(
			'std' => '0',
			'type' => 'checkbox',
			'label' => 'Act as Timeline',
			'checkbox_text' => 'Change look and feel into Timeline',
			'desc' => '',
		),
	),
    'no_preview' => true,
    'shortcode' => '[vc_tabs] {{child_shortcode}} <br>[/vc_tabs]',
    'popup_title' => 'Insert Tabs shortcode',
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => 'Tab Title',
                'desc' => 'Enter the tab title here (better keep it short)',
            ),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Tab Icon (optional)',
				'desc' => 'FontAwesome Icon name. <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of icons</a>',
			),
            'content' => array(
                'std' => 'Tab Content. You can use other shortcodes here',
                'type' => 'textarea',
                'label' => 'Tab Content',
                'desc' => ''
            ),
        ),
        'shortcode' => '<br>[vc_tab title="{{title}}" icon="{{icon}}"] {{content}} [/vc_tab]',
        'clone_button' => 'Add Tab'
    )
);


/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['accordion'] = array(
    'params' => array(
		'toggle' => array(
			'std' => '0',
			'type' => 'checkbox',
			'label' => 'Act as Toggles',
			'checkbox_text' => 'Allow several sections be open at the same time',
			'desc' => '',
		),
	),
    'no_preview' => true,
    'shortcode' => '[vc_accordion] {{child_shortcode}} [/vc_accordion]',
    'popup_title' => 'Insert Accordion shortcode',

    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => 'Tab Title',
                'desc' => 'Enter the tab title here (better keep it short)',
            ),
			'icon' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Tab Icon (optional)',
				'desc' => '',
			),
            'content' => array(
                'std' => 'Tab Content. You can use other shortcodes here',
                'type' => 'textarea',
                'label' => 'Tab Content',
                'desc' => 'FontAwesome Icon name. <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of icons</a>'
            ),
        ),
        'shortcode' => '<br>[vc_accordion_tab title="{{title}}" icon="{{icon}}"] {{content}} [/vc_accordion_tab]',
        'clone_button' => 'Add Accordion'
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Video Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['video'] = array(
	'no_preview' => true,
	'params' => array(
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Video link',
			'desc' => 'Link to the video. More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>',
		),
		'ratio' => array(
			'type' => 'select',
			'label' => 'Ratio',
			'desc' => '',
			'options' => array(
				'16-9' => '16x9',
				'4-3' => '4x3',
				'3-2' => '3x2',
				'1-1' => '1x1',
			)
		),

	),
	'shortcode' => '[vc_video link="{{link}}" ratio="{{ratio}}"]',
	'popup_title' => 'Insert Video shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Contact Form Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['contact_form'] = array(
	'no_preview' => true,
	'params' => array(
		'form_email' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Contact Form Reciever Email',
			'desc' => 'Contact requests will be sent to this Email.',
		),
		'form_name_field' => array(
			'type' => 'select',
			'label' => 'Contact Form Name Field State',
			'desc' => '',
			'options' => array(
				'required' => 'Shown, required',
				'show' => 'Shown, not required',
				'hide' => 'Hidden',
			)
		),
		'form_email_field' => array(
			'type' => 'select',
			'label' => 'Contact Form Email Field State',
			'desc' => '',
			'options' => array(
				'required' => 'Shown, required',
				'show' => 'Shown, not required',
				'hide' => 'Hidden',
			)
		),
		'form_phone_field' => array(
			'type' => 'select',
			'label' => 'Contact Form Phone Field State',
			'desc' => '',
			'options' => array(
				'required' => 'Shown, required',
				'show' => 'Shown, not required',
				'hide' => 'Hidden',
			)
		),
		'form_captcha' => array(
			'type' => 'select',
			'label' => 'Contact Form Phone Field State',
			'desc' => '',
			'options' => array(
				'' => 'Don\'t Display Captcha',
				'show' => 'Display Captcha',
			)
		),

	),
	'shortcode' => '[vc_contact_form form_email="{{form_email}}" form_name_field="{{form_name_field}}" form_email_field="{{form_email_field}}" form_phone_field="{{form_phone_field}}"]',
	'popup_title' => 'Insert Contact Form shortcode'
);


/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['social_links'] = array(
	'no_preview' => true,
	'params' => array(
		'size' => array(
			'type' => 'select',
			'label' => 'Icons Size',
			'desc' => '',
			'options' => array(
				'normal' => 'Normal',
				'' => 'Small',
				'big' => 'Big',
			)
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Email',
			'desc' => '',
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Facebook',
			'desc' => '',
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Twitter',
			'desc' => '',
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Google+',
			'desc' => '',
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'LinkedIn',
			'desc' => '',
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'YouTube',
			'desc' => '',
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Flickr',
			'desc' => '',
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Instagram',
			'desc' => '',
		),
		'behance' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Behance',
			'desc' => '',
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Pinterest',
			'desc' => '',
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Skype',
			'desc' => '',
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Tumblr',
			'desc' => '',
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Dribbble',
			'desc' => '',
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Vkontakte',
			'desc' => '',
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'RSS',
			'desc' => '',
		),

	),
	'shortcode' => '[vc_social_links size="{{size}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" google="{{google}}" linkedin="{{linkedin}}" youtube="{{youtube}}" flickr="{{flickr}}" instagram="{{instagram}}" behance="{{behance}}" pinterest="{{pinterest}}" skype="{{skype}}" tumblr="{{tumblr}}" dribbble="{{dribbble}}" vk="{{vk}}" rss="{{rss}}"]',
	'popup_title' => 'Insert Social Links shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Contacts Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['contacts'] = array(
	'no_preview' => true,
	'params' => array(
		'address' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Address',
			'desc' => '',
		),
		'phone' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Phone number',
			'desc' => '',
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Email',
			'desc' => '',
		),
		'layout' => array(
			'type' => 'select',
			'label' => 'Layout Style',
			'desc' => '',
			'options' => array(
				'' => 'Show contact items with Text',
				'with_icons' => 'Show contact items with Icons',
			)
		),
	),
	'shortcode' => '[vc_contacts address="{{address}}" phone="{{phone}}" email="{{email}}" layout="{{layout}}"]',
	'popup_title' => 'Insert Contacts shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['member'] = array(
	'params' => array(
		'name' => array(
			'std' => 'John Doe',
			'type' => 'text',
			'label' => 'Team Member Name',
			'desc' => '',
		),
		'role' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Team Member Job Title',
			'desc' => 'E.g. CEO, Manager, etc',
		),
		'img' => array(
			'std' => '',
			'type' => 'image',
			'label' => 'Photo',
			'desc' => 'Path to member\'s photo',
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Team Member Description',
			'desc' => '',
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Facebook profile',
			'desc' => '',
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Twitter profile',
			'desc' => '',
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'LinkedIn profile',
			'desc' => '',
		),
	),
	'no_preview' => true,
	'shortcode' => '[vc_member name="{{name}}" role="{{role}}" img="{{img}}" facebook="{{facebook}}" twitter="{{twitter}}" linkedin="{{linkedin}}"] {{description}} [/vc_member]',
	'popup_title' => 'Insert Team Member shortcode',
);
/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'Separator Type',
			'desc' => '',
			'options' => array(
				'' => 'Full Width',
				'short' => 'Short',
				'invisible' => 'Invisible',
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => 'Separator Size',
			'desc' => '',
			'options' => array(
				'' => 'Medium',
				'big' => 'Big',
				'small' => 'Small',
			)
		),
		'icon' => array(
			'std' => 'star',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome Icon name. <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of icons</a>',
		),
	),
	'shortcode' => '[vc_separator type="{{type}}" size="{{size}}" icon="{{icon}}"]',
	'popup_title' => 'Insert Separator shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Icon Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['icon'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome icon name',
		),
	),
	'shortcode' => '[icon icon="{{icon}}"]',
	'popup_title' => 'Insert Icon shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	IconBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['iconbox'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'std' => 'icon_top',
			'type' => 'select',
			'label' => 'Icon Position',
			'options' => array(
				'icon_top' => 'Icon on Top',
				'icon_left' => 'Icon at Left',
			),
			'desc' => '',
		),
		'icon' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Icon',
			'desc' => 'FontAwesome icon name. <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Full list of icons</a>',
		),
		'title' => array(
			'std' => 'IconBox Title',
			'type' => 'text',
			'label' => 'IconBox Title',
			'desc' => '',
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'IconBox Content',
			'desc' => '',
		),
		'link_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Link URL',
			'desc' => 'Leave blank to hide link',
		),
		'link_text' => array(
			'std' => 'Learn More',
			'type' => 'text',
			'label' => 'Link Text',
			'desc' => '',
		),
		'target' => array(
			'std' => '',
			'type' => 'select',
			'label' => 'Link Target',
			'desc' => '',
			'options' => array(
				'' => 'Same window',
				'_blank' => 'New window',
			)
		),
		'img' => array(
			'std' => '',
			'type' => 'image',
			'label' => 'Image (optional)',
			'desc' => 'Select image to replace the icon (32x32 px size is recommended)',
		),
	),
	'shortcode' => '[vc_iconbox type="{{type}}" icon="{{icon}}" title="{{title}}" link_url="{{link_url}}" link_text="{{link_text}}" target="{{target}}" img="{{img}}"] {{content}} [/vc_iconbox]',
	'popup_title' => 'Insert IconBox shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Testimonial Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['testimonial'] = array(
	'no_preview' => true,
	'params' => array(
		'author' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Name',
			'desc' => 'Enter the Name of the Person to quote',
		),
		'company' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Subtitle',
			'desc' => 'Can be used for a job description',
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'Quote',
			'desc' => '',
		),
	),
	'shortcode' => '[vc_testimonial author="{{author}}" company="{{company}}"] {{content}} [/vc_testimonial]',
	'popup_title' => 'Insert Testimonial shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Timeline Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['timeline'] = array(
	'params' => array(),
	'no_preview' => true,
	'shortcode' => '[timeline] {{child_shortcode}} [/timeline]',
	'popup_title' => 'Insert Timeline shortcode',

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => 'Timepoint Title',
				'desc' => 'Displayed above timeline point',
			),
			'text' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => 'Timepoint text',
				'desc' => '',
			),
		),
		'shortcode' => '<br>[timepoint title="{{title}}"] {{text}} [/timepoint]',
		'clone_button' => 'Add Timepoint'
	)
);
/*-----------------------------------------------------------------------------------*/
/*	Latest Posts Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['latest_posts'] = array(
	'no_preview' => true,
	'params' => array(
		'posts' => array(
			'type' => 'select',
			'label' => 'Posts',
			'desc' => '',
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
			)
		),
		'category' => array(
			'type' => 'select',
			'label' => 'Category',
			'desc' => '',
			'options' => $post_categories,
		),
	),
	'shortcode' => '[vc_latest_posts posts="{{posts}}" category="{{category}}"]',
	'popup_title' => 'Insert Latest Posts shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Recent Works Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['recent_works'] = array(
	'no_preview' => true,
	'params' => array(
		'columns' => array(
			'type' => 'select',
			'label' => 'Columns',
			'desc' => '',
			'options' => array(
				'4' => '4',
				'3' => '3',
				'2' => '2',

			)
		),
		'amount' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Amount of Items to show',
			'desc' => 'If left blank, equals amount of Columns',
		),
		'category' => array(
			'type' => 'select',
			'label' => 'Category',
			'desc' => '',
			'options' => $portfolio_categories,
		),
	),
	'shortcode' => '[vc_recent_works columns="{{columns}}" amount="{{amount}}" category="{{category}}"]',
	'popup_title' => 'Insert Portfolio Preview shortcode'
);
/*-----------------------------------------------------------------------------------*/
/*	Slider Revolution Config
/*-----------------------------------------------------------------------------------*/
$slider_revolution = array();

if(class_exists('RevSlider')){
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) {
		$slider_revolution[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}
if (count ($slider_revolution) > 0) {
	$us_zilla_shortcodes['rev_slider'] = array(
		'no_preview' => true,
		'params' => array(
			'alias' => array(
				'type' => 'select',
				'label' => 'Revolution Slider',
				'desc' => '',
				'options' => $slider_revolution,
			),
		),
		'shortcode' => '[rev_slider_vc alias="{{alias}}"]',
		'popup_title' => 'Insert Revolution Slider shortcode'
	);
}

/*-----------------------------------------------------------------------------------*/
/*	ActionBox Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['actionbox'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => 'ActionBox Color',
			'desc' => '',
			'options' => array(
				'primary' => 'Primary Color',
				'alternate' => 'Alternate Color',
			)
		),
		'controls' => array(
			'type' => 'select',
			'label' => 'Buttons Position',
			'desc' => '',
			'options' => array(
				'right' => 'Right',
				'bottom' => 'Bottom',
			)
		),
		'title' => array(
			'std' => 'This is ActionBox',
			'type' => 'text',
			'label' => 'ActionBox Title',
			'desc' =>  '',
		),
		'message' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => 'ActionBox Text',
			'desc' =>  '',
		),
		'button1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 Label',
			'desc' => '',
		),
		'link1' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 1 Link',
			'desc' => '',
		),
		'style1' => array(
			'type' => 'select',
			'label' => 'Button 1 Color',
			'desc' => '',
			'options' => array(
				'default' => 'Default (theme color)',
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'outline' => 'Outlined with Transparent Background',
				'pink' => 'Pink',
				'blue' => 'Blue',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'purple' => 'Purple',
				'red' => 'Red',
				'lime' => 'Lime',
				'navy' => 'Navy',
				'cream' => 'Cream',
				'brown' => 'Brown',
				'midnight' => 'Midnight',
				'teal' => 'Teal',
			)
		),
		'size1' => array(
			'type' => 'select',
			'label' => 'Button 1 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),

		'button2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 Label',
			'desc' => '',
		),
		'link2' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Button 2 Link',
			'desc' => '',
		),
		'style2' => array(
			'type' => 'select',
			'label' => 'Button 2 Color',
			'desc' => '',
			'options' => array(
				'default' => 'Default (theme color)',
				'primary' => 'Primary (theme color)',
				'secondary' => 'Secondary (theme color)',
				'outline' => 'Outlined with Transparent Background',
				'pink' => 'Pink',
				'blue' => 'Blue',
				'green' => 'Green',
				'yellow' => 'Yellow',
				'purple' => 'Purple',
				'red' => 'Red',
				'lime' => 'Lime',
				'navy' => 'Navy',
				'cream' => 'Cream',
				'brown' => 'Brown',
				'midnight' => 'Midnight',
				'teal' => 'Teal',
			)
		),
		'size2' => array(
			'type' => 'select',
			'label' => 'Button 2 Size',
			'desc' => '',
			'options' => array(
				'' => 'Normal',
				'small' => 'Small',
				'big' => 'Big'
			)
		),
	),
	'shortcode' => '[vc_actionbox type="{{type}}" controls="{{controls}}" title="{{title}}" message="{{message}}" button1="{{button1}}" link1="{{link1}}" style1="{{style1}}" size1="{{size1}}" button2="{{button2}}" link2="{{link2}}" style2="{{style2}}" size2="{{size2}}"]',
	'popup_title' => 'Insert ActionBox shortcode'
);

/*-----------------------------------------------------------------------------------*/
/*	Google Maps Config
/*-----------------------------------------------------------------------------------*/

$us_zilla_shortcodes['gmaps'] = array(
	'no_preview' => true,
	'params' => array(
		'address' => array(
			'std' => '1600 Amphitheatre Parkway, Mountain View, CA 94043, United States',
			'type' => 'text',
			'label' => 'Map Address',
			'desc' =>  '',
		),
		'marker' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Marker text',
			'desc' =>  'Leave blank to hide the Marker.',
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map height',
			'desc' =>  'Enter map height in pixels. Default: 400.',
		),
		'type' => array(
			'type' => 'select',
			'label' => 'Map type',
			'desc' => '',
			'options' => array(
				'ROADMAP' => 'Roadmap',
				'SATELLITE' => 'Satellite',
				'HYBRID' => 'Map + Terrain',
				'TERRAIN' => 'Terrain',
			)
		),
		'zoom' => array(
			'type' => 'select',
			'label' => 'Map zoom',
			'desc' => '',
			'options' => array(
				'14' => '14 - Default',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19',
				'20' => '20',
			)
		),
		'latitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Latitude',
			'desc' =>  'If Longitude and Latitude are set, they override the Address for Google Map.',
		),
		'longitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => 'Map Longitude',
			'desc' =>  'If Longitude and Latitude are set, they override the Address for Google Map.',
		),
	),
	'shortcode' => '[vc_gmaps address="{{address}}" latitude="{{latitude}}" longitude="{{longitude}}" marker="{{marker}}" height="{{height}}" type="{{type}}" zoom="{{zoom}}"]',
	'popup_title' => 'Insert Google Maps shortcode'
);
