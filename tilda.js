$(window).load(function(){
    setTimeout(function () {
        window.tildaForm.successEnd = function($jform, successurl, successcallback) {
            iteaPost($jform);
            if ($jform.find('.js-successbox').length > 0) {
                if ($jform.find('.js-successbox').text() == '') {
                    var arMessage = window.tildaForm.arMessages[window.tildaBrowserLang] || {};
                    if (arMessage.success) {
                        $jform.find('.js-successbox').html(arMessage.success)
                    }
                }
                if ($jform.data('success-popup') == 'y') {
                    window.tildaForm.showSuccessPopup($jform.find('.js-successbox').html())
                } else {
                    $jform.find('.js-successbox').show()
                }
            }
            $jform.addClass('js-send-form-success');
            if (successcallback && successcallback.length > 0) {
                setTimeout(function () {
                    eval(successcallback + '($jform)')
                }, 500)
            } else {
                if (successurl && successurl.length > 0) {
                    setTimeout(function() {
                        window.location.href = successurl
                    }, 500)
                }
            }



            tildaForm.clearTCart($jform);
            $jform.find('input[type=text]:visible').val('');
            $jform.find('textarea:visible').html('');
            $jform.find('textarea:visible').val('');
            $jform.data('tildaformresult', {
                tranid: "0",
                orderid: "0"
            })

        }
    }, 300)


    function iteaPost(form) {
        var name = form.find('input[name=name]').val();
        var sum = form.find('input[name=sum]').val();
        var phone = form.find('input[name=phone]').val();
        var email = form.find('input[name=email]').val();
        var roadmapUuid = form.find('input[name=roadmapUuid]').val();
        var coursesUuid = form.find('input[name=coursesUuid]').val();
        var trial = form.find('input[name=trial]').val();
        var city = form.find('input[name=city]').val();
        var discountFromSite = form.find('input[name=discountFromSite]').val();
        var promo = form.find('input[name=promo]').val();
        var filiation = form.find('[name=filiation]').val();

        var arrayData = {
            'name'          : name,
            'sum'           : sum,
            'phone'         : phone,
            'email'         : email,
            'roadmapUuid'   : roadmapUuid,
            'coursesUuid'   : coursesUuid,
            'trial'         : trial,
            'city'          : city,
            'promo'         : promo,
            'filiation'     : filiation,
            'discountFromSite'          : discountFromSite,
            'host': window.location.host
        }

        console.log(arrayData);
        $.ajax({
            type: 'POST',
            // url: 'https://api.itea.ua/api/v1/online/proposal-pull/',
            url: 'https://itea.ua/tildatest.php',
            data: arrayData,
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8',
                // 'X-DEPARTMENT' : '16a73b83-6315-45b2-ac25-031ff5a83652'
            },
            success: function (response) {
                console.log(response)
            },
            error: function (request, status, error) {
                console.log('ERROR', request.responseText);
                console.log('error1error', error);
                console.log('status', status);
            }
        })
    }

});


