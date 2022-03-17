var ww = document.body.clientWidth;
var wh = document.body.clientHeight;
var data;
var options = {useEasing: false, useGrouping: true, separator: '', decimal: '', prefix: '', suffix: ''};
if ($("#c1").length) {
    var numAnim = new CountUp("c1", 0, 5, 0, 5, options);
    numAnim.start();
}
if ($("#c2").length) {
    var numAnim = new CountUp("c2", 0, 10, 0, 5, options);
    numAnim.start();
}
if ($("#c3").length) {
    var numAnim = new CountUp("c3", 0, 18, 0, 4, options);
    numAnim.start();
}
$(window).on('scroll', function () {
    var offset = $('.b-ayshe-headphones__sliding-block').offset();
    if ($(offset).length) {
        if ($(window).scrollTop() > offset.top - (wh / 2)) {
            $('.b-ayshe-headphones__sliding-block').addClass('sliding-headphones');
        }
    }
    var redBorder1 = $('.b-ayshe__programme--pic__container.first-pic').offset();
    if ($(redBorder1).length) {
        if ($(window).scrollTop() > redBorder1.top - (wh / 2)) {
            $('.b-ayshe__programme--pic__container.first-pic').css('display', 'block');
        }
    }
    var redBorder2 = $('.b-ayshe__programme--pic__container.second-pic').offset();
    if ($(redBorder2).length) {
        if ($(window).scrollTop() > (redBorder2.top) - (wh / 2)) {
            $('.b-ayshe__programme--pic__container.second-pic').css('display', 'block');
        }
    }
    var redBorder3 = $('.b-ayshe__programme--pic__container.third-pic').offset();
    if ($(redBorder3).length) {
        if ($(window).scrollTop() > (redBorder3.top) - (wh / 2)) {
            $('.b-ayshe__programme--pic__container.third-pic').css('display', 'block');
        }
    }
    var doubts = $('.b-ayshe__red-inner p').offset();
    if ($(doubts).length) {
        if ($(window).scrollTop() > (doubts.top) - wh) {
            $('.b-ayshe__red-inner p').addClass('fadeInRight');
            $('.b-ayshe__red-inner a').addClass('fadeInLeft');
        }
    }
});
$(window).on("scroll", function () {
    if (ww > 768) {
        $('.b-ayshe-header__main-nav').toggleClass("bg", $(this).scrollTop() > 50);
        $('.b-header-container-fluid').toggleClass("margin", $(this).scrollTop() > 50);
        $('.img-brand').toggleClass("brand", $(this).scrollTop() > 50);
        $('.b-header-navbar').toggleClass("bg", $(this).scrollTop() > 50);
        $('.b-header-navbar-toggle.navbar-toggle').toggleClass("ham", $(this).scrollTop() > 50);
    } else {
        $('.b-ayshe-header__main-nav').removeClass('navbar-fixed-top');
        $('.b-ayshe-bottom-header').css('margin-top', '40px');
    }
});
$(document).click(function (event) {
    if ($(event.target).closest('.flexMenu-viewMore').length == 0 && $(event.target).attr('class') != 'flexMenu-popup') {
        $(".flexMenu-viewMore").removeClass("active");
        $(".flexMenu-popup").css("display", "none");
    }
});
$('#home li:not(.flexMenu-viewMore)').click(function () {
    $(".flexMenu-popup").css("display", "none");
});
$(window).on('scroll', function () {
    if ($(window).scrollTop() > 50) {
        $('.b-ayshe-hidden-menu').addClass('fixed').fadeIn('fast');
    } else {
        $('.b-ayshe-hidden-menu').removeClass('fixed').fadeOut('fast');
    }
});
$('.b-ayshe-header-ul li a').click(function () {
    $('html, body').animate({scrollTop: $($(this).attr('href')).offset().top}, 1000);
    return false;
});
$('#b-ayshe-header .b-ayshe-header-ul li a').click(function () {
    $('#b-ayshe-header .b-ayshe-header-ul li a').removeClass('active');
    $(this).addClass('active');
});
var height = $(window).height();
if (height < 674) {
    $('.b-ayshe-header-main-heading').css({'font-size': '44px', 'line-height': '44px'});
}
$('.b-courses-sing-up-hidden-tip').hide();
$('#switch-currency_form').click(function () {
    var curr = ($('#switch-currency_form select :selected').val());
    if (curr === 'uah') {
        $('#five-uah').show();
        $('#five-usd').css('display', 'none');
        $('#eight-uah').show().siblings('.b-ayshe-bottom-header--sign-up p span').css('display', 'none');
    }
    if (curr === 'usd') {
        $('#five-uah').css('display', 'none');
        $('#five-usd').css('display', 'block');
        $('#eight-usd').css('display', 'inline-block').siblings('.b-ayshe-bottom-header--sign-up p span').css('display', 'none');
    }
});
$(document).ready(function () {

    if($('#tribe-events-content ul.tribe-events-sub-nav').length>0){
        $( "#tribe-events-content ul.tribe-events-sub-nav" ).clone().appendTo( "#tribe-events-content-wrapper" );
    }

    var first_tags = $('.completed-courses .tagit input');
    if (first_tags.val() == '') {
        first_tags.attr('placeholder', 'Выберите хотя бы 1 курс');
    }
    first_tags.on('focus', function () {
        first_tags.removeAttr('placeholder');
    });
    $('.btn-add-education').on('click', function () {
        $('#second-step-btn').css('margin-top', 40);
    });
    $('.b-level-course-list-table_header--btn-right').click(function () {
        $("html, body").animate({scrollTop: 0}, 400);
        return false;
    });
    $('input[type="tel"]').inputmask({mask: "+\\9 (999) 999 9999", clearMaskOnLostFocus: false});
    $(".ui-widget-content .ui-autocomplete-input").inputmask("Regex");
    $(".dayCourse tr.no").each(function (e) {
        if ($(this).next().hasClass("no") && !($(this).hasClass('blue')) && !($(this).hasClass('green')) && !($(this).hasClass('orange')) && !($(this).hasClass('lblue')) && !($(this).hasClass('purl')) && !($(this).hasClass('yellow')) && !($(this).hasClass('pink')) && !($(this).hasClass('hucki')) && !($(this).hasClass('aqua')) && !($(this).hasClass('passion'))) $(this).css('display', 'none');
    });
    if (ww < 768) {
        $('table.orenda_grid td').css('display', 'block');
        $('table.orenda_grid:first').after($('table.orenda_grid td[rowspan]'));
        $(' td[rowspan] a').css({
            "display": "block",
            "height": "50px",
            "width": "100%",
            "border-radius": "5px",
            "background": "#0CAC7C",
            "text-align": "center",
            "line-height": "50px",
            "text-decoration": "none",
            "color": 'white',
            "margin": "10px auto"
        })
    }
    $(window).hashchange(function () {
        var hash = location.hash;
        var res = (hash.replace(/^#!\//, '') || 'blank');
        if (res == 'blank') {
            $('.close-button.close-button--show').trigger('click');
        }
    });
    $('#flex li a').each(function () {
        if ($(this).next().length > 0) {
            $(this).addClass("parent");
        }
    });
    $('li[role="presentation"]').on('click', function () {
        setTimeout(function () {
            $("div.priceZone").pin({containerSelector: "#dayContent", minWidth: 940});
        }, 200);
    });
    $(".navbar-toggle").click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('body').removeClass('show-callback');
            $('.phone-list .phones').addClass('single');
        }
        $('#flex').toggle();
    });
    adjustMenu();
    data = browserDetectNav();
    if (data[0] == 'Firefox') {
        //$(".timeTableCourses.dayCourse").addClass('moz');
        //$('#dd, #dd1').css('display', 'none');
        $('.timeTableCourses.dayCourse td').css('padding', '7px');
    }
});
// let windowWidth = $(window).width();
let resizeHeaderFix = function resizeHeaderFix () {
    if ($(window).width() >= 768) {
        $("body > .content").css("padding-top",($("#header > .container").height() + $("#bs-example-navbar-collapse-1").height())+'px');
    } else {
        $("body > .content").css("padding-top", "");
    }
};
$(window).resize(resizeHeaderFix);
// $(window).scroll(resizeHeaderFix);
$(window).load(resizeHeaderFix);
$(".en-page-banner").height($(window).height());
$(".en-banner-scroll").click(function () {
    $('html, body').animate({scrollTop: $("#en-content").offset().top - 30}, 1000);
});
$(window).bind('resize orientationchange', function () {
    ww = document.body.clientWidth;
    adjustMenu();
});
var adjustMenu = function () {
    if (ww <= 767) {
        $("#header .navbar-toggle").css("display", "inline-block");
        if (!$("#header .navbar-toggle").hasClass("active")) {
            $("#flex").hide();
        } else {
            $("#flex").show();
        }
        // $("#flex li").unbind('mouseenter mouseleave');
        // var menuElems = $('#flex > li');
        // $("#flex li a.parent").unbind('click').bind('click', function (e) {
        //     e.preventDefault();
        //     var parent = $(this).parent("li")[0];
        //     $(parent).toggleClass("hover");
        //     menuElems.each(function (i, e) {
        //         $(e).find('a').removeClass('colorB');
        //         if (e !== parent) {
        //             $(e).removeClass('hover');
        //         } else if (!$(parent).hasClass('hover')) {
        //             $(parent).find('a').addClass('colorB');
        //         }
        //     });
        // });
    } else if (ww > 767) {
        // $("#header .navbar-toggle").css("display", "none");
        // $("#flex").show();
        // $("#flex li").removeClass("hover");
        // $("#flex li a").unbind('click');
        // $("#flex li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function () {
        //     $(this).toggleClass('hover');
        // });
    }
};
$(window).load(function () {
    setTimeout(function(){
        $('[src="https://itea.ua/wp-content/themes/new-it/relize/img/icons/bd.png"]').addClass('img-oracle');
        $('[src="https://itea.ua/wp-content/themes/new-it/relize/img/icons/windows.png"]').addClass('img-windows');
        if ($(document).width() > 768) {
            var hei = 0;
            $(".timeTableCourses.dayCourse tr.infoRow").each(function () {
                hei = ($(this).height() > hei) ? $(this).height() : hei;
            });
            $(".timeTableCourses.dayCourse tr.infoRow").height(hei);
            if (data[0] != 'Firefox') {
                $(".timeTableCourses.dayCourse tr:not(.infoRow)").each(function () {
                    var hei = 0;
                    var curHei, curHei1, curHei2;
                    curHei = $(this).height();
                    $(this).find('td:nth-of-type(2)').each(function () {
                        curHei1 = $(this).height();
                        $(this).find('> *').each(function () {
                            curHei2 = $(this).height();
                            hei = (curHei2 > hei) ? curHei2 : hei;
                        });
                    });
                    hei = (curHei > hei) ? curHei : hei;
                    $(this).find('td').height(hei);
                });
            }
        } else {
            $(".timeTableCourses.dayCourse tr:not(.infoRow) td").each(function () {
                if ($(this).html() == "" || $(this).html() == "<span></span>" || $(this).text() == "") {
                    $(this).css('display', 'none');
                }
                ;
            });
        }
        var wind_he = $(window).height();
        var hed_foot = $('#header').height() + $('#footer').height() - 20;
        $('body > div.content').css('min-height', wind_he - hed_foot);
        $('.placeholder').css({'height': wind_he - 150});
        $('#TwoListsCourses a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $('ul.filter').flexMenu();
        $('.content #filter').flexMenu();

        var $container = $('#container');

        function val_coursHeight() {
            function getMaxOfArray(numArray) {
                return Math.max.apply(null, numArray);
            }

            var heights = [];
            var block = $('.val_cours');
            if (block.hasClass('reg')) return;
            if (block) {
                block.each(function () {
                    heights.push($(this).height());
                });
                block.height(getMaxOfArray(heights));
            }
        }

        function isoLinkHeight() {
            function getMaxOfArray(numArray) {
                return Math.max.apply(null, numArray);
            }

            var heights = [];
            var block = $('#course a.isoLink[role]');
            if (block) {
                block.each(function () {
                    heights.push($(this).height());
                });
                block.height(getMaxOfArray(heights));
            }
        }

        isoLinkHeight();
        val_coursHeight();
        $('select').dropdown();
        var acordionBtn = $('#timeTableButtons .moreInfo');
        var acorCondition = true;
        acordionBtn.on('click', function () {
            var acordion = $(this).parents('#timeTableButtons').find('.accordion');
            $(this).toggleClass('active');
            acordion.toggleClass('active');
            var tAc = $(this).parents('#timeTableButtons').find('p.mainPage');
            var valAc = (acorCondition) ? 'Скрыть' : 'Показать больше';
            acorCondition = !acorCondition;
            tAc.html(valAc);
        });
        // $("div.courseSideBar").pin({containerSelector: "#contForSide", minWidth: 940});
        $("div.priceZone").pin({containerSelector: "#dayContent", minWidth: 940});
        $('.search-block').css({'display': 'none'});
        $('.search-function span').removeClass('close-search').addClass('open-search');
        $('.search-function span').bind('click', function () {
            console.log($('.search-function span').hasClass('close-search'));
            if ($(this).hasClass('close-search')) {
                console.log($(this));
                $('.search-block').css({'display': 'none'});
                $('.search-function span').removeClass('close-search').addClass('open-search');
            } else if ($(this).hasClass('open-search')) {
                console.log("-");
                $('.search-block').css({'display': 'block'});
                $('.search-function span').removeClass('open-search').addClass('close-search');
            }
        });
        if ($('.open_select_course')[0]) {
            $('.open_select_course').bind('click', function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
            });
        }
        if ($('.open-hidden-block')[0]) {
            $('.open-hidden-block').bind('click', function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
            });
            $('#full-time').css({'display': 'block'});
            $('#full-time-link').mouseover(function () {
                $('#full-time').css({'display': 'block'});
                $(this).addClass('active');
                $('#evening-link').mouseover(function () {
                    $('#full-time').css({'display': 'none'});
                    $('#full-time-link').removeClass('active');
                });
            });
            $('#evening-link').mouseover(function () {
                $('#evening').css({'display': 'block'});
                $(this).addClass('active');
                $('#full-time-link').mouseover(function () {
                    $('#evening').css({'display': 'none'});
                    $('#evening-link').removeClass('active');
                });
            });
        }
        if ($('#flb-lightbox-content')[0]) {
            $('#flb-lightbox-content img').css({'max-width': '400px', 'max-height': '300px'});
            $('.gallery-item').css({'margin': '0'});
        }
        if ($('.tabs_section')[0]) {
            $(".name_cource .fixed_block_name").pin({containerSelector: ".name_fixed"});
            $('.tabs_section .tabs_box').css({'display': 'none'});
            $('.tabs_section .tabs_box.visible').css({'display': 'block'});
            $(".tabs_box:not(.visible)").css({'display': 'none'});
        }
        if ($('.desc-course-full-time')[0]) {
            $(".desc-course-full-time .fixed-courses-block-full-time").pin2({
                containerSelector: ".full-desc-course-full-time",
                minWidth: 280,
                minHeight: 1000
            });
        }
        $('.link_wrap').click(function (event) {
            return false;
        });
        if ($('.date-rent-order')[0]) {
            $('.date-rent-order').click(function () {
                if (!$(this).hasClass('active')) {
                    $(this).addClass('active');
                    $('#calendar-rent-order').css({"display": "block"});
                    $('#calendar-rent-order').datepicker({
                        firstDay: 1,
                        altField: '#dateBron',
                        altFormat: 'yy-mm-dd',
                        hightlight: {format: "yy-mm-dd", values: [], settings: {}}
                    });
                } else {
                    $(this).removeClass('active');
                    $('#calendar-rent-order').css({"display": "none"});
                }
            });
        }
        if ($('.form_order')[0]) {
            $('.form_order label span strong').parent().next().focusout(function () {
                if ($(this).val() == '') $(this).css({'border-color': '#cc0000'}); else if ($(this).val() != '') $(this).css({'border-color': '#167A38'}); else {
                    $(this).css({'border-color': '#D3D3D3'});
                    $(this).focus(function () {
                        $(this).css({'border-color': '#00A1AB'});
                    });
                }
            });
            $(".form_order input[value='']").css({'color': '#aaa'});
            $(".form_order input[type='text'],.form_order input[type='email'],.form_order input[type='tel']").keypress(function () {
                $(this).css({'color': '#222'});
            });
        }
        if ($('.children_course')[0]) {
            $('.children_course').parent().siblings('.course_list').css({'display': 'none', 'width': '100%'});
            $('.children_course').click(function () {
                if ($(this).hasClass('active')) {
                    $(this).find('.cost_skype_block').css({'display': 'none', 'width': '100%'});
                    $(this).parent().siblings('.course_list').css({'display': 'none'});
                } else {
                    $(this).parent().siblings('.course_list').css({'display': 'table'});
                    $(this).next('.hidden-block').find('.cost_skype_block').css({'display': 'block', 'width': '100%'});
                }
            });
        }
        if ($('.profi-course')[0]) {
            $('.profi-course').parent('.skype-block-left').parent('.skype-block').parent('.cost_skype_block').parent('.hidden-block').parent('.tabs-course').find('.children_course').empty();
            $('.profi-course').parent('.skype-block-left').parent('.skype-block').parent('.cost_skype_block').parent('.hidden-block').empty();
        }
        if ($(".name-course")[0]) {
            $(".name-course").next('.hidden-block').find('.skype-block-left').find(".lector").appendTo($(".name-course.active").next('.hidden-block').find('.lector-course'));
            $('.name-course').click(function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).find('.plus-icon').removeClass('active');
                    $(this).find('.right').text('Развернуть');
                    $(this).parent().removeClass('active');
                    $(this).parent().find('.hidden-block').slideUp(500);
                    $('html, body').animate({scrollTop: $('table').offset().top + 100}, 1000);
                } else {
                    $(this).find('.plus-icon').addClass('active');
                    $(this).find('.right').text('Свернуть');
                    $(this).addClass('active');
                    $(this).parent().addClass('active');
                    $(this).next('.hidden-block').slideDown(500);
                    $('html, body').animate({scrollTop: $('table').offset().top + 50}, 1000);
                }
            });
            $(".lector").css({'display': 'none'});
        }
        if ($('.okoverf')[0]) {
            $('.okoverf').addClass('overlay');
        }
        if ($('#okoverf2')[0]) {
            $('#okoverf').addClass('overlay');
        }
        if ($('.ico-course-evening')[0]) {
            $('.ico-course-evening').hover(function () {
                $(this).find('img').attr('src', $(this).find($('.ico-course-link-active')).text());
            }, function () {
                $(this).find('img').attr('src', $(this).find($('.path-ico-img')).text());
            });
        }
        if ($('#broadcrumbs-evening')[0]) {
            $('#broadcrumbs-evening span:nth-of-type(5)').css({'display': 'none'}).next().css({'display': 'none'});
            $('#broadcrumbs-evening span:nth-of-type(3)').css({'display': 'none'}).next().css({'display': 'none'});
        }
        if ($('.broadcrumbs_course')[0]) {
            $('.broadcrumbs_course span:nth-of-type(3)').css({'display': 'none'}).next().css({'display': 'none'});
        }
        $('ul.filter > li.current').trigger('click');
        if (data[0] == 'Firefox') {
            function FirefoxResize (){
                $(window).trigger('resize');
                $(document).trigger('resize');
                window.dispatchEvent(new Event('resize'));
                document.dispatchEvent(new Event('resize'));
                console.log("firefox resize");
                var el = document; // This can be your element on which to trigger the event
                var event = document.createEvent('HTMLEvents');
                event.initEvent('resize', true, false);
                el.dispatchEvent(event);

            }
            setTimeout(FirefoxResize,1);
            setTimeout(FirefoxResize,1000);
            setTimeout(FirefoxResize,2000);
            setTimeout(FirefoxResize,3500);
            setTimeout(FirefoxResize,6000);
        }



        var slides = jQuery(".courses-slider .courses-slides").children(".courses-slide");
        var width = jQuery(".courses-slider .courses-slides").width();
        var windowWidth = $(window).width();
        var i = slides.length;
        var offset = i * width;
        var cheki = i-1;

        jQuery(".courses-slider .courses-slides").css('width',offset);

        for (j=0; j < slides.length; j++) {
            if (j===0) {
                jQuery(".courses-slider .navigation").append("<div class='dot active'></div>");
            }
            else {
                jQuery(".courses-slider .navigation").append("<div class='dot'></div>");
            }
        }

        var dots = jQuery(".courses-slider .navigation").children(".dot");
        offset = 0;
        i = 0;

        jQuery('.courses-slider .navigation .dot').click(function(){
            jQuery(".courses-slider .navigation .active").removeClass("active");
            jQuery(this).addClass("active");
            i = jQuery(this).index();
            offset = i * width;
            jQuery(".courses-slider .courses-slides").css("transform","translate3d(-" + offset + "px, 0px, 0px)");
        });


        jQuery(".courses-slider .next").click(function(){
            if (offset < width * cheki) {
                offset += width;
                jQuery(".courses-slider .courses-slides").css("transform","translate3d(-"+offset+"px, 0px, 0px)");
                jQuery(".courses-slider .navigation .active").removeClass("active");
                jQuery(dots[++i]).addClass("active");
            }
        });

        if(jQuery('.courses-slider .navigation .dot:last-child').hasClass('active') === true){
            jQuery('.slider-header-nav .next').removeClass('active');
        } else {
            jQuery('.slider-header-nav .next').addClass('active');
        }

        jQuery(".courses-slider .prev").click(function(){
            if (offset > 0) {
                offset -= width;
                jQuery(".courses-slider .courses-slides").css("transform","translate3d(-"+offset+"px, 0px, 0px)");
                jQuery(".courses-slider .navigation .active").removeClass("active");
                jQuery(dots[--i]).addClass("active");
            }
        });
        function resizeWindow () {
            windowWidth = $(window).width();

            jQuery(".courses-slider .courses-slides").css('width',jQuery(".courses-slider").width()*slides.length);
            width = jQuery(".courses-slider").width();
            jQuery(".courses-slider .courses-slides").css("transform","translate3d(-0px, 0px, 0px)");
            jQuery(".courses-slider .navigation .active").removeClass("active");
            i = 0;
            offset = 0;
            jQuery(dots[i]).addClass("active");
        };
        resizeWindow();
        jQuery(window).resize(function () {
            if (windowWidth !== $(window).width()) {
                resizeWindow();
            }
        });


    }, 1000);
});

