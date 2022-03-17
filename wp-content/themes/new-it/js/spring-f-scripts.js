(function() {
  jQuery("#userPhone").inputmask({mask: "+9 (999) 999 9999"});
  //
  var keys = ['name', 'phone', 'mail', 'course'];
  var form = document.querySelector('.user-data-form');
  //required inputs elements
  var userInputs = {
    name: form.elements.name,
    phone: form.elements.phone,
    mail: form.elements.mail,
    course: form.elements['user_selected_profession_IT']
  };
  var submitButton = form.elements.submit;
  var coursesSelect = document.getElementsByClassName('course-select')[0];
  var coursesItems = document.querySelectorAll('.flex-blocks li');
  var coursesHeading = document.querySelector('.course-select h2');
  var coursesInput = document.getElementById('free-select');
  
  coursesItems.forEach(function(item) {
      item.addEventListener('click', function () {
        var newValue = item.innerText
        coursesHeading.innerText = newValue;
        coursesInput.value = newValue;
        coursesSelect.classList.remove('input-error');
      });
  });
  
  coursesSelect.addEventListener('click', function() {
    coursesSelect.classList.toggle('active');
  });
  
  //going throw every element
  for(var key in userInputs) {
    //hiding tips if input is focused
    userInputs[key].addEventListener('focus', (function(key) {
      return function() {
        tips.classList.remove('validation-error');
        (function (key) {
          userInputs[key].classList.remove('input-error');
        })(key);
      }
    })(key));
    //validation on blur
    userInputs[key].addEventListener('blur', (function(key) {
      return function() {
        validate(key);
      }
    })(key));
  }
  
  //regular expressions for form validations
  var regexDictionary = {
    //check if there are 3 characters at least
    name: /.+/,
    //check the format +38 (999) 999 9999
    phone: /^\+9\s\(\d{3}\)\s\d{3}\s\d{4}$/,
    //email copy paste of common pattern
    mail: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    //check if the value equal to 0
    course: /^[^0]\S*/
  };
  
  var passed = {};
  passed.full = function() {
    //check all required fields
    return (this.name && this.phone && this.mail && this.course);
  };
  
  var tips = document.getElementsByClassName('form-validation')[0];
  // var alertShare = document.getElementsByClassName('form-alert__share')[0];  action disable

    function validate(key) {
    var value;
    if(userInputs[key].selectedIndex != undefined) {
      value = userInputs[key].selectedIndex;
    } else value = userInputs[key].value;
    //checking the required field with regular expression
    passed[key] = regexDictionary[key].test(value);
    //if passed => hide the tip element
    if (passed[key]) {
      tips.classList.remove('validation-error');
      if (key === 'course') {
        coursesSelect.classList.remove('input-error');
      } else {
        userInputs[key].classList.remove('input-error');
      }
    } else {
      tips.classList.add('validation-error');
      if (key === 'course') {
        coursesSelect.classList.add('input-error');
      } else {
        userInputs[key].classList.add('input-error');
      }
    }
  }
  
  form.addEventListener('submit', function(e) {
    for(var i = 0; i < keys.length; i++)
      validate(keys[i]);
    // alertShare.classList.add('alert-share_visible');
    if(!passed.full()) {
      e.preventDefault();
      submitButton.classList.add('submit-error');
    } else {
      document.getElementById('loading').classList.add('active');
      submitButton.classList.remove('submit-error');
    }
  });
  
  document.getElementById('free-select').addEventListener('focus', function() {
    document.getElementById('free-select').classList.add('active-arrow');
  });
  document.getElementById('free-select').addEventListener('blur', function() {
    document.getElementById('free-select').classList.remove('active-arrow');
  });
  document.getElementById('free-select').addEventListener('change', function() {
    document.getElementById('free-select').classList.remove('active-arrow');
  });
})();