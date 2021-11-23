<?php 
$options = get_option('blokco_options');
global $blokco_allowed_tags;
$header_info = (isset($options['header_info_text2']))?$options['header_info_text2']:'';
?>
<?php if($header_info != ''){ ?>
	<!-- Header Info -->
	<div class="header_info_text header_info_text2 header-equaler"><div><div><?php echo wp_kses($header_info, $blokco_allowed_tags); ?></div></div></div>
<?php } ?>