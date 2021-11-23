<?php
/*Front end view of featured block shortcode
==================================*/

$rprogress_perc = $rprogress_title = $rprogress_color = $rprogress_thickness = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$theme_info = wp_get_theme();
wp_enqueue_script('knob-js', BLOKCO_THEME_PATH . '/assets/js/jquery.knob.js', array('jquery'), $theme_info->get( 'Version' ), true);
wp_enqueue_script('appear-js', BLOKCO_THEME_PATH . '/assets/js/jquery.appear.js', array('jquery'), $theme_info->get( 'Version' ), true);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if($rprogress_perc != ''){
	$rprogress_perc_final = $rprogress_perc;
} else {
	$rprogress_perc_final = '1';
}


$title_classes = array();
$title_class = '';
if( !empty( $rprogress_title_color ) && $rprogress_title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($rprogress_title_color);
}
if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( $rprogress_title_color == 'custom' && !empty( $rprogress_title_color_custom ) ) {
	$title_styles[] = 'color:' . $rprogress_title_color_custom;
}
if( !empty($title_styles) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


$perc_classes = array();
$perc_class = '';
if( !empty( $rprogress_perc_color ) && $rprogress_perc_color != 'custom' ) {
	$perc_classes[] = ' '.esc_attr($rprogress_perc_color);
}
if( !empty( $perc_classes ) ) {
	$perc_class = join(' ', $perc_classes);
}

$perc_style = '';
$perc_styles = array();
if( $rprogress_perc_color == 'custom' && !empty( $rprogress_perc_color_custom ) ) {
	$perc_styles[] = 'color:' . $rprogress_perc_color_custom;
}
if( !empty($perc_styles) ) {
	$perc_style = ' style="'. implode( ';', $perc_styles ) .'"';
}


	$output = '<div class="circular-bar '. esc_attr( $css_class ).'">
                    <input class="knob" data-linecap="round" data-fgColor="'.$rprogress_color.'" data-thickness="'.$rprogress_thickness.'" value="'.$rprogress_perc_final.'" data-readOnly="true" data-displayInput="false" data-bgColor="'.$rprogress_base_color.'">
                    <div class="circular-bar-content"><div><div>
						 <strong class="'.$title_class.'"'.$title_style.'>'.$rprogress_title.'</strong>';
						if($rprogress_show_perc){
                      		$output .= '<label class="'.$perc_class.'"'.$perc_style.'>'.$rprogress_perc_final.'%</label>';
						}
    $output .= '</div></div></div></div>';
		
		
	global $blokco_allowed_tags;
	echo wp_kses($output, $blokco_allowed_tags);
?>