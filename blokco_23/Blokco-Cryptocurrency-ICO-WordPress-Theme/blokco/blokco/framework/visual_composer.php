<?php
add_action( 'vc_after_init', 'vc_after_init_actions' );
 
function vc_after_init_actions() {
     
    // Enable VC by default on a list of Post Types
    if( function_exists('vc_set_default_editor_post_types') ){ 
         
        $list = array(
            'page',
			'post',
			'imi_projects',
			'imi_team',
			'imi_services',
			'imi_testimonials',
			'imi_vc_section'
        );
         
        vc_set_default_editor_post_types( $list );
         
    }
}

add_action( 'vc_before_init', 'blokco_vc_set_as_theme' );

if( ! function_exists( 'blokco_vc_set_as_theme' ) ) {
	function blokco_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if ( is_admin() ) {
	if ( ! function_exists( 'blokco_vc_remove_teaser_metabox' ) ) {
		function blokco_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'blokco_vc_remove_teaser_metabox' );
	}
}

/* UPDATE VC DEFAULT SHORTCODES */
add_action( 'admin_init', 'blokco_update_default_shortcodes' );

if ( ! function_exists( 'blokco_update_default_shortcodes' ) ) {
	function blokco_update_default_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_btn', array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Color', 'blokco' ),
					'param_name' => 'color',
					'description' => __( 'Select button color.', 'blokco' ),
					// compatible with btn2, need to be converted from btn1
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value' => array(
							// Btn1 Colors
							__( 'Theme Primary Color', 'blokco' ) => 'theme_primary_btn',
							__( 'Theme Secondary Color', 'blokco' ) => 'theme_secondary_btn',
							__( 'Classic Grey', 'blokco' ) => 'default',
							__( 'Classic Blue', 'blokco' ) => 'primary',
							__( 'Classic Turquoise', 'blokco' ) => 'info',
							__( 'Classic Green', 'blokco' ) => 'success',
							__( 'Classic Orange', 'blokco' ) => 'warning',
							__( 'Classic Red', 'blokco' ) => 'danger',
							__( 'Classic Black', 'blokco' ) => 'inverse',
							// + Btn2 Colors (default color set)
						) + vc_get_shared( 'colors-dashed' ),
					'std' => 'grey',
					// must have default color grey
					'dependency' => array(
						'element' => 'style',
						'value_not_equal_to' => array(
							'custom',
							'outline-custom',
							'gradient',
							'gradient-custom',
						),
					),
				),
			) );
			
			vc_add_params( 'vc_progress_bar', array(
				array(
					'type' => 'param_group',
					'heading' => __( 'Values', 'blokco' ),
					'param_name' => 'values',
					'description' => __( 'Enter values for graph - value, title and color.', 'blokco' ),
					'value' => urlencode( json_encode( array(
						array(
							'label' => __( 'Development', 'blokco' ),
							'value' => '90',
						),
						array(
							'label' => __( 'Design', 'blokco' ),
							'value' => '80',
						),
						array(
							'label' => __( 'Marketing', 'blokco' ),
							'value' => '70',
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Label', 'blokco' ),
							'param_name' => 'label',
							'description' => __( 'Enter text used as title of bar.', 'blokco' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => __( 'Value', 'blokco' ),
							'param_name' => 'value',
							'description' => __( 'Enter value of bar.', 'blokco' ),
							'admin_label' => true,
						),
						array(
							'type' => 'dropdown',
							'heading' => __( 'Color', 'blokco' ),
							'param_name' => 'color',
							'value' => array(
									__( 'Default', 'blokco' ) => '',
								) + array(
									__( 'Theme Primary Color', 'blokco' ) => 'theme_primary_pbar',
									__( 'Theme Secondary Color', 'blokco' ) => 'theme_secondary_pbar',
									__( 'Classic Grey', 'blokco' ) => 'bar_grey',
									__( 'Classic Blue', 'blokco' ) => 'bar_blue',
									__( 'Classic Turquoise', 'blokco' ) => 'bar_turquoise',
									__( 'Classic Green', 'blokco' ) => 'bar_green',
									__( 'Classic Orange', 'blokco' ) => 'bar_orange',
									__( 'Classic Red', 'blokco' ) => 'bar_red',
									__( 'Classic Black', 'blokco' ) => 'bar_black',
								) + vc_get_shared( 'colors-dashed' ) + array(
									__( 'Custom Color', 'blokco' ) => 'custom',
								),
							'description' => __( 'Select single bar background color.', 'blokco' ),
							'admin_label' => true,
							'param_holder_class' => 'vc_colored-dropdown',
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Custom color', 'blokco' ),
							'param_name' => 'customcolor',
							'description' => __( 'Select custom single bar background color.', 'blokco' ),
							'dependency' => array(
								'element' => 'color',
								'value' => array( 'custom' ),
							),
						),
						array(
							'type' => 'colorpicker',
							'heading' => __( 'Custom text color', 'blokco' ),
							'param_name' => 'customtxtcolor',
							'description' => __( 'Select custom single bar text color.', 'blokco' ),
							'dependency' => array(
								'element' => 'color',
								'value' => array( 'custom' ),
							),
						),
					),
				),
			) );

		}

	}
}
/* START THEME ELEMENTS */
if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'blokco_vc_elements' );
}

