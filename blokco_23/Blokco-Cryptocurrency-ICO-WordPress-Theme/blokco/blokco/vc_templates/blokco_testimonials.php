<?php
/*Front end view of testimonials shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $blokco_allowed_tags;

$theme_info = wp_get_theme();
wp_enqueue_style('owl-carousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
wp_enqueue_style('owl-carousel2', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
wp_enqueue_script('owlcarousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if($carousel_pagi==1){
	$carousel_pagi_class = 'carousel-pagination-active';
} else {
	$carousel_pagi_class = '';
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
if($blokco_style_radius != '0px'){
	$brc = 'border-radius-items';
} else {
	$brc = '';
}

$post_output = '<div class="'.esc_attr( $css_class ).' '.$brc.' border-radius-'.esc_html($blokco_style_radius).' '.esc_html($blokco_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($blokco_style_spacing).' '.esc_html($style).' '.esc_html($blokco_style_skin).'  '.esc_html($bgstyle_class).'  '.$image_position.' '.$carousel_overflow_class.' '.$carousel_padded_class.' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.'">';

if($style == 'testimonials-style3'){
	$post_output .= '<div class="carousel-wrapper">';
} else {
	if($view=="carousel"){
		$post_output .= '<div class="carousel-wrapper">';
	} else {
		$post_output .= '<div class="grid-wrapper">';
	}
}
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

if($masonry_show == 1){
	$masonry = 'data-layout="masonry"';
	$eqhe = '';
} else {
	$masonry = '';
	$eqhe = 'equal-heighter';
}


if($style=="testimonials-style3"){
	$post_output .= '<div class="'.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw testimonials-carousel" data-columns="1" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="yes"  data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
} else {
	if($view=="carousel")
	{
		$post_output .= '<div class="imi-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw testimonials-carousel" data-columns="'.esc_attr($grid_column).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
	}
	elseif($view=="grid")
	{
		$post_output .= '<ul class="grid-columns-'.esc_attr($grid_column).' isotope-grid '.$eqhe.'" '.$masonry.'>';
	}
}

$post_args = array('post_type'=>'imi_testimonials', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_testimonials_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$testi_subtitle = get_post_meta(get_the_ID(), 'blokco_testi_sub_title', true);

$hasmedia = '';
if($style=="testimonials-style1")
{
	// Carousel View
	if($view=="carousel")
	{
		$post_output .= '<li class="'.$blokco_style_hover.' site-item item testimonial-item testimonial-grid-item">
					<div class="post-item-content equal-height-column"'.$bgstyle_style.'>';
	
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if(has_post_thumbnail() || $photo == 1 || $author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if(has_post_thumbnail() && $photo == 1)
			{
				$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '100x100') );
				$thumbnail = $post_thumbnail['thumbnail'];
				$post_output .= '<div class="testimonial-img-block '.$image_radius.'"><div class="imi-item-media">'.$thumbnail.'</div></div>';
			}
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	}

	// Grid View
	else
	{
		$post_output .= '<li class="grid-item testimonial-item testimonial-grid-item format-standard">
						<div class="'.$blokco_style_hover.' site-item post-item-content equal-height-column"'.$bgstyle_style.'>';
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if($photo == 1 || $author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if(has_post_thumbnail() && $photo == 1)
			{
				$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '100x100') );
				$thumbnail = $post_thumbnail['thumbnail'];
				$post_output .= '<div class="testimonial-img-block '.$image_radius.'"><div class="imi-item-media">'.$thumbnail.'</div></div>';
			}
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	}
} elseif($style == "testimonials-style2") {
	// Carousel View
	if($view=="carousel")
	{
		$post_output .= '<li class="'.$blokco_style_hover.' site-item item testimonial-item testimonial-grid-item">
					<div class="post-item-content equal-height-column"'.$bgstyle_style.'>';
	
		if(has_post_thumbnail() && $photo == 1)
		{
			$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '150x150') );
			$thumbnail = $post_thumbnail['thumbnail'];
			$post_output .= '<div class="testimonial-img-block '.$image_radius.'"><div class="imi-item-media">'.$thumbnail.'</div></div>';
		}
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if($author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	} else {
		$post_output .= '<li class="grid-item testimonial-item testimonial-grid-item format-standard">
						<div class="'.$blokco_style_hover.' site-item post-item-content equal-height-column"'.$bgstyle_style.'>';
		if(has_post_thumbnail() && $photo == 1)
		{
			$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '150x150') );
			$thumbnail = $post_thumbnail['thumbnail'];
			$post_output .= '<div class="testimonial-img-block '.$image_radius.'"><div class="imi-item-media">'.$thumbnail.'</div></div>';
		}
		$post_output .= '<blockquote>'.get_the_excerpt().'</blockquote>';
		if($author == 1)
		{
			$post_output .= '<div class="testimonial-info">';
			if($author == 1){
				$post_output .= '<cite><span><span><strong>'.get_the_title().'</strong>';
				if($subtitle == 1){
					$post_output .= $testi_subtitle;
				}
				$post_output .= '</span></span></cite>';
			}
			$post_output .= '</div>';
		}
		$post_output .= '</div></li>';
	}
} elseif($style == "testimonials-style3") {
	$noimgeclass = '';
	if($photo == 0){
		$noimgeclass = 'testimonials-style3-no-image';
	}
	$post_output .= '<li class="'.$blokco_style_hover.' site-item item testimonial-item testimonial-grid-item equal-heighter '.$noimgeclass.'">
					<div class="post-item-content"'.$bgstyle_style.'>';
	
	if(has_post_thumbnail() && $photo == 1)
	{
		$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '400x400') );
		$thumbnail = $post_thumbnail['thumbnail'];
		$post_output .= '<div class="testimonial-img-block equal-height-column '.$image_radius.' "><div class="imi-item-media">'.$thumbnail.'</div></div>';
	}
	$post_output .= '<div class="equal-height-column testimonial-floated-content"><blockquote>'.get_the_excerpt().'</blockquote>';
	if($author == 1){
		$post_output .= '<div class="testimonial-info"><cite><strong>'.get_the_title().'</strong>';
		if($subtitle == 1){
			$post_output .= $testi_subtitle;
		}
		$post_output .= '</cite></div>';
	}
	$post_output .= '</div></div></li>';
}
endwhile; endif; wp_reset_postdata();
$post_output .= '</ul>';
if($style == 'testimonials-style1'){
	if($view=="carousel"){
		$post_output .= '</div></div>';
	} else {
		$post_output .= '</div>';
	}
} else {
	$post_output .= '</div></div>';
}

$post_output .= '</div>';
if($pagination == 1){
	$post_output .= '<div class="spacer-10"></div>';
	$GLOBALS['wp_query'] = $post_list;
	$post_output .= _pagination();
	wp_reset_query();
}
echo wp_kses($post_output, $blokco_allowed_tags);
?>