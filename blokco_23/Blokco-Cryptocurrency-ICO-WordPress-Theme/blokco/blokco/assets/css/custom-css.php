<?php
$options = get_option('blokco_options');
header( 'Content-type: text/css' );
// Custom CSS
$custom_css = (isset($options['custom_css']))?$options['custom_css']:'';
if (isset($options['theme_color_type'])&&$options['theme_color_type'] == 1) 
{
   	$primaryColor = (isset($options['primary_theme_color']))?$options['primary_theme_color']:'';
   	$secondaryColor = (isset($options['secondary_theme_color']))?$options['secondary_theme_color']:'';
	echo '#menu-toggle:hover, .project-info-static .project-categories a:hover,.accent-color,.basic-link,.basic-link:hover,.blog-posts .post .blog-post-details a:hover,.btn-link,.btn-primary .badge,.dd-menu>li a:hover,.dd-menu>li.current-menu-item>a,.dd-menu>li.current-menu-parent>a,.dnav1 .next:hover,.dnav1 .prev:hover,.fblock-style2 .fblock-icon,.header-style11 .site-header .dd-menu>li ul a:hover,.header-style2 .is-sticky .dd-menu>li>a:hover,.icon-box.ibox-plain .ibox-icon.accent-color i,.icon-box.ibox-border .ibox-icon.accent-color i,.imi-social-icons-tc.imi-social-icons-plain li a,.imi-social-icons-hover-tc.imi-social-icons-plain li a:hover,.list-group-item a:hover,.megamenu-sub-title i,.mmenu-toggle,.nav-np .next:hover,.nav-np .prev:hover,.nav-pills>.active>a>.badge,.owl-carousel .owl-nav div:hover,.portfolio-item:hover .action-icons a,.post .post-title a:hover,.post-actions .comment-count a:hover,.pricing-column .features a:hover,.pricing-column h3,.search-icon a:hover,.services-list li i.fa,.team-list-item h3 a:hover,.team-position,.testimonial .fa-quote-left,.text-primary,.widget a:hover,.widget li .meta-data a:hover,.widget.recent_posts ul li h5 a:hover,.widget_archive ul li a:hover,.widget_categories ul li a:hover,.widget_links ul li a:hover,.widget_links ul li.active a,.widget_meta ul li a:hover,.widget_recent_comments ul li a:hover,.widget_recent_entries ul li a:hover,.woocommerce ul.products li.product a:hover h3,a,a.external:before,a.list-group-item.active>.badge,a:hover,address strong,h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover,p.drop-caps:first-letter,ul.angles li:before,ul.carets li:before,ul.chevrons li::before,ul.icon>li>i,ul.inline li i.fa,ul.inline li:before,.widget_nav_menu ul li.current-menu-item a, .woocommerce-MyAccount-navigation ul li.is-active a,.widget_nav_menu ul li.current-menu-item a:hover, .woocommerce-MyAccount-navigation ul li.is-active a:hover,.widget_product_categories ul li.current-cat a, .widget_product_categories ul li.current-cat a:hover,.pace-loading-bar .pace .pace-progress,.post-categories i,.post-categories a:hover,.project-filter-nav > li:hover, .woocommerce ul.products li.product .price, .woocommerce li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price,.page-banner-title h1,.eventer .eventer-pagination li a{color:'.esc_attr($primaryColor).'}@media only screen and (max-width:992px){.header-style2 .site-header .cart-module-trigger,.header-style2 .site-header .search-module-trigger{color:'.esc_attr($primaryColor).'}}.accent-color,.dark-skin-style a.btn-primary,.dark-skin-style a.btn-primary:hover,.features:hover a,.vc_btn3.vc_btn3-color-theme_primary_btn.vc_btn3-style-outline{color:'.esc_attr($primaryColor).'!important}.accordion-heading .accordion-toggle.active,.blog-image:hover .blog-overlay,.btn-primary,.btn-primary.disabled,.btn-primary.disabled.active,.btn-primary.disabled:active,.btn-primary.disabled:focus,.btn-primary.disabled:hover,.btn-primary[disabled],.btn-primary[disabled].active,.btn-primary[disabled]:active,.btn-primary[disabled]:focus,.btn-primary[disabled]:hover,.carousel-indicators .active,.dropdown-menu>.active>a,.dropdown-menu>.active>a:focus,.dropdown-menu>.active>a:hover,.fblock-image-overlay,.fblock-style2:hover .fblock-icon,.features .features-icon,.flex-control-nav a.flex-active,.flex-control-nav a:hover,.header-style5 .full-width-menu,.icon-box.ibox-outline .ibox-icon.accent-color i,.icon-box.ibox-noborder .ibox-icon.accent-color i,.imi-social-icons-hover-tc li a:hover,.imi-social-icons-tc li a,.label-primary,.media-box .media-box-wrapper,.nav-pills>li.active>a,.nav-pills>li.active>a:focus,.nav-pills>li.active>a:hover,.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover,.overlay-accent,.owl-carousel .owl-dot.active span,.owl-carousel .owl-dot:hover span,.parallax-overlay,.pricing-column.highlight h3,.progress-bar-primary,.services-overlay:before,.single-team-media .social-icons,.social-icons-colored li.envelope a:hover,.social-icons-inverted li.envelope a,.social-share-bar .share-buttons-tc li a,.team-item:hover .team-overlay-bg,.topbar,a.list-group-item.active,a.list-group-item.active:focus,a.list-group-item.active:hover,fieldset[disabled] .btn-primary,fieldset[disabled] .btn-primary.active,fieldset[disabled] .btn-primary:active,fieldset[disabled] .btn-primary:focus,fieldset[disabled] .btn-primary:hover,p.drop-caps.secondary:first-letter,input[type="button"],input[type="submit"],button,.button,.pace-barber-shop .pace .pace-progress,.basic-link:after,.vc_progress_bar .vc_general.vc_single_bar.vc_progress-bar-color-theme_primary_pbar .vc_bar,.tagcloud a:hover{background-color:'.esc_attr($primaryColor).'}.accent-bg,.accent-overlay:before,.donate-button,.primary-bg-style .post-item-content,.vc_btn3.vc_btn3-color-theme_primary_btn,.vc_btn3.vc_btn3-color-theme_primary_btn.vc_btn3-style-outline:hover,.fblock-style1:hover .btn-default{background-color:'.esc_attr($primaryColor).'!important}.btn-primary.active,.btn-primary:active,.btn-primary:focus,.btn-primary:hover,.open .dropdown-toggle.btn-primary,.woocommerce .widget_layered_nav ul li.chosen a,.woocommerce-page .widget_layered_nav ul li.chosen a,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,.wpcf7-form .wpcf7-submit,p.demo_store,.woocommerce ul.products li.product:hover .button,.pace-center-circle .pace .pace-progress,.pace-corner-indicator .pace .pace-activity,.pace-flash .pace .pace-progress,.pace-flat-top .pace .pace-progress,.pace-loading-bar .pace .pace-progress,.pace-minimal .pace .pace-progress,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.media-box:before, .imi_flickr_widget ul li a:before,.style-overlay-primary-bg .imi-item-media:before,.accent-overlay-in>div:before,.pagination-wrap ul.page-numbers li .current,.eventer .eventer-pagination li.active,.imi-countdown-tc.imi-countdown-timer .imi-timer-col > span{background:'.esc_attr($primaryColor).'}.btn-primary.btn-transparent,.fblock-style2 .fblock-icon,.services-list li:hover section,.timeline .column .title .label:before,a.list-group-item.active,a.list-group-item.active:focus,a.list-group-item.active:hover,a.thumbnail.active,a.thumbnail:focus,a.thumbnail:hover,body .woocommerce .button,.icon-box.ibox-outline .ibox-icon.accent-color,.vc_btn3.vc_btn3-color-theme_primary_btn.vc_btn3-style-outline,.owl-carousel .owl-dot span{border-color:'.esc_attr($primaryColor).'}.panel-primary>.panel-heading+.panel-collapse .panel-body,.woocommerce .woocommerce-info,.woocommerce .woocommerce-message,.woocommerce-page .woocommerce-info,.woocommerce-page .woocommerce-message,.accent-color-bt,.pace-flash .pace .pace-activity{border-top-color:'.esc_attr($primaryColor).'}.panel-primary>.panel-footer+.panel-collapse .panel-body,.accent-color-bb{border-bottom-color:'.esc_attr($primaryColor).'}.dd-menu>ul>li>ul li:hover,blockquote,.pace-flash .pace .pace-activity{border-left-color:'.esc_attr($primaryColor).'}.dd-menu>li ul li ul:before,.woocommerce-MyAccount-navigation ul li.is-active a{border-right-color:'.esc_attr($primaryColor).'}.pace-flash .pace .pace-progress-inner{box-shadow: 0 0 10px '.esc_attr($primaryColor).', 0 0 5px '.esc_attr($primaryColor).'}.pace-loading-bar .pace .pace-activity{box-shadow: inset 0 0 0 2px '.esc_attr($primaryColor).', inset 0 0 0 7px #fff}.dd-style3.dd-menu>li.current-menu-item>a,.dd-style3.dd-menu>li:hover>a,.header-style11 .site-header .dd-menu li.menu-item-has-children:hover:after,.imi-social-icons-hover-sc li a:hover,.imi-social-icons-sc li a,.overlay-wrapper-close,input[type="radio"]:checked, input[type="checkbox"]:checked,.icon-box.ibox-outline .ibox-icon.secondary-color i,.icon-box.ibox-noborder .ibox-icon.secondary-color i,.progress-bar-secondary,.secondary-overlay:before,.vc_progress_bar .vc_general.vc_single_bar.vc_progress-bar-color-theme_secondary_pbar .vc_bar{background-color:'.esc_attr($secondaryColor).'}.vc_btn3.vc_btn3-color-theme_secondary_btn,.vc_btn3.vc_btn3-color-theme_secondary_btn.vc_btn3-style-outline:hover{background-color:'.esc_attr($secondaryColor).'!important}.cart-module-opened,.search-module-opened,.secondary-color-bt{border-top-color:'.esc_attr($secondaryColor).'}.header-style5 .fw-menu .dd-style2.dd-menu>li:hover>a,.imi-social-icons-sc.imi-social-icons-plain li a,.imi-social-icons-plain.imi-social-icons-hover-sc li a:hover,.mmenu-toggle:hover,.project-filter-nav.plain-filters>li.active a,.team-item .social-icons-list a:hover,.theme-mobile-header .mobile-menu .dd-menu li.menu-item-has-children:hover:after,.topbar-social>ul>li a:hover,a:hover,.icon-box.ibox-border .ibox-icon.secondary-color i,.icon-box.ibox-plain .ibox-icon.secondary-color i,ul.checks li:before, ul.angles li:before, a.external:before, ul.chevrons li::before, ul.carets li:before, ul.inline li:before, .imi_flickr_widget ul li a:before, .widget_categories ul li a:before, .widget_archive ul li a:before, .widget_links ul li a:before, .widget_meta ul li a:before, .widget_pages ul li a:before, .widget_custom_category ul li a:before, .imi_flickr_widget ul li a:before,.widget.widget_nav_menu ul li a::before{color:'.esc_attr($secondaryColor).'}.dark-skin-style .nav>li>a:hover,.vc_btn3.vc_btn3-color-theme_secondary_btn.vc_btn3-style-outline,.secondary-color{color:'.esc_attr($secondaryColor).'!important}input[type="radio"]:checked, input[type="checkbox"]:checked,.icon-box.ibox-outline .ibox-icon.secondary-color,.vc_btn3.vc_btn3-color-theme_secondary_btn.vc_btn3-style-outline{border-color:'.esc_attr($secondaryColor).'}.dd-menu>li>a:before,.header-style5 .fw-menu .cart-module-trigger,.header-style5 .fw-menu .search-module-trigger,.media-box:after,.open .dropdown-toggle.btn-primary,.secondary-bg,.secondary-bg-style .post-item-content,.services-list li .service-icon:before,.footer-dark-skin #wp-calendar #prev, .footer-dark-skin #wp-calendar #next, .footer-dark-skin #wp-calendar thead, .footer-dark-skin #wp-calendar tfoot, .footer-dark-skin .imi-searchform .btn,.dd-menu > li > ul > li > a:hover, .dd-menu > li > ul > li > ul > li > a:hover, .dd-menu > li > ul > li > ul > li > ul > li > a:hover, .dd-menu .megamenu-container ul li a:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.style-overlay-secondary-bg .imi-item-media:before,.secondary-overlay-in >div:before,.woocommerce a.button.add_to_cart_button,.pagination-wrap ul.page-numbers li a:hover,.eventer .eventer-pagination li a:hover,.imi-countdown-tc.imi-countdown-timer .imi-timer-col > strong{background:'.esc_attr($secondaryColor).'}.footer-dark-skin .widget_nav_menu ul li.current-menu-item a{border-left-color:'.esc_attr($secondaryColor).'}.accent-color-bb{border-bottom-color:'.esc_attr($secondaryColor).'}.secondary-btn,.secondary-btn:active,.secondary-btn:focus{background:'.esc_attr($secondaryColor).'!important}';
}
		
		$site_width = (isset($options['site_width']))?$options['site_width']:'1170';
		$site_width_spaced=!empty($site_width)?$site_width+30:1200;
		$site_width_bdiff=$site_width/2;
		$site_width_diff=$site_width_spaced/2;
		$SiteMinHeight = (isset($options['content_min_height']))?$options['content_min_height']:'400';
		$pagetitlecolor = (isset($options['inner_page_header_title_typography']['color']))?$options['inner_page_header_title_typography']['color']:'';
		$mmtopposition = (isset($options['mobile_menu_drop_top_position']))?$options['mobile_menu_drop_top_position']:'73';
		$mmbackground = (isset($options['mobile_menu_background']['background-color']))?$options['mobile_menu_background']['background-color']:'';
		$mmenubackground = (isset($options['mm_background']['background-color']))?$options['mm_background']['background-color']:'';
		$ddbg = (isset($options['dd_background']['background-color']))?$options['dd_background']['background-color']:'';
		$logoheight = (isset($options['logo_upload']) && !empty($options['logo_upload']['height']))?$options['logo_upload']['height']:57;
		$logotopspacet = (isset($options['logo_spacing']['padding-top']) && !empty($options['logo_spacing']['padding-top']))?$options['logo_spacing']['padding-top']:35;
		$logotopspaceb = (isset($options['logo_spacing']['padding-bottom']) && !empty($options['logo_spacing']['padding-bottom']))?$options['logo_spacing']['padding-bottom']:35;
		$mlogomaxheight = (isset($options['mobile_logo_max_height']) && !empty($options['mobile_logo_max_height']['height']))?$options['mobile_logo_max_height']['height']:'50px';
		$mnavbarspacingtop = (isset($options['mobile_header_row_spacing']['padding-top']) && !empty($options['mobile_header_row_spacing']['padding-top']))?$options['mobile_header_row_spacing']['padding-top']:'12px';
		$mnavbarspacingbottom = (isset($options['mobile_header_row_spacing']['padding-bottom']) && !empty($options['mobile_header_row_spacing']['padding-bottom']))?$options['mobile_header_row_spacing']['padding-bottom']:'12px';
		$mnavbarspacingright = (isset($options['mobile_header_row_spacing']['padding-right']) && !empty($options['mobile_header_row_spacing']['padding-right']))?$options['mobile_header_row_spacing']['padding-right']:'20px';
		$mnavbarspacingleft = (isset($options['mobile_header_row_spacing']['padding-left']) && !empty($options['mobile_header_row_spacing']['padding-left']))?$options['mobile_header_row_spacing']['padding-left']:'20px';
		$topbarwidgetswidth = (isset($options['topbar_opener_dimension']))?$options['topbar_opener_dimension']['width']:'400px';
		$stickyhheight = (isset($options['sticky_header_height']) && !empty($options['sticky_header_height']['height']))?$options['sticky_header_height']['height']:'75px';
		$mobile_header_menu_links_lh = (isset($options['mobile_header_menu_links_typography']) && !empty($options['mobile_header_menu_links_typography']['line-height']))?$options['mobile_header_menu_links_typography']['line-height']:'';
		$mobile_header_menu_links_fs = (isset($options['mobile_header_menu_links_typography']) && !empty($options['mobile_header_menu_links_typography']['font-size']))?$options['mobile_header_menu_links_typography']['font-size']:'';
		if($mobile_header_menu_links_lh != ''){
			$mobile_header_menu_links_fh = $mobile_header_menu_links_lh;
		}elseif($mobile_header_menu_links_fs != ''){
			$mobile_header_menu_links_fh = $mobile_header_menu_links_fs;
		}else{
			$mobile_header_menu_links_fh = '20px';
		}
		$mobile_header_menu_links_spacing_top = (isset($options['mobile_header_menu_links_spacing']) && !empty($options['mobile_header_menu_links_spacing']['padding-top']))?$options['mobile_header_menu_links_spacing']['padding-top']:'13px';
		$mobile_header_menu_links_spacing_bottom = (isset($options['mobile_header_menu_links_spacing']) && !empty($options['mobile_header_menu_links_spacing']['padding-bottom']))?$options['mobile_header_menu_links_spacing']['padding-bottom']:'13px';
		
		$mobile_header_menu_links_lh_new = str_replace('px','',$mobile_header_menu_links_fh);
		$mobile_header_menu_links_spacing_top_new = str_replace('px','',$mobile_header_menu_links_spacing_top);
		$mobile_header_menu_links_spacing_bottom_new = str_replace('px','',$mobile_header_menu_links_spacing_bottom);
		$mobile_header_menu_links_lh_ficon = $mobile_header_menu_links_lh_new + $mobile_header_menu_links_spacing_top_new + $mobile_header_menu_links_spacing_bottom_new;
		
		$mlogomaxheight_new = str_replace('px','',$mlogomaxheight);
		$mnavbarspacingtop_new = str_replace('px','',$mnavbarspacingtop);
		$mnavbarspacingbottom_new = str_replace('px','',$mnavbarspacingbottom);
		$mobiletopper = $mlogomaxheight_new + $mnavbarspacingtop_new + $mnavbarspacingbottom_new;
		
		$logotopspacet_new = str_replace('px','',$logotopspacet);
		$logotopspaceb_new = str_replace('px','',$logotopspaceb);
		$logoheight_new = str_replace('px','',$logoheight);
		$mlineheight = (intval($logotopspacet_new) + intval($logotopspaceb_new) + intval($logoheight_new));
		$hs2topper = (intval($mlineheight)/2) + intval($logoheight_new);
		$hs2spacer = (intval($mlineheight)/2) - intval($logoheight_new)/2;
		if($logoheight_new >= 126){
			$hs3topper = (126 + intval($logotopspacet_new) + intval($logotopspaceb_new))/2;
			
		}elseif($logoheight_new >= 66){
			$hs3topper = (intval($logoheight_new) + intval($logotopspacet_new) + intval($logotopspaceb_new))/2;
			
		} else {
			$hs3topper = 63;
		}
		if($mobile_header_menu_links_lh_ficon != ''){
			echo '.theme-mobile-header .mobile-menu li.menu-item-has-children .mesnopener{height:'.$mobile_header_menu_links_lh_ficon.'px; line-height:'.$mobile_header_menu_links_lh_ficon.'px;}';
		}
		echo '
			.theme-mobile-header .mobile-logo img{max-height:'.esc_attr($mlogomaxheight).'}
			.theme-mobile-header .mobile-navbar .header-equaler, .theme-mobile-header .mobile-navbar .header-equaler > div > div, .theme-mobile-header .mobile-logo > div > div, .theme-mobile-header .mobile-logo{height:'.esc_attr($mlogomaxheight).'}
			.theme-mobile-header .search-module-opened, .theme-mobile-header .cart-module-opened{top:'.esc_attr($mobiletopper).'px; right:'.esc_attr($mnavbarspacingright).'; width:calc(100% - '.esc_attr($mnavbarspacingleft).' - '.esc_attr($mnavbarspacingright).')}
			.header-style2 .site-header .dd-menu > li ul:before{border-bottom-color:'.esc_attr($ddbg).'}
			
			.header-style2 .site-header .dd-menu > li ul li ul:before{border-right-color:'.esc_attr($ddbg).'}
			
			.header-style2 .site-header .dd-menu > li.megamenu ul:before{border-bottom-color:'.esc_attr($mmenubackground).'}
			
			@media (min-width: 1200px) {.container{width:'.esc_attr($site_width).'px}}
			body.boxed .body, body.boxed .vc_row-no-padding{max-width:'.esc_attr($site_width_spaced).'px!important}
			
			@media (min-width: 1200px) {body.boxed .site-header, .header-style7 .site-header, .header-style8 .site-header{width:'.esc_attr($site_width_spaced).'px;margin-left:-'.esc_attr($site_width_diff).'px}}
			
			.header-style1 .dd-menu > li > a, .header-style7 .dd-menu > li > a, .header-style8 .dd-menu > li > a{line-height:'.esc_attr($mlineheight).'px}.site-header .header-equaler, .site-header .header-equaler > div > div, .header-style10 .site-header .relative-container{height:'.esc_attr($mlineheight).'px}
			
			
			.topper-container.widgets-at-right{right:-'.esc_attr($topbarwidgetswidth).'; width:-'.esc_attr($topbarwidgetswidth).'}
			.topper-container.widgets-at-left{left:-'.esc_attr($topbarwidgetswidth).'; width:-'.esc_attr($topbarwidgetswidth).'}
		';
		if ($mlineheight != '')
		{
			echo '.header-style1 .site-header .search-module-opened, .header-style1 .site-header .cart-module-opened, .header-style4 .site-header .search-module-opened, .header-style4 .site-header .cart-module-opened, .header-style7 .site-header .search-module-opened, .header-style7 .site-header .cart-module-opened, .header-style8 .site-header .search-module-opened, .header-style8 .site-header .cart-module-opened{top:'.esc_attr($mlineheight).'px;}';
		}
		if ($hs3topper != '')
		{
			echo '.header-style3 .header-equaler, .header-style3 .header-equaler > div > div, .header-style3 .header-top{height:'.esc_attr($hs3topper).'px;}.header-style3 .dd-menu > li > a{line-height:'.esc_attr($hs3topper).'px;}.header-style3 .site-header .dd-menu > li.megamenu ul{top:'.esc_attr($hs3topper).'px;}';
		}
		if ($hs3topper <= 63){
			echo '.header-style3 .site-logo{line-height:'.esc_attr($hs3topper).'px;}';
		}
		
		if ($logoheight_new != '')
		{
			echo '.header-style2 .dd-menu > li > a{line-height:'.esc_attr($logoheight_new).'px;}';
		}
		if ($hs2topper != '')
		{
			$logotopspaceb_new1 = intval($logotopspaceb_new)/2;
			echo '.header-style2 .site-header .search-module-opened, .header-style2 .site-header .cart-module-opened, .header-style2 .site-header .dd-menu > li > ul{top:'.esc_attr($hs2topper).'px;margin-top:-'.esc_attr($logotopspaceb_new1).'px;}';
			
		}
		if ($hs2spacer != '')
		{
			echo '.header-style2 .dd-menu > li > a{margin-top:'.esc_attr($hs2spacer).'px;}';
		}
		if (isset($options['sidebar_position'])&&$options['sidebar_position'] == 2) {
			echo ' .main-content-row{flex-direction:row-reverse}';
		}
		if (isset($options['content_wide_width'])&&$options['content_wide_width'] == 1)
		{
			echo '.content .container{width:100%;}';
		}
		if (isset($options['sheader11_side'])&&$options['sheader11_side'] == 2)
		{
			echo '.header-style11 .body{padding-left:0;padding-right:300px}.header-style11 .site-header{left:auto;right:0}';
		}
		if ((isset($options['sheader11_width'])&&$options['sheader11_width']['width'] != '') && (isset($options['sheader11_side'])&&$options['sheader11_side'] == 2))
		{
			echo '.header-style11 .body{padding-left:0;padding-right:'.$options['sheader11_width']['width'].'}';
		}
		if ((isset($options['sheader11_width'])&&$options['sheader11_width']['width'] != '') && (isset($options['sheader11_side'])&&$options['sheader11_side'] == 1))
		{
			echo '.header-style11 .body{padding-right:0;padding-left:'.$options['sheader11_width']['width'].'}';
		}
		if (isset($options['header_wide_width'])&&$options['header_wide_width'] == 1)
		{
			echo '.site-header .container, .header-style7 .site-header, .header-style8 .site-header, .page-banner .container, .breadcrumb-wrapper .container{width:100%!important;max-width:100%!important;}
			.header-style7 .site-header, .header-style8 .site-header{left:0;margin-left:0}';
		}
		if ((isset($options['header_no_side_padding'])&&$options['header_no_side_padding'] == 1) && (isset($options['header_wide_width'])&&$options['header_wide_width'] == 1))
		{
			echo '.site-header .container, .page-banner .container, .breadcrumb-wrapper .container{padding-left:0; padding-right:0}';
		}
		if (isset($options['topbar_wide_width'])&&$options['topbar_wide_width'] == 1)
		{
			echo '.topbar .container{width:100%;}';
		}
		if ((isset($options['topbar_no_side_padding'])&&$options['topbar_no_side_padding'] == 1) && (isset($options['topbar_wide_width'])&&$options['topbar_wide_width'] == 1))
		{
			echo '.topbar .container{padding-left:0; padding-right:0}';
		}
		if (isset($options['header_position_float'])&&$options['header_position_float'] == 1)
		{
			echo 'body:not(.header-style11) .site-header,.theme-mobile-header{position:absolute;}';
		} else {
			echo 'body:not(.header-style11) .site-header,.theme-mobile-header{position:relative;}';
		}
		if (isset($options['header_no_bg_strict'])&&$options['header_no_bg_strict'] == 1)
		{
			echo 'body .body .site-header{background:none;}';
		}
		if (isset($options['header_no_box_shadow'])&&$options['header_no_box_shadow'] == 1)
		{
			echo '.body .site-header{-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}';
		}
		if (isset($options['stickyh_wide_width'])&&$options['stickyh_wide_width'] == 1)
		{
			echo '.theme-sticky-header .container{width:100%;}';
		}
		if (isset($options['enable_topbar_opener_always'])&&$options['enable_topbar_opener_always'] == 1)
		{
			echo '.topper-container{display:block}';
		}
		if ((isset($options['stickyh_no_side_padding'])&&$options['stickyh_no_side_padding'] == 1) && (isset($options['stickyh_wide_width'])&&$options['stickyh_wide_width'] == 1))
		{
			echo '.theme-sticky-header .container{padding-left:0; padding-right:0}';
		}
		if (isset($options['full_width_footer'])&&$options['full_width_footer'] == 1)
		{
			echo '.site-footer-top .container{width:100%;}';
		}
		if ((isset($options['footer_top_no_side_padding'])&&$options['footer_top_no_side_padding'] == 1) && (isset($options['full_width_footer'])&&$options['full_width_footer'] == 1))
		{
			echo '.site-footer-top .container{padding-left:0; padding-right:0}';
		}
		if (isset($options['full_width_footer_bottom'])&&$options['full_width_footer_bottom'] == 1)
		{
			echo '.site-footer-bottom .container{width:100%!important;max-width:100%!important}';
		}
		if ((isset($options['footer_bottom_no_side_padding'])&&$options['footer_bottom_no_side_padding'] == 1) && (isset($options['full_width_footer_bottom'])&&$options['full_width_footer_bottom'] == 1))
		{
			echo '.site-footer-bottom .container{padding-left:0; padding-right:0}';
		}
		if ($SiteMinHeight != '')
		{
			echo '.content{min-height:'.esc_attr($SiteMinHeight).'px}';
		}
		if (isset($options['inner_page_header_title'])&&$options['inner_page_header_title'] == 1)
		{
			echo '.page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_posts_header_title'])&&$options['inner_posts_header_title'] == 1)
		{
			echo '.single-post .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_projects_header_title'])&&$options['inner_projects_header_title'] == 1)
		{
			echo '.single-imi_projects .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_events_header_title'])&&$options['inner_events_header_title'] == 1)
		{
			echo '.single-eventer .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_services_header_title'])&&$options['inner_services_header_title'] == 1)
		{
			echo '.single-imi_services .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_team_header_title'])&&$options['inner_team_header_title'] == 1)
		{
			echo '.single-imi_team .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_products_header_title'])&&$options['inner_products_header_title'] == 1)
		{
			echo '.single-product .page-banner-title{display:none!important;}';
		}
		if (isset($options['inner_page_header_display'])&&$options['inner_page_header_display'] == 1)
		{
			echo '.hero-area{display:none!important;}';
		}
		if (isset($options['inner_posts_header_display'])&&$options['inner_posts_header_display'] == 1)
		{
			echo '.single-post .hero-area{display:none!important;}';
		}
		if (isset($options['inner_projects_header_display'])&&$options['inner_projects_header_display'] == 1)
		{
			echo '.single-imi_projects .hero-area{display:none!important;}';
		}
		if (isset($options['inner_events_header_display'])&&$options['inner_events_header_display'] == 1)
		{
			echo '.single-eventer .hero-area{display:none!important;}';
		}
		if (isset($options['inner_services_header_display'])&&$options['inner_services_header_display'] == 1)
		{
			echo '.single-imi_services .hero-area{display:none!important;}';
		}
		if (isset($options['inner_team_header_display'])&&$options['inner_team_header_display'] == 1)
		{
			echo '.single-imi_team .hero-area{display:none!important;}';
		}
		if (isset($options['inner_products_header_display'])&&$options['inner_products_header_display'] == 1)
		{
			echo '.single-product .hero-area{display:none!important;}';
		}
		if (isset($options['footer_bottom_enable'])&&$options['footer_bottom_enable'] == 0)
		{
			echo '.site-footer-bottom{display:none;}';
		}
		if (isset($options['nav_directions_arrows'])&&$options['nav_directions_arrows'] == 0)
		{
			echo '.dd-menu > li.menu-item-has-children a:after{display:none;}';
		}
		if (isset($options['dd_dropshadow'])&&$options['dd_dropshadow'] == 0)
		{
			echo '.dd-menu > li ul{-webkit-box-shadow:none; -moz-box-shadow:none; box-shadow:none;}';
		}
		if (isset($options['dd_border_radius'])&&$options['dd_border_radius'] == 0)
		{
			echo '.dd-style2.dd-menu > li ul{-webkit-border-radius:0; -moz-border-radius:0; border-radius:0;}';
		}
		if (isset($options['sheader11_padding'])&&$options['sheader11_padding']['padding-left'] != '')
		{
			echo '.header-style11 .header-bottom-blocks{padding-left:'.$options['sheader11_padding']['padding-left'].'}';
		}
		if (isset($options['sheader11_padding'])&&$options['sheader11_padding']['padding-right'] != '')
		{
			echo '.header-style11 .header-bottom-blocks{padding-right:'.$options['sheader11_padding']['padding-right'].'}';
		}
		if (isset($options['topbar_menu_links_border'])&&$options['topbar_menu_links_border']['border-left'] != '')
		{
			echo '.topbar-additional-menu > ul{border-right-width:'.$options['topbar_menu_links_border']['border-left'].';border-right-style:'.$options['topbar_menu_links_border']['border-style'].';border-right-color:'.$options['topbar_menu_links_border']['border-color'].'}';
		}
		if (isset($options['sticky_header_height'])&&$options['sticky_header_height']['height'] != '')
		{
			$shlhr = intval($stickyhheight) - 30;
			echo '.theme-sticky-header .sticky-logo img{max-height:'.$shlhr.'px}';
		}

		if (isset($options['dd_item_link_color']['regular'])&&$options['dd_item_link_color']['regular'] != '')
		{
			echo '.dd-style1.dd-menu > li > ul > li > a, .dd-style1.dd-menu > li > ul > li > ul > li > a, .dd-style1.dd-menu > li > ul > li > ul > li > ul > li > a,.dd-style2.dd-menu > li > ul > li > a, .dd-style2.dd-menu > li > ul > li > ul > li > a, .dd-style2.dd-menu > li > ul > li > ul > li > ul > li > a, .dd-style3.dd-menu > li > ul > li > a, .dd-style3.dd-menu > li > ul > li > ul > li > a, .dd-style3.dd-menu > li > ul > li > ul > li > ul > li > a, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > a, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > a, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > ul > li > a{color:'.$options['dd_item_link_color']['regular'].'}';
		}
		if (isset($options['dd_item_link_color']['hover'])&&$options['dd_item_link_color']['hover'] != '')
		{
			echo '.dd-style1.dd-menu > li > ul > li > a:hover, .dd-style1.dd-menu > li > ul > li > ul > li > a:hover, .dd-style1.dd-menu > li > ul > li > ul > li > ul > li > a:hover,.dd-style2.dd-menu > li > ul > li > a:hover, .dd-style2.dd-menu > li > ul > li > ul > li > a:hover, .dd-style2.dd-menu > li > ul > li > ul > li > ul > li > a:hover, .dd-style3.dd-menu > li > ul > li > a:hover, .dd-style3.dd-menu > li > ul > li > ul > li > a:hover, .dd-style3.dd-menu > li > ul > li > ul > li > ul > li > a:hover, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > a:hover, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > a:hover, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > ul > li > a:hover{color:'.$options['dd_item_link_color']['hover'].'}';
		}
		if (isset($options['dd_item_link_color']['active'])&&$options['dd_item_link_color']['active'] != '')
		{
			echo '.dd-style1.dd-menu > li > ul > li > a:active, .dd-style1.dd-menu > li > ul > li > ul > li > a:active, .dd-style1.dd-menu > li > ul > li > ul > li > ul > li > a:active,.dd-style2.dd-menu > li > ul > li > a:active, .dd-style2.dd-menu > li > ul > li > ul > li > a:active, .dd-style2.dd-menu > li > ul > li > ul > li > ul > li > a:active, .dd-style3.dd-menu > li > ul > li > a:active, .dd-style3.dd-menu > li > ul > li > ul > li > a:active, .dd-style3.dd-menu > li > ul > li > ul > li > ul > li > a:active, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > a:active, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > a:active, .header-style9 .overlay-wrapper .dd-menu > li > ul > li > ul > li > ul > li > a:active{color:'.$options['dd_item_link_color']['active'].'}';
		}
		if (isset($options['bfooter_link_color']['regular'])&&$options['bfooter_link_color']['regular'] != '')
		{
			echo '.body .site-footer-bottom a, .body .footer-dark-skin.site-footer-bottom a{color:'.$options['bfooter_link_color']['regular'].'}';
		}
		if (isset($options['bfooter_link_color']['hover'])&&$options['bfooter_link_color']['hover'] != '')
		{
			echo '.body .site-footer-bottom a:hover, .body .footer-dark-skin.site-footer-bottom a:hover{color:'.$options['bfooter_link_color']['hover'].'}';
		}
		if (isset($options['bfooter_link_color']['active'])&&$options['bfooter_link_color']['active'] != '')
		{
			echo '.body .site-footer-bottom a:active, .body .footer-dark-skin.site-footer-bottom a:active{color:'.$options['bfooter_link_color']['active'].'}';
		}
		if (isset($options['main_nav_link']['regular'])&&$options['main_nav_link']['regular'] != '')
		{
			echo '.dd-menu > li > a, .header-style2 .site-header .dd-menu > li > a, .header-style9 .overlay-wrapper .dd-menu > li > a{color:'.$options['main_nav_link']['regular'].'}';
		}
		if (isset($options['main_nav_link']['hover'])&&$options['main_nav_link']['hover'] != '')
		{
			echo '.dd-menu > li > a:hover, .header-style2 .site-header .dd-menu > li > a:hover, .header-style9 .overlay-wrapper .dd-menu > li > a:hover{color:'.$options['main_nav_link']['hover'].'}';
		}
		if (isset($options['main_nav_link']['active'])&&$options['main_nav_link']['active'] != '')
		{
			echo '.dd-menu > li > a:active, .header-style2 .site-header .dd-menu > li > a:active, .header-style9 .overlay-wrapper .dd-menu > li > a:active{color:'.$options['main_nav_link']['active'].'}';
		}
		if (isset($options['main_nav_link_active']['regular'])&&$options['main_nav_link_active']['regular'] != '')
		{
			echo '.dd-menu > li.current-menu-item > a, .header-style9 .overlay-wrapper .dd-menu > li.current-menu-item > a{color:'.$options['main_nav_link_active']['regular'].'}';
		}
		if (isset($options['main_nav_link_active']['hover'])&&$options['main_nav_link_active']['hover'] != '')
		{
			echo '.dd-menu > li.current-menu-item > a:hover, .header-style9 .overlay-wrapper .dd-menu > li.current-menu-item > a:hover{color:'.$options['main_nav_link_active']['hover'].'}';
		}
		if (isset($options['main_nav_link_active']['active'])&&$options['main_nav_link_active']['active'] != '')
		{
			echo '.dd-menu > li.current-menu-item > a:active, .header-style9 .overlay-wrapper .dd-menu > li.current-menu-item > a:active{color:'.$options['main_nav_link_active']['active'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['regular'])&&$options['shddsearch_trigger_links_color']['regular'] != '')
		{
			echo '.site-header .search-module-trigger, .header-style2 .site-header .search-module-trigger, .header-style9 .site-header .search-module-trigger{color:'.$options['shddsearch_trigger_links_color']['regular'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['hover'])&&$options['shddsearch_trigger_links_color']['hover'] != '')
		{
			echo '.site-header .search-module-trigger:hover, .header-style2 .site-header .search-module-trigger:hover, .header-style9 .site-header .search-module-trigger:hover{color:'.$options['shddsearch_trigger_links_color']['hover'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['active'])&&$options['shddsearch_trigger_links_color']['active'] != '')
		{
			echo '.site-header .search-module-trigger:active, .header-style2 .site-header .search-module-trigger:active, .header-style9 .site-header .search-module-trigger:active{color:'.$options['shddsearch_trigger_links_color']['active'].'}';
		}
		if (isset($options['shcart_trigger_links_color']['regular'])&&$options['shcart_trigger_links_color']['regular'] != '')
		{
			echo '.site-header .cart-module-trigger, .header-style2 .site-header .cart-module-trigger, .header-style9 .site-header .cart-module-trigger{color:'.$options['shcart_trigger_links_color']['regular'].'}';
		}
		if (isset($options['shcart_trigger_links_color']['hover'])&&$options['shcart_trigger_links_color']['hover'] != '')
		{
			echo '.site-header .cart-module-trigger:hover, .header-style2 .site-header .cart-module-trigger:hover, .header-style9 .site-header .cart-module-trigger:hover{color:'.$options['shcart_trigger_links_color']['hover'].'}';
		}
		if (isset($options['shcart_trigger_links_color']['active'])&&$options['shcart_trigger_links_color']['active'] != '')
		{
			echo '.site-header .cart-module-trigger:active, .header-style2 .site-header .cart-module-trigger:active, .header-style9 .site-header .cart-module-trigger:active{color:'.$options['shcart_trigger_links_color']['active'].'}';
		}
		if (isset($options['stickyh_menu_dd_links_color']['regular'])&&$options['stickyh_menu_dd_links_color']['regular'] != '')
		{
			echo '.theme-sticky-header .sticky-menu > ul li ul li a, .theme-sticky-header .sticky-menu > ul li ul li ul li a{color:'.$options['stickyh_menu_dd_links_color']['regular'].'}';
		}
		if (isset($options['stickyh_menu_dd_links_color']['hover'])&&$options['stickyh_menu_dd_links_color']['hover'] != '')
		{
			echo '.theme-sticky-header .sticky-menu > ul li ul li a:hover, .theme-sticky-header .sticky-menu > ul li ul li ul li a:hover{color:'.$options['stickyh_menu_dd_links_color']['hover'].'}';
		}
		if (isset($options['stickyh_menu_dd_links_color']['active'])&&$options['stickyh_menu_dd_links_color']['active'] != '')
		{
			echo '.theme-sticky-header .sticky-menu > ul li ul li a:active, .theme-sticky-header .sticky-menu > ul li ul li ul li a:active{color:'.$options['stickyh_menu_dd_links_color']['active'].'}';
		}
		if (isset($options['mobile_header_triggers_links_color']['regular'])&&$options['mobile_header_triggers_links_color']['regular'] != '')
		{
			echo '.theme-mobile-header .cart-module-trigger, .theme-mobile-header .search-module-trigger, .theme-mobile-header .mmenu-toggle{color:'.$options['mobile_header_triggers_links_color']['regular'].'}';
		}
		if (isset($options['mobile_header_triggers_links_color']['hover'])&&$options['mobile_header_triggers_links_color']['hover'] != '')
		{
			echo '.theme-mobile-header .cart-module-trigger:hover, .theme-mobile-header .search-module-trigger:hover, .theme-mobile-header .mmenu-toggle:hover{color:'.$options['mobile_header_triggers_links_color']['hover'].'}';
		}
		if (isset($options['mobile_header_triggers_links_color']['active'])&&$options['mobile_header_triggers_links_color']['active'] != '')
		{
			echo '.theme-mobile-header .cart-module-trigger:active, .theme-mobile-header .search-module-trigger:active, .theme-mobile-header .mmenu-toggle:active{color:'.$options['mobile_header_triggers_links_color']['active'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['regular'])&&$options['shddsearch_trigger_links_color']['regular'] != '')
		{
			echo '.site-header .search-module-trigger, .header-style2 .site-header .search-module-trigger, .header-style9 .site-header .search-module-trigger{color:'.$options['shddsearch_trigger_links_color']['regular'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['hover'])&&$options['shddsearch_trigger_links_color']['hover'] != '')
		{
			echo '.site-header .search-module-trigger:hover, .header-style2 .site-header .search-module-trigger:hover, .header-style9 .site-header .search-module-trigger:hover{color:'.$options['shddsearch_trigger_links_color']['hover'].'}';
		}
		if (isset($options['shddsearch_trigger_links_color']['active'])&&$options['shddsearch_trigger_links_color']['active'] != '')
		{
			echo '.site-header .search-module-trigger:active, .header-style2 .site-header .search-module-trigger:active, .header-style9 .site-header .search-module-trigger:active{color:'.$options['shddsearch_trigger_links_color']['active'].'}';
		}


		if (isset($options['sidebar_spacing']['padding-left'])&&$options['sidebar_spacing']['padding-left'] != '')
		{
			echo '#sidebar-col .eventer-countdown{margin-left:-'.$options['sidebar_spacing']['padding-left'].'}';
		}
		if (isset($options['sidebar_spacing']['padding-right'])&&$options['sidebar_spacing']['padding-right'] != '')
		{
			echo '#sidebar-col .eventer-countdown{margin-right:-'.$options['sidebar_spacing']['padding-right'].'}';
		}


		echo '
		.theme-sticky-header .search-module-opened, .theme-sticky-header .cart-module-opened{top:'.esc_attr($stickyhheight).';}
		.theme-sticky-header .sticky-menu > ul > li > a{line-height:'.esc_attr($stickyhheight).';}
		.theme-sticky-header .header-equaler, .theme-sticky-header .header-equaler > div > div{height:'.esc_attr($stickyhheight).';}';