if ( ! function_exists( 'blokco_vc_elements' ) ) {
	function blokco_vc_elements() {
		
		$projectterms = array();
		$servicesterms = array();
		$poststerms = array();
		$testimonialsterms = array();
		$teamterms = array();
		
		$project_cats = get_terms('imi_projects_category');
		if(!is_wp_error($project_cats))
		{
			foreach($project_cats as $project_cat)
			{ 
				$projectterms[] = array('value'=>$project_cat->term_id, 'label'=>$project_cat->name); 
			}
		}
		$service_cats = get_terms('imi_services_category');
		if(!is_wp_error($service_cats))
		{
			foreach($service_cats as $service_cat)
			{ 
				$servicesterms[] = array('value'=>$service_cat->term_id, 'label'=>$service_cat->name); 
			}
		}
		$posts_cats = get_terms('category');
		if(!is_wp_error($posts_cats))
		{
			foreach($posts_cats as $posts_cat)
			{ 
				$poststerms[] = array('value'=>$posts_cat->term_id, 'label'=>$posts_cat->name); 
			}
		}
		$testimonials_cats = get_terms('imi_testimonials_category');
		if(!is_wp_error($testimonials_cats))
		{
			foreach($testimonials_cats as $testimonials_cat)
			{ 
				$testimonialsterms[] = array('value'=>$testimonials_cat->term_id, 'label'=>$testimonials_cat->name); 
			}
		}
		$team_cats = get_terms('imi_team_category');
		if(!is_wp_error($team_cats))
		{
			foreach($team_cats as $team_cat)
			{ 
				$teamterms[] = array('value'=>$team_cat->term_id, 'label'=>$team_cat->name); 
			}
		}
		$vc_sections_array = get_posts(array( 'post_type' => 'imi_vc_section', 'posts_per_page' => - 1));
		$vc_sections = array( esc_html__('Select', 'blokco' ) => 0);
		if ( $vc_sections_array && ! is_wp_error( $vc_sections_array ) ) {
			foreach ( $vc_sections_array as $vc_section ) {
				$vc_sections[ get_the_title( $vc_section ) ] = $vc_section->post_name;
			}
		}
		/* Projects Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Projects", "blokco" ),
			"base" => "blokco_project",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'blokco' ),
					'param_name' => 'view',
					'value' => array(esc_html__( 'Grid', 'blokco' ) => 'grid', esc_html__( 'Carousel', 'blokco' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for projects.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'blokco' ) => 1, esc_html__( 'Two Columns', 'blokco' ) => 2, esc_html__( 'Three Columns', 'blokco' ) => 3, esc_html__( 'Four Columns', 'blokco' ) => 4, esc_html__( 'Five Columns', 'blokco' ) => 5, esc_html__( 'Six Columns', 'blokco' ) => 6) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Masonry Grid?', 'blokco' ),
					'param_name' => 'masonry_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'style',
					'value' => array( esc_html__( 'Style1', 'blokco' ) => 'projects-grid-style1', esc_html__( 'Style 2', 'blokco' ) => 'projects-grid-style2') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show project category filters?', 'blokco'),
					'param_name' => 'filters',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('grid'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'blokco'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 1,
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link project image to big image in Lightbox?', 'blokco' ),
					'param_name' => 'zoom',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show project title?', 'blokco' ),
					'param_name' => 'show_title',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show project categories?', 'blokco' ),
					'param_name' => 'show_category',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'blokco' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'blokco' ),
					'param_name' => 'excerpt_number',
					'value' => 10,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Project Categories', 'blokco' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show projects by specific categories. Search and enter by typing category names.', 'blokco' ),
					'settings'		=> array( 'values' => $projectterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of projects', 'blokco' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of projects to show per page.', 'blokco' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'blokco' ),
					'param_name' => 'img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'blokco' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'blokco' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for Projects.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Border Radius', 'blokco' ),
					'param_name' => 'blokco_style_radius',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( '0px', 'blokco' ) => '0px',esc_html__( '1px', 'blokco' ) => '1px', esc_html__( '2px', 'blokco' ) => '2px', esc_html__( '3px', 'blokco' ) => '3px', esc_html__( '4px', 'blokco' ) => '4px', esc_html__( '5px', 'blokco' ) => '5px', esc_html__( '10px', 'blokco' ) => '10px', esc_html__( '15px', 'blokco' ) => '15px', esc_html__( '20px', 'blokco' ) => '20px', esc_html__( '25px', 'blokco' ) => '25px', esc_html__( '30px', 'blokco' ) => '30px', esc_html__( '35px', 'blokco' ) => '35px') ,
					'description' => esc_html__( 'Choose border radius for the post items.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'blokco' ),
					'param_name' => 'blokco_style_spacing',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Spaced', 'blokco' ) => 'spaced-items', esc_html__( 'No space', 'blokco' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between items or not.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style', 'blokco' ),
					'param_name' => 'blokco_style_border',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Shadow', 'blokco' ) => 'shadow-border-style', esc_html__( 'Border', 'blokco' ) => 'basic-border-style', esc_html__( 'None', 'blokco' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style', 'blokco' ),
					'param_name' => 'blokco_style_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'White', 'blokco' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'blokco' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg-style', esc_html__( 'Custom', 'blokco' ) => 'custom-bg-style', esc_html__( 'None', 'blokco' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'blokco' ),
					'param_name' => 'blokco_style_bg_custom',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'dependency' => array('element' => 'blokco_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style', 'blokco' ),
					'param_name' => 'blokco_style_skin',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'light-skin-style', esc_html__( 'Dark', 'blokco' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover style', 'blokco' ),
					'param_name' => 'blokco_style_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'None', 'blokco' ) => 'si-animate-none', esc_html__( 'Shadow', 'blokco' ) => 'si-animate-shadow', esc_html__( 'Move top', 'blokco' ) => 'si-animate-top', esc_html__( 'Shadow + Move top', 'blokco' ) => 'si-animate-shadow si-animate-top') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	/* Services Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Services", "blokco" ),
			"base" => "blokco_services",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'blokco' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'List', 'blokco' ) => 'list', esc_html__( 'Grid', 'blokco' ) => 'grid', esc_html__( 'Carousel', 'blokco' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for services.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'blokco' ) => 1, esc_html__( 'Two Columns', 'blokco' ) => 2, esc_html__( 'Three Columns', 'blokco' ) => 3, esc_html__( 'Four Columns', 'blokco' ) => 4, esc_html__( 'Five Columns', 'blokco' ) => 5, esc_html__( 'Six Columns', 'blokco' ) => 6) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Masonry Grid?', 'blokco' ),
					'param_name' => 'masonry_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'blokco'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 1,
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Show Thumbnail or Icon', 'blokco' ),
					'param_name' => 'thumb',
					'value' => array( esc_html__( 'Icon', 'blokco' ) => 'icon-service-media', esc_html__( 'Thumbnail', 'blokco' ) => 'thumbnail-service-media', esc_html__( 'None', 'blokco' ) => 'no-service-media') ,
					'description' => esc_html__( 'Select thumbnail or icon view for services.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Icon font size', 'blokco' ),
					'param_name' => 'icon_size',
					'description' => esc_html__('Enter font size for the service icons. Add px here. For example: 40px.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'thumb',
						'value' => 'icon-service-media',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'blokco' ),
					'param_name' => 'img_size',
					'value' => '450x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'blokco' ),
					'dependency' => array(
						'element' => 'thumb',
						'value' => array( 'thumbnail-service-media' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Align content?', 'blokco' ),
					'param_name' => 'align',
					'value' => array( esc_html__( 'Center', 'blokco' ) => 'text-align-center', esc_html__( 'Left', 'blokco' ) => 'text-align-left', esc_html__( 'Right', 'blokco' ) => 'text-align-right') ,
					'description' => esc_html__( 'Select alignment for the service grid content.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link Image/Icon/Title to single service page?', 'blokco' ),
					'param_name' => 'linked',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show services title?', 'blokco' ),
					'param_name' => 'show_title',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Title font size', 'blokco' ),
					'param_name' => 'title_size',
					'description' => esc_html__('Enter font size for the service title. Add px here. For example: 20px.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'show_title',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'blokco' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'blokco' ),
					'param_name' => 'excerpt_number',
					'value' => 20,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more link?', 'blokco' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more link text', 'blokco' ),
					'param_name' => 'more_text',
					'value' => 'Read More',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Service Categories', 'blokco' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show services by specific categories. Search and enter by typing category names.', 'blokco' ),
					'settings'		=> array( 'values' => $servicesterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Services', 'blokco' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of services to show per page.', 'blokco' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'blokco' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for services.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','list' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Border Radius', 'blokco' ),
					'param_name' => 'blokco_style_radius',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array(esc_html__( '0px', 'blokco' ) => '0px', esc_html__( '1px', 'blokco' ) => '1px', esc_html__( '2px', 'blokco' ) => '2px', esc_html__( '3px', 'blokco' ) => '3px', esc_html__( '4px', 'blokco' ) => '4px', esc_html__( '5px', 'blokco' ) => '5px', esc_html__( '10px', 'blokco' ) => '10px', esc_html__( '15px', 'blokco' ) => '15px', esc_html__( '20px', 'blokco' ) => '20px', esc_html__( '25px', 'blokco' ) => '25px', esc_html__( '30px', 'blokco' ) => '30px', esc_html__( '35px', 'blokco' ) => '35px') ,
					'description' => esc_html__( 'Choose border radius for the post items.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'blokco' ),
					'param_name' => 'blokco_style_spacing',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Spaced', 'blokco' ) => 'spaced-items', esc_html__( 'No space', 'blokco' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between items or not.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style', 'blokco' ),
					'param_name' => 'blokco_style_border',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Shadow', 'blokco' ) => 'shadow-border-style', esc_html__( 'Border', 'blokco' ) => 'basic-border-style', esc_html__( 'None', 'blokco' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style', 'blokco' ),
					'param_name' => 'blokco_style_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'White', 'blokco' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'blokco' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg-style', esc_html__( 'Custom', 'blokco' ) => 'custom-bg-style', esc_html__( 'None', 'blokco' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'blokco' ),
					'param_name' => 'blokco_style_bg_custom',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'dependency' => array('element' => 'blokco_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style', 'blokco' ),
					'param_name' => 'blokco_style_skin',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'light-skin-style', esc_html__( 'Dark', 'blokco' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover style', 'blokco' ),
					'param_name' => 'blokco_style_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'None', 'blokco' ) => 'si-animate-none', esc_html__( 'Shadow', 'blokco' ) => 'si-animate-shadow', esc_html__( 'Move top', 'blokco' ) => 'si-animate-top', esc_html__( 'Shadow + Move top', 'blokco' ) => 'si-animate-shadow si-animate-top') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	/* Posts Grid/List Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Blog Posts", "blokco" ),
			"base" => "blokco_posts",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'blokco' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'Medium Thumbnails', 'blokco' ) => 'medium',esc_html__( 'Full Width', 'blokco' ) => 'full', esc_html__( 'Grid', 'blokco' ) => 'grid', esc_html__( 'Carousel', 'blokco' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for posts.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'blokco' ) => 1, esc_html__( 'Two Columns', 'blokco' ) => 2, esc_html__( 'Three Columns', 'blokco' ) => 3, esc_html__( 'Four Columns', 'blokco' ) => 4, esc_html__( 'Five Columns', 'blokco' ) => 5, esc_html__( 'Six Columns', 'blokco' ) => 6) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'grid_style',
					'value' => array( esc_html__( 'Classic', 'blokco' ) => 'grid-style-classic', esc_html__( 'Modern', 'blokco' ) => 'grid-style-modern') ,
					'description' => esc_html__( 'Select style for grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','carousel' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Masonry Grid?', 'blokco' ),
					'param_name' => 'masonry_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'blokco'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 1,
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post media?', 'blokco' ),
					'param_name' => 'media_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post featured image only', 'blokco' ),
					'description' => esc_html__( 'Check to show only featured image instead of different media content.', 'blokco' ),
					'param_name' => 'media_image_only',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'media_show',
						'value' => array( '1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post date?', 'blokco' ),
					'param_name' => 'show_date',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post author name?', 'blokco' ),
					'param_name' => 'show_author',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post categories?', 'blokco' ),
					'param_name' => 'show_categories',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post comments number?', 'blokco' ),
					'param_name' => 'show_comments',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'blokco' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'blokco' ),
					'param_name' => 'excerpt_number',
					'value' => 30,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more button?', 'blokco' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more button label', 'blokco' ),
					'param_name' => 'more_text',
					'value' => 'Read More',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Read more button style', 'blokco' ),
					'param_name' => 'more_style',
					'value' => array( esc_html__( 'Text Link', 'blokco' ) => 'more-style-text', esc_html__( 'Button', 'blokco' ) => 'more-style-btn') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Posts Categories', 'blokco' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show posts by specific categories. Search and enter by typing category names.', 'blokco' ),
					'settings'		=> array( 'values' => $poststerms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Posts', 'blokco' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of posts to show per page.', 'blokco' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'blokco' ),
					'param_name' => 'img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. This works for only standard or Image format posts.', 'blokco' ),
					'dependency' => array(
						'element' => 'media_show',
						'value' => array( '1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'blokco' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for posts.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','medium','full' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Border Radius', 'blokco' ),
					'param_name' => 'blokco_style_radius',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( '0px', 'blokco' ) => '0px',esc_html__( '1px', 'blokco' ) => '1px', esc_html__( '2px', 'blokco' ) => '2px', esc_html__( '3px', 'blokco' ) => '3px', esc_html__( '4px', 'blokco' ) => '4px', esc_html__( '5px', 'blokco' ) => '5px', esc_html__( '10px', 'blokco' ) => '10px', esc_html__( '15px', 'blokco' ) => '15px', esc_html__( '20px', 'blokco' ) => '20px', esc_html__( '25px', 'blokco' ) => '25px', esc_html__( '30px', 'blokco' ) => '30px', esc_html__( '35px', 'blokco' ) => '35px') ,
					'description' => esc_html__( 'Choose border radius for the post items.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'blokco' ),
					'param_name' => 'blokco_style_spacing',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Spaced', 'blokco' ) => 'spaced-items', esc_html__( 'No space', 'blokco' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between items or not.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style', 'blokco' ),
					'param_name' => 'blokco_style_border',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Shadow', 'blokco' ) => 'shadow-border-style', esc_html__( 'Border', 'blokco' ) => 'basic-border-style', esc_html__( 'None', 'blokco' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style', 'blokco' ),
					'param_name' => 'blokco_style_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'White', 'blokco' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'blokco' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg-style', esc_html__( 'Custom', 'blokco' ) => 'custom-bg-style', esc_html__( 'None', 'blokco' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'blokco' ),
					'param_name' => 'blokco_style_bg_custom',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'dependency' => array('element' => 'blokco_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style', 'blokco' ),
					'param_name' => 'blokco_style_skin',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'light-skin-style', esc_html__( 'Dark', 'blokco' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover style', 'blokco' ),
					'param_name' => 'blokco_style_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'None', 'blokco' ) => 'si-animate-none', esc_html__( 'Shadow', 'blokco' ) => 'si-animate-shadow', esc_html__( 'Move top', 'blokco' ) => 'si-animate-top', esc_html__( 'Shadow + Move top', 'blokco' ) => 'si-animate-shadow si-animate-top') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	
	/* Testimonial Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Testimonials", "blokco" ),
			"base" => "blokco_testimonials",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'style',
					'value' => array( esc_html__( 'Style 1', 'blokco' ) => 'testimonials-style1', esc_html__( 'Style2', 'blokco' ) => 'testimonials-style2', esc_html__( 'Style3', 'blokco' ) => 'testimonials-style3') ,
					'description' => esc_html__( 'Select style for testimonials.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'blokco' ),
					'param_name' => 'view',
					'value' => array( esc_html__( 'Grid', 'blokco' ) => 'grid', esc_html__( 'Carousel', 'blokco' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for testimonials.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value_not_equal_to' => 'testimonials-style3'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'blokco' ) => 1, esc_html__( 'Two Columns', 'blokco' ) => 2, esc_html__( 'Three Columns', 'blokco' ) => 3, esc_html__( 'Four Columns', 'blokco' ) => 4, esc_html__( 'Five Columns', 'blokco' ) => 5, esc_html__( 'Six Columns', 'blokco' ) => 6) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value_not_equal_to' => 'testimonials-style3'),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Masonry Grid?', 'blokco' ),
					'param_name' => 'masonry_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and next/prev buttons without scrolling back. Auto height will not work if loop is enabled.', 'blokco'),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial author photo?', 'blokco' ),
					'param_name' => 'photo',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial author title?', 'blokco' ),
					'param_name' => 'author',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show testimonial sub title?', 'blokco' ),
					'param_name' => 'subtitle',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image position?', 'blokco' ),
					'param_name' => 'image_position',
					'value' => array( esc_html__( 'Left', 'blokco' ) => 'testi3-fl', esc_html__( 'Right', 'blokco' ) => 'testi3-pr') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'style', 'value' => array('testimonials-style3')),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image shape?', 'blokco' ),
					'param_name' => 'image_radius',
					'value' => array( esc_html__( 'Round', 'blokco' ) => 'full-border-radius', esc_html__( 'Square', 'blokco' ) => 'no-border-radius') ,
					'param_holder_class' => 'vc_colored-dropdown'
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Testimonial Categories', 'blokco' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show testimonials by specific categories. Search and enter by typing category names.', 'blokco' ),
					'settings'		=> array( 'values' => $testimonialsterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Testimonials', 'blokco' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of testimonials to show per page.', 'blokco' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'blokco' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination for tesimonials.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Border Radius', 'blokco' ),
					'param_name' => 'blokco_style_radius',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( '0px', 'blokco' ) => '0px',esc_html__( '1px', 'blokco' ) => '1px', esc_html__( '2px', 'blokco' ) => '2px', esc_html__( '3px', 'blokco' ) => '3px', esc_html__( '4px', 'blokco' ) => '4px', esc_html__( '5px', 'blokco' ) => '5px', esc_html__( '10px', 'blokco' ) => '10px', esc_html__( '15px', 'blokco' ) => '15px', esc_html__( '20px', 'blokco' ) => '20px', esc_html__( '25px', 'blokco' ) => '25px', esc_html__( '30px', 'blokco' ) => '30px', esc_html__( '35px', 'blokco' ) => '35px') ,
					'description' => esc_html__( 'Choose border radius for the post items.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'blokco' ),
					'param_name' => 'blokco_style_spacing',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Spaced', 'blokco' ) => 'spaced-items', esc_html__( 'No space', 'blokco' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between items or not.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style', 'blokco' ),
					'param_name' => 'blokco_style_border',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Shadow', 'blokco' ) => 'shadow-border-style', esc_html__( 'Border', 'blokco' ) => 'basic-border-style', esc_html__( 'None', 'blokco' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'no-border-style'
				),
				array(
					'type' 	=> 'dropdown',
					'heading' => esc_html__( 'Background style', 'blokco' ),
					'param_name' => 'blokco_style_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'White', 'blokco' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'blokco' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg-style', esc_html__( 'Custom', 'blokco' ) => 'custom-bg-style', esc_html__( 'None', 'blokco' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'no-bg-style'
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'blokco' ),
					'param_name' => 'blokco_style_bg_custom',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'dependency' => array('element' => 'blokco_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style', 'blokco' ),
					'param_name' => 'blokco_style_skin',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'light-skin-style', esc_html__( 'Dark', 'blokco' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover style', 'blokco' ),
					'param_name' => 'blokco_style_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'None', 'blokco' ) => 'si-animate-none', esc_html__( 'Shadow', 'blokco' ) => 'si-animate-shadow', esc_html__( 'Move top', 'blokco' ) => 'si-animate-top', esc_html__( 'Shadow + Move top', 'blokco' ) => 'si-animate-shadow si-animate-top') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
	
	/* Team Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Team", "blokco" ),
			"base" => "blokco_team",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'View Style', 'blokco' ),
					'param_name' => 'view',
					'value' => array(esc_html__( 'Grid', 'blokco' ) => 'grid', esc_html__( 'Carousel', 'blokco' ) => 'carousel' ) ,
					'description' => esc_html__( 'Select view style for team.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grid Column', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( 'One Column', 'blokco' ) => 1, esc_html__( 'Two Columns', 'blokco' ) => 2, esc_html__( 'Three Columns', 'blokco' ) => 3, esc_html__( 'Four Columns', 'blokco' ) => 4, esc_html__( 'Five Columns', 'blokco' ) => 5, esc_html__( 'Six Columns', 'blokco' ) => 6) ,
					'description' => esc_html__( 'Select columns of grid/carousel.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'style',
					'value' => array( esc_html__( 'Block Style', 'blokco' ) => 'style1', esc_html__( 'List Style', 'blokco' ) => 'style2') ,
					'description' => esc_html__( 'Select style for the team', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Align content?', 'blokco' ),
					'param_name' => 'align',
					'value' => array( esc_html__( 'Center', 'blokco' ) => 'text-align-center', esc_html__( 'Left', 'blokco' ) => 'text-align-left', esc_html__( 'Right', 'blokco' ) => 'text-align-right') ,
					'description' => esc_html__( 'Select alignment for the team content.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'style1' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Masonry Grid?', 'blokco' ),
					'param_name' => 'masonry_show',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid' ),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'blokco'),
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 1,
					'std' => 1,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
					'dependency' => array(
						'element' => 'view',
						'value' => array('carousel'),
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member designation?', 'blokco' ),
					'param_name' => 'staff_position',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member email?', 'blokco' ),
					'param_name' => 'staff_email',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member phone?', 'blokco' ),
					'param_name' => 'staff_phone',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show team member social links?', 'blokco' ),
					'param_name' => 'staff_social',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Excerpt?', 'blokco' ),
					'param_name' => 'show_excerpt',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of words to show as excerpt', 'blokco' ),
					'param_name' => 'excerpt_number',
					'value' => 60,
					'dependency' => array(
						'element' => 'show_excerpt',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show read more button?', 'blokco' ),
					'param_name' => 'more',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Read more button label', 'blokco' ),
					'param_name' => 'more_text',
					'value' => 'View profile',
					'dependency' => array(
						'element' => 'more',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Link title/image to details page?', 'blokco' ),
					'param_name' => 'permalink',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show thumbnail?', 'blokco' ),
					'param_name' => 'thumb',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Round Image?', 'blokco' ),
					'param_name' => 'round_thumb',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
					'dependency' => array(
						'element' => 'thumb',
						'value' => '1',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'blokco' ),
					'param_name' => 'img_size',
					'value' => '400x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'blokco' ),
					'dependency' => array(
						'element' => 'thumb',
						'value' => '1',
					),
				),
				array(
					'type' => 'autocomplete',
					'class' => '',
					'heading' => esc_html__( 'Team Categories', 'blokco' ),
					'param_name' => 'terms',
					'description' => esc_html__( 'Show team by specific categories. Search and enter by typing category names.', 'blokco' ),
					'settings'		=> array( 'values' => $teamterms,'multiple' => true,
					'min_length' => 1,
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true, ),
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => esc_html__( 'Number of Team members', 'blokco' ),
					'param_name' => 'number',
					'value' => 4,
					'description' => esc_html__( 'Insert number of team to show per page.', 'blokco' )
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'blokco' ),
					'param_name' => 'pagination',
					'description' => esc_html__( 'Show pagination. This will work on an individual team page not on homepage.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'dependency' => array(
						'element' => 'view',
						'value' => array( 'grid','list' ),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items Border Radius', 'blokco' ),
					'param_name' => 'blokco_style_radius',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( '0px', 'blokco' ) => '0px',esc_html__( '1px', 'blokco' ) => '1px', esc_html__( '2px', 'blokco' ) => '2px', esc_html__( '3px', 'blokco' ) => '3px', esc_html__( '4px', 'blokco' ) => '4px', esc_html__( '5px', 'blokco' ) => '5px', esc_html__( '10px', 'blokco' ) => '10px', esc_html__( '15px', 'blokco' ) => '15px', esc_html__( '20px', 'blokco' ) => '20px', esc_html__( '25px', 'blokco' ) => '25px', esc_html__( '30px', 'blokco' ) => '30px', esc_html__( '35px', 'blokco' ) => '35px') ,
					'description' => esc_html__( 'Choose border radius for the post items.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Spaced items', 'blokco' ),
					'param_name' => 'blokco_style_spacing',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Spaced', 'blokco' ) => 'spaced-items', esc_html__( 'No space', 'blokco' ) => 'non-spaced-items') ,
					'description' => esc_html__( 'Choose if you want to have space/gutter between items or not.', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Border style', 'blokco' ),
					'param_name' => 'blokco_style_border',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Shadow', 'blokco' ) => 'shadow-border-style', esc_html__( 'Border', 'blokco' ) => 'basic-border-style', esc_html__( 'None', 'blokco' ) => 'no-border-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background style', 'blokco' ),
					'param_name' => 'blokco_style_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'White', 'blokco' ) => 'white-bg-style', esc_html__( 'Theme primary color', 'blokco' ) => 'primary-bg-style', esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg-style', esc_html__( 'Custom', 'blokco' ) => 'custom-bg-style', esc_html__( 'None', 'blokco' ) => 'no-bg-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom background color', 'blokco' ),
					'param_name' => 'blokco_style_bg_custom',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'dependency' => array('element' => 'blokco_style_bg', 'value' => 'custom-bg-style'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin style', 'blokco' ),
					'param_name' => 'blokco_style_skin',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'light-skin-style', esc_html__( 'Dark', 'blokco' ) => 'dark-skin-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover style', 'blokco' ),
					'param_name' => 'blokco_style_hover',
					'group'      => esc_html__( 'Style', 'blokco' ),
					'value' => array( esc_html__( 'None', 'blokco' ) => 'si-animate-none', esc_html__( 'Shadow', 'blokco' ) => 'si-animate-shadow', esc_html__( 'Move top', 'blokco' ) => 'si-animate-top', esc_html__( 'Shadow + Move top', 'blokco' ) => 'si-animate-shadow si-animate-top') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			)
		) 
	);
		
	/* Team Info Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Team info", "blokco" ),
			"base" => "blokco_teaminfo",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'tinfo_style',
					'value' => array( esc_html__( 'Horizontal', 'blokco' ) => 'tinfo-horizontal-style', esc_html__( 'Vertical', 'blokco' ) => 'tinfo-vertical-style') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Address?', 'blokco' ),
					'param_name' => 'tinfo_address',
					'description' => esc_html__( 'Check to show team member postal address.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Phone?', 'blokco' ),
					'param_name' => 'tinfo_phone',
					'description' => esc_html__( 'Check to show team member phone number.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Email?', 'blokco' ),
					'param_name' => 'tinfo_email',
					'description' => esc_html__( 'Check to show team member email address.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Social Icons?', 'blokco' ),
					'param_name' => 'tinfo_social',
					'description' => esc_html__( 'Check to show team member social profile links.', 'blokco' ),
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
			)
		)
	);
	
	/* Icon Box Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Icon Box", "blokco" ),
			"base" => "blokco_ibox",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'blokco' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'blokco' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'blokco' ) => 'openiconic',
						esc_html__( 'Typicons', 'blokco' ) => 'typicons',
						esc_html__( 'Entypo', 'blokco' ) => 'entypo',
						esc_html__( 'Linecons', 'blokco' ) => 'linecons',
						esc_html__( 'Mono Social', 'blokco' ) => 'monosocial',
						esc_html__( 'Material', 'blokco' ) => 'material',
					),
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_monosocial',
					'value' => 'vc-mono vc-mono-fivehundredpx',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_material',
					'value' => 'vc-material vc-material-cake',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => false,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon - Size', 'blokco' ),
					'param_name' => 'ibox_icon_size',
					'value' => array( esc_html__( '16px', 'blokco' ) => '16px', esc_html__( '32px', 'blokco' ) => '32px', esc_html__( '48px', 'blokco' ) => '48px', esc_html__( '64px', 'blokco' ) => '64px') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => '32px'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'blokco' ),
					'param_name' => 'ibox_icon_color',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color',
						esc_html__( 'Custom', 'blokco' ) => 'custom'
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'blokco' ),
					'param_name' => 'ibox_icon_color_custom',
					'dependency' => array('element' => 'ibox_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'ibox_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title - Font Size (Add px)', 'blokco' ),
					'param_name' => 'ibox_title_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'ibox_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'ibox_title_color_custom',
					'dependency' => array('element' => 'ibox_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'blokco' ),
					'param_name' => 'ibox_desc',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Description - Font Size (Add px)', 'blokco' ),
					'param_name' => 'ibox_desc_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Description - Color', 'blokco' ),
					'param_name' => 'ibox_desc_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Description - Color Custom', 'blokco' ),
					'param_name' => 'ibox_desc_color_custom',
					'dependency' => array('element' => 'ibox_desc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'blokco' ),
					'param_name' => 'ibox_link',
					'description' => esc_html__( 'Enter/Select URL that will be added to Icon and Title.', 'blokco' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Align', 'blokco' ),
					'param_name' => 'ibox_calign',
					'value' => array( esc_html__( 'Left', 'blokco' ) => 'ibox-left', esc_html__( 'Center', 'blokco' ) => 'ibox-center', esc_html__( 'Right', 'blokco' ) => 'ibox-right') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Outline or Border', 'blokco' ),
					'param_name' => 'ibox_border',
					'value' => array( esc_html__( 'Outline', 'blokco' ) => 'ibox-outline', esc_html__( 'Border', 'blokco' ) => 'ibox-border', esc_html__( 'Plain', 'blokco' ) => 'ibox-noborder') ,
					'description' => esc_html__( 'Outline comes with background plus border', 'blokco' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon box shape', 'blokco' ),
					'param_name' => 'ibox_shape',
					'value' => array( esc_html__( 'Circle', 'blokco' ) => '', esc_html__( 'Rounded', 'blokco' ) => 'ibox-rounded', esc_html__( 'Square', 'blokco' ) => 'ibox-square', esc_html__( 'No box', 'blokco' ) => 'ibox-plain') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
	
	
	/* Featured Block Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Featured Block", "blokco" ),
			"base" => "blokco_fblock",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Featured Block Style', 'blokco' ),
					'param_name' => 'fblock_style',
					'value' => array( esc_html__( 'Style1', 'blokco' ) => 'fblock-style1', esc_html__( 'Style2', 'blokco' ) => 'fblock-style2') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Featured Block Image', 'blokco' ),
					'param_name' => 'fblock_image',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'blokco' ),
					'param_name' => 'fblock_img_size',
					'value' => '600x400',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'blokco' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Accent Color', 'blokco' ),
					'param_name' => 'fblock_accent_color',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color-bt',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color-bt',
						esc_html__( 'Custom', 'blokco' ) => 'custom',
					),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style1',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Accent Color Custom', 'blokco' ),
					'param_name' => 'fblock_accent_color_custom',
					'dependency' => array('element' => 'fblock_accent_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Grayscale Images', 'blokco' ),
					'param_name' => 'blokco_grayscale',
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-no-grayscale-images',esc_html__( 'Yes', 'blokco' ) => 'style-grayscale-images') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-grayscale-images'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Disable grayscale on hover?', 'blokco' ),
					'param_name' => 'blokco_grayscale_hover',
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-yes-grayscale-hover',esc_html__( 'Yes', 'blokco' ) => 'style-no-grayscale-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array(
						'element' => 'blokco_grayscale',
						'value' => array( 'style-grayscale-images','carousel' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background', 'blokco' ),
					'param_name' => 'blokco_overlay_bg',
					'value' => array( esc_html__( 'No', 'blokco' ) => 'style-overlay-no-bg', esc_html__( 'Primary Color', 'blokco' ) => 'style-overlay-primary-bg', esc_html__( 'Secondary Color', 'blokco' ) => 'style-overlay-secondary-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Images overlay background opacity', 'blokco' ),
					'param_name' => 'blokco_overlay_bg_opacity',
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'style-overlay-light-bg', esc_html__( 'Normal', 'blokco' ) => 'style-overlay-normal-bg', esc_html__( 'Dark', 'blokco' ) => 'style-overlay-dark-bg', esc_html__( 'Full dark', 'blokco' ) => 'style-overlay-fdark-bg') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hide overlay on hover?', 'blokco' ),
					'param_name' => 'blokco_overlay_hover',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => 'style-no-overlay-hover', esc_html__( 'No', 'blokco' ) => 'style-yes-overlay-hover') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'default' => 'style-no-overlay-hover',
					'dependency' => array('element' => 'blokco_overlay_bg', 'value_not_equal_to' => 'style-overlay-no-bg'),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'blokco' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'blokco' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'blokco' ) => 'openiconic',
						esc_html__( 'Typicons', 'blokco' ) => 'typicons',
						esc_html__( 'Entypo', 'blokco' ) => 'entypo',
						esc_html__( 'Linecons', 'blokco' ) => 'linecons',
						esc_html__( 'Mono Social', 'blokco' ) => 'monosocial',
						esc_html__( 'Material', 'blokco' ) => 'material',
					),
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'blokco' ),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style2',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_fontawesome',
					'value' => 'fa fa-adjust',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_openiconic',
					'value' => 'vc-oi vc-oi-dial',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_typicons',
					'value' => 'typcn typcn-adjust-brightness',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_entypo',
					'value' => 'entypo-icon entypo-icon-note',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_linecons',
					'value' => 'vc_li vc_li-heart',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_monosocial',
					'value' => 'vc-mono vc-mono-fivehundredpx',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_material',
					'value' => 'vc-material vc-material-cake',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'blokco' ),
					'param_name' => 'fblock_icon_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					),
					'dependency' => array(
						'element' => 'fblock_style',
						'value' => 'fblock-style2',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'blokco' ),
					'param_name' => 'fblock_icon_color_custom',
					'dependency' => array('element' => 'fblock_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'fblock_title',
					'value'      => '',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title - Font Size (Add px)', 'blokco' ),
					'param_name' => 'fblock_title_size',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'fblock_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'fblock_title_color_custom',
					'dependency' => array('element' => 'fblock_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'blokco' ),
					'param_name' => 'fblock_desc',
					'value'      => '',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Description - Font Size (Add px)', 'blokco' ),
					'param_name' => 'fblock_desc_size',
					'value'      => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Description - Color', 'blokco' ),
					'param_name' => 'fblock_desc_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Description - Color Custom', 'blokco' ),
					'param_name' => 'fblock_desc_color_custom',
					'dependency' => array('element' => 'fblock_desc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'blokco' ),
					'param_name' => 'fblock_link',
					'description' => esc_html__( 'Enter/Select URL for the featured block.', 'blokco' ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Read more link button label', 'blokco' ),
					'param_name' => 'fblock_more_btn',
					'value'      => esc_html__( 'Find our more', 'blokco' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
	
	
	
	/* Round Progress Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Round Progress", "blokco" ),
			"base" => "blokco_rprogress",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'rprogress_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'rprogress_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'rprogress_title_color_custom',
					'dependency' => array('element' => 'rprogress_title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Percentage (DO NOT ADD %)', 'blokco' ),
					'param_name' => 'rprogress_perc',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show percentage?', 'blokco' ),
					'description' => esc_html__( 'Uncheck to hide the percentage.', 'blokco' ),
					'param_name' => 'rprogress_show_perc',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Percentage - Color', 'blokco' ),
					'param_name' => 'rprogress_perc_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					),
					'dependency' => array('element' => 'rprogress_show_perc', 'value' => '1'),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Percentage - Color Custom', 'blokco' ),
					'param_name' => 'rprogress_perc_color_custom',
					'dependency' => array('element' => 'rprogress_perc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Color', 'blokco' ),
					'param_name' => 'rprogress_color',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Progress bar - Base Color', 'blokco' ),
					'param_name' => 'rprogress_base_color',
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Thickness', 'blokco' ),
					'param_name' => 'rprogress_thickness',
					'value' => array( esc_html__( '.1', 'blokco' ) => '.1', esc_html__( '.2', 'blokco' ) => '.2', esc_html__( '.3', 'blokco' ) => '.3', esc_html__( '.4', 'blokco' ) => '.4', esc_html__( '.5', 'blokco' ) => '.5') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => '.2'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
	
	
	/* Number Counter Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Number Counter", "blokco" ),
			"base" => "blokco_counter",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'blokco' ),
					'value' => array(
						esc_html__( 'Font Awesome', 'blokco' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'blokco' ) => 'openiconic',
						esc_html__( 'Typicons', 'blokco' ) => 'typicons',
						esc_html__( 'Entypo', 'blokco' ) => 'entypo',
						esc_html__( 'Linecons', 'blokco' ) => 'linecons',
						esc_html__( 'Mono Social', 'blokco' ) => 'monosocial',
						esc_html__( 'Material', 'blokco' ) => 'material',
					),
					'admin_label' => true,
					'param_name' => 'type',
					'description' => esc_html__( 'Select icon library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_fontawesome',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'fontawesome',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_openiconic',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'openiconic',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'openiconic',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_typicons',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'typicons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'typicons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_entypo',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'entypo',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'entypo',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_linecons',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'linecons',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'linecons',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_monosocial',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'monosocial',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'monosocial',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'blokco' ),
					'param_name' => 'icon_material',
					'value' => '',
					// default value to backend editor admin_label
					'settings' => array(
						'emptyIcon' => true,
						// default true, display an "EMPTY" icon?
						'type' => 'material',
						'iconsPerPage' => 4000,
						// default 100, how many icons per/page to display
					),
					'dependency' => array(
						'element' => 'type',
						'value' => 'material',
					),
					'description' => esc_html__( 'Select icon from library.', 'blokco' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'blokco' ),
					'param_name' => 'counter_icon_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Custom', 'blokco' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'blokco' ),
					'param_name' => 'counter_icon_color_custom',
					'dependency' => array('element' => 'counter_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon - Font size', 'blokco' ),
					'param_name' => 'counter_icon_font',
					'value' => '55px',
					'description' => esc_html__( 'Icon - font size (Add px)', 'blokco' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Background Color', 'blokco' ),
					'param_name' => 'counter_icon_bgcolor',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-bg',
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-bg',
						esc_html__( 'Custom', 'blokco' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Background Color Custom', 'blokco' ),
					'param_name' => 'counter_icon_bgcolor_custom',
					'dependency' => array('element' => 'counter_icon_bgcolor', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon background shape', 'blokco' ),
					'param_name' => 'counter_icon_bgshape',
					'value'      => array(
						esc_html__( 'Round', 'blokco' ) => 'counter-icon-round',
						esc_html__( 'Rounded', 'blokco' ) => 'counter-icon-rounded',
						esc_html__( 'Square', 'blokco' ) => 'counter-icon-square',
						esc_html__( 'Plain(With no background color)', 'blokco' ) => 'counter-icon-plain'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'counter_title',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'counter_title_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'counter_title_color_custom',
					'dependency' => array('element' => 'counter_title_color', 'value' => 'custom'),
					'weight' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title - Font size (Add px)', 'blokco' ),
					'param_name' => 'counter_title_font',
					'value' => '15px'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number to count', 'blokco' ),
					'param_name' => 'counter_number',
					'value'      => ''
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Text next to number', 'blokco' ),
					'param_name' => 'counter_number_text',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Number - Color', 'blokco' ),
					'param_name' => 'counter_number_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Number - Color Custom', 'blokco' ),
					'param_name' => 'counter_number_color_custom',
					'dependency' => array('element' => 'counter_number_color', 'value' => 'custom'),
					'weight' => 1,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number - Font size (Add px)', 'blokco' ),
					'param_name' => 'counter_number_font',
					'value' => '30px'
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Align', 'blokco' ),
					'param_name' => 'counter_align',
					'value'      => array(
						esc_html__( 'Center', 'blokco' ) => 'counter-align-center',
						esc_html__( 'Left', 'blokco' ) => 'counter-align-left',
						esc_html__( 'Right', 'blokco' ) => 'counter-align-right'
					)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'blokco' ),
					'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.','blokco'),
					'param_name' => 'extra_class'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
	
	/* Pricing Table Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Pricing Table", "blokco" ),
			"base" => "blokco_pricing",
			'as_parent' => array( 'only' => 'blokco_pricing_item' ),
			'show_settings_on_create' => true,
			"category" => esc_html__( "Blokco", "blokco"),
			"params" => array(
				array(
					'type' 					=> 'dropdown',
					'heading' 				=> esc_html__( 'Columns', 'blokco' ),
					'param_name' 			=> 'pricing_columns',
					'value' 					=> array( esc_html__( '1', 'blokco' ) => 'one-cols', esc_html__( '2', 'blokco' ) => 'two-cols', esc_html__( '3', 'blokco' ) => 'three-cols', esc_html__( '4', 'blokco' ) => 'four-cols', esc_html__( '5', 'blokco' ) => 'five-cols', esc_html__( '6', 'blokco' ) => 'six-cols') ,
					'param_holder_class' 	=> 'vc_colored-dropdown',
					'std' 					=> 'three-cols'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			),
			'js_view'                 => 'VcColumnView'
		) 
	);
	/* Pricing Table Column Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'Pricing Column', 'blokco' ),
			'base'     => 'blokco_pricing_item',
			'as_child' => array( 'only' => 'blokco_pricing' ),
			'category' => esc_html__( 'Blokco', 'blokco' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'pricing_title',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Popular Plan?', 'blokco' ),
					'param_name' => 'pricing_popular',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__( 'Check to highlight this plan among others. You should check this only for a plan to keep your pricing table in good looks.', 'blokco' ),
					'std' => 0,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Popular reason', 'blokco' ),
					'param_name' => 'pricing_popular_reason',
					'description' => esc_html__( 'Enter couple of words to show why this plan is popular. Example: Big savings.', 'blokco' ),
					'value'      => '',
					'weight'     => 1,
					'dependency' => array(
						'element' => 'pricing_popular',
						'value' => '1',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price', 'blokco' ),
					'param_name' => 'pricing_price',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Currency', 'blokco' ),
					'param_name' => 'pricing_currency',
					'value'      => '$',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Price Term', 'blokco' ),
					'description' => esc_html__( 'Enter term for the price of the plan. Example: Per Month.', 'blokco' ),
					'param_name' => 'pricing_term',
					'value'      => esc_html__( 'Per Month', 'blokco' ),
					'weight'     => 1
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Features', 'blokco' ),
					'group'      => esc_html__( 'Features', 'blokco' ),
					'param_name' => 'pricing_features',
					'value' => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'This is included', 'blokco' ),
						),
						array(
							'title' => esc_html__( 'And this too', 'blokco' ),
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Feature', 'blokco' ),
							'param_name' => 'title',
							'description' => esc_html__( 'Enter features of the pricing plan.', 'blokco' ),
							'admin_label' => true,
						),
					),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Button Label', 'blokco' ),
					'param_name' => 'pricing_button',
					'value'      => esc_html__( 'Sign Up Now!', 'blokco' ),
					'group'      => esc_html__( 'Button', 'blokco' ),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Color', 'blokco' ),
					'group'      => esc_html__( 'Button', 'blokco' ),
					'param_name' => 'pricing_button_color',
					'value' => array( esc_html__( 'Primary Color', 'blokco' ) => 'btn-primary', esc_html__( 'Secondary Color', 'blokco' ) => 'secondary-btn', esc_html__( 'Orange', 'blokco' ) => 'btn-warning', esc_html__( 'Green', 'blokco' ) => 'btn-success', esc_html__( 'Red', 'blokco' ) => 'btn-danger', esc_html__( 'Blue', 'blokco' ) => 'btn-info') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'primary'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'blokco' ),
					'group'      => esc_html__( 'Button', 'blokco' ),
					'param_name' => 'pricing_button_link',
					'description' => esc_html__( 'Enter/Select URL for the button.', 'blokco' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		)
	);
		
		
	/* Timeline Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Timeline", "blokco" ),
			"base" => "blokco_timeline",
			'as_parent' => array( 'only' => 'blokco_timeline_item' ),
			'show_settings_on_create' => true,
			"category" => esc_html__( "Blokco", "blokco"),
			"params" => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Skin', 'blokco' ),
					'param_name' => 'skin',
					'value' => array( esc_html__( 'Light', 'blokco' ) => 'timeline-light', esc_html__( 'Dark', 'blokco' ) => 'timeline-dark') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'timeline-light'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			),
			'js_view'                 => 'VcColumnView'
		) 
	);
	/* Timeline Item Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'Timeline Item', 'blokco' ),
			'base'     => 'blokco_timeline_item',
			'as_child' => array( 'only' => 'blokco_timeline' ),
			'category' => esc_html__( 'Blokco', 'blokco' ),
			'params'   => array(
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Timeline Content', 'blokco' ),
					'param_name' => 'content',
					'description' => esc_html__( 'Add text to for the timeline item.', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Month', 'blokco' ),
					'param_name' => 'month',
					'description' => esc_html__( 'Select month for the timeline or roadmap.', 'blokco' ),
					'value' => array(
						__( 'None', 'blokco' ) => '',
						__( 'January', 'blokco' ) => 'Jan',
						__( 'february', 'blokco' ) => 'Feb',
						__( 'March', 'blokco' ) => 'Mar',
						__( 'April', 'blokco' ) => 'Apr',
						__( 'May', 'blokco' ) => 'May',
						__( 'June', 'blokco' ) => 'Jun',
						__( 'July', 'blokco' ) => 'Jul',
						__( 'August', 'blokco' ) => 'Aug',
						__( 'September', 'blokco' ) => 'Sep',
						__( 'October', 'blokco' ) => 'Oct',
						__( 'November', 'blokco' ) => 'Nov',
						__( 'December', 'blokco' ) => 'Dec',
					),
					'admin_label' => true,
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'Jan',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Year', 'blokco' ),
					'description'    => esc_html__( 'Enter year for the roadmap or timeline', 'blokco' ),
					'admin_label' => true,
					'param_name' => 'year',
					'value'      => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Time stamp background color', 'blokco' ),
					'param_name' => 'timestamp_bg',
					'description' => esc_html__( 'Choose color style to use as background of the month/year block.', 'blokco' ),
					'value' => array(
						__( 'Theme Secondary Color', 'blokco' ) => 'secondary-bg',
						__( 'Theme Primary Color', 'blokco' ) => 'accent-bg',
						__( 'Custom Color', 'blokco' ) => 'custom-timeline-bg',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'secondary-bg',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Time stamp custom background color', 'blokco' ),
					'param_name' => 'timestamp_custom_bg',
					'dependency' => array('element' => 'timestamp_bg', 'value' => 'custom-timeline-bg'),
					'weight'     => 1
				),
			)
		)
	);
		
		
	/* Social Icons Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Social Icons", "blokco" ),
			"base" => "blokco_social",
			"category" => esc_html__( "Blokco", "blokco"),
			"params" => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Social Profiles', 'blokco' ),
					'param_name' => 'social_profiles',
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Website', 'blokco' ),
							'param_name' => 'type',
							'description' => esc_html__( 'Choose social platform website.', 'blokco' ),
							'admin_label' => true,
							'value' => array(
								esc_html__( 'Facebook', 'blokco' ) => 'fa-facebook',
								esc_html__( 'Twitter', 'blokco' ) => 'fa-twitter',
								esc_html__( 'Pinterest', 'blokco' ) => 'fa-pinterest',
								esc_html__( 'Google Plus', 'blokco' ) => 'fa-google-plus',
								esc_html__( 'Youtube', 'blokco' ) => 'fa-youtube-play',
								esc_html__( 'Instagram', 'blokco' ) => 'fa-instagram',
								esc_html__( 'Vimeo', 'blokco' ) => 'fa-vimeo',
								esc_html__( 'RSS', 'blokco' ) => 'fa-rss',
								esc_html__( 'Dropbox', 'blokco' ) => 'fa-dropbox',
								esc_html__( 'BitBucket', 'blokco' ) => 'fa-bitbucket',
								esc_html__( 'Flickr', 'blokco' ) => 'fa-flickr',
								esc_html__( 'FourSquare', 'blokco' ) => 'fa-foursquare',
								esc_html__( 'GitHub', 'blokco' ) => 'fa-github',
								esc_html__( 'GitTip', 'blokco' ) => 'fa-gittip',
								esc_html__( 'Linkedin', 'blokco' ) => 'fa-linkedin',
								esc_html__( 'Pagelines', 'blokco' ) => 'fa-pagelines',
								esc_html__( 'Skype', 'blokco' ) => 'fa-skype',
								esc_html__( 'Tumblr', 'blokco' ) => 'fa-tubmlr',
								esc_html__( 'TripAdvisor', 'blokco' ) => 'fa-tripadvisor',
								esc_html__( 'VK', 'blokco' ) => 'fa-vk',
								esc_html__( 'Email Address', 'blokco' ) => 'fa-envelope',
							),
							'param_holder_class' => 'vc_colored-dropdown',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'URL', 'blokco' ),
							'param_name' => 'url',
							'description' => esc_html__( 'Enter your social profile URL.', 'blokco' ),
							'admin_label' => true,
						),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Align', 'blokco' ),
					'param_name' => 'align',
					'description' => esc_html__( 'Choose alignment of the icons', 'blokco' ),
					'value' => array(
						__( 'Left', 'blokco' ) => 'imi-social-icons-left',
						__( 'Center', 'blokco' ) => 'imi-social-icons-center',
						__( 'Right', 'blokco' ) => 'imi-social-icons-right',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'imi-social-icons-round',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icons Shape', 'blokco' ),
					'param_name' => 'shape',
					'description' => esc_html__( 'Choose shape of icons', 'blokco' ),
					'value' => array(
						__( 'Round', 'blokco' ) => 'imi-social-icons-round',
						__( 'Rounded', 'blokco' ) => 'imi-social-icons-rounded',
						__( 'Square', 'blokco' ) => 'imi-social-icons-square',
						__( 'Plain', 'blokco' ) => 'imi-social-icons-plain',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'imi-social-icons-round',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icons Size', 'blokco' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Choose size of icons', 'blokco' ),
					'value' => array(
						__( 'Small', 'blokco' ) => 'imi-social-icons-small',
						__( 'Medium', 'blokco' ) => 'imi-social-icons-medium',
						__( 'Large', 'blokco' ) => 'imi-social-icons-large',
						__( 'Extra Large', 'blokco' ) => 'imi-social-icons-xlarge',
						__( 'Custom', 'blokco' ) => 'imi-social-icons-custom',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'imi-social-icons-medium',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Icons Custom Box Size', 'blokco' ),
					'param_name' => 'custom_size',
					'description' => esc_html__('Enter social icons custom box size in px. For example enter: 40px', 'blokco'),
					'dependency' => array(
						'element' => 'size',
						'value' => 'imi-social-icons-custom',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Icons Custom Spacing', 'blokco' ),
					'param_name' => 'custom_spacing',
					'description' => esc_html__('Enter social icons custom spacing between each icon in px. For example enter: 10px', 'blokco'),
					'dependency' => array(
						'element' => 'size',
						'value' => 'imi-social-icons-custom',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Icons Custom Font Size', 'blokco' ),
					'param_name' => 'custom_font_size',
					'description' => esc_html__('Enter social icons custom font size in px. For example enter: 20px', 'blokco'),
					'dependency' => array(
						'element' => 'size',
						'value' => 'imi-social-icons-custom',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Color Style', 'blokco' ),
					'param_name' => 'color',
					'description' => esc_html__( 'Choose color scheme/style for icons.', 'blokco' ),
					'value' => array(
						__( 'Brands Color', 'blokco' ) => 'imi-social-icons-bc',
						__( 'Theme Primary Color', 'blokco' ) => 'imi-social-icons-tc',
						__( 'Theme Secondary Color', 'blokco' ) => 'imi-social-icons-sc',
						__( 'GrayScale', 'blokco' ) => 'imi-social-icons-gc',
						__( 'Custom', 'blokco' ) => 'imi-social-icons-cc',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'imi-social-icons-bc',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icons custom bg color', 'blokco' ),
					'param_name' => 'custom_bg',
					'dependency' => array('element' => 'color', 'value' => 'imi-social-icons-cc'),
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icons custom font color', 'blokco' ),
					'param_name' => 'custom_color',
					'dependency' => array('element' => 'color', 'value' => 'imi-social-icons-cc'),
					'weight'     => 1
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hover Color Style', 'blokco' ),
					'param_name' => 'hover_color',
					'description' => esc_html__( 'Choose color scheme/style for icons hover.', 'blokco' ),
					'value' => array(
						__( 'Brands Color', 'blokco' ) => 'imi-social-icons-hover-bc',
						__( 'Theme Primary Color', 'blokco' ) => 'imi-social-icons-hover-tc',
						__( 'Theme Secondary Color', 'blokco' ) => 'imi-social-icons-hover-sc',
						__( 'GrayScale', 'blokco' ) => 'imi-social-icons-hover-gc',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'imi-social-icons-tc',
					'dependency' => array('element' => 'color', 'value_not_equal_to' => 'imi-social-icons-cc'),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			),
		) 
	);
		
		
	/* Google Maps Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Google Map", "blokco" ),
			"base" => "blokco_maps",
			"category" => esc_html__( "Blokco", "blokco"),
			"params" => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'API Key', 'blokco' ),
					'param_name' => 'map_api',
					'description' => esc_html__( 'Enter your API key. Your map may not function correctly without one. Please ensure you have enabled the Geocoding API in the Google APIs Dashboard.', 'blokco' ).'<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" rel="noopener noreferrer">'.esc_html__('Get an API','blokco').'</a>',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'blokco' ),
					'param_name' => 'map_width',
					'description' => esc_html__( 'Width(px) of your map. If left blank then it will take 100% area of the container.', 'blokco' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'blokco' ),
					'param_name' => 'map_height',
					'description' => esc_html__( 'Height(px) of your map. Default is 300px.', 'blokco' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Zoom Level', 'blokco' ),
					'param_name' => 'map_zoom',
					'description' => esc_html__( 'A value from 0 (the world) to 21 (street level).', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Allow dragging the map to move it around.', 'blokco' ),
					'param_name' => 'map_drag',
					'value' => array(
						__( 'Yes', 'blokco' ) => 'yes',
						__( 'No', 'blokco' ) => 'no',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'yes',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Scroll to zoom', 'blokco' ),
					'description' => esc_html__( 'Allow scrolling over the map to zoom in or out.', 'blokco' ),
					'param_name' => 'map_scroll',
					'value' => array(
						__( 'Yes', 'blokco' ) => 'yes',
						__( 'No', 'blokco' ) => 'no',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'no',
					'dependency' => array(
						'element' => 'map_drag',
						'value' => 'yes',
					),
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Style', 'blokco' ),
					'param_name' => 'map_style',
					'description' => esc_html__( 'Copy and paste predefined styles here from.', 'blokco' ).'<a href="http://snazzymaps.com/" target="_blank" rel="noopener noreferrer">'.esc_html__('Snazzy Maps','blokco').'</a>',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address', 'blokco' ),
					'param_name' => 'marker_address',
					'description' => esc_html__( 'The name of a place, town, city, or even a country. Can be an exact address too.', 'blokco' ),
					'admin_label' => true,
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Marker Icon', 'blokco' ),
					'description' => esc_html__( 'Replaces the default map marker with your own image.', 'blokco' ),
					'param_name' => 'marker_icon',
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Info window text', 'blokco' ),
					'param_name' => 'content',
					'description' => esc_html__( 'Add text to show on the tooltip of the marker.', 'blokco' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Info window max width', 'blokco' ),
					'param_name' => 'marker_info_width',
					'description' => esc_html__( 'Enter maximum width for info window. Enter in px for example 150px', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'When should Info Windows be displayed?', 'blokco' ),
					'param_name' => 'marker_info_show',
					'value' => array(
						__( 'Click', 'blokco' ) => 'click',
						__( 'Mouse over', 'blokco' ) => 'mouseover',
						__( 'Always', 'blokco' ) => 'always',
					),
					'param_holder_class' => 'vc_colored-dropdown',
					'std' => 'click',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			)
		) 
	);
		
		
	/* VC Sections Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'VC Section', 'blokco' ),
			'base'     => 'blokco_vc_section',
			'category' => esc_html__( 'Blokco', 'blokco' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'VC Section', 'blokco' ),
					'param_name' => 'sidebar',
					'admin_label' => true,
					'value'      => $vc_sections
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			)
		)
	);
	
		
	/* Logo Carousel Shortcode
		=====================================================*/
		vc_map( array(
			'name'     => esc_html__( 'Logo Carousel', 'blokco' ),
			'base'     => 'blokco_img_carousel',
			'icon' 	   => 'icon-wpb-images-carousel',
			'category' => esc_html__( 'Blokco', 'blokco' ),
			'params'   => array(
				array(
					'type' => 'attach_images',
					'heading' => __( 'Images', 'blokco' ),
					'param_name' => 'images',
					'value' => '',
					'description' => __( 'Select images from media library.', 'blokco' ),
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Image size', 'blokco' ),
					'param_name' => 'img_size',
					'value' => 'thumbnail',
					'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Image opacity', 'blokco' ),
					'param_name' => 'opacity',
					'value' => array(
						__( '10%', 'blokco' ) => 'lc-opacity1',
						__( '20%', 'blokco' ) => 'lc-opacity2',
						__( '30%', 'blokco' ) => 'lc-opacity3',
						__( '40%', 'blokco' ) => 'lc-opacity4',
						__( '50%', 'blokco' ) => 'lc-opacity5',
						__( '60%', 'blokco' ) => 'lc-opacity6',
						__( '70%', 'blokco' ) => 'lc-opacity7',
						__( '80%', 'blokco' ) => 'lc-opacity8',
						__( '90%', 'blokco' ) => 'lc-opacity9',
						__( '100%', 'blokco' ) => 'lc-opacity10',
					),
					'description' => __( 'Select opacity from 10% to 100%.', 'blokco' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'On click action', 'blokco' ),
					'param_name' => 'onclick',
					'value' => array(
						__( 'Open prettyPhoto', 'blokco' ) => 'link_image',
						__( 'None', 'blokco' ) => 'link_no',
						__( 'Open custom links', 'blokco' ) => 'custom_link',
					),
					'description' => __( 'Select action for click event.', 'blokco' ),
				),
				array(
					'type' => 'exploded_textarea_safe',
					'heading' => __( 'Custom links', 'blokco' ),
					'param_name' => 'custom_links',
					'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'blokco' ),
					'dependency' => array(
						'element' => 'onclick',
						'value' => array( 'custom_link' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Custom link target', 'blokco' ),
					'param_name' => 'custom_links_target',
					'description' => __( 'Select how to open custom links.', 'blokco' ),
					'dependency' => array(
						'element' => 'onclick',
						'value' => array( 'custom_link' ),
					),
					'value' => array(
						__( 'Same Window', 'blokco' ) => '_self',
						__( 'New window', 'blokco' ) => '_blank',
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Logo per view', 'blokco' ),
					'param_name' => 'grid_column',
					'value' => array( esc_html__( '1', 'blokco' ) => 1, esc_html__( '2', 'blokco' ) => 2, esc_html__( '3', 'blokco' ) => 3, esc_html__( '4', 'blokco' ) => 4, esc_html__( '5', 'blokco' ) => 5, esc_html__( '6', 'blokco' ) => 6, esc_html__( '7', 'blokco' ) => 7, esc_html__( '8', 'blokco' ) => 8, esc_html__( '9', 'blokco' ) => 9, esc_html__( '10', 'blokco' ) => 10) ,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel next/prev arrows?', 'blokco'),
					'param_name' => 'carousel_arrows',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 1,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel next/prev arrows position?', 'blokco' ),
					'param_name' => 'carousel_arrows_position',
					'value' => array( esc_html__( 'Below Carousel', 'blokco' ) => 'owl-arrows-bottom', esc_html__( 'Over Carousel', 'blokco' ) => 'owl-arrows-over') ,
					'param_holder_class' => 'vc_colored-dropdown',
					'dependency' => array(
						'element' => 'carousel_arrows',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show carousel pagination?', 'blokco'),
					'param_name' => 'carousel_pagi',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Autoplay Carousel?', 'blokco'),
					'param_name' => 'carousel_autoplay',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'std' => 0,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Auto Rotate Timeout?', 'blokco' ),
					'param_name' => 'carousel_autoplay_timeout',
					'description' => esc_html__('Autoplay interval timeout. 1000 = 1 second.', 'blokco'),
					'std' => '',
					'dependency' => array(
						'element' => 'carousel_autoplay',
						'value' => '1',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Loop carousel?', 'blokco' ),
					'param_name' => 'carousel_loop',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('If you want the carousel to keep rotating using pagination and naxt/prev buttons without scrolling back.', 'blokco'),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Show next/prev items?', 'blokco' ),
					'param_name' => 'carousel_faded',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want the carousel to show next and previous item in a faded view', 'blokco'),
					'std' => 1,
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__('Overflow Hidden?', 'blokco' ),
					'param_name' => 'carousel_overflow',
					'value' => array( esc_html__( 'Yes', 'blokco' ) => true ),
					'description' => esc_html__('Check this option if you want to keep the carousel in the fixed width of the container of the page with no overflow view on slide. This can hide the outside border/shadow of the item blocks.', 'blokco'),
					'std' => 0,
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				)
			)
		)
	);
		
	
	/* Popup video button Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Popup video button", "blokco" ),
			"base" => "blokco_video_button",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Video Link', 'blokco' ),
					'param_name' => 'video_btn_link',
					'description' => esc_html__( 'Enter link to video (YouTube or Vimeo).', 'blokco' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter title to show with the video button', 'blokco' ),
					'admin_label' => true,
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-color',
						esc_html__( 'Custom', 'blokco' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button size', 'blokco' ),
					'param_name' => 'video_btn_size',
					'value'      => array(
						esc_html__( 'Small', 'blokco' ) => 'video-btn-small',
						esc_html__( 'Medium', 'blokco' ) => 'video-btn-medium',
						esc_html__( 'Large', 'blokco' ) => 'video-btn-large',
						esc_html__( 'Extra Large', 'blokco' ) => 'video-btn-xlarge'
					),
					'std' => 'video-btn-small',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button shape', 'blokco' ),
					'param_name' => 'video_btn_shape',
					'value'      => array(
						esc_html__( 'Round', 'blokco' ) => 'video-btn-round',
						esc_html__( 'Square', 'blokco' ) => 'video-btn-square',
						esc_html__( 'Rounded', 'blokco' ) => 'video-btn-rounded'
					),
					'std' => 'video-btn-round',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Button Align', 'blokco' ),
					'param_name' => 'video_btn_align',
					'value'      => array(
						esc_html__( 'Center', 'blokco' ) => 'video-btn-align-center',
						esc_html__( 'Left', 'blokco' ) => 'video-btn-align-left',
						esc_html__( 'Right', 'blokco' ) => 'video-btn-align-right'
					),
					'std' => 'video-btn-align-center',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Play icon - Color', 'blokco' ),
					'param_name' => 'video_btn_icon_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Custom', 'blokco' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Play icon - Color Custom', 'blokco' ),
					'param_name' => 'video_btn_icon_color_custom',
					'dependency' => array('element' => 'video_btn_icon_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Play icon - Background Color', 'blokco' ),
					'param_name' => 'video_btn_icon_bgcolor',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-bg',
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-bg',
						esc_html__( 'Custom', 'blokco' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Play icon - Background Color Custom', 'blokco' ),
					'param_name' => 'video_btn_icon_bgcolor_custom',
					'dependency' => array('element' => 'video_btn_icon_bgcolor', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
		
		
	/* Opening Hours Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Opening Hours", "blokco" ),
			"base" => "blokco_opening_hours",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Day row', 'blokco' ),
					'param_name' => 'opening_days',
					'value' => urlencode( json_encode( array(
						array(
							'day' => esc_html__( 'Monday', 'blokco' ),
							'hours' => esc_html__( '09:00 to 05:00', 'blokco' ),
						),
						array(
							'day' => esc_html__( 'Tuesday', 'blokco' ),
							'hours' => esc_html__( '09:00 to 05:00', 'blokco' ),
						),
					) ) ),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Day', 'blokco' ),
							'param_name' => 'day',
							'description' => esc_html__( 'Enter weekday', 'blokco' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Hours', 'blokco' ),
							'param_name' => 'hours',
							'description' => esc_html__( 'Enter working hours', 'blokco' ),
							'admin_label' => true,
						),
					),
					'callbacks' => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Separator border style', 'blokco' ),
					'param_name' => 'opening_hours_sstyle',
					'value'      => array(
						esc_html__( 'Dark', 'blokco' ) => 'opening-hours-sstyle-dark',
						esc_html__( 'Light', 'blokco' ) => 'opening-hours-sstyle-light'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Text Color', 'blokco' ),
					'param_name' => 'opening_hours_color',
					'value'      => array(
						esc_html__( 'Theme Secondary color', 'blokco' ) => 'secondary-color',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Custom', 'blokco' ) => 'custom',
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Text Color Custom', 'blokco' ),
					'param_name' => 'opening_hours_color_custom',
					'dependency' => array('element' => 'opening_hours_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
		
		
	/* Stats Box Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Stats Box", "blokco" ),
			"base" => "blokco_stats_box",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Accent Color', 'blokco' ),
					'param_name' => 'accent_color',
					'value'      => array(
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-bg',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-bg',
						esc_html__( 'Custom', 'blokco' ) => 'custom',
					),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Accent Color Custom', 'blokco' ),
					'param_name' => 'accent_color_custom',
					'dependency' => array('element' => 'accent_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Active', 'blokco' ),
					'param_name' => 'active_stat',
					'value'      => array(
						esc_html__( 'No', 'blokco' ) => 'active-stats-box-no',
						esc_html__( 'Yes', 'blokco' ) => 'active-stats-box'
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number', 'blokco' ),
					'param_name' => 'number',
					'value'      => '',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number subscript', 'blokco' ),
					'param_name' => 'number_sup',
					'value'      => '',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Number - Font Size (Add px)', 'blokco' ),
					'param_name' => 'number_size',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Number - Color', 'blokco' ),
					'param_name' => 'number_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Number - Color Custom', 'blokco' ),
					'param_name' => 'number_color_custom',
					'dependency' => array('element' => 'number_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'blokco' ),
					'param_name' => 'title',
					'value'      => '',
					'admin_label' => true,
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title - Font Size (Add px)', 'blokco' ),
					'param_name' => 'title_size',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'blokco' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'blokco' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'blokco' ),
					'param_name' => 'desc',
					'value'      => '',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Description - Font Size (Add px)', 'blokco' ),
					'param_name' => 'desc_size',
					'value'      => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Description - Color', 'blokco' ),
					'param_name' => 'desc_color',
					'value'      => array(
						esc_html__( 'Custom', 'blokco' ) => 'custom',
						esc_html__( 'Theme primary color', 'blokco' ) => 'accent-color',
						esc_html__( 'Theme secondary color', 'blokco' ) => 'secondary-color'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Description - Color Custom', 'blokco' ),
					'param_name' => 'desc_color_custom',
					'dependency' => array('element' => 'desc_color', 'value' => 'custom'),
					'weight'     => 1
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'blokco' ),
					'param_name' => 'box_link',
					'description' => esc_html__( 'Enter/Select URL for the stats box.', 'blokco' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
		
	/* Countdown Shortcode
		=====================================================*/
		vc_map( array(
			"name" => esc_html__( "Countdown Timer", "blokco" ),
			"base" => "blokco_countdown",
			"category" => esc_html__( "Blokco", "blokco"),
			"class" => "",
			"params" => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Skin', 'blokco' ),
					'param_name' => 'skin',
					'value'      => array(
						esc_html__( 'Light Background', 'blokco' ) => 'imi-countdown-light',
						esc_html__( 'Dark Background', 'blokco' ) => 'imi-countdown-dark',
						esc_html__( 'Theme Colors Background', 'blokco' ) => 'imi-countdown-tc',
						esc_html__( 'Plain Light Text', 'blokco' ) => 'imi-countdown-light-text',
						esc_html__( 'Plain Dark Text', 'blokco' ) => 'imi-countdown-dark-text',
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Size', 'blokco' ),
					'param_name' => 'size',
					'value'      => array(
						esc_html__( 'Normal', 'blokco' ) => 'imi-countdown-normal',
						esc_html__( 'Compact', 'blokco' ) => 'imi-countdown-compact'
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'End Date', 'blokco' ),
					'heading'    => esc_html__( 'Enter countdown end date in this format yy/mm/dd. Fox example: 2018/12/01', 'blokco' ),
					'param_name' => 'enddate',
					'value'      => '2018/12/01',
					'admin_label' => true,
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'blokco' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'blokco' )
				),
			)
		) 
	);
	
	
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Blokco_Pricing extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_Blokco_Timeline extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Blokco_Opening_Hours extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Video_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Pricing_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Timeline_Item extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Project extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Services extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Team extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Teaminfo extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Ibox extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Fblock extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Counter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Rprogress extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Vc_Section extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Img_Carousel extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Social extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Maps extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Stats_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Blokco_Countdown extends WPBakeryShortCode {
	}
}