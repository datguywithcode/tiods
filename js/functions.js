jQuery(document).ready(function(){
	"use strict";
	
	/* ---------------------------------------------------------------------- */
	/*	Main Banner
	/* ---------------------------------------------------------------------- */
	if(jQuery('.bxslider').length){
		jQuery('.bxslider').bxSlider({
			auto: true,
		});
	}
	
	/* ---------------------------------------------------------------------- */
	/*	SubDropdown
	/* ---------------------------------------------------------------------- */
	jQuery(".sub-dropdown").parent("li").addClass("parentIcon");
	
	/* ---------------------------------------------------------------------- */
	/*	Search Function
	/* ---------------------------------------------------------------------- */
	jQuery('.searchform').hide();
	jQuery("a.search-btn").click(function(){
		jQuery('.searchform').hide();
		jQuery(".searchform").fadeToggle();
	});
	jQuery('html').click(function() {
		jQuery(".searchform").fadeOut();
	});
	jQuery('.kd-search').click(function(event){
		event.stopPropagation();
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Scroll to Top
	/* ---------------------------------------------------------------------- */
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.backtop').fadeIn();
		} else {
			jQuery('.backtop').fadeOut();
		}
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Click to Trigger an Event
	/* ---------------------------------------------------------------------- */
	jQuery('.backtop').click(function(){
		jQuery('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	/* ---------------------------------------------------------------------- */
	/*	Bootstrap Tooltip
	/* ---------------------------------------------------------------------- */
	jQuery('[data-toggle="tooltip"]').tooltip();	
	
	/* ---------------------------------------------------------------------- */
	/*	Owl Carousel
	/* ---------------------------------------------------------------------- */
	if(jQuery('.owl-carousel').length){
		jQuery('.owl-carousel').owlCarousel({
			loop:true,			
			nav:true,
			margin: 30,
			navText: [
				"<i class='fa fa-angle-left'></i>",
				"<i class='fa fa-angle-right'></i>"
			],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:2
				}
			}
		});
	}
	/* ---------------------------------------------------------------------- */
	/*	CountDown
	/* ---------------------------------------------------------------------- */
	if(jQuery('#defaultCountdown').length){
		var austDay = new Date();
		austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
		jQuery('#defaultCountdown').countdown({until: austDay});
		jQuery('#year').text(austDay.getFullYear());
	}
	
	if(jQuery('#defaultCountdown1').length){
		var austDay = new Date();
		austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
		jQuery('#defaultCountdown1').countdown({until: austDay});
		jQuery('#year').text(austDay.getFullYear());
	}
	
	if(jQuery('#defaultCountdown2').length){
		var austDay = new Date();
		austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
		jQuery('#defaultCountdown2').countdown({until: austDay});
		jQuery('#year').text(austDay.getFullYear());
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Google Map
	/* ---------------------------------------------------------------------- */
	if($('#map-canvas').length){
		google.maps.event.addDomListener(window, 'load', initialize);
	}
	
	if($('#map-canvas1').length){
		google.maps.event.addDomListener(window, 'load', initialize_event);
	}
	
	if($('#map-canvas2').length){
		google.maps.event.addDomListener(window, 'load', initialize_event_1);
	}
	
	/* ---------------------------------------------------------------------- */
	/*	For HTML Validation
	/* ---------------------------------------------------------------------- */
	
	$('a[data-rel]').each(function () {
        $(this).attr('rel', $(this).data('rel'));
    });
	
	/* ---------------------------------------------------------------------- */
	/*	Google Map
	/* ---------------------------------------------------------------------- */
	if($('.kf-gallery-pp').length){
		$(".kf-gallery-pp:first a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'normal',
			slideshow: 10000,
			autoplay_slideshow: true
		});
		$(".kf-gallery-pp:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast',
			slideshow: 10000,
			hideflash: true
		});
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */
	
	if($('#contactform').length) {

		var $form = $('#contactform'),
		$loader = '<img src="images/ajax_loading.gif" alt="Loading..." />';
		$form.append('<div class="hidden-me" id="contact_form_responce">');

		var $response = $('#contact_form_responce');
		$response.append('<p></p>');

		$form.submit(function(e){

			$response.find('p').html($loader);

			var data = {
				action: "contact_form_request",
				values: $("#contactform").serialize()
			};

			//send data to server
			$.post("inc/contact-send.php", data, function(response) {

				response = $.parseJSON(response);
				
				$(".incorrect-data").removeClass("incorrect-data");
				$response.find('img').remove();

				if(response.is_errors){

					$response.find('p').removeClass().addClass("error type-2");
					$.each(response.info,function(input_name, input_label) {

						$("[name="+input_name+"]").addClass("incorrect-data");
						$response.find('p').append('Please enter correct "'+input_label+'"!'+ '</br>');
					});

				} else {

					$response.find('p').removeClass().addClass('success type-2');

					if(response.info == 'success'){

						$response.find('p').append('Your email has been sent!');
						$form.find('input:not(input[type="submit"], button), textarea, select').val('').attr( 'checked', false );
						$response.delay(1500).hide(400);
					}

					if(response.info == 'server_fail'){
						$response.find('p').append('Server failed. Send later!');
					}
				}

				// Scroll to bottom of the form to show respond message
				var bottomPosition = $form.offset().top + $form.outerHeight() - $(window).height();

				if($(document).scrollTop() < bottomPosition) {
					$('html, body').animate({
						scrollTop : bottomPosition
					});
				}

				if(!$('#contact_form_responce').css('display') == 'block') {
					$response.show(450);
				}

			});

			e.preventDefault();

		});				

	}
	
	
	if($('.header-2').length){
		// grab the initial top offset of the navigation 
		var stickyNavTop = $('.header-2').offset().top;
		// our function that decides weather the navigation bar should have "fixed" css position or not.
		var stickyNav = function(){
			var scrollTop = $(window).scrollTop(); // our current vertical position from the top
			// if we've scrolled more than the navigation, change its position to fixed to stick to top,
			// otherwise change it back to relative
			if (scrollTop > stickyNavTop) { 
				$('.header-2').addClass('sticky');
			} else {
				$('.header-2').removeClass('sticky'); 
			}
		};
		stickyNav();
		// and run it again every time you scroll
		$(window).scroll(function() {
			stickyNav();
		});
	}

	if($('.header4').length){
		// grab the initial top offset of the navigation 
		var stickyNavTop = 100;
		// our function that decides weather the navigation bar should have "fixed" css position or not.
		var stickyNav = function(){
			var scrollTop = $(window).scrollTop(); // our current vertical position from the top
			// if we've scrolled more than the navigation, change its position to fixed to stick to top,
			// otherwise change it back to relative
			if (scrollTop > stickyNavTop) { 
				$('.header4').addClass('sticky');
			} else {
				$('.header4').removeClass('sticky'); 
			}
		};
		stickyNav();
		// and run it again every time you scroll
		$(window).scroll(function() {
			stickyNav();
		});
	}
	
	if($('.header-2').length){
		$('.header-2').singlePageNav({
			offset: $('.header-2').outerHeight()-30,
			filter: ':not(.external)',
			updateHash: true,
			beforeStart: function() {
				console.log('begin scrolling');
			},
			onComplete: function() {
				console.log('done scrolling');
			}
		});
	}
	/* ---------------------------------------------------------------------- */
	/*	Portfolio Filter Script
	/* ---------------------------------------------------------------------- */
	if($('#portfolio-item-holder').length){
		$(window).load(function() {
			var filter_container = $('#portfolio-item-holder');

			filter_container.children().css('position','absolute');	
			filter_container.masonry({
				singleMode: true,
				itemSelector: '.portfolio-list:not(.hide)',
				animate: true,
				animationOptions:{ duration: 800, queue: false }
			});	
			$(window).resize(function(){
				var temp_width =  filter_container.children().filter(':first').width() + 30;
				filter_container.masonry({
					columnWidth: temp_width,
					singleMode: true,
					itemSelector: '.portfolio-list:not(.hide)',
					animate: true,
					animationOptions:{ duration: 800, queue: false }
				});		
			});	
			$('ul#portfolio-item-filter a').click(function(e){	

				$(this).addClass("active");
				$(this).parents("li").siblings().children("a").removeClass("active");
				e.preventDefault();
				
				var select_filter = $(this).attr('data-value');
				
				if( select_filter == "All" || $(this).parent().index() == 0 ){		
					filter_container.children().each(function(){
						if( $(this).hasClass('hide') ){
							$(this).removeClass('hide');
							$(this).fadeIn();
						}
					});
				}else{
					filter_container.children().not('.' + select_filter).each(function(){
						if( !$(this).hasClass('hide') ){
							$(this).addClass('hide');
							$(this).fadeOut();
						}
					});
					filter_container.children('.' + select_filter).each(function(){
						if( $(this).hasClass('hide') ){
							$(this).removeClass('hide');
							$(this).fadeIn();
						}
					});
				}
				
				filter_container.masonry();	
				
			});
		});
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Accordion Script
	/* ---------------------------------------------------------------------- */
	if($('.accordion').length){
		//custom animation for open/close
		$.fn.slideFadeToggle = function(speed, easing, callback) {
			return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
		};

		$('.accordion').accordion({
			defaultOpen: 'section1',
			cookieName: 'nav',
			speed: 'slow',
			animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
				elem.next().stop(true, true).slideFadeToggle(opts.speed);
			},
			animateClose: function (elem, opts) { //replace the standard slideDown with custom function
				elem.next().stop(true, true).slideFadeToggle(opts.speed);
			}
		});
	}
	
	$("#banner-1 .bx-controls-direction .bx-prev").empty();
	$("#banner-1 .bx-controls-direction .bx-next").empty();
	//$("#banner-1 .bx-controls-direction .bx-next").append('<i class="fa fa-angle-right"></i>');
	//$("#banner-1 .bx-controls-direction .bx-prev").append('<i class="fa fa-angle-left"></i>');
	
	$("#mainbanner .bx-controls-direction .bx-prev").empty();
	$("#mainbanner .bx-controls-direction .bx-next").empty();
	$("#mainbanner .bx-controls-direction .bx-next").append('<i class="fa fa-angle-right"></i>');
	$("#mainbanner .bx-controls-direction .bx-prev").append('<i class="fa fa-angle-left"></i>');
	
});

/* ---------------------------------------------------------------------- */
/*	Google Map Function for Custom Style
/* ---------------------------------------------------------------------- */
function initialize() {
	var MY_MAPTYPE_ID = 'custom_style';
	var map;
	var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);
	var featureOpts = [
		{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}

	];
	var mapOptions = {
		zoom: 12,
		center: brooklyn,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
		},
		mapTypeId: MY_MAPTYPE_ID
	};

	map = new google.maps.Map(
		document.getElementById('map-canvas'),
		mapOptions
	);

	var styledMapOptions = {
		name: 'Custom Style'
	};

	var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}
