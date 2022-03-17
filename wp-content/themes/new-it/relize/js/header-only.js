try {
  $(document).ready(function () {
    (function () {
      var form = document.getElementById('callback-form');
      form.addEventListener('submit', function (e) {
        ga('send', {hitType: 'event', eventCategory: 'getcall', eventAction: 'getcall'});
      });
    })();
    $(function () {
      $('.expand-collapse').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        var toggler = this;
        var timeout = 0;
        if ($('body').hasClass('show-callback')) {
          timeout = 800;
          $('body').removeClass('show-callback');
        }
        setTimeout(function () {
          var list = $('.phones', $(toggler).closest('.phone-list')).toggleClass('single');
          list.parent().toggleClass('single');
        }, timeout);
      });
      $('.b-header-contacte-phone a').click(function (e) {
        e.preventDefault();
        console.log('wtf???');
        var timeout = 800;
        if ($('.phone-list .phones').hasClass('single')) {
          timeout = 0;
        } else {
          $('.phone-list .phones').addClass('single');
        }
        setTimeout(function () {
          $('body').toggleClass('show-callback');
        }, timeout);
      });
      $('#callback-form').submit(function (e) {
        e.preventDefault();
        var formContainer = $(this).closest('.b-header-contacte');
        var regex = /\+9\s\(\d{3}\)\s(\d{2,3}\s?){3}/;
        var tel = $('#b-contacte-phone-tel').val();
        if (regex.test(tel) && $('#b-contacte__full-name').val() !== '') {
          formContainer.find('.b-header-contacte-loader').removeClass('hidden');
          formContainer.find('.b-header-contacte-phone-block').addClass('hidden');

          let dataSend = $(this).serialize();
          if (window.location.pathname === '/employment/' || window.location.pathname === '/uk/employment-uk/') {
            dataSend += "&employment=true";
          }

          $.ajax({
            method: 'post',
            url: window.location.protocol + '//' + window.location.host + '/wp-admin/admin-ajax.php?action=callback_order',
            data: dataSend,
            complete: function () {
              formContainer.find('.b-header-contacte-loader').addClass('hidden');
              formContainer.find('.b-header-contacte-phone-thank').removeClass('hidden');
              formContainer.find('.b-header-contacte-phone-block form')[0].reset();
              setTimeout(function () {
                formContainer.find('.b-header-contacte-phone-block').removeClass('hidden');
                formContainer.find('.b-header-contacte-phone-thank').addClass('hidden');
              }, 8000);
            }
          });
        } else {
          $('#b-contacte-phone-tel').css('border-color', 'red');
          $('#b-contacte__full-name').css('border-color', 'red');
        }
      });
      $('#b-contacte-phone-tel').focus(function () {
        $(this).css('background-color', 'white');
      });
    });
    if ($('.top-search-toggle')[0]) {
      $(function () {
        $('.top-search-toggle').click(function (e) {
          e.preventDefault();
          e.stopPropagation();
          $('body').toggleClass('show-top-search');
          if ($("#header .navbar-toggle").hasClass('active')) {
            $("#header .navbar-toggle").click();
          }
        });
      });
      $(function () {
        $('.header-search input[type="text"]').attr('placeholder', '');
      });
    }
    $(function () {
      $('#header .menu > .menu-item').each(function () {
        if ($(this).find('.sub-menu').length === 0) {
          $(this).addClass('nochildren');
        }
      })
    });
    (function () {
      if (screen.width < 767) {
        var menuElems = $('#flex > li');
        $('#header').find('button').on('click', function () {
          $('body').toggleClass('no-scroll');
          menuElems.each(function (i, e) {
            $(e).removeClass('current-page-ancestor').removeClass('current-menu-item').removeClass('current-menu-paren').css({'border': "none"});
          });
        });
      }
    })();
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      if (screen.width > 767 && scroll > 80) {
        $("body").addClass("small-menu");
      } else {
        $("body").removeClass("small-menu");
      }
    });

    $('.b-header-contacte__close-btn').on('click', function () {
      $('body').removeClass('show-callback');
      $('body').removeClass('show-search');
    })

    $('.phones-block__phone').on('click', function (e) {
      e.preventDefault();
      $('.phones-block').toggleClass('active');
    })
    $(document).mouseup(function (e){ // событие клика по веб-документу
      var div = $(".phones-block"); // тут указываем ID элемента
      if (!div.is(e.target) && div.has(e.target).length === 0) { // и не по его дочерним элементам
        $('.phones-block').removeClass('active');
      }
      var searchInput = $('.header-search');
      if (!searchInput.is(e.target) && searchInput.has(e.target).length === 0) { // и не по его дочерним элементам
        $('.header-search .show-search').show();
        $('.header-search #searchform').removeClass();
        $('.header-search .show-search-show').hide();
      }
    });


    $('.show-search').on('click', function (e) {
      e.preventDefault();

      if ($(window).width() > 1024 ) {
        $(this).toggle();
        $('.show-search-show').toggle();
        $(this).parent().find('form').addClass('showing');
        $(this).parent().find('form input[type="text"]').focus();
      } else {
        $('body').toggleClass('show-search');
        $('form#searchform input[type="text"]').focus();
      }
    });
    $('.left_header_part_search').on('click', function (e) {
      e.preventDefault();
      if ($(window).width() > 1024 ) {
        $('#searchform').addClass('showing');

      } else {
        $('body').toggleClass('show-search');
        $('form#searchform input[type="text"]').focus();
      }
    });
    $('.show-search-show').on('click', function () {
      $('.header-search form').submit();
    });
    $('.modal-search-btn').on('click', function () {
      $('#searchform ').submit();
    });
    $(document).mouseup(function (e) {
      var selectors = ['.b-header-contacte', '.phone-list', '.header-search', '.top-search-form'];
      var hide = true;
      for (var i = 0; i < selectors.length; i++) {
        var container = $(selectors[i]);
        if (container.is(e.target) || $.contains(container[0], e.target)) {
          hide = false;
          break;
        }
      }
      if (hide) {
        $('body').removeClass('show-callback').removeClass('show-top-search');
        $('#header ul.phones').addClass('single').closest('.phone-list').addClass('single');
        $('.header-search form').removeClass('showing');
      }
    });

    // $('#flex > li').on('click', function (e) {
    if ($(window).width() <= 1366) {
      var menuElems = $('#flex > li');
      $("#flex li a.parent").unbind('click').bind('click', function (e) {

        $('.nav-control .parent').removeClass('active')

        if ($(e.target).hasClass('parent')) {
          e.preventDefault();
        }
        e.preventDefault();
        var parent = $(this).parent("li")[0];
        $(parent).toggleClass("hover");
        menuElems.each(function (i, e) {
          if (e !== parent) {
            $(e).removeClass('hover');
          }
        });
      });
    } else {
      $("#flex li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function () {
        $(this).toggleClass('hover');
      });
    }
    // })
    $('.nav-control .parent > a').on('click', function (e) {
      console.log('test')
      e.preventDefault();
      $('.nav-control .parent > a').closest('.parent').toggleClass('active');
      $('#flex > li').removeClass('hover')
    })

  });
} catch (e) {
  console.log('errorHeader', e)
}