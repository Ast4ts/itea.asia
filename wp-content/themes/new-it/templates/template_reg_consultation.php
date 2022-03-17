<?php /* Template Name: Заявка на бесплатную консультацию */ ?>

<?php
$lang = (get_locale() == 'ru_RU');

global $post;
$segment_type = str_replace('_step1', '', $post->post_name);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title><?php wp_title(); ?></title>

    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reg-consultation_v3.css">
</head>
<body>

<header class="centred">
    <a class="img-responsive apply-form-link" href="<?php echo get_home_url(); ?>">
        <img src="<?php bloginfo('template_directory'); ?>/images/reg_consultation/apply-logo.png" alt="itea">
    </a>
</header>

<div id="loading"><div id="loading-animation"></div></div>

<section id="main-form" class="centred">
    <form method="post" class="user-data-form" action="<?php echo esc_url(add_query_arg('action', 'regForConsultation', admin_url('admin-post.php'))); ?>">
        <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">
        <input type="hidden" name="segment_type" value="<?php echo $segment_type; ?>">

        <h1><?php echo get_the_title(); ?></h1>

        <input type="text" name="name" value="" placeholder="Введите Ваше Ф.И.О." autocomplete="off">
        <span class="form-validation form-validation__userName">Введите коректное имя</span>

        <input type="phone" name="phone" id="userPhone" value="" placeholder="Введите Ваш телефон">
        <span class="form-validation form-validation__userPhone">Введите коректный номер</span>

        <input type="email" name="mail" value="" placeholder="Введите E-mail">
        <span class="form-validation form-validation__userEmail">Введите коректный адрес</span>

        <p>Интересующее направление в IT:</p>
        <select id="free-select" name="user_selected_profession_IT" title="">
            <option disabled="disabled" selected="selected">Выберите направление</option>
            <option value="Backend">Backend</option>
            <option value="Frontend">Frontend</option>
            <option value="Mobile Development">Mobile Development</option>
            <option value="Тестирование (QA)">Тестирование (QA)</option>
            <option value="Web/UI/UX design">Web/UI/UX design</option>
            <option value="Other">Другое</option>
        </select>
        <span class="form-validation form-validation__course">Выберите направление</span>

        <input type="submit" value="Отправить заявку" style="margin-top: 20px;">
        <style>
            #privacy-policy{width: 100%;display: flex;margin-top: 25px}
            #privacy-policy>label{padding-right: 10px;box-sizing: border-box;position: relative;display: block;top: 0;left: 0;margin: 0;overflow: visible;}
            #privacy-policy>label>input{display: none;}
            #privacy-policy>label>span{display: block;width: 20px;height: 20px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);border-radius: 3px;background-color: #ffffff;border:1px solid #010101;position: relative;cursor: pointer;}
            #privacy-policy>label>input.error+span{border-color:#e61a4b;box-shadow: 0 2px 10px rgba(230, 26, 75, 0.2);}
            #privacy-policy>label>input.error:checked+span{border-color:#010101;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);}
            #privacy-policy>label>span:after{content: "";position: absolute;width: 11px;height: 5px;border: 2px solid #0bac7c;border-top:0;border-right:0;top: 42%;left: 50%;-webkit-transform: translate(-50%,-50%) rotate(-45deg);transform: translate(-50%,-50%) rotate(-45deg);display: none;}
            #privacy-policy>label>input:checked+span:after{display:block;}
            #privacy-policy>p,#privacy-policy>p>a{font-size: 11px;color: #606f7e;line-height: 16px;}
            #privacy-policy>p{margin: 0;text-align: left;}
            #privacy-policy>p>a{color:#e61a4b;}
        </style>
        <div id="privacy-policy">
            <label for="input-privacy-policy">
                <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy">
                <span></span>
            </label>
            <p>
                <?php if ($lang) { ?>
                    Подписанием и отправкой настоящей заявки я подтверждаю, что я ознакомлен с <a href="/politika-konfidentsialnosti/" target="_blank">Политикой конфиденциальности</a> и принимаю ее условия, включая регламентирующие обработку моих персональных данных, и согласен с ней.
                <?php } else { ?>
                    Підписанням і відправкою справжньою заявки я підтверджую, що я ознайомлений з <a href="/uk/politika-konfidentsiynosti/" target="_blank">Політикою конфіденційності</a> і приймаю її умови, включаючи регламентуючу обробку моїх персональних даних, і згоден з нею.
                <?php } ?>
            </p>
        </div>
    </form>
</section>

<footer>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/consultation_scripts_v3.js"></script>
<!-- Google Code for &#1047;&#1072;&#1087;&#1086;&#1083;&#1085;&#1077;&#1085;&#1080;&#1077; &#1079;&#1072;&#1103;&#1074;&#1082;&#1080; Conversion Page -->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 940432893;
    var google_conversion_language = "en";
    var google_conversion_format = "3";
    var google_conversion_color = "ffffff";
    var google_conversion_label = "ZJbqCLKDrWAQ_bu3wAM";
    var google_remarketing_only = false;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/940432893/?label=ZJbqCLKDrWAQ_bu3wAM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>
<script>var telerTrackerWidgetId="2583c3d0-35b9-44ba-9f0e-6811232d9cac"; var telerTrackerDomain="itea.phonet.com.ua";</script> <script src="//itea.phonet.com.ua/public/widget/call-tracker/lib.js"></script>
</body>
</html>