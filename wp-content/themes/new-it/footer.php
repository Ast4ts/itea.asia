<?php
$lang = (get_locale() == 'ru_RU');
?>
</div><!-- /.content -->
<footer id="footer">

    <?php if (get_locale() != 'en_GB') { ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 footer-left-block">
                    <div class="row">
                        

                        <div class="col-md-6 col-sm-5 footer-title-courses">
                            <p><a href="<?php echo get_category_link( ($lang ? 22 : 219) ); ?>"><?php echo ( $lang ? 'Курсы' : 'Курси' ); ?></a></p>
                            <ul>
                                <li><a href="<?php echo get_category_link( ($lang ? 15 : 241) ); ?>">Frontend development</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 9 : 239) ); ?>">С++</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 8 : 237) ); ?>">C#</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 7 : 243) ); ?>">Java</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 5 : 247) ); ?>">PHP</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 4 : 245) ); ?>">JS development</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 12 : 249) ); ?>">Python</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 1589 : 987) ); ?>">Data Science</a></li>
<!--                                <li><a href="--><?php //echo get_category_link( ($lang ? 13 : 255) ); ?><!--">--><?php //echo ($lang ? 'Программирование под' : 'Програмування під' ); ?><!-- Android</a></li>-->
<!--                                <li><a href="--><?php //echo get_category_link( ($lang ? 14 : 257) ); ?><!--">--><?php //echo ($lang ? 'Программирование под' : 'Програмування під' ); ?><!-- IOS</a></li>-->
                                <li><a href="<?php echo get_category_link( ($lang ? 1378 : 1380) ); ?>">Mobile development</a></li>
                                
                                <li><a href="<?php echo get_category_link( ($lang ? 18 : 251) ); ?>">Веб-дизайн</a></li>
<!--                                <li><a href="--><?php //echo get_category_link( ($lang ? 18 : 251) ); ?><!--">Product Design</a></li>-->
<!--                                <li><a href="--><?php //echo get_category_link( ($lang ? 105 : 226) ); ?><!--">--><?php //echo ($lang ? 'Курсы для детей' : 'Курси для дітей'); ?><!--</a></li>-->
                                <li><a href="<?php echo get_category_link( ($lang ? 746 : 748) ); ?>"><?php echo ($lang ? 'Управление проектами' : 'Управління проектами'); ?></a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 673 : 675) ); ?>">DEVOPS</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 1677 : 675) ); ?>">Business analysis</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 1675 : 675) ); ?>">Тестирование</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 footer-sub-block">
                    <div class="row">
                        <div class="footer-sub-form">
                            <p class="footer-sub-form-title"><?php echo ($lang ? 'Подпишись на рассылку ITEA' : 'Підпишись на розсилку ITEA'); ?></p>
                            <p class="footer-sub-form-discription">
                                <?php
                                if($lang) {
                                    echo 'Узнавай о свежих <span>акциях и скидках</span>, вакансиях компании, предстоящих мероприятиях и многом другом.';
                                } else {
                                    echo 'Дізнавайся про нові <span>акції та знижки</span>, вакансії компанії, події та багато іншого.';
                                }
                                ?>
                            </p>
                            <form>
                                <input type="email" name="mailSub" required="" placeholder="<?php echo ($lang ? 'Введите' : 'Введіть'); ?> Ваш email">
                                <button><img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/grnMail.png"> <?php echo ($lang ? 'Подписаться' : 'Підписатись'); ?> </button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="footer-sub-links">
                            <a href="https://www.facebook.com/ITEA.Ashgabad/" rel="noopener noreferrer nofollow" class="fbL" target="_blank">
                                <span class="rotate">Facebook</span>
                            </a>
<!--                            <a href="https://twitter.com/ITEAua" rel="noopener noreferrer nofollow" class="twL" target="_blank">-->
<!--                                <span class="rotate">Twitter</span>-->
<!--                            </a>-->
                            
                            
                            <a href="https://www.instagram.com/itea.ashgabat/" rel="noopener noreferrer nofollow" class="inst" target="_blank">
                                <span class="rotate">Instagram</span>
                            </a>
<!--                            <a href="https://plus.google.com/b/115862013780160695262/+IteducateUa" rel="noopener noreferrer nofollow" class="gpL" target="_blank">-->
<!--                                <span class="rotate">Google+</span>-->
<!--                            </a>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 footer-left-block-show">
                    <div class="row">
                      
                        <div class="col-sm-2 footer-icons-courses">
                            <a href="https://www.facebook.com/ITEA.Ashgabad/" rel="noopener noreferrer nofollow" class="fbL" target="_blank">
                                <span class="rotate">Facebook</span>
                            </a>
