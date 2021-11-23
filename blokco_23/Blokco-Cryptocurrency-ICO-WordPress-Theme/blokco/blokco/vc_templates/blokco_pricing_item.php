<?php
/*Front end view of pricing table column shortcode
==================================*/

$pricing_title = $pricing_popular = $pricing_popular_reason = $pricing_price = $pricing_currency = $pricing_term = $pricing_features = $pricing_button = $pricing_button_color = $pricing_button_link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = ( '||' === $pricing_button_link ) ? '' : $pricing_button_link;
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

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$values = (array) vc_param_group_parse_atts( $pricing_features );
$data = array();
foreach ( $values as $k => $v ) {
	$data[] = array(
		'label' => isset( $v['title'] ) ? $v['title'] : '',
	);
}

if($pricing_popular == 1){
	$highlight = ' highlight accent-color';
} else {
	$highlight = '';	
}



$output = '<div class="pricing-column'. esc_attr($highlight).'">
  <h3>'. esc_attr($pricing_title);
  if($pricing_popular == 1 && $pricing_popular_reason != ''){
	$output .= '<span class="highlight-reason">'. esc_attr($pricing_popular_reason).'</span>';
  }
  $output .= '</h3>
  <div class="pricing-column-content">
    <h4> <span class="dollar-sign">'. esc_attr($pricing_currency).'</span>'. esc_attr($pricing_price).' </h4>
    <span class="interval">'. esc_attr($pricing_term).'</span>
    <ul class="features">';
    	foreach ( $data as $v ) {
      		$output .= '<li>'. esc_attr($v['label']).'</li>';
     	}
    $output .= '</ul>';
    if ( $use_link ) {
		if($pricing_button != ''){
			$output .= '<a '.$attributes.' class="btn '.esc_attr($pricing_button_color).'">'. esc_attr($pricing_button).'</a>';
		}
	}
    $output .= '</div>
</div>';

global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>