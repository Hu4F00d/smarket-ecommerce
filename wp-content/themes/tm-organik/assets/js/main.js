/*
 * Script for our theme
 * Written By: Insight
 * */

// define insight
'use strict';

window.insight = {};

jQuery( document ).ready( function( $ ) {
	// Centered logo
	jQuery( 'header.header-01 #branding_logo' ).wrap( '<li id="branding_logo_li" class="menu-item"></li>' );
	var menuNum = jQuery( 'header.header-01 nav > ul > li' ).length;
	var menuCenter = parseInt( Math.round( menuNum / 2 ), 10 );
	var menuCenterStr = 'header.header-01 nav > ul > li:nth-child(' + menuCenter + ')';
	jQuery( '#branding_logo_li' ).insertAfter( jQuery( menuCenterStr ) );
	if ( jQuery( 'li.top-search-btn' ).length > 0 ) {
		jQuery( 'header.header-01 nav > ul' ).append( jQuery( 'li.top-search-btn' ) );
	}

	// Scroll to top
	jQuery( '#backtotop' ).on( 'click', function( evt ) {
		$( 'html, body' ).animate( {scrollTop: 0}, 600 );
		evt.preventDefault();
	} );

	// Search
	var topSearch = $( '.top-search' );
	jQuery( '.top-search-btn' ).on( 'click', function() {
		if ( ! topSearch.hasClass( 'open' ) ) {
			topSearch.addClass( 'open' );
			topSearch.slideDown();
			jQuery( '.top-search-input' ).focus();
		} else {
			topSearch.slideUp();
			topSearch.removeClass( 'open' );
		}
	} );
	jQuery( document ).on( 'click', function( e ) {
		if ( (
			     jQuery( e.target ).closest( topSearch ).length == 0
		     ) && (
			     jQuery( e.target ).closest( '.top-search-btn' ).length == 0
		     ) ) {
			if ( topSearch.hasClass( 'open' ) ) {
				topSearch.slideUp();
				topSearch.removeClass( 'open' );
			}
		}
	} );

	// Mini-cart
	cartTopDistance();
	var miniCart = jQuery( '.mini-cart-wrap' );
	miniCart.on( 'click', function( e ) {
		jQuery( this ).addClass( 'open' );
		cartTopDistance();
	} );
	jQuery( document ).on( 'click', function( e ) {
		if ( jQuery( e.target ).closest( miniCart ).length == 0 ) {
			miniCart.removeClass( 'open' );
		}
	} );

	// Add to cart notification
	jQuery( 'a.add_to_cart_button' ).on( 'click', function() {
		jQuery( 'a.add_to_cart_button' ).removeClass( 'recent-added' );
		jQuery( this ).addClass( 'recent-added' );
	} );
	jQuery( 'body' ).on( 'added_to_cart', function() {
		var productName = jQuery( '.recent-added' ).attr( 'data-product_name' );
		if ( jsVars.noticeAddedCartText != undefined ) {
			if ( productName != undefined ) {
				jQuery.growl.notice( {
					location: 'br',
					title: '',
					message: productName + ' ' + jsVars.noticeAddedCartText.toLowerCase() + ' <a href="' + jsVars.noticeCartUrl + '">' + jsVars.noticeCartText + '</a>'
				} );
			} else {
				jQuery.growl.notice( {location: 'br', fixed: true, title: '', message: jsVars.noticeAddedCartText} );
			}
		}
	} );

	// Added to wishlist notification
	jQuery( 'body' ).on( 'added_to_wishlist', function() {
		jQuery.growl.notice( {location: 'br', title: '', message: jsVars.noticeAddedWishlistText} );
	} );

	// Lightgallery for shop
	jQuery( 'body.single-product .images' ).lightGallery( {
		selector: 'a',
		thumbnail: true,
		animateThumb: false,
		showThumbByDefault: false
	} );

	// Cookie notice
	var tmOrganikCookieOk = insightGetCookie( 'tm_organik_cookie_ok' );
	if ( (
		     jsVars.noticeCookieEnable == 1
	     ) && (
		     tmOrganikCookieOk != 'true'
	     ) ) {
		if ( jsVars.noticeCookie != '' ) {
			jQuery.growl( {
				location: 'br',
				fixed: true,
				duration: 3600000,
				title: '',
				message: jsVars.noticeCookie
			} );
			jQuery( '.cookie_notice_ok' ).on( 'click', function() {
				jQuery( this ).parent().parent().find( '.growl-close' ).trigger( 'click' );
				insightSetCookie( 'tm_organik_cookie_ok', 'true', 365 );
				jQuery.growl.notice( {location: 'br', title: '', message: jsVars.noticeCookieOk} );
			} );
		}
	}

	// Popup
	if ( jsVars.popupEnable == 1 ) {
		var popupCtime = Math.floor( Date.now() / 1000 );
		var popupLtime = insightGetCookie( 'tm_organik_popup' );
		if ( popupLtime == '' ) {
			popupLtime = popupCtime;
			setTimeout( function() {
				jQuery( '#woo_popup_btn' ).trigger( 'click' );
				insightSetCookie( 'tm_organik_popup', popupCtime, 365 );
			}, 3000 );
		}
		var popupTime = popupCtime - popupLtime;
		if ( popupTime > jsVars.popupReOpen * 60 ) {
			setTimeout( function() {
				jQuery( '#woo_popup_btn' ).trigger( 'click' );
				insightSetCookie( 'tm_organik_popup', popupCtime, 365 );
			}, 3000 );
		}
	}

	// Woocommerce view switch
	if ( insightGetCookie( 'tm_organik_shop_view' ) != '' ) {
		var shopView = insightGetCookie( 'tm_organik_shop_view' );
	} else {
		var shopView = 'grid';
	}
	shopViewSwitcher( shopView );
	jQuery( '.switch-view .switcher' ).on( 'click', function() {
		var view = jQuery( this ).attr( 'rel' );
		insightSetCookie( 'tm_organik_shop_view', view, 365 );
		shopViewSwitcher( view );
	} );

	// Woocommerce up-sells slick
	jQuery( '.upsells .products' ).slick( {
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		dots: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	} );

	// Woocommerce recent viewed slick
	jQuery( '.viewed .products' ).slick( {
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		dots: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	} );

	// Woocommerce related slick
	jQuery( '.related .products' ).slick( {
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		dots: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	} );

	// Woocommerce thumbnails slick
	jQuery( '.images .thumbnails' ).slick( {
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	} );

	// Woocommerce qty minus
	jQuery( '.qty-minus' ).live( 'click', function() {
		var qtyMin = 0;
		var step = 1;
		var qtyInput = jQuery( this ).parent().find( '.qty' );
		var qty = Number( qtyInput.val() );
		if ( jQuery( this ).attr( 'data-min' ) != '' ) {
			qtyMin = Number( jQuery( this ).attr( 'data-min' ) );
		}
		if ( qtyInput.attr( 'step' ) != '' ) {
			step = Number( qtyInput.attr( 'step' ) );
		}
		var qtyStep = qtyMin + step;
		if ( qty >= qtyStep ) {
			qtyInput.val( qty - step );
		}
		jQuery( '.qty' ).trigger( 'change' );
	} );

	// Woocommerce qty plus
	jQuery( '.qty-plus' ).live( 'click', function() {
		var qtyMax = 1000;
		var step = 1;
		var qtyInput = jQuery( this ).parent().find( '.qty' );
		var qty = Number( qtyInput.val() );
		if ( jQuery( this ).attr( 'data-max' ) != '' ) {
			qtyMax = Number( jQuery( this ).attr( 'data-max' ) );
		}
		if ( qtyInput.attr( 'step' ) != '' ) {
			step = Number( qtyInput.attr( 'step' ) );
		}
		var qtyStep = qty + step;
		if ( qtyMax >= qtyStep ) {
			qtyInput.val( qtyStep );
		}
		jQuery( '.qty' ).trigger( 'change' );
	} );

	// Woocommerce wishlist
	jQuery( '.add_to_wishlist' ).on( 'click', function() {
		jQuery( this ).addClass( 'loading' );
	} );

	// Woocommerce compare
	jQuery( '.yith-compare-btn a.compare' ).on( 'click', function() {
		jQuery( this ).addClass( 'loading' );
	} );

	// Woocommerce categories count
	jQuery( '.product-categories .count' ).each( function() {
		var thisCount = jQuery( this ).html();
		jQuery( this ).html( thisCount.replace( '(', '' ).replace( ')', '' ) );
	} );

	// Woocommerce quick view
	function get_key( array, key, value ) {
		for ( var i = 0; i < array.length; i ++ ) {
			if ( array[i][key] === value ) {
				return i;
			}
		}
		return - 1;
	}

	var products = [],
		idArr = [];
	jQuery( '.quickview-btn' ).each( function() {
		var pid = jQuery( this ).attr( 'data-pid' );
		var pnonce = jQuery( this ).attr( 'data-pnonce' );
		if ( - 1 === jQuery.inArray( pid, idArr ) ) {
			idArr.push( pid );
			products.push( {src: jsVars.ajaxUrl + '?pid=' + pid + '&pnonce=' + pnonce} );
		}
	} );
	jQuery( '.quickview-btn' ).on( 'click', function( e ) {
		e.preventDefault();
		var pid = jQuery( this ).attr( 'data-pid' );
		var pnonce = jQuery( this ).attr( 'data-pnonce' );
		var index = get_key( products, 'src', jsVars.ajaxUrl + '?pid=' + pid + '&pnonce=' + pnonce );
		jQuery.magnificPopup.open( {
			items: products,
			type: 'ajax',
			removalDelay: 500,
			mainClass: 'mfp-fade',
			gallery: {
				enabled: true,
			},
			ajax: {
				settings: {
					type: 'GET',
					data: {
						action: 'woo_quickview'
					}
				}
			},
			callbacks: {
				ajaxContentAdded: function() {
					$( '.quickview-carousel' ).slick( {infinite: false} );
				}
			}
		}, index );
	} );
} );

