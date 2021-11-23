<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
/*
 *
 * 	Blokco Theme Functions
 * 	------------------------------------------------
 * 	Blokco Framework v1.0
 * 	Copyright blokco  2019 - http://www.imithemes.com/
 *	
 */

/* THEME ACTIVATION
  ================================================== */
if (!function_exists('blokco_theme_activation')) {
	function blokco_theme_activation()
	{
		global $pagenow;
		if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
			#provide hook so themes can execute theme specific functions on activation
			do_action('imic_theme_activation');
		}
	}
	add_action('admin_init', 'blokco_theme_activation');
}
/* MAINTENANCE MODE
  ================================================== */
if (!function_exists('blokco_maintenance_mode')) {
    function blokco_maintenance_mode() {
        $options = get_option('blokco_options');
        $custom_logo = $custom_logo_output = $maintenance_mode = "";
        if ((isset($options['custom_admin_login_logo']))&&(isset($options['custom_admin_login_logo']['url']))) {
            $custom_logo = $options['custom_admin_login_logo']['url'];
        }
        $custom_logo_output = '<img src="' . $custom_logo . '" alt="maintenance" style="margin: 0 auto; display: block;">';
        if (isset($options['enable_maintenance'])) {
            $maintenance_mode = $options['enable_maintenance'];
        } else {
            $maintenance_mode = false;
        }
        if ($maintenance_mode) {
            if (!current_user_can('edit_themes') || !is_user_logged_in()) {
                wp_die($custom_logo_output . '<p style="text-align:center">' . esc_html__('We are currently in maintenance mode, please check back shortly.', 'blokco') . '</p>', esc_html__('Maintenance Mode', 'blokco'));
            }
        }
    }
    add_action('get_header', 'blokco_maintenance_mode');
}
/* CUSTOM LOGIN LOGO
  ================================================== */
if (!function_exists('blokco_custom_login_logo')) {
    function blokco_custom_login_logo() {
        $options = get_option('blokco_options');
        $custom_logo = array('url'=>'');
        if (isset($options['custom_admin_login_logo'])) {
            $custom_logo = $options['custom_admin_login_logo'];
        }
    }
    add_action('login_head', 'blokco_custom_login_logo');
}
/* Start remove for validation */
//Custom CSS Enqueue
if (!function_exists('blokco_custom_style_enqueue')) 
{
	add_action( 'wp_enqueue_scripts', 'blokco_custom_style_enqueue', 9999 );
	function blokco_custom_style_enqueue() 
	{
		$taxp = '1';
		$id = '';
		if(is_home()) 
		{ 
			$id = get_option('page_for_posts'); 
		}
		else 
		{ 
			$id = get_the_ID(); 
		}
		if(is_tax() || is_category() || is_tag() || is_archive())
		{
			$taxp = '';
		} 
		$sidebar_position = get_post_meta($id,'blokco_select_sidebar_position',true);
		if(class_exists('buddypress') && is_buddypress()){
			$component = bp_current_component();
			$bp_pages = get_option( 'bp-pages' );
			$id = $bp_pages[$component];
			$sidebar_position = get_post_meta($id,'blokco_select_sidebar_position',true);
		}
		wp_enqueue_style( 'blokco_dynamic_css', admin_url('admin-ajax.php').'?action=blokco_dynamic_css&taxp='.$taxp.'&pgid='.$id.'&sidebar_pos='.$sidebar_position, '');
	}
	add_action('wp_ajax_blokco_dynamic_css', 'blokco_dynamic_css');
	add_action('wp_ajax_nopriv_blokco_dynamic_css', 'blokco_dynamic_css');
	function blokco_dynamic_css() {
		require_once BLOKCO_FILEPATH.'/assets/css/custom-css.php';
		exit;
	}
}

//Fetch Youtube Video ID
if(!function_exists('blokco_linkifyYouTubeURLs'))
{
function blokco_linkifyYouTubeURLs($text) {
    $text = preg_replace('~
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://         # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube         # or youtube.com or
          (?:-nocookie)?  # youtube-nocookie.com
          \.com           # followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\s-]       # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w.-]*    # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w.-]*        # Consume any URL (query) remainder.
        ~ix', 
        '$1',
        $text);
    return $text;
}
}
/* VIDEO EMBED FUNCTIONS
  ================================================== */
