/* scripts from template { */

$(document).ready(function () {

    var sampleTags = ['С#','C++','Ruby','Objective-C','Scala','Perl','Go','CoffeeScript','ActionScript','Java','Python','PHP',
        'jQuery','JavaScript','HTML','CSS','Linux','Ubuntu','MySQL','Ajax','Git','SQL','Nginx','Node.js','Angular.js','React.js',
        'Алгоритмы','Криптография','ООП','.NET','Django','MongoDB','Ruby on Rails','Drupal','WordPress','Agile','Symfony','Doctrine',
        'Bootstrap','Photoshop','SSH','Sass','Laravel','Zend Framework','Yii'];
    $("#mySingleFieldTags").tagit({
        availableTags: sampleTags,
        allowSpaces: true
    });


    $(function(){
        var $uploadCrop;

        function readFile(input) {
            if (input.files[0].size/1024/1024 > 2) {
                alert("Максимальный размер фото 2мб");
                return;
            }
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                alert("Sorry - your browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        var $upload = $('#upload');

        function clickUpload(e){
            e.preventDefault();
            $upload.trigger('click');
        }

        $upload.on('change', function () {
            $(".crop").show();
            readFile(this);
            $('.crop').off('click', '.cr-boundary', clickUpload);
            $('.file-upload').removeClass('hidden');
        });

        $('.crop').on('click', '.cr-boundary', clickUpload);

        $('.upload-result').on('click', function (ev) {
            $uploadCrop.croppie('result', 'canvas').then(function (resp) {
                popupResult({
                    src: resp
                });
                $upload.val(resp);
            });
        });

        function popupResult(result) {
            var html;
            if (result.html) {
                html = result.html;
            }
            if (result.src) {
                html = '<img src="' + result.src + '" />';
            }
            $("#result").html(html);
            $("#upload2").attr('value', result.src);
        }
    });

    $grid1 = $('.grid1');
    $grid1.isotope({filter: '.b-resume-add-job'});
    $('.b-resume-add-job').click(function () {
        $('.form_to_resume-add-job .regular_input').addClass('check_error');
        $('#date-3, #date-4').addClass('check_error');

        $grid1.isotope({filter: '.form_to_resume-add-job'});
        $('.form_to_resume-add-job').css('position', 'relative');
    });
    $grid2 = $('.grid2');
    $grid2.isotope({filter: '.b-resume-add-edu'});
    $('.b-resume-add-edu').click(function () {
        $('.form_to_resume-add-education .regular_input').addClass('check_error');
        $('#second-step-wrapper .fill-out-wrapper').css('margin-top', '40');
        $grid2.isotope({filter: '.form_to_resume-add-education'});
        $('.form_to_resume-add-education').css('position', 'relative');
    });

    /*first step validation*/
    $('#first-step-btn a').on('click',function(e){
        e.preventDefault();

        $('#first-step-wrapper .b-resume-input-div input').each(function(i,elem) {
            if ($('#first-step-wrapper .b-resume-input-div .check_error').length == 0 && $('#first-step-wrapper input').val() != '' && $('#first-step-wrapper textarea').val() != '' && $('#student-email').val() != '' && $('#b-resume-birth').val() != '' && $('#student-tel').val() != ''){

                $('#fill-out').html('');
                $('#first-step-wrapper').removeClass('active').addClass('hidden');
                $('#second-step-wrapper').removeClass('hidden').addClass('active');
            } else {
                $('#student-name, #student-email, #b-resume-birth, #student-tel, #about_me').removeClass('check_error').addClass('student_error');
                $('#fill-out').html('Заполните все обязательные поля формы!');
            }
        });
    });

    $('#second-step-btn a:first-of-type').on('click', function(e){
        e.preventDefault();

        $('#second-step-wrapper').removeClass('active').addClass('hidden');
        $('#first-step-wrapper').removeClass('hidden').addClass('active');
        $('#fill-out').html('');
    });

    /*second step validation*/

    $('#second-step-btn a:last-of-type').on('click', function(e){
        e.preventDefault();

        $('#second-step-wrapper .b-resume-input-div input').each(function(i,elem) {
            if ($('#second-step-wrapper .b-resume-input-div .check_error').length == 0 &&  $('#edu1_names').val() != '' && $('#edu1_specialties').val() != '') {

                $('#fill-out-second').html('');
                $('#second-step-wrapper').removeClass('active').addClass('hidden');
                $('#third-step-wrapper').removeClass('hidden').addClass('active');

            } else {
                $('#edu1_names, #edu1_specialties').removeClass('check_error').addClass('student_error');
                $('#fill-out-second').html('Заполните все обязательные поля формы!');
            }
        });

    });
    $('#third-step-btn a:first-of-type').on('click', function(e){
        e.preventDefault();

        $('#third-step-wrapper').removeClass('active').addClass('hidden');
        $('#second-step-wrapper').removeClass('hidden').addClass('active');
        $('#fill-out-second').html('');

    });

    $('[data-toggle="tooltip"]').tooltip();


    /*third step validation*/

    $('#student-cv-form').on('submit', function(e){
        e.preventDefault();

        $('#third-step-wrapper .b-resume-input-div input').each(function(i,elem) {
            if ($('#third-step-wrapper .b-resume-input-div .check_error').length == 0 && $('.b-resume-form-english__item input:checked').length == 1 && $('#pub-offer:checked').length == 1 && $('#upload-pic').val() != '' && !!$('#courses').val() && $('#personal_qualities').val() != '' && $('#upload').val() != '') {
                $('#student-cv-form').unbind('submit');
                $('#student-cv-form').submit();
                var studentForm = document.getElementById('student-cv-form');
                var loading = document.getElementById('loading');
                loading.classList.add('active');
            } else {
                $('#personal_qualities').removeClass('check_error').addClass('student_error');
                $('#fill-out-third').html('Заполните все обязательные поля формы!');
            }
        });
    })

    /* course list input implementation BEGIN */

    var courseList = document.querySelector('.b-resume__course-list'),
        courseListSearch = document.getElementById('b-resume__course-list-item--search'),
        courseMenu = document.querySelector('.b-resume__course-menu'),
        courseMenuItems = document.getElementsByClassName('b-resume__course-menu-item'),
        courses = document.querySelector('#courses');

    courseListSearch.addEventListener('input', function(e) {
        var reg = new RegExp(escapeRegExp(e.target.value), 'i');
        for(var key in courseMenuItems) {
            if(!courseMenuItems.hasOwnProperty( key )) continue;

            if(!reg.test(courseMenuItems[key].innerText)) {
                courseMenuItems[key].style.display = 'none';
            } else {
                courseMenuItems[key].style.display = 'block';
            }
        }
    });

    // remove previous tag {

    courseListSearch.addEventListener('keydown', function(e) {
        var courseListItems = courseList.children;
        if(e.keyCode == 8 && !e.target.value.length && (courseListItems.length - 1)) {
            //to not overweight code just call 'click' event on the 'x' element
            courseListItems[courseListItems.length - 2].querySelector('.b-resume__course-close').click();
        }
    });

    // }
    courseMenu.addEventListener('click', function(e) {
        defaultMenu();
        attachCourseItem(e.target.innerText);
        e.target.style.display = 'none';
        hideMenu();
        courseListSearch.value = '';
    });

    function attachCourseItem(name) {
        var newEl = document.createElement('li');
        newEl.classList.add('b-resume__course-list-item');
        var span = document.createElement('span');
        span.innerText = name;
        span.classList.add('b-resume__course-name');
        var close = document.createElement('span');
        close.innerText = '×';
        close.classList.add('b-resume__course-close');
        close.addEventListener('click', detachCourseItem);
        newEl.insertAdjacentElement('afterbegin', span);
        newEl.insertAdjacentElement('beforeend', close);
        courseListSearch.parentNode.insertAdjacentElement('beforebegin', newEl);
        addCourse(name);
        moveMenu();
    }

    function addCourse(name) {
        if(courses.value != '')
            courses.value += ',';
        courses.value += name;
    }

    function detachCourseItem(e) {
        var cname;
        for(var i = 0; i < courseMenuItems.length; i++) {
            cname = courseMenuItems[i].innerText;
            if(cname == e.target.previousElementSibling.innerText) {
                courseMenuItems[i].style.display = 'block';
            }
        }
        removeCourse(e.target.previousElementSibling.innerText);
        courseList.removeChild(e.target.parentNode);
        moveMenu();
    }

    function removeCourse(courseName) {
        var valid = escapeRegExp(courseName);
        var reg = new RegExp(',*' + (valid));
        courses.value = courses.value.replace(reg, '');
    }

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }

    function moveMenu() {
        courseMenu.style.left = parseInt(courseListSearch.getBoundingClientRect().left - courseList.parentNode.getBoundingClientRect().left - 15) + 'px';
    }

    courseList.addEventListener('click', function() {
        courseListSearch.focus();
    });

    courseListSearch.addEventListener('focus', showMenu);

    courseListSearch.addEventListener('blur', function() {
        setTimeout(hideMenu, 200);
    });

    function showMenu() {
        courseMenu.classList.add('active');
    }

    function hideMenu() {
        if(document.activeElement != courseListSearch)
            courseMenu.classList.remove('active');
    }

    function defaultMenu() {
        for(var i = 0; i < courseMenuItems.length; i++) {
            courseMenuItems[i].style.display = 'block';
        }
    }

    /* course list input implementation END */
});

/* scripts from template } */