<?php
language_fraud();
if (get_locale() == 'en_GB') {
    if (!in_array(get_the_ID(), [11097, 11093])) {
        wp_redirect(get_permalink(11093));
        exit;
    }
}

$lang = (get_locale() == 'ru_RU');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
        w[l] = w[l] || []
        w[l].push(
          { 'gtm.start': new Date().getTime(), event: 'gtm.js' }
        )
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''
        j.async = true
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl
        f.parentNode.insertBefore(j, f)
      })(window, document, 'script', 'dataLayer', 'GTM-MZ3WL6B')</script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="yandex-verification" content="37ad0abcdc36f2be">
    <?php
	$lao = get_locale() == 'uk';
	if (is_front_page() and $lao ){
		?> <title> Курси програмування та веб-дизайну в Києві | ITEA </title> <?php
    	
	} else {
		?><title><?php wp_title(); ?></title> <?php
	} ?>
    <?php
    if (is_404() || is_attachment() || is_search()) {
        echo '<meta name="robots" content="noindex,nofollow"><meta name="robots" content="none">';
    } elseif (is_front_page() || is_category() || is_single()) {
//        echo '<meta name="robots" content="index,follow"><meta name="robots" content="all">';
    }
    ?>
<?php
	
    
    ?>
	

    <?php wp_head(); ?>
    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">

    <?php if (in_array(get_query_var('cat'), [25, 310])) { ?>
        <!-- <style type="text/css">
            .content .container {
                width: 1280px !important;
            }
         </style> -->
    <?php } ?>

    <!-- Facebook Pixel Code -->
    <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return
        n = f.fbq = function () {
          n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        }
        if (!f._fbq) f._fbq = n
        n.push = n
        n.loaded = !0
        n.version = '2.0'
        n.queue = []
        t = b.createElement(e)
        t.async = !0
        t.src = v
        s = b.getElementsByTagName(e)[0]
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js')
      fbq('init', '474899822710267')
      fbq('track', 'PageView')
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=474899822710267&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Hotjar Tracking Code for itea.ua -->
    <script>
      (function (h, o, t, j, a, r) {
        h.hj = h.hj || function () {
          (h.hj.q = h.hj.q || []).push(arguments)
        }
        h._hjSettings = { hjid: 507818, hjsv: 5 }
        a = o.getElementsByTagName('head')[0]
        r = o.createElement('script')
        r.async = 1
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv
        a.appendChild(r)
      })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=')
    </script>

    <!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css"><![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!---->
    <!--    <script>-->
    <!--        (function (i, s, o, g, r, a, m) {-->
    <!--            i['GoogleAnalyticsObject'] = r;-->
    <!--            i[r] = i[r] || function () {-->
    <!--                    (i[r].q = i[r].q || []).push(arguments)-->
    <!--                }, i[r].l = 1 * new Date();-->
    <!--            a = s.createElement(o),-->
    <!--                m = s.getElementsByTagName(o)[0];-->
    <!--            a.async = 1;-->
    <!--            a.src = g;-->
    <!--            m.parentNode.insertBefore(a, m)-->
    <!--        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');-->
    <!---->
    <!--        ga('create', 'UA-68457841-1', 'auto');-->
    <!--        ga('send', 'pageview');-->
    <!--    </script>-->

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push(
        { google_ad_client: 'ca-pub-2426960159312896', enable_page_level_ads: true }
      )
    </script>

    <style>
        .hide_body > *:not(#preload-it) {
            opacity: 0;
        }
    </style>

</head>
<body class="hide_body">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MZ3WL6B"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<style>
    #preload-it {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: top .5s;
        z-index: 999999;
    }
</style>
<div id="preload-it">
    <img src="/wp-content/themes/new-it/images/Spinner-1s-200px.svg" alt="spinner-it" width="160" height="160">
</div>
<script>
  window.addEventListener('load', function () {
    var preloaderBlock = document.getElementById('preload-it')
    preloaderBlock.style.top = '-110vh'
    document.body.classList.remove('hide_body')
  })
</script>
<header id="header" class="default navbar navbar-default">

    <div class="b-menu-wrapper container">

        <div class="left_header_part">
            <a href="https://itea.asia/" id="logo" class="pull-left" style="padding-right: 40px;">
                <input type="hidden" id="logo-fixed"
                       value="<?php bloginfo('template_directory'); ?>/relize/img/logo-fixed.png"/>
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/logo-itea.svg" alt="ITEA"/>
                <!--            <img src="-->
                <?php //bloginfo('template_directory'); ?><!--/relize/img/logo-itea-black-newyear.svg" alt="ITEA" >-->
            </a>
            <style>
                #logo > img {
                    width: 145px;
                }

                @media (max-width: 767px) {
                    #logo > img {
                        width: 100px;
                    }
                }
            </style>
            <a href="#" class="left_header_part_search"></a>
            <?php if (get_locale() != 'en_GB') { ?>
                <ul class="pos">
                    <li class="parent">
                        <a href="<?php echo get_itea_home_url(); ?>"
                           onclick="return false;"><?php echo($lang ? 'Ашхабад' : 'Ашхабад'); ?></a>
                        <ul class="child">
                            <li class="child_li">
                                <a class="city_name" href="http://lviv.itea.ua/" rel="nofollow">
                                    <?php echo($lang ? 'Львов' : 'Львів'); ?>
                                </a>
                            </li>
                            <li class="child_li">
                                <a class="city_name" href="https://itea.ua/">
                                    <?php echo($lang ? 'Киев' : 'Київ'); ?>
                                </a>
                            </li>
                            <li class="child_li">
                                <a class="city_name" href="https://kharkiv.itea.ua/" rel="nofollow">
                                    <?php echo($lang ? 'Харьков' : 'Харків'); ?>
                                </a>
                            </li>
                            <li class="child_li">
                                <a class="city_name" href="https://itea.uz/" rel="nofollow">
                                    <?php echo($lang ? 'Ташкент' : 'Ташкент'); ?>
                                </a>
                            </li>
                            <li class="child_li">
                                <a class="city_name" href="https://dnipro.itea.ua/" rel="nofollow">
                                    <?php echo($lang ? 'Днепр' : 'Дніпро'); ?>
                                </a>
                            </li>
                            <li class="child_li">
                                <a class="city_name" href="https://lutsk.itea.ua/" rel="nofollow">
                                    <?php echo($lang ? 'Луцк' : 'Луцьк'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>

            <!-- <ul class="lang"><?php pll_the_languages(); ?></ul> -->
        </div>

        <div class="right_header_part">
            <div class="phones-block">
                <?php
                $current_url = explode('/', $_SERVER['REQUEST_URI']);
                ?>
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                <?php if ($current_url[1] == 'corporate-education' || $current_url[1] == 'corporate-education-schedule' || $current_url[1] == 'instructors-corporate') { ?>
                    <a class="phone_header phones-block__phone" href="tel:+380445900838">+38 (044) 590-08-38</a>
                <?php } else {
                    ?>
                    <a class="phone_header phones-block__phone" href="tel:+99363471192">+993 (63) 47-11-92</a>
                    <?php
                } ?>
               
            </div>

            <div class="callback b-header-contacte-phone">
                <a href="#" class="callback-btn" style="white-space: nowrap;letter-spacing: -0.5px;">
                    <?php echo(get_locale() != 'en_GB' ? ($lang ? 'Получить консультацию' : 'Отримати консультацію') : 'Request the callback'); ?>
                </a>
            </div>
        </div>

        <button type="button" class="nav-toggle navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
        </button>

        <!-- <div class="top-search-form">
            <?php get_search_form(); ?>
        </div> -->
    </div><!-- /.container -->

    <div class="b-nav-wrapper">
        <div class="container">
            <div class="navigation">
                <div class="navbar-header">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="nav-controls">

                            <?php if (get_locale() != 'en_GB') { ?>
                                <ul class="pos nav-control">
                                    <li class="parent">
                                        <a href="<?php echo get_itea_home_url(); ?>">
                                            <span class="glyphicon glyphicon-map-marker"></span>
                                            <?php echo($lang ? 'Ашхабад' : 'Ашхабад'); ?>
                                        </a>
                                        <ul class="child">
                                            <li class="child_li">
                                                <a class="city_name" href="http://lviv.itea.ua/" rel="nofollow">
                                                    <?php echo($lang ? 'Львов' : 'Львів'); ?>
                                                </a>
                                            </li>
                                            <li class="child_li">
                                                <a class="city_name" href="<?php echo get_itea_home_url(); ?>">
                                                    <?php echo($lang ? 'Киев' : 'Київ'); ?>
                                                </a>
                                            </li>
                                            <li class="child_li">
                                                <a class="city_name" href="https://kharkiv.itea.ua/" rel="nofollow">
                                                    <?php echo($lang ? 'Харьков' : 'Харків'); ?>
                                                </a>
                                            </li>
                                            <li class="child_li">
                                                <a class="city_name" href="https://itea.uz/" rel="nofollow">
                                                    <?php echo($lang ? 'Ташкент' : 'Ташкент'); ?>
                                                </a>
                                            </li>
                                            <li class="child_li">
                                                <a class="city_name" href="https://dnipro.itea.ua/" rel="nofollow">
                                                    <?php echo($lang ? 'Днепр' : 'Дніпро'); ?>
                                                </a>
                                            </li>
                                            <li class="child_li">
                                                <a class="city_name" href="https://lutsk.itea.ua/" rel="nofollow">
                                                    <?php echo($lang ? 'Луцк' : 'Луцьк'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            <?php } ?>

                            <!-- <ul class="lang"><?php pll_the_languages(); ?></ul> -->
                        </div>

                        <?php
                        $menu_options = [
                            'menu' => 'Main Menu' . (get_locale() == 'ru_RU' ? '' : (get_locale() == 'en_GB' ? ' (en)' : ' (uk)')),
                            'container' => 'nav',
                            'container_class' => '',
                            'container_id' => '',
                            'menu_id' => 'flex'
                        ];
                        wp_nav_menu($menu_options);
                        ?>
                    </div>
                </div>
            </div>

            <?php if (get_locale() != 'en_GB') { ?>
                <!-- <div class="header-search">
                    <?php get_search_form(); ?>
                    <button class="show-search"><?php echo($lang ? 'Поиск' : 'Пошук'); ?> </button>
                    <button class="show-search show-search-show" style="left: 0; display: none; "></button>
                </div> -->
            <?php } ?>
        </div>
</header><!-- /header -->

<div class="content">
