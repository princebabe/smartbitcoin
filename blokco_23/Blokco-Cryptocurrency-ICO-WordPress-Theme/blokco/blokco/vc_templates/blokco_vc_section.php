<?php
/*Front end view of sidebar shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$get_vc_section = get_page_by_path($sidebar, array(), 'imi_vc_section');
$vc_section_id = $get_vc_section->ID;
?>

<div class="blokco_vc_section<?php echo esc_attr( $css_class ); ?>">
	<style type="text/css" scoped>
		<?php echo get_post_meta( $vc_section_id, '_wpb_shortcodes_custom_css', true ); ?>
	</style>
	<?php if ( $vc_section_id != 0 ) {
		echo do_shortcode($get_vc_section->post_content);
	} ?>
	
</div>