window.addEventListener('load',function () {
    var contentSwiperEl = $('#mainSlider #main-slider');
    if (contentSwiperEl.length > 0) {
        function moveToClickedNumber(cont) {
            return function (swiper) {
                swiper.swipeTo(swiper.clickedSlideIndex);
                cont.swipeTo(swiper.clickedSlideIndex);
            }
        }
        var contentSwiper = $('#mainSlider #main-slider').swiper({
            pagination: '.additional-clickers',
            grabCursor: true,
            autoplay: 5000,
            paginationClickable: true,
            onSlideChangeStart: function () {
                updateNavPosition();
            }
        });
        var navSwiper = new Swiper('#slider-tizer-news', {
            slidesPerView: 'auto',
            grabCursor: true,
            mousewheelControl: true,
            mode: 'vertical',
            scrollbar: {container: '.swiper-scrollbar', hide: false, draggable: true},
            onSlideClick: moveToClickedNumber(contentSwiper),
        });
        $('#mainSlider .wrapper-main-slider').on('mouseover', function () {
            contentSwiper.stopAutoplay();
            navSwiper.stopAutoplay();
        });
        $('#mainSlider .wrapper-main-slider').on('mouseleave', function () {
            contentSwiper.startAutoplay();
            navSwiper.startAutoplay();
        });

        function updateNavPosition() {
            $('#slider-tizer-news .active-nav').removeClass('active-nav');
            var activeNav = $('#slider-tizer-news .swiper-slide').eq(contentSwiper.activeIndex).addClass('active-nav');
            if (!activeNav.hasClass('swiper-slide-visible')) {
                if (activeNav.index() > navSwiper.activeIndex) {
                    var thumbsPerNav = Math.floor(navSwiper.width / activeNav.width()) - 1;
                    navSwiper.swipeTo(activeNav.index() - thumbsPerNav);
                } else {
                    navSwiper.swipeTo(activeNav.index());
                }
            }
        }
    }
});

