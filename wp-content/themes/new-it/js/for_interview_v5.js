$(function() {
    var rates = document.getElementsByClassName('rateit-range');
    for (var i = 0; i < rates.length; i++) {
        $(rates[i]).barrating({
            theme: 'fontawesome-stars',
            initialRating: 5
        });
    }

    $('#survey-form input').on('blur keyup', function() {
        var id = $(this).attr('id');
        var val = $(this).val();

        switch(id) {
            case 'survey-coach':
                var rv_name = /^[a-zA-Zа-яА-ЯЇїіІґҐ_'\-\s]+$/;
                if(val != '' && rv_name.test(val)) {
                    $(this).addClass('survey_not_error').removeClass('survey_check_error');
                } else {
                    $(this).removeClass('survey_not_error').addClass('survey_error survey_check_error');
                }
                break;
            case 'survey-listener':
                var rv_name = /^[a-zA-Zа-яА-ЯЇїіІґҐ_'\-\s]+$/;
                if(val != '' && rv_name.test(val)) {
                    $(this).addClass('survey_not_error').removeClass('survey_check_error');
                } else {
                    $(this).removeClass('survey_not_error').addClass('survey_error survey_check_error');
                }
                break;
            case 'survey-email':
                var rv_email = /^([a-zA-Z0-9_.\-])+@([a-zA-Z0-9_.\-])+\.([a-zA-Z])+([a-zA-Z])+/;
                if(val != '' && rv_email.test(val)) {
                    $(this).addClass('survey_not_error').removeClass('survey_check_error');
                } else {
                    $(this).removeClass('survey_not_error').addClass('survey_error survey_check_error');
                }
                break;
        }
    });
    $('#survey-select-course').on('change', function(){
        $(this).removeClass('survey_check_error').css('border-color', '#00a651');
    });
    $('.b-survey-actual input').on('click', function(){
        $('.b-survey-actual input').removeClass('survey_check_error');
    });
    $('#second-step-wrapper .b-survey-job-search input').on('click', function(){
        $('#second-step-wrapper .b-survey-job-search input').removeClass('survey_check_error');
    });
    $('#fifth-step-wrapper .b-survey-job-search input').on('click', function(){
        $('#fifth-step-wrapper .b-survey-job-search input').removeClass('survey_check_error');
    });

    /*steps pagination begin*/
    (function() {
        //converting into an array
        var greybtns = Array.from(document.querySelectorAll('.big-grey-circle')),
            parts = document.querySelectorAll('.b-resume-form-wrapper'),
            controls = [],
            i;

        //shaping the two dimensional array
        for(i = 0; i < greybtns.length; i+=4) {
            controls[i/4] = (greybtns.slice(i, i + 4));
        }

        //only for using with parts object
        function switchTabTo(index) {
            $('.b-resume-form-wrapper.active').removeClass('active');
            $(parts[index]).addClass('active');
        }

        for(i = 0; i < controls.length; i++)
            for(var j = 0; j < controls[i].length; j++){
                controls[i][j].addEventListener('click', (function(x, y) {
                    return function() {
                        parts = document.querySelectorAll('.b-resume-form-wrapper:not(.active)');
                        if(x == 0) {
                            if(!firstStepValidation(true)) {
                                return false;
                            } else if(!secondStepValidation(true)) {
                                switchTabTo(0);
                                return false;
                            }
                        }
                        if(x == 1) {
                            if(!secondStepValidation(true)) {
                                if(y != 0)
                                    return false;
                                else {
                                    firstStepValidation(true);
                                    switchTabTo(0);
                                    return false;
                                }
                            }
                        }
                        switchTabTo(y);
                    }
                })(i, j));//binding values into a listener
            }
    })();

    /*steps pagination end*/

    /*first step survey validation begin*/
    $('#survey-first-step-btn a').on('click',function(e){
        e.preventDefault();

        firstStepValidation();
    });

    function firstStepValidation(flag) {
        $('#first-step-wrapper .b-resume-input-div input').each(function(i,elem) {

            if ($('#first-step-wrapper .b-resume-input-div .survey_check_error').length == 0) {

                $('.survey-fill-out-wrapper span').html('');
                $('#first-step-wrapper').removeClass('active');
                if(!flag) {
                    $('#second-step-wrapper').addClass('active');
                }
            }
            else {
                if($('#courses-list').hasClass('survey_check_error')){
                    $('.courses-list-option-default').css('border-color','#e11030');
                };
                $('.survey-fill-out-wrapper span').html('Заполните все обязательные поля формы!');
            }
        });
        return ($('#first-step-wrapper .b-resume-input-div .survey_check_error').length == 0);
    }
    /*first step survey validation end*/

    /*second step survey validation begin*/
    $('#survey-second-step-btn a:last-child').on('click',function(e){
        e.preventDefault();
        secondStepValidation();
    });
    $('#survey-second-step-btn a:first-child').on('click',function(){
        $('#second-step-wrapper').removeClass('active');
        $('#first-step-wrapper').addClass('active');
        $('.survey-fill-out-wrapper span').html('');

    });
    function secondStepValidation(flag) {
        $('#second-step-wrapper .b-resume-input-div input').each(function(i,elem) {
            if ($('#second-step-wrapper .b-resume-input-div .survey_check_error').length == 0)  {
                $('.survey-fill-out-wrapper span').html('');
                $('#second-step-wrapper').removeClass('active');
                if(!flag) {
                    $('#third-step-wrapper').addClass('active');
                }
            }
            else {
                $('.survey-fill-out-wrapper span').html('Заполните все обязательные поля формы!');
            }
        });
        return ($('#second-step-wrapper .b-resume-input-div .survey_check_error').length == 0);
    }
    /*second step survey validation end*/

    /*third step survey validation begin*/
    $('#survey-treriy-step-btn a:last-child').on('click',function(e){

        e.preventDefault();

        thirdStepValidation();
    });
    $('#survey-treriy-step-btn a:first-child').on('click',function(){
        $('#third-step-wrapper').removeClass('active');
        $('#second-step-wrapper').addClass('active');
        $('.survey-fill-out-wrapper span').html('');

    });
    function thirdStepValidation(flag) {
        $('#third-step-wrapper .rateit-range').each(function(i,elem) {
            if ($('#third-step-wrapper .rateit-range .survey_check_error').length == 0) {
                $('.survey-fill-out-wrapper span').html('');
                $('#third-step-wrapper').removeClass('active');
                if(!flag) {
                    $('#fourth-step-wrapper').addClass('active');
                }
            }
            else {
                $('.survey-fill-out-wrapper span').html('Заполните все обязательные поля формы!');
            }
        });
    }
    /*third step survey validation end*/

    /*fourth step survey validation begin*/
    $('#survey-fourth-step-btn a:last-child').on('click',function(e){

        e.preventDefault();

        fourthStepValidation();
    });
    $('#survey-fourth-step-btn a:first-child').on('click',function(){
        $('#fourth-step-wrapper').removeClass('active');
        $('#third-step-wrapper').addClass('active');
        $('.survey-fill-out-wrapper span').html('');
    });

    function fourthStepValidation(flag) {
        $('#fourth-step-wrapper .rateit-range').each(function(i,elem) {
            if ($('#fourth-step-wrapper .rateit-range.survey_check_error').length == 0) {
                $('.survey-fill-out-wrapper span').html('');
                $('#fourth-step-wrapper').removeClass('active');
                if(!flag) {
                    $('#fifth-step-wrapper').addClass('active');
                }
            }
            else {
                $('.survey-fill-out-wrapper span').html('Заполните все обязательные поля формы!');
            }
        });
    }
    /*fourth step survey validation end*/

    /*fifth step survey validation begin*/
    $('#survey-fifth-step-btn a:first-child').on('click',function(){
        $('#fifth-step-wrapper').removeClass('active');
        $('#fourth-step-wrapper').addClass('active');
        $('.survey-fill-out-wrapper span').html('');
    });

    $('#survey-form').on('submit',function(e){

        e.preventDefault();

        fifthStepValidation();
    });

    function fifthStepValidation() {
        $('#fifth-step-wrapper .b-survey-job-search input').each(function(i,elem) {
            if ($('#fifth-step-wrapper .survey_check_error').length == 0) {
                $('#survey-form').unbind('submit');
                $('#survey-form').submit();
                var loading = document.getElementById('loading');
                loading.classList.add('active');
            } else {
                $('.survey-fill-out-wrapper span').html('Заполните все обязательные поля формы!');
            }
        });
    }
    /*fifth step survey validation end*/

    /*masked date and phone number begin*/
    if($('#survey-tel').length){
        $("#survey-tel").inputmask("+\\9 (999) 999 9999",{
            "oncomplete": function() {
                $(this).addClass('survey_not_error').removeClass('survey_check_error');
            },
            "onincomplete": function() {
                $(this).removeClass('survey_not_error').addClass('survey_error survey_check_error');
            }
        });
        $("#survey-birth").inputmask("dd.mm.yyyy",{
            "oncomplete": function() {
                $(this).addClass('survey_not_error').removeClass('survey_check_error');
            },
            "onincomplete": function() {
                $(this).removeClass('survey_not_error').addClass('survey_error survey_check_error');
            }
        });
        $("#survey-date-2, #survey-date-1").inputmask("dd.mm.yyyy",{
            "oncomplete": function() {
                $(this).addClass('survey_not_error');
            },
            "onincomplete": function() {
                $(this).removeClass('survey_not_error');
            }
        });
    }
    /*masked date and phone number end*/

    $('.b-resume-input-div input').on('focus',function(){
        $(this).siblings('.placeholder').css({'top':'26px', 'left': '30px'});
    });
    $('.b-resume-input-div input').on('blur',function(){
        if($(this).val() == ''){
            $(this).siblings('.placeholder').css({'top':'70px', 'left': '0'});
        }
    });
    $('.b-resume-input-div textarea').on('focus',function(){
        $(this).siblings('.placeholder').css({'top':'26px', 'left': '30px'});
    });
    $('.b-resume-input-div textarea').on('blur',function(){
        if($(this).val() == ''){
            $(this).siblings('.placeholder').css({'top':'70px', 'left': '0'});
        }
    });

});

// form submit loading animation
// window.addEventListener('load', function () {
//    var surveyForm = document.getElementById('survey-form');
//    surveyForm.addEventListener('submit', function () {
//     var loading = document.getElementById('loading');
//     loading.classList.add('active');
//    });
// });

// begin scroll up
(function($) {
    $('#top,#top1,#top2,#top3,#top4,#top5,#top6,#top7').click(function() {
        $('html, body').animate({scrollTop: 0},200);
        return false;
    });
})(jQuery);
// end scroll up
