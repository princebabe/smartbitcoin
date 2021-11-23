<?php
get_header();
global $blokco_allowed_tags;
$options = get_option('blokco_options');
$show_date = (isset($options['blog_date_meta']) && $options['blog_date_meta'] != '')?$options['blog_date_meta']:'1';
$show_author = (isset($options['blog_author_meta']) && $options['blog_author_meta'] != '')?$options['blog_author_meta']:1;
$show_categories = (isset($options['blog_cats_meta']) && $options['blog_cats_meta'] != '')?$options['blog_cats_meta']:1;
$show_comments = (isset($options['blog_comments_meta']) && $options['blog_comments_meta'] != '')?$options['blog_comments_meta']:1;
$show_btn = (isset($options['blog_read_more_btn']) && $options['blog_read_more_btn'] != '')?$options['blog_read_more_btn']:1;
$blog_content_type = (isset($options['blog_content_type']) && $options['blog_date_meta'] != '')?$options['blog_content_type']:1;
$blog_excerpt_words = (isset($options['blog_excerpt_words']))?$options['blog_excerpt_words']:40;
if ( is_rtl() )	{$data_rtl = 'yes';} else {$data_rtl = 'no';}
$id = get_option('page_for_posts');
if($id==0||$id=='')
{
	$id = get_the_ID();
}
$post_type = get_post_type($id);
$page_sidebarget = get_post_meta($id,'blokco_select_sidebar_from_list', true);
$pageSidebarStrictNo = get_post_meta($id,'blokco_strict_no_sidebar', true);
$pageSidebarOpt = (isset($options['blog_archive_sidebar']))?$options['blog_archive_sidebar']:'';
if($page_sidebarget != ''){
	$pageSidebar = $page_sidebarget;
}elseif($pageSidebarOpt != ''){
	$pageSidebar = $pageSidebarOpt;
}elseif(is_home()){
	$pageSidebar = 'blog-sidebar';
}else{
	$pageSidebar = '';
}
if($pageSidebarStrictNo == 1){
	$pageSidebar = '';
}
$sidebar_column = get_post_meta($id,'blokco_sidebar_columns_layout',true);
$sidebar_column = ($sidebar_column=='')?4:$sidebar_column;
if(!empty($pageSidebar)&&is_active_sidebar($pageSidebar)) {
$left_col = 12-$sidebar_column;
$class = $left_col;  
}else{
$class = 12;  
} 
$page_header = get_post_meta($id,'blokco_pages_Choose_slider_display',true);
if($page_header==4) {
	get_template_part( 'pages', 'flex' );
}
elseif($page_header==5) {
	get_template_part( 'pages', 'revolution' );
} else{
	get_template_part( 'pages', 'banner' );
}
?>
<!-- Start Body Content -->
  	 <div id="main-container">
    	<div class="content">
        	<div class="container">
            	<div class="row main-content-row">
                	<div class="col-md-<?php echo esc_attr($class); ?> content-block" id="content-col">
                    	<div class="blog-posts blog-page-posts">
                        <?php if(have_posts()) : ?>
						<?php while(have_posts()) : the_post();
							$post_format = get_post_format();
							$post_format = ($post_format=="")?"image":$post_format;
							$post_author_id = get_post_field( 'post_author', get_the_ID() );
							$meta_data_date = esc_html(get_the_date(get_option('date_format'), get_the_ID()));
							$meta_data_author = '<a href="'. esc_url(get_author_posts_url($post_author_id)).'">'.esc_attr(get_the_author_meta( 'display_name', $post_author_id )).'</a> ';
							$comments_count = wp_count_comments(get_the_ID());
                            
                            $post_media = '';
                            if($post_format == 'image' || $post_format == 'standard'){
                                if ( has_post_thumbnail() ) {
                                    $post_media = '<a href="'.get_the_permalink().'" class="media-box">'.get_the_post_thumbnail(get_the_ID(),'blokco-600x400').'</a>';
                                }	
                            }elseif($post_format == 'gallery'){
								$gallery = '';
								$theme_info = wp_get_theme();
								wp_enqueue_style('owl-carousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.carousel.css', array(), $theme_info->get( 'Version' ), 'all');
								wp_enqueue_style('owl-carousel2', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/css/owl.theme.css', array('owl-carousel'), $theme_info->get( 'Version' ), 'all');
								wp_enqueue_script('owlcarousel', BLOKCO_THEME_PATH . '/assets/vendor/owl-carousel/js/owl.carousel.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
                                $speed = (get_post_meta(get_the_ID(), 'blokco_post_slider_speed', true)!='')?get_post_meta(get_the_ID(), 'blokco_post_slider_speed', true):5000;
                                $pagination = get_post_meta(get_the_ID(), 'blokco_post_slider_pagination', true);
                                $auto_slide = get_post_meta(get_the_ID(), 'blokco_post_slider_auto_slide', true);
                                $direction = get_post_meta(get_the_ID(), 'blokco_post_slider_direction_arrows', true);
                                $image_data=  get_post_meta(get_the_ID(),'blokco_post_gallery_images',false);
                                $pagination = !empty($pagination) ? $pagination : 'yes';
                                $auto_slide = !empty($auto_slide) ? $auto_slide : '';
                                $direction = !empty($direction) ? $direction : 'yes';
                                if (count($image_data) > 0) {
                                    $gallery .= '<div class="carousel-wrapper"><ul class="owl-carousel single-carousel post-media-carousel" data-columns="1" data-autoplay="'.$auto_slide.'" data-pagination="'.$pagination.'" data-margin="0" data-arrows="'.$direction.'" data-rtl="'.$data_rtl.'" data-loop="no">';
                                    foreach ($image_data as $custom_gallery_images) {
                                        $large_src = wp_get_attachment_image_src($custom_gallery_images, 'full');
                                        $gallery .= '<li class="item"><a href="' . esc_url($large_src[0]) . '" class="popup-image">';
                                        $gallery .= wp_get_attachment_image($custom_gallery_images, 'blokco-600x400');
                                        $gallery .= '</a></li>';
                                    }
                                    $gallery .= '</ul></div>';
                                }
                                global $blokco_allowed_tags;
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
							if($show_date == 1 || $show_author == 1 || $show_comments == 1){
								$post_meta = '<div class="blog-post-details meta-data">';
								if($show_date == 1){
									$post_meta .= '<div class="post-date">'.$meta_data_date.'</div>';
								}
								if($show_author == 1){
									$post_meta .= '<div class="post-author">'.$meta_data_author.'</div>';
								}
								if($show_comments == 1){
									$post_meta .= '<div class="comments-likes"><a href="#comments"><i class="fa fa-comments"></i>  '.$comments_count->approved.'</a></div>';
								}
								$post_meta .= '</div><div class="spacer-20"></div>';
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
							?>
							<article <?php post_class('post-list-item'); ?>>
                        	<?php 
							echo '<div class="row">';
							if($post_media != ''){
								echo '<div class="col-md-4"><div class="post-media">';
									echo wp_kses($post_media, $blokco_allowed_tags);
								echo '</div></div>';
							}
							if($post_media != ''){
								echo '<div class="col-md-8">';
							} else {
								echo '<div class="col-md-12">';	
							}
							echo wp_kses($cat_meta, $blokco_allowed_tags);
							echo '<h4 class="post-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h4><hr class="fw">';
							echo wp_kses($post_meta, $blokco_allowed_tags);
							if($blog_content_type == 0){
							  the_content('');
							}
							elseif($blog_content_type == 1 && ($blog_excerpt_words != '' && $blog_excerpt_words != '0')){
							  echo blokco_excerpt($blog_excerpt_words);
							}
							wp_link_pages( array(
							  	'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'blokco' ) . '</span>',
							  	'after'       => '</div>',
							  	'link_before' => '<span>',
							  	'link_after'  => ' </span>',
								'separator'    => '/ ',
							) );
							if($show_btn == 1){
								echo '<div class="spacer-10"></div><a href="'.esc_url(get_permalink()).'" class="btn btn-primary btn-secondary">'.esc_html__('Read more','blokco').'</a>';
							}
							echo '</div></div></article>'; ?>
                                   
						<?php endwhile; endif;?>
                        <!-- Pagination -->
                        <div class="page-pagination">
							<?php if(!function_exists('blokco_pagination'))
                                {
                                next_posts_link( esc_html__('&laquo; Older Entries','blokco'));
                                previous_posts_link( esc_html__('Newer Entries &raquo;','blokco'));
                                }
                            else
                                {
                                echo blokco_pagination();
                            } ?>
                        </div>
                        </div>
                   </div>
                   <?php if(is_active_sidebar($pageSidebar)) { ?>
                    <!-- Sidebar -->
                    <div class="sidebar col-md-<?php echo esc_attr($sidebar_column); ?>" id="sidebar-col">
						<div class="sidebar-col-in">
                    		<?php dynamic_sidebar($pageSidebar); ?>
						</div>
                    </div>
                    <?php } ?>
                        </div>
                    </div>
                </div>
         	</div>
    <!-- End Body Content -->
<?php get_footer(); ?>