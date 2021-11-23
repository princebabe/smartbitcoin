<?php
get_header();
global $blokco_allowed_tags;
$options = get_option('blokco_options');
$page_title = (isset($options['page_404_title']))?$options['page_404_title']:'';
$page_content = (isset($options['page_404_content']))?$options['page_404_content']:'';
$page_404_banner = (isset($options['page_404_banner']))?$options['page_404_banner']['url']:'';
$page_404_button_text = (isset($options['page_404_button_text']))?$options['page_404_button_text']:esc_html('Back to Home','blokco');
$inner_header_position = (isset($options['inner_header_position']))?$options['inner_header_position']:1;
if($page_404_banner != ''){
	$default_header = $page_404_banner;
} else {
	$default_header = (isset($options['blokco_default_banner']['url']))?$options['blokco_default_banner']['url']:'';
}
if($inner_header_position == 2){
	$inner_header_position_class = 'floated-page-titles';
} else {
	$inner_header_position_class = '';
}
?>
<div class="imi-page-header <?php echo esc_attr($inner_header_position_class); ?>">
	<div class="hero-area">
    	<div class="page-banner parallax" style="background-image:url(<?php echo esc_url($default_header); ?>);">
        	<div class="container">
            	
            </div>
        </div>
    </div>
	<div class="page-banner-title">
		<div class="container">
			<h1><?php if($page_title != '') { echo esc_attr($page_title); } else { esc_html_e('404 Error!', 'blokco'); } ?></h1>
		</div>
	</div>
</div>
<!-- End Page Header -->
<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
		<div class="container">
			<div class="row">
				<!-- Posts List -->
				<div class="col-md-8 offset-md-2 col-sm-8 offset-sm-2" id="content-col">
					<!-- Post -->
					<article class="page-404">
						<?php if($page_content != ''){
							echo wp_kses($page_content, $blokco_allowed_tags);
						} else { ?>
						<div class="text-align-center">
							<h2><?php esc_html_e('Sorry - Page Not Found!', 'blokco'); ?></h2>
							<?php esc_html_e('The page you are looking for was moved, removed, renamed', 'blokco'); ?><br><?php esc_html_e('or might never existed. You stumbled upon a broken link.', 'blokco'); ?>
						</div>
						<?php } ?>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Body Content -->
<?php get_footer(); ?>