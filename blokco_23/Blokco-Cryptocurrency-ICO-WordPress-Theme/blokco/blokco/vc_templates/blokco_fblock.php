<?php
/*Front end view of featured block shortcode
==================================*/

$a_href = $a_title = $a_target = $a_rel = $fblock_link = $fblock_bg_color = $fblock_style = $type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );

$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';

$link = ( '||' === $fblock_link ) ? '' : $fblock_link;
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


$icon_classes = array();
$icon_class = '';

if( !empty( $fblock_icon_color ) && $fblock_icon_color != 'custom' ) {
	$icon_classes[] = ' '.esc_attr($fblock_icon_color);
}

if( !empty( $icon_classes ) ) {
	$icon_class = join(' ', $icon_classes);
}

$icon_style = '';
$icon_styles = array();

if( $fblock_icon_color == 'custom' && !empty( $fblock_icon_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $fblock_icon_color_custom );
}

if( !empty( $icon_styles ) ) {
	$icon_style = ' style="'. implode( ';', $icon_styles ) .'"';
}



$title_classes = array();
$title_class = '';

if( !empty( $fblock_title_color ) && $fblock_title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($fblock_title_color);
}

if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( !empty( $fblock_title_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $fblock_title_size );
}

if( $fblock_title_color == 'custom' && !empty( $fblock_title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $fblock_title_color_custom );
}

if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


$desc_classes = array();
$desc_class = '';

if( !empty( $fblock_desc_color ) && $fblock_desc_color != 'custom' ) {
	$desc_classes[] = ' '.esc_attr($fblock_desc_color);
}

if( !empty( $desc_classes ) ) {
	$desc_class = join(' ', $desc_classes);
}

$desc_style = '';
$desc_styles = array();
if( !empty( $fblock_desc_size ) ) {
	$desc_styles[] = 'font-size:' . esc_attr( $fblock_desc_size );
}

if( $fblock_desc_color == 'custom' && !empty( $fblock_desc_color_custom ) ) {
	$desc_styles[] = 'color:' . $fblock_desc_color_custom;
}

if( !empty( $desc_styles ) ) {
	$desc_style = ' style="'. implode( ';', $desc_styles ) .'"';
}

$accent_classes = array();
$accent_class = '';

if( !empty( $fblock_accent_color ) && $fblock_accent_color != 'custom' ) {
	$accent_classes[] = ' '.esc_attr($fblock_accent_color);
}

if( !empty( $accent_classes ) ) {
	$accent_class = join(' ', $accent_classes);
}

$accent_style = '';
$accent_styles = array();
if( $fblock_accent_color == 'custom' && !empty( $fblock_accent_color_custom ) ) {
	$accent_styles[] = 'border-top-color:' . $fblock_accent_color_custom ;
}

if( !empty( $accent_styles ) ) {
	$accent_style = ' style="'. implode( ';', $accent_styles ) .'"';
}

	
// Start HTML Output
$output = '';
if($fblock_style == 'fblock-style1'){
	if($fblock_image != ''){
		$output .= '<div class="featured-block '.esc_attr($fblock_style).' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.' '.esc_attr( $css_class ).'">';
		$image_data = wpb_getImageBySize(array(
			'attach_id' => $fblock_image,
			'thumb_size' => $fblock_img_size
		));
		$output .= '<div class="featured-block-image imi-item-media">';
		$output .= $image_data['thumbnail'];
		$output .= '</div>';
		$output .= '<div class="featured-block-cont '.$accent_class.'"'.$accent_style.'>';
		if( $fblock_title ){
			$output .= '<h4 class="featured-block-title '.$title_class.'"'.$title_style.'>'.esc_attr($fblock_title).'</h4>';
		}
		if( $fblock_desc ){
			$output .= '<p class="featured-block-desc '.$desc_class.'" '.$desc_style.'>'.wpb_js_remove_wpautop( $fblock_desc, false ).'</p>';
		}
		
		if ( $use_link ) {
			$output .= '<a '.$attributes.' class="btn btn-block btn-default">'.$fblock_more_btn.'</a>';
		}
		$output .= '</div></div>';
	}
} else {
	$output .= '<div class="site-item si-animate-shadow si-animate-top featured-block '.esc_attr($fblock_style).' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.esc_attr( $css_class ).'">';
	$image_data = wpb_getImageBySize(array(
		'attach_id' => $fblock_image,
		'thumb_size' => $fblock_img_size
	));
	$output .= '<div class="featured-block-image imi-item-media">';
	$output .= $image_data['thumbnail'];
	
	$output .= '<div class="featured-block-content">';
	if( $iconClass ){
		$output .= '<div class="featured-block-icon"><i class="'.$iconClass.' '.esc_attr($icon_class).'"'.$icon_style.'></i></div>';
	}
	$output .= '<div class="featured-block-text">';
	if( $fblock_title ){
		$output .= '<h3 class="featured-block-title '.$title_class.'"'.$title_style.'>'.esc_attr($fblock_title).'</h3>';
	}
	if( $fblock_desc ){
		$output .= '<p class="featured-block-desc '.$desc_class.'"'.$desc_style.'>'.wpb_js_remove_wpautop( $fblock_desc, false ).'</p>';
	}
	$output .= '</div>';
		
	if ( $use_link ) {
		$output .= '<a '.$attributes.' class="btn btn-default">'.$fblock_more_btn.'</a>';
	}
	$output .= '</div></div></div>';
}
		
		
global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>