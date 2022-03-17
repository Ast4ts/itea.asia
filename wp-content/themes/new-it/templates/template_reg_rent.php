<?php /* Template Name: Заявка на аренду */ ?>

<?php
hideLangSwitchAndSetCorrectLang();
get_header();
$lang = (get_locale() == 'ru_RU');

global $post;
$segment_type = str_replace('_step1', '', $post->post_name);
?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/classic.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/classic.date.css" />
<script src="<?php bloginfo('template_directory'); ?>/relize/js/picker.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/picker.date.js"></script>

<div class="container regDiv">
    <div id="loading"><div id="loading-animation"></div></div>
    <section id="contact" class="datePicker">
        <div class="container_12">
            <div class="grid_6">
                <h1><?php echo $lang ? get_the_title() : get_the_excerpt(); ?></h1>
                <br><br>

                <form method="POST" id="cnt-order" class="user-data-form" action="<?php echo esc_url(add_query_arg('action', 'regForDayCourses', admin_url('admin-post.php'))); ?>">
                    <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">
                    <input type="hidden" name="segment_type" value="<?php echo $segment_type; ?>">

                    <p class="b-courses-sing-up-hidden-tip">
                        <?php if ($lang) { ?>
                            Пожалуйста, заполните все обязательные поля формы
                        <?php } else { ?>
                            Будь ласка, заповніть всі обов'язкові поля форми
                        <?php } ?>
                    </p>

                    <div class="items">
                        <div class="group">
                            <input name="name" type="text" id="course-sign-up-name">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label><span class="red">* </span>
                                <?php if ($lang) { ?>
                                    Имя и Фамилия
                                <?php } else { ?>
                                    Ім'я та прізвище
                                <?php } ?>
                            </label>
                        </div>
                        <div class="group">
                            <input name="phone" type="tel" id="maskTel" autocomplete="off"  value="">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label><span class="red">* </span>Телефон</label>
                        </div>
                        <div class="group">
                            <input name="mail" type="email" id="course-sign-up-email"value="">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label><span class="red">* </span>E-mail</label>
                        </div>
                        <div class="group">
                            <input name="comment" type="text">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>
                                <?php if ($lang) { ?>
                                    Комментарий
                                <?php } else { ?>
                                    Коментар
                                <?php } ?>
                            </label>
                        </div>

                        <input
                            id="input_01"
                            class="datepicker"
                            name="rental_date"
                            type="text"
                            autofocuss
                            value="<?php echo date('d.m.y'); ?>"
                            data-valuee="<?php echo date('y-m-d'); ?>">
                        <button class="submit">
                            <div class="progress"></div>
                            <i></i><span><?php echo $lang ? 'Отправить заявку' : 'Відправити заявку'; ?></span>
                        </button>
                    </div>

                    <style>
                        #privacy-policy{width: 100%;display: flex;margin-top: 25px}
                        #privacy-policy>label{padding-right: 10px;box-sizing: border-box;position: relative;display: block;top: 0;left: 0;margin: 0;}
                        #privacy-policy>label>input{display: none;}
                        #privacy-policy>label>span{display: block;width: 20px;height: 20px;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);border-radius: 3px;background-color: #ffffff;border:1px solid #010101;position: relative;cursor: pointer;}
                        #privacy-policy>label>input.error+span{border-color:#e61a4b;box-shadow: 0 2px 10px rgba(230, 26, 75, 0.2);}
                        #privacy-policy>label>input.error:checked+span{border-color:#010101;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);}
                        #privacy-policy>label>span:after{content: "";position: absolute;width: 11px;height: 5px;border: 2px solid #0bac7c;border-top:0;border-right:0;top: 42%;left: 50%;-webkit-transform: translate(-50%,-50%) rotate(-45deg);transform: translate(-50%,-50%) rotate(-45deg);display: none;}
                        #privacy-policy>label>input:checked+span:after{display:block;}
                        #privacy-policy>p,#privacy-policy>p>a{font-size: 11px;color: #606f7e;line-height: 16px;}
                        #privacy-policy>p>a{color:#e61a4b;}
                    </style>
                    <div id="privacy-policy">
                        <label for="input-privacy-policy">
                            <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy">
                            <span></span>
                        </label>
                        <p>
                            <?php if ($lang) { ?>
                                Подписанием и отправкой настоящей заявки я подтверждаю, что я ознакомлен с <br><a href="/politika-konfidentsialnosti/" target="_blank">Политикой конфиденциальности</a> и принимаю ее условия, включая регламентирующие обработку моих персональных данных, и согласен с ней.
                            <?php } else { ?>
                                Підписанням і відправкою справжньою заявки я підтверджую, що я ознайомлений з <br><a href="/uk/politika-konfidentsiynosti/" target="_blank">Політикою конфіденційності</a> і приймаю її умови, включаючи регламентуючу обробку моїх персональних даних, і згоден з нею.
                            <?php } ?>
                        </p>
                    </div>

                    <?php /* ?><p class="hiddenText">
                        <?php if ($lang) { ?>
                            * Отправляя заявку, я даю согласие на обработку моих персональных данных.
                            Компания ITEA обязуется не передавать данную информацию 3-лицам.
                        <?php } else { ?>
                            * Відправляючи заявку, я даю згоду на обробку моїх персональних даних.
                            Компанія ITEA зобов'язується не передавати цю інформацію 3-особам.
                        <?php } ?>
                    </p><?php /**/ ?>
                </form>
            </div>
            <div class="grid_6 date">
                <h3>
                    <?php if ($lang) { ?>
                        Выберите дату планируемой аренды помещения</h3>
                    <?php } else { ?>
                        Оберіть заплановану дату оренди приміщення
                    <?php } ?>
                <div id="datepicker"></div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    var a = false;
    var $input = $('.datepicker').pickadate({
        today: '',
        formatSubmit: 'yyyy/mm/dd',
        min: true,
        container: '#datepicker',
        closeOnSelect: true,
        closeOnClear: false,
        monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
        monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
        weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
        weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
        clear: '',
        close: '',
        firstDay: 1,
        format: 'd mmmm yyyy г.'
    });

    var picker = $input.pickadate('picker');
    picker.set('select', '<?php echo date('d.m.y'); ?>')
</script>

<script src="<?php bloginfo('template_directory'); ?>/js/form_validations_v4.js"></script>

<?php get_footer(); ?>