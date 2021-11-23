<?php
$options = get_option('blokco_options');
$menu_locations = get_nav_menu_locations();
$onepage_menu = get_post_meta($id,'blokco_select_menu_from_list',true);
$dd_menu_style = (isset($options['dd_menu_style']) && $options['dd_menu_style'] != '')?$options['dd_menu_style']:'dd-style1';
if (class_exists('imi_mega_menu_walker')) {
	if($onepage_menu != '' && is_page_template('template-onepage.php')){
		wp_nav_menu(array('menu' => $onepage_menu, 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => '', 'walker' => new imi_mega_menu_walker));
	} else {
		if (!empty($menu_locations['primary-menu'])) { 
			wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => '', 'walker' => new imi_mega_menu_walker));
		}
	}
} else {
	if($onepage_menu != '' && is_page_template('template-onepage.php')){
		wp_nav_menu(array('menu' => $onepage_menu, 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => ''));
	} else {
		if (!empty($menu_locations['primary-menu'])) { 
			wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => '','items_wrap' => '<ul id="%1$s" class="sf-menu dd-menu '.$dd_menu_style.'">%3$s</ul>', 'link_before' => '', 'link_after' => ''));
		}
	}
} ?>