//Page Style Options
$id = ($_REQUEST['pgid'])?$_REQUEST['pgid']:'';
$taxp = ($_REQUEST['taxp'])?$_REQUEST['taxp']:'';
if($taxp=="1") 
{
	$content_top_padding = get_post_meta($id,'blokco_content_padding_top',true);
	$content_bottom_padding = get_post_meta($id,'blokco_content_padding_bottom',true);
	$content_width = get_post_meta($id,'blokco_content_width',true);
	$page_header_show = get_post_meta($id,'blokco_page_header_show',true);
	$page_social_show = get_post_meta($id,'blokco_page_social_share',true);
	$page_title_show = get_post_meta($id,'blokco_pages_title_show',true);
	$page_breadcrumb_show = get_post_meta($id,'blokco_pages_breadcrumb_show',true);
	$page_topbar_show = get_post_meta($id,'blokco_page_topbar_show',true);
	$header_image_overlay = get_post_meta($id,'blokco_header_image_overlay',true);
	$header_image_overlay_opacity = get_post_meta($id,'blokco_header_image_overlay_opacity',true);
	$pages_banner_text_color = get_post_meta($id,'blokco_pages_banner_text_color',true);
	$pages_title_alignment = get_post_meta($id,'blokco_pages_title_alignment',true);
	$page_body_bg_color = get_post_meta($id,'blokco_pages_body_bg_color',true);
	$page_body_bg_image = get_post_meta($id,'blokco_pages_body_bg_image',true);
	$page_body_bg_image_src = wp_get_attachment_image_src( $page_body_bg_image, 'full', '', array() );
	$page_body_bg_size = get_post_meta($id,'blokco_pages_body_bg_wide',true);
	if($page_body_bg_size==0){
		$page_body_bg_size_result = 'auto';
		$page_body_bg_size_attachment = 'scroll';
	}else{
		$page_body_bg_size_result = 'cover';
		$page_body_bg_size_attachment = 'fixed';
	}
	$page_body_bg_repeat = get_post_meta($id,'blokco_pages_body_bg_repeat',true);
	$page_content_bg_color = get_post_meta($id,'blokco_pages_content_bg_color',true);
	$page_content_bg_image = get_post_meta($id,'blokco_pages_content_bg_image',true);
	$page_content_bg_image_src = wp_get_attachment_image_src( $page_content_bg_image, 'full', '', array() );
	$page_content_bg_size = get_post_meta($id,'blokco_pages_content_bg_wide',true);
	if($page_content_bg_size==0){
		$page_content_bg_size_result = 'auto';
		$page_content_bg_size_attachment = 'scroll';
	}else{
		$page_content_bg_size_result = 'cover';
		$page_content_bg_size_attachment = 'fixed';
	}
	$page_content_bg_repeat = get_post_meta($id,'blokco_pages_content_bg_repeat',true);
		if($page_header_show == 0 && $page_header_show != ''){
			echo'.hero-area{display:none;}';	
		}else{
			echo'.hero-area{display:block;}';		
		}
		if($page_social_show == 0 && $page_social_show != ''){
			echo'.social-share-bar{display:none;}';	
		}else{
			echo'.social-share-bar{display:block;}';		
		}
		if($page_title_show == 0 && $page_title_show != ''){
			echo'.page-banner-title{display:none;}';
		}else{
			echo'.page-banner-title{display:block;}';		
		}
		if($page_breadcrumb_show == 0 && $page_breadcrumb_show != ''){
			echo'.breadcrumb-wrapper{display:none;}';	
		}else{
			echo'.breadcrumb-wrapper{display:block;}';		
		}
		if($page_topbar_show == 0 && $page_topbar_show != ''){
			echo'.topbar{display:none;}';	
		}else{
			echo'.topbar{display:block;}';		
		}
		if($header_image_overlay != ''){
			echo '.page-banner-image:before{background:'.$header_image_overlay.';}';
		}
		if($header_image_overlay_opacity != ''){
			echo '.page-banner-image:before{opacity:'.$header_image_overlay_opacity.';}';
		} else {
			echo '.page-banner-image:before{opacity:.4;}';	
		}
		if($pages_banner_text_color != ''){
			echo'.page-banner-title h1{color:'.$pages_banner_text_color.';}';	
		}
		if($pages_title_alignment != ''){
			echo'.page-banner-title{text-align:'.$pages_title_alignment.'!important;}';	
		}
		echo '.content{';
			if($content_top_padding != ''){ echo 'padding-top:'.esc_attr($content_top_padding).'px;'; }
			if($content_bottom_padding != ''){ echo 'padding-bottom:'.esc_attr($content_bottom_padding).'px;'; }
		echo '}';
		if($content_width != ''){
		echo '
		.content .container{
			width:'.esc_attr($content_width).';
		}';
		}
		echo 'body.boxed{';
			if($page_body_bg_color != ''){ echo 'background-color:'.esc_attr($page_body_bg_color).';';}
			if($page_body_bg_image != ''){ echo 'background-image:url('.esc_attr($page_body_bg_image_src[0]).')!important;';}
			if($page_body_bg_image != ''){ echo 'background-size:'.esc_attr($page_body_bg_size_result).'!important;';}
			if($page_body_bg_image != ''){ echo 'background-repeat:'.esc_attr($page_body_bg_repeat).'!important;';}
			if($page_body_bg_image != ''){ echo 'background-attachment:'.esc_attr($page_body_bg_size_attachment).'!important;';}
		echo '}
		.content{';
			if($page_content_bg_color != ''){ echo 'background-color:'.esc_attr($page_content_bg_color).';';}
			if($page_content_bg_image != ''){ echo 'background-image:url('.esc_attr($page_content_bg_image_src[0]).');';}
			if($page_content_bg_image != ''){ echo 'background-size:'.esc_attr($page_content_bg_size_result).';';}
			if($page_content_bg_image != ''){ echo 'background-repeat:'.esc_attr($page_content_bg_repeat).';';}
			if($page_content_bg_image != ''){ echo 'background-attachment:'.esc_attr($page_content_bg_size_attachment).';';}
		echo '}';
	}
$sidebar_position = (isset($_REQUEST['sidebar_pos']))?$_REQUEST['sidebar_pos']:'';
if($sidebar_position == 2)
{
	echo ' .main-content-row{flex-direction:row-reverse}';	
}
elseif($sidebar_position == 1)
{
	echo ' .main-content-row{flex-direction:row}';	
}

// USER STYLES
if ($custom_css) 
{
	echo "\n" . '/*========== User Custom CSS Styles ==========*/' . "\n";
	echo ''.$custom_css;
}

if(isset($options['site_layout'])&&$options['site_layout'] == 'boxed')
{
	if (!empty($options['upload-repeatable-bg-image']['id'])) 
	{
		 echo 'body{background-image:url(' . $options['upload-repeatable-bg-image']['url'] . '); background-repeat:repeat; background-size:auto;}';
	} 
	else if (!empty($options['full-screen-bg-image']['id'])) 
	{
		 echo 'body{background-image:url(' . $options['full-screen-bg-image']['url'] . '); background-repeat: no-repeat; background-size:cover;}';
	}
	else if(!empty($options['repeatable-bg-image'])) 
	{
		 echo 'body{background-image:url(' . get_template_directory_uri() . '/images/patterns/' . $options['repeatable-bg-image'] . '); background-repeat:repeat; background-size:auto;}';
	}
}

$footer_vc_section = (isset($options['footer_vc_section']))?$options['footer_vc_section']:'';
$topbar_widgets_content = (isset($options['topbar_widgets_content']) && $options['topbar_widgets_content'] != '')?$options['topbar_widgets_content']:'';
echo get_post_meta( $footer_vc_section, '_wpb_shortcodes_custom_css', true );
echo get_post_meta( $topbar_widgets_content, '_wpb_shortcodes_custom_css', true );
?>