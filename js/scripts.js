//   all ------------------
function initCitybook() {
    "use strict";
    //   loader ------------------
    $(".loader-wrap").fadeOut(300, function () {
        $("#main").animate({
            opacity: "1"
        }, 300);
    });
    //   Background image ------------------
    var a = $(".bg");
    a.each(function (a) {
        if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
    });
    //   scrollToFixed------------------
    if (typeof $.fn.scrollToFixed !== 'undefined') {
        //$(".fixed-bar").scrollToFixed({
        //    minWidth: 1064,
        //    marginTop: 90,
        //    removeOffsets: true,
        //    limit: function () {
        //        var a = $(".limit-box").offset().top - $(".fixed-bar").outerHeight() - 70;
        //        return a;
        //    }
        //});
        $(".back-to-filters").scrollToFixed({
            minWidth: 1224,
            zIndex: 12,
            marginTop: 130,
            removeOffsets: true,
            limit: function () {
                var a = $(".limit-box").offset().top - $(".back-to-filters").outerHeight(true) - 10;
                return a;
            }
        });
        $(".scroll-nav-wrapper").not(".dont-scroll-to-fixed").scrollToFixed({
            minWidth: 768,
            zIndex: 12,
            marginTop: 80,
            removeOffsets: true,
            limit: function () {
                var a = $(".limit-box").offset().top - $(".scroll-nav-wrapper").outerHeight(true) - 10;
                return a;
            }
        });
    }
    //   Isotope------------------
    if (typeof $.fn.isotope !== 'undefined') {
        function initIsotope() {
            if ($(".gallery-items:not(.no-isotope)").length && $(window).width() > 768) {
                var a = $(".gallery-items:not(.no-isotope)").isotope({
                    singleMode: true,
                    columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                    itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                    transformsEnabled: true,
                    transitionDuration: "700ms",
                    resizable: true
                });
                a.imagesLoaded(function () {
                    a.isotope("layout");
                });
                $(".gallery-filters").on("click", "a.gallery-filter", function (b) {
                    var c = $(this).attr("data-filter"),
                        d = $(this).text();
                    b.preventDefault();
                    var c = $(this).attr("data-filter");
                    a.isotope({
                        filter: c
                    });
                    $(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                    $(this).addClass("gallery-filter-active");

                });
            }
        }
        initIsotope();
    }
    //   Slick------------------
    if (typeof $.fn.slick !== 'undefined') {
	    var sbp = $('.swiper-button-prev'),
		    sbn = $('.swiper-button-next');
        $('.fw-carousel').slick({
            dots: true,
            infinite: true,
            speed: 600,
            slidesToShow: 1,
            centerMode: false,
            arrows: false,
            variableWidth: true
        });
        sbp.on("click", function () {
            $('.fw-carousel').slick('slickPrev');
        })

        sbn.on("click", function () {
            $('.fw-carousel').slick('slickNext');
        })
        $('.slideshow-container').slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            fade: true,
            cssEase: 'ease-in',
            infinite: true,
            speed: 1000
        });
        $('.single-slider').slick({
            infinite: true,
            slidesToShow: 1,
            dots: true,
            arrows: false,
            adaptiveHeight: true
        });
        sbp.on("click", function () {
            $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickPrev');
        });
        sbn.on("click", function () {
            $(this).closest(".single-slider-wrapper").find('.single-slider').slick('slickNext');
        });

        $('.slider-container').slick({
            infinite: true,
            slidesToShow: 1,
            dots: true,
            arrows: false,
        });
         $('.slider-container').on('init', function(event, slick){
     //initAutocomplete();
            });
        sbp.on("click", function () {
            $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickPrev');

        });
        sbn.on("click", function () {
            $(this).closest(".slider-container-wrap").find('.slider-container').slick('slickNext');
        });
        $('.single-carousel').slick({
            infinite: true,
            slidesToShow: 3,
            dots: true,
            arrows: false,
            centerMode: true,
            responsive: [{
                    breakpoint: 1224,
                    settings: {
                        slidesToShow: 2,
                        centerMode: false,
                    }
                },

                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                    }
                }
            ]

        });
        sbp.on("click", function () {
            $(this).closest(".carousel ").find('.single-carousel').slick('slickPrev');
        });
        sbn.on("click", function () {
            $(this).closest(".carousel").find('.single-carousel').slick('slickNext');
        });
        if ($(window).width() > 768) {
            $('.listing-carousel').each((i, e) => {
                $(e).slick({
                    infinite: true,
                    slidesToShow: $(e).data().slidesToShow || 5,
                    initialSlide: $(e).data().initialSlide || 0,
                    dots: true,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0',
                    responsive: [{
                            breakpoint: 1500,
                            settings: {
                                slidesToShow: $(e).data().slidesToShow || 4,
                            }
                        },
                        {
                            breakpoint: 1224,
                            settings: {
                                slidesToShow: 3,
                            }
                        },

                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 768,//800,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]

                });
            })
        }
    
        sbp.on("click", function () {
            $(this).closest(".list-carousel").find('.listing-carousel').slick('slickPrev');
        });
        sbn.on("click", function () {
            $(this).closest(".list-carousel").find('.listing-carousel').slick('slickNext');
        });
        $('.client-carousel').slick({
            variableWidth: true,//
            infinite: true,
            slidesToShow: 5,
            dots: false,
            arrows: false,
            centerMode: true,
            responsive: [{
                    breakpoint: 1224,
                    settings: {
                        slidesToShow: 4,
                        centerMode: false,
                    }
                },

                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        centerMode: true,
                    }
                }
            ]

        });
        $('.sp-cont-prev').on("click", function () {
            $(this).closest(".spons-list").find('.client-carousel').slick('slickPrev');
        });
        $('.sp-cont-next').on("click", function () {
            $(this).closest(".spons-list").find('.client-carousel').slick('slickNext');
        });

    };
    //   Bubbles ------------------
    $('<div class="bubbles"></div>').appendTo(".bubble-bg");
    var bArray = [];
    var sArray = [5, 10, 15, 20];
    for (var i = 0; i < $('.bubbles').width(); i++) {
        bArray.push(i);
    }
    function randomValue(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    }
    setInterval(function () {
        var size = randomValue(sArray);
        $('.bubbles').append('<div class="individual-bubble" style="left: ' + randomValue(bArray) + 'px; width: ' + size + 'px; height:' + size + 'px;"></div>');
        $('.individual-bubble').fadeOut(5000, function () {
            $(this).remove()
        });
    }, 350);
    //   lightGallery------------------
    $(".image-popup").lightGallery({
        selector: "this",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        counter: false
    });
    var o = $(".lightgallery"),
        p = o.data("looped");
    o.lightGallery({
        selector: ".lightgallery a.popup-image",
        cssEasing: "cubic-bezier(0.25, 0, 0.25, 1)",
        download: false,
        loop: false,
		counter: false
    });
    $('#showFullGallery').on('click', function () {
        $(this).siblings('.lightgallery').find('a.popup-image').first().click()
    })
    //   appear------------------
    //$(".stats").appear(function () {
    //    $(".num").countTo();
    //});
    // Share   ------------------
    if (typeof $.fn.niceSelect !== 'undefined') {
        $(".share-container").share({
            networks: ['facebook', 'email', 'twitter', 'linkedin']
        });
        var shrcn = $(".share-container");
        function showShare() {
            shrcn.removeClass("isShare");
            shrcn.addClass("visshare");
        }
        function hideShare() {
            shrcn.addClass("isShare");
            shrcn.removeClass("visshare");
        }
        $(".showshare, .custom-showshare").on("click", function () {
            $(this).toggleClass("vis-butsh");
            //$(this).find("span").text($(this).text() === 'Zatvori' ? 'Podeli' : 'Zatvori');
            if ($(".share-container").hasClass("isShare")) showShare();
            else hideShare();
        });
        // click outside showshare to close
        $(document).on('click.showshare', function (e) {
            //e.stopPropagation()
            if ($(e.target).closest('.custom-showshare').length === 0) {
                !$(".share-container").hasClass("isShare") && hideShare()
            }
        });
    }
    //   accordion ------------------
    $(".accordion a.toggle").not('.disabled').on("click", function (a) {
        a.preventDefault();
        $(".accordion a.toggle").not(this).removeClass("act-accordion");
        $(this).toggleClass("act-accordion");
        if ($(this).next('div.accordion-inner').is(':visible')) {
            $(this).next('div.accordion-inner').slideUp();
        } else {
            $(".accordion a.toggle").next('div.accordion-inner').slideUp();
            $(this).next('div.accordion-inner').slideToggle();
        }
    });
    //   tabs------------------
    $(".tabs-menu a").on("click", function (a) {
        a.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var b = $(this).attr("href");
        $(".tab-content").not(b).css("display", "none");
        $(b).fadeIn();
    });
    // twitter ------------------
    //if ($("#footer-twiit").length > 0) {
    //    var config1 = {
    //        "profile": {
    //            "screenName": 'planplusweb'
    //        },
    //        "domId": 'footer-twiit',
    //        "maxTweets": 2,
    //        "enableLinks": true,
    //        "showImages": false,
    //        "showUser": false,
    //        "showInteraction": false,
    //        "useEmoji": true,
    //        "lang": "sr"
    //    };
    //    twitterFetcher.fetch(config1);
    //}
    //   Contact form------------------
	$(document).on('submit','#contactform',function(){
        var a = $(this).attr("action");
        $("#message").slideUp(750, function () {
            $("#message").hide();
            $("#submit").attr("disabled", "disabled");
            $.post(a, {
                name: $("#name").val(),
                email: $("#email").val(),
                comments: $("#comments").val()
            }, function (a) {
                document.getElementById("message").innerHTML = a;
                $("#message").slideDown("slow");
                $("#submit").removeAttr("disabled");
                if (null != a.match("success")) $("#contactform").slideDown("slow");
            });
        });
        return false;
    });
 	$(document).on('keyup', '#contactform input, #contactform textarea', function(){
        $("#message").slideUp(1500);
    });
    //   mailchimp------------------
    //$("#subscribe").ajaxChimp({
    //    language: "eng",
    //    url: "http://kwst.us18.list-manage.com/subscribe/post?u=42df802713d4826a4b137cd9e&id=815d11e811"
    //});
    //$.ajaxChimp.translations.eng = {
    //    submit: "Submitting...",
    //    0: '<i class="fa fa-check"></i> We will be in touch soon!',
    //    1: '<i class="fa fa-warning"></i> You must enter a valid e-mail address.',
    //    2: '<i class="fa fa-warning"></i> E-mail address is not valid.',
    //    3: '<i class="fa fa-warning"></i> E-mail address is not valid.',
    //    4: '<i class="fa fa-warning"></i> E-mail address is not valid.',
    //    5: '<i class="fa fa-warning"></i> E-mail address is not valid.'
    //};
    //   Video------------------
  //  var v = $(".background-youtube-wrapper").data("vid");
  //  var f = $(".background-youtube-wrapper").data("mv");
  //  $(".background-youtube-wrapper").YTPlayer({
  //      fitToBackground: true,
  //      videoId: v,
  //      pauseOnScroll: true,
  //      mute: f,
  //      callback: function () {
  //          var a = $(".background-youtube-wrapper").data("ytPlayer").player;
  //      }
  //  });

  //  var w = $(".background-vimeo").data("vim"),
		//bvc = $(".background-vimeo"),
		//bvmc = $(".media-container"),
		//bvfc =  $(".background-vimeo iframe "),
		//vch =  $(".video-container");
  //  bvc.append('<iframe src="//player.vimeo.com/video/' + w + '?background=1"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>');
  //  $(".video-holder").height(bvmc.height());
  //  if ($(window).width() > 1024) {
  //      if ($(".video-holder").size() > 0)
  //          if (bvmc.height() / 9 * 16 > bvmc.width()) {
  //              bvfc.height(bvmc.height()).width(bvmc.height() / 9 * 16);
  //             bvfc.css({
  //                  "margin-left": -1 * $("iframe").width() / 2 + "px",
  //                  top: "-75px",
  //                  "margin-top": "0px"
  //              });
  //          } else {
  //              bvfc.width($(window).width()).height($(window).width() / 16 * 9);
  //              bvfc.css({
  //                  "margin-left": -1 * $("iframe").width() / 2 + "px",
  //                  "margin-top": -1 * $("iframe").height() / 2 + "px",
  //                  top: "50%"
  //              });
  //          }
  //  } else if ($(window).width() < 760) {
  //      $(".video-holder").height(bvmc.height());
  //      bvfc.height(bvmc.height());
  //  } else {
  //      $(".video-holder").height(bvmc.height());
  //      bvfc.height(bvmc.height());
  //  }
  //  vch.css("width", $(window).width() + "px");
  //  vch.css("height",  720 / 1280 * $(window).width()) + "px";
  //  if (vch.height() < $(window).height()) {
  //      vch.css("height", $(window).height() + "px");
  //      vch.css("width",  1280 / 720 * $(window).height()) + "px";
  //  }
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        //var a = 70 + $(".scroll-nav-wrapper").height();
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") || location.hostname === this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top //- a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    //$(".scroll-init  ul ").not('.dont-single-page-nav').singlePageNav({
    //    filter: ":not(.external)",
    //    updateHash: false,
    //    offset: 110,
    //    threshold: 120,
    //    speed: 1200,
    //    currentClass: "act-scrlink"
    //});
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 200);
        return false;
    });
    // scroll animation ------------------
    $(window).on("scroll", function (a) {
        if ($(this).scrollTop() > 150) {
            $(".to-top").fadeIn(500);
        } else {
            $(".to-top").fadeOut(500);
        }
    });
    // collage image position ------------------
    $(".images-collage-item").each(function () {
        var tcp = $(this),
			dpl = tcp.data("position-left"),
            dpt = tcp.data("position-top"),
            dzi = tcp.data("zindex");
        tcp.css({
            "top": dpt + "%"
        });
        tcp.css({
            "z-index": dzi,
        });
        tcp.css({
            "left": dpl + "%",
        });
    });
    // modal ------------------
    var modal = {};

    window.modal = modal;
    modal.hide = function () {
        $('.modal').fadeOut();
        $("html, body").removeClass("hid-body");
    };
    $('.modal-open').on("click", function (e) {
        e.preventDefault();
        $('.modal').fadeIn();
        $("html, body").addClass("hid-body");
    });
    // mobile log in
    $('.main-menu').on('click', 'div.log-out-btn, .login-link', function (e) {
        e.preventDefault();
        $('#main').append(`<iframe src="/account/signin?returnUrl=${returnUrl}" class="main-register-wrap modal" />`)
        $('.modal').fadeIn();
        $("html, body").addClass("hid-body");
    });
    $('.close-reg').on("click", function () {
        modal.hide();
    });
	// click ------------------
    $(".more-filter-option").on("click", function () {
        $(".hidden-listing-filter").slideToggle(500);
        $(this).find("span").toggleClass("mfilopact");
    });
    //$(".show-search-button").on("click", function () {
    //    $(".vis-header-search").slideToggle(500);
    //});
    $(".listing-view-layout li a.list").on("click", function (e) {
        e.preventDefault();
        $(".listing-view-layout li a").removeClass("active");
        $(".listing-item").addClass("list-layout");
        $(this).addClass("active");
    });
    $(".listing-view-layout li a.grid").on("click", function (e) {
        e.preventDefault();
        $(".listing-view-layout li a").removeClass("active");
        $(".listing-item").removeClass("list-layout");
        $(this).addClass("active");
    });
    // Forms ------------------
	$(document).on('change', '.leave-rating input', function() {
        var $radio = $(this);
        $('.leave-rating .selected').removeClass('selected');
        $radio.closest('label').addClass('selected');
    });
 
    typeof $.fn.niceSelect !== 'undefined' && $('.chosen-select').niceSelect();
    //$('input[type="range"].distance-radius').rangeslider({
    //    polyfill: false,
    //    onInit: function () {
    //        this.output = $(".distance-title span").html(this.$element.val());
    //    },
    //    onSlide: function (
    //        position, value) {
    //        this.output.html(value);
    //    }
    //});
    typeof $.fn.dateDropper !== 'undefined' && $('input.datepicker').dateDropper();
    typeof $.fn.timeDropper !== 'undefined' && $("input.timepicker").timeDropper({
        setCurrentTime: false,
        meridians: false,
        primaryColor: "#4DB7FE",
        borderColor: "#4DB7FE",
        minutesInterval: '15',
        format: 'HH:mm'
    });
    $(".eye").on("click touchstart", function () {
		var epi = $(this).parent(".pass-input-wrap").find("input");
        if (epi.attr("type") === "password") {
            epi.attr("type", "text");
        } else {
            epi.attr("type", "password");
        }
    });
  //  var cityId = $("#weather-widget").data("city-id"),
  //      lat = $("#weather-widget").data("lat"),
  //      lng = $("#weather-widget").data("lng");
	
		//$("#weather-widget").ideaboxWeather({
  //              location: '',
  //              id: cityId != 0 ? cityId : '',
  //              lat: cityId != 0 && cityId != '' ? '' : lat,
  //              lon: cityId != 0 && cityId != '' ? '' : lng,
  //              lang: 'sr',
  //              template: 'horizontal',
  //              imgpath: "/Content/themes/citybook/images/wimg/",
  //              todaytext: "Danas",
  //              days: ['Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Četvrtak', 'Petak', 'Subota'],
  //              dayssmall: ['Ned', 'Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub']
 
		//});
	
 
    // Styles ------------------
    if ($("footer.main-footer").hasClass("fixed-footer")) {
        $('<div class="height-emulator fl-wrap"></div>').appendTo("#main");
    }
    function csselem() {
        $(".height-emulator").css({
            height: $(".fixed-footer").outerHeight(true)
        });
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true)
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true)
        });
        $(".map-container.column-map").css({
            height: $(window).outerHeight(true)-60+"px"
            //height: $(window).outerHeight(true) - parseInt($('#wrapper').css('padding-top')) + "px"
        });		
					
    }
    csselem();
    // Mob Menu------------------
    $(".nav-button-wrap").on("click", function () {
        $(".main-menu, header.main-header").toggleClass("vismobmenu");
        $('html').toggleClass("scroll-lock")
        // set menu start position
        $('.sliding-menu-wrapper').css('margin-left', 0)
        // only max-width 768px
        if ($(window).width() <= 768) {
            $(".nav-button-wrap").toggleClass('active')
            $('.nav-button').toggleClass('fa fa-times')
        }
    });
    //function mobMenuInit() {
    //    var ww = $(window).width();
    //    ww = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    //    if (ww < 1180 || $('.main-header.map').length) {
    //        $(".menusb").remove();
    //        $(".main-menu").removeClass("nav-holder");
    //        $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
    //        $(".menusb").menu();
    //    } else {
    //        $(".menusb").remove();
    //        $(".main-menu").addClass("nav-holder");
    //    }
    //}
    //mobMenuInit();
    //   css ------------------
    var $window = $(window);
    $window.on("resize", function() {
        csselem();
        //mobMenuInit();
    });
    $(".box-cat").on({
		mouseenter: function () {
        var a = $(this).data("bgscr");
        $(".bg-ser").css("background-image", "url(" + a + ")");
    }});
    //$(".header-user-name").on("click", function () {
    //    $(".header-user-menu ul").toggleClass("hu-menu-vis");
    //    $(this).toggleClass("hu-menu-visdec");
    //});
    // Counter ------------------
    //if ($(".counter-widget").length > 0) {
    //    var countCurrent = $(".counter-widget").attr("data-countDate");
    //    $(".countdown").downCount({
    //        date: countCurrent ,
    //        offset: 0
    //    });
    //}
	
	
	function showBookingForm (){
		$(".booking-modal-wrap , .bmw-overlay").fadeIn(400);
		$("html, body").addClass("hid-body");
	}
	function hideBookingForm (){
		$(".booking-modal-wrap , .bmw-overlay").fadeOut(400);
		$("html, body").removeClass("hid-body");
	}	
    $(".booking-modal-close , .bmw-overlay").on("click", function () {
  		hideBookingForm ();
    });
    $(".book-btn").on("click", function (e) {
		e.preventDefault();
  		showBookingForm ();
    });		
 
	 
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;
    $(".next-form").on("click", function (e) {
        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        $("#progressbar li").eq($(".bookiing-form-wrap fieldset").index(next_fs)).addClass("active");
        next_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity,
                    'position': 'relative'
                });
            },
            duration: 1200,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'
        });
    });
    $(".back-form").on("click", function (e) {
        e.preventDefault();
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li").eq($(".bookiing-form-wrap fieldset").index(current_fs)).removeClass("active");
        previous_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function (now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = ((1 - now) * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'left': left,
                    'position': 'absolute'
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity,
                    'position': 'relative'
                });
            },
            duration: 1200,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutBack'
        });
    });	
}
//   Parallax ------------------
//function initparallax() {
//    var a = {
//        Android: function () {
//            return navigator.userAgent.match(/Android/i);
//        },
//        BlackBerry: function () {
//            return navigator.userAgent.match(/BlackBerry/i);
//        },
//        iOS: function () {
//            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
//        },
//        Opera: function () {
//            return navigator.userAgent.match(/Opera Mini/i);
//        },
//        Windows: function () {
//            return navigator.userAgent.match(/IEMobile/i);
//        },
//        any: function () {
//            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
//        }
//    };
//    trueMobile = a.any();
//    if (null === trueMobile) {
//        var b = new Scrollax();
//        b.reload();
//        b.init();
//    }
//    if (trueMobile) $(".bgvid , .background-vimeo , .background-youtube-wrapper ").remove();
//}
 //   instagram ------------------	
 //var actoket = $('#insta-content').data("instatoken");
 //var token = actoket,
 //   num_photos = 6;
 //if (token) {
 //   $.ajax({
 //       url: 'https://api.instagram.com/v1/users/self/media/recent',
 //       dataType: 'jsonp',
 //       type: 'GET',
 //       data: {
 //           access_token: token,
 //           count: num_photos
 //       },
 //       success: function (data) {
 //           for (x in data.data) {
 //               $('#insta-content').append('<a target="_blank" href="' + data.data[x].link + '"><img src="' + data.data[x].images.low_resolution.url + '"></a>');
 //           }
 //       },
 //       error: function (data) {
 //           console.log(data);
 //       }
 //   });
 //}
    //   Star Raiting ------------------
