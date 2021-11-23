<?php 
$options = get_option('blokco_options');
global $blokco_allowed_tags;
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
$logo_meta = get_post_meta($id,'blokco_page_logo',true);
$logo_url_array = wp_get_attachment_image_src( $logo_meta, 'full', '', array() );
if(is_array($logo_url_array)) { $logo_url = $logo_url_array[0]; }else{$logo_url='';}
$logo_retina_meta = get_post_meta($id,'blokco_page_logo_retina',true);
$logo_retina_url_array = wp_get_attachment_image_src( $logo_retina_meta, 'full', '', array() );
if(is_array($logo_retina_url_array)) { $logo_retina_url = $logo_retina_url_array[0]; }
$logo_retina_url = (!empty($logo_retina_url))?$logo_retina_url:$logo_url;
$retina_logo_width = get_post_meta($id,'blokco_page_logo_retina_width',true);
$retina_logo_height = get_post_meta($id,'blokco_page_logo_retina_height',true);
if($logo_url == ''){
	$logo = (isset($options['logo_upload']))?$options['logo_upload']:'';
	$logo_url = (isset($logo['url']))?$logo['url']:'';
	$logo_retina = (isset($options['retina_logo_upload']))?$options['retina_logo_upload']:'';
	$logo_retina_url = (!empty($logo_retina['url'])!='')?$logo_retina['url']:$logo_url;
	$retina_logo_width = (!empty($logo['width']))?$logo['width']:'130';
	$retina_logo_height = (!empty($logo['height']))?$logo['height']:'23';
}
$mobile_logo = (isset($options['mobile_logo_upload']))?$options['mobile_logo_upload']:'';
$mobile_logo_url = (isset($mobile_logo['url']))?$mobile_logo['url']:'';
$mobile_logo_retina = (isset($options['mobile_retina_logo_upload']))?$options['mobile_retina_logo_upload']:'';
$mobile_logo_retina_url = (!empty($mobile_logo_retina['url'])!='')?$mobile_logo_retina['url']:$mobile_logo_url;
$mobile_retina_logo_width = (!empty($mobile_logo['width']))?$mobile_logo['width']:'130';
$mobile_retina_logo_height = (!empty($mobile_logo['height']))?$mobile_logo['height']:'23';
$mobile_header_search = (isset($options['mobile_header_search']) && $options['mobile_header_search'] != '')?$options['mobile_header_search']:0;
$mobile_header_cart = (isset($options['mobile_header_cart']) && $options['mobile_header_cart'] != '')?$options['mobile_header_cart']:0;
$mobile_header_menu_btn_type = (isset($options['mobile_header_menu_btn_type']) && $options['mobile_header_menu_btn_type'] != '')?$options['mobile_header_menu_btn_type']:0;
$mobile_header_menu_btn_text = (isset($options['mobile_header_menu_btn_text']) && $options['mobile_header_menu_btn_text'] != '')?$options['mobile_header_menu_btn_text']:'';
?>

<div class="mobile-navbar">
	<div class="mobile-logo"><div><div>
		<?php if($mobile_logo_url != ''){ ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-logo"><img src="<?php echo esc_url($mobile_logo_url); ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-retina-logo"><img src="<?php echo esc_url($mobile_logo_retina_url); ?>" alt="<?php echo get_bloginfo('name'); ?>" width="<?php echo esc_attr($mobile_retina_logo_width); ?>" height="<?php echo esc_attr($mobile_retina_logo_height); ?>"></a>
		<?php } else { ?>
			<?php if($logo_url == ''){ ?>
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="static-logo">
				<span class="site-name"><?php echo get_bloginfo('name'); ?></span>
				<span class="site-tagline"><?php echo get_bloginfo('description'); ?></span>
				</a>
			<?php } else { ?>
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-logo"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-retina-logo"><img src="<?php echo esc_url($logo_retina_url); ?>" alt="<?php echo get_bloginfo('name'); ?>" width="<?php echo esc_attr($retina_logo_width); ?>" height="<?php echo esc_attr($retina_logo_height); ?>"></a>
			<?php } ?>
		<?php } ?>
		</div></div></div>

	<?php
	if($mobile_header_cart != 0){
		blokco_cart_button_header();
	}
	if($mobile_header_search != 0){
		blokco_search_button_header();
	}?>
	<div class="header-equaler"><div><div>
		<?php 
		if($mobile_header_menu_btn_type == 0){
			echo'<button class="mmenu-toggle"></button>';
		}elseif($mobile_header_menu_btn_type == 1){
			echo'<button class="mmenu-toggle">'.' '.$mobile_header_menu_btn_text.'</button>';
		}else{
			echo'<button class="mmenu-toggle mmenu-toggle-noicon">'.$mobile_header_menu_btn_text.'</button>';
		} ?>
	</div></div></div>
	<!-- Cloned Main Menu -->
	<nav class="main-menu-clone mobile-menu"><div><ul></ul></div></nav>
</div>