<?php
$options = get_option('blokco_options');
global $blokco_allowed_tags;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
?>
<header class="site-header">
	<div class="container relative-container">
      	<?php
		// Header Left Blocks
		$header_left_blocks = (isset($options['header_left_blocks']))?$options['header_left_blocks']['enabled']:array();
		if ($header_left_blocks):
			echo '<div class="header-left-blocks">';
			foreach ($header_left_blocks as $key=>$value) {
			switch($key) {
				case 'logo': get_template_part( 'partials/site-logo', '' );
				break;

				case 'widgets-opener': get_template_part( 'partials/widgets-opener-main', '' );
				break;

				case 'menu': '';
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
		$header_right_blocks = (isset($options['header_right_blocks']))?$options['header_right_blocks']['enabled']:array();
		if ($header_right_blocks):
			echo '<div class="header-right-blocks">';
			foreach ($header_right_blocks as $key=>$value) {
			switch($key) {
				case 'logo': get_template_part( 'partials/site-logo', '' );
				break;

				case 'widgets-opener': get_template_part( 'partials/widgets-opener-main', '' );
				break;

				case 'menu': '';
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
		<div class="fw-menu">
			<div class="full-width-menu">
				<?php
				// Cart
				if (isset($options['header45_cart'])&&$options['header45_cart'] == 1) {
					 echo blokco_cart_button_header();
				}
				// Search
				if (isset($options['header45_search'])&&$options['header45_search'] == 1) {
					  blokco_search_button_header();
				} ?>
				<div class="main-menu">
					<?php get_template_part('partials/main-menu',''); ?>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- End Header --> 