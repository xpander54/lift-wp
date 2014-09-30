<?php

if ( ! function_exists( 'us_fonts' ) ) {
    function us_fonts() {
        global $smof_data;
        $protocol = is_ssl() ? 'https' : 'http';

        if (empty($smof_data['font_subset'])) {
            $subset = '';
        } else {
            $subset = '&subset='.$smof_data['font_subset'];
        }

        if ($smof_data['body_text_font'] != '' AND $smof_data['body_text_font'] != 'none')
        {

            wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['body_text_font']).":400,700,400italic,700italic".$subset );
        }
        else
        {
            wp_enqueue_style( 'us-body-text-font', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic".$subset );
        }


        if ($smof_data['body_text_font'] != $smof_data['navigation_font'] AND $smof_data['navigation_font'] != '' AND $smof_data['navigation_font'] != 'none')
        {
            wp_enqueue_style( 'us-navigation-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['navigation_font']).":400,700,400italic,700italic".$subset );
        }

        if ($smof_data['heading_font'] != '' AND $smof_data['heading_font'] != 'none')
        {
            wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=".str_replace(' ', '+', $smof_data['heading_font']).":400,300,700".$subset );
        }
        else
        {
            wp_enqueue_style( 'us-heading-font', "$protocol://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700".$subset );
        }


    }
    add_action( 'wp_enqueue_scripts', 'us_fonts' );

}

if ( ! function_exists( 'us_styles' ) ) {
    function us_styles()
    {
        wp_register_style( 'us_motioncss', get_template_directory_uri() . '/css/motioncss.css', array(), '1', 'all' );
        wp_register_style( 'us_motioncss-widgets', get_template_directory_uri() . '/css/motioncss-widgets.css', array(), '1', 'all' );
        wp_register_style( 'us_font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1', 'all' );
        wp_register_style( 'us_magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1', 'all' );
        wp_register_style( 'us_wp-widgets', get_template_directory_uri() . '/css/wp-widgets.css', array(), '1', 'all' );
        wp_register_style( 'us_style', get_template_directory_uri() . '/css/style.css', array(), '1', 'all' );
        wp_register_style( 'us_responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1', 'all' );
        wp_register_style( 'us_animation', get_template_directory_uri() . '/css/animation.css', array(), '1', 'all' );
        wp_register_style( 'us_js_composer_fe', get_template_directory_uri() . '/vc_templates/css/us.js_composer_fe.css', array(), '1', 'all' );

        wp_enqueue_style( 'us_motioncss' );
        wp_enqueue_style( 'us_motioncss-widgets' );
        wp_enqueue_style( 'us_font-awesome' );
        wp_enqueue_style( 'us_magnific-popup' );
        wp_enqueue_style( 'us_wp-widgets' );
        wp_enqueue_style( 'us_style' );
        wp_enqueue_style( 'us_responsive' );
        wp_enqueue_style( 'us_animation' );

        if (us_is_vc_fe()) {
            wp_enqueue_style( 'us_js_composer_fe' );
        } else {
            wp_dequeue_style( 'js_composer_front' );
        }
    }
    add_action('wp_enqueue_scripts', 'us_styles', 12);
}

function us_custom_styles()
{
    $wp_upload_dir  = wp_upload_dir();
    $styles_dir = $wp_upload_dir['basedir'].'/us_custom_css';
    $styles_dir = str_replace('\\', '/', $styles_dir);
    $styles_file = $styles_dir.'/us_astra_custom_styles.css';

    if (file_exists($styles_file))
    {
        wp_register_style('us_custom_css', $wp_upload_dir['baseurl'] . '/us_custom_css/us_astra_custom_styles.css', array(), '1', 'all');
        wp_enqueue_style('us_custom_css');
    }
    else
    {
        global $load_styles_directly;
        $load_styles_directly = true;
    }

    if(get_template_directory_uri() !=  get_stylesheet_directory_uri())
    {
        wp_register_style( 'astra-style' ,  get_stylesheet_directory_uri() . '/style.css', array(), '1', 'all' );
        wp_enqueue_style( 'astra-style');
    }
}
add_action('wp_enqueue_scripts', 'us_custom_styles', 17);