// On resize
jQuery( window ).on( 'resize', function( $ ) {
	cartTopDistance();
} );

// On scroll
jQuery( window ).on( 'scroll', function( $ ) {
	cartTopDistance();
} );

function cartTopDistance() {
	var headerHeight = jQuery( '.header' ).height();
	jQuery( '.widget_shopping_cart_content' ).css( 'top', headerHeight + 'px' );
}

function shopViewSwitcher( view ) {
	var col = jQuery( '#switch-view-grid' ).attr( 'data-col' );
	jQuery( '.switch-view .switcher' ).each( function() {
		jQuery( this ).removeClass( 'active' );
	} );
	if ( view == 'list' ) {
		jQuery( '#switch-view-list' ).addClass( 'active' );
		if ( ! jQuery( 'body.archive .products' ).hasClass( 'list' ) ) {
			jQuery( 'body.archive .products' ).removeClass( 'grid' ).addClass( 'list' );
			jQuery( 'body.archive .products' ).removeClass( 'row' );
			jQuery( 'body.archive .products .loop-product' ).each( function() {
				jQuery( this ).removeClass( col );
				jQuery( this ).addClass( 'row' );
				jQuery( this ).find( '.product-thumb' ).wrap( '<div class="col-md-4"></div>' );
				jQuery( this ).find( '.product-info' ).wrap( '<div class="col-md-8"></div>' );
			} );
		}
	} else {
		jQuery( '#switch-view-grid' ).addClass( 'active' );
		if ( jQuery( 'body.archive .products' ).hasClass( 'list' ) ) {
			jQuery( 'body.archive .products' ).removeClass( 'list' ).addClass( 'grid' );
			jQuery( 'body.archive .products' ).addClass( 'row' );
			jQuery( 'body.archive .products .loop-product' ).each( function() {
				jQuery( this ).removeClass( 'row' );
				jQuery( this ).find( '.product-thumb' ).unwrap();
				jQuery( this ).find( '.product-info' ).unwrap();
				jQuery( this ).addClass( col );
			} );
		}
	}
}