function moveRed(i) {
    i = $('.fotorama__nav__frame--dot.fotorama__active').index();
    $('#menu li').removeClass('act');
    $('#menu li#' + i).addClass('act');
    setTimeout(moveRed, 1);
    i++;
}

$(document).keydown(function (e) {
    if (e.keyCode === 27) {
        $('.search-function span').click();
        return false;
    }
});
$(window).load(function () {
    $('.gallery').masonry({itemSelector: '.gallery-item', isFitWidth: true}).imagesLoaded(function () {
        $('.gallery').masonry('reload');
    });
    var $container = $('.isotope').isotope({resizable: false, itemSelector: '.item', layoutMode: 'fitRows'});
    if (data[0] != 'Firefox') {
        $('table.timeTableCourses.dayCourse tr.no th').css('display', 'block');
        // con = $('.timeTableCourses.dayCourse').isotope({
        //     resizable: true,
        //     containerStyle: {position: 'relative', overflow: 'visible'},
        //     itemSelector: 'tr',
        //     layoutMode: 'fitRows'
        // });
    }
    $('.filter li').on('click', function (event) {
        if ($(this).hasClass('flexMenu-viewMore')) return;
        $('.filter li').removeClass('current');
        $(this).addClass('current');
        var filterValue = $(this).attr('data-filter');
        $container.isotope({filter: filterValue});
        event.stopPropagation();
    });
    $(".flexMenu-viewMore").on('click', function (event) {
        $('li[data-filter="*"]').removeClass('current');
        $('li[data-filter=".programming"]').removeClass('current');
        $('li[data-filter=".layout"]').removeClass('current');
        $(this).addClass('current');
    });

    //nanoscroll
    $(".nano").nanoScroller();

    //Select vendors
    $('.wrapper-dropdown-2 .nano').on('click',function(event){
        event.stopPropagation();
    });
    $('.filter3 .dropdown li').on('click', function (event) {
        if($(this).attr('data-filter')==="*"){
            $('.filter3 .dropdown li').removeClass('current');
            $(this).toggleClass('current');
            $('#dd span.all-vendors').show();
            $('#dd1 ul.dropdown li').css('display', 'list-item');
            var filterValue = '*';
            //$('.filters-radio .all-c input').prop('checked',true);
            $('.filters-radio .garanted label').removeClass('notactive');
            if ($('.filters-radio input:radio[name="f-course"]').is(':checked') && $('.filters-radio input:radio[name="f-course"]:checked').val() == 'hide') {
                filterValue = " .has-g";
            }
            // con.isotope({filter: filterValue});
            $('.timeTableCourses.dayCourse tr').hide();
            if(filterValue === '*'){
                $('.timeTableCourses.dayCourse tr').show();
            }else{
                $(filterValue).show();
            }
            event.stopPropagation();
            // scrollspy();
            // $('#dd , #dd1').removeClass('active');
            $('#dd span.all-vendors').text($(this).text());
            $('#dd .chosen-vendors').html('');
            $('#dd1 span.all-technology').show();
            $('#dd1 .chosen-technology').html('');
            $('#dd1 .dropdown li').removeClass('current');
            $('#dd1').addClass('notactive');
            $(".nano").nanoScroller();
        }else{
            $('.filter3 .dropdown li[data-filter="*"]').removeClass('current');
            $('#dd1').removeClass('notactive');
            if($(this).hasClass('current')){
                $('#dd .chosen-vendors li[data-filter="'+$(this).attr('data-filter')+'"]').remove();
            }else{
                $('#dd .chosen-vendors').append('<li data-filter="'+$(this).attr('data-filter')+'">'+$(this).text()+'<span class="close-item"></span></li>');
                $('.filter3>div>.chosen-vendors>li[data-filter="'+$(this).attr('data-filter')+'"]>.close-item').on('click',function(event){
                    event.stopPropagation();
                    var parent = $(this).parent();
                    $('.filter3 .dropdown li[data-filter="'+parent.attr('data-filter')+'"]').click();
                });
            }
            $(this).toggleClass('current');
            var filterValue = "";
            $('#dd1 ul.dropdown li').css('display', 'none');
            $('.filters-radio .garanted label').addClass('notactive');
            if ($('.filters-radio input:radio[name="f-course"]').is(':checked') && $('.filters-radio input:radio[name="f-course"]:checked').val() == 'hide') {
                $('.filter3 .dropdown li.current').each(function (indx, element) {
                    filterValue += " " + $(element).attr('data-filter')+'.has-g';
                    if (filterValue == ' *') {
                        $('#dd1 ul.dropdown li').css('display', 'list-item');
                    } else {
                        $('#dd1 ul li.has-g' + $(element).attr('data-filter')).css('display', 'list-item');
                    }
                    if($('.timeTableCourses.dayCourse .parent-category'+$(element).attr('data-filter')).hasClass('has-g')){$('.filters-radio .garanted label').removeClass('notactive');}
                });
                if(!$('#dd .chosen-vendors li').length>0){
                    filterValue = " .has-g";
                }
            }else{
                $('.filter3 .dropdown li.current').each(function (indx, element) {
                    filterValue += " " + $(element).attr('data-filter');
                    if (filterValue == ' *') {
                        $('#dd1 ul.dropdown li').css('display', 'list-item');
                    } else {
                        $('#dd1 ul li' + $(element).attr('data-filter')).css('display', 'list-item');
                    }
                    if($('.timeTableCourses.dayCourse .parent-category'+$(element).attr('data-filter')).hasClass('has-g')){$('.filters-radio .garanted label').removeClass('notactive');}
                });
            }

            filterValue = filterValue.substr(1);
            filterValue = filterValue.replace(new RegExp(" ", 'g'), ",");
            //$('.filters-radio .all-c input').prop('checked',true);
            // con.isotope({filter: filterValue});
            $('.timeTableCourses.dayCourse tr').hide();
            console.log(filterValue,JSON.stringify(filterValue),filterValue.length);
            if(filterValue==='' || filterValue==='*'){
                $('.timeTableCourses.dayCourse tr').show();
            }else{
                $(filterValue).show();
            }
            event.stopPropagation();
            // scrollspy();
            // $('#dd , #dd1').removeClass('active');
            $('#dd span.all-vendors').hide();
            if(!$('#dd .chosen-vendors li').length>0){
                $('#dd span.all-vendors').show();
                $('.filter3 .dropdown li[data-filter="*"]').addClass('current');
                $('.filters-radio .garanted label').removeClass('notactive');
                $('#dd1 ul.dropdown li').css('display', 'list-item');
                $('#dd1').addClass('notactive');
            }
            $('#dd1 span.all-technology').show();
            $('#dd1 .chosen-technology').html('');
            $('#dd1 .dropdown li').removeClass('current');
            $(".nano").nanoScroller();
        }
    });

    //select technologies
    $('#dd1 .dropdown').on('click', 'li', function () {
        if($(this).hasClass('current')){
            $('#dd1 .chosen-technology li[data-filter="'+$(this).attr('data-filter')+'"]').remove();
        }else{
            $('#dd1 .chosen-technology').append('<li data-filter="'+$(this).attr('data-filter')+'">'+$(this).text()+'<span class="close-item"></span></li>');
            $('#dd1 .chosen-technology li[data-filter="'+$(this).attr('data-filter')+'"]>.close-item').on('click',function(event){
                event.stopPropagation();
                var parent = $(this).parent();
                $('#dd1 .dropdown li[data-filter="'+parent.attr('data-filter')+'"]').click();
            });
        }
        $(this).toggleClass('current');
        var filterValue = "";
        $('.filters-radio .garanted label').addClass('notactive');
        $('#dd1 .dropdown li.current').each(function (indx, element) {

            if ($('.filters-radio input:radio[name="f-course"]').is(':checked') && $('.filters-radio input:radio[name="f-course"]:checked').val() == 'hide') {
                filterValue += " .has-g" + $(element).attr('data-filter');
            }else{
                filterValue += " " + $(element).attr('data-filter');
            }
            if($('.timeTableCourses.dayCourse .child-category'+$(element).attr('data-filter')).hasClass('has-g')){$('.filters-radio .garanted label').removeClass('notactive');}
        });
        $('#dd1 span.all-technology').hide();
        if(!$('#dd1 .chosen-technology li').length>0){
            $('#dd1 span.all-technology').show();
            if(!$('#dd .chosen-vendors li').length>0){
                filterValue='*';
            }else{
                filterValue = "";
                $('.filters-radio .garanted label').addClass('notactive');
                $('.filter3 .dropdown li.current').each(function (indx, element) {
                    if ($('.filters-radio input:radio[name="f-course"]').is(':checked') && $('.filters-radio input:radio[name="f-course"]:checked').val() == 'hide') {
                        filterValue += " .has-g" + $(element).attr('data-filter');
                    }else{
                        filterValue += " " + $(element).attr('data-filter');
                    }
                    if($('.timeTableCourses.dayCourse .child-category'+$(element).attr('data-filter')).hasClass('has-g')){$('.filters-radio .garanted label').removeClass('notactive');}
                });
            }
        }
        //$('.filters-radio .all-c input').prop('checked',true);
        filterValue = filterValue.substr(1);
        filterValue = filterValue.replace(new RegExp(" ", 'g'), ",");
        // con.isotope({filter: filterValue});
        $('.timeTableCourses.dayCourse tr').hide();
        $(filterValue).show();
        //$('#dd1').toggleClass('active');
    });

    //hover info vendors
    $('.filters-radio .all-c .info').hover(function () {
        $('.filters-radio .all-c').addClass('hover-info');
    },function () {
        $('.filters-radio .all-c').removeClass('hover-info');
    });


    $('.filters-radio input:radio[name="f-course"]').change(function(){
        if(!jQuery('#dd .chosen-vendors li').length>0 && !jQuery('#dd1 .chosen-technology li').length>0){
            if ($(this).is(':checked') && $(this).val() == 'hide') {
                // con.isotope({filter: '.has-g'});
                $('.timeTableCourses.dayCourse tr').hide();
                $('.timeTableCourses.dayCourse .has-g').show();
            }else{
                // con.isotope({filter: '*'});
                $('.timeTableCourses.dayCourse tr').show();
            }
        }else{
            if ($(this).is(':checked') && $(this).val() == 'hide') {
                var filter = '.has-g';
                if(!jQuery('#dd1 .chosen-technology li').length>0){
                    var vendors = [];
                    jQuery('#dd1 ul.dropdown li').css('display','none');
                    $('#dd .chosen-vendors li').each(function(){
                        vendors.push($(this).attr('data-filter')+'.has-g');
                        jQuery('#dd1 ul.dropdown li.has-g'+$(this).attr('data-filter')).css('display','list-item');
                    });
                    filter = vendors.join(',');
                    $(".nano").nanoScroller();
                }else{
                    var vendorsAndTechnology = [];
                    $('#dd1 .chosen-technology li').each(function(){
                        vendorsAndTechnology.push($(this).attr('data-filter')+'.has-g');
                    });
                    filter = vendorsAndTechnology.join(',');
                }
                // con.isotope({filter: filter});
                $('.timeTableCourses.dayCourse tr').hide();
                $(filter).show();
            }else{
                var filter = '.has-g';
                if(!jQuery('#dd1 .chosen-technology li').length>0){
                    var vendors = [];
                    $('#dd .chosen-vendors li').each(function(){
                        vendors.push($(this).attr('data-filter'));
                        jQuery('#dd1 ul.dropdown li'+$(this).attr('data-filter')).css('display','list-item');
                    });
                    filter = vendors.join(',');
                    $(".nano").nanoScroller();
                }else{
                    var vendorsAndTechnology = [];
                    $('#dd1 .chosen-technology li').each(function(){
                        vendorsAndTechnology.push($(this).attr('data-filter'));
                    });
                    filter = vendorsAndTechnology.join(',');
                }
                // con.isotope({filter: filter});
                $('.timeTableCourses.dayCourse tr').hide();
                $(filter).show();
            }
        }

    });
    $('.filters-select .wrapper-dropdown-2').on('click',function(event){
        var was_active = $(this).hasClass('active');
        $('.filters-select .wrapper-dropdown-2').removeClass('active');
        if(!was_active){$(this).addClass('active');}
        event.stopPropagation();
    });
    // con.isotope({filter: '.has-g'});
    $('.timeTableCourses.dayCourse tr').hide();
    $('.timeTableCourses.dayCourse .has-g').show();

    $('#direction').on('click', 'a', function () {
        var filterValue = $(this).attr('data-filter');
        $container.isotope({filter: filterValue});
        $('.filter li').removeClass('current');
        $('.filter li[data-filter = "' + filterValue + '"]').addClass('current');
    });
    // if ($('.blue').height() && data[0] != 'Firefox') {
    //     var scrollToSelectors = ['.blue', '.green', '.orange', '.lblue', '.purl', '.yellow', '.pink', '.hucki', '.aqua', '.passion'];
    //     for (var i = 0; i < scrollToSelectors.length; i++) {
    //         $(scrollToSelectors[i]).scrollToFixed({
    //             marginTop: 75,
    //             limit: parseInt($('.dayCourse')[0].style.height) + 350,
    //             removeOffsets: true
    //         });
    //     }
    // }
});
(function ($) {
    var flexObjects = [], resizeTimeout;

    function adjustFlexMenu() {
        $(flexObjects).each(function () {
            $(this).flexMenu({'undo': true}).flexMenu(this.options);
        });
    }

    function collapseAllExcept($menuToAvoid) {
        var $activeMenus, $menusToCollapse;
        $activeMenus = $('li.flexMenu-viewMore.active');
        $menusToCollapse = $activeMenus.not($menuToAvoid);
        $menusToCollapse.removeClass('active').find('> ul').hide();
    }

    $.fn.flexMenu = function (options) {
        var checkFlexObject, s = $.extend({
            'threshold': 2,
            'cutoff': 2,
            'linkText': 'Еще',
            'linkTitle': 'View More',
            'linkTextAll': 'Просмотреть все направления',
            'linkTitleAll': 'Open/Close Menu',
            'showOnHover': true,
            'popupAbsolute': true,
            'undo': false
        }, options);
        this.options = s;
        checkFlexObject = $.inArray(this, flexObjects);
        if (checkFlexObject >= 0) {
            flexObjects.splice(checkFlexObject, 1);
        } else {
            flexObjects.push(this);
        }
        return this.each(function () {
            var $this = $(this), $items = $this.find('> li'), $self = $this, $firstItem = $items.first(),
                $lastItem = $items.last(), numItems = $this.find('li').length,
                firstItemTop = Math.floor($firstItem.offset().top),
                firstItemHeight = Math.floor($firstItem.outerHeight(true)), $lastChild, keepLooking, $moreItem,
                $moreLink, numToRemove, allInPopup = false, $menu, i;

            function needsMenu($itemOfInterest) {
                var result = (Math.ceil($itemOfInterest.offset().top) >= (firstItemTop + firstItemHeight)) ? true : false;
                return false;
            }

            if (needsMenu($lastItem) && numItems > s.threshold && !s.undo && $this.is(':visible')) {
                var $popup = $('<ul class="flexMenu-popup" style="display:none;' + ((s.popupAbsolute) ? ' position: absolute;' : '') + '"></ul>'),
                    firstItemOffset = $firstItem.offset().top;
                for (i = numItems; i > 1; i--) {
                    $lastChild = $this.find('> li:last-child');
                    keepLooking = (needsMenu($lastChild));
                    $lastChild.appendTo($popup);
                    if ((i - 1) <= s.cutoff) {
                        $($this.children().get().reverse()).appendTo($popup);
                        allInPopup = true;
                        break;
                    }
                    if (!keepLooking) {
                        break;
                    }
                }
                if (allInPopup) {
                    $this.append('<li class="flexMenu-viewMore flexMenu-allInPopup"><a href="#" title="' + s.linkTitleAll + '">' + s.linkTextAll + '</a></li>');
                } else {
                    $this.append('<li class="flexMenu-viewMore"><a href="#" title="' + s.linkTitle + '">' + s.linkText + '</a></li>');
                }
                $moreItem = $this.find('> li.flexMenu-viewMore');
                if (needsMenu($moreItem)) {
                    $this.find('> li:nth-last-child(2)').appendTo($popup);
                }
                $popup.children().each(function (i, li) {
                    $popup.prepend(li);
                });
                $moreItem.append($popup);
                $moreLink = $this.find('> li.flexMenu-viewMore > a');
                $moreLink.click(function (e) {
                    collapseAllExcept($moreItem);
                    $popup.toggle();
                    $moreItem.toggleClass('active');
                    e.preventDefault();
                });
                if (s.showOnHover && (typeof Modernizr !== 'undefined') && !Modernizr.touch) {
                    $moreItem.hover(function () {
                        $popup.show();
                        $(this).addClass('active');
                    }, function () {
                        $popup.hide();
                        $(this).removeClass('active');
                    });
                }
            } else if (s.undo && $this.find('ul.flexMenu-popup')) {
                $menu = $this.find('ul.flexMenu-popup');
                numToRemove = $menu.find('li').length;
                for (i = 1; i <= numToRemove; i++) {
                    $menu.find('> li:first-child').appendTo($this);
                }
                $menu.remove();
                $this.find('> li.flexMenu-viewMore').remove();
            }
        });
    };
})(jQuery);