function cardRaining() {
    $.fn.duplicate = function (a, b) {
        var c = [];
        for (var d = 0; d < a; d++) $.merge(c, this.clone(b).get());
        return this.pushStack(c);
    };
    var cr = $(".card-popup-raining");
    cr.each(function (cr) {
        var starcount = $(this).attr("data-starrating");
        $("<i class='fa fa-star'></i>").duplicate(starcount).prependTo(this);
    });
}
cardRaining();
var cr2 = $(".card-popup-rainingvis");
cr2.each(function (cr) {
    var starcount2 = $(this).attr("data-starrating2");
    $("<i class='fa fa-star' style='color: #c2c2c2;' ></i>").duplicate(5 - starcount2).prependTo(this);
    $("<i class='fa fa-star'></i>").duplicate(starcount2).prependTo(this);
});
//$(".location a , .loc-act").on("click", function (e) {
//	e.preventDefault();
//$.get("http://ipinfo.io", function (response) {
//  $(".location input , .qodef-archive-places-search").val( response.city);
 
//}, "jsonp");
// });
    //$('.quantity-item').each(function() {
    //  var spinner = jQuery(this),
    //    input = spinner.find('input[type="text"]'),
    //    btnUp = spinner.find('.plus'),
    //    btnDown = spinner.find('.minus'),
    //    min = input.attr('min'),
    //    max = input.attr('max');

    //  btnUp.click(function() {
    //    var oldValue = parseFloat(input.val());
    //    if (oldValue >= max) {
    //      var newVal = oldValue;
    //    } else {
    //      var newVal = oldValue + 1;
		
    //    }
    //    spinner.find("input.qty").val(newVal);
    //    spinner.find("input.qty").trigger("change");
    //  });

    //  btnDown.click(function() {
    //    var oldValue = parseFloat(input.val());
    //    if (oldValue <= min) {
    //      var newVal = oldValue;
    //    } else {
    //      var newVal = oldValue - 1;
    //    }
    //    spinner.find("input.qty").val(newVal);
    //    spinner.find("input.qty").trigger("change");
    //  });
    //}); 
 //function initAutocomplete() {
 //           var input = document.getElementById('autocomplete-input');
 //           var autocomplete = new google.maps.places.Autocomplete(input);
 //           autocomplete.addListener('place_changed', function() {
 //             var place = autocomplete.getPlace();
 //             if (!place.geometry) {
 //               window.alert("No details available for input: '" + place.name + "'");
 //               return;
 //             }
 //           });		
 //       }
