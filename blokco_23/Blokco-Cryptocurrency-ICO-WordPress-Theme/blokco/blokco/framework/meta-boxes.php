<?php
/* * ** Meta Box Functions **** */
$prefix = 'blokco_';
global $meta_boxes;
$options = get_option('blokco_options');
$gmap_api_key = (isset($options['google_map_api']))?$options['google_map_api']:'';
load_theme_textdomain('blokco', BLOKCO_FILEPATH . '/language');
/* FONT AWESOME DATA IN PHP
================================================== */
require_once BLOKCO_FILEPATH . '/framework/font-awesome.php';
$meta_boxes = array();
//Page Design Meta Box
$meta_boxes[] = array(
	'title'       => esc_html__( 'Page Design Options', 'blokco' ),
	'tabs'      => array(
		'layout'    => array(
			'label' => esc_html__( 'Layout', 'blokco' ),
		),
		'header'    => array(
			'label' => esc_html__( 'Header', 'blokco' ),
		),
		'page_header'  => array(
			'label' => esc_html__( 'Page Header', 'blokco' ),
		),
		'page_title'  => array(
			'label' => esc_html__( 'Page Title', 'blokco' ),
		),
		'page_content' => array(
			'label' => esc_html__( 'Content', 'blokco' ),
		),
		'social_share'    => array(
			'label' => esc_html__( 'Social Sharing', 'blokco' ),
		),
	),
	// Tab style: 'default', 'box' or 'left'. Optional
	'tab_style' => 'left',
	// Show meta box wrapper around tabs? true (default) or false. Optional
	'tab_wrapper' => true,
   	'pages' => array('post','page','imi_team','imi_projects','imi_services','product','eventer'),
	'fields'    => array(
		array(
            'name' => esc_html__('Standard Logo', 'blokco'),
            'id' => $prefix . 'page_logo',
            'desc' => esc_html__("Upload logo image to show on this page.", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'header',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('Retina Logo', 'blokco'),
            'id' => $prefix . 'page_logo_retina',
            'desc' => esc_html__("Retina Display is a marketing term developed by Apple to refer to devices and monitors that have a resolution and pixel density so high &ndash; roughly 300 or more pixels per inch.", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'header',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('Standard Logo Width for Retina Logo', 'blokco'),
            'desc' => esc_html__("If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width.", 'blokco'),
            'id' => $prefix . 'page_logo_retina_width',
            'type' => 'text',
			'tab'  => 'header',
		),
		array(
            'name' => esc_html__('Standard Logo Height for Retina Logo', 'blokco'),
            'desc' => esc_html__("If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height.", 'blokco'),
            'id' => $prefix . 'page_logo_retina_height',
            'type' => 'text',
			'tab'  => 'header',
		),
		array(
            'name' => esc_html__('Topbar Show/Hide', 'blokco'),
            'id' => $prefix . 'page_topbar_show',
            'type' => 'select',
			'tab'  => 'header',
            'options' => array(
                1 => esc_html__('Show', 'blokco'),
                0 => esc_html__('Hide', 'blokco'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Page layout', 'blokco'),
            'id' => $prefix . 'page_layout',
            'desc' => esc_html__("Select layout for the page.", 'blokco'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
				'' => esc_html__('Theme Default', 'blokco'),
				'full-width-page' => esc_html__('Full Width', 'blokco'),
				'boxed' => esc_html__('Boxed', 'blokco'),
            )
        ),
		array(
            'name' => esc_html__('Content Width', 'blokco'),
            'desc' => esc_html__("Enter width of content in px or %", 'blokco'),
            'id' => $prefix . 'content_width',
            'type' => 'text',
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Content Padding Top', 'blokco'),
            'id' => $prefix . 'content_padding_top',
            'type' => 'number',
            'std' => 60,
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Content Padding Bottom', 'blokco'),
            'id' => $prefix . 'content_padding_bottom',
            'type' => 'number',
            'std' => '60',
			'tab'  => 'page_content',
		),
		array(
            'name' => esc_html__('Background Color', 'blokco'),
            'id' => $prefix . 'pages_body_bg_color',
            'desc' => esc_html__("Choose background color for the outer area", 'blokco'),
            'type' => 'color',
			'tab'  => 'layout',
			'visible' => array( 'blokco_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Image', 'blokco'),
            'id' => $prefix . 'pages_body_bg_image',
            'desc' => esc_html__("Choose background image for the outer area", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'layout',
            'max_file_uploads' => 1,
			'visible' => array( 'blokco_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('100% Background Image', 'blokco'),
            'id' => $prefix . 'pages_body_bg_wide',
            'desc' => esc_html__("Choose to have the background image display at 100%.", 'blokco'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
                '1' => esc_html__('Yes', 'blokco'),
                '0' => esc_html__('No', 'blokco'),
            ),
            'std' => 0,
			'visible' => array( 'blokco_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Repeat', 'blokco'),
            'id' => $prefix . 'pages_body_bg_repeat',
            'desc' => esc_html__("Select how the background image repeats.", 'blokco'),
            'type' => 'select',
			'tab'  => 'layout',
            'options' => array(
                'repeat' => esc_html__('Repeat', 'blokco'),
                'repeat-x' => esc_html__('Repeat Horizontally', 'blokco'),
                'repeat-y' => esc_html__('Repeat Vertically', 'blokco'),
                'no-repeat' => esc_html__('No Repeat', 'blokco'),
            ),
            'std' => 'repeat',
			'visible' => array( 'blokco_page_layout', '=', 'boxed' )
        ),
		array(
            'name' => esc_html__('Background Color', 'blokco'),
            'id' => $prefix . 'pages_content_bg_color',
            'desc' => esc_html__("Choose background color for the Content area", 'blokco'),
            'type' => 'color',
			'tab'  => 'page_content',
        ),
		array(
            'name' => esc_html__('Background Image', 'blokco'),
            'id' => $prefix . 'pages_content_bg_image',
            'desc' => esc_html__("Choose background image for the Content area", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'page_content',
            'max_file_uploads' => 1
        ),
		array(
            'name' => esc_html__('100% Background Image', 'blokco'),
            'id' => $prefix . 'pages_content_bg_wide',
            'desc' => esc_html__("Choose to have the background image display at 100%.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_content',
            'options' => array(
                1 => esc_html__('Yes', 'blokco'),
                0 => esc_html__('No', 'blokco'),
            ),
            'std' => 0,
        ),
		array(
            'name' => esc_html__('Background Repeat', 'blokco'),
            'id' => $prefix . 'pages_content_bg_repeat',
            'desc' => esc_html__("Select how the background image repeats.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_content',
            'options' => array(
                'repeat' => esc_html__('Repeat', 'blokco'),
                'repeat-x' => esc_html__('Repeat Horizontally', 'blokco'),
                'repeat-y' => esc_html__('Repeat Vertically', 'blokco'),
                'no-repeat' => esc_html__('No Repeat', 'blokco'),
            ),
            'std' => 'repeat',
        ),
		array(
            'name' => esc_html__('Page Header Show/Hide', 'blokco'),
            'id' => $prefix . 'page_header_show',
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                1 => esc_html__('Show', 'blokco'),
                0 => esc_html__('Hide', 'blokco'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Choose Header Type', 'blokco'),
            'id' => $prefix . 'pages_Choose_slider_display',
            'desc' => esc_html__("Select Banner Type.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
				1 => esc_html__('Colored Banner', 'blokco'),
				2 => esc_html__('Image Banner', 'blokco'),
                4 => esc_html__('Flex Slider', 'blokco'),
                5 => esc_html__('Revolution Slider', 'blokco'),
            ),
			'std' => 2,
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
        ),
		array(
			'name' => esc_html__( 'Banner Color', 'blokco' ),
			'id' => $prefix.'pages_banner_color',
			'type' => 'color',
			'tab'  => 'page_header',
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '1' ),
		),
		array(
            'name' => esc_html__('Use featured image as page banner', 'blokco'),
            'id' => $prefix . 'featured_image_banner',
            'desc' => esc_html__("If checked then your page/post featured image will be used as it's page header banner image. Uncheck to upload your own new image for the page header banner.", 'blokco'),
            'type' => 'checkbox',
			'tab'  => 'page_header',
			'std'  => 0,
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '2' ),
        ),
		array(
            'name' => esc_html__('Banner Image', 'blokco'),
            'id' => $prefix . 'header_image',
            'desc' => esc_html__("Upload banner image for header for this Page/Post.", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'page_header',
            'max_file_uploads' => 1,
			'hidden' => array( 'blokco_featured_image_banner', true ),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '2' ),
        ),
		array(
            'name' => esc_html__('Banner image overlay', 'blokco'),
            'id' => $prefix . 'header_image_overlay',
            'desc' => esc_html__("Choose over color for Image banner.", 'blokco'),
            'type' => 'color',
			'tab'  => 'page_header',
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'hidden' => array( 'blokco_pages_Choose_slider_display', 'between', [3,5] ),
        ),
		array(
            'name' => esc_html__('Banner image overlay opacity', 'blokco'),
            'id' => $prefix . 'header_image_overlay_opacity',
            'desc' => esc_html__("Enter value for opacity of banner image overlay. Enter value between 0.1 to 1.", 'blokco'),
            'type' => 'text',
			'tab'  => 'page_header',
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'hidden' => array( 'blokco_pages_Choose_slider_display', 'between', [3,5] ),
        ),
        array(
		   'name' => esc_html__('Select Revolution Slider from list','blokco'),
			'id' => $prefix . 'pages_select_revolution_from_list',
			'desc' => esc_html__("Select Revolution Slider from list", 'blokco'),
			'type' => 'select',
			'tab'  => 'page_header',
			'options' => blokco_RevSliderShortCode(),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '5' ),
		),
        //Slider Images
        array(
            'name' => esc_html__('Slider Images', 'blokco'),
            'id' => $prefix . 'pages_slider_image',
            'desc' => esc_html__("Upload/select slider images.", 'blokco'),
            'type' => 'image_advanced',
			'tab'  => 'page_header',
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Pagination', 'blokco'),
            'id' => $prefix . 'pages_slider_pagination',
            'desc' => esc_html__("Enable to show pagination for slider.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Enable', 'blokco'),
                'no' => esc_html__('Disable', 'blokco'),
            ),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Auto Slide', 'blokco'),
            'id' => $prefix . 'pages_slider_auto_slide',
            'desc' => esc_html__("Select Yes to slide automatically.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Yes', 'blokco'),
                'no' => esc_html__('No', 'blokco'),
            ),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Direction Arrows', 'blokco'),
            'id' => $prefix . 'pages_slider_direction_arrows',
            'desc' => esc_html__("Select Yes to show slider direction arrows.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'yes' => esc_html__('Yes', 'blokco'),
                'no' => esc_html__('No', 'blokco'),
            ),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Slider Effects', 'blokco'),
            'id' => $prefix . 'pages_slider_effects',
            'desc' => esc_html__("Select effects for slider.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_header',
            'options' => array(
                'fade' => esc_html__('Fade', 'blokco'),
                'slide' => esc_html__('Slide', 'blokco'),
            ),
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'visible' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
        ),
		array(
            'name' => esc_html__('Banner/Slider Height', 'blokco'),
            'id' => $prefix . 'pages_slider_height',
            'desc' => esc_html__("Enter Height for Banner/Slider Ex-250. DO NOT ENTER px HERE", 'blokco'),
            'type' => 'text',
			'tab'  => 'page_header',
			'visible' => array( 'blokco_page_header_show', '=', '1' ),
			'hidden' => array( 'blokco_pages_Choose_slider_display', '=', '4' ),
			'hidden' => array( 'blokco_pages_Choose_slider_display', '=', '5' ),
        ),
		array(
            'name' => esc_html__('Page Title Show/Hide', 'blokco'),
            'id' => $prefix . 'pages_title_show',
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
                1 => esc_html__('Show', 'blokco'),
                0 => esc_html__('Hide', 'blokco'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Page Title Text Color', 'blokco'),
            'id' => $prefix . 'pages_banner_text_color',
            'desc' => esc_html__("Select banner text color.", 'blokco'),
            'type' => 'color',
			'tab'  => 'page_title'
        ),
		array(
            'name' => esc_html__('Page Title Alignment', 'blokco'),
            'id' => $prefix . 'pages_title_alignment',
            'desc' => esc_html__("Choose aligment of the page title.", 'blokco'),
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
				'' => esc_html__('Theme Default', 'blokco'),
				'left' => esc_html__('Left', 'blokco'),
				'center' => esc_html__('Center', 'blokco'),
                'right' => esc_html__('Right', 'blokco'),
            ),
        ),
		array(
            'name' => esc_html__('Page header sub title', 'blokco'),
            'desc' => esc_html__("Enter sub title for the page that will show below the page title in the page header area.", 'blokco'),
            'id' => $prefix . 'header_sub_title',
            'type' => 'text',
			'tab'  => 'page_title',
		),
		array(
            'name' => esc_html__('Breadcrumb Show/Hide', 'blokco'),
            'id' => $prefix . 'pages_breadcrumb_show',
            'type' => 'select',
			'tab'  => 'page_title',
            'options' => array(
                1 => esc_html__('Show', 'blokco'),
                0 => esc_html__('Hide', 'blokco'),
            ),
            'std' => 1,
        ),
		array(
            'name' => esc_html__('Show social sharing buttons', 'blokco'),
            'id' => $prefix . 'page_social_share',
            'type' => 'select',
			'tab'  => 'social_share',
            'options' => array(
                '1' => esc_html__('Show', 'blokco'),
                '0' => esc_html__('Hide', 'blokco'),
            ),
            'std' => 1,
        ),
	)
);

/* Post Meta Box
  ================================================== */
$meta_boxes[] = array(
    'id' => 'gallery_meta_box',
    'title' => __('Post media', 'blokco'),
    'pages' => array('post'),
	'context' => 'side',
	'priority' => 'low',
    'fields' => array(
        // Video Url
        array(
            'name' => esc_html__('Video URL', 'blokco'),
            'id' => $prefix . 'post_video_url',
            'desc' => esc_html__("Enter Youtube or Vimeo URL", 'blokco'),
            'type' => 'url',
			'visible' => ['post_format','video']
        ),
        // Link URL
        array(
            'name' => esc_html__('Link', 'blokco'),
            'id' => $prefix . 'post_link_url',
            'desc' => esc_html__("Enter the link URL", 'blokco'),
            'type' => 'url',
			'visible' => ['post_format','link']
        ),
		array(
            'name' => esc_html__('Gallery images', 'blokco'),
            'id' => $prefix . 'post_gallery_images',
            'desc' => esc_html__("Upload images for gallery/slider", 'blokco'),
            'type' => 'image_advanced',
            'max_file_uploads' => 30,
			'visible' => ['post_format','gallery']
        ),
       array(
            'name' => esc_html__('Show slider pagination?', 'blokco'),
            'id' => $prefix . 'post_slider_pagination',
            'desc' => esc_html__("Select yes to show pagination for slider.", 'blokco'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'blokco'),
                'no' => esc_html__('No', 'blokco'),
            ),
			'visible' => ['post_format','gallery']
        ),
		array(
            'name' => esc_html__('Show next/prev arrows?', 'blokco'),
            'id' => $prefix . 'post_slider_direction_arrows',
            'desc' => esc_html__("Select Yes to show slider direction arrows.", 'blokco'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'blokco'),
                'no' => esc_html__('No', 'blokco'),
            ),
			'visible' => ['post_format','gallery']
        ),
		array(
            'name' => esc_html__('Slider autoplay?', 'blokco'),
            'id' => $prefix . 'post_slider_auto_slide',
            'desc' => esc_html__("Select Yes to auto slide the posts gallery images.", 'blokco'),
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__('Yes', 'blokco'),
                'no' => esc_html__('No', 'blokco'),
            ),
			'visible' => ['post_format','gallery']
        ),
        //Audio Display
        array(
            'name' => esc_html__('Soundcloud Embed Code', 'blokco'),
            'id' => $prefix . 'post_uploaded_audio',
            'desc' => esc_html__("Paste your soundcloud audio embed code here. Help: http://bit.ly/2gRU1is", 'blokco'),
            'type' => 'textarea',
			'visible' => ['post_format','audio']
        ),
    )
);
/* Testimonials Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Testimonial Author Info', 'blokco'),
    'pages' => array('imi_testimonials'),
    'fields' => array(
        array(
            'name' => esc_html__('Sub title', 'blokco'),
            'id' => $prefix . 'testi_sub_title',
            'desc' => esc_html__("Enter sub title for the testimonial that will appear with the name of the author. It can be company name or job position.", 'blokco'),
            'type' => 'text',
        ),
    )
);
/* Services Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Service Info', 'blokco'),
    'pages' => array('imi_services'),
    'fields' => array(
        array(
            'name' => esc_html__('Choose Icon', 'blokco'),
            'id' => $prefix . 'service_icon',
            'desc' => esc_html__("Choose icon from the list of icons here to be used for this service. All Font Awesome Icon can be found here: http://fontawesome.io/icons/", 'blokco'),
            'type' => 'select',
			'options' => blokco_smk_font_awesome('readable')
        ),
        array(
            'name' => esc_html__('Upload icon image', 'blokco'),
            'id' => $prefix . 'service_icon_image',
            'desc' => esc_html__("Upload icon image to use for this service.", 'blokco'),
            'type' => 'image_advanced',
            'max_file_uploads' => 1
        ),
    )
);
/* Team Meta Box
  ================================================== */
$meta_boxes[] = array(
    'id' => 'team_meta_box',
    'title' => esc_html__('Team Member Information', 'blokco'),
    'pages' => array('imi_team'),
	'priority' => 'high',
    'fields' => array(
		array(
            'name' => esc_html__('Job position', 'blokco'),
            'id' => $prefix . 'staff_position',
            'desc' => esc_html__("Enter job designation/position of team member.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Email', 'blokco'),
            'id' => $prefix . 'staff_member_email',
            'desc' => esc_html__("Enter the team member's email.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Phone no.', 'blokco'),
            'id' => $prefix . 'staff_member_phone',
            'desc' => esc_html__("Enter the team member's phone number.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Address', 'blokco'),
            'id' => $prefix . 'staff_member_address',
            'desc' => esc_html__("Enter the team member's postal address.", 'blokco'),
            'type' => 'textarea',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Facebook', 'blokco'),
            'id' => $prefix . 'staff_member_facebook',
            'desc' => esc_html__("Enter team member's Facebook account URL.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Twitter', 'blokco'),
            'id' => $prefix . 'staff_member_twitter',
            'desc' => esc_html__("Enter team member's Twitter account URL.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Google Plus', 'blokco'),
            'id' => $prefix . 'staff_member_gplus',
            'desc' => esc_html__("Enter team member's Google Plus profile URL.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Linkedin', 'blokco'),
            'id' => $prefix . 'staff_member_linkedin',
            'desc' => esc_html__("Enter team member's Linkedin profile URL.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
		array(
            'name' => esc_html__('Pinterest', 'blokco'),
            'id' => $prefix . 'staff_member_pinterest',
            'desc' => esc_html__("Enter team member's Pinterest profile URL.", 'blokco'),
            'type' => 'text',
            'std' => '',
        ),
    )
);
/* * ******************* META BOX REGISTERING ********************** */
/**
 * Register meta boxes
 *
 * @return void
 */
function blokco_register_meta_boxes() {
    global $meta_boxes;
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (class_exists('RW_Meta_Box')) {
        foreach ($meta_boxes as $meta_box) {
            new RW_Meta_Box($meta_box);
        }
    }
}
add_action('rwmb_meta_boxes', 'blokco_register_taxonomy_meta_boxes');
function blokco_register_taxonomy_meta_boxes($meta_boxes) {
$prefix = 'blokco_';
/* Term Meta Box
  ================================================== */
$meta_boxes[] = array(
    'title' => esc_html__('Additional Info', 'blokco'),
    'taxonomies' => array('imi_projects_category', 'imi_service_category', 'imi_team_category', 'category','eventer-category'),
    'fields' => array(
		array(
            'name' => esc_html__('Page banner image', 'blokco'),
            'id' => $prefix . 'term_banner_image',
            'type' => 'image_advanced',
            'max_file_uploads' => 1
		),
    )
);
	return $meta_boxes;
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking Page template, categories, etc.
add_action('admin_init', 'blokco_register_meta_boxes');
?>