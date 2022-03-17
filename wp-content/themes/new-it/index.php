<?php
$lang = (get_locale() == 'ru_RU');

get_header();
?>
    <div id="particles-js" style="position:absolute; width:100%; height:130%;"></div>


    <div class="fluid" id="new_head">
        <div class="container">
            <div class="top">
                <h2><?php echo($lang ? 'Мы' : 'Ми'); ?> - ITEA</h2>
                <h3><?php echo($lang ? 'Твой путь от обучения к успешной карьере в IT<br>Обучайся. Практикуйся. Совершенствуйся.' : 'Твій шлях від навчання до успішної кар&rsquo;єри в IT<br>Навчайся. Практикуйся. Вдосконалюйся.'); ?></h3>
            </div>
        </div>
        <div class="b-new-index-icons container">
            <div class="b-new-index-icons-wrapper col-md-12">
                <h2><?php echo($lang ? 'Комплексная программа обучения по направлениям' : 'Комплексна програма навчання за напрямками'); ?></h2>

                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 15 : 241)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr2.png" alt="#">
                        <h3 class="title_napr">Frontend <br><span>development</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 673 : 675)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr17.png" alt="#">
                        <h3 class="title_napr">DevOps</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 746 : 748)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/project_management.png" alt="#">
                        <h3 class="title_napr"><?php /* echo($lang ? 'Управление' : 'Управління'); ?>
                            <br><span>проектами</span><?php /**/ ?>Project management</h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 4 : 245)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr10.png" alt="#">
                        <h3 class="title_napr">JS <br><span>development</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4" style ='margin-bottom:15px;'>
                    <a href="<?php echo get_category_link(($lang ? 8 : 237)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr14.png" alt="#">
                        <h3 class="title_napr">C#<br><span>programming</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 9 : 239)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr11.png" alt="#">
                        <h3 class="title_napr">C++ <br><span>programming</span></h3>
                    </a>
                </div>
                
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 5 : 247)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr7.png" alt="#">
                        <h3 class="title_napr">PHP <br><span>programming</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 7 : 243)); ?>" class="item_napr">
                        <div class="sale"></div>
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr12.png" alt="#">
                        <h3 class="title_napr">Java <br><span>programming</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 12 : 249)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr6.png" alt="#">
                        <h3 class="title_napr">Python <br><span>programming</span></h3>
                    </a>
                </div>
                
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1062 : 1060)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr19.png" alt="#">
                        <h3 class="title_napr">Game <br><span>development</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1378 : 1380)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/mobile-development.png" alt="#">
                        <h3 class="title_napr">Mobile <br><span>development</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1589 : 987)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr13.png" alt="#">
                        <h3 class="title_napr">Data Science/<br><span>Machine Learning</span></h3>
                    </a>
                </div>
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(1665); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr100.png" alt="#">
                        <h3 class="title_napr">Системное<br><span>администрирование</span></h3>
                    </a>
                </div>
                
                
                
                
                
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 18 : 251)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr4.png" alt="#">
                        <h3 class="title_napr">Design</h3>
                    </a>
                </div>
<!--                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">-->
<!--                    <a href="--><?php //echo get_category_link(($lang ? 18 : 251)); ?><!--" class="item_napr">-->
<!--                        <img src="--><?php //bloginfo('template_directory'); ?><!--/images/napr4.png" alt="#">-->
<!--                        <h3 class="title_napr">Design</h3>-->
<!--                    </a>-->
<!--                </div>-->
                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(1667); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr200.png" alt="#">
                        <h3 class="title_napr">Full Stack<br><span>Java Developer</span></h3>
                    </a>
                </div>
                
                
                 <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1677 : 1124)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr15.png" alt="#">
                        <h3 class="title_napr"> Business analysis</h3>
                    </a>
                </div>
                 <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1675 : 992)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr24.png" alt="#">
                        <h3 class="title_napr"><?php echo($lang ? 'Тестирование' : 'QA'); ?></span></h3>
                    </a>
                </div>

                <!-- ////////////////////////////////////// -->
                
                <!-- <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 990 : 992)); ?>" class="item_napr">
                        <img src="<?php bloginfo('template_directory'); ?>/images/napr24.png" alt="#">
                        <h3 class="title_napr"><?php echo($lang ? 'Управление <br><span>персоналом</span>' : 'Управління <br><span>персоналом</span>'); ?></span></h3>
                    </a>
                </div> -->
                <!-- <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">
                    <a href="<?php echo get_category_link(($lang ? 1146 : 1148)); ?>" class="item_napr">                       
                        <img src="<?php bloginfo('template_directory'); ?>/images/digital_markeeting_icon.png" alt="#">
                        <h3 class="title_napr">Digital<br><span>marketing</span></h3>
                    </a>
                </div> -->
                

                
