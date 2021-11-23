<?php
/*Front end view of timeline shortcode
==================================*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

<ul class="timeline <?php echo esc_attr($skin); ?> <?php echo esc_attr( $css_class ); ?>">
	<?php if ( ! empty( $content ) ) { ?>
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	<?php } ?>
</ul>