$(".notification-close").on("click", function () {
	$(this).parent(".notification").slideUp(500);
});


//var chatwidwrap = $(".chat-widget_wrap"),
//    cahtwidbutton = $(".chat-widget-button");
//    function showChat(){
//	   cahtwidbutton.addClass("closechat_btn");
//	   chatwidwrap.fadeIn(500).removeClass("not-vis-chat");
//	}
//    function hideChat(){
//	   cahtwidbutton.removeClass("closechat_btn");
//	   chatwidwrap.fadeOut(500).addClass("not-vis-chat");
//	}   
//cahtwidbutton.on("click", function () {
//     if(chatwidwrap.hasClass("not-vis-chat")){
//		 showChat();
//	}
//	else {
//	     hideChat();
//	}
//});
//   Init All ------------------
$(function () {
    initCitybook();
    //initparallax();
});

/*------extensions-------------------------------------*/
// breadcrumbs mobile more 
$('.breadcrumbs a.mobile-more').on('click', function () {
    $('.breadcrumbs > a, .breadcrumbs > span').show()
    $(this).hide()
})

// nice select back
$(document).on('click', '.nice-select-back', function () {
    $('.nice-select').removeClass('open')
    $('html').removeClass('scroll-lock')
})

// forms
//$('form#subscribe').submit(function (e) {
//    e.preventDefault()
//    var data = {
//        email: $(this).find('#subscribe-email').val()
//    }

//    if (data.email == '') {
//        $('form#subscribe .enteremail-message').removeClass('hidden').text('Obavezno je uneti email adresu!')
//        return
//    }
//    grecaptcha.ready(function () {
//        grecaptcha.execute(reCapthaSiteKey, { action: 'submit' }).then(function (token) {
//            // Add your logic to submit to your backend server here.
//            data.reCaptchaToken = token;
//            ajaxLoader()
//            $.post('/Ajax/NewsletterSubscribe', data, function (data, textStatus, jqXHR) {
//                if (data.message) {
//                    if (data.statusCode < 0) {
//                        $('form#subscribe .enteremail-message').removeClass('hidden').text(data.message)
//                    } else {
//                        $('.subscribe-message').removeClass('hidden').html(data.message)
//                        $('#subscribe-button, .enteremail-wrapper').remove()
//                    }
//                }
//            }).fail(ajaxFail)
//                .always(ajaxAlways);
//        });
//    });
//})

function ajaxLogin(data, textStatus, jqXHR) {
    if (data.status == 'Ok') {
        $('.close-reg').click()
        if (window.loginCallback != undefined && window.loginCallback == 'SendReview') {
            Swal.fire({
                text: data.message,
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Pošalji recenziju',
                cancelButtonText: 'Ok'
            }).then((promise) => {
                if (promise.isConfirmed) {
                    $('form[name=add_review]').submit()
                    window.loginReload = true
                } else {
                    window.location.reload()
                }
            })
        } else if (window.loginCallback != undefined && window.loginCallback == 'ImproveThisListing') {
            $('[name=improve_this_listing]').click()
        } else {
            $('.loader-wrap').show()
            window.location.reload()
        }

    } else if (data.status == 'Error') {
        Swal.fire({
            text: data.message,
            icon: 'error'
        })
    } else {
        ajaxFail()
    }
}

// Oauth2 login
function oauth2LoginSucceed() {
    $('.close-reg').click()
    if (window.sendReview != undefined && window.sendReview == true) {
        Swal.fire({
            title: "Uspešno ste se prijavili",
            text: "Da li želite da pošaljete recenziju?",
            showCancelButton: true,
            confirmButtonText: 'Pošalji',
            cancelButtonText: 'Odustani'
        }).then((promise) => {
            if (promise.isConfirmed) {
                $('form[name=add_review]').submit()
            } else {
                window.location.reload()
            }
        })
    } else {
        window.location.reload()
    }
}

function oauth2LoginFailed() {
    Swal.fire({
        text: "Došlo je do greške prilikom prijave.\nPokušajte ponovo.",
        icon: 'error'
    })
}

