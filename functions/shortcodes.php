<?php

// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

$auto_open = FALSE;
$first_tab = FALSE;
$first_tab_title = FALSE;

class US_Shortcodes {

	public function __construct()
	{
		add_filter('the_content', array($this, 'paragraph_fix'));
		add_filter('the_content', array($this, 'a_to_img_magnific_pupup'));

		add_filter('the_content', array($this, 'sections_fix'), 12);

		add_shortcode('item_title', array($this, 'item_title'));

		add_shortcode('timepoint_title', array($this, 'timepoint_title'));

		add_shortcode('icon', array($this, 'icon'));
		add_shortcode('vc_iconbox', array($this, 'vc_iconbox'));
		add_shortcode('vc_testimonial', array($this, 'vc_testimonial'));

		add_shortcode('vc_clients', array($this, 'vc_clients'));
		add_shortcode('vc_recent_works', array($this, 'vc_recent_works'));
		add_shortcode('vc_latest_posts', array($this, 'vc_latest_posts'));

		add_shortcode('vc_member', array($this, 'vc_member'));

		add_shortcode('vc_actionbox', array($this, 'vc_actionbox'));

		add_shortcode('pricing_table', array($this, 'pricing_table'));
		add_shortcode('pricing_column', array($this, 'pricing_column'));
		add_shortcode('pricing_row', array($this, 'pricing_row'));
		add_shortcode('pricing_footer', array($this, 'pricing_footer'));

		add_shortcode('vc_contact_form', array($this, 'vc_contact_form'));
		add_shortcode('vc_social_links', array($this, 'vc_social_links'));
		add_shortcode('vc_contacts', array($this, 'vc_contacts'));


		remove_shortcode('gallery');
		add_shortcode('gallery', array($this, 'gallery'));
		add_shortcode('vc_simple_slider', array($this, 'vc_simple_slider'));
		add_shortcode('vc_grid_blog_slider', array($this, 'vc_grid_blog_slider'));

        //VC shortcodes
        if (!class_exists('WPBakeryVisualComposerAbstract')) {
            add_shortcode('vc_row', array($this, 'vc_row'));
            add_shortcode('vc_row_inner', array($this, 'vc_row'));
            add_shortcode('vc_column', array($this, 'vc_column'));
            add_shortcode('vc_column_inner', array($this, 'vc_column'));
            add_shortcode('vc_column_text', array($this, 'vc_column_text'));
            add_shortcode('vc_separator', array($this, 'vc_separator'));
            add_shortcode('vc_button', array($this, 'vc_button'));
            add_shortcode('vc_video', array($this, 'vc_video'));
            add_shortcode('vc_gmaps', array($this, 'vc_gmaps'));
            add_shortcode('vc_accordion', array($this, 'vc_accordion'));
            add_shortcode('vc_accordion_tab', array($this, 'vc_accordion_tab'));
            add_shortcode('vc_tabs', array($this, 'vc_tabs'));
            add_shortcode('vc_tab', array($this, 'vc_tab'));
            add_shortcode('vc_gallery', array($this, 'vc_gallery'));
            add_shortcode('vc_single_image', array($this, 'vc_single_image'));
            add_shortcode('rev_slider_vc', array($this, 'rev_slider_vc'));
        }
	}

