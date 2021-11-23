<?php
/*Front end view of team shortcode
==================================*/
$a_href = $a_title = $a_target = $a_rel = $ibox_link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';

$link = ( '||' === $ibox_link ) ? '' : $ibox_link;
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

$icon_size_class = '';
if($ibox_icon_size == '16px'){
	$icon_size_class = 'ibox-icon-16';
}elseif($ibox_icon_size == '32px'){
	$icon_size_class = 'ibox-icon-32';
}elseif($ibox_icon_size == '48px'){
	$icon_size_class = 'ibox-icon-48';
}elseif($ibox_icon_size == '64px'){
	$icon_size_class = 'ibox-icon-64';
}

$icon_classes = array();
$icon_class = '';
if( !empty( $ibox_icon_color ) ) {
	$icon_classes[] = ' '.esc_attr($ibox_icon_color);
}
if( !empty( $icon_classes ) ) {
	$icon_class = join(' ', $icon_classes);
}

$icon_style = '';
$icon_styles = array();
if( $ibox_icon_color == 'custom' && !empty( $ibox_icon_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $ibox_icon_color_custom );
	$icon_styles[] = 'background-color:' . esc_attr( $ibox_icon_color_custom );
}
if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}

$icon_i_style = '';
$icon_i_styles = array();
if( $ibox_icon_color == 'custom' && !empty( $ibox_icon_color_custom ) ) {
	$icon_i_styles[] = 'border-color:' . esc_attr( $ibox_icon_color_custom );
}
if( !empty( $icon_i_styles ) ) {
	$icon_i_style = ' style="'. implode( ';', $icon_i_styles ) .'"';
}
$title_classes = array();
$title_class = '';

if( !empty( $ibox_title_color ) && $ibox_title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($ibox_title_color);
}
if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( !empty( $ibox_title_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $ibox_title_size );
}
if( $ibox_title_color == 'custom' && !empty( $ibox_title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $ibox_title_color_custom );
}
if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}

$desc_classes = array();
$desc_class = '';
if( !empty( $ibox_desc_color ) && $ibox_desc_color != 'custom' ) {
	$desc_classes[] = ' '.esc_attr($ibox_desc_color);
}
if( !empty( $desc_classes ) ) {
	$desc_class = join(' ', $desc_classes);
}

$desc_style = '';
$desc_styles = array();
if( !empty($ibox_desc_size) ) {
	$desc_styles[] = 'font-size:' . esc_attr( $ibox_desc_size );
}
if( $ibox_desc_color == 'custom' && !empty( $ibox_desc_color_custom ) ) {
	$desc_styles[] = 'color:' . $ibox_desc_color_custom;
}
if( !empty($desc_styles) ) {
	$desc_style = ' style="'. implode( ';', $desc_styles ) .'"';
}


	$output = '<div class="icon-box '.$ibox_calign.' '.$ibox_border.' '.$icon_size_class.' '.$ibox_shape.' '.esc_attr( $css_class ).'">';
		if ( $use_link ) {
			$output .= '<a '.$attributes.'>';
		}
		$output .= '<div class="ibox-icon'.$icon_class.'" '.$icon_i_style.'>';
		if($iconClass) {
			$output .= '<i class="'.$iconClass.'" '.$icon_style.'></i>';
		}
		$output .= '</div>';
		$output .= '<h4 class="'.$title_class.'"'.$title_style.'>'.$ibox_title.'</h4>';
		if ( $use_link ) {
			$output .= '</a>';
		}
		$output .= '<p class="'.$desc_class.'"'.$desc_style.'>'.$ibox_desc.'</p></div>';
		
		
	global $blokco_allowed_tags;
	echo wp_kses($output, $blokco_allowed_tags);
?>