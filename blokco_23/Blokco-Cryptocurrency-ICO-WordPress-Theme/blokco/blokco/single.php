<?php 
get_header();
global $blokco_allowed_tags;
$post_type = get_post_type(get_the_ID());
$options = get_option('blokco_options');
if($post_type == 'post'){
	$show_date = (isset($options['blog_post_date_meta']))?$options['blog_post_date_meta']:1;
	$show_author = (isset($options['blog_post_author_meta']))?$options['blog_post_author_meta']:1;
	$show_categories = (isset($options['blog_post_cats_meta']))?$options['blog_post_cats_meta']:1;
	$show_comments = (isset($options['blog_post_comments_meta']))?$options['blog_post_comments_meta']:1;
	$show_thumbnail = (isset($options['blog_post_thumbnail']))?$options['blog_post_thumbnail']:1;
}
if ( is_rtl() )	{$data_rtl = 'yes';} else {$data_rtl = 'no';}
$pageSidebarGet = get_post_meta(get_the_ID(),'blokco_select_sidebar_from_list', true);
$pageSidebarStrictNo = get_post_meta(get_the_ID(),'blokco_strict_no_sidebar', true);
$pageSidebarOpt = '';
if($post_type == 'post'){
	$pageSidebarOpt = (isset($options['blog_sidebar']))?$options['blog_sidebar']:'';
}elseif($post_type == 'imi_projects'){
	$pageSidebarOpt = (isset($options['project_sidebar']))?$options['project_sidebar']:'';
}elseif($post_type == 'imi_services'){
	$pageSidebarOpt = (isset($options['service_sidebar']))?$options['service_sidebar']:'';
}elseif($post_type == 'imi_team'){
	$pageSidebarOpt = (isset($options['team_sidebar']))?$options['team_sidebar']:'';
}

