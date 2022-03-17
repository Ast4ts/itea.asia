(function () {
  var gmap = document.getElementsByTagName('iframe')[0];
  var maps = [
    // 'https://www.google.com/maps/d/embed?mid=1UXyxl1hh20UEgVSNIRBGEGNms8JO-SU-&language=',
    // 'https://www.google.com/maps/d/embed?mid=1oJnl3Veyc_exTftxxjUfpo1UBPR9r3uz&ll=50.42647035959107%2C30.522956967968753&z=11',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d402638.1679466421!2d57.97009812724136!3d37.9628752916335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6ffe1bab3684d9%3A0x3cde013f62d3ade9!2z0JDRiNGF0LDQsdCw0LQsINCi0YPRgNC60LzQtdC90LjRgdGC0LDQvQ!5e0!3m2!1sru!2sua!4v1621399836266!5m2!1sru!2sua',
    'https://www.google.com/maps/d/embed?mid=10rF8qOXW79Owxn3Q1SuFiyGFsRjzk4gj&ll=50.41343350198632%2C30.525703550000003&z=11',

    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2573.684872414755!2d23.990439151493465!3d49.8295877396844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473ae77e64398c01%3A0xbab766eca34c6d62!2z0LLRg9C70LjRhtGPINCT0LXRgNC-0ZfQsiDQo9Cf0JAsIDgwLCDQm9GM0LLRltCyLCDQm9GM0LLRltCy0YHRjNC60LAg0L7QsdC70LDRgdGC0YwsIDc5MDAw!5e0!3m2!1suk!2sua!4v1547627672939&language=',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5769.814317918668!2d35.04502106198706!3d48.466668469065915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDjCsDI4JzAyLjIiTiAzNcKwMDInNTIuOCJF!5e0!3m2!1sru!2sua!4v1565781674476!5m2!1sru!2sua',
    //'https://www.google.com/maps/embed/v1/place?q=place_id:EmjQv9GA0L7RgdC_0LXQutGCINCT0LDQs9Cw0YDRltC90LAsIDEwLCDQpdCw0YDQutGW0LIsINCl0LDRgNC60ZbQstGB0YzQutCwINC-0LHQu9Cw0YHRgtGMLCDQo9C60YDQsNGX0L3QsA&key=AIzaSyCwLLmhVR_GGhjGyeeEc9PIQ-KojrWva-M&language=',
    // 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10260.669965749417!2d36.2223549!3d49.9894692!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9c90f7f9e6de783!2sFabrika.space!5e0!3m2!1sru!2sua!4v1543414166824',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2565.1679405599875!2d36.22016225167111!3d49.989460779313376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a0f9c7a6a7e3%3A0x9c90f7f9e6de783!2sFabrika.space!5e0!3m2!1sru!2sua!4v1600949648828!5m2!1sru!2sua&language=',//Харьков
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2747.2514465727254!2d30.741682951574823!3d46.483333279023846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c631989c254863%3A0x7da3c2cef5e0a8f2!2z0YPQuy4g0JTQtdGA0LjQsdCw0YHQvtCy0YHQutCw0Y8sIDUsINCe0LTQtdGB0YHQsCwg0J7QtNC10YHRgdC60LDRjyDQvtCx0LvQsNGB0YLRjCwgNjUwMDA!5e0!3m2!1sru!2sua!4v1600949600338!5m2!1sru!2sua&language=',//Одесса
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2484.4631429679844!2d-0.016231348519439723!3d51.486367919961644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876029104269b7b%3A0x54f76f1f39e27e1c!2zNiBTdCBEYXZpZHMgU3F1YXJlLCBJc2xlIG9mIERvZ3MsIExvbmRvbiwg0JLQtdC70LjQutC-0LHRgNC40YLQsNC90LjRjw!5e0!3m2!1sru!2sus!4v1565791266146!5m2!1sru!2sus',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.6219599256463!2d10.722943816096313!3d59.92182118187007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416dd6397d5e7d%3A0x27a707aabe8caa68!2zT3NjYXJzIGdhdGUgMjcsIDAzNTIgT3Nsbywg0J3QvtGA0LLQtdCz0LjRjw!5e0!3m2!1sru!2sua!4v1600949540082!5m2!1sru!2sua&language=',//Осло
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2995.0862452012957!2d69.20440451127435!3d41.35047909263402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8c17e75b2329%3A0x26ba8d46c20d2d3!2zNCDQo9C90LjQstC10YDRgdC40YLQtdGCINGD0LsuLCDQotCw0YjQutC10L3RgiAxMDAxNzQsINCj0LfQsdC10LrQuNGB0YLQsNC9!5e0!3m2!1sru!2sua!4v1539764073705&language=',
      'https://www.google.com/maps/d/embed?mid=1Mzx7p9BUJc5OlEeD6H_IgNq0b3KAYPt4&language='
  ];
  gmap.src = maps[0] + language;
  var navs = document.querySelectorAll('.q-contacts .nav-tabs li a');
  var details = document.querySelectorAll('.q-contacts .details ul');
  document.querySelector('.q-contacts .details ul').classList.add('in');
  var prevDet = details[0];
  for (var i = 0, len = navs.length; i < len; i++) {
    navs[i].addEventListener('click', function (e) {
      removeActive();
      var index = 0;
      for (var j = 0; j < len; j++) {
        if (e.target == navs[j]) {
          index = j;
          break;
        }
      }
      if (details[index] != prevDet) {
        gmap.src = maps[index] + language;
        details[index].classList.add('in');
        prevDet.classList.remove('in');
        prevDet = details[index];
      }
    });
  }
  var check = false;

  function contToggle() {
    check = !check;
    if (check) {
      addActive();
    } else {
      removeActive();
    }
  }

  function removeActive() {
    btnToggle.classList.remove('active');
    listWrapper.classList.remove('active');
    navTabs.classList.remove('active');
  }

  function addActive() {
    btnToggle.classList.add('active');
    listWrapper.classList.add('active');
    navTabs.classList.add('active');
  }

  var navTabs = document.querySelector('.q-contacts .nav-tabs');
  var listWrapper = document.querySelector('.contacts-list-wrapper');
  var btnToggle = document.querySelector('.btn-toggle-collapse');
  btnToggle.addEventListener('click', contToggle);
})();
