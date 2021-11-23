<?php
$options = get_option('blokco_options');
global $blokco_allowed_tags;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
?>
<div class="theme-mobile-header">
	<?php
	// Header Left Blocks
	$mobile_header_blocks = (isset($options['mobile_header_blocks']))?$options['mobile_header_blocks']['enabled']:array();
	if (count($mobile_header_blocks)>1):
		echo '<div class="mobile-header-blocks">';
		foreach ($mobile_header_blocks as $key=>$value) {
		switch($key) {
			case 'logo-menu': get_template_part( 'partials/mobile-logo-menu', '' );
			break;

			case 'topmenu': get_template_part( 'partials/top-menu', '' );
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
		}
	}
	echo '</div>';
	else:
		echo '<div class="mobile-header-blocks">'.
		get_template_part("partials/mobile-logo-menu").'
		</div>';
	endif;  
	?>
</div>
<!-- End Header --> 