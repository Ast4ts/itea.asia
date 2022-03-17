<?php
$page_id = get_the_ID();
$full_price = get_post_meta($page_id, 'cost', true);
$start_date = get_post_meta($page_id, 'date1', true);
$time_spending = get_post_meta($page_id, 'time', true);

global $wpdb;
$table_name = $wpdb->get_blog_prefix() . 'exchange_rates';
$rates = $wpdb->get_row('SELECT usd FROM ' . $table_name . ' WHERE id = 1 LIMIT 1', ARRAY_A);

$lang = (get_locale() == 'ru_RU');
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
        <link href='https://fonts.googleapis.com/css?family=Playfair+Display:700italic,400italic' rel='stylesheet'
              type='text/css'>
        <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/styles.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/animate.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/styles.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/new-ayshe-styles.css"/>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font/font.css"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700&subset=latin,cyrillic' rel='stylesheet'
              type='text/css'/>

        <!--[if IE]>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css"><![endif]-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>

<body id="b-ayshe-body">
<header id="b-ayshe-header">

    <div class="b-ayshe-container">
        <div class="b-ayshe-wrapper">

            <!-- menu begin -->
            <nav class="b-ayshe-header__main-nav navbar navbar-fixed-top navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img
                                    src="<?php bloginfo('template_directory'); ?>/relize/img/icons/new-ayshe-logo.png"
                                    class="img-responsive" alt="ayshe"/></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="b-ayshe-header-ul nav navbar-nav">
                            <li><a class="active"
                                   href="#programme"><?php echo($lang ? 'программа курса' : 'програма курсу'); ?></a>
                            </li>
                            <li><a href="#benefits"><?php echo($lang ? 'наши преимущества' : 'наші переваги'); ?></a>
                            </li>
                            <li><a href="#study"><?php echo($lang ? 'формат обучения' : 'формат навчання'); ?></a></li>
                            <li>
                                <a href="#briefly"><?php echo($lang ? 'коротко о программе' : 'коротко про дану програму'); ?></a>
                            </li>
                            <li><a href="#contacts"><?php echo($lang ? 'КОНТАКТЫ' : 'КОНТАКТИ'); ?></a></li>
                            <li class="b-ayshe-header__booking"><a href="#"
                                                                   onclick="document.getElementById('payment_reserve').submit(); return false;"><?php echo($lang ? 'ПЕРВЫЕ 5 занятий' : 'ПЕРШІ 5 занять'); ?></a>
                            </li>
                        </ul>
                        <div class="b-ayshe-header__currency">

                            <form id="switch-currency_form" method="POST" action="">
                                <select class="switch-currency__select">

                                    <option value="uah">uah</option>
                                    <option value="usd" <?php echo(isset($_GET['usd']) ? 'selected' : ''); ?>>usd
                                    </option>

                                </select>
                            </form>

                        </div>
                    </div>
                </div>
            </nav>
            <!-- menu end -->

            <div class="b-ayshe-bottom-header col-md-offset-1 col-md-7">
                <div class="b-ayshe-bottom-header__inner-wrapper animated fadeInLeft">
                    <div class="b-ayshe-bottom-header--text col-md-12">
                        <p>
                            <?php echo($lang ? 'от Айше Борсеитовой' : 'від Айше Борсеітової'); ?>
                            <span class="b-ayshe-header-main-heading">
							<?php echo($lang ? 'Инновационная методика' : 'Інноваційна методика'); ?>
						</span>
                            <span class="b-ayshe-header-blue-span">Онлайн</span>
                            <span class="b-ayshe-header-dark-blue-span">- <?php echo($lang ? 'изучения английского' : 'вивчення англійської мови'); ?></span>
                            <span class="b-ayshe-header-blue-span"><?php echo($lang ? 'из любой точки мира' : 'з будь-якої точки світу'); ?></span>

                        </p>
                    </div>

                    <div class="b-ayshe-bottom-header--sign-up col-md-12">
                        <div class="b-ayshe-bottom-header--sign-up--wrapper">

                            <form action="<?php echo get_permalink(8450); ?>" method="POST" id="payment_buy">
                                <input type="hidden" name="id_course" value="6963">
                                <input type="hidden" name="price" value="ayshe_buy">
                                <input type="submit" class="b-ayshe-bottom-header--sign-up"
                                       value="<?php echo($lang ? 'Записаться на курс' : 'Записатися на курс'); ?>">
                            </form>

                            <p>
                                <?php echo($lang ? 'Стоимость курса:' : 'Вартість курсу:'); ?><br>
                                <span class="b-ayshe-header-cost-span" id="eight-uah"><?php echo $full_price; ?>
                                    тмт.</span>
                                <span class="b-ayshe-header-cost-span"
                                      id="eight-usd">$<?php echo round($full_price / $rates['usd']); ?></span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 b-ayshe-bottom-header__single-ayshe">
                <img class="animated fadeInRight img-responsive"
                     src="<?php bloginfo('template_directory'); ?>/relize/img/backgrounds/alone.png" alt="ayshe"/>
            </div>
        </div>
    </div>