<!--                            <a href="https://twitter.com/ITEAua" rel="noopener noreferrer nofollow" class="twL" target="_blank">-->
<!--                                <span class="rotate">Twitter</span>-->
<!--                            </a>-->
                           
                            <a href="https://www.instagram.com/itea.ashgabat/" rel="noopener noreferrer nofollow" class="inst" target="_blank">
                                <span class="rotate">Instagram</span>
                            </a>
<!--                            <a href="https://plus.google.com/b/115862013780160695262/+IteducateUa" rel="noopener noreferrer nofollow" class="gpL" target="_blank">-->
<!--                                <span class="rotate">Google+</span>-->
<!--                            </a>-->
                        </div>
                        <div class="col-md-6 col-sm-5 footer-title-courses">
                            <p><a href="<?php echo get_category_link( ($lang ? 22 : 219) ); ?>"><?php echo ( $lang ? 'Курсы' : 'Курси' ); ?></a></p>
                            <ul>
                                <li><a href="<?php echo get_category_link( ($lang ? 15 : 241) ); ?>">Frontend development</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 9 : 239) ); ?>">С++</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 8 : 237) ); ?>">C#</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 7 : 243) ); ?>">Java</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 5 : 247) ); ?>">PHP</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 4 : 245) ); ?>">JS development</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 12 : 249) ); ?>">Python</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 1589 : 987) ); ?>">Data Science</a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 1378 : 1380) ); ?>">Mobile development</a></li>
                                <!-- <li><a href="<?php //echo get_category_link( ($lang ? 16 : 259) ); ?>"><?php //echo ( $lang ? 'Тестирование' : 'Тестування' ); ?></a></li> -->
                                <li><a href="<?php echo get_category_link( ($lang ? 18 : 251) ); ?>">Веб дизайн</a></li>
<!--                                <li><a href="--><?php //echo get_category_link( ($lang ? 105 : 226) ); ?><!--">--><?php //echo ($lang ? 'Курсы для детей' : 'Курси для дітей'); ?><!--</a></li>-->
                                <li><a href="<?php echo get_category_link( ($lang ? 746 : 748) ); ?>"><?php echo ($lang ? 'Управление проектами' : 'Управління проектами'); ?></a></li>
                                <li><a href="<?php echo get_category_link( ($lang ? 673 : 675) ); ?>">DEVOPS</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="last">
        <div class="container">
            <span>&copy; IT Education Academy (ITEA) <?php echo date('Y') ?> | <?php
                switch (get_locale()) {
                    case 'ru_RU':
                        echo 'Все права защищены';
                        break;
                    case 'uk':
                        echo 'Всі права захищені';
                        break;
                    default:
                        echo 'All rights reserved';
                }
                ?></span>
        </div>
    </div>

  <div class="modal-wrapper modal-callback">
    <div class="b-header-contacte">
      <div class="b-header-contacte__close-btn"></div>
      <div class="b-header-contacte-phone-block">
        <h3 class="b-header-contacte__title"><?php echo(get_locale() != 'en_GB' ? ($lang ? 'Заполните форму' : 'Заповніть форму') : 'Fill the form'); ?></h3>
        <p class="b-header-contacte__detail"><?php echo(get_locale() != 'en_GB' ? ($lang ? 'И наши менеджеры свяжутся' : 'І наші менеджери зв\'яжуться') : 'And our managers will'); ?><br>
          <?php echo(get_locale() != 'en_GB' ? ($lang ? 'с вами в ближайшее время' : 'з вами найближчим часом') : 'contact you shortly'); ?></p>
        <form method="POST" action="javascript:void(null);" id="callback-form" class="b-header-contacte-phone-form">
          <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">

          <label for="b-contacte__full-name"><?php echo(get_locale() != 'en_GB' ? ($lang ? 'Имя и Фамилия' : 'Ім\'я і Прізвище') : 'Name'); ?></label>
          <input type="text" name="name" id="b-contacte__full-name" value="" placeholder="<?php echo(get_locale() != 'en_GB' ? ($lang ? 'Имя и Фамилия' : 'Ім\'я і Прізвище') : 'Name'); ?>">

          <label for="b-contacte-phone-tel" class="b-contacte__phone"><?php echo(get_locale() != 'en_GB' ? ($lang ? 'Телефон' : 'Телефон') : 'Phone'); ?></label>
          <input type="tel" name="phone" id="b-contacte-phone-tel" value="" required>

          <input type="submit" value="<?php echo(get_locale() != 'en_GB' ? ($lang ? 'Отправить' : 'Надіслати') : 'Send'); ?>">
        </form>
      </div>
      <div class="b-header-contacte-loader hidden">
        <img src="<?php echo get_template_directory_uri(); ?>/images/source-iloveimg-cropped.gif">
      </div>
      <div class="b-header-contacte-phone-thank hidden">
        <p>
          <?php echo (get_locale() != 'en_GB' ? ($lang ? 'Спасибо!<br>Наш менеджер свяжется с Вами.' : 'Дякуємо!<br>Наш менеджер зв\'яжеться з Вами.') : 'Thank you!<br>Our manager will contact you');
          ?>
        </p>
      </div>
    </div>
  </div>
  <!-- <div class="modal-wrapper modal-search">
    <div class="b-header-contacte">
      <div class="b-header-contacte__close-btn"></div>
      <div class="modal-search-form">
        <?php get_search_form(); ?>
        <button class="modal-search-btn"><?php echo $lang ? "Найты" : "Знайти"?></button>
      </div>
    </div>
  </div> -->

    <!-- <div class="modal-wrapper modal-policy">
        <div class="b-header-contacte modal-policy-content">
            <div class="b-header-contacte__close-btn"></div>
            <div class="b-header-contacte-phone-block">
                <h3 class="b-header-contacte__title">Политика конфиденциальности</h3>
                <p class="b-header-contacte__detail">
                    Академия обучения ИТ ITEA стремится открыто и в понятной форме сообщать своим пользователям о том, как собираются и обрабатываются их персональные данные. Мы ценим Вашу уверенность в том, что мы будем делать это тщательно и разумно.
                    <br><br>
                    Политика конфиденциальности предназначена для того, чтобы способствовать формированию у Вас понимания того, каким образом мы осуществляем сбор, раскрытие и обеспечение безопасности информации о Вас, получаемой нами в ходе посещения и просмотра Вами нашего веб-ресурса.
                    <br>
                    <br>
                    Продолжая использовать данный сайт и нажимая кнопку "Принять", Вы подтверждаете, что ознакомились с
                    <a href="/politika-konfidentsialnosti/">Политикой Конфиденциальности</a> и согласны на обработку Ваших персональных данных на изложенных в
                    <a href="/politika-konfidentsialnosti/">Политике Конфиденциальности</a> условиях.
                </p>
                <input id="acceptCookiePolicy" type="submit" value="Принять">
            </div>
        </div>
    </div> -->
    <style>
        body .modal-policy-content {
            max-width: 100%;
            width: 620px;
            padding: 42px 15px;
        }
        body .modal-policy-content a {
            color: #337ab7!important;
        }
        .show-policy .modal-policy {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
          $('#acceptCookiePolicy').on('click', () => {
            document.cookie = "policy_accept=1; domain="+window.location.host+"; path=/; max-age=7776000";
            $('body').removeClass('show-policy');
          })

          function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
              "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
          }
          let cookie = getCookie('policy_accept')

          if (!cookie) {
            $('body').addClass('show-policy');
          }
          $('.b-header-contacte__close-btn').on('click', function () {
            $('body').removeClass('show-policy');
          })
        })
    </script>