// search input on mobile
$('.show-search-button').on('click', function () {
    if ($(window).width() <= 768) {
        if (!$('.header-search input').is(':focus')) {
            setTimeout(function () {
                $('.header-search input').focus()
            }, 300)
        }
        $('.header-search-input-item .header-search-button.left-side i')
            .addClass('fa-chevron-left')
            .removeClass('fa-search')
        $('header').addClass('search-active-header')
        $('html').addClass('scroll-lock')
    }
});

// search close on mobile
$('.header-search-button.left-side').on('click', 'i.fa-chevron-left', searchClose)
function searchClose() {
    var i = $('.header-search-button.left-side i.fa-chevron-left')
    setTimeout(function () {
        $('.header-search input').blur()
        i.removeClass('fa-chevron-left')
            .addClass('fa-search')
        $('header').removeClass('search-active-header')
        $('html').removeClass('scroll-lock')
    }, 100)
}

// search input clear button
$('.header-search-button.right-side, .main-search-button')
    .on('click', 'i.fa-times', function (e) {
        if ($('.header-search-input-item input').val() == '') {
            typeof rutie != 'undefined' && routie('')
            $(this).removeClass('fa-times')
            $('.header-search-input-item .header-search-button.right-side').addClass('hidden')
        } else {
            //$('.header-search-input-item, .main-search-input-item')
            //    .removeClass('active')
            $('.header-search-input-item input, .main-search-input-item input')
                .val('').focus()
            $('.header-search-input-item .autocomplete-list, .main-search-input-item .autocomplete-list')
                .empty()
            //$searchIcons.removeClass('fa-times')
            //routie.silent('')
            $('.header-search-input-item .header-search-button.right-side').addClass('hidden')
        }
    })


// main menu
$('.main-menu-button').on('click', function () {
    $('.main-menu, header.main-header').toggleClass('vismobmenu')
    $('html').toggleClass("scroll-lock")
    $('.nav-button-wrap').toggleClass('active')
    $('.nav-button').toggleClass('fa fa-times')
    $('.to-top').remove()
});


// header
var $headerSearchInputitem = $('.header-search-input-item'),
    $headerSearchInputitemInput = $('.header-search-input-item input'),
    $searchInputs = $('.header-search-input-item input, .main-search-input-item input'),
    $headerSearchButton = $('.header-search-button.left-side'),
    $headerSearchButtonI = $('.header-search-button.left-side i'),
    $header = $('header'),
    $main = $('#main')



function iOS() {
    //return !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform)
    return /\b(iPad|iPhone|iPod)\b/.test(navigator.userAgent) && !window.MSStream
}

// header search input on focus
$searchInputs.on('focus', function (e) {
    getCurrentPosition()
    $headerSearchInputitem.addClass('active')
    $header.addClass('search-active-header')
    if (windowWidth() <= 768) {
        $('html').addClass('scroll-lock')
    }

    $('.autocomplete-list').on('scroll touchstart', hideAutocompleteKeyboard)

    if (iOS()) {
        //$header.css({ 'transform': 'TranslateY(-10000px)' })
        //setTimeout(function () { $header.css({ 'transform': 'translate3d(0,0,0)' }) }, 100)
        $header.addClass('ios-fallback')

        for (var i = 0; i < 100; i++) {
            setTimeout(function () {
                window.scrollTo(0, 0)
                document.body.scrollTo = 0
            }, i * 10)
        }
    }

    if (windowWidth() > 768 || this.value.length) {
        $headerSearchButtonI.addClass('fa-search').removeClass('fa-chevron-left')
    } else {
        $headerSearchButtonI.addClass('fa-chevron-left').removeClass('fa-search')
    }
    autocompleteInput(this)
}).on('blur', function () {
    if (windowWidth() <= 768) {
        $('html').removeClass('scroll-lock')
    }
})

//$(window).resize(function () {
//    if ($headerSearchInputitem.hasClass('active')) {
//        $autocompleteLists.css('min-height', window.innerHeight - 170 + 'px')
//        $('.debug-msg').remove()
//        $('#main').prepend(`<div class="debug-msg" style="
//                                position: absolute;
//                                top: 70px;
//                                background: #fff;
//                                z-index: 1000;
//                                padding: 15px;
//                            ">Windows resize</div>`
//        )
//    } else {
//        $autocompleteLists.css('min-height', '')
//    }
//})

//$(visualViewport).resize(function () {
//    $('.debug-msg').remove()
//    $('#main').prepend(`<div class="debug-msg" style="
//                                position: absolute;
//                                top: 70px;
//                                background: #fff;
//                                z-index: 1000;
//                                padding: 15px;
//                            ">visualViewport resize</div>`
//    )
//    if ($headerSearchInputitem.hasClass('active')) {
//        $autocompleteLists.css('min-height', visualViewport.height - 170 + 'px')
//    } else {
//        $autocompleteLists.css('min-height', '')
//    }
//})

// header search button on click
$headerSearchButton.on('click', 'i.fa-chevron-left', function () {
    if ($(this).hasClass('history-back')) {
        historyBack()
    } else {
        $headerSearchInputitem.removeClass('active')
        $autocompleteLists.css('min-height', '').empty()
        $header.removeClass('search-active-header')
        $('html').removeClass('scroll-lock')
    }
})

//set vh for mobile devices
function setViewHeight() {
    document.documentElement.style.setProperty('--c100vh', `${Math.floor(window.innerHeight*window.devicePixelRatio)/window.devicePixelRatio}px`)
}
setViewHeight()
//$(window).on('resize', setViewHeight)
//window.addEventListener('resize', setViewHeight)

// search input focus mobile
//$('.main-search-input input, .header-search input').on('focus', function () {
//    if ($(window).width() <= 768) {
//        $('.main-search-input input').blur()
//        if (!$('.header-search input').is(':focus')) {
//            setTimeout(function () {
//                $('.header-search input').focus()
//            }, 300)
//        }
//        $('.header-search-input-item .header-search-button i').addClass('fa-chevron-left')
//        $('header').addClass('active')
//        $('#main').css('overflow', 'hidden')
//    }
//    if (this.value.length) {
//        $('.header-search-button i').addClass('fa-times')
//        autocompleteInput(this)
//    }
//});

// search clear button
$('.header-search-button.left-side, .main-search-button')
    .on('click', function (e) {
        //$('.header-search-input-item, .main-search-input-item')
        //    .removeClass('active')
        //$('.header-search-input-item input, .main-search-input-item input')
        //    .val('').focus()
        //$('.header-search-input-item .autocomplete-list, .main-search-input-item .autocomplete-list')
        //    .empty()
        //$searchIcons.removeClass('fa-times')
        //routie.silent('')
    })


/* Autocomplete */
var $headerSearchButton = $('.header-search-input-item .header-search-button.left-side'),
    $headerSearchButtonR = $('.header-search-input-item .header-search-button.right-side'),
    $searchIcons = $('.header-search-input-item .header-search-button.left-side i,.main-search-input-item .main-search-button i'),
    $searchItems = $('.header-search-input-item, .main-search-input-item'),
    $autocompleteLists = $('.header-search-input-item .autocomplete-list, .main-search-input-item .autocomplete-list'),
    jqxhr

$searchInputs
    .on('input', searchInputOnInput)
    .on('keypress', searchInputOnKeypress)

$('#search').on('submit', function (e) { e.preventDefault() })

$headerSearchButton.on('click', '.fa-search', function () {
    $searchInputs.val().trim().length > 0 && doSearch($searchInputs.val()) 
})

$('.autocomplete-list').on('click', '.fill-search-input', function (e) {
    fillSearchInputOnClick(e, $searchInputs)
    //$('.autocomplete-list').off('scroll touchstart', hideAutocompleteKeyboard)
    //e.stopPropagation()
    //var data = $(e.target).closest('.search-item').data()
    //$searchInputs.val(`${data.title} , ${data.address}`).focus()
    //setTimeout(function () {
    //    $searchInputs.focus()
    //    $searchInputs.get(0).setSelectionRange(data.title.length + 1, data.title.length + 1)
    //}, 100)
})

function fillSearchInputOnClick(e, input) {
    $(e.target).closest('.search-item').closest('ul').off('scroll touchstart', hideAutocompleteKeyboard)
    e.stopPropagation()
    var data = $(e.target).closest('.search-item').data()
    var $input = $(input)
    $input.val(`${data.title} , ${data.address}`).focus()
    setTimeout(function () {
        $input.focus()
        $input.get(0).setSelectionRange(data.title.length + 1, data.title.length + 1)
        console.log($input, $input.get(0), data.title.length + 1)
    }, 100)
}

function hideAutocompleteKeyboard(e) {
    hideKeyboard($searchInputs)
    $('.autocomplete-list').off('scroll touchstart', hideAutocompleteKeyboard)
}

function hideKeyboard(element) {
    element.attr('readonly', 'readonly'); // Force keyboard to hide on input field.
    element.attr('disabled', 'true'); // Force keyboard to hide on textarea field.
    setTimeout(function () {
        element.blur();  //actually close the keyboard
        // Remove readonly attribute after keyboard is hidden.
        element.removeAttr('readonly');
        element.removeAttr('disabled');
    }, 100);
}