if ( ! function_exists( 'us_jscripts' ) ) {
    function us_jscripts()
    {

        wp_register_script('us_g-alert', get_template_directory_uri().'/js/g-alert.js', array('jquery'), '', TRUE);
        wp_register_script('us_carousello', get_template_directory_uri().'/js/jquery.carousello.js', array('jquery'), '', TRUE);
        wp_register_script('us_imagesloaded', get_template_directory_uri().'/js/imagesloaded.js', array('jquery'), '', TRUE);
        wp_register_script('us_isotope', get_template_directory_uri().'/js/jquery.isotope.js', array('jquery'), '', TRUE);
        wp_register_script('us_magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.js', array('jquery'), '', TRUE);
        wp_register_script('us_smoothScroll', get_template_directory_uri().'/js/jquery.smoothScroll.js', array('jquery'), '', TRUE);
        wp_register_script('us_simpleplaceholder', get_template_directory_uri().'/js/jquery.simpleplaceholder.js', array('jquery'), '', TRUE);
        wp_register_script('us_w-search', get_template_directory_uri().'/js/w-search.js', array('jquery'), '', TRUE);
        wp_register_script('us_navToSelect', get_template_directory_uri().'/js/navToSelect.js', array('jquery'), '', TRUE);
        wp_register_script('us_w-tabs', get_template_directory_uri().'/js/w-tabs.js', array('jquery'), '', TRUE);
        wp_register_script('us_w-timeline', get_template_directory_uri().'/js/w-timeline.js', array('jquery'), '', TRUE);
        wp_register_script('us_waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), '', TRUE);
        wp_register_script('us_flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), '', TRUE);
        wp_register_script('us_w-lang', get_template_directory_uri().'/js/w-lang.js', array('jquery'), '', TRUE);
        wp_register_script('us_parallax', get_template_directory_uri().'/js/jquery.parallax.js', array('jquery'), '', TRUE);
        wp_register_script('us_plugins', get_template_directory_uri().'/js/plugins.js', array('jquery'), '', TRUE);
        wp_register_script('gmaps', get_template_directory_uri().'/js/jquery.gmap.min.js', array('jquery'), '', TRUE);
//	wp_register_script('', get_template_directory_uri().'/js/.js', array('jquery'), '');

        wp_enqueue_script('jquery');
        wp_enqueue_script('us_g-alert');
        wp_enqueue_script('us_carousello');
        wp_enqueue_script('us_imagesloaded');
        wp_enqueue_script('us_isotope');
        wp_enqueue_script('us_magnific-popup');
        wp_enqueue_script('us_smoothScroll');
        wp_enqueue_script('us_simpleplaceholder');
        wp_enqueue_script('us_w-search');
        wp_enqueue_script('us_navToSelect');
        wp_enqueue_script('us_w-tabs');
        wp_enqueue_script('us_w-timeline');
        wp_enqueue_script('us_waypoints');
        wp_enqueue_script('us_flexslider');
        wp_enqueue_script('us_w-lang');
        wp_enqueue_script('us_parallax');
        wp_enqueue_script('us_plugins');

        wp_enqueue_script('comment-reply');

    }
    add_action('wp_enqueue_scripts', 'us_jscripts');
}

function us_wp_admin_js() {
	wp_register_style( 'admin_buttons', get_template_directory_uri() . '/css/buttons.css' );
	wp_enqueue_style( 'admin_buttons' );

	wp_register_script('us_wp_admin', get_template_directory_uri().'/functions/js/us_admin.js', array('jquery'), '', TRUE);
	wp_enqueue_script( 'us_wp_admin' );
}
add_action( 'admin_enqueue_scripts', 'us_wp_admin_js' );