<?php
/*Front end view of social shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$icon_style = '';
$icon_styles = array();
if( $size == 'imi-social-icons-custom' && !empty( $custom_size ) ) {
	$icon_styles[] = 'width:' . esc_attr( $custom_size );
	$icon_styles[] = 'height:' . esc_attr( $custom_size );
}
if( $size == 'imi-social-icons-custom' && !empty( $custom_spacing ) ) {
	if( $align == 'imi-social-icons-left' ) {
		$icon_styles[] = 'margin-right:' . esc_attr( $custom_spacing );
	} elseif( $align == 'imi-social-icons-right' ) {
		$icon_styles[] = 'margin-left:' . esc_attr( $custom_spacing );
	} elseif( $align == 'imi-social-icons-center' ) {
		$custom_spacing_new = str_replace('px','',$custom_spacing);
		$custom_spacing_half = intval($custom_spacing_new) / 2;
		$icon_styles[] = 'margin-left:' . esc_attr( $custom_spacing_half ).'px';
		$icon_styles[] = 'margin-right:' . esc_attr( $custom_spacing_half ).'px';
	}
}
if( $size == 'imi-social-icons-custom' && !empty( $custom_font_size ) ) {
	$icon_styles[] = 'font-size:' . esc_attr( $custom_font_size );
}
if( $color == 'imi-social-icons-cc' && !empty( $custom_bg ) ) {
	$icon_styles[] = 'background:' . esc_attr( $custom_bg );
}
if( $color == 'imi-social-icons-cc' && !empty( $custom_color ) ) {
	$icon_styles[] = 'color:' . esc_attr( $custom_color ).'!important';
}
if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}

$values = (array) vc_param_group_parse_atts( $social_profiles );

$output = '
<ul class="shortcode-social-icons imi-social-icons '.$align.' '.$shape.' '.$size.' '.$color.' '.$hover_color.' '.esc_attr( $css_class ).'">';
		foreach ( $values as $k => $v ) {
				$profile = isset( $v['type'] ) ? $v['type'] : '';
				$link = isset( $v['url'] ) ? $v['url'] : '';
			$key = $profile;
			$value = $link;
		  	$string = substr($key, 3);
			if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
			  $output .= '<li class="'.esc_attr($string).'"><a href="mailto:' . esc_url($value) . '"><i class="fa ' . esc_attr($key) . '" '.$icon_style.'></i></a></li>';
		  	}
		  	if (filter_var($value, FILTER_VALIDATE_URL)) {
			  $output .= '<li class="'.esc_attr($string).'"><a href="' . esc_attr($value) . '" target="_blank" '.$icon_style.'><i class="fa ' . esc_attr($key) . '"></i></a></li>';
		  	}
		  	elseif($key == 'fa-skype' && $value != '' && $value != 'Enter Skype ID') {
			  $output .= '<li class="'.esc_attr($string).'"><a href="skype:' . esc_url($value) . '?call" '.$icon_style.'><i class="fa ' . esc_attr($key) . '"></i></a></li>';
		  	}
		}

$output .= '</ul>';
	
		
	global $blokco_allowed_tags;
	echo wp_kses($output, $blokco_allowed_tags);
?>