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

    <script src="<?php bloginfo('template_directory'); ?>/relize/js/parallax.min.js"></script>

    <script src="<?php bloginfo('template_directory'); ?>/relize/js/main_v3.js"></script>


</head>

<body id="b-ayshe-body">
<header id="b-ayshe-header">
    <!-- hidden menu begin -->
    <!-- <div class="b-ayshe-container b-ayshe-hidden-menu">
		  <div class="b-ayshe-wrapper">
			<nav class="b-ayshe-header__main-nav navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="#"><img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/new-ayshe-small-logo.png" alt="ayshe"/></a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="b-ayshe-header-ul nav navbar-nav">
		        <li ><a class="active" href="#programme">программа курса</a></li>
		        <li><a href="#benefits">наши преимущества</a></li>
		        <li><a href="#study">формат обучения</a></li>
		        <li><a href="#briefly">коротко о программе</a></li>
		        <li><a href="#contacts">КОНТАКТЫ</a></li>
		        <li class="b-ayshe-menu-li-booking"><a class="b-ayshe-menu-booking" href="#">ЗАБРОНИРОВАТЬ МЕСТО</a></li> 
		      </ul>
		      <ul class="b-ayshe-header__currency">
		      	<li class="dropdown">
	          			<a id="uah" class="dropdown-toggle" data-toggle="dropdown" href="#">uah</a>
			        <ul class="b-ayshe-header__currency__drop dropdown-menu">
			          
			          <li><a id="usd" href="#">usd</a></li>
			          <li><a id="rub" href="#">rub</a></li>
			        </ul>
	        		</li>
		      </ul>
		    </div>
		  </div>
		</nav>
	  </div>
	 </div>  -->
    <!-- hidden menu end -->


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
                        <a class="navbar-brand" href="#"><img
                                    src="<?php bloginfo('template_directory'); ?>/relize/img/icons/new-ayshe-logo.png"
                                    class="img-responsive" alt="ayshe"/></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="b-ayshe-header-ul nav navbar-nav">
                            <li><a class="active" href="#programme">программа курса</a></li>
                            <li><a href="#benefits">наши преимущества</a></li>
                            <li><a href="#study">формат обучения</a></li>
                            <li><a href="#briefly">коротко о программе</a></li>
                            <li><a href="#contacts">КОНТАКТЫ</a></li>
                            <!-- <li class="b-ayshe-header__booking"><a href="#">ЗАБРОНИРОВАТЬ МЕСТО</a></li> -->
                        </ul>
                        <div class="b-ayshe-header__currency">
                            <!-- <li class="dropdown">
                                                  <a id="uah" class="dropdown-toggle active" data-toggle="dropdown" href="#">uah</a>
                                                <ul class="b-ayshe-header__currency__drop dropdown-menu">

                                                  <li><a id="usd" href="#">usd</a></li>
                                                  <li><a id="rub" href="#">rub</a></li>
                                                </ul>
                                            </li> -->
                            <form id="switch-currency_form" method="POST" action="">
                                <?php $currencyName = $_POST["currency"];
                                //var_dump($currencyName);
                                if (empty($currencyName)) {
                                    $currencyName = 'usd';
                                }
                                if ($currencyName == 'uah') {
                                    ?>
                                    <label for="grn" class="active-currency">uah</label>
                                    <input id="grn" type="radio" name="currency" value="uah" checked="checked">
                                    <label for="usd">usd</label>
                                    <input id="usd" type="radio" name="currency" value="usd">
                                    <label for="rub">rub</label>
                                    <input id="rub" type="radio" name="currency" value="rub">
                                <?php }
                                if ($currencyName == 'usd') {
                                    ?>
                                    <label for="usd" class="active-currency">usd</label>
                                    <input id="usd" type="radio" name="currency" value="usd" checked="checked">
                                    <label for="grn">uah</label>
                                    <input id="grn" type="radio" name="currency" value="uah">

                                    <label for="rub">rub</label>
                                    <input id="rub" type="radio" name="currency" value="rub">
                                <?php }
                                if ($currencyName == 'rub') {
                                    ?>
                                    <label for="rub" class="active-currency">rub</label>
                                    <input id="rub" type="radio" name="currency" value="rub" checked="checked">
                                    <label for="grn">uah</label>
                                    <input id="grn" type="radio" name="currency" value="uah">
                                    <label for="usd">usd</label>
                                    <input id="usd" type="radio" name="currency" value="usd">

                                <?php } ?>
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
                            от Айше Борсеитовой
                            <span class="b-ayshe-header-main-heading">
							Инновационная методика
						</span>
                            <span class="b-ayshe-header-blue-span">Онлайн</span> <span
                                    class="b-ayshe-header-dark-blue-span">- изучения английского</span>
                            <span class="b-ayshe-header-blue-span">из любой точки мира</span>

                        </p>
                    </div>

                    <div class="b-ayshe-bottom-header--sign-up col-md-12">
                        <div class="b-ayshe-bottom-header--sign-up--wrapper">
                            <form action="<?php echo get_permalink(6847); ?>" method="POST">
                                <input type="hidden" name="id_course" value="6963">
                                <input type="submit" class="b-ayshe-bottom-header--sign-up" value="Записаться на курс">
                            </form>
                            <p>
                                Стоимость курса:<br>
                                <span class="b-ayshe-header-cost-span">8000 тмт.</span>
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


    </div>
