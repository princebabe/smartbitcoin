<?php 
$options = get_option('blokco_options');
if(is_home()){
	$id = get_option('page_for_posts');
} else {
	$id = get_the_ID();
}
$post_type = get_post_type($id);
$default_project_banner = (isset($options['default_project_banner']))?$options['default_project_banner']['url']:'';
$default_post_banner = (isset($options['default_post_banner']))?$options['default_post_banner']['url']:'';
$default_service_banner = (isset($options['default_service_banner']))?$options['default_service_banner']['url']:'';
$default_team_banner = (isset($options['default_team_banner']))?$options['default_team_banner']['url']:'';
$default_product_banner = (isset($options['default_product_banner']))?$options['default_product_banner']['url']:'';

if($post_type=='imi_projects' && $default_project_banner != '')
{
	$image_default = $default_project_banner;
}
elseif($post_type=='post' && $default_post_banner != '')
{
	$image_default = $default_post_banner;
}
elseif($post_type=='imi_services' && $default_service_banner != '')
{
	$image_default = $default_service_banner;
}
elseif($post_type=='imi_team' && $default_team_banner != '')
{
	$image_default = $default_team_banner;
}
elseif($post_type=='product' && $default_product_banner != '')
{
	$image_default = $default_product_banner;
}
else{
	$image_default = (isset($options['blokco_default_banner']))?$options['blokco_default_banner']['url']:'';
}

$image = $banner_type = '';
$banner_type = get_post_meta($id,'blokco_pages_Choose_slider_display',true);
$fimagebanner = get_post_meta($id,'blokco_featured_image_banner',true);
$height = get_post_meta($id,'blokco_pages_slider_height',true);
$PageBannerMinHeight = (isset($options['inner_page_header_min_height']))?$options['inner_page_header_min_height']:'';
$color = get_post_meta($id,'blokco_pages_banner_color',true);
$sub_title = get_post_meta($id,'blokco_header_sub_title',true);
$color = ($color!='' && $color!='#')?$color:'';
$post_image = get_post_meta($id,'blokco_header_image',true);
$image_src = wp_get_attachment_image_src( $post_image, 'full', '', array() );
$post_thumbnail_id = get_post_thumbnail_id( $id );
$post_thumbnail_url = wp_get_attachment_image_src($post_thumbnail_id,'full', true);
if(is_tax() || is_category()){
	$term_id = get_queried_object()->term_id;
	$term_banner = get_term_meta( $term_id, 'blokco_term_banner_image', true );
	$term_banner_image = RWMB_Image_Field::file_info( $term_banner, array( 'size' => 'full' ) );
} else {
	$term_banner_image['url'] = '';
}


if(has_post_thumbnail($id) && $fimagebanner == 1){$image = $post_thumbnail_url[0];}elseif(is_array($image_src)) { $image = $image_src[0]; }elseif($term_banner_image['url'] != ''){ $image = $term_banner_image['url']; } else { $image = $image_default; }
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
if($height != ''){$rheight = $height;} elseif($PageBannerMinHeight != ''){$rheight = $PageBannerMinHeight;} else {$rheight = '';}

if($inner_header_position == 2){
	$inner_header_position_class = 'floated-page-titles';
} else {
	$inner_header_position_class = '';
}
?>
<div class="imi-page-header <?php echo esc_attr($inner_header_position_class); ?>">
	 <div class="hero-area">
	 <?php if($banner_type=='2' || $banner_type == '')
	 {
		 echo '<div class="page-banner page-banner-image parallax" style="background-image:url('.esc_url($image).'); background-color:'.esc_attr($color).'; height:'.esc_attr($rheight).'px'.';">
		 <div class="container">';
	 }
	 elseif($banner_type=='1')
	 {
		 echo '<div class="page-banner" style="background-color:'.esc_attr($color).'; height:'.esc_attr($rheight).'px'.';">
		 <div class="container">';
	 }
	 ?>
		 <?php if($breadcrumb_header_display != '' && $breadcrumb_header_display != 1){ ?>
		<div class="breadcrumb-wrapper">
			<div class="container">
				<?php if(function_exists('bcn_display')){ ?>
					<ol class="breadcrumb">
						<?php bcn_display(); ?>
					</ol>
				<?php } ?>
			</div>
		</div>
		<?php } ?>

				</div>
			</div>
	</div>
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