    public function rev_slider_vc($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/rev_slider_vc.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_row($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_row.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_column($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_column.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_column_text($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_column_text.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_accordion($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_accordion.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_accordion_tab($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_accordion_tab.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_tabs($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_tabs.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_tab($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_tab.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_gallery($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_gallery.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_single_image($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_single_image.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_separator($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_separator.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_button($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_button.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_video($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_video.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function vc_gmaps($atts, $content = null) {
        ob_start();
        include (get_template_directory().'/vc_templates/vc_gmaps.php');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

	public function paragraph_fix($content)
	{
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']<br>' => ']',
		);

		$content = strtr($content, $array);
		return $content;
	}

	public function sections_fix($content)
	{
		remove_shortcode('section');
		$link_pages_args = array(
			'before'           => '<div class="w-blog-pagination"><div class="g-pagination">',
			'after'            => '</div></div>',
			'next_or_number'   => 'next_and_number',
			'nextpagelink'     => __('Next', 'us'),
			'previouspagelink' => __('Previous', 'us'),
			'echo'             => 0
		);

		global $disable_section_shortcode;

		if ($disable_section_shortcode)
		{
			add_shortcode('section', array($this, 'section_dummy'));
			$content = $content.us_wp_link_pages($link_pages_args);
			return do_shortcode($content);
		}

		add_shortcode('section', array($this, 'section'));

		if (strpos($content, '[section') !== FALSE)
		{
			$content = strtr($content, array('[section' => '[/section automatic_end_section="1"][section'));

			$content = strtr($content, array('[/section]' => '[/section][section]'));

			$content = strtr($content, array('[/section automatic_end_section="1"]' => '[/section]'));

			$content = '[section]'.$content.us_wp_link_pages($link_pages_args).'[/section]';
		}
		else
		{
			$content = '[section]'.$content.us_wp_link_pages($link_pages_args).'[/section]';
		}

		$content = preg_replace('%\[section\](\\s)*\[/section\]%i', '', $content);

		return do_shortcode($content);
	}

	public function a_to_img_magnific_pupup ($content)
	{
		$pattern = "/<a(.*?)href=('|\")([^>]*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1ref="magnificPopup" href=$2$3.$4$5$6>';
		$content = preg_replace($pattern, $replacement, $content);

		return $content;
	}

	public function vc_contact_form($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'form_name_field' => 'required',
				'form_email_field' => 'required',
				'form_phone_field' => 'required',
				'form_email' => '',
				'form_captcha' => '',
				'captcha_salt' => 'Astra',
			), $attributes);

		$errors = array();
		if(isset($_POST['action']) AND $_POST['action'] == 'contact') {

			// Check name
			if($attributes['form_name_field'] == 'required' AND trim($_POST['contact_name']) == '') {
				$errors['contact_name'] = __('Please, enter Your name', 'us');
			} elseif (in_array($attributes['form_name_field'], array('required', 'show'))) {
				$name = trim($_POST['contact_name']);
			}

			// Check email
			if($attributes['form_email_field'] == 'required' AND trim($_POST['contact_email']) == '')  {
				$errors['contact_email'] = __('Please, enter Your email', 'us');
			} elseif ($attributes['form_email_field'] == 'required' AND filter_var($_POST['contact_email'],FILTER_VALIDATE_EMAIL) === false) {
				$errors['contact_email'] = __('Please, enter correct email', 'us');
			} elseif (in_array($attributes['form_email_field'], array('required', 'show'))) {
				$email = trim($_POST['contact_email']);
			}

			// Check phone
			if($attributes['form_phone_field'] == 'required' AND trim($_POST['contact_phone']) == '') {
				$errors['contact_phone'] = __('Please, enter Your phone', 'us');
			} elseif (in_array($attributes['form_phone_field'], array('required', 'show'))) {
				$phone = trim($_POST['contact_phone']);
			}

			//Check message
			if(trim($_POST['contact_message']) == '') {
				$errors['contact_message'] = __('Please, enter Your message', 'us');
			} else {
				if(function_exists('stripslashes')) {
					$comments = stripslashes(trim($_POST['contact_message']));
				} else {
					$comments = trim($_POST['contact_message']);
				}
			}

			// Check captcha
			if($attributes['form_captcha'] == 'show' AND md5(@$_POST['contact_captcha'].$attributes['captcha_salt']) != @$_POST['contact_captcha_result']) {
				$errors['contact_captcha'] = __('Please, enter correct result', 'us');
			}


			// Send the email
			if(!count($errors)) {
				$emailTo = ($attributes['form_email'] != '')?$attributes['form_email']:get_option('admin_email');
				$body = '';
				if (in_array($attributes['form_name_field'], array('required', 'show'))) {
					$body .= "Name: $name \n\n";
				}
				if (in_array($attributes['form_email_field'], array('required', 'show'))) {
					$body .= "Email: $email \n\n";
				}
				if (in_array($attributes['form_phone_field'], array('required', 'show'))) {
					$body .= "Phone: $phone \n\n";
				}
				$body .= "Message:\n $comments";
				$headers = '';

				$mail = wp_mail($emailTo, __('Contact request from', 'us')." http://".$_SERVER['HTTP_HOST'].'/', $body, $headers);

				$mailSent = true;

				$_POST['contact_name'] = $_POST['contact_email'] = $_POST['contact_phone'] = $_POST['contact_message'] = '';
			}
		}

		$output = '<form class="g-form" action="" method="post">';

		if (isset($mailSent) AND $mailSent)
		{
			$output .= '<div class="g-alert type_success with_close">
					<div class="g-alert-close">×</div>
					<div class="g-alert-body">
						<p><b>'.__('Thank You', 'us').'!</b> '.__('Your message was sent', 'us').'.</p>
					</div>
					</div>';
		}

		$output .= '<input type="hidden" name="action" value="contact">
			<div class="g-form-group">
				<div class="g-form-group-rows">';

		$name_error_text = (isset($errors['contact_name']))?'<div class="g-form-row-state">'.$errors['contact_name'].'</div>':'';
		$name_error_class = (isset($errors['contact_name']))?' check_wrong':'';
		$name_required = ($attributes['form_name_field'] == 'required')?' *':'';

		$email_error_text = (isset($errors['contact_email']))?'<div class="g-form-row-state">'.$errors['contact_email'].'</div>':'';
		$email_error_class = (isset($errors['contact_email']))?' check_wrong':'';
		$email_required = ($attributes['form_email_field'] == 'required')?' *':'';

		$phone_error_text = (isset($errors['contact_phone']))?'<div class="g-form-row-state">'.$errors['contact_phone'].'</div>':'';
		$phone_error_class = (isset($errors['contact_phone']))?' check_wrong':'';
		$phone_required = ($attributes['form_phone_field'] == 'required')?' *':'';

		$message_error_text = (isset($errors['contact_message']))?'<div class="g-form-row-state">'.$errors['contact_message'].'</div>':'';
		$message_error_class = (isset($errors['contact_message']))?' check_wrong':'';

		$captcha_error_text = (isset($errors['contact_captcha']))?'<div class="g-form-row-state">'.$errors['contact_captcha'].'</div>':'';
		$captcha_error_class = (isset($errors['contact_captcha']))?' check_wrong':'';

		if (in_array($attributes['form_name_field'], array('required', 'show'))) {
			$output .= '<div class="g-form-row'.$name_error_class.'">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_name">'.__('Your name', 'us').$name_required.'</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="text" name="contact_name" id="contact_name" value="'.@$_POST['contact_name'].'">
							</div>
						</div>
						'.$name_error_text.'
					</div>';
		}

		if (in_array($attributes['form_email_field'], array('required', 'show'))) {
			$output .= '<div class="g-form-row'.$email_error_class.'">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_email">'.__('Your Email', 'us').$email_required.'</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="text" name="contact_email" id="contact_email" value="'.@$_POST['contact_email'].'">
							</div>
						</div>
						'.$email_error_text.'
					</div>';
		}

		if (in_array($attributes['form_phone_field'], array('required', 'show'))) {
			$output .= '<div class="g-form-row'.$phone_error_class.'">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_phone">'.__('Your Phone', 'us').$phone_required.'</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="text" name="contact_phone" id="contact_phone" value="'.@$_POST['contact_phone'].'">
							</div>
						</div>
						'.$phone_error_text.'
					</div>';
		}


		$output .= '<div class="g-form-row'.$message_error_class.'">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="input1x3">'.__('Your Message', 'us').' *</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<textarea name="contact_message" id="contact_message" cols="30" rows="10">'.@$_POST['contact_message'].'</textarea>
							</div>
						</div>
						'.$message_error_text.'
					</div>';

		if ($attributes['form_captcha'] == 'show') {
			$first_num = rand(0, 19);
			$second_num = rand(0, 19);
			$sign = rand(0,1);
			if ($sign) {
				$result = $first_num+$second_num;
				$equation = $first_num.' + '.$second_num;
			} else {
				if ($first_num < $second_num){
					$first_num = $first_num+$second_num;
					$second_num = $first_num-$second_num;
					$first_num = $first_num-$second_num;
				}
				$result = $first_num-$second_num;
				$equation = $first_num.' - '.$second_num;
			}
			$output .= '<div class="g-form-row'.$captcha_error_class.'">
						<div class="g-form-row-label">
							<label class="g-form-row-label-h" for="contact_captcha">'.__('Just to prove you are a human, please solve the equation: ', 'us').$equation.'</label>
						</div>
						<div class="g-form-row-field">
							<div class="g-input">
								<input type="hidden" name="contact_captcha_result" value="'.md5($result.$attributes['captcha_salt']).'">
								<input type="text" name="contact_captcha" id="contact_captcha" value="">
							</div>
						</div>
						'.$captcha_error_text.'
					</div>';
		}

		$output .= '<div class="g-form-row">
						<div class="g-form-row-label"></div>
						<div class="g-form-row-field">
							<button class="g-btn type_primary">'.__('Send Message', 'us').'</button>
						</div>
					</div>
				</div>
			</div>
		</form>';

		return $output;
	}

	public function vc_social_links($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'size' => '',
				'email' => '',
				'facebook' => '',
				'twitter' => '',
				'google' => '',
				'linkedin' => '',
				'youtube' => '',
				'vimeo' => '',
				'flickr' => '',
				'instagram' => '',
				'behance' => '',
				'pinterest' => '',
				'skype' => '',
				'tumblr' => '',
				'dribbble' => '',
				'vk' => '',
				'rss' => '',
			), $attributes);

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

		$size_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';

		$output = '<div class="w-socials'.$size_class.'">
			<div class="w-socials-h">
				<div class="w-socials-list">';

		foreach ($socials as $social_key => $social)
		{
			if ($attributes[$social_key] != '')
			{
				if ($social_key == 'email')
				{
					$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" href="mailto:'.$attributes[$social_key].'">
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
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
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
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
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
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
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
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
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

		$output .= '</div></div></div>';

		return $output;
	}

	public function vc_contacts($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'phone' => '',
				'email' => '',
				'address' => '',
				'layout' => '',
			), $attributes);

		$layout_class = ($attributes['layout'] == 'with_icons')?' with_icons':'';


		$output = 	'<div class="w-contacts'.$layout_class.'">
						<div class="w-contacts-h">
							<div class="w-contacts-list">';
		if ($attributes['address'] != ''){
			$output .= 			'<div class="w-contacts-item for_address">
									<i class="fa fa-map-marker"></i>
									<span class="w-contacts-item-name">'.__('Address', 'us').':</span>
									<span class="w-contacts-item-value">'.$attributes['address'].'</span>
								</div>';
		}
		if ($attributes['phone'] != ''){
			$output .= 			'<div class="w-contacts-item for_phone">
									<i class="fa fa-phone"></i>
									<span class="w-contacts-item-name">'.__('Phone', 'us').':</span>
									<span class="w-contacts-item-value">'.$attributes['phone'].'</span>
								</div>';
		}
		if ($attributes['email'] != ''){
			$output .= 			'<div class="w-contacts-item for_email">
									<i class="fa fa-envelope"></i>
									<span class="w-contacts-item-name">'.__('Email', 'us').':</span>
									<span class="w-contacts-item-value"><a href="mailto:'.$attributes['email'].'">'.$attributes['email'].'</a></span>
								</div>';
		}

		$output .= 			'</div>
						</div>
					</div>';

		return $output;
	}

	public function pricing_table($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="w-pricing"> <div class="w-pricing-h">'.do_shortcode($content).'</div></div>';

		return $output;
	}

	public function pricing_column($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'type' => '',
				'price' => '',
				'time' => '',
			), $attributes);

		$featured_class = ($attributes['type'] == 'featured')?' type_featured':'';

		$output = 	'<div class="w-pricing-item'.$featured_class.'"><div class="w-pricing-item-h">
						<div class="w-pricing-item-header">
							<div class="w-pricing-item-title">'.$attributes['title'].'</div>
							<div class="w-pricing-item-price">'.$attributes['price'].'<small>'.$attributes['time'].'</small></div>
						</div>
						<ul class="w-pricing-item-features">'.
						do_shortcode($content).
					'</div></div>';

		return $output;
	}

	public function pricing_row($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = 	'<li class="w-pricing-item-feature">'.do_shortcode($content).'</li>';

		return $output;

	}

	public function pricing_footer($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'url' => '',
				'type' => 'default',
				'size' => '',
				'icon' => '',
			), $attributes);

		if ($attributes['url'] == '') $attributes['url'] = 'javascript:void(0)';

		$output = 	'</ul>
					<div class="w-pricing-item-footer">
						<a class="w-pricing-item-footer-button g-btn';
		$output .= ($attributes['type'] != '')?' type_'.$attributes['type']:'';
		$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$output .= '" href="'.$attributes['url'].'"><span>'.do_shortcode($content).'</span></a>
					</div>';

		return $output;

	}



	public function timepoint_title($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1))
			), $attributes);

		global $first_tab_title, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab_title)?' active':'';
			$first_tab_title = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}

		$output = 	'<div class="w-timeline-item'.$active_class.'">
						<span class="w-timeline-item-bullet"></span>
						<span class="w-timeline-item-title">'.$attributes['title'].'</span>
					</div> ';

		return $output;
	}

