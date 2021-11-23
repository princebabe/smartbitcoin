<?php
/*Front end view of popup video button shortcode
==================================*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$link = ( '||' === $video_btn_link ) ? '' : $video_btn_link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
	$a_rel = $link['rel'];
}
if ( $use_link ) {
	$attributes[] = 'href="' . trim( $a_href ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	if ( ! empty( $a_target ) ) {
		$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	}
	if ( ! empty( $a_rel ) ) {
		$attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
	}
	$attributes = implode( ' ', $attributes );
}

$icon_classes = array();
$icon_class = '';

if( !empty( $video_btn_icon_color ) && $video_btn_icon_color != 'custom' ) {
	$icon_classes[] = ' '.esc_attr($video_btn_icon_color);
}
if( !empty( $video_btn_icon_bgcolor ) && $video_btn_icon_bgcolor != 'custom' ) {
	$icon_classes[] = ' '.esc_attr($video_btn_icon_bgcolor);
}
if( !empty( $video_btn_icon_bgshape )) {
	$icon_classes[] = ' '.esc_attr($video_btn_icon_bgshape);
}

if( !empty( $icon_classes ) ) {
	$icon_class = ' '. join(' ', $icon_classes);
}

$icon_style = '';
$icon_styles = array();
if( $video_btn_icon_color == 'custom' && !empty( $video_btn_icon_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $video_btn_icon_color_custom );
}
if( $video_btn_icon_bgcolor == 'custom' && !empty( $video_btn_icon_bgcolor_custom ) ) {
	$icon_styles[] = 'background-color:' . esc_attr( $video_btn_icon_bgcolor_custom );
}
if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}


$title_classes = array();
$title_class = '';

if( !empty( $title_color ) && $title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($title_color);
}

if( !empty( $title_classes ) ) {
	$title_class = ' '. join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( $title_color == 'custom' && !empty( $title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $title_color_custom );
}
if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


	$output = '<div class="popup-video-button '.esc_attr($video_btn_align).' '.esc_attr($video_btn_size).' '.esc_attr($video_btn_shape).'  '.esc_attr( $css_class ).'"><div><div>';
				if ( $use_link ) {
					$output .= '<a '.$attributes.' class="popup-video-link magnific-video '.esc_attr($icon_class).'"'.$icon_style.'>';
				}
					$output .= '<i class="fa fa-play"></i>';
				if ( $use_link ) {
					$output .= '</a>';
				}
              	$output .= '<h4 class="'.esc_attr($title_class).'" '.$title_style.'>'.$title.'</h4></div></div></div>';
		
		
global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>