function insightSetCookie( cname, cvalue, exdays ) {
	var d = new Date();
	d.setTime( d.getTime() + (
			exdays * 24 * 60 * 60 * 1000
		) );
	var expires = 'expires=' + d.toUTCString();
	document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/';
}

function insightGetCookie( cname ) {
	var name = cname + '=';
	var ca = document.cookie.split( ';' );
	for ( var i = 0; i < ca.length; i ++ ) {
		var c = ca[i];
		while ( c.charAt( 0 ) == ' ' ) {
			c = c.substring( 1 );
		}
		if ( c.indexOf( name ) == 0 ) {
			return c.substring( name.length, c.length );
		}
	}
	return '';
}

function insightMarkProductViewed( pid ) {
	if ( insightGetCookie( 'tm_organik_viewed_products' ) != '' ) {
		var viewed = insightGetCookie( 'tm_organik_viewed_products' ).split( ',' );
		for ( var i = 0; i < viewed.length; i ++ ) {
			while ( viewed[i] == pid ) {
				viewed.splice( i, 1 );
			}
		}
		viewed.unshift( pid );
		var viewedStr = viewed.join();
		insightSetCookie( 'tm_organik_viewed_products', viewedStr, 7 );
	} else {
		insightSetCookie( 'tm_organik_viewed_products', pid, 7 );
	}
}

