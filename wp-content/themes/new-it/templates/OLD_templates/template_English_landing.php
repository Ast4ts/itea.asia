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
                                   href="#programme"><?php echo($lang ? '?????????????????? ??????????' : '???????????????? ??????????'); ?></a>
                            </li>
                            <li><a href="#benefits"><?php echo($lang ? '???????? ????????????????????????' : '???????? ????????????????'); ?></a>
                            </li>
                            <li><a href="#study"><?php echo($lang ? '???????????? ????????????????' : '???????????? ????????????????'); ?></a></li>
                            <li>
                                <a href="#briefly"><?php echo($lang ? '?????????????? ?? ??????????????????' : '?????????????? ?????? ???????? ????????????????'); ?></a>
                            </li>
                            <li><a href="#contacts"><?php echo($lang ? '????????????????' : '????????????????'); ?></a></li>
                            <li class="b-ayshe-header__booking"><a href="#"
                                                                   onclick="document.getElementById('payment_reserve').submit(); return false;"><?php echo($lang ? '???????????? 5 ??????????????' : '?????????? 5 ????????????'); ?></a>
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
                            <?php echo($lang ? '???? ???????? ??????????????????????' : '?????? ???????? ??????????????????????'); ?>
                            <span class="b-ayshe-header-main-heading">
							<?php echo($lang ? '?????????????????????????? ????????????????' : '?????????????????????? ????????????????'); ?>
						</span>
                            <span class="b-ayshe-header-blue-span">????????????</span>
                            <span class="b-ayshe-header-dark-blue-span">- <?php echo($lang ? '???????????????? ??????????????????????' : '???????????????? ?????????????????????? ????????'); ?></span>
                            <span class="b-ayshe-header-blue-span"><?php echo($lang ? '???? ?????????? ?????????? ????????' : '?? ????????-???????? ?????????? ??????????'); ?></span>

                        </p>
                    </div>

                    <div class="b-ayshe-bottom-header--sign-up col-md-12">
                        <div class="b-ayshe-bottom-header--sign-up--wrapper">

                            <form action="<?php echo get_permalink(8450); ?>" method="POST" id="payment_buy">
                                <input type="hidden" name="id_course" value="6963">
                                <input type="hidden" name="price" value="ayshe_buy">
                                <input type="submit" class="b-ayshe-bottom-header--sign-up"
                                       value="<?php echo($lang ? '???????????????????? ???? ????????' : '???????????????????? ???? ????????'); ?>">
                            </form>

                            <p>
                                <?php echo($lang ? '?????????????????? ??????????:' : '???????????????? ??????????:'); ?><br>
                                <span class="b-ayshe-header-cost-span" id="eight-uah"><?php echo $full_price; ?>
                                    ??????.</span>
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

                    <?php echo($lang ? '?????????????????? ????????' : '???????????????????? ????????'); ?><br/>
                    <span>
		  					<?php echo($lang ? '????????????????' : '??????????????'), $start_date; ?>
		  				</span>
                </p>
            </div>
        </div>
        <div class="b-ayshe-grey-header__item col-md-6">
            <div class="b-ayshe-grey-header__item--img-wrapper">
                <p>
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/packman.png" alt="ayshe"/>

                    <?php echo($lang ? '???????????????????????? ??????????:' : '???????????????????? ??????????:'); ?> 33 ??????????<br/>
                    <span>
		  					<?php echo($lang ? '???????? ????????????????' : '???????? ??????????????????'); ?><?php echo $time_spending; ?>
		  				</span>
                </p>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container">
        <div class="b-ayshe-wrapper">
            <div class="b-ayshe__programme">
                <h1 id="programme" class="b-ayshe__programme--heading">
                    <?php echo($lang ? '?????????????????? ??????????' : '???????????????? ??????????'); ?>
                </h1>
                <p class="b-ayshe__programme--small-heading">
                    <?php echo($lang ? '???????????????? ?? ???????? 33 ???????????????????????? ??????????????' : '?????????????? ?? ???????? 33 ???????????????????? ??????????????'); ?>
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
											<?php echo($lang ? '??????????????' : '????????????'); ?>
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
                                ?????????? ?????????????????? ?????????????????????? ???????????????????????????????? ?????????????????? ??????????????, ?????????????????????????? ?? ?????????????????????????? ???????????????????? ???????????????????? ????????????, ???????????? ?????????????????????????? ???????????????????? ???????? ???? ????????. ???????????????? ??????????????????????, ?????????????????????? ?????? ?????????????????????? ???????????????????? ??????????????????????.
                            <?php } else { ?>
                                ???????????? ???????????????????? ???????????????? 9 ?????????????????????? ?????????? ???? 80+ ??????????????, ???????????????????? ?????? ???????????? ????????????????. ???? ???????????? ?????????????????? ???? ?????????????????????? ??????????????, ???????? ???????????????? ?????? ?????????????????????? ?????????????? ???? ???????????????? ???????????????? ?? ???????????????????? ????.
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 b-ayshe__programme--steps">
                    <div class="col-md-5 col-sm-4 col-xs-4 text">
                        <p>
                            <?php if ($lang) { ?>
                                ?????????? ???????????????????????????????? ???????????? ?? ???????????? ???????????????????????? ???????? ?????????? ???????????????????????????? ???????????? ?????????????????????? ??????????. ???? ?????????????? ???????????????? ?????????????????????? ??
                                <span>300 ???????????????????????? ??????????????????</span>, ?????????????? ?????????? ?????? ?????????????????????? ?? ???????????? ?????????????? ?? native speaker ?????? ???? ?????????? ????????????????, ?????? ?? ?????? ?????????? ???????????? ??????????????????????.
                            <?php } else { ?>
                                ???????????? ???????????? ???????????? ???? ???????????? ?????????????????????????????? ?????????? ?????????? ?????????????????????? ?????????? ?????????????????????? ????????. ???? ???????????? ?????????????? ?????????????????????? ????
                                <span>300 ???????????????????? ??????????????</span>, ?????? ?????????????????? ?????? ?????????????????????? ???? ???????????? ?????????????????????? ?? native speaker ???? ???? ???????????????? ????????????????, ?????? ?? ?????? ?????????? ????????????-??????????????????????.
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
											<?php echo($lang ? '??????????????' : '????????????'); ?>
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
											<?php echo($lang ? '??????????????' : '????????????'); ?>
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
                            <?php echo($lang ? '?????????????????????? ???????? ??????????????????, ????????????????????:' : '?????????????????????? ???????? ????????????????, ???? ??????????????:'); ?>
                        </h3>
                        <p>
                            <?php echo($lang ? '?????????????????????? ?? ?????????????????????????? ?????????????? ?????????????????????????? 9 ????????????, ?????????????????????? ?????? ???????????? ????????' : '?????????????????????? ???? ?????????????????????????? ?????????????? ???????????????????????? 9 ?????????????????????? ??????????, ???????????????????? ?????? ???????????? ????????????????'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? '?????????????????????? ???????????????????????? ???????????????? ???????????? ???????? (700 - 1000 ?????????? ???????????????????????? ?????????????????? ?? ????????)' : '?????????????????????? ???????????????????? ???????????????? ???????????? ???????????????? (700-1000 ???????????????? ???????????????????????????????? ?????????????? ???? ????????)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? '???????????? ???????????????? ???????? ???? ?????????????????? ????????????-???????????????? (????????????????????, ???????????????????? ??????????????????, ???????? ????????????????????, ???????????????? ??????, ?????????????????????? ????????????????, ?????????????????????????? ?? ????.)' : '???????? ???????????????? ???????????????? ???? ?????????? ????????????-???????? (????????????????, ???????????????????? ??????????????????, ?????????? ??????????????????????????, ?????????????? ??????????, ???????????????????? ???? ????????)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? '???????????????????????????? ?????????? ???????????????????????? ?????????????? (???????????????? ???????????????????? ?????????????? ?? ????????-??????????????, ?????????????????????????? ???????????????????????? ??????????, ????????????????, ?????????????? ????????????, ?????????????????? ???? ????????????????????)' : '?????????????????????????? ?????????????? ???????????????????? ???????????? (???????????????? ?????????????????????? ?????????????? ???? ??????????-??????????????, ?????????????????????????????? ?????????????????????? ????????????, ??????????, ?????????????? ????????????, ???????????????? ?????????????????????? ??????????)'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? '?????????????????????? ?????????????? ???????????????????? ???????????????????? ????????' : '?????????????????????? ?????????????? ???????????????????? ???????????????????????? ????????????????'); ?>
                        </p>
                        <p>
                            <?php echo($lang ? '?????????????? ?? ????????????-????????????????????, networking.' : '???????????? ?? ????????????-??????????????????, networking.'); ?>
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
                <?php echo($lang ? '?????????????????????? ???????????????????? ?? ????????????' : '???????????????? ???????????????????? ?? ????????????'); ?>
            </h2>
            <div class="col-md-12">
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>50
                            <span><?php echo($lang ? '??????????' : '??????????'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? '?????? 33 ??????????????' : '???? 33 ????????????????'); ?> <br>????
                        1.5 <?php echo($lang ? '????????' : '????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>90
                            <span><?php echo($lang ? '??????????' : '????????????'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? '???????????????????????? <br> ???????????? ??????????????' : '???????????????????? <br> ???????????? ??????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>3<br>
                            <span><?php echo($lang ? '??????????????' : '??????????????'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? '?? ????????????' : '???? ??????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 b-ayshe-blue-graphic__item">
                    <div class="b-ayshe-blue-graphic--round">
                        <p>2.5
                            <span><?php echo($lang ? '????????????' : '????????????'); ?></span></p>
                    </div>
                    <p>
                        <?php echo($lang ? '???????????????????????? <br> ?????????????? ??????????' : '???????????????????? <br> ?????????????? ??????????'); ?>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-advantages">
        <div class="b-ayshe-narrow-wrapper">
            <h2 id="benefits">
                <?php echo($lang ? '???????? ????????????????????????' : '???????? ????????????????'); ?>
            </h2>

            <div class="col-md-12 b-ayshe-advantages__wrapper">
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-1.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???? ?????????? ???????????????? ?????????????? ???????? ?? ?????????????? ????????????????????' : '???? ???????????????? ???????????????? ?????????? ???? ?????????????????? ??????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-2.png"
                             alt="advantages"/>
                        <?php echo($lang ? '?? ?????????????? ??????????, ???? ?? ?????????????????? ???? ?????????? 1.5 ????????, ?? ?????????? ?????????????????????????? ???????????????? ????????????????????' : '???????????????? ??????????, ?????? ?? ?????????????????????????? ???? ???????????? 1,5 ????????????, ?? ?????????? ???????????????? ?????????????????? ????????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-3.png"
                             alt="advantages"/>
                        <?php echo($lang ? '??????????????????????, ?????????????????????????? ??????????????????????????, ?????????????????? ???????? ????????????' : '??????????????, ???????????????????????? ??????????????????, ?????????????? ?????????? ????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-4.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???????????????????????? ????????' : '?????????????????????? ????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-5.png"
                             alt="advantages"/>
                        <?php echo($lang ? '?????????????????????????????? ???????????? ????????????????, ???????????????????? ?????????? ?? ???? ?????????????????? ??????????????????????????, ??????????????????, ?????????????????? ?????????? ?????????????????????????????? ???? ?????????????????? ?? ?????? ????????????????' : '???????????????????????? ???????????? ????????????????, ???????????????????? ?????????? ???? ???? ?????????????????? ??????????????????, ??????????????????, ?????????????????? ?????????? ???????????????????????????????? ???? ?????????????????? ???? ???????? ????????????'); ?>
                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-6.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???????????? ?? ???????????????????? ???????????? ?????? ?????????????????????????????? ????????????????????' : '?????????? ???? ???????????? ???????????? ?????? ?????????????????????????? ????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-7.png"
                             alt="advantages"/>
                        <?php echo($lang ? '????????????????????: ???????????? ???????? = ???????????????????? ?????????????? ???????????????? ???? ?????????????????????? ??????????????????' : '??????????????????: ?????????? ?????????????? = ???????????????? ?????????????? ???????????????? ???? ???????????????????????? ????????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-8.png"
                             alt="advantages"/>
                        <?php echo($lang ? '????????????????????, ?????????????? ?????? ?? ???????????? ????????????????????' : '????????????????????, ???????? ?????????? ?? ?????????? ????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-9.png"
                             alt="advantages"/>
                        <?php echo($lang ? '?????????????????? ????????????' : '???????????????? ????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-10.png"
                             alt="advantages"/>
                        Networking <?php echo($lang ? '?? ????????????-????????????????????' : '?? ????????????-??????????????????'); ?>
                    </p>
                </div>
                <div class="col-md-4 b-ayshe-advantages__item">
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-11.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???????????????????? ???????????????? ??????????????, ????????????????????, ??????????????????, ????????????????????' : '?????????????????????? ???????????????? ??????????????, ??????????, ?????????????????? ???? ????????????????????'); ?>

                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-12.png"
                             alt="advantages"/>
                        <?php echo($lang ? '?????????????? 5 ??????????????, ?????????? ?????????????????? ?? ?????????????????????????? ?? ?????? ???????????????? ??????????????????' : '???????????? 5 ????????????, ?????? ???????????????????? ?? ???????????????????????? ???? ?????? ???????????????? ??????????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-13.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???????????? ?????????? ???????????????????? ?? ?????????????????????? ????????????' : '???????????? ???????? ???????????????????? ???? ?????????????????? ????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-14.png"
                             alt="advantages"/>
                        <?php echo($lang ? '???????????????? ?????? ?? 15 ??????????????' : '?????????????? ???????????????? ?????????????????????? ?????? ?? 15 ??????????????'); ?>
                    </p>
                    <p>
                        <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/adv-15.png"
                             alt="advantages"/>
                        <?php echo($lang ? '?????????????? ????????????????????' : '?????????????? ????????????????????'); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-red parallax-window" data-parallax="scroll"
         data-image-src="<?php bloginfo('template_directory'); ?>/relize/img/backgrounds/red-ayshe.png">
        <div class="b-ayshe__red-inner">

            <p class="animated">
                <?php echo($lang ? '?????? ?????? ?????????????????????????' : '?????? ???? ?????????????????'); ?><br>
                <span>
	  					<?php echo($lang ? '?????????? ?????????????????????????? ???????????? ??????????????????, ???????????? ???????????? 5 ??????????????' : '?????????? ???????????????????????? ?????????? ????????????????, ???????????? ?????????? 5 ????????????'); ?>
                    <br>
	  				</span>
                <span id="five-uah">
	  				 	???? 500 ??????.
	  				</span>
                <span id="five-usd">
	  				 	???? $<?php echo round(500 / $rates['usd']); ?>
	  				</span>
            </p>

            <a class="animated" href="#"
               onclick="document.getElementById('payment_reserve').submit(); return false;"><?php echo($lang ? '?????????????????????????? ??????????' : '?????????????????????? ??????????'); ?></a>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-study">
        <h2 id="study" class="b-ayshe-study__headings">
            <?php echo($lang ? '???????????? ????????????????' : '???????????? ????????????????'); ?>
            <span>
	  				<?php echo($lang ? '5 ?????????????? ??????????, ?????????? ?????????????? ???????????????????? ????????:' : '5 ?????????????? ????????????, ?????? ?????????????? ???????????????????? ????????:'); ?>
	  			</span>
        </h2>
        <div class="b-ayshe-study-wrapper">
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        1
                        <span>
		  						 <?php echo($lang ? '??????' : '????????'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? '???????????????????? ???? ????????' : '???????????????????? ???? ????????'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        2
                        <span>
		  						 <?php echo($lang ? '??????' : '????????'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? '???????????????? ?????????????? ???????????????????? ?? ?????????????????? ?????? ????????????????' : '???????????????? ?????????????? ???????????????????? ???? ?????????????????? ?????? ????????????????'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        3
                        <span>
		  						 <?php echo($lang ? '??????' : '????????'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? '???? ?????????????????? ?????? ?????????????? ?? ??????????????????, ?????? ?????????? ?????????????????? ????????????????' : '???? ???????????????????? ?????? ?????????????? ???? ??????????????????, ???? ?????????????????????????????? ????????????????'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        4
                        <span>
		  						 <?php echo($lang ? '??????' : '????????'); ?>
		  					</span>
                    </p>
                    <span class="b-ayshe-study__sign-up">
		  					  <?php echo($lang ? '???????????????? ???????? ????????, ???? ?????????????????? ??????????????????, ?????????? ???????????????? ?? ?????????????? ????????' : '???????????????????? ???????? ????????, ???? ???????????????????? ????????????????, ?????????? ???????????????? ???? ???????????????????? ????????'); ?>
		  				</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 b-ayshe-study__item">
                <div class="b-ayshe-study__item--inner">
                    <p>
                        5
                        <span>
		  						 <?php echo($lang ? '??????' : '????????'); ?>
		  					</span>
                    </p>
                    <a href="#"
                       onclick="document.getElementById('payment_buy').submit(); return false;"><?php echo($lang ? '?????????????????????????? ??????????' : '?????????????????????? ??????????'); ?></a>
                </div>
            </div>

        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-headphones">
        <div class="col-md-12 b-ayshe-headphones--inner">
            <p>
                <?php echo($lang ? '?????? ?????????????? ???????????????????? ?????????? ??????????????????' : '?????? ???????????? ?????????????????? ???????? ??????????????????'); ?>
                <span>
						<?php echo($lang ? '(???????????????? + ????????????????), ???????????????? ?? ??????????????????' : "(?????????????????? + ????????????????), ???????????????? ???? ????????'????????"); ?>
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
                <?php echo($lang ? '???????????????????????? <span>ONLINE</span>-????????????????' : '???????????????? <span>ONLINE</span>-????????????????'); ?>
            </h2>
            <div class="col-md-12 b-ayshe-online--inner">
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/waves.png" alt="advantages"/>
                    <p>
                        <?php echo($lang ? '???????????? ???????????? ?????????????? ????????????????' : '?????????????? ???????????? ????????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/youtube-ayshe.png"
                         alt="advantages"/>
                    <p>
                        <?php echo($lang ? '???????????? ?? ??????????-??????????????, ???????????? ?? ???????????? ????????????????????' : '???????????? ???? ??????????-????????????, ???????????? ???? ?????????? ????????????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/arrow-ayshe.png"
                         alt="advantages"/>
                    <p>
                        <?php echo($lang ? '?????????????????? ??????????????: ????????, ?? ????????????????????, ???? ????????????, ???? ????????????' : '?????????????????????? ??????????????: ??????????, ?? ????????????????????, ???? ????????????, ???? ????????????????????'); ?>
                    </p>
                </div>
                <div class="col-md-3 b-ayshe-online__item">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/bucks.png" alt="advantages"/>
                    <p>
                        <?php echo($lang ? '?????? ?????????????????????????? ?????????????????????????? ???? ???????????? ?????????????????? ?? ?????????????????? ???????????????????? ?????????????? ?? ????????????' : '?????????? ???????????????????????? ?????????????????????????? ???? ???????????? ???????????????????? ?? ?????????????????? ???????????????????? ???????? ?? ??????????'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="b-ayshe-container b-ayshe-stream">
        <h2 id="briefly">
            <?php echo($lang ? '?????????????? ?? ???????????? ??????????????????' : '?????????????? ?????? ???????? ????????????????'); ?>
            <span>
	  				<?php echo($lang ? '?????????????? ?????? ?? ???????????????? ???? 80 000 ???????????????????? ???????? ???? 20 ??????????' : "??????????'???????? ?????? ?? ???????????????? ???? 80 000 ?????????????????????? ???????? ???? 20 ????????????"); ?>
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