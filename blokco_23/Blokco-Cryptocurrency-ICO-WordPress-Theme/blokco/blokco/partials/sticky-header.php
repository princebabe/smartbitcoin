<?php
$options = get_option('blokco_options');
global $blokco_allowed_tags;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
?>
<div class="theme-sticky-header">
	<div class="container">
		<?php
		// Header Left Blocks
		$sticky_header_left_blocks = (isset($options['sticky_header_left_blocks']))?$options['sticky_header_left_blocks']['enabled']:array();
		if ($sticky_header_left_blocks):
			echo '<div class="sticky-header-left-blocks">';
			foreach ($sticky_header_left_blocks as $key=>$value) {
			switch($key) {
				case 'logo': get_template_part( 'partials/site-logo', '' );
				break;

				case 'widgets-opener': get_template_part( 'partials/widgets-opener-main', '' );
				break;

				case 'menu': get_template_part( 'partials/sticky-menu', '' );
				break;

				case 'featured-button1': get_template_part( 'partials/featured-button1', '' );
				break;

				case 'featured-button2': get_template_part( 'partials/featured-button2', '' );
				break;

				case 'featured-button3': get_template_part( 'partials/featured-button3', '' );
				break;

				case 'header-info1': get_template_part( 'partials/header-info1', '' );
				break;

				case 'header-info2': get_template_part( 'partials/header-info2', '' );
				break;

				case 'header-info3': get_template_part( 'partials/header-info3', '' );
				break;

				case 'social-icons': get_template_part( 'partials/social-icons-main', '' );
				break;

				case 'search': blokco_search_button_header();    
				break;

				case 'cart': blokco_cart_button_header();    
				break;
			}
		}
		echo '</div>';
		endif;				  
		?>
		<?php
		// Header Right Blocks
		$sticky_header_right_blocks = (isset($options['sticky_header_right_blocks']))?$options['sticky_header_right_blocks']['enabled']:array();
		if ($sticky_header_right_blocks):
			echo '<div class="sticky-header-right-blocks">';
			foreach ($sticky_header_right_blocks as $key=>$value) {
			switch($key) {
				case 'logo': get_template_part( 'partials/site-logo', '' );
				break;

				case 'widgets-opener': get_template_part( 'partials/widgets-opener-main', '' );
				break;

				case 'menu': get_template_part( 'partials/sticky-menu', '' );
				break;

				case 'featured-button1': get_template_part( 'partials/featured-button1', '' );
				break;

				case 'featured-button2': get_template_part( 'partials/featured-button2', '' );
				break;

				case 'featured-button3': get_template_part( 'partials/featured-button3', '' );
				break;

				case 'header-info1': get_template_part( 'partials/header-info1', '' );
				break;

				case 'header-info2': get_template_part( 'partials/header-info2', '' );
				break;

				case 'header-info3': get_template_part( 'partials/header-info3', '' );
				break;

				case 'social-icons': get_template_part( 'partials/social-icons-main', '' );
				break;

				case 'search': blokco_search_button_header();    
				break;

				case 'cart': blokco_cart_button_header();    
				break;
			}
		}
		echo '</div>';
		endif;				  
		?>
	</div>
</div>
<!-- End Header --> 