// function scrollspy() {
//     $('.blue').trigger('detach.ScrollToFixed');
//     $('.green').trigger('detach.ScrollToFixed');
//     $('.orange').trigger('detach.ScrollToFixed');
//     $('.lblue').trigger('detach.ScrollToFixed');
//     $('.purl').trigger('detach.ScrollToFixed');
//     $('.yellow').trigger('detach.ScrollToFixed');
//     $('.pink').trigger('detach.ScrollToFixed');
//     $('.hucki').trigger('detach.ScrollToFixed');
//     $('.aqua').trigger('detach.ScrollToFixed');
//     $('.passion').trigger('detach.ScrollToFixed');
// }

function browserDetectNav(chrAfterPoint) {
    var
        UA = window.navigator.userAgent, OperaB = /Opera[ \/]+\w+\.\w+/i, OperaV = /Version[ \/]+\w+\.\w+/i,
        FirefoxB = /Firefox\/\w+\.\w+/i, ChromeB = /Chrome\/\w+\.\w+/i, SafariB = /Version\/\w+\.\w+/i,
        IEB = /MSIE *\d+\.\w+/i, SafariV = /Safari\/\w+\.\w+/i, browser = new Array(), browserSplit = /[ \/\.]/i,
        OperaV = UA.match(OperaV), Firefox = UA.match(FirefoxB), Chrome = UA.match(ChromeB), Safari = UA.match(SafariB),
        SafariV = UA.match(SafariV), IE = UA.match(IEB), Opera = UA.match(OperaB);
    if ((!Opera == "") & (!OperaV == "")) browser[0] = OperaV[0].replace(/Version/, "Opera")
    else if (!Opera == "") browser[0] = Opera[0]
    else if (!IE == "") browser[0] = IE[0]
    else if (!Firefox == "") browser[0] = Firefox[0]
    else if (!Chrome == "") browser[0] = Chrome[0]
    else if ((!Safari == "") && (!SafariV == "")) browser[0] = Safari[0].replace("Version", "Safari");
    var
        outputData;
    if (browser[0] != null) outputData = browser[0].split(browserSplit);
    if ((chrAfterPoint == null) && (outputData != null)) {
        chrAfterPoint = outputData[2].length;
        outputData[2] = outputData[2].substring(0, chrAfterPoint);
        return (outputData);
    } else return (false);
}

