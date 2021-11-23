<?php
/*Front end view of team shortcode
==================================*/
$align = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $blokco_allowed_tags;

if($view=="carousel")
{
	$theme_info = wp_get_theme();
	wp_enqueue_style('owl-carousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
	wp_enqueue_style('owl-carousel2', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
	wp_enqueue_script('owlcarousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if($carousel_pagi==1){
	$carousel_pagi_class = 'carousel-pagination-active';
} else {
	$carousel_pagi_class = '';
}

if($carousel_faded==1){
	$carousel_padded_class = '';
} else {
	$carousel_padded_class = 'owl-padded';
}

if($carousel_overflow==1){
	$carousel_overflow_class = 'owl-no-padding-class';
} else {
	$carousel_overflow_class = '';
}

if($round_thumb==1){
	$thumb_shape = '';
} else {
	$thumb_shape = 'team-square-thumb';
}

	
$bgstyle_classes = array();
$bgstyle_class = '';

if( !empty( $blokco_style_bg ) ) {
	$bgstyle_classes[] = ' '.esc_attr($blokco_style_bg);
}

if( !empty( $bgstyle_classes ) ) {
	$bgstyle_class = join(' ', $bgstyle_classes);
}

$bgstyle_style = '';
$bgstyle_styles = array();

if( $blokco_style_bg == 'custom-bg-style' && !empty( $blokco_style_bg_custom ) ) {
	$bgstyle_styles[] = 'background-color:' . esc_attr( $blokco_style_bg_custom );
}
if( !empty( $bgstyle_styles ) ) {
	$bgstyle_style = ' style="'. implode( ';', $bgstyle_styles ) .'"';
}

if($masonry_show == 1){
	$masonry = 'data-layout="masonry"';
	$eqhe = '';
} else {
	$masonry = '';
	$eqhe = 'equal-heighter';
}
if($blokco_style_radius != '0px'){
	$brc = 'border-radius-items';
} else {
	$brc = '';
}

$post_output = '<div class="'.esc_attr( $css_class ).' '.$brc.' border-radius-'.esc_html($blokco_style_radius).' '.esc_html($blokco_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($blokco_style_spacing).' '.esc_html($blokco_style_skin).'  '.esc_html($bgstyle_class).' team-grid-'.esc_html($style).' '.esc_html($align).' '.$carousel_overflow_class.' '.esc_html($carousel_padded_class).' '.$thumb_shape.' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.'">';
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} else {
	$post_output .= '<div class="grid-wrapper">';
}
if($view=="carousel")
{
	if ( is_rtl() )	{
		$data_rtl = 'yes';
	} else {
		$data_rtl = 'no';
	}
	if($carousel_arrows==1){
		$carrows = 'yes';
	} else {
		$carrows = 'no';
	}
	if($carousel_pagi==1){
		$cpagi = 'yes';
	} else {
		$cpagi = 'no';
	}
	if($carousel_loop==1){
		$cloop = 'yes';
	} else {
		$cloop = 'no';
	}
	if($carousel_autoplay!=''){
		$cauto = 'yes';
	} else {
		$cauto = 'no';
	}
	if($blokco_style_spacing == 'non-spaced-items'){
		$owl_margin = 0;
	} else {
		$owl_margin = 30;
	}
	$post_output .= '<div class="imi-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw team-carousel" data-columns="'.esc_attr($grid_column).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
}
else
{
	$post_output .= '<ul data-columns="'.esc_attr($grid_column).'" class="imi-grid-iso grid-columns-'.esc_attr($grid_column).' isotope-grid '.$eqhe.'" '.$masonry.'>';
}


$post_args = array('post_type'=>'imi_team', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'imi_team_category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}
$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$position = get_post_meta(get_the_ID(), 'blokco_staff_position', true);
$facebook = get_post_meta(get_the_ID(), 'blokco_staff_member_facebook', true);
$twitter = get_post_meta(get_the_ID(), 'blokco_staff_member_twitter', true);
$gplus = get_post_meta(get_the_ID(), 'blokco_staff_member_gplus', true);
$linkedin = get_post_meta(get_the_ID(), 'blokco_staff_member_linkedin', true);
$pinterest = get_post_meta(get_the_ID(), 'blokco_staff_member_pinterest', true);
$email = get_post_meta(get_the_ID(), 'blokco_staff_member_email', true);
$phone = get_post_meta(get_the_ID(), 'blokco_staff_member_phone', true);
$social = '';
$social_data = array();
$social_data = array('facebook'=>$facebook, 'twitter'=>$twitter, 'google-plus'=>$gplus, 'linkedin'=>$linkedin, 'pinterest'=>$pinterest);
if($facebook!=''||$twitter!=''||$gplus!=''||$linkedin!=''||$pinterest!=''||$email!=''||$phone!='')
{
	$social .= '<div class="social-icons-list">';
	foreach($social_data as $key=>$value)
	{
		if($value!='')
		{
			$url = $value;
			
			$social .= '<a href="'.$url.'">
						  <i class="fa fa-'.$key.'"></i>
					  </a>';
		}
	}
	$social .= '</div>';
}
$thumbnail = '';
if($img_size != ''){
	$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
	$thumbnail = $post_thumbnail['thumbnail'];
} else {
	$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'blokco-400x400');
	$thumbnail = $post_thumbnail;
}

$hasmedia = '';
// Carousel View
if($style=="style1")
{
	if($view=="carousel"){
		$post_output .= '<li class="item">
					 	<div class="grid-item team-item team-grid-item team-carousel-item format-standard">';
	} else{
		$post_output .= '<li class="grid-item team-grid-item format-standard team-item">
						<div class="grid-item-content">';
	}
	$post_output .= '<div class="'.$blokco_style_hover.' site-item equal-height-column post-item-content"'.$bgstyle_style.'>';
	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '<div class="team-media imi-item-media">';
		if($permalink == 1){
			$post_output .= '<a href="'.get_permalink().'" class="media-box">';
		}
		$post_output .= $thumbnail;
		if($permalink == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</div>';
	}
	$post_output .= '<h4>';
	if($permalink == 1){
		$post_output .= '<a href="'.get_permalink().'">';
	}
	$post_output .= get_the_title();
	if($permalink == 1){
		$post_output .= '</a>';
	}
	$post_output .= '</h4>';
	if($staff_position == 1 && $position != ''){
		$post_output .= '<div class="meta-data">'.$position.'</div>';
	}
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="team-item-excerpt post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($staff_email == 1 && $email != ''){
		$post_output .= '<a href="mailto:'.$email.'" class="team-item-contact-link secondary-bg">'.$email.'</a>';
	}
	if($staff_phone == 1 && $phone != ''){
		$post_output .= '<a href="tel:'.$phone.'" class="team-item-contact-link secondary-bg">'.$phone.'</a>';
	}
	if($staff_social == 1){
		$post_output .= $social;
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	$post_output .= '</div></div></li>';
}

// Grid View
else
{
	if($view=="carousel"){
		$post_output .= '<li class="item">
					 	<div class="grid-item team-item team-grid-item team-carousel-item format-standard">';
	} else{
		$post_output .= '<li class="grid-item team-grid-item format-standard team-item">
						<div class="grid-item-content">';
	}
	$post_output .= '<div class="'.$blokco_style_hover.' site-item equal-height-column post-item-content"'.$bgstyle_style.'>';
	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '<div class="team-media imi-item-media">';
		if($permalink == 1){
			$post_output .= '<a href="'.get_permalink().'" class="media-box">';
		}
		$post_output .= $thumbnail;
		if($permalink == 1){
			$post_output .= '</a>';
		}
		$post_output .= '</div>';
		$post_output .= '<div class="team-item-cont">';
	}
	$post_output .= '<h4>';
	if($permalink == 1){
		$post_output .= '<a href="'.get_permalink().'">';
	}
	$post_output .= get_the_title();
	if($permalink == 1){
		$post_output .= '</a>';
	}
	$post_output .= '</h4>';
	if($staff_position == 1 && $position != ''){
		$post_output .= '<div class="meta-data">'.$position.'</div>';
	}
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="team-item-excerpt post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($staff_social == 1){
		$post_output .= $social;
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div><a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
	}
	if(has_post_thumbnail() && $thumb == 1)
	{
		$post_output .= '</div>';
	}
	$post_output .= '</div></div></li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
else
{
	$post_output .= '</ul></div>';
}

$post_output .= '</div>';
if($pagination == 1){
	$post_output .= '<div class="spacer-10"></div>';
	$GLOBALS['wp_query'] = $post_list;
	$post_output .= blokco_pagination();
	wp_reset_query();
}
echo wp_kses($post_output, $blokco_allowed_tags);
?>