</footer>




<!--<div id="modal-holiday" class="modal fade modal-holiday__bg" tabindex="-1" role="dialog" aria-hidden="true">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="modal-holiday__wrapper offset-xs-1 col-xs-10">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>-->
<!--                <div class="modal-body ">-->
<!---->
<!--                    <div class="modal-holiday__title">--><?php //echo ( $lang ? 'itea отправляется на каникулы' : 'itea вирушає на канікули' ); ?><!--</div>-->
<!---->
<!--                    <p><span>--><?php //echo ( $lang ? 'C 01.01.2019 по 08.01.2019' : 'З 01.01.2019 по 08.01.2019' ); ?><!--</span> --><?php //echo ( $lang ? ' заявки принимаются онлайн, а связываться с вами и уточнять детали мы будем ' : 'заявки приймаються онлайн, а зв\'язуватися з вами і уточнювати деталі ми будемо ' ); ?><!--<span>--><?php //echo ( $lang ? 'c 9.01' : 'з 9.01' ); ?><!--</span></p>-->
<!--                    <div class="modal-body__trees clearfix">-->
<!--                        <div class="col-xs-4">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/relize/img/popup-holiday/christmas-tree-s.png" class="img-responsive" alt="">-->
<!--                        </div>-->
<!--                        <div class="col-xs-8">-->
<!--                            <img src="--><?php //bloginfo('template_directory'); ?><!--/relize/img/popup-holiday/christmas-tree-l.png" class="img-responsive" alt="">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <p>--><?php //echo ( $lang ? 'Возьмите участие в розыгрыше<br>скидок до ' : 'Візьміть участь в розіграші <br>знижок до ' ); ?><!--<span> -50%</span></p>-->
<!---->
<!--                    <a class="modal-holiday__discount" href="--><?php //echo ( $lang ? '/newyear2019/' : '/uk/newyear-2019/' ); ?><!--">--><?php //echo ( $lang ? 'Получить скидку' : 'Отримати знижку' ); ?><!--</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php
if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
    strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')!==false ||
    strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false){ ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/styles.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/styles_v35.css">


    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/english-style.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/resume_v7.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/roadmap_v16.css">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/tag-it.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/zendesk.css">

    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/modal-holiday.css">
<?php }else{ ?>
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/css/styles.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/css/styles_v35.css" as="style" onload="this.onload=null;this.rel='stylesheet';">


    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/css/english-style.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/css/resume_v7.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/css/roadmap_v16.css" as="style" onload="this.onload=null;this.rel='stylesheet';">

    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/jquery-ui.theme.min.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/tag-it.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/relize/js/jquery-ui/zendesk.css" as="style" onload="this.onload=null;this.rel='stylesheet';">

    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/css/modal-holiday.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
<?php } ?>



