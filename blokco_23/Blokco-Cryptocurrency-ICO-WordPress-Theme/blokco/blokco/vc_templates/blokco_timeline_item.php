<?php
/*Front end view of timeline item shortcode
==================================*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $blokco_allowed_tags;

$stamp_classes = array();
$stamp_class = '';

if( !empty( $timestamp_bg ) && $timestamp_bg != 'custom-timeline-bg' ) {
	$stamp_classes[] = ' '.esc_attr($timestamp_bg);
}

if( !empty( $stamp_classes ) ) {
	$stamp_class = ' '. join(' ', $stamp_classes);
}

$stamp_style = '';
$stamp_styles = array();
if( $timestamp_bg == 'custom-timeline-bg' && !empty( $timestamp_custom_bg ) ) {
	$stamp_styles[] = 'background-color:' . esc_attr( $timestamp_custom_bg );
}
if( !empty( $stamp_styles ) ) {
	$stamp_style = ' style="'. implode( ';', $stamp_styles ) .'"';
}
?>
<li>
	<div class="timeline-badge <?php echo esc_attr($stamp_class); ?>" <?php echo ''.$stamp_style; ?>><?php echo esc_attr($month); ?><span><?php echo esc_attr($year); ?></span><div class=" <?php echo esc_attr($stamp_class); ?>" <?php echo ''.$stamp_style; ?>></div></div>
	<div class="timeline-panel">
	
		<div class="description">
			<?php echo wp_kses($content, $blokco_allowed_tags); ?>
		</div>
	</div>
</li>