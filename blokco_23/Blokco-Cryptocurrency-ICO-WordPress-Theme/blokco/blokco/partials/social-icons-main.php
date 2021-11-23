<?php $options = get_option('blokco_options');
$main_social_shape = (isset($options['main_social_shape']))?$options['main_social_shape']:'';
$main_social_size = (isset($options['main_social_size']))?$options['main_social_size']:'';
$main_social_style = (isset($options['main_social_style']))?$options['main_social_style']:'';
$main_social_hover_style = (isset($options['main_social_hover_style']))?$options['main_social_hover_style']:''; ?>
<div class="header-social-container header-equaler"><div><div>
	<ul class="header-social imi-social-icons <?php echo esc_attr($main_social_shape); ?> <?php echo esc_attr($main_social_size); ?> <?php echo esc_attr($main_social_style); ?> <?php echo esc_attr($main_social_hover_style); ?>">
	<?php
	  $socialSites = (isset($options['header_social_links']))?$options['header_social_links']:array();
	  foreach ($socialSites as $key => $value) {
		  $string = substr($key, 3);
		  if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
			  echo '<li class="'.esc_attr($string).'"><a href="mailto:' . esc_url($value) . '"><i class="fa ' . esc_attr($key) . '"></i></a></li>';
		  }
		  if (filter_var($value, FILTER_VALIDATE_URL)) {
			  echo '<li class="'.esc_attr($string).'"><a href="' . esc_attr($value) . '" target="_blank"><i class="fa ' . esc_attr($key) . '"></i></a></li>';
		  }
		  elseif($key == 'fa-skype' && $value != '' && $value != 'Enter Skype ID') {
			  echo '<li class="'.esc_attr($string).'"><a href="skype:' . esc_url($value) . '?call"><i class="fa ' . esc_attr($key) . '"></i></a></li>';
		  }
	  }
	?>
	</ul>
</div></div></div>