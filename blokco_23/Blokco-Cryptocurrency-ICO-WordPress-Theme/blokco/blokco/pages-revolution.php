<?php
$options = get_option('blokco_options');
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
$rev_slider = get_post_meta($id,'blokco_pages_select_revolution_from_list',true);
if (has_shortcode($rev_slider, 'rev_slider')) {
	$rev_slider = preg_replace('/\\\\/', '', $rev_slider);
} else {
	if (class_exists('RevSlider')) {
		$sld = new RevSlider();
		$sliders = $sld->getArrSliders();
		if (!empty($sliders)) {
			foreach ($sliders as $slider) {
				if ($slider->id != $rev_slider) continue;
				$rev_slider = $slider->getParam('shortcode', 'false');
			}
		}
	}
} ?>
<div class="hero-area">
	<div class="slider-rev-cont">
     	<div class="tp-limited">
			<?php echo do_shortcode(stripslashes($rev_slider)); ?>
      	</div>
   	</div>
</div>