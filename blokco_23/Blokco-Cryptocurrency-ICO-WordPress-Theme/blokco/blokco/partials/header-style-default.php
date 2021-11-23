<?php
$options = get_option('blokco_options');
global $blokco_allowed_tags;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
?>
<header class="site-header">
	<div class="container relative-container">
		<div class="header-left-blocks">
			<?php get_template_part( 'partials/site-logo', '' ); ?>
		</div>
		<div class="header-right-blocks">
			<div class="main-menu">
				<?php get_template_part( 'partials/main-menu', '' ); ?>
			</div>
		</div>
	</div>
</header>
<!-- End Header --> 