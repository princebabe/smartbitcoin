<?php
/*Front end view of project shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $blokco_allowed_tags;

if($view=="carousel")
{
	$theme_info = wp_get_theme();
	wp_enqueue_style('owl-carousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
	wp_enqueue_style('owl-carousel2', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
	wp_enqueue_script('owlcarousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );


if($carousel_pagi==1){
	$carousel_pagi_class = 'carousel-pagination-active';
} else {
	$carousel_pagi_class = '';
}

$bgstyle_classes = array();
$bgstyle_class = '';

if( !empty( $blokco_style_bg ) ) {
	$bgstyle_classes[] = ' '.esc_attr($blokco_style_bg);
}

if( !empty( $bgstyle_classes ) ) {
	$bgstyle_class = join(' ', $bgstyle_classes);
}

$bgstyle_style = '';
$bgstyle_styles = array();

if( $blokco_style_bg == 'custom-bg-style' && !empty( $blokco_style_bg_custom ) ) {
	$bgstyle_styles[] = 'background-color:' . esc_attr( $blokco_style_bg_custom );
}
if( !empty( $bgstyle_styles ) ) {
	$bgstyle_style = ' style="'. implode( ';', $bgstyle_styles ) .'"';
}

if($masonry_show == 1){
	$masonry = 'data-layout="masonry"';
	$eqhe = '';
} else {
	$masonry = '';
	$eqhe = 'equal-heighter';
}

if($carousel_faded==1){
	$carousel_padded_class = '';
} else {
	$carousel_padded_class = 'owl-padded';
}

if($carousel_overflow==1){
	$carousel_overflow_class = 'owl-no-padding-class';
} else {
	$carousel_overflow_class = '';
}
if($blokco_style_radius != '0px'){
	$brc = 'border-radius-items';
} else {
	$brc = '';
}

$post_output = '<div class="sort-destination-parent '.esc_attr( $css_class ).' '.$brc.' border-radius-'.esc_html($blokco_style_radius).' '.esc_html($blokco_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($blokco_style_spacing).' '.esc_html($blokco_style_skin).'  '.esc_html($bgstyle_class).' '.$carousel_overflow_class.' '.$carousel_padded_class.' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.'" '.$masonry.'>';
// Project Filters
if($filters == 1 && $view != "carousel"){
	if($terms!=''){
    	$project_cats = explode(',', $terms);
	} else {
    	$project_cats = get_terms('imi_projects_category');
	}
	$post_output .= '<ul class="project-filter-nav sort-source" data-sort-id="portfolio" data-option-key="filter">';
	$post_output .= '<li data-option-value="*" class="active"><span>' .esc_html__('Show All', 'blokco').'</span></li>';
	foreach($project_cats as $project_cat) {
		if($terms!=''){
			$term = get_term( $project_cat, 'imi_projects_category' );
		} else {
			$term = $project_cat;
		}
		$post_output .= '<li data-option-value=".cat-'.$term->slug.'"><span>'. $term->name.'</span></li>';
	}
	$post_output .= '</ul>';
} else {
	$post_output .= '';
}
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} else {
	$post_output .= '<div class="grid-wrapper">';
}
if($view=="carousel")
{
	if ( is_rtl() )	{
		$data_rtl = 'yes';
	} else {
		$data_rtl = 'no';
	}
	if($carousel_arrows==1){
		$carrows = 'yes';
	} else {
		$carrows = 'no';
	}
	if($carousel_pagi==1){
		$cpagi = 'yes';
	} else {
		$cpagi = 'no';
	}
	if($carousel_loop==1){
		$cloop = 'yes';
	} else {
		$cloop = 'no';
	}
	if($carousel_autoplay!=''){
		$cauto = 'yes';
	} else {
		$cauto = 'no';
	}
	if($blokco_style_spacing == 'non-spaced-items'){
		$owl_margin = 0;
	} else {
		$owl_margin = 30;
	}
	$post_output .= '<div class="imi-styled-row '.$carousel_pagi_class.'"><ul class="owl-carousel equal-heighter carousel-fw project-carousel" data-columns="'.esc_attr($grid_column).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
}
elseif($view=="grid")
{
	if($filters == 1){
		$post_output .= '<ul class="grid-columns-'.esc_attr($grid_column).' portfolio-list '.$eqhe.' sort-destination" data-sort-id="portfolio">';
	} else {
		$post_output .= '<ul class="grid-columns-'.esc_attr($grid_column).' portfolio-list '.$eqhe.' isotope-grid" '.$masonry.'>';
	}
}


$post_args = array('post_type'=>'imi_projects', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_projects_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}

$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$thumbnail = '';
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$post_full_thumbnail = get_the_post_thumbnail_url(get_the_ID(),'full');
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'blokco-600x400');
	$post_full_thumbnail = get_the_post_thumbnail_url(get_the_ID(),'full');
	$thumbnail = $post_thumbnail;
}

$hasmedia = '';
if($view=="carousel"){
	$post_output .= '<li class="item site-item '.$blokco_style_hover.'">
					<div class="grid-item project-grid-item portfolio-item portfolio-carousel-item '.$style;
	if($zoom == 1){
		$post_output .= ' format-zoom">';
	} else {
		$post_output .= ' format-link">';	
	}
} else {
	$post_output .= '<li class="grid-item portfolio-item project-grid-item format-standard '.$style;
	$term_slug = get_the_terms(get_the_ID(), 'imi_projects_category');
	if (!empty($term_slug)) {
		foreach ($term_slug as $term) {
		  $post_output .= ' cat-'.$term->slug.' ';
		}
	}
	if($zoom == 1){
		$post_output .= ' format-image">';
	} else {
		$post_output .= ' format-standard">';	
	}
	$post_output .= '<div class="'.$blokco_style_hover.' site-item grid-item-inner">';
}

	if($zoom == 1){
		$post_output .= '<a href="'.$post_full_thumbnail.'" class="magnific-image">';
	} else {
		$post_output .= '<a href="'.get_the_permalink().'">';
	}

	$post_output .= '<div class="project-media imi-item-media">';
	if(has_post_thumbnail())
	{
		$post_output .= '<div class="media-box">'.$thumbnail.'</div>';
	} else {
		$post_output .= '<div class="project-media imi-item-media">';
		$post_output .= '<div class="media-box"><img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="img" height="100%"></div>';
		$post_output .= '</div>';
	}
	if($style == 'projects-grid-style1'){
		$post_output .= '<div class="project-overlay">';
		if($show_category == 1){
			$post_output .= '<div class="project-categories">';
			$post = get_post();
			$categories = get_the_terms( $post->ID, 'imi_projects_category' );
			foreach( $categories as $category ) {
				$post_output .= '<span>'.esc_html( $category->name ).'</span>';
			}
			$post_output .= '</div>';
		}
		if($show_title == 1 || $show_excerpt == 1){
			$post_output .= '<div class="project-overlay-info">';
			if($show_title == 1){
				$post_output .= '<h4><span class="project-name">'.get_the_title().'</span></h4>';
			}
			if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
				$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></div></a>';
	}
	if($style == 'projects-grid-style2'){
		$post_output .= '</div></a>';
		if($show_title == 1 || $show_category == 1){
			$post_output .= '<div class="project-info-static equal-height-column post-item-content"'.$bgstyle_style.'>';
			if($show_title == 1){
				$post_output .= '<h4><a href="'.get_the_permalink().'"><span class="project-name">'.get_the_title().'</span></a></h4>';
			}
			if($show_category == 1){
				$post_output .= '<div class="project-categories">';
				$post = get_post();
				$categories = get_the_terms( $post->ID, 'imi_projects_category' );
				foreach( $categories as $category ) {
					$post_output .= '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
				}
				$post_output .= '</div>';
			}
			if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
				$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
			}
			$post_output .= '</div>';
		}
	}
	$post_output .= '</div></li>';

endwhile; endif; wp_reset_postdata();
$post_output .= '</ul>';
if($view=="carousel"){
	$post_output .= '</div></div>';
} else {
	$post_output .= '</div>';
}

$post_output .= '</div>';
if($pagination == 1){
	$post_output .= '<div class="spacer-10"></div>';
	$GLOBALS['wp_query'] = $post_list;
	$post_output .= blokco_pagination();
	wp_reset_query();
}
echo wp_kses($post_output, $blokco_allowed_tags);
?>