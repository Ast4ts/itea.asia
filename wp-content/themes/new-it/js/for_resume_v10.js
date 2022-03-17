/* student CV validation start */
$(function() {
    // rate star check
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

    $('#student-cv-form input, #student-cv-form textarea').on('blur keyup', function(){
        var id = $(this).attr('id');
        var val = $(this).val();
        switch(id) {
            case 'student-name':
                var rv_name = /^[0-9a-zA-Zа-яА-ЯЇїіІґҐ_'\-\s]+$/;
                if(val != '' && rv_name.test(val)) {
                    $(this).addClass('student_not_error').removeClass('check_error');
                } else {
                    $(this).removeClass('student_not_error').addClass('student_error check_error');
                }
                break;
            case 'student-email':
                var rv_email = /^([a-zA-Z0-9_.\-])+@([a-zA-Z0-9_.\-])+\.([a-zA-Z])+([a-zA-Z])+/;
                if(val != '' && rv_email.test(val)) {
                    $(this).addClass('student_not_error').removeClass('check_error');
                } else {
                    $(this).removeClass('student_not_error').addClass('student_error check_error');
                }
                break;
            case 'about_me':
            case 'edu1_names':
            case 'public_offer':
            case 'edu1_specialties':
            case 'personal_qualities':
                if(val != '') {
                    $(this).addClass('student_not_error').removeClass('check_error');
                } else {
                    $(this).removeClass('student_not_error').addClass('student_error check_error');
                }
                break;
        }
    });

    var flag = new Boolean(true);
    $('#add_place').click(function() {
        if (flag) {
            flag = false;
            func1.call(this);
        } else {
            flag = true;
            func2.call(this);
        }
        return false;
    });

    function func1(){
        $('.b-resume-form-right-block-hide').show(300)
    }
    function func2(){
        $('.b-resume-form-right-block-hide').hide(300)
    }

    /*input masked validation*/
    if($('#student-tel').length){
        $("#student-tel").inputmask("+\\9 (999) 999 9999",{
            "oncomplete": function()
            {
                $(this).addClass('student_not_error').removeClass('check_error');
            },

            "onincomplete": function()
            {
                $(this).removeClass('student_not_error').addClass('student_error check_error');
            }
        });
        $("#b-resume-birth").inputmask("dd.mm.yyyy",{

            "oncomplete": function() {
                $(this).addClass('student_not_error').removeClass('check_error');
            },
            "onincomplete": function() {
                $(this).removeClass('student_not_error').addClass('student_error check_error');
            }
        });
        $('#date-1, #date-2, #date-3-second, #date-4-second').inputmask("dd.mm.yyyy",{

            "oncomplete": function()
            {
                $(this).addClass('student_not_error');
            },
            "onincomplete": function()
            {
                $(this).removeClass('student_not_error');
            }
        });
    }
});
// begin scroll up
(function($) {
    $('#first-step-btn a, #second-step-btn a, #third-step-btn a:first-of-type').click(function() {
        $('html, body').animate({scrollTop: 0},500);
        return false;
    });
})(jQuery);
// end scroll up
/* student CV validation end */