// Carousel
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			Carousel: {

				init: function() {
					this.build();
					return this;
				},

				build: function() {
					$( '.insight-carousel' ).slick( {
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 3,
									slidesToScroll: 3,
									infinite: true,
									dots: true
								}
							}, {
								breakpoint: 800,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2
								}
							}, {
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							}
						],
						infinite: true,
						draggable: true,
					} );

					// Slider filter
					var $optionSetsPf = $( '.insight-filter' ),
						$optionLinksPf = $optionSetsPf.find( 'a' );
					$optionLinksPf.click( function() {
						var $this = $( this );
						// don't proceed if already selected
						if ( $this.hasClass( 'active' ) ) {
							return false;
						}
						var $optionSet = $this.parents( '.insight-filter' );
						$optionSet.find( '.active' ).removeClass( 'active' );
						$this.addClass( 'active' );
						// make option object dynamically, i.e. { filter: '.my-filter-class' }
						var options = {},
							key = $optionSet.attr( 'data-option-key' ),
							value = $this.attr( 'data-option-value' );

						// parse 'false' as false boolean
						value = value === 'false' ? false : value;

						$( this ).closest( '.insight-product-carousel' ).find( '.products' ).slick( 'slickFilter', value );

						return false;
					} );
					$( '.insight-product-carousel .products' ).slick( {
						infinite: false,
						slidesToShow: 3,
						slidesToScroll: 3,
						nextArrow: '<span class="carousel-next ion-ios-arrow-right"></span>',
						prevArrow: '<span class="carousel-prev ion-ios-arrow-left"></span>',
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: 3,
									slidesToScroll: 3,
								}
							}, {
								breakpoint: 800,
								settings: {
									slidesToShow: 2,
									slidesToScroll: 2
								}
							}, {
								breakpoint: 480,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1
								}
							}
						],
						draggable: true,
					} );

				},

			}
		} );
	}
).apply( this, [window.insight, jQuery] );

// Menu mobile
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			MenuMobile: {

				init: function() {
					this.build();
					return this;
				},

				build: function() {
					if ( $( '#open-left' ).length > 0 ) {
						var slideout = new Slideout( {
							'panel': document.getElementById( 'page' ),
							'menu': document.getElementById( 'menu-slideout' ),
							'padding': 256,
							'tolerance': 70,
							'touch': false,
						} );
					}
					// Toggle button
					if ( $( '#open-left' ).length > 0 ) {
						document.querySelector( '#open-left' ).addEventListener( 'click', function() {
							slideout.toggle();
						} );
						$( '#page' ).on( 'click', function( e ) {
							if ( $( e.target ).closest( '#open-left' ).length === 0 ) {
								if ( slideout._opened ) {
									e.preventDefault();
								}
								slideout.close();
							}
						} );
					}

					//show submenu
					var $menu = $( '.mobile-menu' );

					$menu.find( '.sub-menu-toggle' ).on( 'click', function( e ) {
						var subMenu = $( this ).next();

						if ( subMenu.css( 'display' ) == 'block' ) {
							subMenu.css( 'display', 'block' ).slideUp().parent().removeClass( 'expand' );
						} else {
							subMenu.css( 'display', 'none' ).slideDown().parent().addClass( 'expand' );
						}
						e.stopPropagation();
					} );
				},
			}
		} );
	}
).apply( this, [window.insight, jQuery] );