if($pageSidebarGet != ''){
	$pageSidebar = $pageSidebarGet;
}elseif($pageSidebarOpt != ''){
	$pageSidebar = $pageSidebarOpt;
}else{
	$pageSidebar = 'blog-sidebar';
}
if($pageSidebarStrictNo == 1){
	$pageSidebar = '';
}
$sidebar_column = get_post_meta(get_the_ID(),'blokco_sidebar_columns_layout',true);
if(!empty($pageSidebar)&&is_active_sidebar($pageSidebar)) {
$sidebar_column = ($sidebar_column=='')?4:$sidebar_column;
$left_col = 12-$sidebar_column;
$class = $left_col;  
}else{
$class = 12;  
}
$page_header = get_post_meta(get_the_ID(),'blokco_pages_Choose_slider_display',true);
if($page_header==4) {
	get_template_part( 'pages', 'flex' );
}
elseif($page_header==5) {
	get_template_part( 'pages', 'revolution' );
} else{
	get_template_part( 'pages', 'banner' );
}
?>
<div class="main" role="main">
	<div id="content" class="content full">
    	<div class="container">
      		<div class="row main-content-row">
        		<div class="col-md-<?php echo esc_attr($class); ?>" id="content-col">
        			<?php if(have_posts()) : while(have_posts()) : the_post();
					if($post_type == 'post'||$post_type=='attachment'){
						$post_format = get_post_format();
						$post_format = ($post_format=="")?"image":$post_format;
						$post_author_id = get_post_field( 'post_author', get_the_ID() );
						$meta_data_date = esc_html(get_the_date(get_option('date_format'), get_the_ID()));
						$meta_data_author = '<a href="'. esc_url(get_author_posts_url($post_author_id)).'">'.esc_attr(get_the_author_meta( 'display_name', $post_author_id )).'</a> ';
						$comments_count = wp_count_comments(get_the_ID());

					  	$post_media = '';
					  	if($post_format == 'image' || $post_format == 'standard'){
						  	if ( has_post_thumbnail() ) {
							  	$post_media = get_the_post_thumbnail(get_the_ID(),'full');
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
							  	$gallery .= '<div class="carousel-wrapper"><ul class="owl-carousel single-carousel post-media-carousel" data-columns="1" data-autoplay="'.$auto_slide.'" data-pagination="'.$pagination.'" data-arrows="'.$direction.'" data-single-item="yes" data-items-desktop="1" data-items-desktop-small="1" data-items-tablet="2" data-items-mobile="1" '.$data_rtl.'>';
							  	foreach ($image_data as $custom_gallery_images) {
								  	$large_src = wp_get_attachment_image_src($custom_gallery_images, 'full');
								  	$gallery .= '<li class="item">';
								  	$gallery .= wp_get_attachment_image($custom_gallery_images, 'full');
								  	$gallery .= '</li>';
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
				
                  		echo '<div class="blog-posts"><div class="post-list-item post format-'.esc_attr($post_format).'">';
						echo wp_kses($cat_meta, $blokco_allowed_tags);
				  		if (isset($options['inner_posts_header_title'])&&$options['inner_posts_header_title'] == 1)
						{
							echo '<h3 class="post-title">'.get_the_title().'</h3><hr class="fw">';
						} else{
							echo '<hr class="fw">';
						}
                  		echo wp_kses($post_meta, $blokco_allowed_tags);
						echo '<div class="spacer-30"></div>';
                  		if($post_media != '' && $show_thumbnail == 1){
                      		echo '<div class="post-media">';
                          	echo wp_kses($post_media, $blokco_allowed_tags);
                      		echo '</div>';
                  		}
                  
				  		echo '<div class="post-content">';
                  		the_content();
				  		echo '</div>';
                  		wp_link_pages( array(
							  	'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'blokco' ) . '</span>',
							  	'after'       => '</div>',
							  	'link_before' => '<span>',
							  	'link_after'  => ' </span>',
								'separator'    => '/ ',
							) );
                  		?>
                  		<div class="spacer-20"></div>
                  		<?php if (has_tag()) { ?>
                  			<div class="tagcloud"> 
                      		<?php the_tags('', ''); ?>
                  			</div>
                  		<?php }
					
						if($post_type == 'imi_projects'){
							if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['4'] == 1 && function_exists('imithemes_share_buttons')) { echo imithemes_share_buttons(); }
						}elseif($post_type == 'imi_services'){
							if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['5'] == 1 && function_exists('imithemes_share_buttons')) { echo imithemes_share_buttons(); }
						}elseif($post_type == 'imi_team'){
							if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['3'] == 1 && function_exists('imithemes_share_buttons')) { echo imithemes_share_buttons(); }
						}	
						elseif($post_type == 'post'){
							if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['1'] == 1 && function_exists('imithemes_share_buttons')) { echo imithemes_share_buttons(); }
						} ?>
                  	</div>
         		</div>
           	 	<?php if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['1'] == 1) { ?>
                	<?php if(function_exists('imithemes_share_buttons')){ imithemes_share_buttons(); } ?>
            	<?php } ?>
            	<div class="np-links">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6 text-align-left">
							<div class="pn-link prev-post-link"><?php echo previous_post_link('%link', '<span>'.__('Previous','blokco').'</span> %title'); ?></div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-align-right">
							<div class="pn-link next-post-link"><?php echo next_post_link('%link', '<span>'.__('Next','blokco').'</span> %title'); ?></div>
						</div>
					</div>
				</div>
          
            	<!-- Post Comments -->
            	<?php if ( comments_open() || get_comments_number() ){comments_template();} ?>
    		<?php } else {
				echo '<div class="post-content">';
				the_content();
				echo '</div>';
					}
				 ?>
        <?php endwhile; endif;?>
        </div>
        <?php if(is_active_sidebar($pageSidebar)) { ?>
            <!-- Sidebar -->
            <div class="col-md-<?php echo esc_attr($sidebar_column); ?>" id="sidebar-col">
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