	public function item_title($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'icon' => '',
			), $attributes);

		global $first_tab_title, $auto_open;
		if ($auto_open) {
			$active_class = ($first_tab_title)?' active':'';
			$first_tab_title = FALSE;
		} else {
			$active_class = ($attributes['open'])?' active':'';
		}


		$icon_class = ($attributes['icon'] != '')?' fa fa-'.$attributes['icon']:'';
		$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

		$output = 	'<div class="w-tabs-item'.$active_class.$item_icon_class.'">'.
						'<span class="w-tabs-item-icon'.$icon_class.'"></span>'.
						'<span class="w-tabs-item-title">'.$attributes['title'].'</span>'.
					'</div>';

		return $output;
	}

	public function icon($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => "",
			), $attributes);

		$output = 	'<span class="fa fa-'.$attributes['icon'].'"></span>';

		return $output;
	}

	public function vc_actionbox ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'grey',
				'controls' => 'right',
				'title' => 'ActionBox title',
				'title_size' => 'h2',
				'message' => '',
				'button1' => '',
				'link1' => '',
				'style1' => 'default',
				'size1' => '',
				'button2' => '',
				'link2' => '',
				'style2' => 'default',
				'size2' => '',
				'animate' => '',
			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$controls_position_class = ($attributes['controls'] != 'bottom')?' at_right':'';
		$actionbox_controls_position_class = ($attributes['controls'] != 'bottom')?' controls_aside':'';


		$output = 	'<div class="w-actionbox color_'.$attributes['type'].$actionbox_controls_position_class.$animate_class.'">'.
			'<div class="w-actionbox-h">'.
			'<div class="w-actionbox-text">';
		if ($attributes['title'] != '')
		{
			$output .= 			'<h3>'.html_entity_decode($attributes['title']).'</h3>';
		}
		if ($attributes['message'] != '')
		{
			$output .= 			'<p>'.html_entity_decode($attributes['message']).'</p>';
		}


		$output .=			'</div>'.
			'<div class="w-actionbox-controls'.$controls_position_class.'">';

		if ($attributes['button1'] != '' AND $attributes['link1'] != '')
		{
			$colour_class = ($attributes['style1'] != '')?' type_'.$attributes['style1']:'';
			$size_class = ($attributes['size1'] != '')?' size_'.$attributes['size1']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link1'].'"><span>'.$attributes['button1'].'</span></a>';
		}

		if ($attributes['button2'] != '' AND $attributes['link2'] != '')
		{
			$colour_class = ($attributes['style2'] != '')?' type_'.$attributes['style2']:'';
			$size_class = ($attributes['size2'] != '')?' size_'.$attributes['size2']:'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['link2'].'"><span>'.$attributes['button2'].'</span></a>';
		}

		$output .=			'</div>'.
			'</div>'.
			'</div>';
		return $output;
	}

	public function section ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'background' => FALSE,
				'img' => FALSE,
				'parallax' => FALSE,
				'parallax_speed' => FALSE,
				'full_width' => FALSE,
                'class' => FALSE,
                'id' => FALSE,

			), $attributes);

		$output_type = ($attributes['background'] != '')?' color_'.$attributes['background']:'';
		$full_width_type = ($attributes['full_width'] != '')?' type_fullwidth':'';

        $additional_class = ($attributes['class'] != '')?' '.$attributes['class']:'';
        $section_id = ($attributes['id'] != '')?$attributes['id']:'';
        $section_id_string = ($attributes['id'] != '')?' id="'.$attributes['id'].'"':'';

		$background_style = '';
		if ($attributes['img'] != '')
		{
//			$output_type = ' type_background';
			if (is_numeric($attributes['img']))
			{
				$img_id = preg_replace('/[^\d]/', '', $attributes['img']);
                $img = wp_get_attachment_image_src($img_id, 'full', 0);

				if ( $img != NULL )
				{
					$img = $img[0];
                    $background_style = ' style="background-image: url('.$img.')"';
				}
			}
			else
			{
				$background_style = ' style="background-image: url('.$attributes['img'].')"';
			}

		}

		$parallax_class = '';
		$js_output = '';
		if ($attributes['parallax']) {
            if ($section_id_string == '') {
                $section_id = 'section_'.rand(99999, 999999);
                $section_id_string = ' id="'.$section_id.'"';
            }
			$parallax_class = ' with_parallax';

			$js_output = "<script>jQuery(window).load(function(){ jQuery('#".$section_id."').parallax('50%', '".$attributes['parallax_speed']."'); });</script>";
		}

		$output =	'<div class="l-submain'.$full_width_type.$output_type.$parallax_class.$additional_class.'"'.$background_style.$section_id_string.'>'.
						'<div class="l-submain-h g-html i-cf">'.
							do_shortcode($content).
						'</div>'.
					'</div>'.$js_output;

		return $output;
	}

	public function section_dummy ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => FALSE,
				'with' => FALSE,

			), $attributes);

		$output = 	'<div>'.do_shortcode($content).'</div>';

		return $output;
	}

	public function vc_iconbox($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => '',
				'img' => '',
				'title' => '',
				'link_url' => '',
				'link_text' => 'Learn More',
				'type' => '',
				'target' => '',

			), $attributes);


		if (is_numeric($attributes['img']))
		{
			$img_id = preg_replace('/[^\d]/', '', $attributes['img']);
            $img = wp_get_attachment_image_src( $img_id, 'full');

			if ( $img != NULL )
			{
				$img = $img[0];
			}
		}
		else
		{
			$img =  $attributes['img'];
		}

		$img_class = ($img != NULL)?' with_img':'';
		$type_class = ($attributes['type'] != '')?' '.$attributes['type']:'';
		$link = $icon_link_start = $icon_link_end = '';
		$link_target = ($attributes['target'] == '_blank')?' target="_blank"':'';
		if ($attributes['link_url'] != '') {
			$link = '<a class="w-iconbox-text-link" href="'.$attributes['link_url'].'"'.$link_target.'><span>'.$attributes['link_text'].'</span></a>';
            $icon_link_start = '<a href="'.$attributes['link_url'].'"'.$link_target.'>';
            $icon_link_end = '</a>';
		}

		$output =	'<div class="w-iconbox'.$img_class.$type_class.'">
						<div class="w-iconbox-h">
							'.$icon_link_start.'<div class="w-iconbox-icon">
								<i class="fa fa-'.$attributes['icon'].'"></i>';
		if ($img != NULL) {
			$output .=			'<div class="w-iconbox-icon-img">
									<img src="'.$img.'" alt=""/>
								</div>';
		}
		$output .=	'			</div>'.$icon_link_end.'
							<div class="w-iconbox-text">
								<h3 class="w-iconbox-text-title">'.$attributes['title'].'</h3>
								<div class="w-iconbox-text-description">'.do_shortcode($content).'</div>
								'.$link.'
							</div>
						</div>
					</div>';

		return $output;
	}

	public function vc_testimonial($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'author' => '',
				'company' => '',
				'animate' => '',

			), $attributes);

		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		$output = 	'<div class="w-testimonial'.$animate_class.'">
						<div class="w-testimonial-h">
							<blockquote>
								<q class="w-testimonial-text">'.do_shortcode($content).'</q>
								<div class="w-testimonial-person">
									<i class="fa fa-user"></i>
									<span class="w-testimonial-person-name">'.$attributes['author'].'</span>,
									<span class="w-testimonial-person-meta">'.$attributes['company'].'</span>
								</div>
							</blockquote>
						</div>
					</div>';

		return $output;
	}

	public function vc_member ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'name' => '',
				'role' => '',
				'img' => '',
				'email' => '',
				'facebook' => '',
				'twitter' => '',
				'google_plus' => '',
				'linkedin' => '',
                'custom_icon' => '',
                'custom_link' => '',
				'link' => '',
				'animate' => '',
			), $attributes);


		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		if (is_numeric($attributes['img']))
		{
			$img_id = preg_replace('/[^\d]/', '', $attributes['img']);
            $img = wp_get_attachment_image_src( $img_id, 'full');

			if ( $img != NULL )
			{
				$img = $img[0];
			}
		}
		else
		{
			$img =  $attributes['img'];
		}

		if ( $img == NULL OR $img == '' )
		{
			$img = get_template_directory_uri().'/img/placeholder/500x500.gif';
		}

		$social_output = '';

        if ($attributes['facebook'] != '' OR $attributes['twitter'] != '' OR $attributes['google_plus'] != '' OR $attributes['linkedin'] != '' OR $attributes['email'] != '' OR ($attributes['custom_icon'] != '' AND $attributes['custom_link'] != ''))
		{
			$social_output .=		'<div class="w-team-member-links">'.
										'<div class="w-team-member-links-list">';

			if ($attributes['email'] != '')
			{
				$social_output .= 			'<a class="w-team-member-links-item" href="mailto:'.$attributes['email'].'" target="_blank"><i class="fa fa-envelope"></i></a>';
			}
			if ($attributes['facebook'] != '')
			{
				$social_output .= 			'<a class="w-team-member-links-item" href="'.$attributes['facebook'].'" target="_blank"><i class="fa fa-facebook"></i></a>';
			}
			if ($attributes['twitter'] != '')
			{
				$social_output .= 			'<a class="w-team-member-links-item" href="'.$attributes['twitter'].'" target="_blank"><i class="fa fa-twitter"></i></a>';
			}
			if ($attributes['google_plus'] != '')
			{
				$social_output .= 			'<a class="w-team-member-links-item" href="'.$attributes['google_plus'].'" target="_blank"><i class="fa fa-google-plus"></i></a>';
			}
			if ($attributes['linkedin'] != '')
			{
				$social_output .= 			'<a class="w-team-member-links-item" href="'.$attributes['linkedin'].'" target="_blank"><i class="fa fa-linkedin"></i></a>';
			}
            if ($attributes['custom_icon'] != '' AND $attributes['custom_link'] != '')
            {
                $social_output .= 			'<a class="w-team-member-links-item" href="'.$attributes['custom_link'].'" target="_blank"><i class="fa fa-'.$attributes['custom_icon'].'"></i></a>';
            }
			$social_output .=			'</div>'.
									'</div>';
		}

        $link_start = $link_end = '';

        if ($attributes['link'] != '') {
            $link_start = '<a class="w-team-link" href="'.$attributes['link'].'">';
            $link_end = '</a>';
        }

		$output = 	'<div class="w-team-member'.$animate_class.'">
						<div class="w-team-member-h">
							<div class="w-team-member-image">
								'.$link_start.'<img src="'.$img.'" alt="" />'.$link_end.'
								'.$social_output.'
							</div>
							<div class="w-team-member-meta">
								<div class="w-team-member-meta-h">
									'.$link_start.'<h4 class="w-team-member-name"><span>'.$attributes['name'].'</span></h4>'.$link_end.'
									<div class="w-team-member-role">'.$attributes['role'].'</div>
									<div class="w-team-member-description">
										<p>'.do_shortcode($content).'</p>
									</div>
								</div>
							</div>
						</div>
					</div>';

		return $output;
	}

	public function vc_clients($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'amount' => 1000,
			), $attributes);

		$args = array(
			'post_type' => 'us_client',
			'paged' => 1,
			'posts_per_page' => $attributes['amount'],
		);

		$cleints = new WP_Query($args);

		$output = 	'<div class="w-clients type_carousel columns_5">
							<div class="w-clients-h">
								<div class="w-clients-list">
									<div class="w-clients-list-h">';

		while($cleints->have_posts())
		{
			$cleints->the_post();
			if(has_post_thumbnail())
			{
				if (rwmb_meta('us_client_url') != '')
				{
					$client_new_tab = (rwmb_meta('us_client_new_tab') == 1)?' target="_blank"':'';
					$client_url = (rwmb_meta('us_client_url') != '')?rwmb_meta('us_client_url'):'javascript:void(0);';
					$client_url = (substr($client_url, 0, 4) == 'http' OR $client_url == 'javascript:void(0);' OR $client_url == '#')?$client_url:'//'.$client_url;
					$output .= 			'<a class="w-clients-item" href="'.$client_url.'"'.$client_new_tab.'>'.
							get_the_post_thumbnail(get_the_ID(), 'carousel-thumb').
						'</a>';
				}
				else
				{
					$output .= 			'<div class="w-clients-item">'.
							get_the_post_thumbnail(get_the_ID(), 'carousel-thumb').
						'</div>';
				}

			}
		}

	$output .=						'</div>
								</div>
								<a class="w-clients-nav to_prev disabled" href="javascript:void(0)" title=""></a>
								<a class="w-clients-nav to_next" href="javascript:void(0)" title=""></a>
							</div>
						</div>';
		return $output;
	}

	public function animate($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'afc',
			), $attributes);

		$output = '<div class="animate_'.$attributes['type'].'">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function vc_latest_posts($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'posts' => 2,
				'category' => null,
			), $attributes);

		if ( ! in_array($attributes['posts'], array(1,2,3)))
		{
			$attributes['posts'] = 2;
		}

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => 1,
            'posts_per_page' => $attributes['posts'],
            'post__not_in' => get_option( 'sticky_posts' )
        );

		if ( ! empty($attributes['category'])) {
			$args['category_name'] = $attributes['category'];
		}

        global $wp_query;

        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query($args);

		$output = 	'<div class="w-shortblog columns_'.$attributes['posts'].' date_atleft">
							<div class="w-shortblog-h">
								<div class="w-shortblog-list">';
		global $disable_section_shortcode;
		$disable_section_shortcode_tmp = $disable_section_shortcode;
		$disable_section_shortcode = TRUE;
		while($wp_query->have_posts())
		{
            $wp_query->the_post();


			$excerpt = get_the_content(get_the_ID());
			$excerpt = do_shortcode($excerpt);
			$excerpt = $this->sections_fix($excerpt);


			$excerpt = apply_filters('the_excerpt', $excerpt);
			$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
			$excerpt_length = apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

			$output .= 				'<div class="w-shortblog-entry">
										<div class="w-shortblog-entry-h">
											<a class="w-shortblog-entry-link" href="'.get_permalink(get_the_ID()).'">
												<h4 class="w-shortblog-entry-title">
													<span class="w-shortblog-entry-title-h">'.get_the_title().'</span>
												</h4>
											</a>
											<div class="w-shortblog-entry-meta">
												<div class="w-shortblog-entry-meta-date">
													<span class="w-shortblog-entry-meta-date-month">'.get_the_date('M').'</span>
										<span class="w-shortblog-entry-meta-date-day">'.get_the_date('d').'</span>
										<span class="w-shortblog-entry-meta-date-year">'.get_the_date('Y').'</span>
												</div>
											</div>
											<div class="w-shortblog-entry-short">
											'.$excerpt.'
											</div>
										</div>
									</div>';
		}
		$output .=				'</div>
							</div>
						</div>';
		$disable_section_shortcode = $disable_section_shortcode_tmp;

        wp_reset_postdata();
        $wp_query= $temp;

		return $output;
	}

	public function vc_recent_works($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'columns' => 4,
				'amount' => NULL,
				'animate' => '',
				'category' => '',
			), $attributes);

