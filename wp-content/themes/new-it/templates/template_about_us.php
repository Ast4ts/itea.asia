<?php /* Template Name: Страница "Про ITEA" */

$lang = (get_locale() == 'ru_RU');

get_header();
?>

<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/about_us_v3.css">

<div class="page-about-itea">
<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<section class="about-us-slider">
    <div>
        <h1>ITEA</h1>
        <p class="intro">
        <?php
        if($lang){
        ?>
            Международная образовательная компания комплексной <br> подготовки и развития специалистов IT-индустрии
        <?php
        } else {
        ?>
           Міжнародна освітня компанія комплексної <br> підготовки та розвитку спеціалістів IT-індустрії
       <?php }
        ?>
        </p>
    </div>
</section>
<section class="about-us-advantages">
    <h3><?php echo ( $lang ? 'Наши преимущества' : 'Наші переваги' ); ?></h3>
    <div class="about-icons ">
        <div class="col-hidden">
            <img class=" panda-img" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda_for_main.gif" alt="">
        </div>
        <div class="col-1-flex">
            <div  class="col-left-sm partisipation">
                <div class="feat-col reverse">
                <p class="text-alignment"><?php echo ( $lang ? 'Участие в мероприятиях' : 'Участь у заходах' ); ?> <span class="align-text"><?php echo ( $lang ? 'от ITEA' : 'від ITEA' ); ?></span></p>
                </div>
                <div class="feat-col">
                    <img src="<?php bloginfo('template_directory'); ?>/images/about_us/cup.png" alt="">
                </div>
            </div>
            <div class="col-left-sm align-col-lg">
                <div class="feat-col reverse">
                    <p class="text-info-desc"><?php echo ( $lang ? 'Компактные группы до' : 'Компактні групи до' ); ?> <span class="align-right">12 <?php echo ( $lang ? 'человек' : 'осіб' ); ?></span></p>
                </div>
                <div class="feat-col">
                    <img src="<?php bloginfo('template_directory'); ?>/images/about_us/community.png" alt="">
                </div>
            </div>
            <div  class="col-left-sm">
                <div class="feat-col reverse teaching">
                <p class="text-info-desc-1"><?php echo ( $lang ? 'Преподаватели-практики' : 'Викладачі-практики' ); ?> <span class="align-right-1"> <?php echo ( $lang ? 'из топ IT-компаний' : 'із топ IT-компаній' ); ?></span></p>
                </div>
                <div class="feat-col">
                    <img src="<?php bloginfo('template_directory'); ?>/images/about_us/speaker.png" alt="">
                </div>
            </div>
        </div>
        <div class="col-2-flex">
            <img class=" panda-img" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda_for_main.gif" alt="">
        </div>
        <div class="col-3-flex">
            <div class="col-right-sm">
                <div class="feat-col">
                    <img src="<?php bloginfo('template_directory'); ?>/images/about_us/intern.png" alt="">
                </div>
                <div class="feat-col reverse align-left-col">
                    <p class="text-alignment">
                        <?= ( $lang ? 'Сотрудничество с JUNGO <span style="display: block">платформой для трудоустройства</span><span>начинающих специалистов</span>' : 'Співпраця з JUNGO <span style="display: block">платформою для працевлаштування</span><span>фахівців-початківців</span>' ); ?>
                    </p>
                </div>
            </div>
            <div class="col-right-sm align-right-col">
                <div class="feat-col">
                    <img src="<?php bloginfo('template_directory'); ?>/images/about_us/attach.png" alt="">
                </div>
                <div class="feat-col reverse column-fixed">
                    <p><?php echo ( $lang ? 'Присоединение к сообществу <span>IT-профессионалов</span>' : 'Приєднання до спільноти <span>IT-професіоналів</span>' ); ?></p>
                </div>
            </div>
            <div class="col-right-sm">
                <div class="feat-col">
                <img src="<?php bloginfo('template_directory'); ?>/images/about_us/hands.png" alt="">
                </div>
                <div class="feat-col reverse align-left-column">
                <p><?php echo ( $lang ? 'Консультация по вопросам<br>трудоустройства и рекомендации<br>от практикующих специалистов' : 'Консультація з питань<br>працевлаштування та рекомендації<br>від практикуючих фахівців' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-us-features">
    <div class="features  col-1-feat">
        <img src="<?php bloginfo('template_directory'); ?>/images/about_us/icon-bulb.png" alt="">
        <h4>16000+</h4>
        <p><?php echo ( $lang ? 'Более 16000 студентов выбрали курсы ITEA, доверившись нам, и оправдали свои ожидания' : 'Більше 16000 студентів обрали курси від ITEA, довірившись нам, і виправдали свої сподівання' ); ?></p>
    </div>
    <div class="features col-2-feat">
        <img src="<?php bloginfo('template_directory'); ?>/images/about_us/icon-mic.png" alt="">
        <h4>95%</h4>
        <p><?php echo ( $lang ? 'Именно такое количество студентов трудоустраивается, пройдя <b>комплексную программу Roadmap</b>' : 'Саме така кількість студентів працевлаштовується після проходження комплексної програми навчання <b>(Roadmap)</b>' ); ?></p>
    </div>
    <div class="features col-3-feat">
        <img src="<?php bloginfo('template_directory'); ?>/images/about_us/icon-graph.png" alt="">
        <h4>200+</h4>
        <p><?php echo ( $lang ? 'С нами работают более двухсот лучших преподавателей-практиков уровня <b>Senior/Team Lead</b> из топ IT-компаний' : 'З нами працюють більше 200 кращих викладачів-практиків рівня <b>Senior/Team Lead</b> із топ IT-компаній' ); ?></p>
    </div>
    <div class="features col-4-feat">
        <img src="<?php bloginfo('template_directory'); ?>/images/about_us/icon-hands.png" alt="">
        <h4>6 <?php echo ( $lang ? 'мес.' : 'міс.' ); ?></h4>
        <p><?php echo ( $lang ? 'Консультируем и поддерживаем в начале карьерного пути' : 'Консультуємо і підтримуємо на початку кар\'єрного шляху' ); ?></p>
    </div>
    <div class="features col-5-feat">
        <img src="<?php bloginfo('template_directory'); ?>/images/about_us/icon-pencil.png" alt="">
        <h4>400$</h4>
        <p><?php echo ( $lang ? 'Cредняя зарплата выпускников ITEA через год после выпуска' : 'Середня заробітна плата випускників ITEA через рік після випуску' ); ?></p>
    </div>
</section>
<section class="about-us-release" id="release">
    <div class="future-block">
        <h3>ITEA <?php echo ( $lang ? 'выпустила более 16000 выпускников' : 'випустила більше 16000 випускників' ); ?></h3>
        <p style="text-align:center;">
            <?php
            if($lang){
            ?>
                ІТЕА помогает лучшим выпускникам успешно начать карьеру в IТ-сфере. <br>Благодаря сотрудничеству с платформой JUNGO, мы предоставляем все возможности найти хорошего работодателя и начать стажировку в крупнейших ІT-компаниях.
            <?php
            } else {
            ?>
                ITEA допомагає найкращим випускникам успішно розпочати кар'єру в ІТ-сфері. <br>Завдяки співпраці з платформою JUNGO, ми надаємо всі можливості знайти хорошого роботодавця і почати стажування в найбільших ІТ-компаніях.
            <?php
            }
            ?>
        </p>
        <div class="panda-align">
             <div>
                <div  id="panda-left-hat">
                    <img class="panda-left-hat" src="<?php bloginfo('template_directory'); ?>/images/about_us/hat-left.png" alt="">
                </div>
                 <div id="panda-hat">
                    <img class="panda-main-hat" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda-hat.png" alt="">
                </div>
                <div id="panda-right-hat">
                    <img class="panda-right-hat" src="<?php bloginfo('template_directory'); ?>/images/about_us/hat-right.png" alt="">
                </div>
             </div>

            <div class="pandas">
                <img class="panda-left" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda-left.png" alt="">
                <img class="panda-main-img" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda-main.png" alt="">
                <img class="panda-right" src="<?php bloginfo('template_directory'); ?>/images/about_us/panda-right.png" alt="">
            </div>
        </div>
        <div class="panda-align-big">
            <img src="<?php bloginfo('template_directory'); ?>/images/about_us/panda-all.png" alt="">
        </div><!--end content-right-->
    </div>
</section>

<section class="authorized-partner">
    <h3>ITEA – <?php echo ( $lang ? 'авторизованный партнер' : 'авторизований партнер' ); ?></h3>
    <div class="container" id="autorisations">
        <div class="partners-flex-wrapper">
            <div class="partner aep-partner">
                <span class="helper"></span><img src="/wp-content/themes/new-it/relize/img/backgrounds/Microsoft.png">
            </div>
            <div class="partner ms-partner">
                <span class="helper"></span><img src="/wp-content/themes/new-it/relize/img/backgrounds/LogoMS19.png">
            </div>
            <div class="partner cisco-partner">
                <img src="/wp-content/themes/new-it/relize/img/backgrounds/Logo_Cisco.png">
                <p><span>ITEA</span> - <?php echo ( $lang ? 'единственный украинский учебный центр, который является официальным авторизованным партнером компании Cisco в Украине.' : 'єдиний український учбовий центр, який є офіційним авторизованим партнером компанії Cisco в Україні.'); ?></p>
            </div>
            <div class="partner android-partner">
                <span class="helper"></span><img src="/wp-content/themes/new-it/relize/img/backgrounds/AndroidATC-logo-1.png">
            </div>
        </div>
    </div>
</section>

<section class="about-us-branches">
    <h3><?php echo ( $lang ? 'Представительские филиалы' : 'Представницькі філії' ); ?></h3>
    <div class="container">
      <div class="branch-row">
        <div class="branch-item">
          <a href="https://itea.ua/" class="branch-url branch-url__bg-1">
            <div class="branch-title">
              <?php echo ( $lang ? 'Киев' : 'Київ' ); ?>
            </div>
            <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
          </a>
        </div>
        <div class="branch-item">
          <a href="https://lviv.itea.ua/" class="branch-url branch-url__bg-2">
            <div class="branch-title">
              <?php echo ( $lang ? 'Львов' : 'Львів' ); ?>
            </div>
            <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
          </a>
        </div>
        <div class="branch-item">
          <a href="https://kharkiv.itea.ua/" class="branch-url branch-url__bg-3">
            <div class="branch-title">
              <?php echo ( $lang ? 'Харьков' : 'Харків' ); ?>
            </div>
            <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
          </a>
        </div>
        <div class="branch-item">
          <a href="https://itea.uz/" class="branch-url branch-url__bg-4">
            <div class="branch-title">
              <?php echo ( $lang ? 'Ташкент' : 'Ташкент' ); ?>
            </div>
            <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
          </a>
        </div>
          <div class="branch-item">
              <a href="https://dnipro.itea.ua/" class="branch-url branch-url__bg-dnipro">
                  <div class="branch-title">
                      <?php echo ( $lang ? 'Днепр' : 'Дніпро' ); ?>
                  </div>
                  <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
              </a>
          </div>
          <div class="branch-item">
              <a href="https://lutsk.itea.ua/" class="branch-url branch-url__bg-lutsk">
                  <div class="branch-title">
                      <?php echo ( $lang ? 'Луцк' : 'Луцьк' ); ?>
                  </div>
                  <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
              </a>
          </div>
        <div class="branch-item">
          <a href="https://kyiv.iteahub.com/" class="branch-url branch-url__bg-5">
            <div class="branch-title">
              <?php echo ( $lang ? 'Коворкинг' : 'Коворкінг' ); ?>
            </div>
            <span class="branch-item__details"><?php echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><span class="branch-item__arrow"></span></span>
          </a>
        </div>
        <div class="branch-item branch-item__last-item">
          <a href="#" class="branch-url">
              <div class="branch-title">
                  <div class="branch-title__new-city">
                      <span><?php echo ( $lang ? 'Скоро Открытие' : 'Скоро Відкриття' ); ?></span>
                  </div>
              </div>
            <div class="branch-title">
              <div class="branch-title__new-city">
                  <span class="small"><?php echo ( $lang ? 'Одесса' : 'Одеса' ); ?></span>
                  <span class="small"><?php echo ( $lang ? 'Лондон' : 'Лондон' ); ?></span>
                  <span class="small"><?php echo ( $lang ? 'Осло' : 'Осло' ); ?></span>
              </div>
            </div>

          </a>
        </div>
      </div>
    </div>




<!--      <div class="content-branch col-br-1">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/kyiv.png" alt="">-->
<!--          <a href="--><?php //echo get_home_url(); ?><!--" class="city-button">--><?php //echo ( $lang ? 'Киев' : 'Київ' ); ?><!--</a>-->
<!--        </div>-->
<!--        &nbsp; &nbsp; <a  href="--><?php //echo get_home_url(); ?><!--"  class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--      <div class="content-branch col-br-2">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/lviv.png" alt="">-->
<!--          <a  href="http://lviv.itea.ua" class="city-button">--><?php //echo ( $lang ? 'Львов' : 'Львів' ); ?><!--</a>-->
<!--        </div>-->
<!--          <a href="http://lviv.itea.ua"  class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--      <div class="content-branch col-br-3">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/academy.png" alt="">-->
<!--          <a href="http://kharkiv.itea.ua" class="city-button">--><?php //echo ( $lang ? 'Харьков' : 'Харків' ); ?><!--</a>-->
<!--        </div>-->
<!--          <a href="http://kharkiv.itea.ua"  class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--      <div class="content-branch col-br-3">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/academy.png" alt="">-->
<!--          <a href="https://itea.uz" class="city-button">--><?php //echo ( $lang ? 'Ташкент' : 'Ташкент' ); ?><!--</a>-->
<!--        </div>-->
<!--          <a href="https://itea.uz/"  class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--      <div class="content-branch col-br-4">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/hub.png" alt="">-->
<!--          <a  href="http://iteahub.com" class="city-button centered-button">--><?php //echo ( $lang ? 'Коворкинг' : 'Коворкінг' ); ?><!--</a>-->
<!--        </div>-->
<!--        &nbsp; &nbsp; <a href="http://iteahub.com" class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--      <div class="content-branch col-br-4">-->
<!--        <div class="city-block">-->
<!--          <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/hub.png" alt="">-->
<!--          <a  href="http://iteahub.com" class="city-button centered-button">--><?php //echo ( $lang ? 'Коворкинг' : 'Коворкінг' ); ?><!--</a>-->
<!--        </div>-->
<!--        &nbsp; &nbsp; <a href="http://iteahub.com" class="detail">--><?php //echo ( $lang ? 'Подробнее' : 'Детальніше' ); ?><!-- <img src="--><?php //bloginfo('template_directory'); ?><!--/images/about_us/arrow-white.png" alt=""></a>-->
<!--      </div>-->
<!--    </div>-->
</section>
</div>

<script type="text/javascript">
    $(window).bind('scroll',function(e){
        parallaxScroll();
    });

    function parallaxScroll() {
        var scrolled = $(window).scrollTop();
        $('#panda-hat').css('top',(270-(scrolled*.2))+'px');
        $('#panda-left-hat').css('top',(350-(scrolled*.2))+'px');
        $('#panda-right-hat').css('top',(300-(scrolled*.2))+'px');
    }
</script>

<?php get_footer(); ?>
