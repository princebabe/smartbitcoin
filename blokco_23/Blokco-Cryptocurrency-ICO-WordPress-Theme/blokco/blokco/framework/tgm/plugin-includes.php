<?php
require_once BLOKCO_FILEPATH . '/framework/tgm/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'blokco_register_required_plugins' );

function blokco_register_required_plugins() {
	$plugins_path = get_template_directory() . '/framework/tgm/plugins/';
    $plugins = array(
        array(
			'name' 				=> esc_html__('Breadcrumb NavXT', 'blokco'),
			'slug' 				=> 'breadcrumb-navxt',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-navxt.png',
		),
		array(
			'name' 				=> esc_html__('Pojo Sidebars', 'blokco'),
			'slug' 				=> 'pojo-sidebars',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-pojo.png',
		),
		array(
			'name' 				=> esc_html__('Loco Translate', 'blokco'),
			'slug' 				=> 'loco-translate',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-loco.png',
		),
       	array(
			'name' 				=> esc_html__('WooCommerce', 'blokco'),
		    'slug' 				=> 'woocommerce',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-woo.png',
		),
		array(
			'name' 				=> esc_html__('Contact Form 7', 'blokco'),
		    'slug' 				=> 'contact-form-7',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-cf7.png',
		),
		array(
			'name' 				=> esc_html__('Cryptocurrency Price Ticket Widget', 'blokco'),
		   	'slug' 				=> 'cryptocurrency-price-ticker-widget',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-crypto-ticker.png',
		),
        array(
			'name' 				=> esc_html__('Best Contact Forms', 'blokco'),
			'slug' 				=> 'wpforms-lite',
			'required' 			=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-wpforms.png',
		),
		array(
            'name'          	=> esc_html__('Revolution Slider', 'blokco'),
            'slug'            	=> 'revslider',
            'source'          	=> $plugins_path. 'revslider.zip',
            'required'         	=> true,
            'version' 			=> '6.5.10',
            'force_activation'  => false,
            'force_deactivation'=> false,
            'external_url'      => '',
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-revslider.png',
        ),
			array(
            'name'              => esc_html__('A Core Plugin', 'blokco'),
            'slug'              => 'blokco-core',
            'source'            => $plugins_path. 'blokco-core.zip',
            'required'          => true,
            'version'           => '2.0',
            'force_activation'  => false,
            'force_deactivation'=> false,
            'external_url'      => '',
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-core.png',
        ),
		array(
            'name'              => esc_html__('WP Bakery Page Builder', 'blokco'),
            'slug'              => 'js_composer',
			'source'            => $plugins_path. 'js_composer.zip',
			'version' 			=> '6.7.0',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-vc.png',
        ),
		array(
            'name'              => esc_html__('Eventer', 'blokco'),
            'slug'              => 'eventer',
			'source'            => $plugins_path. 'eventer.zip',
			'version' 			=> '3.2.1',
            'required'          => true,
            'force_activation'  => false,
            'force_deactivation'=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-eventer.png',
        ),
		array(
            'name'              => esc_html__('Virtual Coins Widgets VC', 'blokco'),
            'slug'              => 'virtual_coin_widgets_vc',
			'source'            => $plugins_path. 'virtual_coin_widgets_vc.zip',
			'version' 			=> '2.2.2',
            'required'          => false,
            'force_activation'  => false,
            'force_deactivation'=> false,
			'image_src'			=> get_template_directory_uri() . '/framework/tgm/images/plugin-vcoins.png',
        ),
            
    );
    
	$config = array(
		'id'			=> 'tgmpa',					// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	=> '',						// Default absolute path to bundled plugins.
		'menu'			=> 'tgmpa-install-plugins',	// Menu slug.
		'parent_slug'	=> 'themes.php',			// Parent menu slug.
		'capability'	=> 'edit_theme_options',	// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	=> false,					// Show admin notices or not.
		'dismissable'	=> true,					// If false, a user cannot dismiss the nag message.
		'dismiss_msg'	=> '',						// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	=> true,					// Automatically activate plugins after installation or not.
		'message'		=> '',						// Message to output right before the plugins table.
	);
	
	tgmpa( $plugins, $config );
	
}
if(function_exists('vc_set_as_theme')) vc_set_as_theme( $disable_updater = true );
