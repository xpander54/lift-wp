<?php
/**
 * Include all needed files
 */
/* Slightly Modified Options Framework */
require_once ('admin/index.php');
/* Admin specific functions */
require_once('functions/admin.php');
/* Load shortcodes */
require_once('functions/shortcodes.php');
require_once('functions/zilla-shortcodes/zilla-shortcodes.php');
/* Breadcrumbs function */
require_once('functions/breadcrumbs.php');
/* Post formats */
require_once('functions/post_formats.php');
/* Custom Post types */
require_once('functions/post_types.php');
/* Meta Box plugin and settings */
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/vendor/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/vendor/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
require_once('functions/meta-box_settings.php');
/* Menu and it's custom markup */
require_once('functions/menu.php');
/* Comments custom markup */
require_once('functions/comments.php');
/* wp_link_pages both next and numbers usage */
require_once('functions/link_pages.php');
/* Sidebars init */
require_once('functions/sidebars.php');
/* Sidebar generator */
require_once('vendor/sidebar_generator.php');
/* Plugins activation */
require_once('functions/plugin_activation.php');
/* CSS and JS enqueue */
require_once('functions/enqueue.php');
/* Auto Updater */
require_once('vendor/tf_updater/index.php');
/* Widgets */
require_once('functions/widgets/contact.php');
require_once('functions/widgets/socials.php');
add_filter('widget_text', 'do_shortcode');

require_once('functions/ajax_grid_blog.php');
require_once('functions/ajax_import.php');


/**
 * Theme Setup
 */
function us_theme_setup()
{
	global $smof_data, $content_width;

	if ( ! isset( $content_width ) ) $content_width = 1500;
	add_theme_support('automatic-feed-links');

	add_theme_support('post-formats', array('quote', 'image', 'gallery', 'video', ));

	/* Add post thumbnail functionality */
	add_theme_support('post-thumbnails');
	add_image_size('portfolio-list', 490, 490, true);
	add_image_size('blog-grid', 465, 0, false);
	add_image_size('blog-large', 1000, 600, true);
	add_image_size('carousel-thumb', 180, 120, true);
	add_image_size('gallery-xs', 91, 91, true);
	add_image_size('gallery-s', 160, 160, true);
	add_image_size('gallery-m', 192, 192, true);
	add_image_size('gallery-l', 244, 244, true);
	add_image_size('gallery-masonry', 350, 0, false);
	add_image_size('member', 350, 350, true);


	/* hide admin bar */
//	show_admin_bar( false );

	/* Excerpt length */
	if (isset($smof_data['blog_excerpt_length']) AND $smof_data['blog_excerpt_length'] != 55) {
		add_filter( 'excerpt_length', 'us_excerpt_length', 999 );
	}

	/* Remove [...] from excerpt */
	add_filter('excerpt_more', 'us_excerpt_more');

	/* Theme localization */
	load_theme_textdomain( 'us', get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'us_theme_setup' );

//if (!class_exists('WPBakeryVisualComposerAbstract')) {
//    $dir = dirname(__FILE__) . '/wpbakery/';
//    $composer_settings = Array(
//        'APP_ROOT'      => $dir . '/js_composer/',
//        'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
//        'APP_DIR'       => basename( $dir ) . '/js_composer/',
//        'CONFIG'        => $dir . '/js_composer/config/',
//        'ASSETS_DIR'    => 'assets/',
//        'COMPOSER'      => $dir . '/js_composer/composer/',
//        'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
//        'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
//        'USER_DIR_NAME'  => 'vc_templates', /* Path relative to your current theme, where VC should look for new shortcode templates */
//
//        //for which content types Visual Composer should be enabled by default
//        'default_post_types' => Array('page', 'us_portfolio', 'post'),
//    );
//    require_once(get_template_directory().'/wpbakery/js_composer/js_composer.php');
//    $wpVC_setup->init($composer_settings);
//
//    vc_disable_frontend();
//}

if (function_exists('set_revslider_as_theme')) {
    set_revslider_as_theme();
}

if (function_exists('vc_set_as_theme')) {
    vc_set_as_theme();
}

function us_excerpt_length( $length ) {
	global $smof_data;
	return $smof_data['blog_excerpt_length'];
}

function us_excerpt_more( $more ) {
	return '';
}

/* Custom code goes below this line. */

/* Custom code goes above this line. */