<!--                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">-->
<!--                    <a href="--><?php //echo get_category_link(($lang ? 14 : 257)); ?><!--" class="item_napr">-->
<!--                        <img src="--><?php //bloginfo('template_directory'); ?><!--/images/napr20.png" alt="#">-->
<!--                        <h3 class="title_napr">IOS<br><span>programming</span></h3>-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">-->
<!--                    <a href="--><?php //echo get_category_link(($lang ? 13 : 255)); ?><!--" class="item_napr">-->
<!--                        <img src="--><?php //bloginfo('template_directory'); ?><!--/images/napr16.png" alt="#">-->
<!--                        <h3 class="title_napr">Android<br><span>programming</span></h3>-->
<!--                    </a>-->
<!--                </div>-->
                
                
<!--                <div class="b-new-index-icons-wrapper__item col-md-2 col-sm-3 col-xs-4">-->
<!--                    <a href="--><?php //echo get_category_link(($lang ? 1202 : 1204)); ?><!--" class="item_napr">-->
<!--                        <img src="--><?php //bloginfo('template_directory'); ?><!--/images/cybersecurity_100x100.png" alt="#">-->
<!--                        <h3 class="title_napr">--><?php //echo($lang ? 'Сybersecurity' : 'Сybersecurity'); ?><!--</span></h3>-->
<!--                    </a>-->
<!--                </div>-->
            </div>
        </div>
        
    </div>

    <section class="about-us-advantages page-about-itea">
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
                        <p><?php echo ( $lang ? 'Стажировка в <span>IT-компаниях</span>' : 'Стажування в <span>IT-компаніях</span>' ); ?></p>
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
                        <p><?php echo ( $lang ? 'Помощь в <br> трудоустройстве' : 'Допомога у <br> працевлаштуванні' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php /*?><div class="fluid" id="timeTableButtons">
        <div class="container">
            <h3 class="mainPage"><?php echo($lang ? 'Преимущество обучения в ITEA' : 'Переваги навчання в ITEA'); ?></h3>
            <div class="col-md-12 b-main-benefits">
                <div class="col-md-4 b-main-benefits__left-benefits">
                    <div class="b-main-benefits--inner col-md-12">
                        <p class="b-main-benefits--left-p">
                            <?php echo($lang ? 'Участие в мероприятиях от ITEA' : 'Участь у заходах від ITEA'); ?>
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/cup.png" alt="#">
                        </p>
                    </div>
                    <div class="b-main-benefits--inner col-md-12">
                        <p class="b-main-benefits--left-p">
                            <?php echo($lang ? 'Компактные группы до 12 человек' : 'Компактні групи до 12 учасників'); ?>
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/community.png" alt="#">
                        </p>
                    </div>
                    <div class="b-main-benefits--inner col-md-12">
                        <p class="b-main-benefits--left-p">
                            <?php echo($lang ? 'Преподаватели – практики из топ IT-компаний' : 'Викладачі – практики із топ IT-компаній'); ?>
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/speaker.png" alt="#">
                        </p>
                    </div>
                </div>

                <div class="col-md-4 b-main-benefits__center-benefits">
                    <div class="col-md-10 b-main-benefits--panda-inner">
                        <img class="img-responsive b-main-benefits__pic"
                             src="<?php bloginfo('template_directory'); ?>/relize/img/icons/panda_for_main.gif" alt="#">
                    </div>
                </div>


                <div class="col-md-4 b-main-benefits__right-benefits">
                    <div class="b-main-benefits--inner right-benefit col-md-12">
                        <p class="b-main-benefits--right-p">
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/intern.png" alt="#">
                            <?php echo($lang ? 'Стажировка в IT-компаниях' : 'Стажування в IT-компаніях'); ?>
                        </p>
                    </div>
                    <div class="b-main-benefits--inner right-benefit col-md-12">
                        <p class="b-main-benefits--right-p">
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/attach.png" alt="#">
                            <?php echo($lang ? 'Присоединение к сообществу IT-профессионалов' : 'Приєднання до спільноти IT-професіоналів'); ?>
                        </p>
                    </div>
                    <div class="b-main-benefits--inner right-benefit col-md-12">
                        <p class="b-main-benefits--right-p">
                            <img class="img-responsive b-main-benefits__pic"
                                 src="<?php bloginfo('template_directory'); ?>/relize/img/icons/hands.png" alt="#">
                            <?php echo($lang ? 'Помощь в трудоустройстве' : 'Допомога у працевлаштуванні'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><?php /**/ ?>

    <div class="fluid" id="consultation">
        <div class="container">
            <?php if ($lang) { ?>
                <p>С чего начать карьеру в IT?<span>Мы с радостью поможем с выбором наиболее подходящего для Вас IT-направления. Оставьте заявку на бесплатную консультацию.
                Наши специалисты свяжутся с Вами и помогут определить наиболее правильный путь развития в этой интересной и перспективной сфере.</span>
                </p>
            <?php } else { ?>
                <p>З чого почати кар'єру в IT?<span>Ми з радістю допоможемо з вибором найкращого для Вас IT-напрямку. Залиште заявку на безкоштовну консультацію.
                Наші спеціалісти зв'яжуться з Вами і допоможуть визначити найбільш правильний шлях розвитку в цій цікавій та перспективній сфері.</span>
                </p>
            <?php } ?>
            <a href="<?php echo get_permalink(12439); ?>"><?php echo($lang ? 'Получить бесплатную консультацию' : 'Отримати безкоштовну консультацію'); ?>
            </a>
        </div>
    </div>

    <h1 style=' text-indent: 100%; padding:0 !important;margin:0 !important; font-size: 0 !important; white-space: nowrap; overflow: hidden;'>Курсы программирования в Ашхабаде</h1>
    <div class="container" id="courseList">
        <section id="course">
            <div class="container_12">
                <div class="grid_12">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs TwoListsCourses" role="tablist">
                            <li role="presentation" class="active"><a href="#home" class="isoLink" aria-controls="home" style="min-height:75px; width:100%;"
                                                                      role="tab"
                                                                      data-toggle="tab"><?php echo($lang ? 'Вечернее обучение' : 'Вечірнє навчання'); ?>
                                    <span> 19:00-22:00</span></a></li>
                          
                        </ul>
                        <div class="tab-content">


                            <?php pageCoursesItea(true); ?>
                            <?php pageCorporateEducation(true); ?>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="fluid sec" id="timeTableButtons">
        <div class="containImg">
            <div class="left">
                <a href="<?php echo get_permalink($lang ? 17 : 7863); ?>">
                    <div class="container">
                        <p>
                            <?php echo($lang ? 'Расписание<br>вечерних курсов' : 'Розклад<br>вечірніх курсів'); ?>
                        </p>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
    <div class="container" id="autorisations">
        <div>
            <h3>ITEA – <?php echo($lang ? 'авторизованный партнер' : 'авторизований партнер'); ?></h3>
            <div class="partners-flex-wrapper">
                <div class="partner aep-partner">
                    <span class="helper"></span><img src="/wp-content/themes/new-it/relize/img/backgrounds/Microsoft.png">
                </div>
                <div class="partner ms-partner">
                    <span class="helper"></span><img src="/wp-content/themes/new-it/relize/img/backgrounds/LogoMS19.png">
                </div>
                <div class="partner cisco-partner">
                    <img src="/wp-content/themes/new-it/relize/img/backgrounds/Logo_Cisco.png">
                    <p><span>ITEA</span>
                        - <?php echo($lang ? 'единственный украинский учебный центр, который является официальным авторизованным партнером компании Cisco в Украине.' : 'єдиний український учбовий центр, який є офіційним авторизованим партнером компанії Cisco в Україні.'); ?>
                    </p>
                </div>
                <?php /*?><div class="partner android-partner">
                    <span class="helper"></span><img
                            src="/wp-content/themes/new-it/relize/img/backgrounds/AndroidATC-logo-1.png">
                </div><?php /**/?>
<!--                <div class="partner vmware-partner">-->
<!--                    <span class="helper"></span><img-->
<!--                            src="/wp-content/themes/new-it/relize/img/backgrounds/VMW-PTNR-LOGO-PREM-AUTR-TRAINING-CNTR-WHITE.png">-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <a href="https://itea.ua/news/assurance/" class="fluid" id="microsoft">
        <div class="container">
            <p>Microsoft<span>Software Assurance</span></p>
            <?php if ($lang) { ?>
                <p>Microsoft Software Assurance – программа поддержки Microsoft, целью которой является помощь
                    заказчикам корпоративных лицензий в максимально эффективном использовании приобретенного
                    программного обеспечения.</p>
            <?php } else { ?>
                <p>Microsoft Software Assurance – програма підтримки Microsoft, метою якої є допомога замовникам
                    корпоративних ліцензій в максимально ефективному використанні придбаного програмного
                    забезпечення.</p>
            <?php } ?>
        </div>
    </a>
    <div class="fluid" id="sertificats">
        <div class="container">
            <div>
                <h3><?php echo($lang ? 'Наши сертификаты' : 'Наші сертифікати'); ?></h3>
                <div class="img"><img src="/wp-content/themes/new-it/files/certificate_cisco.jpg" alt="Cisco1-001">
                    <a href="/wp-content/themes/new-it/files/cisco_partner_2021.pdf" class="view"
                       target="_blank">
                        <?php echo($lang ? 'Просмотреть сертификат' : 'Переглянути сертифікат'); ?></a>
                </div>

                <div class="img"><img src="/wp-content/themes/new-it/relize/img/backgrounds/sertificate2.png" alt="Microsoft_certificate">
                    <a href="/wp-content/themes/new-it/files/microsoft_partner_2021.pdf" class="view"
                       target="_blank">
                        <?php echo($lang ? 'Просмотреть сертификат' : 'Переглянути сертифікат'); ?></a>
                </div>
                <br>
                <?php /*?><div class="img"><img src="/wp-content/themes/new-it/relize/img/backgrounds/AndroidATC-banner-1.png"
                                      alt="">
                    <a href="https://itea.ua/wp-content/uploads/2017/05/ITEducation_Academy_Partnership_Certificate.pdf"
                       class="view" target="_blank">
                        <?php echo($lang ? 'Просмотреть сертификат' : 'Переглянути сертифікат'); ?></a>
                </div><?php /**/?>

                <div class="img"><img src="/wp-content/themes/new-it/relize/img/backgrounds/wmWare371x190.png" alt="wmWare">
                    <a href="https://itea.ua/wp-content/uploads/2017/09/Certificate.pdf" class="view" target="_blank">
                        <?php echo($lang ? 'Просмотреть сертификат' : 'Переглянути сертифікат'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="fluid" id="partners">
        <div class="container">
            <h3><?php echo($lang ? 'Наши партнеры' : 'Наші партнери'); ?></h3>

            <?php
            $partners = get_post_gallery(($lang ? 9 : 7902), false);
            $array = explode(',', $partners['ids']);

            if (isset($partners) && !empty($partners['ids'])) {
                foreach ($array as $src) {
                  $item = get_post($src);
                  if (parse_url($item->post_content, PHP_URL_SCHEME) == 'http' || parse_url($item->post_content, PHP_URL_SCHEME) == 'https') {
                    echo '<a href="'. $item->post_content .'"><img src="' . wp_get_attachment_url($item->ID) . '"></a>';
                  } else {
                    echo '<img src="' . wp_get_attachment_url($item->ID) . '">';
                  }
                }
            }
            ?>

        </div>
    </div>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/about_us_v3.css">
<?php get_footer(); ?>
