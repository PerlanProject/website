(function($) {

    "use strict";

    // Document ready function 
    $(function() {

       
   /*-------------------------------------
               /*-------------------------------------
         Jquery Serch Box
         -------------------------------------*/
        var topSearchForm = $('#top-search-form');

        topSearchForm.on('click', 'a.search-button', function(e) {
            e.preventDefault();

            var targrt = $(this).prev('input.search-input');
            targrt.animate({
                width: ["toggle", "swing"],
                height: ["toggle", "swing"],
                opacity: "toggle"
            }, 500, "linear");

            return false;

        });

   

    });

    /*-------------------------------------
     jQuery MeanMenu activation code
     --------------------------------------*/
     var href = jQuery(".custom-logo-link").attr('href');

     var src = jQuery(".custom-logo").attr('src');

     if( src=="" )
     {
        var value="<a href='"+href+"'' class='logo-mobile-menu'><img src='"+src+"' /></a>";
    }
    else
    {
        //var title_dec= jQuery(".logo-area").html();
       var value= jQuery(".logo-area").html();
    }

    $('nav#dropdown').meanmenu({ siteLogo: value });

    /*-------------------------------------
     Wow js Active
     -------------------------------------*/
    new WOW().init();

   
    /*-------------------------------------
     Sidebar Menu activation code
    -------------------------------------*/
    $('#additional-menu-area').on('click', 'span.side-menu-trigger', function() {

        var $this = $(this),
            wrapper = $(this).parents('body').find('>#wrapper');
        if ($this.hasClass('open')) {
            document.getElementById('mySidenav').style.width = '0';
            $this.removeClass('open').find('i.fa').removeClass('fa-times').addClass('fa-bars');
            wrapper.removeClass('open');
        } else {
            wrapper.addClass('open');
            $this.addClass('open').find('i.fa').removeClass('fa-bars').addClass('fa-times');
            document.getElementById('mySidenav').style.width = '280px';
        }

    });

    $('#mySidenav').on('click', '.closebtn', function(e) {
        e.preventDefault();
        var $this = $(this),
            wrapper = $(this).parents('body').find('>#wrapper');
        wrapper.removeClass('open');
        document.getElementById('mySidenav').style.width = '0';
        $('#additional-menu-area span.side-menu-trigger').removeClass('open').find('i.fa').removeClass('fa-times').addClass('fa-bars');

    });


    /****************************************
  Circle Bars - Knob
  ***************************************/
    if (typeof($.fn.knob) != 'undefined') {
        $('.knob.knob-nopercent').each(function() {
            var $this = $(this),
                knobVal = $this.attr('data-rel');
            $this.knob({
                'draw': function() {}
            });
            $this.appear(function() {
                $({
                    value: 0
                }).animate({
                    value: knobVal
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {

                        $this.val(Math.ceil(this.value)).trigger('change');
                    }
                });
            }, { accX: 0, accY: -150 });
        });


    }

    /*-------------------------------------
       Select2 activation code
       -------------------------------------*/
    if ($('.request-form-select select.select2').length) {
        $('.request-form-select select.select2').select2({
            theme: 'classic',
            dropdownAutoWidth: true,
            width: '100%'
        });
    }

    /*-------------------------------------
     Window load function
     -------------------------------------*/
    $(window).on('load', function() {

        var galleryIsoContainer = $('#blog-gallery');
        if (galleryIsoContainer.length) {

            var blogGallerIso = galleryIsoContainer.imagesLoaded(function() {
                blogGallerIso.isotope({
                    itemSelector: '.blog-item',
                    masonry: {
                        columnWidth: '.blog-item'
                    }
                });
            });
        }

        // Page Preloader
        $('#preloader').fadeOut('slow', function() {
            $(this).remove();
        });

        //jQuery for Isotope initialization
        var $container = $('#isotope-container');
        if ($container.length > 0) {
            var $isotope = $container.find('.featuredContainer').isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });

            $container.find('.isotope-classes-tab').on('click', 'a', function() {
                var $this = $(this);
                $this.parent('.isotope-classes-tab').find('a').removeClass('current');
                $this.addClass('current');
                var selector = $this.attr('data-filter');
                $isotope.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        }

        var testimonialCarousel = $('#rt-testimonial-slider-wrap');
        if (testimonialCarousel.length) {

            testimonialCarousel.find('.testimonial-sliders').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
                asNavFor: '.testimonial-carousel'
            });
            testimonialCarousel.find('.testimonial-carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.testimonial-sliders',
                dots: false,
                arrows: true,
                prevArrow: true,
                nextArrow: true,
                centerMode: true,
                centerPadding: '0px',
                focusOnSelect: true
            });

        }

    }); // end window load function

   
    /*-------------------------------------
    Accordion for fixing F&Q
    -------------------------------------*/
    var faqAccordion = $('#faq-accordion');
    faqAccordion
        .on('show.bs.collapse', function(e) {
            faqAccordion.find('.panel-heading').removeClass('active');
            $(e.target).parents('.panel').find('.panel-heading').addClass('active');
            faqAccordion.find('.panel-collapse.collapse').slideUp('slow', function() {
                $(this).removeClass('in').css('display', '');
            });
        });


    /*-------------------------------------
     Accordion
     -------------------------------------*/
    var accordion = $('#accordion');
    accordion.children('.panel').children('.panel-collapse').each(function() {
        if ($(this).hasClass('in')) {
            $(this).parent('.panel').children('.panel-heading').addClass('active');
        }
    });
    accordion
        .on('show.bs.collapse', function(e) {
            $(e.target).prev('.panel-heading').addClass('active');
        })
        .on('hide.bs.collapse', function(e) {
            $(e.target).prev('.panel-heading').removeClass('active');
        });

  

    /*-------------------------------------
     Input Quantity Up & Down activation code
     -------------------------------------*/
    $('#quantity-holder').on('click', '.quantity-plus', function() {

        var $holder = $(this).parents('.quantity-holder');
        var $target = $holder.find('input.quantity-input');
        var $quantity = parseInt($target.val(), 10);
        if ($.isNumeric($quantity) && $quantity > 0) {
            $quantity = $quantity + 1;
            $target.val($quantity);
        } else {
            $target.val($quantity);
        }

    }).on('click', '.quantity-minus', function() {

        var $holder = $(this).parents('.quantity-holder');
        var $target = $holder.find('input.quantity-input');
        var $quantity = parseInt($target.val(), 10);
        if ($.isNumeric($quantity) && $quantity >= 2) {
            $quantity = $quantity - 1;
            $target.val($quantity);
        } else {
            $target.val(1);
        }

    });

    /*-------------------------------------
     Carousel slider initiation
     -------------------------------------*/
    $('.fn-carousel').each(function() {
        var carousel = $(this),
            loop = carousel.data('loop'),
            items = carousel.data('items'),
            margin = carousel.data('margin'),
            stagePadding = carousel.data('stage-padding'),
            autoplay = carousel.data('autoplay'),
            autoplayTimeout = carousel.data('autoplay-timeout'),
            smartSpeed = carousel.data('smart-speed'),
            dots = carousel.data('dots'),
            nav = carousel.data('nav'),
            navSpeed = carousel.data('nav-speed'),
            rXsmall = carousel.data('r-x-small'),
            rXsmallNav = carousel.data('r-x-small-nav'),
            rXsmallDots = carousel.data('r-x-small-dots'),
            rXmedium = carousel.data('r-x-medium'),
            rXmediumNav = carousel.data('r-x-medium-nav'),
            rXmediumDots = carousel.data('r-x-medium-dots'),
            rSmall = carousel.data('r-small'),
            rSmallNav = carousel.data('r-small-nav'),
            rSmallDots = carousel.data('r-small-dots'),
            rMedium = carousel.data('r-medium'),
            rMediumNav = carousel.data('r-medium-nav'),
            rMediumDots = carousel.data('r-medium-dots'),
            center = carousel.data('center');

        carousel.owlCarousel({
            loop: (loop ? true : false),
            items: (items ? items : 4),
            lazyLoad: true,
            margin: (margin ? margin : 0),
            autoplay: (autoplay ? true : false),
            autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),
            smartSpeed: (smartSpeed ? smartSpeed : 250),
            dots: (dots ? true : false),
            nav: (nav ? true : false),
            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
            navSpeed: (navSpeed ? true : false),
            center: (center ? true : false),
            responsiveClass: true,
            responsive: {
                0: {
                    items: (rXsmall ? rXsmall : 1),
                    nav: (rXsmallNav ? true : false),
                    dots: (rXsmallDots ? true : false)
                },
                480: {
                    items: (rXmedium ? rXmedium : 2),
                    nav: (rXmediumNav ? true : false),
                    dots: (rXmediumDots ? true : false)
                },
                768: {
                    items: (rSmall ? rSmall : 3),
                    nav: (rSmallNav ? true : false),
                    dots: (rSmallDots ? true : false)
                },
                992: {
                    items: (rMedium ? rMedium : 5),
                    nav: (rMediumNav ? true : false),
                    dots: (rMediumDots ? true : false)
                }
            }
        });

    });


    /*-------------------------------------
     Window onLoad and onResize event trigger
     -------------------------------------*/
    $(window).on('load resize', function() {
        //Define the maximum height for mobile menu
        var wHeight = $(window).height(),
            mLogoH = $('a.logo-mobile-menu').outerHeight();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('height', wHeight + 'px');

        var s = $('#sticker');
        if (s.parent('.header-one-style').length) {
            var topBar = s.prev('.header-top-bar'),
                total = topBar.outerHeight() + s.outerHeight();
            $('#wrapper').css("padding-top", total + 'px');
        }

        

    });

    /*-------------------------------------
     Jquery Stiky Menu at window Load
     -------------------------------------*/
    $(window).on('scroll', function() {

        var s = $('#sticker'),
            w = $('.wrapper'),
            h = s.outerHeight(),
            windowpos = $(window).scrollTop(),
            windowWidth = $(window).width(),
            h1 = s.parent('.header-one-style'),
            h2 = s.parent('.header-two-style'),
            h3 = s.parent('.header-three-style'),
            h4 = s.parent('.header-four-style'),
            h5 = s.parent('.header-five-style'),
            h6 = s.parent('.header-six-style'),
            topBar, topBarH, mBottom;

        if (windowWidth > 767) {
            w.css('padding-top', '');
            if (h1.length || h6.length) {
                topBar = s.prev('.header-top-bar');
                topBarH = topBar.outerHeight();
            } else if (h2.length) {
                topBar = h2;
                topBarH = h2.outerHeight() - 35;
            } else if (h4.length) {
                topBar = s.prev('.header-area');
                topBarH = topBar.outerHeight();
            } else if (h5.length || h3.length) {
                topBarH = 1;
            }


            if (windowpos >= topBarH) {
                s.addClass('stick');
                if (h1.length || h4.length || h6.length) {
                    topBar.css('margin-bottom', h + 'px');
                }
            } else {
                s.removeClass('stick');
                if (h1.length || h4.length || h6.length) {
                    topBar.css('margin-bottom', 0);
                }
            }
        }

    });


})(jQuery);
