<?php
/*Front end view of featured block shortcode
==================================*/

$a_href = $a_title = $a_target = $a_rel = $link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );


$link = ( '||' === $box_link ) ? '' : $box_link;
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


$number_classes = array();
$number_class = '';

if( !empty( $number_color ) && $number_color != 'custom' ) {
	$number_classes[] = ' '.esc_attr($number_color);
}

if( !empty( $number_classes ) ) {
	$number_class = join(' ', $number_classes);
}

$number_style = '';
$number_styles = array();
if( !empty( $number_size ) ) {
	$number_styles[] = 'font-size:' . esc_attr( $number_size );
}

if( $number_color == 'custom' && !empty( $number_color_custom ) ) {
	$number_styles[] = 'color:' . esc_attr( $number_color_custom );
}

if( !empty( $number_styles ) ) {
	$number_style = ' style="'. implode( ';', $number_styles ) .'"';
}

$title_classes = array();
$title_class = '';

if( !empty( $title_color ) && $title_color != 'custom' ) {
	$title_classes[] = ' '.esc_attr($title_color);
}

if( !empty( $title_classes ) ) {
	$title_class = join(' ', $title_classes);
}

$title_style = '';
$title_styles = array();
if( !empty( $title_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $title_size );
}

if( $title_color == 'custom' && !empty( $title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $title_color_custom );
}

if( !empty( $title_styles ) ) {
	$title_style = ' style="'. implode( ';', $title_styles ) .'"';
}


$desc_classes = array();
$desc_class = '';

if( !empty( $desc_color ) && $desc_color != 'custom' ) {
	$desc_classes[] = ' '.esc_attr($desc_color);
}

if( !empty( $desc_classes ) ) {
	$desc_class = join(' ', $desc_classes);
}

$desc_style = '';
$desc_styles = array();
if( !empty( $desc_size ) ) {
	$desc_styles[] = 'font-size:' . esc_attr( $desc_size );
}

if( $desc_color == 'custom' && !empty( $desc_color_custom ) ) {
	$desc_styles[] = 'color:' . $desc_color_custom;
}

if( !empty( $desc_styles ) ) {
	$desc_style = ' style="'. implode( ';', $desc_styles ) .'"';
}

$accent_classes = array();
$accent_class = '';

if( !empty( $accent_color ) && $accent_color != 'custom' ) {
	$accent_classes[] = ' '.esc_attr($accent_color);
}

if( !empty( $accent_classes ) ) {
	$accent_class = join(' ', $accent_classes);
}

$accent_style = '';
$accent_styles = array();
if( $accent_color == 'custom' && !empty( $accent_color_custom ) ) {
	$accent_styles[] = 'background:' . $accent_color_custom ;
}

if( !empty( $accent_styles ) ) {
	$accent_style = ' style="'. implode( ';', $accent_styles ) .'"';
}

	
// Start HTML Output
$output = '';
		
		if ( $use_link ) {
			$output .= '<a '.$attributes.'>';
		}
		$output .= '<div class="site-item si-animate-shadow stats-box '.$active_stat.' '.esc_attr( $css_class ).'">';
		$output .= '<div class="stats-box-border '.$accent_class.'"'.$accent_style.'></div>';
		$output .= '<div class="stats-box-cont">';
		if( $number ){
			$output .= '<div class="stats-box-number '.$number_class.'"'.$number_style.'>'.esc_attr($number).'<sub>'.esc_attr($number_sup).'</sub></div>';
		}
		$output .= '<div class="stats-box-content">';
		if( $title ){
			$output .= '<p class="stats-box-title '.$title_class.'"'.$title_style.'>'.esc_attr($title).'</p>';
		}
		if( $desc ){
			$output .= '<p class="stats-box-desc '.$desc_class.'" '.$desc_style.'>'.wpb_js_remove_wpautop( $desc, false ).'</p>';
		}
		$output .= '</div></div></div>';
		
		if ( $use_link ) {
			$output .= '</a>';
		}
		
global $blokco_allowed_tags;
echo wp_kses($output, $blokco_allowed_tags);
?>