/* ---------------------------------------------------------------------- */
/*	Google Map Function for Event Style
/* ---------------------------------------------------------------------- */
function initialize_event() {
	var MY_MAPTYPE_ID = 'custom_style';
	var map;
	var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);
	var featureOpts = [
		{
		  stylers: [
			{ hue: '#E24F3D' },
			{ visibility: 'simplified' },
			{ gamma: 0.5 },
			{ weight: 0.5 }
		  ]
		},
		{
		  elementType: 'labels',
		  stylers: [
			{ visibility: 'on' }
		  ]
		},
		{
		  featureType: 'water',
		  stylers: [
			{ color: '#ffffff' }
		  ]
		}
	];
	var mapOptions = {
		zoom: 12,
		center: brooklyn,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
		},
		mapTypeId: MY_MAPTYPE_ID
	};

	map = new google.maps.Map(
		document.getElementById('map-canvas1'),
		mapOptions
	);

	var styledMapOptions = {
		name: 'Custom Style'
	};

	var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}
/* ---------------------------------------------------------------------- */
/*	Google Map Function for Event Style
/* ---------------------------------------------------------------------- */
function initialize_event_1() {
	var MY_MAPTYPE_ID = 'custom_style';
	var map;
	var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);
	var featureOpts = [
		{
		  stylers: [
			{ hue: '#E24F3D' },
			{ visibility: 'simplified' },
			{ gamma: 0.5 },
			{ weight: 0.5 }
		  ]
		},
		{
		  elementType: 'labels',
		  stylers: [
			{ visibility: 'on' }
		  ]
		},
		{
		  featureType: 'water',
		  stylers: [
			{ color: '#ffffff' }
		  ]
		}
	];
	var mapOptions = {
		zoom: 12,
		center: brooklyn,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
		},
		mapTypeId: MY_MAPTYPE_ID
	};

	map = new google.maps.Map(
		document.getElementById('map-canvas2'),
		mapOptions
	);

	var styledMapOptions = {
		name: 'Custom Style'
	};

	var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

	map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}


