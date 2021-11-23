<?php
/*Front end view of services shortcode
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
	$bgstyle_styles[] = 'background-color:' . $blokco_style_bg_custom;
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
if($blokco_style_radius != '0px'){
	$brc = 'border-radius-items';
} else {
	$brc = '';
}


$post_output = '<div class="'.esc_attr( $css_class ).' '.$brc.' border-radius-'.esc_html($blokco_style_radius).' '.esc_html($blokco_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($blokco_style_spacing).' '.esc_html($blokco_style_skin).'  '.esc_html($bgstyle_class).' '.$carousel_overflow_class.' '.$carousel_padded_class.' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.'">';
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} elseif($view=="grid"){
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
	$post_output .= '<div class="imi-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw services-carousel services-list" data-columns="'.esc_attr($grid_column).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
}
elseif($view=="list")
{
	$post_output .= '<ul class="services-list services-listing">';
}
elseif($view=="grid")
{
	$post_output .= '<ul class="grid-columns-'.esc_attr($grid_column).' isotope-grid '.$eqhe.' services-list" '.$masonry.'>';
}

$post_args = array('post_type'=>'imi_services', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_services_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$thumbnail = get_the_post_thumbnail(get_the_ID(),$img_size);
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => '450x400') );
	$thumbnail = $post_thumbnail;
}

$icon_style = '';
$icon_styles = array();
if( !empty( $icon_size ) ) {
	$icon_styles[] = 'font-size:' . esc_attr( $icon_size );
}

if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}

$title_style = '';
$title_styles = array();
if( !empty( $title_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $title_size );
}

if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}

$icon = get_post_meta(get_the_ID(), 'blokco_service_icon', true);
$iimage = get_post_meta(get_the_ID(), 'blokco_service_icon_image', true);
$iimage_src = wp_get_attachment_image_src( $iimage, 'full', '', array() );
if($iimage_src != ''){
	$icon = '<img src="'.$iimage_src[0].'" alt="img">';
} else {
	if($icon != ''){
		$icon = '<i class="fa '.$icon.'"'.$icon_style.'></i>';
	} else {
		$icon = '<i class="fa fa-camera"'.$icon_style.'></i>';
	}
}

$hasmedia = '';
if($view=="list")
// List View
{
	$post_output .= '<li class="'.$blokco_style_hover.' site-item service-list-item format-standard post-item-content '.$thumb.'"'.$bgstyle_style.'>';
	if($thumb != 'no-service-media'){
		if($thumb == 'icon-service-media'){
			$post_output .= '<div class="service-media"><div class="service-icon">';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= $icon;
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</div></div>';
		} else {
			$post_output .= '<div class="service-media"><div class="service-imagen imi-item-media">';
			if(has_post_thumbnail())
			{
				if($linked == 1){
					$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
				}
				$post_output .= $thumbnail;
				if($linked == 1){
					$post_output .= '</a>';
				}
			} else {
				if($linked == 1){
					$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
				}
				$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="img" width="100%">';
				if($linked == 1){
					$post_output .= '</a>';
				}
			}
			$post_output .= '</div>';
		}
	}
	if($show_title == 1 || $show_excerpt == 1 || $more == 1){
		$post_output .= '<div class="service-item-content">';
		if($show_title == 1){
			$post_output .= '<h4>';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= get_the_title();
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</h4>';
		}
		if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
			$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
		}
		if($more == 1){
			$post_output .= '<a href="'.get_permalink().'" class="basic-link">'.$more_text.'</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '</li>';
}
else
{
	if($view=="carousel"){
	$post_output .= '<li class="item '.$blokco_style_hover.' site-item">
				 <div class="grid-item service-grid-item service-carousel-item format-standard '.$thumb.' '.$align.'">';
	} else {
	$post_output .= '<li class="grid-item service-grid-item service-masonry-item format-standard '.$thumb.' '.$align.'">
					<div class="'.$blokco_style_hover.' site-item grid-item-inner">';
	}
	if($thumb == 'icon-service-media'){
		$post_output .= '<div class="service-item-grid-content post-item-content equal-height-column"'.$bgstyle_style.'>';
	}
	if($thumb != 'no-service-media'){
		if($thumb == 'icon-service-media'){
			$post_output .= '<div class="service-media"><div class="service-icon">';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= $icon;
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</div></div>';
		} else {
			$post_output .= '<div class="service-media"><div class="service-imagen imi-item-media">';
			if(has_post_thumbnail())
			{
				if($linked == 1){
					$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
				}
				$post_output .= $thumbnail;
				if($linked == 1){
					$post_output .= '</a>';
				}
			} else {
				if($linked == 1){
					$post_output .= '<a href="'.get_the_permalink().'" class="media-box">';
				}
				$post_output .= '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="img" width="100%">';
				if($linked == 1){
					$post_output .= '</a>';
				}
			}
			$post_output .= '</div>';
		}
	}
	if($show_title == 1 || $show_excerpt == 1 || $more == 1){
		if($thumb != 'icon-service-media'){
			$post_output .= '<div class="service-item-grid-content post-item-content equal-height-column"'.$bgstyle_style.'>';
		}
		if($show_title == 1){
			$post_output .= '<h4'.$title_style.'>';
			if($linked == 1){
				$post_output .= '<a href="'.get_the_permalink().'">';
			}
			$post_output .= get_the_title();
			if($linked == 1){
				$post_output .= '</a>';
			}
			$post_output .= '</h4>';
		}
		if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
			$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
		}
		if($more == 1){
			$post_output .= '<div class="spacer-10"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
		}
		if($thumb != 'icon-service-media'){
			$post_output .= '</div>';
		}
	}
	if($thumb == 'icon-service-media'){
		$post_output .= '</div>';
	}
	$post_output .= '</div></li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
elseif($view=="list")
{
	$post_output .= '</ul>';
}
else
{
	$post_output .= '</ul></div>';
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