$('.autocomplete-list, .map-result').on('click', 'li.search-item', function () {
    var item = $(this).data()

    if (typeof logMapAnalytics != 'undefined' && item.analyticsActionId) {
        logMapAnalytics(item.analyticsActionId)
    }

    if (item.mobile && item.type == 2) {
        var hash = window.location.hash.slice(1).split('/')
        if (!hash[5]) {
            hash[5] = item.index
            routie.silent(hash.join('/'))
        } else {
            history.replaceState(null, null, '#' + hash.join('/'))
        }
        $mapResult.children().not('.search-list').remove()
        $mapResult.children('.search-list').addClass('hidden')
        switch (item.type) {
            case 0: return routieAddress(item.title, item.lat, item.lon, { searchMobile: true, flyTo: false }); break;
            case 1: return routieStreet(item.title, item.id, undefined, { searchMobile: true, flyTo: false }); break;
            case 2: return routieObject(item.title, item.id, { searchMobile: true, flyTo: false }); break;
            case 3: return routiePlace(item.title, item.id, { searchMobile: true, flyTo: false }); break;
            case 6: 
            case 7: return routieNeighbourhood(item.title, item.id, item.type, { searchMobile: true, flyTo: false }); break;
            case 8: return routieStop(item.title, item.id, { searchMobile: true, flyTo: false }); break;
            case 9: return routieTrafficRoute(item.title, item.id, item.title.split(' ')[0], 0); break;
            default: throw 'Nedefinisani tip pretrage!'; break;
        }
        
    }
    $headerSearchButtonR.addClass('hidden')
    window.location.assign(itemLink(item))
})

function itemLink(item) {

    if (item.routie)
        return item.routie

    var ll = '', z = ''

    if (item.lat && (item.lng || item.lon)) {
        ll = `/${item.lat}/${(item.lng || item.lon)}`
    } else if (typeof map != 'undefined' && map && map.getCenter) {
        ll = `/${map.getCenter().lat}/${map.getCenter().lng}`,
        z = `/${map.getZoom()}`
    }

    if (item.type == 0) {
        return `/mapa#!adresa/${(item.title.slice(0, item.title.indexOf('(') > 0 ? item.title.indexOf('(') : undefined).trim() + (item.number ? ' ' + item.number : '')).toUrlString()}-${item.address.toUrlString()}${ll}`
    } else if (item.type == 1) {
        if ($(this).find('.address.more').length) {
            return `/mapa#!ulice/${item.title.toUrlString()}/${item.code}`
        } else {
            return `/mapa#!ulica/${item.title.toUrlString()}/${item.code}`
        }
    } else if (item.type == 2) {
        if ($(this).find('.address.more').length) {
            return `/mapa#!sve-lokacije/${item.title.toUrlString()}/${item.companyid}${ll}`
        } else {
            return `/mapa#!objekat/${item.title.toUrlString()}/${item.code}`
        }
    } else if (item.type == 3) {
        return `/mapa#!mesto/${item.title.toUrlString()}/${item.code}`
    } else if (item.type == 4) {
        return `/mapa#!pretraga/${item.title.toUrlString()}${ll}${z}`
    } else if (item.type == 6) { //polygon
        return `/mapa#!komsiluk/${item.title.toUrlString()}/${item.code}/${item.type}`
    } else if (item.type == 7) { //point
        return `/mapa#!komsiluk/${item.title.toUrlString()}/${item.code}/${item.type}`
    } else if (item.type == 8) { 
        return `/mapa#!stajaliste/${item.title.toUrlString()}/${item.code}/1`
    } else if (item.type == 9) {
        return `/mapa#!${item.title.toUrlString().replace('-', '/')}-${item.address.toUrlString()}/${item.code}/0`
    } else {
        throw 'Nedefinisani tip pretrage!'
    }
}

$('.content').on('click', function () { $('.autocomplete-list').empty() })

function searchInputOnKeypress(event) {
    if (event.keyCode == 13 && $(this).val().trim().length > 0) {
        doSearch($(this).val())
    } else {
        console.log(event.keyCode)
    }
}

function latLngZoomFromSearchText(text) {
    if (!text || !text.length || !text.includes(',') || text.split(',').length < 2)
        return
    var latLngZoom = {}
    latLngZoom.lat = parseFloat(text.split(',')[0])
    if (isNaN(latLngZoom.lat) || latLngZoom.lat > 90 || latLngZoom.lat < -90)
        return
    latLngZoom.lng = parseFloat(text.split(',')[1])
    if (isNaN(latLngZoom.lng) || latLngZoom.lng > 180 || latLngZoom.lng < -180)
        return
    latLngZoom.zoom = parseInt(text.split(',')[2])
    if (isNaN(latLngZoom.zoom) || latLngZoom.zoom > 19 || latLngZoom.zoom < 8)
        latLngZoom.zoom = undefined
    return latLngZoom
}

function doSearch(searchString) {
    var latLngZoom = latLngZoomFromSearchText(searchString)
    if (latLngZoom)
        return window.location.assign(`/mapa#!koordinate/${latLngZoom.lat}/${latLngZoom.lng}/${latLngZoom.zoom || ''}`)
    var cp = itemFromStorage('currentPosition')
    if (cp) {
        return window.location.assign(`/mapa#!pretraga/${searchString.trim().toUrlString()}/${cp.lat}/${cp.lng}/16`)
    }
    var mo = mapOptionsFromStorage() || defaultMapOptions()
    window.location.assign(`/mapa#!pretraga/${searchString.trim().toUrlString()}/${mo.center.lat}/${mo.center.lng}/${mo.zoom}`)
}

function searchInputOnInput() {
    if (iOS()) {
        var ss = this.selectionStart,
            se = this.selectionEnd,
            self = this
        setTimeout(function () {
            self.setSelectionRange(ss, se)
        }, 10)
    }
    autocompleteInput(this)
}

function autocompleteInput(input, callback) {
    autocomplete($(input).val(), callback)
    $searchInputs.val($(input).val())

    if ($(input).val().length > 0) {
        $searchItems.addClass('active')
        $searchIcons
            .removeClass('fa-chevron-left')
            .addClass('fa-search')
        $headerSearchButtonR.removeClass('hidden')
    }
    else {
        if ($(window).width() <= 768) {
            $searchIcons.addClass('fa-chevron-left')
                .removeClass('fa-search')
        }
        $searchIcons.removeClass('fa-times')
        $headerSearchButtonR.addClass('hidden')
    }
}

function autocomplete(searchString, options) {

    options = options || {}

    if (jqxhr)
        jqxhr.abort()
    
    var center = (mapOptionsFromStorage() || defaultMapOptions()).center
    var ajaxData = {
        lat: center.lat,
        lon: center.lng
    }
    ajaxData.text = searchString.replace('(', '').replace(')', '').toSrLatin()

    if (!ajaxData.text) {
        processAutocompleteData({}, {
            searchVal: searchString,
            autocompleteLists: options.autocompleteLists,
            categories: options.categories
        })
        return
    }

    jqxhr = $.get("/Ajax/AutocompleteMain", ajaxData, function (data) {
        processAutocompleteData(data, {
            searchVal: searchString,
            autocompleteLists: options.autocompleteLists,
            categories: options.categories
        })
    })
}

function moreLocationLabel(number) {
    return number % 10 >= 2
        && number % 10 <= 4
        && (number % 100 < 12 || number % 100 > 14) ? ' lokacije' : ' lokacija'
}

function mapOptionsFromStorage(){
    // if browser supports localStorage
    if (localStorage && localStorage['mapOptions'] && localStorage['mapOptions'].length) {
        return JSON.parse(localStorage['mapOptions'])
    }
    return null
}

function defaultMapOptions() {
    return {
        center: { lat: 44.817946, lng: 20.456789 },
        zoom: 12
    }
}

function setMapOptionsToStorage(mapOptions){
    if (localStorage) {
        localStorage['mapOptions'] = JSON.stringify(mapOptions)
    }
}

function itemToStorage(itemName, item) {
    if (localStorage) {
        localStorage[itemName] = JSON.stringify(item)
    }
}

function itemFromStorage(itemName) {
    // if browser supports localStorage
    if (localStorage && localStorage[itemName] && localStorage[itemName].length) {
        return JSON.parse(localStorage[itemName])
    }
    return undefined
}

