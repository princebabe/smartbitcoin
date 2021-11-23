<?php 
$options = get_option('blokco_options');
global $blokco_allowed_tags;
$feat_button_title1 = (isset($options['feat_button_title1']))?$options['feat_button_title1']:esc_html__('Button','blokco');
$feat_button_url1 = (isset($options['feat_button_url1']))?$options['feat_button_url1']:'';
$feat_button_shape1 = (isset($options['feat_button_shape1']))?$options['feat_button_shape1']:'';
$feat_button_size1 = (isset($options['feat_button_size1']))?$options['feat_button_size1']:'';
?>
<?php if($feat_button_url1 != ''){ ?>
	<div class="featured-buttons header-equaler"><div><div>
		<a href="<?php echo esc_url($feat_button_url1); ?>" class="fbtn fbtn1 <?php echo esc_attr($feat_button_shape1); ?> <?php echo esc_attr($feat_button_size1); ?>"><?php echo wp_kses($feat_button_title1, $blokco_allowed_tags); ?></a>
	</div></div></div>
<?php } ?>