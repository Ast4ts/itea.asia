<section id="tilda-content-block" class="tilda-content-block">
    <?= $content = apply_filters('the_content', get_post_field('post_content', $post->ID));?>


    <?php
    $price = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
    $dis = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont', true);
    $dis_left = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-left', true);
    $dis_vdbh = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-vdnh', true);
    $isMonth = get_post_meta(pll_get_post($post->ID, 'ru'), 'ismonth', true);
    $weeks = get_post_meta(pll_get_post($post->ID, 'ru'), 'weeks', true);

    if (!empty($dis) || !empty($dis_left) || !empty($dis_vdbh)) {
        $oldPrice = $price;
        $price = nicePrice(ceil($price * (100 - $dis) / 100));
        $oldPartsPrice = nicePrice(ceil($oldPrice / $weeks * 1.15));
        $partsPrice = nicePrice(ceil($price / $weeks * 1.15));
        $partsPriceLeft = nicePrice(ceil($price / $weeks * 1.15));
    } else {
        $partsPrice = nicePrice(floor($price / $weeks * 1.15));
    }


    $Uuid_right_band = 'e7f33e0e-9605-4f0b-8ed3-7de8cde053b7';
    $Uuid_left_band = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0';
    $Uuid_vdnh_band = 'd6272609-b556-4d4d-8cf4-6d72b4517181';

    $hidensInputs = array();
    $hidensInputs[] = '<input type="hidden" name="parts_price" value="' . $partsPrice . ' x' . $weeks . '">';
    $hidensInputs[] = '<input type="hidden" name="price" value="' . $price . '">';
    $hidensInputs[] = '<input type="hidden" name="discountFromSite" value="">';
    $hidensInputs[] = '<input type="hidden" name="course_id" value="' . $post->ID . '">';
    $hidensInputs = implode(' ', $hidensInputs);
    ?>

    <form method="POST" class="user-data-form" action="<?= esc_url(add_query_arg('action', 'regForEveningCourses', admin_url('admin-post.php')))?>" style="display:none;">
        <input type="hidden" name="verification"
               value="<?= wp_create_nonce('ITEA_of_the_best!'); ?>">
        <input type="hidden" name="locationCourses" value="<?php echo $Uuid_right_band; ?>">
        <input name="name" type="text" id="name" >
        <input name="mail" type="email" id="email" >
        <input name="phone" type="text" id="phone" >
        <textarea name="comment" type="text"></textarea>
        <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy" checked>

        <input type="hidden" name="segment_type" value="b2c_order">

        <input type="submit" id="sendregForEveningCourses" value="Записаться">

        <?= (isset($hidensInputs) ? $hidensInputs : ''); ?>
    </form>
</section>
<style>
    .course-content-block, .recommended-sources {
        display: none;
    }
    .tilda-content-block svg {
        height: auto;
        padding-top: inherit;
        padding-bottom: inherit;
    }
    .tilda-content-block *{
        font-family: inherit!important;
    }
    .tilda-content-block b,.tilda-content-block strong {
        color: inherit;
    }
</style>
<script>
    window.addEventListener('load', function() {
        window.tildaForm.successEnd = function($jform, successurl, successcallback) {
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
                eval(successcallback + '($jform)')
            } else {
                if (successurl && successurl.length > 0) {
                    setTimeout(function() {
                        window.location.href = successurl
                    }, 500)
                }
            }
            completeRegForEvening($jform);

            tildaForm.clearTCart($jform);
            $jform.find('input[type=text]:visible').val('');
            $jform.find('textarea:visible').html('');
            $jform.find('textarea:visible').val('');
            $jform.data('tildaformresult', {
                tranid: "0",
                orderid: "0"
            })

        };
        function completeRegForEvening (form) {
            console.log('ok');
            $("#name").val( form.find("[name=name]").val() );
            $("#email").val( form.find("[name=email]").val() );
            $("#phone").val( "380"+form.find("[type=tel]").val() );
            $("#sendregForEveningCourses").click();
        }

    });
</script>