if (!function_exists('blokco_video_embed')) {
    function blokco_video_embed($url, $width = 500, $height = 300) {
        if (strpos($url, 'youtube') || strpos($url, 'youtu.be')) {
            return blokco_video_youtube($url, $width, $height);
        } else {
            return blokco_video_vimeo($url, $width, $height);
        }
    }
}
/* Video Youtube
  ================================================== */
if (!function_exists('blokco_video_youtube')) {
    function blokco_video_youtube($url, $width = 560, $height = 315) {
		if($url!='') {
        $video_id = blokco_linkifyYouTubeURLs($url);
			return '<iframe itemprop="video" src="//www.youtube.com/embed/' . $video_id . '?wmode=transparent&autoplay=0" width="' . $width . '" height="' . $height . '" ></iframe>';
		}
   }
}
/* Video Vimeo
  ================================================== */
if (!function_exists('blokco_video_vimeo')) {
   function blokco_video_vimeo($url, $width = 500, $height = 315) {
	   if($url!='') {
        preg_match('/https?:\/\/vimeo.com\/(\d+)$/', $url, $video_id);
        return '<iframe src="//player.vimeo.com/video/' . $video_id[1] . '?title=0&amp;byline=0&amp;autoplay=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe>'; }
    }
}
/* REGISTER SIDEBARS
  ================================================== */
