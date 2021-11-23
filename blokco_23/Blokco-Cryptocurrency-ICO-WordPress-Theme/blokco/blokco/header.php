<!DOCTYPE html>
<!--// OPEN HTML //-->
<html <?php language_attributes(); ?> class="no-js"><head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php $options = get_option('blokco_options'); ?>
    <!-- Mobile Specific Metas
    ================================================== -->
	<?php $switch_responsive = (isset($options['switch-responsive']))?$options['switch-responsive']:'';
	if ($switch_responsive == 1 || $switch_responsive == ''){ ?>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php } ?>
    <?php
	 //  WORDPRESS HEAD HOOK
     wp_head(); ?>
	<?php 
	 $space_beforeheader = (isset($options['space_before_head']))?$options['space_before_head']:'';
        echo ''.$space_beforeheader;
    ?>
</head>
<!--// CLOSE HEAD //-->
<body <?php body_class(); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } ?>
<div class="body"> 
<?php
$header_style = (isset($options['header_layout']))?$options['header_layout']:'';
$enable_sticky_header = (isset($options['enable_sticky_header']) && $options['enable_sticky_header'] != '')?$options['enable_sticky_header']:0;
$show_topbar = (isset($options['show_topbar']) && $options['show_topbar'] != '')?$options['show_topbar']:1;
$topbar_opener_position = (isset($options['topbar_opener_position']) && $options['topbar_opener_position'] != '')?$options['topbar_opener_position']:'widgets-at-top';
$enable_mobile_header = (isset($options['enable_mobile_header']) && $options['enable_mobile_header'] != '')?$options['enable_mobile_header']:1;
$topbar_widgets_content = (isset($options['topbar_widgets_content']) && $options['topbar_widgets_content'] != '')?$options['topbar_widgets_content']:'';
?>
<?php if($enable_sticky_header == 1 && $header_style != '11'){ 
	get_template_part( 'partials/sticky-header', '' );
}
if($enable_mobile_header == 1){ 
	get_template_part( 'partials/mobile-header', '' );
} ?>
<?php echo'<div class="overlay-wrapper overlay-search-form-wrapper">
		<a href="#" class="overlay-wrapper-close"><i class="fa fa-times"></i></a><div><div><div class="container">';
		get_search_form();
	echo '</div></div></div></div>';
?>
<?php
	
	if ( !empty( $topbar_widgets_content ) || $topbar_widgets_content != '' ) {
		$topbar_sidebar = get_post( $topbar_widgets_content );
?>
	<div class="topper-container <?php echo esc_attr($topbar_opener_position); ?>">
		<div class="container">
			<?php echo apply_filters( 'the_content', $topbar_sidebar->post_content ); ?>
		</div>
	</div>
<?php } ?>
<?php if($show_topbar == 1 ) { ?>
	<header class="topbar">
    	<div class="container">
     		<?php 
			$topbar_left_blocks = (isset($options['topbar_left_blocks']))?$options['topbar_left_blocks']['enabled']:array();
			if ($topbar_left_blocks):
				echo '<div class="topbar-left-blocks">';
				foreach ($topbar_left_blocks as $key=>$value) {
				switch($key) {
					case 'social-icons': get_template_part( 'partials/social-icons-main', '' );
					break;

					case 'widgets-opener': get_template_part( 'partials/widgets-opener', '' );
					break;

					case 'menu': get_template_part( 'partials/top-menu', '' );
					break;

					case 'featured-button1': get_template_part( 'partials/featured-button1', '' );
					break;

					case 'featured-button2': get_template_part( 'partials/featured-button2', '' );
					break;

					case 'featured-button3': get_template_part( 'partials/featured-button3', '' );
					break;

					case 'search': blokco_search_button_header();
					break;

					case 'cart': blokco_cart_button_header();
					break;

					case 'header-info1': get_template_part( 'partials/header-info1', '' );
					break;

					case 'header-info2': get_template_part( 'partials/header-info2', '' );
					break;

					case 'header-info3': get_template_part( 'partials/header-info3', '' );
					break;
				}
			}
			echo '</div>';
			endif;				  
			?>
    	
    		<?php 
			$topbar_right_blocks = (isset($options['topbar_right_blocks']))?$options['topbar_right_blocks']['enabled']:array();
			if ($topbar_right_blocks): 
				echo '<div class="topbar-right-blocks">';
				foreach ($topbar_right_blocks as $key=>$value) {
				switch($key) {
					case 'social-icons': get_template_part( 'partials/social-icons-main', '' );
					break;

					case 'widgets-opener': get_template_part( 'partials/widgets-opener', '' );
					break;

					case 'menu': get_template_part( 'partials/top-menu', '' );
					break;

					case 'featured-button1': get_template_part( 'partials/featured-button1', '' );
					break;

					case 'featured-button2': get_template_part( 'partials/featured-button2', '' );
					break;

					case 'featured-button3': get_template_part( 'partials/featured-button3', '' );
					break;

					case 'search': blokco_search_button_header();
					break;

					case 'cart': blokco_cart_button_header();
					break;

					case 'header-info1': get_template_part( 'partials/header-info1', '' );
					break;

					case 'header-info2': get_template_part( 'partials/header-info2', '' );
					break;

					case 'header-info3': get_template_part( 'partials/header-info3', '' );
					break;
				}
			}
			echo '</div>';
			endif;				  
			?>
     	</div>
	</header>
<?php } ?>
<?php
if($header_style != ''){
	get_template_part('partials/header-style', $header_style);
} else {
	get_template_part('partials/header-style-default', '');
}
?>