(function ($, window, undefined) {
    '$:nomunge';
    var str_hashchange = 'hashchange', doc = document, fake_onhashchange, special = $.event.special,
        doc_mode = doc.documentMode,
        supports_onhashchange = 'on' + str_hashchange in window && (doc_mode === undefined || doc_mode > 7);

    function get_fragment(url) {
        url = url || location.href;
        return '#' + url.replace(/^[^#]*#?(.*)$/, '$1');
    }

    $.fn[str_hashchange] = function (fn) {
        return fn ? this.bind(str_hashchange, fn) : this.trigger(str_hashchange);
    };
    $.fn[str_hashchange].delay = 50;
    special[str_hashchange] = $.extend(special[str_hashchange], {
        setup: function () {
            if (supports_onhashchange) {
                return false;
            }
            $(fake_onhashchange.start);
        }, teardown: function () {
            if (supports_onhashchange) {
                return false;
            }
            $(fake_onhashchange.stop);
        }
    });
    fake_onhashchange = (function () {
        var self = {}, timeout_id, last_hash = get_fragment(), fn_retval = function (val) {
            return val;
        }, history_set = fn_retval, history_get = fn_retval;
        self.start = function () {
            timeout_id || poll();
        };
        self.stop = function () {
            timeout_id && clearTimeout(timeout_id);
            timeout_id = undefined;
        };

        function poll() {
            var hash = get_fragment(), history_hash = history_get(last_hash);
            if (hash !== last_hash) {
                history_set(last_hash = hash, history_hash);
                $(window).trigger(str_hashchange);
            } else if (history_hash !== last_hash) {
                location.href = location.href.replace(/#.*/, '') + history_hash;
            }
            timeout_id = setTimeout(poll, $.fn[str_hashchange].delay);
        }

        return self;
    })();
    var halfText = $('.spoiler').innerHeight() / 2, textHeight = $('.spoiler').innerHeight();
    $('.spoiler').css('height', $('.spoiler').innerHeight() / 2);
    $('.readmore').click(function () {
        if ($('.spoiler').innerHeight() == halfText) {
            $('.spoiler').animate({height: textHeight}, 500);
            $(this).text('Скрыть');
            $('.spoiler').removeClass('spoiler-shadow');
        } else {
            $('.spoiler').animate({height: halfText}, 500);
            $(this).text('Читать далее');
            $('.spoiler').addClass('spoiler-shadow');
        }
    });
})(jQuery, this);