function processAutocompleteData(data, options) {

    options = options || {}

    var autocompleteLists = options.autocompleteLists || $autocompleteLists
    autocompleteLists.empty().on('scroll touchstart', hideAutocompleteKeyboard)

    var searchVal = options.searchVal || $('.header-search-input-item input').val()

    if (data.results) {
        data.results.forEach(function (element) {
            var proximity = 0
            if (typeof map !== 'undefined') {
                proximity = map.distance(L.latLng(element.lat, element.lng), map.getCenter())

                proximity = proximity > 1000 ?
                    proximity > 50000 ? Math.round(proximity / 1000) + 'km'
                        : Number(Math.round(proximity / 1000 + 'e1') + 'e-1') + 'km'
                    : Math.round(proximity) + 'm'
            }
            proximity = proximity.length ? $('<div />').addClass('').text(proximity) : ''

            /*if (element.label.indexOf(',') != -1 && element.label.indexOf('-') != -1) {
                element.place = element.label.split(',')[1].split(' - ')[0]
                element.street = element.label.split(',')[1].split(' - ')[1]
            } else if (element.label.indexOf(',') != -1) {
                element.place = element.label.split(',')[1]
            }
            element.label = element.label.split(',', 1)[0]*/
            element.number = data.snp.number

            var analyticsActionId = ''

            switch (element.type) {
                case 1: analyticsActionId = 2; break;
                case 2: analyticsActionId = 3; break;
                case 3: analyticsActionId = 4; break;
            }

            var iClass = element.type == 2 ? 'fa fa-map-marker-alt' :
                element.type == 1 ? 'fa fa-road' : 'far fa-dot-circle',
                iconName = element.type == 2 ? 'marker' :
                    element.type == 1 ? 'street' :
                        element.type == 8 || element.type == 9 ? 'bus' : 'place',
                more = ''//element.more ? '<div class="more address"><i class="fa fa-plus"></i>' + element.more + moreLocationLabel(element.more) + '</div>' : ''

            if (element.type == 1 && data.snp.number) {
                element.type = 0
            }

            var title = highlightStringByPattern(element.title + (element.type == 0 ? ' ' + element.number : ''), searchVal),
                address = highlightStringByPattern(element.address, searchVal)
            if (element.type == 1) {
                title = title.split(' ')
                title[title.length - 1] = `<span class="fill-search-input-wrap">${title[title.length - 1]}<i class="fill-search-input fa fa-arrow-left"></i></span>`
                title = title.join(' ')
            }

            autocompleteLists
                .append(`<li class="search-item" 
                        data-companyid="${element.companyID}" 
                        data-type="${element.type}" 
                        data-code="${element.code}"
                        data-lat="${element.lat}"
                        data-lng="${element.lng}"
                        data-title="${element.title}"
                        data-address="${element.address}"
                        data-number="${element.number || ''}"
                        data-analytics-action-id="${analyticsActionId}">  
                        <div class="search-item-label"> 
                            <div class="title">${title}</div> 
                            <div class="address">${address}</div>
                            ${more} 
                        </div> 
                        <img class="icon-list" src="/content/images/svg/icon-list/${iconName}-15.svg" />
                    </li>`)
        })
    } else if (searchHistory.length) {
        Array.from(searchHistory).reverse().forEach(function (e) {
            $autocompleteLists
                .append(`<li class="search-item" 
                    data-companyid="" 
                    data-type="4" 
                    data-code=""
                    data-lat=""
                    data-lng=""
                    data-title="${e}"
                    data-address=""
                    data-number="">  
                    <div class="search-item-label"> 
                        <div class="title">${e}</div> 
                    </div> 
                    <img class="icon-list" src="/content/images/svg/icon-list/history-15.svg" />
                </li>`)
        })
    } else {
        ['banke', 'benzinske pumpe', 'restorani', 'supermarketi', 'apoteke'].forEach(function (e) {
            $autocompleteLists
                .append(`<li class="search-item" 
                    data-companyid="" 
                    data-type="4" 
                    data-code=""
                    data-lat=""
                    data-lng=""
                    data-title="${e}"
                    data-address=""
                    data-number="">  
                    <div class="search-item-label"> 
                        <div class="title">${e}</div> 
                    </div> 
                    <img class="icon-list" src="/content/images/svg/icon-list/magnify-15.svg" />
                </li>`)
        })
    }

    if (options.categories == undefined || options.categories) {
        data.categories && data.categories.forEach(function (category) {
            autocompleteLists
                .append('<li class="search-item" data-type="4"> \
                        <div class="search-item-label"> \
                            <div class="title">' + category + '</div> \
                        </div > \
                        <i class="fa fa-map-marker-alt"></i> \
                    </li>')
        })
    }
}

function highlightStringByPattern(string, pattern) {
    var result = '',
        pattern = pattern.split(' ').map(x => x.toSrLatin().toLatin())
    string.replace('/(/g', ' ( ').replace('/)/g', ' ) ').split(' ').forEach((word) => {
        var finded = pattern.find(p => word.toLatin().startsWith(p) || word.toLatin().startsWith('(' + p))
        if (finded) {
            var len = finded.length - (finded.match(/dj/g) || []).length
            result += `<b>${word.slice(0, len)}</b>${word.slice(len, word.length)} `
        } else {
            result += `${word} `
        }
    })

    return result.replace('/ ( /g', '(').replace('/ ) /g', ')').trim()
}
/* Autocomplete end */

String.prototype.toLatin = function() {
    return this.toLowerCase().split('').map(function (char) {
        switch (char.charCodeAt()) {
            case 262:
            case 263:
            case 268:
            case 269:
                return 'c';
                break;
            case 352:
            case 353:
                return 's';
                break;
            case 381:
            case 382:
                return 'z';
                break;
            case 272:
            case 273:
                return 'dj';
                break;
            default:
                return char;
                break;
        }
    }).join('')
}

String.prototype.toSrLatin = function () {
    const langmap = {
        "А": "A",
        "Б": "B",
        "В": "V",
        "Г": "G",
        "Д": "D",
        "Ђ": "Đ",
        "Е": "E",
        "Ж": "Ž",
        "З": "Z",
        "И": "I",
        "Ј": "J",
        "К": "K",
        "Л": "L",
        "Љ": "Lj",
        "М": "M",
        "Н": "N",
        "Њ": "Nj",
        "О": "O",
        "П": "P",
        "Р": "R",
        "С": "S",
        "Т": "T",
        "Ћ": "Ć",
        "У": "U",
        "Ф": "F",
        "Х": "H",
        "Ц": "C",
        "Ч": "Č",
        "Џ": "Dž",
        "Ш": "Š",
        "а": "a",
        "б": "b",
        "в": "v",
        "г": "g",
        "д": "d",
        "ђ": "đ",
        "е": "e",
        "ж": "ž",
        "з": "z",
        "и": "i",
        "ј": "j",
        "к": "k",
        "л": "l",
        "љ": "lj",
        "м": "m",
        "н": "n",
        "њ": "nj",
        "о": "o",
        "п": "p",
        "р": "r",
        "с": "s",
        "т": "t",
        "ћ": "ć",
        "у": "u",
        "ф": "f",
        "х": "h",
        "ц": "c",
        "ч": "č",
        "џ": "dž",
        "ш": "š",
    }
    return this.replace(/[^\u0000-\u007E]/g, function (a) {
        return langmap[a] || a;
    });
}

String.prototype.toUrlString = function () {
    var urlString = this.toClassicLatin().replace(new RegExp(" ", "gm"), "-").replace(new RegExp("---", "gm"), "-").replace(new RegExp(",", "gm"), "").replace(new RegExp(":", "gm"), "").replace(new RegExp("%", "gm"), "").replace(new RegExp("&", "gm"), "").replace(new RegExp("/", "gm"), "").replace(new RegExp("\\.", "gm"), "-").replace(/\+/g, "").replace(/\(/g, "").replace(/\)/g, "")
    return encodeURIComponent(urlString)
}

String.prototype.toClassicLatin = function () {
    return this.toLowerCase().split('').map(function (char) {
        switch (char.charCodeAt()) {
            case 262:
            case 263:
            case 268:
            case 269:
                return 'c';
                break;
            case 352:
            case 353:
                return 's';
                break;
            case 381:
            case 382:
                return 'z';
                break;
            case 272:
            case 273:
                return 'dj';
                break;
            case 38:
                return 'an132';
                break;
            case 43:
                return '%2B';
                break;
            default:
                return char;
                break;
        }
    }).join('')
}



/***********************************************
    * cookie consent
    */
;(function () {
    var date = new Date(itemFromStorage('cookieConsentConfirmedDate')),
        currentDate = new Date(new Date().toDateString())
    if (isNaN(date.getTime()) || dateDifferenceInDays(date, currentDate) > 365) {
        $(
            `<div class="cookie-consent">
                <div class="cookie-message">PlanPlus.rs koristi kolačiće kako bi obezbedio nabolje korisničko iskustvo. <a href="/privatnost">Saznaj više</a></div>
                <div class="cookie-confirm btn flat-btn">Prihvatam!</div>
            </div>`
        ).appendTo('#main')
        $('.cookie-confirm').on('click', function () {
            itemToStorage('cookieConsentConfirmedDate', new Date().toDateString())
            $('.cookie-consent').remove()
        })
    }
})();
//if (!itemFromStorage('cookieConsentConfirmedDate')) {
//    $(
//        `<div class="cookie-consent">
//            <div class="cookie-message">PlanPlus.rs koristi kolačiće kako bi obezbedio nabolje korisničko iskustvo. <a href="/privatnost">Saznaj više</a></div>
//            <div class="cookie-confirm btn flat-btn">Prihvatam!</div>
//        </div>`
//    ).appendTo('#main')

//    $('.cookie-confirm').on('click', function () {
//        itemToStorage('cookieConsentConfirmedDate', 1)
//        $('.cookie-consent').remove()
//    })
//}
/************************************************/


/* page-top banner show-hide switch*/
$(window).on('scroll', function () {
    if ($(window).scrollTop() > $('.page-top').innerHeight()) {
        if (!$('.main-header').hasClass('main-header-fixed')) {
            $('.main-header').addClass('main-header-fixed');
        };
        if ($('.general-info-section').length) {
            if (!$('.general-info-section').hasClass('general-info-section-fixed')) {
                $('.general-info-section').addClass('general-info-section-fixed');
            }
        }
    } else {
        if ($('.main-header').hasClass('main-header-fixed')) {
            $('.main-header').removeClass('main-header-fixed');
        };
        if ($('.general-info-section').length) {
            if ($('.general-info-section').hasClass('general-info-section-fixed')) {
                $('.general-info-section').removeClass('general-info-section-fixed');
            }
        }
    };
});
/**/