// About shortcode
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			AboutShortcode: {

				init: function() {
					this.build();
					return this;
				},

				build: function() {
					$( '.insight-about--carousel' ).slick( {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 1,
						autoplay: true,
						nextArrow: '<span class="about-next ion-ios-arrow-thin-right"></span>',
					} );
					$( '.insight-about--carousel .slick-track' ).lightGallery( {
						thumbnail: true,
						animateThumb: false,
						showThumbByDefault: false
					} );
				},

			}
		} );
	}
).apply( this, [window.insight, jQuery] );

// Masonry Blog
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			MasonryBlog: {

				init: function() {
					this.build();
					return this;
				},

				build: function() {
					var $masonry = $( '.blog-grid' );
					$masonry.isotope( {
						itemSelector: '.post',
						percentPosition: true,
					} ).imagesLoaded().progress( function() {
						$masonry.isotope( 'layout' );
					} );
				},

			}
		} );
	}
).apply( this, [window.insight, jQuery] );

// GalleryLight
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			GalleryLight: {

				init: function() {
					this.build();
					this.filter();
					return this;
				},

				build: function() {
					$( '.insight-gallery-images' ).lightGallery( {
						selector: 'a',
						thumbnail: true,
						animateThumb: false,
						showThumbByDefault: false
					} );
				},

				filter: function() {
					var tmGalleryGrid = $( '.insight-gallery .insight-gallery-images' );
					var bh = tmGalleryGrid.find( '.base-item .insight-gallery-image' ).height();
					var mrgBottom = 30;

					$( window ).resize( function() {
						var tmGalleryGrid = $( '.insight-gallery .insight-gallery-images' );
						var bh = tmGalleryGrid.find( '.base-item .insight-gallery-image' ).height();
						var mrgBottom = 30;
						tmGalleryGrid.find( '.x2' ).height( bh * 2 + mrgBottom );
						tmGalleryGrid.find( '.w-x2' ).height( bh );
					} );

					tmGalleryGrid.isotope( {
						itemSelector: '.insight-gallery-item',
						transitionDuration: '0.4s'
					} ).imagesLoaded().progress( function() {
						tmGalleryGrid.find( '.x2' ).height( bh * 2 + mrgBottom );
						tmGalleryGrid.find( '.w-x2' ).height( bh );
						tmGalleryGrid.isotope( 'layout' );
					} );


					var $optionSets = $( '.insight-gallery-filter ul' ),
						$optionLinks = $optionSets.find( 'a' );
					$optionLinks.click( function() {
						var $this = $( this );
						// don't proceed if already selected
						if ( $this.hasClass( 'active' ) ) {
							return false;
						}
						var $optionSet = $this.parents( '.insight-gallery-filter ul' );
						$optionSet.find( '.active' ).removeClass( 'active' );
						$this.addClass( 'active' );
						// make option object dynamically, i.e. { filter: '.my-filter-class' }
						var options = {},
							key = $optionSet.attr( 'data-option-key' ),
							value = $this.attr( 'data-option-value' );

						// parse 'false' as false boolean
						value = value === 'false' ? false : value;
						options[key] = value;
						if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
							changeLayoutMode( $this, options );
						} else {
							// otherwise, apply new options
							$this.closest( '.insight-gallery' ).find( '.insight-gallery-images' ).isotope( options );
						}
						return false;
					} );
				},

			}
		} );
	}
).apply( this, [window.insight, jQuery] );