if (!function_exists('blokco_widgets_init')) {
    function blokco_widgets_init() {
		$options = get_option('blokco_options');
		$topbar_class = (isset($options["topbar_layout"]))?$options["topbar_layout"]:'3';
		$footer_class = (isset($options["footer_layout"]))?$options["footer_layout"]:'4';
		register_sidebar(array(
			'name' => esc_html__('Blog Sidebar', 'blokco'),
			'id' => 'blog-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			'name' => esc_html__('Page Sidebar', 'blokco'),
			'id' => 'page-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			'name' => esc_html__('Services Page', 'blokco'),
			'id' => 'services-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div class="widget sidebar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			'name' => esc_html__('Projects Page', 'blokco'),
			'id' => 'projects-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div class="widget sidebar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			'name' => esc_html__('Team Page', 'blokco'),
			'id' => 'team-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div class="widget sidebar %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			'name' => esc_html__('Shop Sidebar', 'blokco'),
			'id' => 'shop-sidebar',
			'description' => '',
			'class' => '',
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		));
		for ( $footer = 1; $footer < 5; $footer ++ ) {
			register_sidebar( array(
				'id'            => 'blokco-footer-' . $footer,
				'name'          => esc_html__( 'Footer widgets ', 'blokco' ) . $footer,
				'before_widget' => '<div id="%1$s" class="footer_widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="footer-widgettitle">',
				'after_title'   => '</h4>',
			) );
		}
	}
}
add_action( 'widgets_init', 'blokco_widgets_init', 50 );
//Get all Sidebars
if (!function_exists('blokco_get_all_sidebars')) {
    function blokco_get_all_sidebars() {
        $all_sidebars = array();
        global $wp_registered_sidebars;
        $all_sidebars = array('' => '');
        foreach ($wp_registered_sidebars as $sidebar) {
            $all_sidebars[$sidebar['id']] = $sidebar['name'];
        }
        return $all_sidebars;
    }
}
//Meta Box for Sidebar on all Posts/Page
if (!function_exists('blokco_register_meta_box')) {
    add_action('admin_init', 'blokco_register_meta_box');
    function blokco_register_meta_box() {
        // Check if plugin is activated or included in theme
        if (!class_exists('RW_Meta_Box'))
            return;
        $prefix = 'blokco_';
        $meta_box = array(
            'id' => 'template-sidebar1',
            'title' => esc_html__("Select Sidebar", 'blokco'),
            'pages' => array('post', 'page', 'imi_projects', 'imi_team', 'imi_services','eventer'),
            'context' => 'normal',
            'fields' => array(
                array(
                    'name' => esc_html__('Select Sidebar from list','blokco'),
                    'id' => $prefix . 'select_sidebar_from_list',
                    'desc' => esc_html__("Select Sidebar from list, if using page builder then please add sidebar from element only.", 'blokco'),
                    'type' => 'select',
                    'options' => blokco_get_all_sidebars(),
                ),
                array(
                    'name' => esc_html__('Show no sidebar','blokco'),
                    'id' => $prefix . 'strict_no_sidebar',
                    'desc' => esc_html__("This will dishonour page sidebar chosen at Theme Options as well.", 'blokco'),
                    'type' => 'checkbox',
					'default' => 0
                ),
                array(
                    'name' => esc_html__('Select Sidebar Position','blokco'),
                    'id' => $prefix . 'select_sidebar_position',
                    'desc' => esc_html__("Select Sidebar Postion", 'blokco'),
                    'type' => 'radio',
                    'options' => array(
						'2' => esc_html__('Left','blokco'),
						'1' => esc_html__('Right','blokco')
					),
					'default' => '1'
                ),
				array(
					'name' => esc_html__('Sidebar Width', 'blokco'),
					'id' => $prefix . 'sidebar_columns_layout',
					'desc' => esc_html__("Select width of the page sidebar", 'blokco'),
					'type' => 'select',
					'options' => array(
						'4' => esc_html__('One Third','blokco'),
						'3' => esc_html__('One Fourth', 'blokco'),
						'6' => esc_html__('Half','blokco'),
							),
					'default' => '4',
			),
            )
        );
        new RW_Meta_Box($meta_box);
    }
}
//Get all Menus
if (!function_exists('blokco_get_all_menus')) {
    function blokco_get_all_menus() {
		$all_menus = array();
    	$all_menu = wp_get_nav_menus();
		foreach ( $all_menu as $menu ) {
			$all_menus[$menu->slug] = $menu->name;
		}
		return $all_menus;
    }
}
//Meta Box for Menu on One Page Template
if (!function_exists('blokco_register_menu_meta_box')) {
    add_action('admin_init', 'blokco_register_menu_meta_box');
    function blokco_register_menu_meta_box() {
        // Check if plugin is activated or included in theme
        if (!class_exists('RW_Meta_Box'))
            return;
        $prefix = 'blokco_';
        $meta_box = array(
            'id' => 'template-one-page',
            'title' => esc_html__("One Page Menu", 'blokco'),
            'pages' => array('page'),
			'show'   => array(
				'template' => array( 'template-onepage.php' ),
			),
            'context' => 'normal',
            'fields' => array(
                array(
                    'name' => esc_html__('Select Menu from list','blokco'),
                    'id' => $prefix . 'select_menu_from_list',
                    'desc' => esc_html__('Select the menu from the list to use as this One Page menu. Your primary menu will be replaced by this selected menu on this page only and will be used as one page scroller. The pages added to the selected menu will be used as content of the one page website.', 'blokco'),
                    'type' => 'select',
                    'options' => blokco_get_all_menus(),
                ),
            )
        );
        new RW_Meta_Box($meta_box);
    }
}
/** -------------------------------------------------------------------------------------
 * Gallery Flexslider
 * @param ID of current Post.
 * @return Div with flexslider parameter.
  ----------------------------------------------------------------------------------- */
