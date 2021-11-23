<?php
/*Front end view of opening hours shortcode
==================================*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$values = (array) vc_param_group_parse_atts( $opening_days );
$data = array();
foreach ( $values as $k => $v ) {
	$data[] = array(
		'label' => isset( $v['day'] ) ? $v['day'] : '',
		'value' => isset( $v['hours'] ) ? $v['hours'] : '',
	);
}

$widget_classes = array();
$widget_class = '';

if( !empty( $opening_hours_color ) && $opening_hours_color != 'custom' ) {
	$widget_classes[] = ' '.esc_attr($opening_hours_color);
}

if( !empty( $widget_classes ) ) {
	$widget_class = ' '. join(' ', $widget_classes);
}

$widget_style = '';
$widget_styles = array();
if( $opening_hours_color == 'custom' && !empty( $opening_hours_color_custom ) ) {
	$widget_styles[] = 'color:' . esc_attr( $opening_hours_color_custom );
}
if( !empty( $widget_styles ) ) {
	$widget_style = ' style="'. implode( ';', $widget_styles ) .'"';
}


$output = '<div class="opening-hours-table '.esc_attr($widget_class).esc_attr( $css_class ).'"'.$widget_style.'><div class="opening-hours-table-content">
    <ul>';
    	foreach ( $data as $v ) {
      		$output .= '<li class="'.$opening_hours_sstyle.'"><strong>'. esc_attr($v['label']).'</strong>';
      		$output .= '<span>'. esc_attr($v['value']).'</span></li>';
     	}
    $output .= '</ul>';
    $output .= '</div></div>';

global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>