<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&subset=latin,cyrillic">



<?php if(is_front_page()):?>
    <script src="<?php bloginfo('template_directory'); ?>/relize/particles/particles.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/relize/particles/app.js"></script>
<?php endif;?>

<script src="<?php bloginfo('template_directory'); ?>/relize/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/idangerous.swiper.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/idangerous.swiper.scrollbar-2.1.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/cookie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/mask.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/nanoscroll.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/main_v10.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/isotope.pkgd.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery.pin.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/jquery.masonry.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/header-only.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/utm_cookie.js"></script>



<script>
//   // *********************** Script for Popup **********************************
//     var startDate = new Date('1/1/2019 03:00:00'); //
//     var endDate = new Date('1/9/2019 03:00:00'); //
//     var now = new Date();
//     // console.log('startDate', startDate.getTime());
//     // console.log('endDate', endDate.getTime());
//     // console.log('now', now);
//     // console.log('is?', !$.cookie('good') && ((startDate.getTime() < now.getTime()) && (now.getTime() < endDate.getTime())));
//
//     $( document ).ready(function() {
// //Проверяем если ли в куках запись, что посетитель уже был
// //         if (!$.cookie('good') && (now.getTime() < userEntered.getTime())) {
//         if (localStorage.getItem('holiday') !== 'on' && (startDate.getTime() < now.getTime()) && (now.getTime() < endDate.getTime())) {
//             $("#modal-holiday").modal({
//                 backdrop: 'static',
//                 keyboard: true,
//                 show: true
//             }); //метод Bootstrap
//           localStorage.setItem('holiday', 'on');
//         }
//         if (now.getTime() > endDate.getTime()) {
//           localStorage.removeItem('holiday');
//         }
// //создаем куки
// //         var date = new Date();
// //         date.setTime(date.getTime() + (3600 * 1000 * 12));
// //         $.cookie('good', true, {expires: date, path: '/'} );
//     });
</script>



<script type="text/javascript">
    $('.footer-sub-form form').on('submit',function(e) {
        $.ajax({
            type: 'POST',
            url:  'https://itea.ua/wp-content/plugins/the-events-calendar/src/views/subscribe.php',
            data: $(this).serialize(),
            success: function () {
                $('.footer-sub-block .row .footer-sub-form').html('<p align="center"><?php echo ( $lang ? 'Спасибо за подписку!' : 'Дякую за підписку!' ); ?></p>');
            }
        });
        e.preventDefault();
        return false;
    });
</script>


<?php wp_footer(); ?>


<script type="text/javascript">
    var google_tag_params =
        { edu_pid: 'REPLACE_WITH_VALUE', edu_plocid: 'REPLACE_WITH_VALUE', edu_pagetype: 'REPLACE_WITH_VALUE', edu_totalvalue: 'REPLACE_WITH_VALUE', };
</script>
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 940432893;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/940432893/?guid=ON&script=0"/>
    </div>
</noscript>



<script src="/wp-content/themes/new-it/js/detect.js"></script>
<script>
    window.addEventListener("load", function () {
        var user = detect.parse(navigator.userAgent);
        //console.log(user);
        //jQuery('body').append('<span>'+user.browser.family+' = '+~user.browser.family.indexOf("Firefox")+'</span>');
        if(~user.browser.family.indexOf("Firefox") || ~user.device.family.indexOf("iPhone") || ~user.device.family.indexOf("iPad") || ~user.browser.family.indexOf("Safari") || ~user.browser.family.indexOf("Android")){
            jQuery(document).ready(function(){
                jQuery('body link[rel="preload"]').each(function(){
                    jQuery(this).attr('rel','stylesheet');
                });
            });
        }
    });
</script>

<script>var telerTrackerWidgetId="2583c3d0-35b9-44ba-9f0e-6811232d9cac"; var telerTrackerDomain="itea.phonet.com.ua";</script>
<!-- <script src="//itea.phonet.com.ua/public/widget/call-tracker/lib.js"></script> -->
<!-- <script>
    window.replainSettings = { id: '888842ed-39bf-4a0d-ab29-bc576c1752aa' };
    (function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
        var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
    })('https://widget.replain.cc/dist/client.js');
</script> -->
</body>
</html>