</header>
<main id="b-ayshe-main">
    <div class="b-ayshe-grey-header container">
        <div class="b-ayshe-grey-header__item col-md-6">
            <div class="b-ayshe-grey-header__item--img-wrapper">
                <p>
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/blue-check.png" alt="ayshe"/>

                    <?php echo($lang ? 'Ближайший курс' : 'Найближчий курс'); ?><br/>
                    <span>
		  					<?php echo($lang ? 'Стартует' : 'Стартує'), $start_date; ?>
		  				</span>
                </p>
            </div>
        </div>
        <div class="b-ayshe-grey-header__item col-md-6">
            <div class="b-ayshe-grey-header__item--img-wrapper">
                <p>
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/packman.png" alt="ayshe"/>

                    <?php echo($lang ? 'Длительность курса:' : 'Тривалість курсу:'); ?> 33 урока<br/>
                    <span>
		  					<?php echo($lang ? 'Курс читается' : 'Курс читається'); ?><?php echo $time_spending; ?>
		  				</span>
                </p>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container">
        <div class="b-ayshe-wrapper">
            <div class="b-ayshe__programme">
                <h1 id="programme" class="b-ayshe__programme--heading">
                    <?php echo($lang ? 'Программа курса' : 'Програма курсу'); ?>
                </h1>
                <p class="b-ayshe__programme--small-heading">
                    <?php echo($lang ? 'Включает в себя 33 практических занятия' : 'Включає в себе 33 практичних заняття'); ?>
                </p>
                <div class="col-md-12 b-ayshe__programme--steps">
                    <div class="col-md-5 col-sm-4 col-xs-4 digits">
						
							<span>
								01-05
							</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 b-ayshe__programme--pic">
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step1.png" alt="step1"/> -->
                        <div class="b-ayshe__programme--pic__container first-pic">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p id="c1">5
                                </p>
                                <span class="classes">
											<?php echo($lang ? 'занятий' : 'занять'); ?>
									</span>
                            </div>
                            <div class="archide">
                                <div class="arc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-4 text">
                        <p>
                            <?php if ($lang) { ?>
                                Будут посвящены преодолению психологического языкового барьера, качественному и существенному пополнению словарного запаса, навыку распознавания английской речи на слух. Основные конструкции, необходимые для правильного построения предложений.
                            <?php } else { ?>
                                Будуть присвячені вивченню 9 граматичних часів та 80+ виразів, необхідних для усного мовлення. Ти вивчиш лексичний та граматичний мінімум, який потрібен для підтримання розмови на загальну тематику з елементами ІТ.
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 b-ayshe__programme--steps">
                    <div class="col-md-5 col-sm-4 col-xs-4 text">
                        <p>
                            <?php if ($lang) { ?>
                                Дадут основополагающие знания и умения использовать весь запас грамматических времен английского языка. Ты изучишь основные конструкции и
                                <span>300 практических выражений</span>, которые нужны для правильного и живого общения с native speaker как на общие тематики, так и для сферы бизнес английского.
                            <?php } else { ?>
                                Дадуть базові знання та вміння використовувати увесь запас граматичних часів англійської мови. Ти вивчиш основні конструкції та
                                <span>300 практичних виразів</span>, які необхідні для правильного та живого спілкування з native speaker як на загальну тематику, так і для сфери бізнес-англійської.
                            <?php } ?>
                        </p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 b-ayshe__programme--pic">
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step2.png" alt="step2"/> -->
                        <div class="b-ayshe__programme--pic__container second-pic">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p id="c2">10
                                </p>
                                <span class="classes">
											<?php echo($lang ? 'занятий' : 'занять'); ?>
									</span>
                            </div>
                            <div class="archide">
                                <div class="arc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-4 digits">
							<span>
								06-15
							</span>
                    </div>

                </div>
                <div class="col-md-12 b-ayshe__programme--steps lots-p">
                    <div class="col-md-5 col-sm-4 col-xs-4 digits">
							<span>
								16-33
							</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 b-ayshe__programme--pic">
                        <div class="b-ayshe__programme--pic__container third-pic">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p id="c3">18
                                </p>
                                <span class="classes">
											<?php echo($lang ? 'занятий' : 'занять'); ?>
									</span>
                            </div>
                            <div class="archide">
                                <div class="arc"></div>
                            </div>
                        </div>
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step3.png" alt="step3"/> -->
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12 list">

                        <h3>
                            <?php echo($lang ? 'Интенсивный блок программы, включающий:' : 'Інтенсивний блок програми, що містить:'); ?>
                        </h3>
                        <p>
                            <?php echo($lang ? 'Закрепление и автоматизацию навыков использования 9 времен, необходимых для устной речи' : 'Закріплення та автоматизація навичок використання 9 граматичних часів, необхідних для усного мовлення'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? 'Закрепление лексического минимума устной речи (700 - 1000 самых используемых выражений и слов)' : 'Закріплення лексичного мінімуму усного мовлення (700-1000 найбільш використовуваних виразів та слів)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? 'Устная практика речи на различные бизнес-тематики (переговоры, подписание контракта, наем сотрудника, судебный иск, расторжение договора, собеседование и пр.)' : 'Усна практика мовлення на різні бізнес-теми (перемови, підписання контракту, найми співробітника, судовий позов, співбесіда та інше)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? 'Мультимедийная часть практических занятий (просмотр английских фильмов и виде-роликов, прослушивание англоязычных песен, новостей, ведение беседы, дискуссии на английском)' : 'Мультимедійна частина практичних занять (перегляд англійських фільмів та відео-роликів, прослуховування англомовних пісень, новин, ведення бесіди, дискусії англійською мовою)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? 'Оттачивание навыков письменной английской речи' : 'Опрацювання навичок письмового англійського мовлення'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? 'Участие в бизнес-сообществе, networking.' : 'Участь у бізнес-спільноті, networking.'); ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 test-circle">

                </div>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-blue-graphic">
        <div class="b-ayshe-narrow-wrapper">
            <h2>
                <?php echo($lang ? 'технический английский в цифрах' : 'технічна англійська у цифрах'); ?>
            </h2>
            <div class="col-md-12">
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>50
                            <span><?php echo($lang ? 'часов' : 'годин'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? 'Это 33 встречи' : 'Це 33 зустрічі'); ?> <br>по
                        1.5 <?php echo($lang ? 'часа' : 'години'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>90
                            <span><?php echo($lang ? 'минут' : 'хвилин'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? 'Длительность <br> одного занятия' : 'Тривалість <br> одного заняття'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>3<br>
                            <span><?php echo($lang ? 'ЗАНЯТИЯ' : 'ЗАНЯТТЯ'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? 'В неделю' : 'На тиждень'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>2.5
                            <span><?php echo($lang ? 'МЕСЯЦА' : 'МІСЯЦЯ'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? 'Длительность <br> полного курса' : 'Тривалість <br> повного курсу'); ?>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-advantages">
        <div class="b-ayshe-narrow-wrapper">
            <h2 id="benefits">
                <?php echo($lang ? 'наши преимущества' : 'наші переваги'); ?>
            </h2>

            <div class="col-md-12 b-ayshe-advantages__wrapper">
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-1.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Не нужно покупать никаких книг и учебных материалов' : 'Не потрібно купувати книги та навчальні матеріали'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-2.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'В краткие сроки, но с нагрузкой не более 1.5 часа, с целью качественного усвоения информации' : 'Короткий строк, але з навантаженням не більше 1,5 години, з метою якісного засвоєння інформації'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-3.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Современные, харизматичные преподаватели, обожающие свою работу' : 'Сучасні, харизматичні викладачі, віддані своїй роботі'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-4.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Справедливая цена' : 'Справедлива ціна'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-5.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Психологические методы обучения, постановка целей и их пошаговое осуществление, мотивация, осознание своей ответственности за результат и его качество' : 'Психологічні методи навчання, постановка цілей та їх покрокове виконання, мотивація, розуміння своєї відповідальності за результат та його якість'); ?>
                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-6.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Легкая и интересная подача без лингвистических объяснений' : 'Легка та цікава подача без лінгвістичних пояснень'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-7.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Эффективно: каждый урок = нескольким месяцам обучения по стандартным методикам' : 'Ефективно: кожне заняття = декілька місяців навчання за стандартними методиками'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-8.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Информация, которой нет в других источниках' : 'Інформація, якої немає в інших джерелах'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-9.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Поэтапная оплата' : 'Поетапна оплата'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-10.png"
                             alt="advantages"/>
                        Networking <?php echo($lang ? 'и бизнес-сообщество' : 'і бізнес-спільнота'); ?>
                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-11.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Отсутствие домашних заданий, упражнений, экзаменов, заучивания' : 'Відсутність домашніх завдань, вправ, екзаменів та заучуваннь'); ?>

                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-12.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Пробные 5 занятий, чтобы убедиться в эффективности и уже получить результат' : 'Пробні 5 занять, аби упевнитися в ефективності та вже отримати результат'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-13.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Только живой английский и необходимые знания' : 'Тільки жива англійська та необхідні знання'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-14.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Говорите уже с 15 занятия' : 'Зможете говорити англійською вже з 15 заняття'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-15.png"
                             alt="advantages"/>
                        <?php echo($lang ? 'Секреты полиглотов' : 'Секрети поліглотів'); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-red parallax-window" data-parallax="scroll"
         data-image-src="<?php bloginfo('template_directory'); ?>/relize/img/backgrounds/red-ayshe.png">
        <div class="b-ayshe__red-inner">

            <p class="animated">
                <?php echo($lang ? 'Все еще сомневаешься?' : 'Все ще вагаєшся?'); ?><br>
                <span>
	  					<?php echo($lang ? 'Оцени эффективность данной программы, пройди первые 5 занятий' : 'Оціни ефективність даної програми, пройди перші 5 занять'); ?>
                    <br>
	  				</span>
                <span id="five-uah">
	  				 	за 500 тмт.
	  				</span>
                <span id="five-usd">
	  				 	за $<?php echo round(500 / $rates['usd']); ?>
	  				</span>
            </p>

            <a class="animated" href="#"
               onclick="document.getElementById('payment_reserve').submit(); return false;"><?php echo($lang ? 'ЗАБРОНИРОВАТЬ МЕСТО' : 'ЗАБРОНЮВАТИ МІСЦЕ'); ?></a>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-study">
        <h2 id="study" class="b-ayshe-study__headings">
            <?php echo($lang ? 'ФОРМАТ ОБУЧЕНИЯ' : 'ФОРМАТ НАВЧАННЯ'); ?>
            <span>
	  				<?php echo($lang ? '5 простых шагов, чтобы выучить английский язык:' : '5 простих кроків, щоб вивчити англійську мову:'); ?>
	  			</span>
        </h2>
        <div class="b-ayshe-study-wrapper">
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        1
                        <span>
		  						 <?php echo($lang ? 'шаг' : 'крок'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? 'Записаться на курс' : 'Записатися на курс'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        2
                        <span>
		  						 <?php echo($lang ? 'шаг' : 'крок'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? 'Получить вводную информацию и материалы для обучения' : 'Отримати вступну інформацію та матеріали для навчання'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        3
                        <span>
		  						 <?php echo($lang ? 'шаг' : 'крок'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? 'Мы присылаем Вам доступы к платформе, где будет проходить обучение' : 'Ми надсилаємо Вам доступи до платформи, де відбуватиметься навчання'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        4
                        <span>
		  						 <?php echo($lang ? 'шаг' : 'крок'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? 'Учитывая Ваши цели, мы подбираем программу, форму обучения и учебный план' : 'Враховуючи Ваші цілі, ми підбираємо програму, форму навчання та навчальний план'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        5
                        <span>
		  						 <?php echo($lang ? 'шаг' : 'крок'); ?>
		  					</span>
                    </p>
                    <a href="#"
                       onclick="document.getElementById('payment_buy').submit(); return false;"><?php echo($lang ? 'ЗАБРОНИРОВАТЬ МЕСТО' : 'ЗАБРОНЮВАТИ МІСЦЕ'); ?></a>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-headphones">
        <div class="col-md-12 b-ayshe-headphones--inner">
            <p>
                <?php echo($lang ? 'Для занятий необходимо иметь гарнитуру' : 'Для занять необхідно мати гарнітуру'); ?>
                <span>
						<?php echo($lang ? '(наушники + микрофон), интернет и компьютер' : "(навушники + мікрофон), інтернет та комп'ютер"); ?>
	  				</span>
            </p>
        </div>

        <div class="col-md-12 b-ayshe-headphones__sliding-block">
            <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/headphones.png" alt="advantages"/>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-online">
        <div class="b-ayshe-narrow-wrapper">
            <h2>
                <?php echo($lang ? 'преимущества <span>ONLINE</span>-ОБУЧЕНИЯ' : 'переваги <span>ONLINE</span>-НАВЧАННЯ'); ?>
            </h2>
            <div class="col-md-12 b-ayshe-online--inner">
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/waves.png" alt="advantages"/>
                    <p>
                        <?php echo($lang ? 'Гибкий график времени обучения' : 'Гнучкий графік навчання'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/youtube-ayshe.png"
                         alt="advantages"/>
                    <p>
                        <?php echo($lang ? 'Доступ к видео-лекциям, тестам и другим материалам' : 'Доступ до відео-лекцій, тестів та інших матеріалів'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/arrow-ayshe.png"
                         alt="advantages"/>
                    <p>
                        <?php echo($lang ? 'Удаленные занятия: дома, в транспорте, на работе, на отдыхе' : 'Дистанційні заняття: вдома, в транспорті, на роботі, на відпочинку'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/bucks.png" alt="advantages"/>
                    <p>
                        <?php echo($lang ? 'Нет необходимости переплачивать за аренду помещения и поддержку комфортных условий в классе' : 'Немає необхідності переплачувати за оренду приміщення і підтримку комфортних умов в класі'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-stream">
        <h2 id="briefly">
            <?php echo($lang ? 'КОРОТКО О ДАННОЙ ПРОГРАММЕ' : 'КОРОТКО ПРО ДАНУ ПРОГРАМУ'); ?>
            <span>
	  				<?php echo($lang ? 'Запомни раз и навсегда до 80 000 английских слов за 20 минут' : "Запам'ятай раз і назавжди до 80 000 англійських слів за 20 хвилин"); ?>
	  			</span>
        </h2>
        <div class="b-ayshe-video-section col-md-12">
            <video width="100%" height="100%" loop preload autoplay
                   poster="<?php bloginfo('template_directory'); ?>/relize/img/backgrounds/stream.png"
                   src="<?php bloginfo('template_directory'); ?>/relize/video-cut.mp4">
            </video>
        </div>
        <div class="b-ayshe-stream__overlay">
            <a target="blank" href="https://www.youtube.com/watch?v=HP5M0qxRICA">
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/knipo4ka.png" alt="play"/>
            </a>
        </div>
    </div>
</main>

<form action="<?php echo get_permalink(8450); ?>" method="POST" id="payment_reserve" class="hidden">
    <input type="hidden" name="id_course" value="6963">
    <input type="hidden" name="price" value="ayshe_reserve">
</form>

<?php
if (isset($_GET['usd'])) {
    ?>
    <script type="text/javascript">
        $('#five-uah').css('display', 'none');
        $('#five-usd').css('display', 'block');
        $('#eight-usd').css('display', 'inline-block').siblings('.b-ayshe-bottom-header--sign-up p span').css('display', 'none');
    </script>
    <?php
}
?>

<script src="<?php bloginfo('template_directory'); ?>/relize/js/parallax.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/relize/js/countUp.js"></script>

<?php get_footer(); ?>