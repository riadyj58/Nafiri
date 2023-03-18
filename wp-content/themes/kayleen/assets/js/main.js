(function($){

    'use strict';


    function isScrolledIntoViewport(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    // Site Preload & Fix transitions on load
    $(window).on('load', function() {
        $("body").addClass("site-loaded");
    });


    // Smooth Scroll
    if( $('body').hasClass('rivax-smooth-scroll') ) {
        SmoothScroll({ keyboardSupport: false });
    }


    // Post Reading Progress Indicator
    if($('.post-reading-progress-indicator').length) {
        $(window).on('scroll', function () {
            let docHeight = $("body").height();
            let winHeight = $(window).height();
            let viewport = docHeight - winHeight;
            let scrollPos = $(window).scrollTop();
            let scrollPercent = (scrollPos / viewport) * 100;
            $(".post-reading-progress-indicator span").css("width", scrollPercent + "%");

        });
    }

    // Offcanvas
    $('.offcanvas-container').on('click', function (e) {
        e.stopPropagation();
    });
    $('body').on('click', '.offcanvas-opener', function (e) {
        e.stopPropagation();
        $(this).closest('.rivax-offcanvas').find('.offcanvas-wrapper').addClass('open');
    });

    $('body, .offcanvas-closer').on('click', function (e) {
        $('.offcanvas-wrapper').removeClass('open');
    });

    // Popup Search
    $('body').on('click', '.popup-search-opener', function (e) {
        e.stopPropagation();
        $(this).closest('.popup-search-wrapper').find('.popup-search').addClass('open');
    });

    $('.popup-search-container').on('click', function (e) {
        e.stopPropagation();
    });

    $('body, .popup-search-closer').on('click', function (e) {
        $('.popup-search').removeClass('open');
    });

    // Sticky Header
    $(window).on('scroll', function () {

        if ( $('#site-sticky-header').length == 0 ) { // Check sticky header is enabled
            return;
        }

        var stickyPos = $('#site-header').outerHeight() + 300;
        var scroll = $(window).scrollTop();

        if( scroll > stickyPos ) {
            $('#site-sticky-header').addClass('fixed');
        }
        else {
            $('#site-sticky-header').removeClass('fixed');
            $('#site-sticky-header .popup-search').removeClass('open');
            $('#site-sticky-header .offcanvas-wrapper').removeClass('open');
        }
    });

    // Header Vertical Nav
    $('.header-vertical-nav li.menu-item-has-children > a').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('.sub-menu').slideToggle();
    });



    // Header Mega Menu
    $('body').on('mouseenter', '.rivax-header-nav li.rivax-mega-menu-item, .rivax-header-nav li.rivax-mega-menu-4-col', function() {
        var megaMenuWidth = $(this).closest('.elementor-container').width();

        // No need for default header.
        if(megaMenuWidth === undefined)
            return;

        var subMenu = $(this).children('.sub-menu');
        subMenu.css('width', megaMenuWidth);

        var menuPos = $(this).closest('.rivax-header-nav').offset().left;
        var elementorContainerPos = $(this).closest('.elementor-container').offset().left;

        if( $('body').hasClass('rtl') ) {
            var menuRightPos = menuPos + $(this).closest('.rivax-header-nav').width();
            var elementorContainerRightPos = elementorContainerPos + megaMenuWidth;

            subMenu.css('right', parseInt(menuRightPos - elementorContainerRightPos));

        }
        else {
            subMenu.css('left', parseInt(elementorContainerPos - menuPos));
        }


    });



    // Back to Top Button
    $(window).on('scroll', function (e) {

        var showPos = $('#site-header').outerHeight() + 200;
        var scroll = $(window).scrollTop();

        if( scroll > showPos ) {
            $('#back-to-top').addClass('show');
        }
        else {
            $('#back-to-top').removeClass('show');
        }

    });

    $('#back-to-top').click(function(e) {
        $('body,html').animate({scrollTop:0},800);
    });


    // Fixed Next And Previous Posts
    $(window).on('scroll', function (e) {

        var scroll = $(window).scrollTop();

        if( scroll > 900 ) {
            $('.single-fixed-next-prev-posts').addClass('show');
        }
        else {
            $('.single-fixed-next-prev-posts').removeClass('show');
        }

    });


    // Footer Canvas Menu
    $('.footer-canvas-menu-btn').click(function(e) {
        if( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $('body').removeClass('footer-canvas-menu-active');
        }
        else {
            $(this).addClass('active');
            $('body').addClass('footer-canvas-menu-active');
        }

    });


    // Sticky Sidebar
    if( $('#site-sticky-header').length ) {
        $('.sidebar-container.sticky .sidebar-container-inner').css('top', $('#site-sticky-header').outerHeight() + 10);
    }


    // Comments Area Collapsable
    $('.comments-list-collapse-btn').on('click', function (e) {
        var commentsArea = $('.comments-area');
        var btn = $(this);

        if( commentsArea.hasClass('collapsed') ) {
            commentsArea.slideDown();
            commentsArea.removeClass('collapsed');
            btn.text( btn.data('hide') );
        }
        else {
            commentsArea.slideUp();
            commentsArea.addClass('collapsed');
            btn.text( btn.data('show') );
        }
    });


    // Single Post Share Link Box
    $(".single-share-box-link .share-link-btn").on('click', function(){
        $(".single-share-box-link .share-link-text").select();
        document.execCommand('copy');
        $('.single-share-box-link .copied-popup-text').addClass('show');
        setTimeout(function () {
            $('.single-share-box-link .copied-popup-text').removeClass('show');
        }, 2000);
    });


    // Infinite Scroll Load More
    $(window).on('scroll', function () {

        $( ".rivax-post-load-more.infinite-scroll" ).each(function( index ) {

            if( isScrolledIntoViewport($(this)) ) {
                $(this).trigger("click");
            }

        });

    });


    // Load more posts ajax
    $('.rivax-post-load-more').on('click', function (e) {
        e.preventDefault();
        if($(this).hasClass('hide')) return;

        var loadMoreBtn = $(this);
        var loadMoreLoader = loadMoreBtn.next('.rivax-post-load-more-loader');
        var scope = loadMoreBtn.closest('.rivax-posts-container').find('.rivax-posts-wrapper');

        var widgetId = $(this).data('widget-id');
        var postId = $(this).data('post-id');
        var pageNumber = $(this).data('current-page') + 1;



        var data = {
            action: 'rivax_get_load_more_posts',
            widgetId: widgetId,
            postId: postId,
            pageNumber: pageNumber,
            qVars: (typeof rivaxLoadMoreQVars !== 'undefined')? rivaxLoadMoreQVars : '',
        };
        $.post({
            url: rivax_ajax_object.AjaxUrl,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                loadMoreBtn.addClass('hide');
                loadMoreLoader.addClass('show');
            },
            success: function(response) {
                if(response.data) {
                    var items = $(response.data);

                    scope.append(items);
                    if( scope.hasClass('layout-masonry') ) {
                        scope.masonry( 'appended', items );
                    }
                }


                if(response.no_more) {
                    loadMoreLoader.remove();
                    loadMoreBtn.remove();
                }
                else {
                    loadMoreBtn.data('current-page', pageNumber);
                }
            },
            error: function() {

            },
            complete: function() {
                loadMoreBtn.removeClass('hide');
                loadMoreLoader.removeClass('show');
            }
        });


    });




    var PostsHandler = function( $scope, $ ) {

        // Post Masonry Layout
        var masonryPosts = $scope.find('.rivax-posts-wrapper.layout-masonry');
        if ( masonryPosts.length ){
            masonryPosts.masonry({
                itemSelector: '.post-item',
                percentPosition: true,
            });
        }


        // Post Carousel Layout
        var carouselPosts = $scope.find('.rivax-posts-wrapper.layout-carousel .rivax-posts-carousel-wrapper');
        if ( carouselPosts.length ){
            var carouselSettings = carouselPosts.data('settings');
            var carouselContainer = carouselPosts.find('.swiper-container');


            if ( 'undefined' === typeof Swiper ) {
                const asyncSwiper = elementorFrontend.utils.swiper;

                new asyncSwiper( carouselContainer, carouselSettings ).then( ( newSwiperInstance ) => {
                    var swiper = newSwiperInstance;
                } );
            } else {
                var swiper = new Swiper(carouselContainer, carouselSettings);
            }

        }



        // Single Post Gallery Hero
        if ( $('.single-hero-gallery-container').length ){

            if( $('.single-hero-inside .single-hero-gallery-container').length ) {
                var gallerySettings = {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    centeredSlides: true,
                    //loop: true,
                    autoplay: true,
                    spaceBetween: 30,
                    a11y: {
                        enabled: false,
                    },
                    navigation: {
                        nextEl: ".single-hero-gallery-container .swiper-button-next",
                        prevEl: ".single-hero-gallery-container .swiper-button-prev",
                    }
                };
            }
            else {
                var gallerySettings = {
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    centeredSlides: true,
                    //loop: true,
                    autoplay: true,
                    spaceBetween: 30,
                    a11y: {
                        enabled: false,
                    },
                    navigation: {
                        nextEl: ".single-hero-gallery-container .swiper-button-next",
                        prevEl: ".single-hero-gallery-container .swiper-button-prev",
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                        },
                        992: {
                            slidesPerView: 2,
                        }
                    }
                };
            }

            var carouselContainer = $('.single-hero-gallery-container .swiper-container');

            if ( 'undefined' === typeof Swiper ) {
                const asyncSwiper = elementorFrontend.utils.swiper;

                new asyncSwiper( carouselContainer, gallerySettings ).then( ( newSwiperInstance ) => {
                    var swiper = newSwiperInstance;
                } );
            } else {
                var swiper = new Swiper(carouselContainer, gallerySettings);
            }

        }



        // Post Stellar
        if( $scope.find('.rivax-stellar-wrapper').length ) {

            var wrapper = $scope.find('.rivax-stellar-wrapper');

            wrapper.find('.post-item').on('mouseenter click', function() {
                if( $(this).hasClass('active') )
                    return;

                var id = $(this).data('id');
                wrapper.find('.post-item').removeClass('active');
                $(this).addClass('active');

                wrapper.find('.image-item').removeClass('active');
                wrapper.find('.image-item[data-id="' + id + '"]').addClass('active');

            });
        }


    }


    // Elementor Widgets
    $( window ).on( 'elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', PostsHandler );

    });








})( jQuery );