if (!function_exists('blokco_gallery_flexslider')) {
    function cblokco_gallery_flexslider($id) {
		$speed = (get_post_meta(get_the_ID(), 'blokco_gallery_slider_speed', true)!='')?get_post_meta(get_the_ID(), 'blokco_gallery_slider_speed', true):5000;
        $pagination = get_post_meta(get_the_ID(), 'blokco_gallery_slider_pagination', true);
        $auto_slide = get_post_meta(get_the_ID(), 'blokco_gallery_slider_auto_slide', true);
        $direction = get_post_meta(get_the_ID(), 'blokco_gallery_slider_direction_arrows', true);
        $effect = get_post_meta(get_the_ID(), 'blokco_gallery_slider_effects', true);
        $pagination = !empty($pagination) ? $pagination : 'yes';
        $auto_slide = !empty($auto_slide) ? $auto_slide : 'yes';
        $direction = !empty($direction) ? $direction : 'yes';
        $effect = !empty($effect) ? $effect : 'slide';
        return '<div class="flexslider galleryflex" data-autoplay="' . $auto_slide . '" data-pagination="' . $pagination . '" data-arrows="' . $direction . '" data-style="' . $effect . '" data-pause="yes" data-speed='.$speed.'>';
    }
}
/*======================
Change Excerpt Length*/
if (!function_exists('blokco_custom_excerpt_length')) {
	function blokco_custom_excerpt_length( $length ) {
		return 520;
	}
	add_filter( 'excerpt_length', 'blokco_custom_excerpt_length', 999 );
}
//Attachment Meta Box
if(!function_exists('blokco_attachment_url')){
	function blokco_attachment_url( $fields, $post ) {
		$meta = get_post_meta($post->ID, 'meta_link', true);
		$fields['meta_link'] = array(
			'label' => esc_html__('Image URL','blokco'),
			'input' => 'text',
			'value' => $meta,
			'show_in_edit' => true,
		);
		return $fields;
	}
	add_filter( 'attachment_fields_to_edit', 'blokco_attachment_url', 10, 2 );
}
/**
* Update custom field on save
*/
if(!function_exists('blokco_update_attachment_url')){
	function blokco_update_attachment_url($attachment){
		global $post;
		update_post_meta($post->ID, 'meta_link', $attachment['attachments'][$post->ID]['meta_link']);
		return $attachment;
	}
	add_filter( 'attachment_fields_to_save', 'blokco_update_attachment_url', 4);
}
/**
* Update custom field via ajax
*/
if(!function_exists('blokco_save_attachment_url')){
	function blokco_save_attachment_url() {
		$post_id = $_POST['id'];
		$meta = $_POST['attachments'][$post_id ]['meta_link'];
		update_post_meta($post_id , 'meta_link', $meta);
		clean_post_cache($post_id);
	}
	add_action('wp_ajax_save-attachment-compat', 'blokco_save_attachment_url', 0, 1);
}
//Attachment Meta Box
if(!function_exists('blokco_attachment_postid')){
	function blokco_attachment_postid( $fields, $post ) {
		$meta = get_post_meta($post->ID, 'meta_postid', true);
		$fields['meta_postid'] = array(
			'label' => esc_html__('Post ID','blokco'),
			'input' => 'text',
			'value' => $meta,
			'show_in_edit' => true,
		);
		return $fields;
	}
	add_filter( 'attachment_fields_to_edit', 'blokco_attachment_postid', 10, 2 );
}
/**
* Update custom field on save
*/
if(!function_exists('blokco_update_attachment_postid')){
	function blokco_update_attachment_postid($attachment){
		global $post;
		update_post_meta($post->ID, 'meta_postid', $attachment['attachments'][$post->ID]['meta_postid']);
		return $attachment;
	}
	add_filter( 'attachment_fields_to_save', 'blokco_update_attachment_postid', 4);
}
/**
* Update custom field via ajax
*/
if(!function_exists('blokco_save_attachment_postid')){
	function blokco_save_attachment_postid() {
		$post_id = $_POST['id'];
		$meta = $_POST['attachments'][$post_id ]['meta_postid'];
		update_post_meta($post_id , 'meta_postid', $meta);
		clean_post_cache($post_id);
	}
	add_action('wp_ajax_save-attachment-compat', 'blokco_save_attachment_postid', 0, 1);
}
//Get Attachment details
if (!function_exists('blokco_wp_get_attachment')) {
	function blokco_wp_get_attachment( $attachment_id ) {
		$attachment = get_post( $attachment_id );
		if(!empty($attachment)) {
			return array(
				'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'caption' => $attachment->post_excerpt,
				'description' => $attachment->post_content,
				'href' => get_permalink( $attachment->ID ),
				'src' => $attachment->guid,
				'title' => $attachment->post_title,
				'url' => $attachment->meta_link,
				'postid' => $attachment->meta_postid
			);
		}
	}
}
if(!function_exists('blokco_get_post_content')){
	function blokco_get_post_content($update_id, $filter='', $limit='25'){
		$post_id = get_post($update_id);
		$content = $post_id->post_content;
		if($filter=='1')
		{
			$excerpt = apply_filters('the_content', $content);
		}
		else
		{
			$excerpt = wp_trim_words($content, $limit);
		}
		return $excerpt;
	}
}
/* Add Class to Next/Previous Posts Link
========================================================= */
add_filter('next_posts_link_attributes', 'blokco_older_posts_link');
add_filter('previous_posts_link_attributes', 'blokco_newer_posts_link');