function windowWidth() {
    return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

function windowHeight() {
    return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
}

$(function () {
    $('[name=working-hours-auto-fill-data]').each(function (i, e) {
        e.text = openingHoursLabel(getSrDate(), JSON.parse(e.dataset.openingHours), e.dataset.currentHoliday)
    })
    typeof getSrDate != 'undefined' && $(`#oppeningHours li[data-day=${getSrDate().getDay()}]`).addClass('current-day')
});

$(function () {
    $.get("/Ajax/CurrentUser", function (data, textStatus, jqXHR) {
        if (data.screenName) {
            $('body').addClass('logged-in')

            var adminLi = ''

            if (data.isAdmin) {
                adminLi = 
                    `<li class="admin-menu">
                        <a href="javascript:void(0);">Admin <i class="fa fa-caret-down"></i></a>
                        <ul class="header-user-submenu">
                            <li><a href="/Analytics/PoiProfile">Analitika</a></li>
                            <li><a href="/Dashboard/Routes">Linije</a></li>
                            <li><a href="/Dashboard/Stops">Stajališta</a></li>
                            <li><a href="/Dashboard/TemporarilyClosedObjects">Privremeno zatvoreni objekti</a></li>
                            <li><a href="/Edit/MapObject?rn=1">Neregularni objekti</a></li>
                            <li><a href="/Dashboard/Categories">Kategorije</a></li>
                            <li><a href="/Dashboard/Companies">Preduzeća</a></li>
                            <li><a href="/Dashboard/Posts">Članci</a></li>
                            <li><a href="/Dashboard/Content">Sadržaj</a></li>
                            <li><a href="/Dashboard/Sitemap">Sitemap</a></li>
                            ${typeof poi !== 'undefined' && poi.id ? `<li><a href="/Edit/Object?id=${poi.id}&companyId=${poi.companyId || ''}">Izmeni objekat<i class="fa fa-edit" style="margin-left:10px;"></i></a></li><li><a href="/Add/Object?id=${poi.id}&companyId=${poi.companyId || ''}">Kopiraj objekat<i class="fa fa-copy" style="margin-left:10px;"></i></a></li><li><a href="javascript:void(0);" onclick="deleteObjectAndReload(${poi.id})">Obriši objekat<i class="fa fa-trash-can" style="margin-left:10px;"></i></a></li>` : ''}
                            ${typeof poi !== 'undefined' && poi.companyId ?
                            `<li><a href="/Dashboard/Objects?companyId=${poi.companyId}">Objekti u preduzeću<i class="fa fa-edit" style="margin-left:10px;"></i></a></li>
                            <li><a href="/Dashboard/Advertisements?companyId=${poi.companyId}">Oglasi preduzeća<i class="fa fa-ad" style="margin-left:10px;"></i></a></li>
                            <li><a href="/Dashboard/Analytics?companyId=${poi.companyId}">Analitika za preduzeće<i class="fa fa-chart-line" style="margin-left:10px;"></i></a></li>` : ''}
                        </ul>
                     </li>`
            }

            var links = `<li><a href="javascript:void(0);">Moj profil <i class="fa fa-caret-down"></i></a>
                            <ul class="header-user-submenu">
                                <li><a href="/Edit/Account">Podešavanja</a></li>
                                <li><a href="/Dashboard/Reviews">Recenzije</a></li>
                                <li><a href="/Edit/Password">Promena lozinke</a></li>
                                <li><a href="/Edit/RemoveAccount">Brisanje profila</a></li>
                            </ul>
                        </li>
                        ${data.isVerifiedOwner ? `<li><a href="javascript:void(0);">Moja firma <i class="fa fa-caret-down"></i></a>
                            <ul class="header-user-submenu">
                                <li><a href="/Dashboard/Analytics">Analitika</a></li>
                                <li><a href="/Dashboard/Advertisements">Oglasi</a></li>
                                <li><a href="/Dashboard/Objects">Objekti</a></li>
                                <li><a href="/Dashboard/ObjectsReviews">Recenzije</a></li>
                                <li class="hidden"><a href="/Dashboard/Settings">Podešavanja</a></li>
                            </ul>
                        </li>` : ''}
                        ${adminLi}
                        <li><a href="/Account/LogOff?returnUrl=${isPost ? '/' : encodeURIComponent(location.pathname + location.search)}">Odjavi se</a></li>`

            $('#headerUserMenu').append(
                `<div class="header-user-menu-wrap">
                    <div class="header-user-menu">
                        <div class="header-user-name">
                            <span><img src="${data.imageUrl}" alt="${data.screenName}"></span>
                            ${data.screenName}
                        </div>
                        <ul>
                            ${links}
                        </ul>
                    </div>
                </div>`
            )

            $('.main-menu nav ul').append(adminLi)

            $('#logInOut').append(
                `<li class="post-author">
                    <img src="${data.imageUrl}" alt="${data.screenName}">
                    <span>${data.screenName}</span>
                </li>
                ${links}`
            )
        } else {
            $('<div class="show-reg-form modal-open"><i class="fa fa-user fa-regular"></i>Prijavi se</div>')
                .on('click', function (e) {
                    e.preventDefault()
                    $('#main').append(`<iframe src="/account/signin?returnUrl=${returnUrl}" class="main-register-wrap modal" />`)
                    $('.modal').fadeIn()
                    $("html, body").addClass("hid-body")
                })
                .appendTo($('#headerUserMenu'))

            $('#logInOut').append(
                '<li><a href="#" class="login-link">Prijavi se</a></li>'
            )
        }

        function mobMenuInit() {
            var ww = $(window).width();
            ww = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            if (ww < 1180 || $('.main-header.map').length) {
                $(".menusb").remove();
                $(".main-menu").removeClass("nav-holder");
                $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
                $(".menusb").menu();
            } else {
                $(".menusb").remove();
                $(".main-menu").addClass("nav-holder");
            }
        }
        mobMenuInit();
        $(window).on("resize", function () {
            mobMenuInit();
        });

        if (data.isAdmin && typeof map != 'undefined' && map.contextmenu && map.options && map.options.addObjectControl) {
            map.contextmenu.addItem({
                text: 'Kreiraj novi objekat',
                callback: function (e) {
                    window.open(`/Add/Object?lat=${e.latlng.lat}&lng=${e.latlng.lng}`)
                }
            })
            map.contextmenu.addItem({
                text: 'Kreiraj novo stajalište',
                callback: function (e) {
                    window.open(`/Add/Stop?lat=${e.latlng.lat}&lng=${e.latlng.lng}`)
                }
            })
            map.contextmenu.addItem({
                text: 'Promeni mapu',
                callback: function (e) {
                    switchMapLayer()
                }
            })
        }

        $.get(`/Ajax/GetPosts`, function (data) {
            var mlvd = new Date(itemFromStorage('magazineLastVisitedDate')),
                cd = new Date(new Date().toDateString()),
                newPostsCount = 0
            data.posts.forEach(function (p) {
                var pd = new Date(p.date)
                if (dateDifferenceInDays(pd, cd) <= 7 && (isNaN(mlvd.getTime()) || (pd.getTime() - mlvd.getTime()) > 0)) {
                    newPostsCount++
                }
            })
            if (newPostsCount) {
                $('.num-new-posts').text(newPostsCount).show()
            }
        })
    })
});

function dateDifferenceInDays(fdate, sdate) {
    if (isNaN(fdate.getTime()) || isNaN(sdate.getTime()))
        return undefined
    return Math.abs(fdate.getTime() - sdate.getTime()) / (1000 * 3600 * 24)
}

/************* tool-tip **************/

$(function () {
    function tooltipBottom(element, container) {
        if ($(window).scrollTop() + windowHeight() * 0.25 < $(element).offset().top) {
            return ($(container).outerHeight() + $(container).offset().top - $(element).offset().top + 10) + 'px'
        } else {
            return 'unset'
        }
    }
    function tooltipTop(element, container) {
        if ($(window).scrollTop() + windowHeight() * 0.25 < $(element).offset().top) {
            return 'unset'
        } else {
            return ($(element).offset().top - $(container).offset().top + $(element).height() + 10) + 'px'
        }
    }
    function tooltipLeft(element, container, tooltipWidth) {
        if ($(element).offset().left + $(element).width() / 2 > tooltipWidth / 2
            && $(element).offset().left + $(element).width() / 2 + tooltipWidth / 2 < windowWidth()
        ) {
            return $(element).offset().left - $(container).offset().left - (tooltipWidth - $(element).width()) / 2
        } else if ($(element).offset().left > 20 && $(element).offset().left - 20 + tooltipWidth < windowWidth()) {
            return $(element).offset().left - $(container).offset().left - 20
        } else if ($(element).offset().left + $(element).width() + 20 < windowWidth() && $(element).offset().left + $(element).width() + 20 > tooltipWidth) {
            return $(element).offset().left - $(container).offset().left + $(element).width() + 20 - tooltipWidth
        }
        return 0
    }
    function tooltipArrowLeft(element, container, tooltipWidth) {
        if ($(element).offset().left + $(element).width() / 2 > tooltipWidth / 2
            && $(element).offset().left + $(element).width() / 2 + tooltipWidth / 2 < windowWidth()
        ) {
            return tooltipWidth / 2 - 7
        } else if ($(element).offset().left > 20 && $(element).offset().left - 20 + tooltipWidth < windowWidth()) {
            return 20
        } else if ($(element).offset().left + $(element).width() + 20 < windowWidth() && $(element).offset().left + $(element).width() + 20 < tooltipWidth) {
            return $(element).offset().left - $(element).width() / 2
        } else if ($(element).offset().left + $(element).width() + 20 < windowWidth()) {
            return 270
        }
        return 10
    }
    function tooltipArrowClass(element, container) {
        if ($(window).scrollTop() + windowHeight() * 0.25 < $(element).offset().top) {
            return ''
        } else {
            return 'up'
        }
    }
    var bsTimeout;
    $('[tooltip-html]').mouseover(function () {
        clearTimeout(bsTimeout)
        $('.tooltip-box').remove()
        var $t = $('<div class="tooltip-box">' + $(this).attr('tooltip-html') + '</div>').css('visibility', 'hidden')
        var $p = $(this).closest('[tooltip-container]')
        $t.appendTo($p)
        var tooltipWidth = $t.outerWidth()
        $t.remove()
        $(`<div style="top: ${tooltipTop(this, $p)};bottom: ${tooltipBottom(this, $p)};left: ${tooltipLeft(this, $p, tooltipWidth)}px;" class="tooltip-box"><i class="tooltip-box-arrow ${tooltipArrowClass(this, $p)}" style="left: ${tooltipArrowLeft(this, $p, tooltipWidth)}px;"></i>${$(this).attr('tooltip-html')}</div>`)
            .appendTo($p)
            .mouseover(function () {
                clearTimeout(bsTimeout)
            })
            .mouseleave(function () {
                bsTimeout = setTimeout(function () {
                    $('.tooltip-box').remove()
                }, 1000)
            })
    })
    $('[tooltip-html]').mouseleave(function () {
        bsTimeout = setTimeout(function () {
            $('.tooltip-box').remove()
        }, 1000)
    })
    $('[click-tooltip-html]').on('click', function () {
        $('.tooltip-box').remove()
        var $t = $('<div class="tooltip-box">' + $(this).attr('click-tooltip-html') + '</div>').css('visibility', 'hidden')
        var $p = $(this).closest('[tooltip-container]')
        $t.appendTo($p)
        var tooltipWidth = $t.outerWidth()
        $t.remove()
        $(`<div style="top: ${tooltipTop(this, $p)};bottom: ${tooltipBottom(this, $p)};left: ${tooltipLeft(this, $p, tooltipWidth)}px;" class="tooltip-box"><i class="tooltip-box-arrow ${tooltipArrowClass(this, $p)}" style="left: ${tooltipArrowLeft(this, $p, tooltipWidth)}px;"></i>${$(this).attr('click-tooltip-html')}</div>`)
            .appendTo($p)
    })
    $(document).on('click.outside-tooltip-box', function(event) {
        if ($(event.target).closest('[click-tooltip-html], [tooltip-html]').length === 0) {
             $('.tooltip-box').remove()
        }
    })
});

/************* tool-tip end **************/

/************** ajax *********************/

function ajaxFail() {
    Swal.fire({
        text: 'Greška!!!',
        icon: 'error'
    })
}

function ajaxAlways() {
    $(".loader-wrap").removeClass('bg-transparent').fadeOut(300, function () {
        $("#main").animate({
            opacity: "1"
        }, 300);
    });
}

function ajaxLoader() {
    $('.loader-wrap').addClass('bg-transparent').fadeIn(300, function () {
        $("#main").animate({
            opacity: "1"
        }, 300);
    })
}

/************** ajax end *********************/

// delete object
function deleteObject(id, statusOkCallback) {
    Swal.fire({
        text: 'Izabrali ste opciju za brisanje objekta! Da li ste sigurni da želite da nastavite?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Nastavi',
        cancelButtonText: 'Odustani'
    }).then(promise => {
        if (promise.isConfirmed) {
            Swal.fire({
                title: 'Pojasnite razlog brisanja:',
                input: 'radio',
                inputOptions: {
                    'Objekat ne postoji.': 'Objekat ne postoji.',
                    'Objekat je trajno zatvoren.': 'Objekat je trajno zatvoren.',
                    'Objekat je duplikat.': 'Objekat je duplikat.'
                },
                inputValidator: (value) => {
                    if (!value) {
                        return 'Izaberi razlog za brisanje objekta!'
                    }
                },
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Obriši',
                cancelButtonText: 'Odustani'
            }).then(promise => {
                if (promise.isConfirmed) {
                    ajaxLoader()
                    $.get('/Ajax/DeleteObject', { id: id, message: promise.value }, function (data, textStatus, jqXHR) {
                        if (data.status) {
                            Swal.fire({
                                text: data.message,
                                icon: data.status == 'Ok' || data.status == 'RequestSent' ? 'success'
                                    : data.status == 'SessionEnd' || data.status == 'PermissionDenied' ? 'warning'
                                        : data.status == 'DoesNotExist' ? 'info'
                                            : 'error' // Error, Unknown
                            }).then((value) => {
                                if (data.status == 'Ok') {
                                    if (typeof statusOkCallback === 'function') {
                                        statusOkCallback()
                                    }
                                }
                            })
                        } else {
                            ajaxFail()
                        }
                    })
                        .fail(ajaxFail)
                        .always(ajaxAlways)
                }
            })
        }
    })
}

// delete object from menu
function deleteObjectAndReload(id) {
    deleteObject(id, function () {window.location.reload()})
}


/************* micro banner section **************/

$(function () {
    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return Math.ceil(elementBottom) > viewportTop && Math.ceil(elementTop) < viewportBottom;
    };

    if ($('section.micro-banner').length) {
        reOrderMicroBanners($('section.micro-banner ul'))
        setInterval(function () {
            reOrderMicroBanners($('section.micro-banner ul'))
        }, 30000)
    }

    function reOrderMicroBanners(ulElement) {
        var ulLength = $(ulElement).find('li').length
        $(ulElement).find('li').each(function (i, e) {
            $(e).css('order', Math.floor(Math.random() * ulLength))
        })
        var $visible = $(ulElement).find('li').filter((i, e) => $(e).isInViewport())
        $visible
            .filter((i, e) => $(e).attr('data-viewed') != 'true')
            .each((i, e) => {
                gtag('event', 'micro_banner_impression', {
                    id: $(e).data().id
                })
                gtag('event', 'micro_banner_view', {
                    id: $(e).data().id
                })
            })
        $visible.each((i, e) => $(e).attr('data-viewed', 'true'))
    }
});

