<?php
/*Front end view of maps shortcode
==================================*/
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$theme_info = wp_get_theme();
$counter_days = esc_html__('day', 'blokco');
$counter_hours = esc_html__('hr', 'blokco');
$counter_minutes = esc_html__('min', 'blokco');
$counter_seconds = esc_html__('sec', 'blokco');


wp_enqueue_script('countdown-timer', BLOKCO_THEME_PATH . '/assets/js/jquery.countdown.js', array('jquery'), $theme_info->get( 'Version' ), true);
wp_enqueue_script('countdown-init', BLOKCO_THEME_PATH . '/assets/js/countdown.init.js', array('jquery'), $theme_info->get( 'Version' ), true);
wp_localize_script('countdown-init', 'initval', array('ajax_url' => admin_url( 'admin-ajax.php' ),'day'=>$counter_days, 'hr'=>$counter_hours, 'min'=>$counter_minutes, 'sec'=>$counter_seconds));


$getid = 'imi-countdown-'.blokco_mapRandomId();

echo '<div class="imi-countdown-timer '.$skin.' '.$size.'" id="'.$getid.'" data-date="'.esc_attr($enddate).'"></div>';

?>