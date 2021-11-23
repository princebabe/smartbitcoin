<?php 
$options = get_option('blokco_options');
if(is_home()){
	$id = get_option('page_for_posts');
} else {
	$id = get_the_ID();
}
$post_type = get_post_type($id);
$theme_info = wp_get_theme();
wp_enqueue_script('flexslider', BLOKCO_THEME_PATH . '/assets/vendor/flexslider/js/jquery.flexslider.js', array('jquery'), $theme_info->get( 'Version' ), true);
$breadcrumb_header_display = (isset($options['breadcrumb_header_display']))?$options['breadcrumb_header_display']:1;
$type = get_post_meta($id,'blokco_pages_Choose_slider_display',true);
$pagination = get_post_meta($id,'blokco_pages_slider_pagination',true);
$autoplay = get_post_meta($id,'blokco_pages_slider_auto_slide',true);
$arrows = get_post_meta($id,'blokco_pages_slider_direction_arrows',true);
$effects = get_post_meta($id,'blokco_pages_slider_effects',true);
if($type==1 || $type==2 || $type==4) {
	$height = get_post_meta($id,'blokco_pages_slider_height',true);
} else {
	$height = '';
}
$images = get_post_meta($id,'blokco_pages_slider_image',false);
$PageBannerMinHeight = (isset($options['inner_page_header_min_height']))?$options['inner_page_header_min_height']:'';
$project_archive_title = (isset($options['project_archive_title']))?$options['project_archive_title']:esc_html__('Projects', 'blokco');
$blog_archive_title = (isset($options['blog_archive_title']))?$options['blog_archive_title']:esc_html__('Blog', 'blokco');
$service_archive_title = (isset($options['service_archive_title']))?$options['service_archive_title']:esc_html__('Services', 'blokco');
$team_archive_title = (isset($options['team_archive_title']))?$options['team_archive_title']:esc_html__('Team', 'blokco');
$shop_archive_title = (isset($options['shop_archive_title']))?$options['shop_archive_title']:esc_html__('Shop', 'blokco');
$breadcrumb_header_display = (isset($options['breadcrumb_header_display']))?$options['breadcrumb_header_display']:1;
$inner_header_position = (isset($options['inner_header_position']))?$options['inner_header_position']:1;

if($post_type=='imi_projects')
{
	if(is_single()){
		$blog_title = get_the_title(get_the_ID());
	}
	elseif (is_tax('imi_projects_category')){
		$blog_title = single_term_title("", false);
	}
	else {
		$blog_title = $project_archive_title;
	}
	$banner_title = $blog_title;
}
elseif($post_type=='post')
{
	if(is_single()){
		$blog_title = get_the_title(get_the_ID());
	}
	elseif (is_category() || is_tag()){
		$blog_title = single_term_title("", false);
	}
	elseif (is_author()){
		global $author;
        $userdata = get_userdata($author);
		$blog_title = $userdata->display_name;
	} else {
		$blog_title = $blog_archive_title;
	}
	$banner_title = $blog_title;
}
elseif($post_type=='imi_services')
{
	if(is_single()){
		$blog_title = get_the_title(get_the_ID());
	}
	elseif (is_tax('imi_services_category')){
		$blog_title = single_term_title("", false);
	}
	else {
		$blog_title = $service_archive_title;
	}
	$banner_title = $blog_title;
}
elseif($post_type=='imi_team')
{
	if(is_single()){
		$blog_title = get_the_title(get_the_ID());
	}
	elseif (is_tax('imi_team_category')){
		$blog_title = single_term_title("", false);
	}
	else {
		$blog_title = $team_archive_title;
	}
	$banner_title = $blog_title;
}
elseif($post_type=='product')
{
	if(is_single()){
		$blog_title = get_the_title(get_the_ID());
	}
	elseif (is_tax('product_cat')){
		$blog_title = single_term_title("", false);
	}
	else {
		$blog_title = $shop_archive_title;
	}
	$banner_title = $blog_title;
}
else
{
	$banner_title = get_the_title($id);
}

if($inner_header_position == 2){
	$inner_header_position_class = 'floated-page-titles';
} else {
	$inner_header_position_class = '';
}
?>
<div class="imi-page-header <?php echo esc_attr($inner_header_position_class); ?>">

	<?php if(!empty($images)) {
	if($height != ''){$rheight = $height;} elseif($PageBannerMinHeight != ''){$rheight = $PageBannerMinHeight;} else {$rheight = 250;} ?>

	<!-- Hero Area -->
    <div class="hero-area">
    	<!-- Start Hero Slider -->
      	<div class="flexslider heroflex hero-slider" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-arrows="<?php echo esc_attr($arrows); ?>" data-style="<?php echo esc_attr($effects); ?>" data-pause="yes" style="height:<?php echo esc_attr($rheight); ?>px;">
            <ul class="slides">
            <?php foreach($images as $image) {
									$image_data = blokco_wp_get_attachment($image);
									$image_src = wp_get_attachment_image_src( $image, 'full', '', array() ); ?>
                <li class="parallax" style="height:<?php echo esc_attr($rheight); ?>px; background-image:url(<?php echo esc_url($image_src[0]); ?>);">
                	<div class="flex-caption">
                    	<div class="container">
                        	<div class="flex-caption-table">
                            	<div class="flex-caption-cell">
                                	<div class="flex-caption-text">
                                  <?php if($image_data['postid']) { ?>
                            			<h3><a href="<?php echo get_the_permalink($image_data['postid']); ?>"><?php echo get_the_title($image_data['postid']); ?></a></h3>
                    					<p><?php wp_trim_words(blokco_post_excerpt_by_id($image_data['postid']), 20); ?></p>
                                  <?php } else { ?>
                                       <?php echo ''.$image_data['description']; ?>
                                        <?php } ?>
                                    </div>
                               	</div>
                          	</div>
                        </div>
                    </div>
                </li>
                <?php } ?>
          	</ul>
       	</div>
        <!-- End Hero Slider -->
    </div>
    <?php } ?>
    <!-- End Hero Area -->
	<div class="page-banner-title">
		<div class="container">
			<h1><?php echo esc_attr($banner_title); ?></h1>
			<?php if($sub_title != ''){ ?>
				<p><?php echo esc_attr($sub_title); ?></p>
			<?php } ?>
		</div>
	</div>
</div>
<!-- End Page Header -->