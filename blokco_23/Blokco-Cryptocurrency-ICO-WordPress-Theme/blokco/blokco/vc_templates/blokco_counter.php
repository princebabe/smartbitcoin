<?php
/*Front end view of number counter shortcode
==================================*/

$counter_icon = $counter_icon_color = $counter_icon_color_custom = $counter_icon_font = $counter_title = $counter_title_color = $counter_title_color_custom = $counter_title_font = $counter_number = $counter_number_color = $counter_number_color_custom = $counter_number_color = $counter_align = $counter_number_text = $extra_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$theme_info = wp_get_theme();
wp_enqueue_script('countto-js', BLOKCO_THEME_PATH . '/assets/js/jquery.countto.js', array('jquery'), $theme_info->get( 'Version' ), true);
wp_enqueue_script('appear-js', BLOKCO_THEME_PATH . '/assets/js/jquery.appear.js', array('jquery'), $theme_info->get( 'Version' ), true);
wp_enqueue_script('waypoints', BLOKCO_THEME_PATH . '/assets/js/waypoints.js', array('jquery'), $theme_info->get( 'Version' ), false);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : '';

if($counter_icon_font != ''){
	$icon_dimension = $counter_icon_font;
}

$title_classes = array();
$title_class = '';

if( !empty( $counter_title_color ) && $counter_title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($counter_title_color);
}

if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( !empty( $counter_title_font ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $counter_title_font );
}

if( $counter_title_color == 'custom' && !empty( $counter_title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $counter_title_color_custom );
}

if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


$icon_classes = array();
$icon_class = '';

if( !empty( $counter_icon_color ) && $counter_icon_color != 'custom' ) {
	$icon_classes[] = ' '.esc_attr($counter_icon_color);
}
if( !empty( $counter_icon_bgcolor ) && $counter_icon_bgcolor != 'custom' ) {
	$icon_classes[] = ' '.esc_attr($counter_icon_bgcolor);
}
if( !empty( $counter_icon_bgshape )) {
	$icon_classes[] = ' '.esc_attr($counter_icon_bgshape);
}

if( !empty( $icon_classes ) ) {
	$icon_class = ' '. join(' ', $icon_classes);
}

$icon_style = '';
$icon_styles = array();
if( !empty( $counter_title_font ) ) {
	$icon_styles[] = 'font-size:' . esc_attr( $counter_icon_font );
}
if( $counter_icon_color == 'custom' && !empty( $counter_icon_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $counter_icon_color_custom );
}
if( $counter_icon_bgcolor == 'custom' && !empty( $counter_icon_bgcolor_custom ) ) {
	$icon_styles[] = 'background-color:' . esc_attr( $counter_icon_bgcolor_custom );
}
if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}


$number_classes = array();
$number_class = '';

if( !empty( $counter_number_color ) && $counter_number_color != 'custom' ) {
	$number_classes[] = ' '.esc_attr($counter_number_color);
}

if( !empty( $number_classes ) ) {
	$number_class = join(' ', $number_classes);
}

$number_style = '';
$number_styles = array();
if( !empty( $counter_number_font ) ) {
	$number_styles[] = 'font-size:' . esc_attr( $counter_number_font );
}

if( $counter_number_color == 'custom' && !empty( $counter_number_color_custom ) ) {
	$number_styles[] = 'color:' . esc_attr( $counter_number_color_custom );
}

if( !empty( $number_styles ) ) {
	$number_style = ' style="'. implode( ';', $number_styles ) .'"';
}

	$output = '<div class="cust-counter '.esc_attr($counter_align).' '.esc_attr( $css_class ).' '.$extra_class.'">';
				if( $iconClass ){
					$output .= '<div class="fact-ico'.esc_attr($icon_class).'"'.$icon_style.'><i class="'.esc_attr($iconClass).'" style="height:'.$icon_dimension.';width:'.$icon_dimension.'"></i></div>';
				}
              	$output .= '
              	<div class="timer" data-perc="'.esc_attr($counter_number).'"> <span class="count '.esc_attr($number_class).'"'.$number_style.'>'.esc_attr($counter_number).'</span><span class=" '.esc_attr($number_class).'"'.$number_style.'>'.esc_attr($counter_number_text
				).'</span> </div>
              	<div class="fact '.esc_attr($title_class).'"'.$title_style.'>'.esc_attr($counter_title).'</div>
			  </div>';
		
		
global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>