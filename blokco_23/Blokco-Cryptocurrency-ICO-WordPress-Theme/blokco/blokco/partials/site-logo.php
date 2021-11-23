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
$sticky_logo = (isset($options['sticky_logo_upload']))?$options['sticky_logo_upload']:'';
$sticky_logo_url = (isset($sticky_logo['url']) && $sticky_logo['url'] != '')?$sticky_logo['url']:$logo_url;
if(isset($sticky_logo['url']) && $sticky_logo['url'] != ''){
	$sticky_logo_retina_url = (isset($options['sticky_retina_logo_upload']) && $options['sticky_retina_logo_upload']['url'] != '')?$options['sticky_retina_logo_upload']['url']:$sticky_logo_url;
	$sticky_retina_logo_width = $options['sticky_retina_logo_upload']['width'];
	$sticky_retina_logo_height = $options['sticky_retina_logo_upload']['height'];
} elseif($logo_retina_url != ''){
	$sticky_logo_retina_url = $logo_retina_url;
	$sticky_retina_logo_width = $retina_logo_width;
	$sticky_retina_logo_height = $retina_logo_height;
} else{
	$sticky_logo_retina_url = $sticky_logo_url;
	$sticky_retina_logo_width = (!empty($sticky_logo['width']))?$sticky_logo['width']:'130';
	$sticky_retina_logo_height = (!empty($sticky_logo['height']))?$sticky_logo['height']:'23';
}
?>
<?php if($logo_url == ''){ ?><div class="header-equaler header-equaler-static"><?php } else { ?><div class="header-equaler"><?php } ?><div><div>
	<div class="site-logo"><div>
		<?php if($logo_url == ''){ ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="static-logo">
			<span class="site-name"><?php echo get_bloginfo('name'); ?></span>
			<span class="site-tagline"><?php echo get_bloginfo('description'); ?></span>
			</a>
		<?php } else { ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-logo"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-retina-logo"><img src="<?php echo esc_url($logo_retina_url); ?>" alt="<?php echo get_bloginfo('name'); ?>" width="<?php echo esc_attr($retina_logo_width); ?>" height="<?php echo esc_attr($retina_logo_height); ?>"></a>
		<?php } ?>
	</div></div>
	<div class="sticky-logo">
		<?php if($sticky_logo_url == ''){ ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="static-logo">
			<span class="site-name"><?php echo get_bloginfo('name'); ?></span>
			<span class="site-tagline"><?php echo get_bloginfo('description'); ?></span>
			</a>
		<?php } else { ?>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-logo"><img src="<?php echo esc_url($sticky_logo_url); ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
			<a href="<?php echo esc_url( home_url('/') ); ?>" class="default-retina-logo"><img src="<?php echo esc_url($sticky_logo_retina_url); ?>" alt="<?php echo get_bloginfo('name'); ?>" width="<?php echo esc_attr($sticky_retina_logo_width); ?>" height="<?php echo esc_attr($sticky_retina_logo_height); ?>"></a>
		<?php } ?>
	</div>
</div></div></div>