// ProductGridFilter filter
(
	function( insight, $ ) {
		insight = insight || {};
		$.extend( insight, {

			ProductGridFilter: {

				init: function() {
					this.build();
					this.loadmore();
					return this;
				},

				build: function() {

					var tmProductGrid = $( '.insight-product-grid .products' );
					tmProductGrid.isotope( {
						itemSelector: '.product',
						transitionDuration: '0.4s'
					} ).imagesLoaded().progress( function() {
						tmProductGrid.isotope( 'layout' );
					} );

					var $optionSets = $( '.insight-grid-filter ul' ),
						$optionLinks = $optionSets.find( 'a' );
					$optionLinks.click( function() {
						var $this = $( this );
						// don't proceed if already selected
						if ( $this.hasClass( 'active' ) ) {
							return false;
						}
						var $optionSet = $this.parents( '.insight-grid-filter ul' );
						$optionSet.find( '.active' ).removeClass( 'active' );
						$this.addClass( 'active' );
						// make option object dynamically, i.e. { filter: '.my-filter-class' }
						var options = {},
							key = $optionSet.attr( 'data-option-key' ),
							value = $this.attr( 'data-option-value' );

						// parse 'false' as false boolean
						value = value === 'false' ? false : value;
						options[key] = value;
						if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
							changeLayoutMode( $this, options );
						} else {
							// otherwise, apply new options
							$this.closest( '.insight-product-grid' ).find( '.products' ).isotope( options );
						}
						return false;
					} );
				},

				loadmore: function() {
					$( '.btn-loadmore' ).on( 'click', function() {
						var box_container = $( this ).data( 'box-container' );
						var box_container_el = $( '.insight-product-grid ' + $( this ).data( 'box-container' ) + ' .products' );
						var page = '=' + $( this ).data( 'next-page' );
						var max_pages = '=' + $( this ).data( 'max-pages' );

						if ( page == 0 ) {
							$( this ).parent().css( {display: 'none'} );
							return;
						}

						$( this ).data( 'next-page', (
							page + 1
						) );
						var $thiss = $( this );

						$( this ).addClass( 'btn-transparent' ).html( '<div class="loading loader-inner ball-pulse"><div></div><div></div><div></div></div>' );
						$.get( $( this ).data( 'url' ) + page, function( html ) {
							var content = $( html ).find( '.insight-product-grid .products' );
							var $newItems = $( content[0].innerHTML );
							box_container_el.isotope( 'insert', $newItems );

							box_container_el.imagesLoaded().progress( function() {
								box_container_el.isotope( 'layout' );
							} );

							$thiss.removeClass( 'btn-transparent' ).html( $thiss.data( 'text' ) );

							if ( page == max_pages ) {
								$thiss.parent().css( {display: 'none'} );
								return;
							}
							return false;
						} );
					} );
				}
			}
		} );
	}
).apply( this, [window.insight, jQuery] );


(
	function( insight, $ ) {
		function insightOnReady() {

			//Menu mobile
			if ( typeof insight.MenuMobile !== 'undefined' ) {
				insight.MenuMobile.init();
			}

			// Carousel
			if ( typeof insight.Carousel !== 'undefined' ) {
				insight.Carousel.init();
			}
			// AboutShortcode
			if ( typeof insight.AboutShortcode !== 'undefined' ) {
				insight.AboutShortcode.init();
			}
			// MasonryBlog
			if ( typeof insight.MasonryBlog !== 'undefined' ) {
				insight.MasonryBlog.init();
			}
			//ProductGridFilter
			if ( typeof insight.ProductGridFilter !== 'undefined' ) {
				insight.ProductGridFilter.init();
			}
			//GalleryLight
			if ( typeof insight.GalleryLight !== 'undefined' ) {
				insight.GalleryLight.init();
			}
		}

		$( document ).ready( function() {
			insightOnReady();
		} );
	}.apply( this, [window.insight, jQuery] )
);


// Accordion
(
	function( $ ) {
		$.fn.insightAccordion = function() {
			var thisAcc = this;
			thisAcc.find( '.title' ).on( 'click', function() {
				thisAcc.find( '.item' ).removeClass( 'active' );
				$( this ).parent().addClass( 'active' );
			} );
		};
	}( jQuery )
);
