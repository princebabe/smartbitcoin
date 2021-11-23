<?php
/*Front end view of posts shortcode
==================================*/
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


$post_output = '<div class="'.esc_attr( $css_class ).' '.$brc.' border-radius-'.esc_html($blokco_style_radius).' '.esc_html($blokco_style_border).' '.esc_html($carousel_arrows_position).' '.esc_html($blokco_style_spacing).' '.esc_html($blokco_style_skin).'  '.esc_html($bgstyle_class).' '.$carousel_overflow_class.' '.$carousel_overflow_class.' '.$carousel_padded_class.' '.$blokco_grayscale.' '.$blokco_overlay_bg.' '.$blokco_overlay_bg_opacity.' '.$blokco_overlay_hover.' '.$blokco_grayscale_hover.'">';
if($view=="carousel"){
	$post_output .= '<div class="carousel-wrapper">';
} elseif($view=="grid"){
	$post_output .= '<div class="grid-wrapper">';
}
if ( is_rtl() )	{
	$data_rtl = 'yes';
} else {
	$data_rtl = 'no';
}

if($view=="carousel")
{
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
	$post_output .= '<div class="imi-styled-row equal-heighter '.$carousel_pagi_class.'"><ul class="owl-carousel carousel-fw posts-carousel blog-posts" data-columns="'.esc_attr($grid_column).'" data-autoplay="'.$cauto.'" data-autoplay-timeout="'.$carousel_autoplay_timeout.'" data-pagination="'.$cpagi.'" data-arrows="'.$carrows.'" data-auto-height="no" data-rtl="'.$data_rtl.'" data-loop="'.$cloop.'" data-margin="'.$owl_margin.'">';
}
elseif($view=="full" || $view=="medium")
{
	$post_output .= '<div class="blog-posts">';
}
elseif($view=="grid")
{
	$post_output .= '<ul class="grid-columns-'.esc_attr($grid_column).' isotope-grid '.$eqhe.' blog-posts" '.$masonry.'>';
}


$post_args = array('post_type'=>'post', 'posts_per_page'=>$number, 'paged' => get_query_var('paged'));
if($terms!='')
{
    $terms = explode(',', $terms);
    $post_args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'terms' => $terms,
            'field' => 'term_id',
			'operator'=>'IN'
        ]
    ];
}


$post_list = new WP_Query($post_args);
if($post_list->have_posts()):while($post_list->have_posts()):$post_list->the_post();
$post_format = get_post_format();
$post_format = ($post_format=="")?"image":$post_format;
$post_author_id = get_post_field( 'post_author', get_the_ID() );
$meta_data_date = esc_html(get_the_date(get_option('date_format'), get_the_ID()));
$meta_data_author = '<a href="'. esc_url(get_author_posts_url($post_author_id)).'">'.esc_attr(get_the_author_meta( 'display_name', $post_author_id )).'</a> ';
$comments_count = wp_count_comments(get_the_ID());
$categories = get_the_category();
$categories_list = '';
if(!empty($categories))
{
   foreach($categories as $category)
   {
		$categories_list = '<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>';
   }
}


