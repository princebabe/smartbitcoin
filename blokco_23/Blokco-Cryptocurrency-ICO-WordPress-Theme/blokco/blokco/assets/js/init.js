jQuery(function($){
	"use strict";

	var BLOKCO = window.BLOKCO || {};

	BLOKCO.megaMenu = function() {
	};

	/* ==================================================
		Scroll Functions
	================================================== */
		BLOKCO.scrollFunctions = function(){
			var didScroll = false;

			var $arrow = $('#back-to-top');
			var $sticky_header_wrapper = $('.theme-sticky-header');

			$arrow.on('click',function(e) {
				$('body,html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
				e.preventDefault();
			});

			$(window).scroll(function() {
				didScroll = true;
			});

			setInterval(function() {
				if( didScroll ) {
					didScroll = false;

					if( $(window).scrollTop() > 200 ) {
						$arrow.css("right",20);
					} else {
						$arrow.css("right","-50px");
					}


						if( $(window).scrollTop() > 200 ) {
							$sticky_header_wrapper.css("margin-top",'0');
						} else {
							$sticky_header_wrapper.css("margin-top","-999px");
						}

				}
			}, 250);
		};
	/* ==================================================
	   Hero Flex Slider
	================================================== */
		BLOKCO.heroflex = function() {
			$('.heroflex').each(function(){
					var carouselInstance = $(this); 
					var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
					var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
					var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
					var carouselDirection = carouselInstance.attr("data-direction") ? carouselInstance.attr("data-direction") : "horizontal";
					var carouselStyle = carouselInstance.attr("data-style") ? carouselInstance.attr("data-style") : "fade";
					var carouselSpeed = carouselInstance.attr("data-speed") ? carouselInstance.attr("data-speed") : "5000";
					var carouselPause = carouselInstance.attr("data-pause") === 'yes' ? true : false;

					carouselInstance.flexslider({
						animation: carouselStyle,
						easing: "swing",
						direction: carouselDirection,
						slideshow: carouselAutoplay,
						slideshowSpeed: carouselSpeed,
						animationSpeed: 600,
						initDelay: 0,
						randomize: false,
						pauseOnHover: carouselPause,
						controlNav: carouselPagination,
						directionNav: carouselArrows,
						prevText: "",
						nextText: ""
					});
			});
		};
	/* ==================================================
	   Flex Slider
	================================================== */
		BLOKCO.galleryflex = function() {
			$('.galleryflex').each(function(){
					var carouselInstance = $(this); 
					var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
					var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
					var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
					var carouselDirection = carouselInstance.attr("data-direction") ? carouselInstance.attr("data-direction") : "horizontal";
					var carouselStyle = carouselInstance.attr("data-style") ? carouselInstance.attr("data-style") : "fade";
					var carouselSpeed = carouselInstance.attr("data-speed") ? carouselInstance.attr("data-speed") : "5000";
					var carouselPause = carouselInstance.attr("data-pause") === 'yes' ? true : false;

					carouselInstance.flexslider({
						animation: carouselStyle,
						easing: "swing",
						direction: carouselDirection,
						slideshow: carouselAutoplay,
						slideshowSpeed: carouselSpeed,
						animationSpeed: 600,
						initDelay: 0,
						animationLoop: false,
						randomize: false,
						pauseOnHover: carouselPause,
						controlNav: carouselPagination,
						directionNav: carouselArrows,
						prevText: "",
						nextText: ""
					});
			});
		};
	/* ==================================================
	   Owl Carousel
	================================================== */
		BLOKCO.OwlCarousel = function() {
			$('.owl-carousel').each(function(){
					var carouselInstance = $(this); 
					var carouselColumns = carouselInstance.attr("data-columns") ? carouselInstance.attr("data-columns") : "1";
					var carouselColumnsT = carouselInstance.attr("data-columns-tab") ? carouselInstance.attr("data-columns-tab") : "1";
					var carouselColumnsM = carouselInstance.attr("data-columns-mobile") ? carouselInstance.attr("data-columns-mobile") : "1";
					var carouselAutoplay = carouselInstance.attr("data-autoplay") === 'yes' ? true : false;
					var carouselAutoplayTime = carouselInstance.attr("data-autoplay-timeout") ? carouselInstance.attr("data-autoplay-timeout") : '5000';
					var carouselPagination = carouselInstance.attr("data-pagination") === 'yes' ? true : false;
					var carouselArrows = carouselInstance.attr("data-arrows") === 'yes' ? true : false;
					var carouselAutoHeight = carouselInstance.attr("data-auto-height") === 'yes' ? true : false;
					var carouselRTL = carouselInstance.attr("data-rtl") === 'yes' ? true : false;
					var carouselLoop = carouselInstance.attr("data-loop") === 'yes' ? true : false;
					var carouselMargin = carouselInstance.attr("data-margin") ? carouselInstance.attr("data-margin") : 30;
					var carouselPadding = carouselInstance.attr("data-padding") ? carouselInstance.attr("data-padding") : 0;

					carouselInstance.owlCarousel({
						loop: carouselLoop,
						items: carouselColumns,
						autoWidth: false,
						margin: parseInt(carouselMargin),
						stagePadding: parseInt(carouselPadding),
						autoplay : carouselAutoplay,
						autoplayTimeout: parseInt(carouselAutoplayTime),
						nav : carouselArrows,
						dots : carouselPagination,
						mergeFit: false,
						navText: ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
						autoplayHoverPause: true,
						lazyLoad: true,
						rtl: carouselRTL,
						autoHeight: carouselAutoHeight,
						responsive:{
							0:{
								items:carouselColumnsM,
								dots:true,
								nav:false,
								stagePadding:0
							},
							768:{
								items:carouselColumnsT,
								nav:false
							},
							1000:{
								items:carouselColumns
							},
							1200:{
								items:carouselColumns
							}
						}
					});
			});
		};
	/* ==================================================
	   Magnific Popup
	================================================== */
		BLOKCO.Magnific = function() {
			jQuery('.format-gallery').each(function(){
				$(this).magnificPopup({
					delegate: 'a.popup-image', // child items selector, by clicking on it popup will open
					type: 'image',
					autoFocusLast: true,
					mainClass: 'mfp-with-zoom mfp-img-mobile',
					gallery:{enabled:true},
				});
			});
			jQuery('.magnific-image').magnificPopup({ 
				type: 'image',
				autoFocusLast: true,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				gallery:{enabled:false}
				// other options
			});
			jQuery('.magnific-video,.magnific-video button,.magnific-video a').magnificPopup({ 
				type: 'iframe',
				autoFocusLast: true,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				zoom: {
					enabled: true,
					duration: 300, // don't foget to change the duration also in CSS
					opener: function(element) {
					  return element.find('img');
					}
				},
				gallery:{enabled:false}
				// other options
			});
		};
	/* ==================================================
	   Animated Counters
	================================================== */
		BLOKCO.Counters = function() {
			$('.cust-counter').each(function () {
				$(this).appear(function() {
				var counter = $(this).find(".timer .count").html();
				$(this).find(".timer .count").countTo({
					from: 0,
					to: counter,
					speed: 2000,
					refreshInterval: 60
					});
				});
			});
		};
	/* ==================================================
	   SuperFish menu
	================================================== */
		BLOKCO.SuperFish = function() {
			$(".site-header").find(".dd-menu > li").clone().appendTo(".main-menu-clone > div > ul");
			$(".site-header").find(".dd-menu").clone().appendTo(".sticky-menu");
			$(".mmenu-toggle").on('click',function(){
				$(".mobile-menu").slideToggle();
				$(this).toggleClass('menu-opened');
			});
			if(!$('body').hasClass('header-style11')){
				$('.sf-menu').superfish({
					  delay: 200,
					  animation: {opacity:'show', height:'show'},
					  speed: 'fast',
					  cssArrows: false,
					  disableHI: true
				});
			}
			$('.theme-mobile-header .mobile-menu li.menu-item-has-children').each(function(){
				$(this).append('<span class="mesnopener"></span>');
			});
			$('.theme-mobile-header .mobile-menu li.menu-item-has-children .mesnopener').on('click',function(){
				$(this).parent('li').find('>ul.sub-menu').slideToggle();
				$(this).parent('li').toggleClass('mitem-clicked');
				return false;
			});

			// Centering the dropdown menus
			var a = $(".dd-style2.dd-menu li");
			a.mouseover(function() {
				 var the_width = $(this).find("a").width();
				 var child_width = $(this).find("ul").width();
				 var width = parseInt((child_width - the_width)/2);
				$(this).find("ul").css('left', -width);
			});

			var aa = $(".dd-menu li, .sticky-menu li");
			aa.each(function() {
				var aa = $(window).width() - 16, t = $(this).offset().left, o = $(this).find("ul.sub-menu").width(), n = 0;
				n = $("body").hasClass("boxed") ? imi_local.siteWidth - (t - (aa - imi_local.siteWidth) / 2) :aa - t;
				var d;
				$(this).find("ul.sub-menu").length > 0 && (d = n - o), (o > n || o > d) && ($(this).find("ul.sub-menu").addClass("right"),$(this).addClass("right-align-menu"), 
				$(this).find("ul.sub-menu").addClass("right"));
			});

			$('.hidden-menu-opener').on('click', function(){
				$('.main-menu').fadeToggle();
				$('body').addClass('fscreen-menu-open');
				return false;
			});

			BLOKCO.hs11hgetter = function() {
				var hs11theight = $('.header-style11 .site-header .header-top-blocks').height();
				var hs11bheight = $('.header-style11 .site-header .header-bottom-blocks').height();
				if($(window).height() < hs11theight+hs11bheight){
					$('.header-style11 .header-bottom-blocks').css({'position':'static','padding-left':0,'padding-right':0});
				}
			};

			$('.header-style11 .site-header .dd-menu li.menu-item-has-children').after().on('click',function(){
				$(this).find('> ul.sub-menu').slideToggle();
				$(this).toggleClass('menu-toggle-status');
				BLOKCO.hs11hgetter();
				return false;
			});

			$(window).resize(function(){
				BLOKCO.hs11hgetter();
			});
		};
	/* ==================================================
	   SuperFish menu
	================================================== */
		BLOKCO.TinyNav = function() {
			$('.topbar-menu').tinyNav({
				header: '---',
				indent: '- '
			});
		};
	/* ==================================================
	   IsoTope Full Width
	================================================== */
		BLOKCO.IsoTopeFull = function() {
			$('.sort-destination-parent').each(function(){
				var isotopeInstance = $(this); 
				var isotopeLayout = isotopeInstance.attr("data-layout") ? isotopeInstance.attr("data-layout") : "fitRows";
				// init Isotope
				var $grid = $('.sort-destination').isotope({
					itemSelector: '.grid-item',
					originLeft: true,
					layoutMode: isotopeLayout,
				});
				// filter items on button click
				$('.sort-source').on( 'click', 'li', function() {
					var filterValue = $(this).attr('data-option-value');
					$grid.isotope({ filter: filterValue });
				});
			});

			$('.isotope-grid').each(function(){
				var isotopeInstance = $(this); 
				var isotopeLayout = isotopeInstance.attr("data-layout") ? isotopeInstance.attr("data-layout") : "fitRows";
				isotopeInstance.isotope({
					itemSelector: '.grid-item',
					originLeft: true,
					layoutMode: isotopeLayout,
				});
			});
		};
	/* ==================================================
	   Pricing Tables
	================================================== */
		var $tallestCol;
		BLOKCO.pricingTable = function(){
			$('.pricing-table').each(function(){
				$tallestCol = 0;
				$(this).find('> div .features').each(function(){
					($(this).height() > $tallestCol) ? $tallestCol = $(this).height() : $tallestCol = $tallestCol;
				});	
				if($tallestCol === 0){ $tallestCol = 'auto';}
				$(this).find('> div .features').css('height',$tallestCol);
			});
		};
	/* ==================================================
	   Equal Height
	================================================== */
		BLOKCO.equalheight = function(){
			// apply matchHeight to each item container's items
			$('.equal-heighter').each(function() {
				$(this).find('.equal-height-column').matchHeight();
			});
		};
	/* ==================================================
	   Topbar Widgets Opener
	================================================== */
		BLOKCO.Topbarwidgets = function(){
			var TopWidgetsWidth = imi_local.topbar_widgets;
			if(TopWidgetsWidth !== ''){
				var WidgetsWidth = TopWidgetsWidth;
			} else {
				var WidgetsWidth = '400px';
			}
			$('.widgets-at-top-opener').on('click',function(e){
				e.stopPropagation();
				$('body').addClass('topper-opened');
				$('.widgets-at-top').slideToggle();
				e.preventDefault();
			});
			$('.widgets-at-right-opener').on('click',function(e){
				e.stopPropagation();
				$('body').addClass('topper-opened');
				$('.widgets-at-right').animate({
					right: "0"
				},300);
				e.preventDefault();
			});
			$('.widgets-at-left-opener').on('click',function(e){
				e.stopPropagation();
				$('body').addClass('topper-opened');
				$('.widgets-at-left').animate({
					left: "0"
				},300);
				e.preventDefault();
			});
			$(document).on('click',function(){
				$('.widgets-at-right').animate({
					right: "-"+WidgetsWidth
				},300);
				$('.widgets-at-left').animate({
					left: "-"+WidgetsWidth
				},300);
				$('.widgets-at-top').slideUp();
				$('body').removeClass('topper-opened');
			});
			$(".widgets-at-left").on('click',function(e){
				e.stopPropagation();
			});
			$(".widgets-at-right").on('click',function(e){
				e.stopPropagation();
			});
			$(".widgets-at-top").on('click',function(e){
				e.stopPropagation();
			});
		};
	/* ==================================================
	   One Page Menu
	================================================== */
		BLOKCO.OnePageMenu = function(){
			$(".page-template-template-onepage .menu-item").each(function(index, element) {
				var $menu_data_id = $(this).find("a").attr("data-id");
				var $home_url = window.location.href;
				var after_home_url = $home_url.substr(0, $home_url.lastIndexOf("\/") + 1);
				if(typeof $menu_data_id=='undefined') return true;
				if($(this).hasClass("menu-item-type-custom"))
				{

				}
				else
				{
					$(this).find("a").attr("href", after_home_url+"#scroll-"+$menu_data_id);
				}
			});
			/*if(Modernizr.touch && $(window).width() < 991 ) {
				$(".page-template-template-onepage .mobile-menu > div > ul > li > a").click(function(e){
					$(".mobile-menu").slideUp();
					e.preventDefault();
				});
			}*/

			//LOCAL SCROLL
			jQuery('.page-template-template-onepage .sf-menu, .page-template-template-onepage .mobile-menu').localScroll({
				offset: -62
			});

			var sections = jQuery('.page-template-template-onepage .page-section');
			var navigation_links = jQuery('.page-template-template-onepage .sf-menu a, .page-template-template-onepage .mobile-menu a');
			sections.waypoint({
				handler: function(direction) {
					var $home_url = window.location.href;
					var after_home_url = $home_url.substr(0, $home_url.lastIndexOf("\/") + 1);
					var active_section;
					active_section = jQuery(this);
					if (direction === "up"){ active_section = active_section.prev();}
					var active_link = jQuery('.page-template-template-onepage .sf-menu a[href="'+ after_home_url + '#' + active_section.attr("id") + '"]');
					navigation_links.parent('li').removeClass("current-menu-item");
					active_link.parent('li').addClass("current-menu-item").delay(1500);
				},
				offset: 150
			});
		};
	/* ==================================================
	   Google Maps Shortcode
	================================================== */
		BLOKCO.Maps = function(){
			$('.imi-google-maps').each(function(){
				var mapInstance = $(this);
				var address = mapInstance.attr("data-address") ? mapInstance.attr("data-address") : "New York USA";
				var mapzoom = mapInstance.attr("data-mapzoom") ? mapInstance.attr("data-mapzoom") : '8';
				var zoomv = parseInt(mapzoom);
				var info = mapInstance.attr("data-info") ? mapInstance.attr("data-info") : address;
				var infowidth = mapInstance.attr("data-infowidth") ? mapInstance.attr("data-infowidth") : "100px";
				var mapid = mapInstance.attr("data-id") ? mapInstance.attr("data-id") : "imi-map";
				var info_show = mapInstance.attr("data-infoshow") ? mapInstance.attr("data-infoshow") : "click";
				var style = mapInstance.attr("data-style") ? mapInstance.attr("data-style") : "";
				style = $.parseJSON(style);
				var scroll = mapInstance.attr("data-scroll") === 'yes' ? true : false;
				var drag = mapInstance.attr("data-drag") === 'yes' ? true : false;
				var markericon = mapInstance.attr("data-markericon") ? mapInstance.attr("data-markericon") : '';
				var latitude;
				var longitude;
				var geocoder = new google.maps.Geocoder();
				function getGeocode() {
					geocoder.geocode( { 'address': address}, function(results, status) {
						if (status === google.maps.GeocoderStatus.OK) {
							latitude = results[0].geometry.location.lat();
							longitude = results[0].geometry.location.lng(); 
							initGoogleMap();   
						} 
					});
				}
				function initGoogleMap() {
					var styles = style;
					var options = {
						mapTypeControlOptions: {
							mapTypeIds: ['Styled']
						},
						center: new google.maps.LatLng(latitude, longitude),
						zoom: zoomv,
						scrollwheel: scroll,
						navigationControl: false,
						draggable: drag,
						mapTypeControl: false,
						disableDefaultUI: true,	
						mapTypeId: 'Styled',
					};
					var div = document.getElementById(mapid);
					var map = new google.maps.Map(div, options);
					var marker = new google.maps.Marker({
						map:map,
						draggable:false,
						icon: markericon,
						animation: google.maps.Animation.DROP,
						position: new google.maps.LatLng(latitude,longitude)
					});
					var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
					map.mapTypes.set('Styled', styledMapType);

					var infowindow = new google.maps.InfoWindow({
						  content: "<div class='iwContent' style='max-width:"+infowidth+"'>"+info+"</div>"
					});
					google.maps.event.addListener(marker, info_show, function() {
						infowindow.open(map,marker);
					});
					if(info_show === 'always'){
						infowindow.open(map,marker);
					}
				}
				google.maps.event.addDomListener(window, 'load', getGeocode);
			});
		}
	/* ==================================================
	   Round Progress Shortcode
	================================================== */
		BLOKCO.RProgress = function(){
			if(typeof($.fn.knob) !== "undefined") {
				$(".knob").knob({
					width: '100%'
				});
			}
		}
	/* ==================================================
	   Init Functions
	================================================== */
	$(document).ready(function(){
		BLOKCO.megaMenu();
		BLOKCO.scrollFunctions();
		BLOKCO.heroflex();
		BLOKCO.galleryflex();
		BLOKCO.OwlCarousel();
		BLOKCO.Magnific();
		BLOKCO.SuperFish();
		BLOKCO.TinyNav();
		BLOKCO.Counters();
		BLOKCO.pricingTable();
		BLOKCO.OnePageMenu();
		BLOKCO.Topbarwidgets();
		BLOKCO.Maps();
		BLOKCO.RProgress();
		WWHGetter();
		$('select').wrap('<div class="imi-select">');
		function imi_fix_vc_full_width_row(){
			var $elements = jQuery('body.rtl [data-vc-full-width="true"]');
			jQuery.each($elements, function () {
				var $el = jQuery(this);
				$el.css('right', $el.css('left')).css('left', '');
			});
		}

		// Fixes rows in RTL
		jQuery(document).on('vc-full-width-row', function () {
			imi_fix_vc_full_width_row();
		});

		// Run one time because it was not firing in Mac/Firefox and Windows/Edge some times
		imi_fix_vc_full_width_row();
	});

	// DESIGN ELEMENTS //
	

	// Any Button Scroll to section
	$('a.scrollto, .scrollto a').on("click", function(){
		$.scrollTo( this.hash, 800, { easing:'easeOutQuint' });
		return false;
	});

	// Cart & Search option in header
	$(".dd-search .search-module-trigger").on('click',function(e){
		e.stopPropagation();
		$(this).parents(".search-module").find(".search-module-opened").toggle();
		$('.cart-module-opened').hide();
		e.preventDefault();
	});
	$(".dd-search .search-module-opened").on('click',function(e){
		e.stopPropagation();
	});
	$(".cart-module-trigger").on('click',function(e){
		e.stopPropagation();
		$(this).parents(".cart-module").find(".cart-module-opened").toggle();
		$('.search-module-opened').hide();
		e.preventDefault();
	});
	$(".cart-module-opened").on('click',function(e){
		e.stopPropagation();
	});
	$(document).on('click',function(){
		$('.search-module-opened, .cart-module-opened').hide();
	});
	$('.overlay-wrapper-close').on('click',function(){
		$('.overlay-wrapper').fadeOut();
		$('body').removeClass('overlay-wrapper-open');
		$('body').removeClass('fscreen-menu-open');
		return false;
	});
	$('.overlay-search-form .search-module-trigger').on('click', function(){
		setTimeout(function(){$('.overlay-search-form-wrapper input[type="text"]').focus();},500);
		$('.overlay-search-form-wrapper').fadeToggle();
		$('body').addClass('overlay-wrapper-open');
		return false;
	});

	// FITVIDS
	$(".fw-video, .post-media").fitVids();

	$(window).load(function(){
		BLOKCO.IsoTopeFull();
		BLOKCO.equalheight();
	});

	// Window height/Width Getter Classes
	function WWHGetter(){
		var wheighter = $(window).height();
		var wwidth = $(window).width();
		$(".wheighter").css("height",wheighter);
		$(".wwidth").css("width",wwidth);
	}

	//Project Filter Nav
	$('.project-filter-nav li:first-child').addClass('accent-color');
	$('.project-filter-nav li').on('click',function(){
		$('.project-filter-nav li').removeClass('accent-color');
		$(this).addClass('accent-color');
	});
});