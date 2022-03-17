/*
 * data:   25.04.16
 *
 * Функция nicePrice() идентична функцие nicePrice с файла functions.php
 *
 * При необходимости изменить логику, для корректности вывода информации, необходимо изменить функцию и на PHP и на JS
 *
 */
$(window).load(function () {
    $('.b-level-course-list-table_header--btn-left').click(function () {
        $grid.isotope({filter: '.course-list'});
    });
    $('.b-level-course-list-table_header--btn-right').click(function () {
        $grid.isotope({filter: '.course-choice'});
    });
    $('.b-level-course-list-table_header--btn-left').click(function () {
        $('.b-level-course-list-table_header--btn-right').removeClass('active');
        $('.b-level-course-list-table_header--btn-left').addClass('active');
    });
    $('.b-level-course-list-table_header--btn-right').click(function () {
        $('.b-level-course-list-table_header--btn-left').removeClass('active');
        $('.b-level-course-list-table_header--btn-right').addClass('active');
    });
    function calcCoursePrice() {
        var requiredAamount = $('.number-of-percent').attr('data-num-courses');
        var salePercent = $('.number-of-percent').text();
        salePercent = salePercent / 100;

        var checkedCourses = $('.css-checkbox:checked'),
            coursesAll = $('.css-checkbox');

        if(checkedCourses.length == coursesAll.length)
            salePercent = -parseInt($('.full-sale-discount').text()) / 100;

        var coursItemVal = '';
        var coursePrice = 0;

        for (var i = 0; i < checkedCourses.length; i++) {
            coursItemVal = $(checkedCourses[i]).val().split('|');
            coursePrice += Number(coursItemVal[1]);
        }
        if (i >= requiredAamount) {
            coursePrice = parseInt(coursePrice - coursePrice * salePercent + 0.99, 10);
        }

        var form = $('#choice_course_form');
        if (checkedCourses[0] === undefined) {
            $('.form-disabled').fadeIn(300);
            $("button[name='roadChoice_payOnce']", form).attr('disabled', true).css('opacity', '0.5');
        } else {
            $('.form-disabled').fadeOut(300);
            $("button[name='roadChoice_payOnce']", form).attr('disabled', false).css('opacity', '1');
        }

        var partsPrice = parseInt((coursePrice + coursePrice * 0.1) / 4 + 0.99, 10);

        function nicePrice(price) {
            price = String(price);
            if (price.length > 2) {
                price = price.slice(0, -1);
                switch (price.slice(-1)) {
                    case '1':
                    case '2':
                        price = price.slice(0, -1) + '00';
                        break;
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                    case '7':
                        price = price.slice(0, -1) + '50';
                        break;
                    case '8':
                    case '9':
                        price = String(Number(price.slice(0, -1)) + 1) + '00';
                        break;
                    default:
                        price += '0';
                }
            }
            return price;
        }

        coursePrice = nicePrice(coursePrice);
        partsPrice = nicePrice(partsPrice);

        $('.choice-total-price').text(coursePrice + " тмт.");
        $('.choice-part-price').text(partsPrice + " тмт.");
        $("input[name='roadChoice_price']", form).val(coursePrice);
        $("input[name='roadChoice_parts_price']", form).val(partsPrice);

        $("input[name='roadmap-full-price']", form).val(coursePrice);
        $("input[name='roadmap-part-price']", form).val(partsPrice);
    }

    calcCoursePrice();
    $('.css-checkbox').change(function () {
        calcCoursePrice();
    });

});
