<?php
if (!defined('ABSPATH'))
exit; // Exit if accessed directly 
/*
* Here you include files which is required by theme
*/


/* META BOX FRAMEWORK
================================================== */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
require_once BLOKCO_FILEPATH . '/welcome.php';
/* THEME FUNCTIONS
================================================== */
require_once BLOKCO_FILEPATH. '/framework/theme-functions.php';
/* META BOX FRAMEWORK
================================================== */
require_once BLOKCO_FILEPATH. '/framework/meta-boxes.php';

/* VISUAL COMPOSER INCLUDE
================================================== */
require_once BLOKCO_FILEPATH. '/framework/visual_composer.php';

/* PLUGIN INCLUDES
================================================== */
require_once BLOKCO_FILEPATH. '/framework/tgm/plugin-includes.php';

/* LOAD STYLESHEETS
================================================== */
if (!function_exists('blokco_enqueue_styles')) {
	function blokco_enqueue_styles() {
		$options = get_option('blokco_options');
		$switch_responsive = (isset($options['switch-responsive']))?$options['switch-responsive']:1;
		$theme_info = wp_get_theme();
		$theme_color_scheme = (isset($options['theme_color_scheme']))?$options['theme_color_scheme']:'color1.css';
		$enable_preloader = (isset($options['enable_preloader']))?$options['enable_preloader']:1;
		$preloader_style = (isset($options['preloader_style']))?$options['preloader_style']:'center-circle';
		$blog_id = get_current_blog_id();
			wp_enqueue_style('bootstrap-grid', BLOKCO_THEME_PATH . '/assets/css/bootstrap-grid.css', array(), $theme_info->get( 'Version' ), 'all');
			if($enable_preloader == 1 && $preloader_style != ''){
				wp_enqueue_style('pace-preloader-style', BLOKCO_THEME_PATH . '/assets/css/preloaders/'.esc_attr($preloader_style).'.css', array(), $theme_info->get( 'Version' ), 'all');
			}
			wp_enqueue_style('blokco-main', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ), 'all');
			wp_enqueue_style('fontawesome-icons', BLOKCO_THEME_PATH . '/assets/css/font-awesome.min.css', array(), $theme_info->get( 'Version' ), 'all');
			if ($switch_responsive == 1 || $switch_responsive == ''){
				wp_enqueue_style('responsive-media', BLOKCO_THEME_PATH . '/assets/css/responsive.css', array(), $theme_info->get( 'Version' ), 'all');
			}
        	wp_enqueue_style('magnific-css', BLOKCO_THEME_PATH . '/assets/vendor/magnific/magnific-popup.css', array(), $theme_info->get( 'Version' ), 'all');
			if (isset($options['theme_color_type'])&&$options['theme_color_type'] == 0) {
				wp_enqueue_style('blokco-colors', BLOKCO_THEME_PATH . '/assets/colors/' . $theme_color_scheme, array(), $theme_info->get( 'Version' ), 'all');
			} elseif (!isset($options['theme_color_type'])) {
				wp_enqueue_style('blokco-colors', BLOKCO_THEME_PATH . '/assets/colors/color1.css', array(), $theme_info->get( 'Version' ), 'all');
			}
			wp_enqueue_style('blokco-custom-options-style', BLOKCO_THEME_PATH . '/assets/css/custom-option_'.$blog_id.'.css', array(), $theme_info->get( 'Version' ), 'all');
			//**End Enqueue STYLESHEETPATH**//
		}
		add_action('wp_enqueue_scripts', 'blokco_enqueue_styles', 999);
}
if (!function_exists('blokco_enqueue_scripts')) {
    function blokco_enqueue_scripts() {
      	$options = get_option('blokco_options');
		$theme_info = wp_get_theme();
		$custom_js = (isset($options['custom_js']))?$options['custom_js']:'';
		$enable_preloader = (isset($options['enable_preloader']))?$options['enable_preloader']:1;
        //**register script**//
		wp_enqueue_script('modernizr', BLOKCO_THEME_PATH . '/assets/js/modernizr.js', array('jquery'), $theme_info->get( 'Version' ), false);
		wp_enqueue_script('waypoints', BLOKCO_THEME_PATH . '/assets/js/waypoints.js', array('jquery'), $theme_info->get( 'Version' ), false);
		wp_enqueue_script('magnific-js', BLOKCO_THEME_PATH . '/assets/vendor/magnific/jquery.magnific-popup.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('tinynav-js', BLOKCO_THEME_PATH . '/assets/js/jquery-tinynav.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('scrollto-js', BLOKCO_THEME_PATH . '/assets/js/jquery.scrollto.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('matchheight-js', BLOKCO_THEME_PATH . '/assets/js/jquery.matchheight.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('fitvids-js', BLOKCO_THEME_PATH . '/assets/js/jquery.fitvids.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('isotope-js', BLOKCO_THEME_PATH . '/assets/js/jquery.isotope.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('sticky-js', BLOKCO_THEME_PATH . '/assets/js/jquery.sticky.plugin.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('superfish-menu-js', BLOKCO_THEME_PATH . '/assets/js/jquery.superfish.menu.js', array('jquery'), $theme_info->get( 'Version' ), true);
		wp_enqueue_script('blokco-js-init', BLOKCO_THEME_PATH . '/assets/js/init.js', array('jquery'), $theme_info->get( 'Version' ), true);
		if($enable_preloader == 1){
			wp_enqueue_script('pace-preloader', BLOKCO_THEME_PATH . '/assets/js/pace-loader.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		}
		wp_add_inline_script('blokco-js-init', $custom_js);
		$site_width = (isset($options['site_width']))?$options['site_width']:1170;
		$topbarwidgets = (isset($options['topbar_opener_dimension']))?$options['topbar_opener_dimension']['width']:'400px';
		$enable_sticky_header = (isset($options['enable_sticky_header']) && $options['enable_sticky_header'] != '')?$options['enable_sticky_header']:1;
		wp_localize_script('blokco-js-init', 'imi_local', array('homeurl' => get_template_directory_uri(), 'sticky_header' => $enable_sticky_header, 'siteWidth' => $site_width, 'topbar_widgets' => $topbarwidgets));
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'blokco_enqueue_scripts');
}
/* LOAD BACKEND SCRIPTS
  ================================================== */
function blokco_admin_scripts() 
{
	$theme_info = wp_get_theme();
 	wp_enqueue_script('blokco-admin-functions', BLOKCO_THEME_PATH . '/assets/js/admin_scripts.js', array('jquery'), $theme_info->get( 'Version' ), true);
    if (!class_exists('IMI_Admin')) {
	   wp_enqueue_script('blokco-admin-scripts-new', BLOKCO_THEME_PATH . '/assets/js/imi-plugins.js', 'jquery', null, true);
	   wp_localize_script('blokco-admin-scripts-new', 'vals', array('siteurl' => esc_url(site_url('wp-admin/admin.php?page=imi-admin-welcome'))));
	   wp_enqueue_style('blokco-admin-style', BLOKCO_THEME_PATH . '/assets/css/admin-pages.css', array(), '1.0', 'all');
    }
}
add_action('admin_init', 'blokco_admin_scripts');
?>