function microBannerClick(microBannerId) {
    if (typeof logMapAnalytics != 'undefined') {
        logMapAnalytics(14)
    }
    gtag('event', 'micro_banner_click', {
        id: microBannerId
    })
}

/************* micro banner section end **************/


var searchHistory = [];

if (localStorage && localStorage['searchHistory'] && localStorage['searchHistory'].length) {
    searchHistory = JSON.parse(localStorage['searchHistory'])
}

$(function () {
    var closedNotifications = []
    if (localStorage && localStorage['closedNotifications'] && localStorage['closedNotifications'].length) {
        closedNotifications = JSON.parse(localStorage['closedNotifications'])
    }
    // notification
    $.get('/Ajax/GetGeneralNotifications', function (data, textStatus, jqXHR) {
        if (data.length) {
            var notifications = ''
            data.forEach(function (n) {
                if (!closedNotifications.includes(n.id.toString())) {
                    notifications += $(n.html).attr('data-id', n.id).get(0).outerHTML
                }
            })

            if (notifications.length) {
                console.log(notifications)
                if ($('body.map').length) {
                    $('<div/>').addClass('general-notification-box')
                        .append('<i class="fa fa-close close-general-notification"></i>')
                        .append(notifications)
                        .appendTo('.map .map-container')
                } else {
                    $('<section/>').addClass('general-notification-section')
                        .append('<i class="fa fa-close close-general-notification"></i>')
                        .append(notifications)
                        .appendTo('#wrapper > .content')
                }

                $('.close-general-notification').on('click', function () {
                    $(this).siblings().each(function (i, e) {
                        closedNotifications.push($(e).attr('data-id'))
                    })
                    if (localStorage) {
                        localStorage['closedNotifications'] = JSON.stringify(closedNotifications)
                    }
                    $(this).parent().remove()
                })
            }
        }
    })
});


/* page-top banner show-hide switch wrapper padding-top class because of map rendering */
$(function () {
    if ($('.map-container.column-map').length && windowWidth() > 768) {
        $(window).on('scroll', function () {
            if ($(window).scrollTop() + $(window).height() > $('footer').offset().top) {
                $('.map-container.column-map').css({
                    position: 'absolute',
                    bottom: '0px',
                    top: 'unset'
                });
            } else if ($(window).scrollTop() > $('.page-top').innerHeight()) {
                $('.map-container.column-map').css({
                    position: 'fixed',
                    top: '60px'
                });
            } else {
                $('.map-container.column-map').css({
                    position: 'absolute',
                    top: '0px'
                });
            };
        });
    }
});
/**/

/* geolocation */
function getCurrentPosition() {
    navigator.geolocation.getCurrentPosition(e => {
        itemToStorage('currentPosition', { lat: e.coords.latitude, lng: e.coords.longitude })
    });
};
/* geolocation end */


/* analytics */
function objectPhoneClick(objectId, categoryCode, categoryName, placeCode, placeName) {
    gtag('event', 'object_phone_click', {
        place_code: placeCode,
        place_name: placeName,
        category_code: categoryCode,
        category_name: categoryName,
        id: objectId
    })
}
/* analytics end */

/* webp check */
// check_webp_feature:
//   'feature' can be one of 'lossy', 'lossless', 'alpha' or 'animation'.
//   'callback(feature, result)' will be passed back the detection result (in an asynchronous way!)
function check_webp_feature(feature, callback) {
    var kTestImages = {
        lossy: "UklGRiIAAABXRUJQVlA4IBYAAAAwAQCdASoBAAEADsD+JaQAA3AAAAAA",
        lossless: "UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==",
        alpha: "UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAARBxAR/Q9ERP8DAABWUDggGAAAABQBAJ0BKgEAAQAAAP4AAA3AAP7mtQAAAA==",
        animation: "UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA"
    };
    var img = new Image();
    img.onload = function () {
        var result = (img.width > 0) && (img.height > 0);
        callback(feature, result);
    };
    img.onerror = function () {
        callback(feature, false);
    };
    img.src = "data:image/webp;base64," + kTestImages[feature];
}

//check_webp_feature('lossy', webpFeatureCallback)

//check_webp_feature('lossless', webpFeatureCallback)

//check_webp_feature('alpha', webpFeatureCallback)

//check_webp_feature('animation', webpFeatureCallback)

function webpFeatureCallback(feature, result) {
    if (!result) {
        alert('Webp feature "' + feature + '" nije podržan!!!')
    }
}
/* webp check end*/