//		$animate_class = ($attributes['animate'] != '')?' animate_'.$attributes['animate']:'';

		if ( ! in_array($attributes['columns'], array(2,3,4)))
		{
			$attributes['columns'] = 4;
		}

		if ($attributes['amount'] == NULL)
		{
			$attributes['amount'] = $attributes['columns'];
		}

		$args = array(
			'post_type' => 'us_portfolio',
			'paged' => 1,
			'posts_per_page' => $attributes['amount'],
		);

		if ( ! empty($attributes['category'])) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'us_portfolio_category',
					'field' => 'slug',
					'terms' => $attributes['category']
				)
			);
		}

		$works = new WP_Query($args);

		$output = 	'<div class="w-portfolio columns_'.$attributes['columns'].'">
						<div class="w-portfolio-h">
							<div class="w-portfolio-list">
								<div class="w-portfolio-list-h">';

		while($works->have_posts())
		{
			$works->the_post();

			$item_categories_links = '';
			$item_categories = get_the_terms(get_the_ID(), 'us_portfolio_category');
			if (is_array($item_categories))
			{
				foreach ($item_categories as $item_category)
				{
					$item_categories_links .= $item_category->name.' / ';
				}
			}
			if (mb_strlen($item_categories_links) > 0 )
			{
				$item_categories_links = mb_substr($item_categories_links, 0, -2);
			}

			if ( has_post_thumbnail() ) {
				$the_thumbnail = get_the_post_thumbnail( null, 'portfolio-list');
			} else {
				$the_thumbnail =  '<img src="'.get_template_directory_uri() .'/img/placeholder/500x500.gif" alt="">';
			}

			$output .= 			'<div class="w-portfolio-item">
								<div class="w-portfolio-item-h">
									<a class="w-portfolio-item-anchor" href="'.get_permalink(get_the_ID()).'">
										<div class="w-portfolio-item-image">
											'.$the_thumbnail.'
											<div class="w-portfolio-item-meta">
												<h2 class="w-portfolio-item-title">'.get_the_title().'</h2>
												<i class="fa fa-mail-forward"></i>
											</div>
										</div>
									</a>
								</div>
								</div>';

		}


		$output .=				'</div>'.
							'</div>'.
						'</div>'.
					'</div>';
		return $output;
	}

	public function vc_simple_slider($attributes)
	{
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attributes['ids'] ) )
		{
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attributes['orderby'] ) )
			{
				$attributes['orderby'] = 'post__in';
			}
			$attributes['include'] = $attributes['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attributes['orderby'] ) )
		{
			$attributes['orderby'] = sanitize_sql_orderby( $attributes['orderby'] );
			if ( !$attributes['orderby'] )
			{
				unset( $attributes['orderby'] );
			}
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'type'       => 's',
			'include'    => '',
			'exclude'    => '',
			'auto_rotation'    => '1',
		), $attributes));


		$type_classes = ' type_slider';
		$size = 'gallery-full';


		$id = intval($id);

		if ( !empty($include) )
		{
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			if (is_array($_attachments))
			{
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}
		}
		elseif ( !empty($exclude) )
		{
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		else
		{
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
		{
			return '';
		}


		$rand_id = rand(100000, 999999);
		$output = '<div class="w-gallery'.$type_classes.'"> <div class="w-gallery-h"> <div class="w-gallery-main"><div class="w-gallery-main-h flexslider flex-loading" id="slider_'.$rand_id.'">';



		$i = 1;
		if (is_array($attachments))
		{

			$output .= '<ul class="slides">';
			foreach ( $attachments as $id => $attachment ) {

				$output .= '<li>';
				$output .= wp_get_attachment_image( $id, $size, 0 );
				$output .= '</li>';

				$i++;

			}
			$output .= '</ul>';



		}

		$output .= "</div> </div> </div> </div>\n";

		$disable_rotation = '';
		if ($auto_rotation == 0) {
			$disable_rotation = 'slideshow: false,';
		}

		$output .= '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#slider_'.$rand_id.'").flexslider({
								'.$disable_rotation.'controlsContainer: "#slider_'.$rand_id.'",
								directionalNav: true,
								controlNav: false,
								smoothHeight: true,
								start: function(slider) {
									slider.resize();
									jQuery("#slider_'.$rand_id.'").removeClass("flex-loading");
								}
							});
						});
					</script>';

		return $output;
	}

	public function vc_grid_blog_slider($attributes)
	{
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attributes['ids'] ) )
		{
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attributes['orderby'] ) )
			{
				$attributes['orderby'] = 'post__in';
			}
			$attributes['include'] = $attributes['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attributes['orderby'] ) )
		{
			$attributes['orderby'] = sanitize_sql_orderby( $attributes['orderby'] );
			if ( !$attributes['orderby'] )
			{
				unset( $attributes['orderby'] );
			}
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'type'       => 's',
			'include'    => '',
			'exclude'    => '',
			'auto_rotation'    => '1',
		), $attributes));


		$type_classes = ' type_slider';
		$size = 'gallery-full';


		$id = intval($id);

		if ( !empty($include) )
		{
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			if (is_array($_attachments))
			{
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}
		}
		elseif ( !empty($exclude) )
		{
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		else
		{
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
		{
			return '';
		}


		$rand_id = rand(100000, 999999);
		$output = '<div class="w-gallery'.$type_classes.'"> <div class="w-gallery-h"> <div class="w-gallery-main"><div class="w-gallery-main-h flexslider flex-loading" id="slider_'.$rand_id.'">';



		$i = 1;
		if (is_array($attachments))
		{

			$output .= '<ul class="slides">';
			foreach ( $attachments as $id => $attachment ) {




				$output .= '<li>';
				$output .= wp_get_attachment_image( $id, 'portfolio-list', 0 );
				$output .= '</li>';

				$i++;

			}
			$output .= '</ul>';



		}

		$output .= "</div> </div> </div> </div>\n";

		$disable_rotation = '';
		if ($auto_rotation == 0) {
			$disable_rotation = 'slideshow: false,';
		}

		$output .= '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#slider_'.$rand_id.'").flexslider({
								'.$disable_rotation.'controlsContainer: "#slider_'.$rand_id.'",
								directionalNav: true,
								controlNav: false,
								smoothHeight: true,
								start: function(slider) {
									jQuery("#slider_'.$rand_id.'").removeClass("flex-loading");
									slider.resize();
									jQuery(".w-blog.type_masonry .w-blog-list").isotope("layout");
								}
							});
						});
					</script>';

		return $output;
	}

	public function gallery($attributes)
	{
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attributes['ids'] ) )
		{
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attributes['orderby'] ) )
			{
				$attributes['orderby'] = 'post__in';
			}
			$attributes['include'] = $attributes['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attributes['orderby'] ) )
		{
			$attributes['orderby'] = sanitize_sql_orderby( $attributes['orderby'] );
			if ( !$attributes['orderby'] )
			{
				unset( $attributes['orderby'] );
			}
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'type'       => 's',
			'include'    => '',
			'exclude'    => ''
		), $attributes));

		if ( ! in_array($type, array('xs', 's', 'm', 'l', 'masonry', 'slider',))) {
			$type = "s";
		}

		$size = 'gallery-'.$type;
		if ($type == 'masonry') {
			$type_classes = ' type_masonry';
		} elseif ($type == 'slider') {
			$type_classes = ' type_slider';
			$size = 'gallery-full';
		} else {
			$type_classes = ' layout_tile size_'.$type;
		}


		$id = intval($id);
		if ( 'RAND' == $order )
		{
			$orderby = 'none';
		}

		if ( !empty($include) )
		{
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			if (is_array($_attachments))
			{
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}
		}
		elseif ( !empty($exclude) )
		{
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		else
		{
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
		{
			return '';
		}

		if ( is_feed() )
		{
			$output = "\n";
			if (is_array($attachments))
			{
				foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			}
			return $output;
		}


		if ($type == 'slider') {
			$rand_id = rand(100000, 999999);
			$output = '<div class="w-gallery'.$type_classes.'"> <div class="w-gallery-h"> <div class="w-gallery-main"><div class="w-gallery-main-h flexslider flex-loading" id="slider_'.$rand_id.'">';
		} else {
			$output = '<div class="w-gallery'.$type_classes.'"> <div class="w-gallery-h"> <div class="w-gallery-tnails"> <div class="w-gallery-tnails-h">';
		}


		$i = 1;
		if (is_array($attachments))
		{
			if ($type == 'slider') {
				$output .= '<ul class="slides">';
				foreach ( $attachments as $id => $attachment ) {




					$output .= '<li>';
					$output .= wp_get_attachment_image( $id, $size, 0 );
					$output .= '</li>';

					$i++;

				}
				$output .= '</ul>';
				$output .= '<script type="text/javascript">
								jQuery(window).load(function() {
									jQuery("#slider_'.$rand_id.'").flexslider({
										controlsContainer: "#slider_'.$rand_id.'",
										directionalNav: true,
										controlNav: false,
										smoothHeight: true,
										start: function(slider) {
											slider.resize();
											jQuery("#slider_'.$rand_id.'").removeClass("flex-loading");
										}
									});
								});
							</script>';
			} else {
				foreach ( $attachments as $id => $attachment ) {


					$title = trim(strip_tags( get_post_meta($id, '_wp_attachment_image_alt', true) ));
					if (empty($title))
					{
						$title = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
					}
					if (empty($title ))
					{
						$title = trim(strip_tags( $attachment->post_title )); // Finally, use the title
					}

					$output .= '<a class="w-gallery-tnail order_'.$i.'" href="'.wp_get_attachment_url($id).'" title="'.$title.'">';
					$output .= '<span class="w-gallery-tnail-h">';
					$output .= wp_get_attachment_image( $id, $size, 0 );
					$output .= '<span class="w-gallery-tnail-title"><i class="fa fa-search"></i></span>';

					$output .= '</span>';
					$output .= '</a>';

					$i++;

				}
			}

		}

		$output .= "</div> </div> </div> </div>\n";

		return $output;
	}
}

