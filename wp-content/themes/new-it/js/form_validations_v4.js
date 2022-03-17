//course registration form validation
//connected with class .user-data-form
(function userDataForm() {
    var inputPP = document.querySelector('#input-privacy-policy') || 'notInput';
    var form = document.querySelector('.user-data-form'),
        keys = ['name', 'phone', 'mail'],
        userInputs = {//required inputs elements
            name: form.elements.name,
            phone: form.elements.phone,
            mail: form.elements.mail,
            course: form.elements.course || {value: true},// {value: true} is a little hack for validation if there is no such field at all
            name_of_child: form.elements.name_of_child || {value: true},
            age_of_child: form.elements.age_of_child || {value:true}
        };

    if(form.elements.course) {
        keys.push('course');
    }
    if(form.elements.name_of_child) {
        keys.push('name_of_child', 'age_of_child');
    }

    var userTip = document.querySelector('.b-courses-sing-up-hidden-tip');

    var regexDictionary = {
        //check if there are 3 characters at least
        name: /^\S+/,
        //check the format +38 (999) 999 9999
        phone: /^\+9\s\(\d{3}\)\s\d{3}\s\d{4}$/,
        //email copy paste of common pattern
        mail: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
        //check if the value equal to 0
        course: /^.+$/,
        name_of_child: /^\S{3,}/,
        age_of_child: /.+/
    };

    //going throw every element
    for(var key in userInputs) {
        //in the case of course: {value: true}
        if(!userInputs[key].addEventListener)
            continue;
        //hiding tips if input is focused
        userInputs[key].addEventListener('focus', (function(key) {
            return function() {
                this.style.borderBottomColor = 'rgb(19, 59, 84)';
            }
        })(key));
        //validation on blur
        userInputs[key].addEventListener('blur', (function(key) {
            return function() {//if you don't know what is that for => wrapper to pass the current key
                validate(key);
            }
        })(key));
    }

    function validate(key) {
        var value;
        try {
            value = userInputs[key].value;
        } catch (e) {
            //just in case everything is falling
            console.log('An error occurred: ' + e);
        }
        //checking the required field with regular expression
        passed[key] = regexDictionary[key].test(value);
        //if passed => hide the tip element
        userInputs[key].style.borderBottomColor = passed[key] ? 'rgb(19, 59, 84)' : 'red';
        if(!passed[key] && key == 'course') {
            document.getElementsByClassName('courses-list-option-default')[0].style.borderColor = 'red';
        }
    }

    //tester object
    var passed = {};
    passed.full = function() {
        var result = true;
        //check all required fields
        for(var i = 0; i < keys.length; i++)
            result = result && this[keys[i]];
        return result;
    };

    form.addEventListener('submit', function(e) {
        console.log(inputPP);
        console.log($(form).serialize());
        for(var i = 0; i < keys.length; i++)
            validate(keys[i]);
        if(!passed.full()) {
            e.preventDefault();
            e.stopImmediatePropagation();
            userTip.style.display = 'block';
        } else {
            if(inputPP!=='notInput'){
                if(inputPP.checked){
                    if(typeof callNew != 'undefined') callNew();
                    userTip.style.display = 'none';
                    document.getElementById('loading').classList.add('active');
                }else{
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    userTip.style.display = 'block';
                    inputPP.className = 'error';
                }
            }else{
                if(typeof callNew != 'undefined') callNew();
                userTip.style.display = 'none';
                document.getElementById('loading').classList.add('active');
            }
        }
    });
})();