$post_media = '';
// If only featured image show is active
if($media_image_only == 1){
	$thumbnail = '';
	if($img_size != ''){
		$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
		$thumbnail = $post_thumbnail['thumbnail'];
	} else {
		$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'blokco-600x400');
		$thumbnail = $post_thumbnail;
	}
	if ( has_post_thumbnail() ) {
		$post_media = '<a href="'.get_the_permalink().'" class="media-box">'.$thumbnail.'</a>';
	}
} else
{
	// Else get post media as per the post format
	if($post_format == 'image' || $post_format == 'standard'){
		$thumbnail = '';
		if($img_size != ''){
			$post_thumbnail = wpb_getImageBySize( array('post_id' => get_the_ID(),'thumb_size' => $img_size) );
			$thumbnail = $post_thumbnail['thumbnail'];
		} else {
			$post_thumbnail = get_the_post_thumbnail(get_the_ID(),'blokco-600x400');
			$thumbnail = $post_thumbnail;
		}
		if ( has_post_thumbnail() ) {
			$post_media = '<a href="'.get_the_permalink().'" class="media-box">'.$thumbnail.'</a>';
		}	
	}elseif($post_format == 'gallery'){
		$gallery = '';
		$theme_info = wp_get_theme();
		wp_enqueue_style('owl-carousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
		wp_enqueue_style('owl-carousel2', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
		wp_enqueue_script('owlcarousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
		$speed = (get_post_meta(get_the_ID(), 'blokco_post_slider_speed', true)!='')?get_post_meta(get_the_ID(), 'blokco_post_slider_speed', true):5000;
		$cpagination = get_post_meta(get_the_ID(), 'blokco_post_slider_pagination', true);
		$auto_slide = get_post_meta(get_the_ID(), 'blokco_post_slider_auto_slide', true);
		$direction = get_post_meta(get_the_ID(), 'blokco_post_slider_direction_arrows', true);
		$image_data=  get_post_meta(get_the_ID(),'blokco_post_gallery_images',false);
		$cpagination = !empty($pagination) ? $pagination : 'yes';
		$direction = !empty($direction) ? $direction : 'yes';
		$auto_slide = !empty($auto_slide) ? $auto_slide : '';
		if (count($image_data) > 0) {
			$gallery .= '<div class="carousel-wrapper"><ul class="owl-carousel single-carousel post-media-carousel" data-columns="1" data-autoplay="'.$auto_slide.'" data-pagination="'.$cpagination.'" data-margin="0" data-arrows="'.$direction.'" data-rtl="'.$data_rtl.'" data-loop="no">';
			foreach ($image_data as $custom_gallery_images) {
				$large_src = wp_get_attachment_image_src($custom_gallery_images, 'full');
				$gallery .= '<li class="item"><a href="' . esc_url($large_src[0]) . '" class="popup-image">';
				if($view=="full"){
					$gallery .= wp_get_attachment_image($custom_gallery_images, 'full');
				} else {
					$gallery .= wp_get_attachment_image($custom_gallery_images, 'blokco-600x400');
				}
				$gallery .= '</a></li>';
			}
			$gallery .= '</ul></div>';
		}
		$post_media = wp_kses($gallery, $blokco_allowed_tags);

	}elseif($post_format == 'audio'){
		$audio_code = get_post_meta(get_the_ID(),'blokco_post_uploaded_audio',true);
		if($audio_code != ''){
			$post_media = $audio_code;
		}

	}elseif($post_format == 'video'){
		$video_url = get_post_meta(get_the_ID(),'blokco_post_video_url',true);
		if($video_url != ''){
			$post_media = blokco_video_embed($video_url,"500","338");
		}
	}
}
if($show_date == 1 || $show_author == 1 || $show_comments == 1){
	$post_meta = '<div class="blog-post-details meta-data">';
	if($show_date == 1){
		$post_meta .= '<div class="post-date">'.$meta_data_date.'</div>';
	}
	if($show_author == 1){
		$post_meta .= '<div class="post-author">'.$meta_data_author.'</div>';
	}
	if($show_comments == 1){
		$post_meta .= '<div class="comments-likes"><a href="'.get_the_permalink().'#comments"><i class="fa fa-comments"></i>  '.$comments_count->approved.'</a></div>';
	}
	$post_meta .= '</div>';
} else {
	$post_meta = '';
}
if($show_categories == 1){
	$cat_meta = '<div class="post-categories meta-data"><i class="fa fa-archive"></i> '; 
	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	if ( ! empty( $categories ) ) {
		foreach( $categories as $category ) {
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
		}
		$cat_meta .=  trim( $output, $separator );
	}
	$cat_meta .= '</div>';
} else {
	$cat_meta = '';
}
if($more_style == 'more-style-text'){
	$more_btn = '<a href="'.get_permalink().'" class="basic-link read-more-link">'.$more_text.'</a>';
} else {
	$more_btn = '<a href="'.get_permalink().'" class="btn btn-primary read-more-link">'.$more_text.'</a>';
}

// Carousel View
$hasmedia = '';
if($view=="carousel")
{
	$post_output .= '<li class="'.$blokco_style_hover.' site-item item">
				 <div class="grid-item post blog-masonry-item post-carousel-item post-grid-item format-'.$post_format.' '.$grid_style.'">';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media imi-item-media">'.$post_media.'</div>';
		$hasmedia = 'item-hasmedia';
	}

	$post_output .= '<div class="grid-item-content equal-height-column post-item-content '.$hasmedia.'"'.$bgstyle_style.'>';
	$post_output .= $cat_meta;
	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div>'.$more_btn;
	}
	$post_output .= '</div>
	</div></li>';
}
elseif($view=="medium")
{
	$post_output .= '<div class="'.$blokco_style_hover.' site-item post-list-item post post-item-content format-'.$post_format.'"'.$bgstyle_style.'>
						<div class="row">';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="col-md-4"><div class="post-media imi-item-media">'.$post_media.'</div></div>';
		$hasmedia = 'item-hasmedia';
	}
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="col-md-8">';
	} else {
		$post_output .= '<div class="col-md-12">';	
	}
	$post_output .= '<div class="post-list-item-content '.$hasmedia.'">';
	$post_output .= $cat_meta;
	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4><hr class="fw">';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div>'.$more_btn;
	}
	$post_output .= '</div></div>
			</div>
		</div>';
}
elseif($view=="full")
{
	$post_output .= '<div class="'.$blokco_style_hover.' site-item post post-list-item blog-full-item post-item-content format-'.$post_format.'"'.$bgstyle_style.'>';
	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media imi-item-media">'.$post_media.'</div>';
		$hasmedia = 'item-hasmedia';
	}

	$post_output .= '<div class="full-item-content '.$hasmedia.'">';

	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div>'.$more_btn;
	}
	$post_output .= '</div></div>';
}
else
{
	$post_output .= '<li class="grid-item post post-grid-item blog-masonry-item format-'.$post_format.' '.$grid_style.'">
					<div class="'.$blokco_style_hover.' site-item grid-item-inner">';

	if($media_show == 1 && $post_media != ''){
		$post_output .= '<div class="post-media imi-item-media">'.$post_media.'</div>';
		$hasmedia = 'item-hasmedia';
	}

	$post_output .= '<div class="grid-item-content equal-height-column post-item-content '.$hasmedia.'"'.$bgstyle_style.'>';
	$post_output .= $cat_meta;
	$post_output .= '<h4 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	$post_output .= $post_meta;
	if($show_excerpt == 1 && ($excerpt_number != '' && $excerpt_number != '0')){
		$post_output .= '<div class="post-item-excerpt">'.blokco_excerpt($excerpt_number).'</div>';
	}
	if($more == 1){
		$post_output .= '<div class="spacer-20"></div>'.$more_btn;
	}
	$post_output .= '</div>
					</div>
				</li>';
}
endwhile; endif; wp_reset_postdata();
if($view=="carousel")
{
	$post_output .= '</ul></div></div>';
}
elseif($view=="grid")
{
	$post_output .= '</ul></div>';
}
else
{
	$post_output .= '</div>';
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