global $us_shortcodes;

$us_shortcodes = new US_Shortcodes;

// Add buttons to tinyMCE
function us_add_buttons() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'us_tinymce_plugin');
		add_filter('mce_buttons_3', 'us_tinymce_buttons');
	}
}

function us_tinymce_buttons($buttons) {
	array_push($buttons, "columns", "separator_btn", "button_btn", "tabs", "accordion", "iconbox", "testimonial", "services", "team", "latest_posts", "recent_works", "clients", "actionbox", "video", "pricing_table", "alert", "contact_form", "contacts", "social_links", "gmaps");
	if(class_exists('RevSlider')){
		$slider_revolution = array();
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		foreach($arrSliders as $revSlider) {
			$slider_revolution[$revSlider->getAlias()] = $revSlider->getTitle();
		}

		if (count ($slider_revolution) > 0) {
			array_push($buttons, "rev_slider");
		}
	}
	return $buttons;
}

function us_tinymce_plugin($plugin_array) {
	$plugin_array['columns'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['alert'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['tabs'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['accordion'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['video'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['team'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['button_btn'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['separator_btn'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['icon'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['iconbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['testimonial'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['latest_posts'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['recent_works'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['clients'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['actionbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['pricing_table'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['contact_form'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['social_links'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['contacts'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['gmaps'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['rev_slider'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
//	$plugin_array['animate'] = get_template_directory_uri().'/functions/tinymce/buttons.js';

	return $plugin_array;
}

add_action('admin_init', 'us_add_buttons');

function us_media_templates(){

	?>
	<script type="text/html" id="tmpl-my-custom-gallery-setting">
		<label class="setting">
			<span>Type</span>
			<select data-setting="type">
				<option value="default_val">S size thumbs</option>
				<option value="xs">XS size thumbs</option>
				<option value="m">M size thumbs</option>
				<option value="l">L size thumbs</option>
				<option value="masonry">Masonry</option>
				<option value="slider">Slider</option>
			</select>
		</label>
	</script>

	<script>

		jQuery(document).ready(function(){

			// add your shortcode attribute and its default value to the
			// gallery settings list; $.extend should work as well...
			_.extend(wp.media.gallery.defaults, {
				type: 'default_val'
			});

			// merge default gallery settings template with yours
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
				template: function(view){
					return wp.media.template('gallery-settings')(view)
						+ wp.media.template('my-custom-gallery-setting')(view);
				}
			});

		});

	</script>
<?php

}

// Add Type select to Gallery window
add_action('print_media_templates', 'us_media_templates');

