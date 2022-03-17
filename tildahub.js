$(document).ready(function () {
  window.tildaForm.successEnd = function($jform, successurl, successcallback) {
  //   if ($jform.find('.js-successbox').length > 0) {
  //     if ($jform.find('.js-successbox').text() == '') {
  //       var arMessage = window.tildaForm.arMessages[window.tildaBrowserLang] || {};
  //       if (arMessage.success) {
  //         $jform.find('.js-successbox').html(arMessage.success)
  //       }
  //     }
  //     if ($jform.data('success-popup') == 'y') {
  //       window.tildaForm.showSuccessPopup($jform.find('.js-successbox').html())
  //     } else {
  //       $jform.find('.js-successbox').show()
  //     }
  //   }
  //   $jform.addClass('js-send-form-success');
  //   if (successcallback && successcallback.length > 0) {
  //     eval(successcallback + '($jform)')
  //   } else {
  //     if (successurl && successurl.length > 0) {
  //       setTimeout(function() {
  //         window.location.href = successurl
  //       }, 500)
  //     }
  //   }
    console.log('$jform', $jform)
  //   iteaPost($jform);
  //
  //   tildaForm.clearTCart($jform);
  //   $jform.find('input[type=text]:visible').val('');
  //   $jform.find('textarea:visible').html('');
  //   $jform.find('textarea:visible').val('');
  //   $jform.data('tildaformresult', {
  //     tranid: "0",
  //     orderid: "0"
  //   })


    let currentForm = $jform.attr('id')
    console.log(currentForm)
    let arr = {}
    $($jform.serializeArray()).each(function (i, el) {
      console.log(i, el)
      arr[el.name] = el.value
    })
    console.log(arr)
    let sendData = {
      'startDate': arr['Date'] || arr['date'],
      'startTime': arr['time'],
      'department': 'e662a805-13be-4867-8dfe-865eef36850d',
      'count': 1,
      'seatCount': 1,
      'comment': arr['Textarea'],
      'tax': currentForm != 'form154997802' ? arr['Selectbox'] : trailRoom[0].uuid,
      'contact': {
        'email': arr['email'],
        'firstName': arr['name'],
        'lastName': arr['surname'],
        'phone': arr['phone']
      }
    }
    $.ajax({
      url: 'https://crm.iteahub.com/sites-api/v1/reserve/' + ((currentForm == 'form155171435') ? 'external-event' : 'coworking-request'),
      headers: { 'Authorization': 'Bearer ' + token },
      contentType: 'application/json',
      dataType: 'json',
      method: 'POST',
      data: JSON.stringify(sendData),
      success: function (response) {console.log(response)}
    })

  }




  let to_token_data = {
    client_id: '1_2f6cm82v9ytc84480okggw4w0owk8oo8g0og0c8848k0wcgs8o',
    client_secret: '1pr668b2pfhcokg0cok00g8k8gwwks4ck8co0sgsooko484wwc',
    grant_type: 'client_credentials',
    username: 'customer@user.com',
    password: 'customeruser'
  }
  let data = {}
  let token = ''
  let token_data = $.ajax({
    url: 'https://crm.iteahub.com/oauth/v2/token',
    contentType: 'application/json',
    dataType: 'json',
    method: 'POST',
    data: JSON.stringify(to_token_data),
    success: onAjaxSuccessToken
  })

  function onAjaxSuccessToken (response) {
    token = response.access_token
    $.ajax({
      url: 'https://crm.iteahub.com/sites-api/v1/tax/department/e662a805-13be-4867-8dfe-865eef36850d',
      method: 'GET',
      headers: { 'Authorization': 'Bearer ' + response.access_token },
      success: onAjaxSuccess
    })
  }

  function onAjaxSuccess (response) {
    data = response
    monthNoFixed = data.payload.filter((item) => {return ((item.type == 'coworking') && (item.taxMinPeriod == 'month') && (item.fixedPlace == false) && (item.trial == false))})
    dayNoFixed = data.payload.filter((item) => {return ((item.type == 'coworking') && (item.taxMinPeriod == 'day') && (item.fixedPlace == false) && (item.trial == false))})
    hourNoFixed = data.payload.filter((item) => {return ((item.type == 'coworking') && (item.taxMinPeriod == 'hour') && (item.fixedPlace == false) && (item.trial == false))})
    orderFixed = data.payload.filter((item) => {return ((item.type == 'coworking') && (item.taxMinPeriod == 'month') && (item.fixedPlace == true) && (item.trial == false))})
    privateRoom = data.payload.filter((item) => {return ((item.privateRoom == true) && (item.taxMinPeriod == 'month') && (item.trial == false))})
    eventRoom = data.payload.filter((item) => {return item.type == 'event'})
    trailRoom = data.payload.filter((item) => {return item.trial == true})

  }

  let monthNoFixed
  let dayNoFixed
  let hourNoFixed
  let orderFixed
  let privateRoom
  let eventRoom
  let trailRoom

  setTimeout(() => {
    let monthNoFixedForm = $('#form154997820')
    let dayNoFixedForm = $('#form155170501')
    let hourNoFixedForm = $('#form155170725')
    let orderFixedForm = $('#form155171841')
    let privateRoomForm = $('#form155170890')
    let eventRoomForm = $('#form155171435')
    let trailRoomForm = ('#form154997802')

    let select_content = ''
    monthNoFixed.forEach((item) => select_content += `<option value='${item.uuid}'>${item.name}</option>`)
    $(monthNoFixedForm).find('.t-select').html(select_content)

    select_content = ''
    dayNoFixed.forEach((item) => select_content += `<option value='${item.uuid}'>${item.name}</option>`)
    $(dayNoFixedForm).find('.t-select').html(select_content)

    select_content = ''
    hourNoFixed.forEach((item) => select_content += `<option value='${item.uuid}'>${item.name}</option>`)
    $(hourNoFixedForm).find('.t-select').html(select_content)

    select_content = ''
    orderFixed.forEach((item) => select_content += `<option value='${item.uuid}'>${item.name}</option>`)
    $(orderFixedForm).find('.t-select').html(select_content)


    select_content = ''
    privateRoom.forEach((item) => select_content += `<option value='${item.uuid}'>${item.name}</option>`)
    $(privateRoomForm).find('.t-select').html(select_content)

    select_content = ''
    console.log(eventRoomForm.find('.t-select'))
    eventRoom.forEach((item) => {
      select_content += `<option value='${item.uuid}'>${item.name}</option>`
    })
    $(eventRoomForm).find('.t-select').html(select_content)

    console.log(eventRoom)

  }, 3000)
})