function blokco_older_posts_link() {
    return 'class="pull-left"';
}
function blokco_newer_posts_link() {
    return 'class="pull-right"';
}
add_filter('next_post_link', 'blokco_post_link_attributes_next');
add_filter('previous_post_link', 'blokco_post_link_attributes_prev');
 
function blokco_post_link_attributes_prev($output) {
    $code = 'class="pull-left"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
function blokco_post_link_attributes_next($output) {
    $code = 'class="pull-right"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
//Get All Post Types
if(!function_exists('blokco_get_all_types')){
add_action( 'wp_loaded', 'blokco_get_all_types');
function blokco_get_all_types(){
   $args = array(
   'public'   => true,
   );
$output = 'names'; // names or objects, note names is the default
return $post_types = get_post_types($args, $output); 
}
}
function blokco_post_excerpt_by_id( $post_id ) {
    global $post;
    $post = get_post( $post_id );
    setup_postdata( $post );
    $the_excerpt = get_the_excerpt();
    wp_reset_postdata();
    return $the_excerpt;
}
/* -------------------------------------------------------------------------------------
  RevSlider ShortCode
  ----------------------------------------------------------------------------------- */
if(!function_exists('blokco_RevSliderShortCode')){
	function blokco_RevSliderShortCode(){
    	$slidernames = array();
        if(class_exists('RevSlider')){
            $sld = new RevSlider();
            $sliders = $sld->getArrSliders();
            if(!empty($sliders)){
                foreach($sliders as $slider){
                    $title = $slider->title;
                    $slidernames[esc_attr($slider->id)] = $title;
                }
            }
        }
        return $slidernames;
    }
}
 /**
 * BLOKCO SEARCH BUTTON
 */
if(!function_exists('blokco_search_button_header')){
	function blokco_search_button_header(){
		global $options;
		$search_form_style = (isset($options['search_form_style']) && $options['search_form_style'] != '')?$options['search_form_style']:'0';
		$mobile_header_search = (isset($options['mobile_header_search']) && $options['mobile_header_search'] != '')?$options['mobile_header_search']:0;
		if($search_form_style == '0'){
			echo '<div class="sitewide-search dd-search search-module header-equaler"><div><div>
					<a href="#" class="search-module-trigger"><i class="fa fa-search"></i></a>
					<div class="search-module-opened">';
						 get_search_form();
					echo '</div></div></div></div>';
		} elseif($search_form_style == '1'){
			echo '<div class="sitewide-search open-search-form header-equaler"><div><div>';
				get_search_form();
			echo '</div></div></div>';
		} else {
			echo '<div class="sitewide-search overlay-search-form search-module header-equaler"><div><div>
				  <a href="#" class="search-module-trigger"><i class="fa fa-search"></i></a></div></div></div>';
		}
		
		if($mobile_header_search != 0){
			echo '<div class="mobile-search dd-search search-module header-equaler"><div><div>
					<a href="#" class="search-module-trigger"><i class="fa fa-search"></i></a>
					<div class="search-module-opened">';
						 get_search_form();
					echo '</div></div></div></div>';
		}
	}
}
 /**
 * BLOKCO CART BUTTON
 */

if(!function_exists('blokco_cart_button_header')){
function blokco_cart_button_header(){
		if(class_exists('Woocommerce')):
			$wcurrency = get_woocommerce_currency_symbol();
			 ?>
			<div class="cart-module header-equaler"><div><div>
				<a href="#" class="cart-module-trigger" id="cart-module-trigger"><i class="fa fa-shopping-cart"></i><span class="cart-tquant">

						<span class="cart-contents">
						</span>
					</span></a>
				<div class="cart-module-opened">
					<div class="cart-module-items">

						<div class="header-quickcart"></div>

					</div>
				</div>
			</div></div></div>
		<?php endif;
	}
}
/* Removing Redux framework pages */
if(!function_exists('blokco_remove_redux_menu')){
	add_action( 'admin_menu', 'blokco_remove_redux_menu',12 );
   	function blokco_remove_redux_menu() {
   		remove_submenu_page('tools.php','redux-about');
    }
}

// Random ID Generator
if(!function_exists('blokco_mapRandomId')){
	function blokco_mapRandomId($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

$default_attribs = array('data-skin' => array(),'data-layout' => array(),'name' => array(),'action' => array(),'method' => array(),'type' => array(),'placeholder' => array(),'data-padding' => array(),'data-margin' => array(),'data-autoplay-timeout' => array(),'data-loop' => array(),'data-rtl' => array(),'data-auto-height' => array(),'data-displayinput' => array(), 'data-readonly' => array(), 'value' => array(), 'data-fgcolor' => array(), 'data-bgcolor' => array(), 'data-thickness' => array(), 'data-linecap' => array(), 'data-option-value' => array(), 'data-style' => array(), 'data-pause' => array(), 'data-speed' => array(), 'data-option-key' => array(), 'data-sort-id' => array(),'href' => array(),'rel' => array(),'data-appear-progress-animation' => array(),'data-appear-animation-delay' => array(), 'target' => array('_blank','_self','_top'), 'data-items-mobile' => array(), 'data-items-tablet' => array(), 'data-items-desktop-small' => array(), 'data-items-desktop' => array(), 'data-single-item' => array(), 'data-arrows' => array(), 'data-pagination' => array(), 'data-autoplay' => array(), 'data-columns' => array(), 'data-columns-tab' => array(), 'data-columns-mobile' => array(), 'width' => array(), 'data-srcset' => array(), 'height' => array(), 'src' => array(), 'id' => array(), 'class' => array(), 'title' => array(), 'style' => array(), 'alt' => array(), 'data' => array(), 'data-mce-id' => array(), 'data-mce-style' => array(), 'data-mce-bogus' => array());

$blokco_allowed_tags = array(
	'div'           => $default_attribs,
	'span'          => $default_attribs,
	'p'             => $default_attribs,
	'a'             => $default_attribs,
	'u'             => $default_attribs,
	'i'             => $default_attribs,
	'q'             => $default_attribs,
	'b'             => $default_attribs,
	'ul'            => $default_attribs,
	'ol'            => $default_attribs,
	'li'            => $default_attribs,
	'br'            => $default_attribs,
	'hr'            => $default_attribs,
	'strong'        => $default_attribs,
	'blockquote'    => $default_attribs,
	'del'           => $default_attribs,
	'strike'        => $default_attribs,
	'em'            => $default_attribs,
	'code'          => $default_attribs,
	'h1'            => $default_attribs,
	'h2'            => $default_attribs,
	'h3'            => $default_attribs,
	'h4'            => $default_attribs,
	'h5'            => $default_attribs,
	'h6'            => $default_attribs,
	'cite'          => $default_attribs,
	'img'           => $default_attribs,
	'section'       => $default_attribs,
	'iframe'        => $default_attribs,
	'input'         => $default_attribs,
	'label'         => $default_attribs,
	'canvas'        => $default_attribs,
	'form'        	=> $default_attribs,
	'sub'        	=> $default_attribs,
	'sup'        	=> $default_attribs,
);
$blokco_btn_allowed_tags = array(
	'span'          => $default_attribs,
	'u'             => $default_attribs,
	'i'             => $default_attribs,
	'b'             => $default_attribs,
	'br'            => $default_attribs,
	'strong'        => $default_attribs,
	'del'           => $default_attribs,
	'strike'        => $default_attribs,
	'em'            => $default_attribs,
	'img'           => $default_attribs,
);
?>