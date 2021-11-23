<?php
/*Front end view of logo carousel shortcode
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



$post_output = '<div class="'.esc_attr( $css_class ).' '.esc_html($carousel_arrows_position).' '.$carousel_overflow_class.' '.$carousel_padded_class.'">';
$post_output .= '<div class="carousel-wrapper">';

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
$owl_margin = 25;

$post_output .= '<div class="equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw imi-logo-carousel" data-columns="'.esc_attr($grid_column).'" data-columns-tab="3" data-columns-mobile="2" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';

$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';
$pretty_rand = 'link_image' === $onclick ? ' data-rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"' : '';

if ( 'link_image' === $onclick ) {
	wp_enqueue_script( 'prettyphoto' );
	wp_enqueue_style( 'prettyphoto' );
}

if ( '' === $images ) {
	$images = '-1,-2,-3';
}

if ( 'custom_link' === $onclick ) {
	$custom_links = vc_value_from_safe( $custom_links );
	$custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;


foreach ( $images as $attach_id ) :
						
							$i ++;
							if ( $attach_id > 0 ) {
								$post_thumbnail = wpb_getImageBySize( array(
									'attach_id' => $attach_id,
									'thumb_size' => $img_size,
								) );
							} else {
								$post_thumbnail = array();
								$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
								$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
							}
							$thumbnail = $post_thumbnail['thumbnail'];
							$post_output .= '<li class="item"><div class="logo-carousel-item equal-height-column '.$opacity.'"><div><div>';
									if ( 'link_image' === $onclick ){
										$p_img_large = $post_thumbnail['p_img_large'];
										$post_output .= '<a class="prettyphoto" href="'.$p_img_large[0].'" '.$pretty_rand.'>';
										$post_output .= $thumbnail;
										$post_output .= '</a>';
									}
									elseif( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ){
										$post_output .= '<a href="'.$custom_links[ $i ].'"'.( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ).'>';
										$post_output .= $thumbnail;
										$post_output .= '</a>';
									} else {
										$post_output .= $thumbnail;
									}
								$post_output .= '</div></div></div></li>';
						endforeach;
	

	$post_output .= '</ul></div></div>';

$post_output .= '</div>';
echo wp_kses($post_output, $blokco_allowed_tags);
?>