</header>
<main id="b-ayshe-main">
    <div class="b-ayshe-grey-header container">
        <div class="b-ayshe-grey-header__item col-md-6">
            <div class="b-ayshe-grey-header__item--img-wrapper">
                <p>
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/blue-check.png" alt="ayshe"/>

                    Ближайший курс <br/>
                    <span>
		  					Стартует 14.05.2016
		  				</span>
                </p>
            </div>
        </div>
        <div class="b-ayshe-grey-header__item col-md-6">
            <div class="b-ayshe-grey-header__item--img-wrapper">
                <p>
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/packman.png" alt="ayshe"/>

                    Длительность курса: 50 ч. <br/>
                    <span>
		  					Курс читается 2-3 раза в неделю
		  				</span>
                </p>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container">
        <div class="b-ayshe-wrapper">
            <div class="b-ayshe__programme">
                <h1 id="programme" class="b-ayshe__programme--heading">
                    Программа курса
                </h1>
                <p class="b-ayshe__programme--small-heading">
                    Включает в себя 33 практических занятий
                </p>
                <div class="col-md-12 b-ayshe__programme--steps">
                    <div class="col-md-5 col-sm-4 col-xs-4 digits">
						
							<span>
								01-05
							</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 b-ayshe__programme--pic">
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step1.png" alt="step1"/> -->
                        <div class="b-ayshe__programme--pic__container">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p>
                                    5
                                    <span>
											занятий
										</span>
                                </p>
                            </div>
                            <div class="archide">
                                <div class="arc"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-4 text">
                        <p>
                            Будут посвящены изучению 9 времен и 80+ выражений, необходимых для устной речи. Ты узнаешь
                            словарный и грамматический минимум, который нужен для поддержания разговора на общую
                            тематику с элементами ИТ.
                        </p>
                    </div>
                </div>
                <div class="col-md-12 b-ayshe__programme--steps">
                    <div class="col-md-5 col-sm-4 col-xs-4 text">
                        <p>
                            Дадут основополагающие знания и умения использовать весь запас грамматических времен
                            английского языка. Ты изучишь основные конструкции и
                            <span> 300 практических выражений </span>, которые нужны для правильного и живого общения с
                            native speaker как на общие тематики, так и для сферы бизнес английского.
                        </p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 b-ayshe__programme--pic">
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step2.png" alt="step2"/> -->
                        <div class="b-ayshe__programme--pic__container">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p>
                                    10
                                    <span>
											занятий
										</span>
                                </p>
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
                    <div class="col-md-5 col-sm-6 col-xs-6 digits">
							<span>
								16-33
							</span>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 b-ayshe__programme--pic">
                        <div class="b-ayshe__programme--pic__container">
                            <div class="archide archideLeft">
                                <div class="arc"></div>
                            </div>
                            <div class="b-ayshe__programme--pic__container--text">
                                <p>
                                    18
                                    <span>
											занятий
										</span>
                                </p>
                            </div>
                            <div class="archide">
                                <div class="arc"></div>
                            </div>
                        </div>
                        <!-- <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/step3.png" alt="step3"/> -->
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12 list">

                        <h3>
                            Интенсивный блок программы, включающий:
                        </h3>
                        <p>
                            Закрепление и автоматизацию навыков использования 9 времен, необходимых для устной речи
                        </p>
                        <p>
                            Закрепление лексического минимума устной речи (700 - 1000 самых используемых выражений и
                            слов)
                        </p>
                        <p>
                            Устная практика речи на различные бизнес-тематики (переговоры, подписание контракта, наем
                            сотрудника, судебный иск, расторжение договора, собеседование и пр.)
                        </p>
                        <p>
                            Мультимедийная часть практических занятий (просмотр английских фильмов и виде-роликов,
                            прослушивание англоязычных песен, новостей, ведение беседы, дискуссии на английском)
                        </p>
                        <p>
                            Оттачивание навыков письменной английской речи
                        </p>
                        <p>
                            Участие в бизнес-сообществе, networking.
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
                технический английский в цифрах
            </h2>
            <div class="col-md-12">
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>50
                            <span>часов</span></p>
                    </div>
                    <p>
                        Это 33 встречи <br>по 1.5 часа
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>90
                            <span>минут</span></p>
                    </div>
                    <p>
                        Длительность <br>одного занятия
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>3<br>
                            <span>ЗАНЯТИЯ</span></p>
                    </div>
                    <p>
                        В неделю
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>2.5
                            <span>МЕСЯЦА</span></p>
                    </div>
                    <p>
                        Длительность <br>полного курса
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-advantages">
        <div class="b-ayshe-narrow-wrapper">
            <h2 id="benefits">
                наши преимущества
            </h2>
            <div class="col-md-12 b-ayshe-advantages__wrapper">

                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-1.png"
                             alt="advantages"/>
                        Не нужно покупать никаких книг и учебных материалов
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-2.png"
                             alt="advantages"/>
                        В краткие сроки, но с нагрузкой не более 1.5 часа, с целью качественного усвоения информации
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-3.png"
                             alt="advantages"/>
                        Современные, харизматичные преподаватели, обожающие свою работу
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-4.png"
                             alt="advantages"/>
                        Справедливая цена
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-5.png"
                             alt="advantages"/>
                        Психологические методы обучения, постановка целей и их пошаговое осуществление, мотивация,
                        осознание своей ответственности за результат и его качество
                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-6.png"
                             alt="advantages"/>
                        Легкая и интересная подача без лингвистических объяснений

                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-7.png"
                             alt="advantages"/>
                        Эффективно: каждый урок = нескольким месяцам обучения по стандартным методикам
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-8.png"
                             alt="advantages"/>
                        Информация, которой нет в других источниках
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-9.png"
                             alt="advantages"/>
                        Поэтапная оплата
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-10.png"
                             alt="advantages"/>
                        Networking и бизнес-сообщество

                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-11.png"
                             alt="advantages"/>
                        Отсутствие домашних заданий, упражнений, экзаменов, заучивания

                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-12.png"
                             alt="advantages"/>
                        Пробные 5 занятий, чтобы убедиться в эффективности и уже получить результат
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-13.png"
                             alt="advantages"/>
                        Только живой английский и необходимые знания
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-14.png"
                             alt="advantages"/>
                        Говорите уже с 15 занятия
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-15.png"
                             alt="advantages"/>
                        Секреты полиглотов
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-red parallax-window" data-parallax="scroll"
         data-image-src="<?php bloginfo('template_directory'); ?>/relize/img/backgrounds/red-ayshe.png">
        <div class="b-ayshe__red-inner">
            <p>
                Все еще сомневаешься?<br>
                <span>Оцени эффективность данной программы, пройди первые 5 занятий<br></span>
                за 500 тмт.
                <a href="#">ЗАБРОНИРОВАТЬ МЕСТО</a>
            </p>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-study">
        <h2 id="study" class="b-ayshe-study__headings">
            ФОРМАТ ОБУЧЕНИЯ
            <span>5 простых шагов, чтобы выучить английский язык:</span>
        </h2>
        <div class="b-ayshe-study-wrapper">
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        1
                        <span>шаг</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  Записаться на курс
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        2
                        <span>шаг</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  Получить вводную информацию и материалы для обучения
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        3
                        <span>шаг</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  Мы присылаем Вам доступы к платформе, где будет проходить обучение
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        4
                        <span>шаг</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  Учитывая Ваши цели, мы подбираем программу, форму обучения и учебный план
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        5
                        <span>шаг</span>
                    </p>
                    <a href="#">ЗАБРОНИРОВАТЬ МЕСТО</a>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-headphones">
        <div class="col-md-12 b-ayshe-headphones--inner">
            <p>
                Для занятий необходимо иметь гарнитуру
                <span>(наушники + микрофон), интернет и компьютер</span>
            </p>

        </div>
        <div class="col-md-12 b-ayshe-headphones__sliding-block">
            <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/headphones.png" alt="advantages"/>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-online">
        <div class="b-ayshe-narrow-wrapper">
            <h2>
                преимущества
                <span>ONLINE</span>
                -ОБУЧЕНИЯ
            </h2>
            <div class="col-md-12 b-ayshe-online--inner">
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/waves.png" alt="advantages"/>
                    <p>
                        Гибкий график времени обучения
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/youtube-ayshe.png"
                         alt="advantages"/>
                    <p>
                        Доступ к видео-лекциям, тестам и другим материалам
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/arrow-ayshe.png"
                         alt="advantages"/>
                    <p>
                        Удаленные занятия: дома, в транспорте, на работе, на отдыхе
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/bucks.png" alt="advantages"/>
                    <p>
                        Нет необходимости переплачивать за аренду помещения и поддержку комфортных условий в классе
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-stream">
        <h2 id="briefly">
            КОРОТКО О ДАННОЙ ПРОГРАММЕ
            <span>Запомни раз и навсегда до 80 000 английских слов за 20 минут</span>
        </h2>
    </div>
</main>

<?php get_footer(); ?>