<?php 
get_header();
$options = get_option('blokco_options');
$pageSidebarGet = get_post_meta(get_the_ID(),'blokco_select_sidebar_from_list', true);
$pageSidebarStrictNo = get_post_meta(get_the_ID(),'blokco_strict_no_sidebar', true);
$breadcrumb_header_display = (isset($options['breadcrumb_header_display']))?$options['breadcrumb_header_display']:1;
$PageBannerMinHeight = (isset($options['inner_page_header_min_height']))?$options['inner_page_header_min_height']:'';
$inner_header_position = (isset($options['inner_header_position']))?$options['inner_header_position']:1;
$pageSidebarOpt = $options['product_sidebar'];
if($pageSidebarGet != ''){
	$pageSidebar = $pageSidebarGet;
}elseif($pageSidebarOpt != ''){
	$pageSidebar = $pageSidebarOpt;
}else{
	$pageSidebar = '';
}
if($pageSidebarStrictNo == 1){
	$pageSidebar = '';
}
$sidebar_column = get_post_meta(get_the_ID(),'blokco_sidebar_columns_layout',true);
$sidebar_column = ($sidebar_column=='')?3:$sidebar_column;
if(!empty($pageSidebar)&&is_active_sidebar($pageSidebar)) {
$left_col = 12-$sidebar_column;
$class = $left_col;  
}else{
$class = 12;  
}
$product_banner = (isset($options['default_product_banner']))?$options['default_product_banner']['url']:'';
$default_banner = (isset($options['blokco_default_banner']))?$options['blokco_default_banner']['url']:'';
if(is_product_category()){
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$term_banner_image = get_option($term->taxonomy . $term->term_id . "_term_banner");
	if($term_banner_image != ''){
		$image_default = $term_banner_image;
	}
	if($product_banner != ''){
		$image_default = $product_banner;
	} else {
		$image_default = $product_banner;
	}
	$shop_archive_title = (isset($options['shop_archive_title']))?$options['shop_archive_title']:esc_html__('Shop', 'blokco');

if($inner_header_position == 2){
	$inner_header_position_class = 'floated-page-titles';
} else {
	$inner_header_position_class = '';
}
?>
<div class="imi-page-header <?php echo esc_attr($inner_header_position_class); ?>">
    <div class="hero-area">
    	<?php if($image_default != ''){ ?>
    		<div class="page-banner page-banner-image parallax" style="background-image:url(<?php echo esc_url($image_default); ?>); height:<?php echo esc_attr($PageBannerMinHeight); ?>px;">
       	<?php } else { ?>
    		<div class="page-banner parallax" style="height:<?php echo esc_attr($PageBannerMinHeight); ?>px;">
        <?php } ?>
        	<div class="container">
				<?php if(function_exists('bcn_display')){ ?>
					<ol class="breadcrumb">
						<?php bcn_display(); ?>
					</ol>
				<?php } ?>
            </div>
        </div>
    </div>
	<div class="page-banner-title">
		<div class="container">
			<h1><?php echo esc_attr($shop_archive_title); ?></h1>
			<?php if($sub_title != ''){ ?>
				<p><?php echo esc_attr($sub_title); ?></p>
			<?php } ?>
		</div>
	</div>
</div>
<!-- End Page Header -->
<?php } else {
$page_header = get_post_meta(get_the_ID(),'blokco_pages_Choose_slider_display',true);
if($page_header==4) {
	get_template_part( 'pages', 'flex' );
}
elseif($page_header==5) {
	get_template_part( 'pages', 'revolution' );
}
else {
	get_template_part( 'pages', 'banner' );
}
}
?>
<!-- Start Body Content -->
<div id="main-container">
  	<div class="content">
   		<div class="container">
       		<div class="row main-content-row">
            	<div class="col-md-<?php echo esc_attr($class); ?>" id="content-col">
            		<?php if ( have_posts() ) :
						woocommerce_content(); echo blokco_pagination();
						endif; ?>
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
<?php get_footer(); ?>