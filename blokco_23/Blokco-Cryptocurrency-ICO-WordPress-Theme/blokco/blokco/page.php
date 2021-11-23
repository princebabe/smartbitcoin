<?php 
get_header();
global $blokco_allowed_tags;
$options = get_option('blokco_options');
$pageSidebarGet = get_post_meta(get_the_ID(),'blokco_select_sidebar_from_list', true);
$pageSidebarStrictNo = get_post_meta(get_the_ID(),'blokco_strict_no_sidebar', true);
$pageSidebarOpt = (isset($options['page_sidebar']))?$options['page_sidebar']:'';
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
$sidebar_column = ($sidebar_column=='')?4:$sidebar_column;
if(!empty($pageSidebar)&&is_active_sidebar($pageSidebar)) {
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
<!-- Start Body Content -->
<div id="main-container">
  	<div class="content">
   		<div class="container">
       		<div class="row main-content-row">
            	<div class="col-md-<?php echo esc_attr($class); ?>" id="content-col">
            		<?php if(have_posts()):while(have_posts()):the_post();
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
						endwhile; endif; ?>
						
						<?php if ((isset($options['switch_sharing']) && $options['switch_sharing'] == 1) && $options['share_post_types']['2'] == '1') { ?>
							<?php if(function_exists('imithemes_share_buttons')){ echo imithemes_share_buttons(); } ?>
						<?php } ?>
            			<?php if ( comments_open() || get_comments_number() ){comments_template();} ?>
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