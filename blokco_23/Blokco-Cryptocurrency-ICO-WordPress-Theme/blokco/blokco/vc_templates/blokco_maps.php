<?php
/*Front end view of maps shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$theme_info = wp_get_theme();
wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$map_api, array('jquery'), $theme_info->get( 'Version' ), true);
if($map_width != ''){
	$width = $map_width;
} else {
	$width = '100%';
}
if($map_height != ''){
	$height = $map_height;
} else {
	$height = '400px';
}
if($marker_icon != ''){
	$icon = wp_get_attachment_url($marker_icon);
} else {
	$icon = get_template_directory_uri().'/assets/images/map_marker.png';
}

$getid = 'imi-map-'.blokco_mapRandomId();
$style = str_replace('<br />','',$map_style);


echo '<div class="imi-google-maps '.esc_attr( $css_class ).'" id="'.$getid.'" data-id="'.$getid.'" style="width:'.$width.'; height:'.$height.';" data-address="'.esc_attr($marker_address).'" data-scroll="'.esc_attr($map_scroll).'" data-mapzoom="'.$map_zoom.'" data-info="'.esc_attr($content).'" data-infowidth="'.esc_attr($marker_info_width).'" data-infoshow="'.esc_attr($marker_info_show).'" data-style="'.esc_attr($style).'" data-drag="'.esc_attr($map_drag).'" data-markericon="'.esc_url($icon).'"></div>';

?>