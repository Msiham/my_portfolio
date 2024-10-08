( function( $ ) {

	$(window).resize(function(){
		tempus_getHeight();
		tempus_videoWidth();
		tempus_getItemHeight();
		tempus_getFullWidth();
		// tempus_sticky_text();
		tempus_fixed_nav();
		tempus_sliderWidth();
	});

	$(document).ready(function(){
		tempus_getItemHeight();
		tempus_pointySlider();
		tempus_sidebar();
		tempus_imagesLoaded();
		tempus_getHeight();
		tempus_videoWidth();
		tempus_getMasonry();
		tempus_getGalleryMasonry();
		tempus_infinitePortfolio();
		tempus_addFancybox();
		tempus_getFullWidth();
		tempus_nevigationGap();
		tempus_revealerAjax();
		tempus_adaptiveBackground();
		// tempus_sliderWidth();
		tempus_allGallery();
		tempus_preventFlicker();
		tempus_altMenu();
		tempus_wowInit();
		tempus_backToTop();
		tempus_getCaption();
		// tempus_sticky_text();
	});

	$(window).load(function() {
  	tempus_getMasonry();
		tempus_allGallery();
		tempus_fixed_nav();
		// tempus_sticky_text();
		tempus_sliderWidth();
	})

	function tempus_getCaption() {
		$('.wp-caption').each(function() {
			$(this).find('a[data-fancybox="group"]').attr('data-caption', $(this).find('.wp-caption-text').text());
		});
		$('.wp-block-image').each(function() {
			if ($(this).find('.wp-element-caption').text().length > 0) {
				$(this).find('a[data-fancybox="group"]').attr('data-caption', $(this).find('.wp-element-caption').text());
			} else {
				$(this).find('a[data-fancybox="group"]').attr('data-caption', $(this).find('.wp-caption-text').text());
			}
		});
	}

	function tempus_altMenu() {
		if ( $('.nav_container').hasClass('menu-alt') || $(window).width() < 959) {
			$( 'li.menu-item-has-children a' ).on( 'click', function(e) {
				if ($(e.target.parentElement).hasClass('menu-item-has-children') /*&& !$( this ).closest('.menu-item').children('.sub-menu').hasClass( 'opened' )*/) {
					e.preventDefault();
					// $( this ).closest('.nav-menu').find('.sub-menu').removeClass( 'opened' );
					$( this ).closest('.menu-item').children('.sub-menu').toggleClass( 'opened' );
				}
			} );
		}
	}

	function tempus_wowInit() {
		wow = new WOW({
			animateClass: 'animated'
		});
		wow.init();
	}

	function tempus_preventFlicker() {
		var h = $('.titleheight-100').height();
		if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('.titleheight-100').height(h);
		}
		$( window ).on( "orientationchange", function() {
			$('.titleheight-100').height($(this).height());
		});
	}

	function tempus_sliderWidth() {
		$('.fullscreen-slider .owl-stage-outer').each(function() {
			var gallery = $(".owl-stage-outer");
			var galleryItem = $( '.owl-item' );
			var galleryImage = $( '.fullscreen-slider .owl-item img' );
			var galleryShortcodeImage = $( '.shortcode-gallery-full .owl-item img' );
			var galleryShortcodeItem = $( '.shortcode-gallery .owl-item' );
			var galleryRatio;

			// var nVer = navigator.appVersion;
			// var nAgt = navigator.userAgent;
			// var nameOffset,verOffset,ix;

			// if(navigator.platform == 'iPhone' || navigator.platform == 'iPod'){
			// 	if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
			// 	  var mobileSafari = "Safari";
			// 	}
			// }

			if (gallery) {
				// $('body').prepend(window.screen.availHeight + ':' + window.innerHeight);
				// 640 : 570


				if (galleryItem.height() <= $(window).height() ) {
					gallery.css({"height": window.innerHeight})
				} else {
					gallery.css({"height": ""})
				}

				galleryImage.each(function() {
					galleryRatio = $(this).attr( 'data-ratio' );
					if ( window.innerHeight*galleryRatio >= window.innerWidth ) {
						$(this).css({"width": window.screen.availHeight*galleryRatio, "height": window.screen.availHeight, "margin-left": (window.innerWidth - window.screen.availHeight*galleryRatio)/2});
						// if ( mobileSafari == 'Safari' ) {
						// 	$(this).css({"width": window.screen.availHeight*galleryRatio + 60, "height": window.screen.availHeight, "margin-left": ($window.innerWidth - window.screen.availHeight*galleryRatio)/2});
						// }
					} else {
						$(this).css({"width": "", "height": "", "margin-left": ""})
					}
				});

				// if ($(window).width() > 959) {
				// 	$('.fullscreen-slider, .owl-item').css({'height' : $(window).height()});
				// 	// $('.owl-item img').css({'margin-top' : -($(window).width()/galleryRatio - $(window).height())/2});
				// }

				if ($(window).width() < 959) {
					$('.fullscreen-slider').css({'height' : window.innerHeight});
					// $('.owl-item img').css({'margin-top' : ''});
				} else {
					$('.fullscreen-slider').css({'height' : ''});
				}

			}
		});
	}

	function tempus_adaptiveBackground() {
		if ($('body').hasClass('page-template-template-blog-chess')) {
			$.adaptiveBackground.run();
			$('.blog-image').on('ab-color-found', function(ev,payload){
				$(this).parent('.simple-post').find('.post-data').css({ 'background' : payload.color });
			});
		}
	}

	function tempus_nevigationGap() {
		if ($('body').hasClass('page-template-template-portfolio-revealer') && $('#site-navigation').height() > 0 && $(window).width() > 959) {
			$('.revealer-wrapper').css({ 'height' : $(window).height() - $('#site-navigation').outerHeight() });
		} else if ($('body').hasClass('page-template-template-portfolio-revealer') && $(window).width() <= 959) {
			// $('.revealer-wrapper').css({ 'height' : $(window).height() - $('#site-navigation').outerHeight() });
		}

		if ($('body').hasClass('page-template-template-portfolio-pointy-slider') && $('#site-navigation').height() > 0) {
			$('.pointy-slider-wrapper').css({ 'padding-top' : $('#site-navigation').outerHeight() });
		}
	}

	function tempus_fixed_nav() {
		if ( $('body').hasClass("single-post") && $('.project-navigation').length > 0) {
			var $document = $(document);

			setTimeout(function() {
        const title_container = $('.title_container').innerHeight(),
				site_navigation = $('#site-navigation').innerHeight(),
				admin_navigation = $('#wpadminbar').innerHeight(),
				scroll_height = site_navigation + title_container;

				function tempus_getScroll() {
					if ( $document.scrollTop() >= scroll_height && $(window).width() > 959 ) {
						$('.project-navigation').css({"position" : "fixed", "top" : 140, "bottom" : "" });
					} else {
						$('.project-navigation').css({"position" : "absolute", "top" : "", "bottom" : -140 });
					}
				}

				// console.log("admin_navigation: " + admin_navigation);
				// console.log("scroll_height: " + scroll_height);
				// console.log("scrollTop: " + $document.scrollTop());

				$document.scroll(function() {
					tempus_getScroll();
				});

			  tempus_getScroll();

			}, 200);
		}
	}

	function tempus_sticky_text() {
		if ($('.half-container').length > 0 && $(window).width() > 959 && $('.sticky-text').innerHeight() < $('.half-gallery-container').height() ) {

			setTimeout(function(){
				const sticky_text = $('.sticky-text').innerHeight(),
				photo_container = $('.half-gallery-container').height(),
				sticky_text_width = $('.half-text-container').innerWidth(),
				site_navigation = $('#site-navigation').height(),
				scroll_height = site_navigation + sticky_text,
				max_scroll = site_navigation + photo_container - sticky_text,
				$document = $(document);

				/*console.log("sticky_text: " + sticky_text);
				console.log("photo_container: " + photo_container);
				console.log("site_navigation: " + site_navigation);*/

				function tempus_getSticky() {
					if ($(window).width() > 959) {
							$('.sticky-text').css({"position" : "relative", "top" : "", "width" : "" });
						if ( $document.scrollTop() >= site_navigation && $document.scrollTop() < max_scroll ) {
							$('.sticky-text').css({"position" : "fixed", "top" : 0, "width" : sticky_text_width });
						} else if ( $document.scrollTop() < site_navigation ) {
							$('.sticky-text').css({"position" : "relative", "top" : "", "width" : "" });
						} else if ($document.scrollTop() >= max_scroll) {
							$('.sticky-text').css({"position" : "absolute", "top" : max_scroll - site_navigation, "width" : "" });
						}
					} else {
						$('.sticky-text').css({"position" : "relative", "top" : "", "width" : "" });
					}
				}

				tempus_getSticky();

				$document.scroll(function() {
					tempus_getSticky();
				});
			}, 200);
		}

	}

	function tempus_pointySlider() {
		var sliderContainers = $('.pointy-slider-wrapper');

		if( sliderContainers.length > 0 ) initBlockSlider(sliderContainers);

		function initBlockSlider(sliderContainers) {
			sliderContainers.each(function(){
				var sliderContainer = $(this),
					slides = sliderContainer.children('.pointy-slider').children('li'),
					sliderPagination = createSliderPagination(sliderContainer);

				sliderPagination.on('click', function(event){
					event.preventDefault();
					var selected = $(this),
						index = selected.index();
					updateSlider(index, sliderPagination, slides);
				});

				sliderContainer.on('swipeleft', function(){
					var bool = enableSwipe(sliderContainer),
						visibleSlide = sliderContainer.find('.is-visible').last(),
						visibleSlideIndex = visibleSlide.index();
					if(!visibleSlide.is(':last-child') && bool) {updateSlider(visibleSlideIndex + 1, sliderPagination, slides);}
				});

				sliderContainer.on('swiperight', function(){
					var bool = enableSwipe(sliderContainer),
						visibleSlide = sliderContainer.find('.is-visible').last(),
						visibleSlideIndex = visibleSlide.index();
					if(!visibleSlide.is(':first-child') && bool) {updateSlider(visibleSlideIndex - 1, sliderPagination, slides);}
				});

				var CountSlides = 0;
				sliderContainer.children('.pointy-slider').find('li').each(function(index) {
					(function(that, i) {
						CountSlides++;
            var t = setTimeout(function() {
                updateSlider(index, sliderPagination, slides);
            }, 3000 * i);
        	})(this, index);
				});

				var resetToFirst = setTimeout(function() {
						updateSlider(0, sliderPagination, slides);
				}, 3000 * CountSlides);

			});
		}

		function createSliderPagination(container){
			var wrapper = $('<ol class="pointy-slider-navigation"></ol>');
			container.children('.pointy-slider').find('li').each(function(index){
				var dotWrapper = (index == 0) ? $('<li class="selected"></li>') : $('<li></li>'),
					dot = $('<a href="#0"></a>').appendTo(dotWrapper);
				dotWrapper.appendTo(wrapper);
				var dotText = ( index+1 < 10 ) ? '0'+ (index+1) : index+1;
				dot.text(dotText);
			});
			wrapper.appendTo(container);
			return wrapper.children('li');
		}

		function updateSlider(n, navigation, slides) {
			navigation.removeClass('selected').eq(n).addClass('selected');
			slides.eq(n).addClass('is-visible').removeClass('covered').prevAll('li').addClass('is-visible covered').end().nextAll('li').removeClass('is-visible covered');

			navigation.parent('ul').addClass('slider-animating').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$(this).removeClass('slider-animating');
			});
		}

		function enableSwipe(container) {
			return ( container.parents('.touch').length > 0 );
		}
	}

	if ($('body').find("#comment, .wpcf7-textarea")) {
		$('#comment, .wpcf7-textarea').focusout(function() {
			if ($(this).val().trim().length > 0) {
				$(this).css({"height": 200});
			}
		});
	}

	$( '.comments-number' ).on( 'click', function() {
		$( '.comments-inner' ).toggleClass( 'show-comments' );
	} );

	$( '.comments-link' ).on( 'click', function() {
		$( '.comments-inner' ).addClass( 'show-comments' );
	} );

	$( '.menu-dropdown' ).on( 'click', function() {
		$( '.nav-menu, .menu-dropdown, body' ).toggleClass( 'toggled-on' );
	} );

	function tempus_addFancybox() {
		fancyRatio = (typeof fancyRatio !== 'undefined') ? fancyRatio : 16 / 9;
		$('[data-fancybox]').fancybox({
			loop: true,
			animationEffect: "fade",
			preventCaptionOverlap: false,
			infobar: false,
			clickContent : false,
			beforeShow : function() {
	      if ($(this.element).find('.thumb').attr('alt')) {
	        this.title = $(this.element).find('.thumb').attr('alt');
	      }
	      if ($(this.element).find('img').attr('alt')) {
	        this.title = $(this.element).find('img').attr('alt');
	      }
	      if (this.title) {
	        this.title =  this.title;
	      }
	    },
			buttons : [
		// 		"slideShow",
		// "fullScreen",
    // "zoom",
				'close'
			],
			btnTpl: {
				// slideShow:
				// 	'<button data-fancybox-play="" class="fancybox-button fancybox-button--play" title="slideShow">' +
				// 	'</button>',
				// 	fullScreen:
				// 		'<button data-fancybox-fullscreen="" class="fancybox-button fancybox-button--fullscreen" title="fullScreen">' +
				// 		'</button>',
				// zoom : '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}">' +
				// 					'<svg viewBox="0 0 40 40">' +
				// 							'<path d="M 18,17 m-8,0 a 8,8 0 1,0 16,0 a 8,8 0 1,0 -16,0 M25,23 L31,29 L25,23" />' +
				// 					'</svg>' +
				// 			'</button>',
		    close:
					'<button data-fancybox-close="" class="fancybox-button fancybox-button--close" title="Close">' +
					'</button>',



					// fullScreen:
					// 	'<button data-fancybox-fullscreen="" class="fancybox-button fancybox-button--fullscreen" title="Close">' +
					// 	'</button>',

		    arrowLeft:
					'<button data-fancybox-prev="" title="Previous" class="fancybox-arrow fancybox-arrow--left">' +
					'</button>',

		    arrowRight:
					'<button data-fancybox-next="" title="Next" class="fancybox-arrow fancybox-arrow--right">' +
					'</button>',
			},
			helpers:  {
				title:  { type : 'inside' }
			},
			// onUpdate : function( instance, current ) {
			// 	if ($('.fancybox-slide').hasClass('fancybox-slide--video')) {
			//     var width,
			//         height,
			//         // ratio = 16 / 9,
			// 				// fancyRatio = 16 / 9,
			//         video = current.$content;
			//
			//     if ( video ) {
			//       video.hide();
			//
			//       width  = current.$slide.width();
			//       height = current.$slide.height() - 100;
			//
			//       if ( height * fancyRatio > width ) {
			//         height = width / fancyRatio;
			//       } else {
			//         width = height * fancyRatio;
			//       }
			//
			// 			var multiplier = 0.98;
			// 			if ($(window).width() > 959) {
			// 				multiplier = 0.94;
			// 			}
			//
			//       video.css({
			//         width  : width * multiplier,
			//         height : height * multiplier
			//       }).show();
			//
			//     }
			// 	}
		  // }
		});
		$( '.hentry' ).fitVids();
	}

	function tempus_sidebar() {

		$('.sidebar-btn').on('click', function(event){
			event.preventDefault();
			$('.floated-sidebar').addClass('is-visible');
			$('.sidebar-hider').addClass('is-visible');
		});

		$('.search-btn, .search-icon').on('click', function(event){
			event.preventDefault();
			var $search_bar = $('.search-bar');
			$search_bar.addClass('show');
			setTimeout(function(){
        $search_bar.find('.search-input').focus();
      }, 200);
		});

		$('.search-bar').on('click', function(event){
			event.preventDefault();
			if ( $(event.target).is('.search-bar-form') || $(event.target).is('.search-input') ) {
				$('.search-bar').addClass('show');
			} else {
				$('.search-bar').removeClass('show');
			}
		});

		$('.search-input').on("keypress", function(e) {
    	var code = (e.keyCode ? e.keyCode : e.which);
    	if (code == 13) {
        e.preventDefault();
        e.stopPropagation();
        $(this).closest('#searchform').submit();
    	}
  	});

		$('.floated-sidebar').on('click', function(event){
			if ( $(event.target).is('.sidebar-close') ) {
				$('.floated-sidebar').removeClass('is-visible');
				$('.sidebar-hider').removeClass('is-visible');
				event.preventDefault();
			}
		});

		$('.sidebar-hider').on('click', function() {
			$('.floated-sidebar').removeClass('is-visible');
			$('.sidebar-hider').removeClass('is-visible');
		});

		if ($('#wpadminbar').innerHeight() > 0) {
			$('.sidebar-close').css({ "top" : 32});
		}

	}

	function tempus_getFullWidth() {
		if ($(".shortcode-gallery-full, .content-self-container, .content-self-container-full")) {
			if ( $('.content-wrapper').find( ".portfolio-text" ).length ) {
				$(".shortcode-gallery-full, .content-self-container, .content-self-container-full").css({"margin-left": $( '.portfolio-text' ).width()/2-$(window).width()/2, "max-width":"none", "width": $(window).width()})
			} else if ( $('.content-wrapper').find( ".post-description" ).length ) {
				$(".shortcode-gallery-full, .content-self-container, .content-self-container-full").css({"margin-left": $( '.post-description' ).width()/2-$(window).width()/2, "max-width":"none", "width": $(window).width()})
			}
		}
	}

	var $container = $( '#portfolio-wrapper, #shop-wrapper' ),
	$container_gallery = $( '#portfolio-gallery-wrapper' );

	function tempus_getMasonry() {

		var newWidth = '';

		if ($("body").is(".page-template-template-portfolio5col-mixed")) {
			newWidth = '.portfolio_sizer';
		}

		$container.masonry( {
			columnWidth: newWidth,
			itemSelector: '.portfolio-item-slug, .blog-item, .shop-item',
			transitionDuration: 0,
			isAnimated: false
		});
	}

	function tempus_getGalleryMasonry() {
		$container_gallery.masonry( {
			itemSelector: '.portfolio-gallery-item',
			isAnimated: true,
			animationOptions: {
		    duration: 750,
		    easing: 'linear',
		    queue: false
		  }
		});
	}

	function tempus_ChangeUrl(page, url) {
    if (typeof (history.pushState) !== "undefined") {
      var obj = { Page: page, Url: url };
      history.pushState(obj, obj.Page, obj.Url);
    }
  }

	function tempus_revealerAjax() {

		var $container = $( '.revealer-wrapper' ),
		exclude = '', include = '', interval = '',
		perpage = parseInt($( '.revealer-next-projects' ).attr( 'data-perpage' )),
		offset = perpage, i = 0,
		all = parseInt($( '.revealer-next-projects' ).attr( 'data-all' )),
		filter = $( '.revealer-next-projects' ).attr( 'data-filter' );
		var counter = 0;

		// console.log( 'exclude:' + exclude );
		// console.log( 'offset:' + offset );
		// console.log( 'perpage:' + perpage );
		// console.log( 'counter:' + counter );
		// console.log( 'filter:' + filter );

		function tempus_revealerLoaded() {
			$(".revealer-item").each(function() {
				var his = $(this);
	      his.imagesLoaded({ background: true }, function() {
					his.addClass("loaded");
				});
	    });
		}

		function tempus_revealerAnime() {
			var myAnimation = anime({
				targets: '.loader',
				translateX: '101%',
				borderRadius: '100%',
				delay: function(el, index) {
			    return index * 100;
			  },
				duration: 1000,
				easing: 'easeInOutExpo'
			})
		}

		tempus_revealerLoaded();

		$(".revealer-item").imagesLoaded({ background: true }, function() {
			tempus_revealerAnime();
		});

		$( '.revealer-next-projects' ).on('click', function( e ) {
			e.preventDefault();
			var lastClicked = $(this).data( "lastClicked" ) || 0;

			if ( offset > 0 ) {
				$container.find( '.revealer-item' ).each( function() {
					exclude = exclude + $( this ).attr( 'data-id') + ',';
				});
			}

			counter = 0;

			$container.find(".revealer-item").imagesLoaded({ background: true }, function() {
				var myAnimation = anime({
							targets: '.loader',
							translateX: '-1%',
							scale: {
						    value: 2,
						    delay: 150,
						    duration: 850,
						    easing: 'easeInOutExpo',
						  },
							delay: function(el, index) {
						    return index * 80;
						  },
							borderRadius: '1%',
							duration: 1000,
							easing: 'easeInOutExpo'
						})
					});

					if (new Date() - lastClicked >= 1000) {
						$(this).data( "lastClicked", new Date() );
						$( function() {
							if (e.handled !== true) {
								e.handled = true;
								setTimeout(callAjax, 1000);
							}
						});
					}

					function callAjax() {
						$.ajax( {
							type : 'POST',
							url : infinite_url.ajax_url,
							data : {
								action : 'tempus_ajax_revealer',
								security : security,
								filter : filter,
								exclude : exclude,
							},
							success : function( response ) {
								var elem = $( response ).addClass( 'hidden' );
								$container.html( elem );
								elem.removeClass( 'hidden' );

								perpage = parseInt($( '.revealer-column' ).attr( 'data-perpage' ));
								offset = perpage + offset;

								$container.find( '.revealer-item' ).each( function() {
									counter++;
								});

								if ( (offset >= all) || (counter < perpage) ) {
									exclude = ''; offset = 0;
								}

								tempus_revealerLoaded();

								$container.find(".revealer-item").imagesLoaded({ background: true }, function() {
									tempus_revealerAnime();
								});

								// console.log( 'exclude:' + exclude );
								// console.log( 'offset:' + offset );
								// console.log( 'perpage:' + perpage );
								// console.log( 'counter:' + counter );
								// console.log( 'response:' + response );
							},
							error: function(xhr,textStatus,e) {
	                console.log('responseText: ' + xhr.responseText);
	            }
						});
					}
		});

	}

	function tempus_infinitePortfolio() {
		const portfolio_container = $( '#portfolio-wrapper, .tilt-wrapper' );
		// filter,	count, all, columns;
		// perpage = $( '#next-projects' ).data( 'perpage' ),
		// loadtext = $( '#next-projects' ).data( 'load' ),
		// loadingtext = $( '#next-projects' ).data( 'loading' ),
		// offset = perpage;

		// if ( offset >= $( '#next-projects' ).attr( 'data-all' ) ) {
		// 	$( '.load-more' ).addClass( 'hide' );
		// }

		$( '.next-projects' ).each( function() {
			var this_perpage = +$( this ).attr( 'data-perpage' );

			if ( this_perpage >= $( this ).attr( 'data-all' ) ) {
				$( this ).parent().addClass( 'hide' );
			}

		});

		// $('#filter li').click( function( e ) {
		$('.portfolio-filters li').click( function( e ) {

			// if ($( this ).attr( 'data-filter' ) !== $( '#next-projects' ).attr( 'data-filter' )) {
			if ($( this ).attr( 'data-filter' ) !== $( '.next-projects' ).attr( 'data-filter' )) {

				// e.preventDefault();
				e.preventDefault($( this ).attr( 'data-container'));

				const allAttributes = $(this).data();
				// console.log(allAttributes);

				// $( '#ajax-loader' ).fadeIn(100);
				if (typeof allAttributes.container !== 'undefined') {
					$('.loader-id' + allAttributes.container).fadeIn(100);
				} else {
					$( '.ajax-loader' ).fadeIn(100);
				}

				var lastClicked = $(this).data( "lastClicked" ) || 0;
				var $this = $(this), order;

				// var image_size = $( this ).attr( 'data-size');
				// count = $( this ).attr( 'data-count' );
				var offset = 0;
				// var style = $( '#next-projects' ).attr( 'data-style' ),
				// parent_id = $( '#next-projects' ).attr( 'data-parent_id' );
				// filter = $( this ).attr( 'data-filter' );
				// columns = $( '#next-projects' ).attr( 'data-columns');
				// order = $( this ).attr( 'data-order');


				// for (var i in allAttributes) {
				// 	console.log( i + ':' + allAttributes[i] );
				// }

				// console.log(allAttributes.style);


				if (typeof allAttributes.container !== 'undefined') {
					data_container = $('.wrapper-id' + allAttributes.container);
					// style = $( this ).attr( 'data-style' );
					// parent_id = $( this ).attr( 'data-parent_id' );
					// columns = $( this ).attr( 'data-columns');
					// order = $( this ).attr( 'data-order');
					// perpage = $( this ).data( 'perpage' );
				} else {
					data_container = portfolio_container;
					allAttributes.style = $( '#next-projects' ).attr( 'data-style' ),
					allAttributes.parent_id = $( '#next-projects' ).attr( 'data-parent_id' );
					allAttributes.columns = $( '#next-projects' ).attr( 'data-columns');
				}

				if (new Date() - lastClicked >= 1000) {
					$(this).data( "lastClicked", new Date() );
					$( function() {
						if (e.handled !== true) {
							e.handled = true;
							setTimeout( callAjax, 100 );
						}
					});
				}

				// console.log(allAttributes);

				function callAjax() {
					$.ajax( {
						type : 'POST',
						url : infinite_url.ajax_url,
						data : {
							action : 'tempus_ajax_infinite',
							security : security,
							perpage : allAttributes.perpage,
							//offset : offset,
							filter : allAttributes.filter,
							columns : allAttributes.columns,
							style : allAttributes.style,
							parent_id : allAttributes.parent_id,
							image_size : allAttributes.size,
							order : allAttributes.order
						},
						success : function( response ) {
							const elem = $( response ).addClass( 'hidden' );
							// $portfolio_container.html( elem );
							data_container.html( elem );
							tempus_getItemHeight();
							tempus_imagesLoaded();
							if (allAttributes.style) {
								tempus_getHeight();
							}
							// $portfolio_container.masonry( 'prepended', elem );
							data_container.masonry( 'prepended', elem );
							// elem.removeClass( 'hidden' );

							offset = allAttributes.perpage + offset;

							if ( allAttributes.perpage >= allAttributes.count ) {
								$( '.load-more' ).addClass( 'hide' );
							} else {
								$( '.load-more' ).removeClass( 'hide' );
							}

							// $( '#ajax-loader' ).delay(990).fadeOut("slow");

							if (typeof allAttributes.container !== 'undefined') {
								$('.loader-id' + allAttributes.container).delay(590).fadeOut("slow");
							} else {
								$( '.ajax-loader' ).delay(590).fadeOut("slow");
							}

							//console.log( filter );
							$.fancybox.destroy();
							tempus_addFancybox();
						}
					});
				}

				// $( '#next-projects' ).attr( 'data-filter', filter );
				// $( '#next-projects' ).attr( 'data-all', count );
				// $( this ).parent().find( 'a' ).removeClass( 'active' );
				// $( this ).find( 'a' ).addClass( 'active' );

				if (typeof allAttributes.container !== "undefined") {
					$('.next-projects-id' + $( this ).attr( 'data-container')).attr( 'data-filter', allAttributes.filter );
					$('.next-projects-id' + $( this ).attr( 'data-container')).attr( 'data-all', allAttributes.count );
				} else {
					$( '#next-projects' ).attr( 'data-filter', allAttributes.filter );
					$( '#next-projects' ).attr( 'data-all', allAttributes.count );
				}
				$( this ).parent().find( 'span' ).removeClass( 'active' );
				$( this ).find( 'span' ).addClass( 'active' );
			}

		} );

		// $( '#next-projects' ).click( function( e ) {
		$( '.next-projects' ).click( function( e ) {

			// e.preventDefault();
			// var exclude = '',
			// style = $( this ).attr( 'data-style' );
			// var lastClicked = $(this).data( "lastClicked" ) || 0;
			// all = $( this ).attr( 'data-all' );
			// filter = $( this ).attr( 'data-filter' );
			// columns = $( '#next-projects' ).attr( 'data-columns');
			// $portfolio_container.find( '.portfolio-item-slug, .tilt-item' ).each( function() {
			// 	exclude = exclude + $( this ).attr( 'data-id') + ',';
			// });
			//
			// $( '.loadmore-img' ).fadeIn();

			e.preventDefault();

			const allAttributes = $(this).data();

			var exclude = [], counter = 0, offset = 0,
			$this = $(this);
			// style = $( this ).attr( 'data-style' ), order,
			// parent_id = $( this ).attr( 'data-parent_id' );
			var lastClicked = $(this).data( "lastClicked" ) || 0;
			// all = $( this ).attr( 'data-all' );
			// filter = $( this ).attr( 'data-filter' );
			// columns = $( this ).attr( 'data-columns');
			// image_size = $( this ).attr( 'data-size');
			// order = $( this ).attr( 'data-order');
			// perpage = $( this ).data( 'perpage' );
			// offset = perpage;

			// if ( offset >= $( this ).attr( 'data-all' ) ) {
			// 	$( '.load-more' ).addClass( 'hide' );
			// }

			if (typeof allAttributes.container !== 'undefined') {
				data_container = $('.wrapper-id' + allAttributes.container);
			} else {
				data_container = portfolio_container;
			}

			// data_container.find( '.portfolio-item-slug' ).each( function() {
			// 	exclude = exclude + $( this ).attr( 'data-id') + ',';
			// 	counter++;
			// });

			data_container.find('.portfolio-item-slug').map(function() {
				exclude.push($( this ).attr( 'data-id'));
				counter++;
			});

			offset = counter;
			// console.log( exclude + ":" +  counter);

			$(this).find( '.loadmore-img' ).fadeIn();

			if (new Date() - lastClicked >= 1000) {
				$(this).data( "lastClicked", new Date() );
				$( function() {
					if (e.handled !== true) {
						e.handled = true;
						setTimeout(callAjax, 100);
					}
				});
			}

			function callAjax() {
				$.ajax( {
					type : 'POST',
					url : infinite_url.ajax_url,
					data : {
						action : 'tempus_ajax_infinite',
						security : security,
						perpage : allAttributes.perpage,
						//offset : offset,
						filter : allAttributes.filter,
						columns : allAttributes.columns,
						exclude : exclude.join(),
						style : allAttributes.style,
						parent_id : allAttributes.parent_id,
						image_size : allAttributes.size,
						order : allAttributes.order
					},
					success : function( response ) {
						// var elem = $( response ).addClass( 'hidden' );
						const elem = $( response );
						// $portfolio_container.append( elem );
						data_container.append( elem );
						// elem.removeClass( 'hidden' );

						if (allAttributes.columns != 'portfolio-tilt') {

							tempus_getItemHeight();
							tempus_imagesLoaded();
							if (allAttributes.style) { tempus_getHeight(); }
							// $portfolio_container.masonry( 'appended', elem );
							data_container.masonry( 'appended', elem, true );

						} else {

							tempus_tilt_init();

						}

						//tempus_imagesLoaded();

						//tempus_pfAnimation();

						offset = allAttributes.perpage + offset;

						if ( offset >= allAttributes.all ) {
							if (typeof allAttributes.container !== 'undefined') {
								// $( '.load-more' ).addClass( 'hide' );
								$this.parent().addClass( 'hide' );
							} else {
								$( '.load-more' ).addClass( 'hide' );
							}
						}
						$( '.loadmore-img' ).fadeOut();
						$.fancybox.destroy();
						tempus_addFancybox();
						//$( '#next-projects' ).text( loadtext ).fadeIn();
						//console.log( columns );
					}
				});
			}

		});
	}

	function tempus_tilt_init() {
		var tiltSettings = [
		{},
		{
			movement: {
				imgWrapper : {
					translation : {x: 10, y: 10, z: 30},
					rotation : {x: 0, y: -10, z: 0},
					reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
				},
				lines : {
					translation : {x: 10, y: 10, z: [0,70]},
					rotation : {x: 0, y: 0, z: -2},
					reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
				},
				caption : {
					rotation : {x: 0, y: 0, z: 2},
					reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
				},
				overlay : {
					translation : {x: 10, y: -10, z: 0},
					rotation : {x: 0, y: 0, z: 2},
					reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
				},
				shine : {
					translation : {x: 100, y: 100, z: 0},
					reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
				}
			}
		}];
		var idx = 0;
		[].slice.call(document.querySelectorAll('a.tilt-item')).forEach(function(el, pos) {
			idx = pos%2 === 0 ? idx+1 : idx;
			new TiltFx(el, tiltSettings[0]);
		});
	}

	function tempus_imagesLoaded() {
    $(".portfolio-item-slug, .tilt-item").imagesLoaded({ background: ".thumb, .tilt-image" }).progress(function(instance, image) {
			//var result = image.isLoaded ? 'loaded' : 'broken';
			$(image.element).parents('.portfolio-item-slug, .tilt-item').addClass("loaded");
    	//console.log( image.img.src );
      //return $(".portfolio-item, .tilt-item").addClass("loaded");
    });
	}

 /* Images alignment */

	function tempus_getItemHeight() { var newPadding;
		if ($("div").is("#portfolio-wrapper") ) {
			if (typeof (customPadding) !== "undefined") {
				newPadding = customPadding;
			} else {
				newPadding = 10;
			}

			$('.portfolio-item-slug:not(.masonry-item)').each(function() {
				var $this = $(this);
			  if ($this.hasClass('size-2x1')) {
					$(this).css({"height": Math.floor(($(this).width() - newPadding * 2)/2)})
				} else if ($this.hasClass('size-1x2')) {
					$(this).css({"height": Math.floor($(this).width() * 2 + newPadding * 2)})
				} else {
					$(this).css({"height": $(this).width()})
				}
			})
		}
	}

	function tempus_addFullWidth() {
		if ($(window).width() > 959) {
			$(".related-posts").css({"margin-left": "-10px", "max-width":"none", "width": $(".related-posts").width() + 20})
		} else {
			$(".related-posts").css({"margin-left": "0", "width" : "auto" });
		}
	}

	function tempus_videoWidth() {
		$('.selfhosted-video').each(function() {
			const video = $(".selfhosted-video");
			const videoContainer = $( '.self_container' );
			const classicContainer = $( '.blog-classic-container' );
			if (video || classicContainer) {
				if (videoContainer.width()/video.data( 'video-ratio' ) <= videoContainer.height() ) {
					$(this).css({"width": videoContainer.height()*video.data( 'video-ratio' ), "height": videoContainer.height(), "margin-left":(videoContainer.width()-videoContainer.height()*video.data( 'video-ratio' ))/2})
				} else {
					$(this).css({"width": "", "height": "", "margin-left": ""})
				}
			}
		});
	}

	function tempus_getHeight() {
		$('.masonry-item').each( function() {
			 const ratio = ($('.convert-conditions') && $('.convert-conditions').attr('data-aspectratio') && $('.convert-conditions').attr('data-aspectratio') != 'default') ? $('.convert-conditions').attr('data-aspectratio') : $( this ).find( '.thumb' ).attr( 'data-ratio' );
			 const img_width = $( this ).width();

			 if ( ratio > 1 ) {
				 var div_height = img_width / ratio;
			 } else {
				 var div_height = img_width / ratio;
			 }

			//  $( this ).find( '.masonry-thumb' ).css( { 'height': Math.floor( div_height ) } );
			 $( this ).css( { 'height': Math.floor( div_height ) } );
		 } );
	}

 /* Gallery */
	function tempus_allGallery() {
		const carouselAutoplay = ($(".owl-carousel").hasClass('owl-autoplay')) ? true : false,
		carouselAnimate = ($(".owl-carousel").hasClass('owl-autoplay')) ? 'fadeOut' : false;
		$(".owl-carousel").owlCarousel({
			autoplay:carouselAutoplay,
			animateOut: carouselAnimate,
			items:1,
			lazyLoad:true,
			nav:true,
			pagination:true,
			loop:true,
			rewind:true,
			dots:true,
			navSpeed:800,
			// autoplayTimeout:8000
		});

		$('.justified-gallery').justifiedGallery({
			rowHeight : 200,
			maxRowHeight : 400,
			lastRow : 'justify',
			margins : 3,
			captions : false
		});
	}


	/* Back to top */

	function tempus_backToTop() {
		// browser window scroll (in pixels) after which the "back to top" link is shown
		const offset = 300, offset_next = 100,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 100,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.to-top');
		//$next_prev = $('.project-navigation');

		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');

			/*( $(this).scrollTop() > offset ) ? $('.sidebar-btn').addClass('cd-is-visible') : $('.sidebar-btn').removeClass('cd-is-visible');*/

			if( $(this).scrollTop() > offset_opacity ) {
				$back_to_top.addClass('cd-fade-out');
			}
		});

		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
		});

	}

} )( jQuery );
