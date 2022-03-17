<?php /* Template Name: Регистрация "ITspring2018" */
$lang = (get_locale() == 'ru_RU');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title><?php wp_title(); ?></title>
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font/font.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/itspring2018.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-68457841-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag()
        {dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-68457841-1');
    </script>
</head>
<body>

<div class="newyear">
    <div class="wrapper">
        <div class="newyear-form">
            <header class="centred">
                <a class="img-responsive apply-form-link" href="<?php echo get_home_url(); ?>">
                    <img src="<?php bloginfo('template_directory'); ?>/images/reg_spring/logo.png" alt="itea">
                    <img class="mobile-hidden" src="<?php bloginfo('template_directory'); ?>/images/reg_spring/mobile-logo.png" alt="itea">
                </a>
                <h1>
                    <?php
                        $page_title = get_the_title();
                        $arr = explode(' ',trim($page_title));
                    ?>
                    <span><?php echo $arr[0]; ?></span><span><?php echo ' '. $arr[1] . ' ' . $arr[2]; ?></span>

                </h1>





                <p class="underform-paragraph">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            the_content();
                        }
                    }
                    ?>
                </p>
            </header>

            <div id="loading"><div id="loading-animation"></div></div>

            <section id="main-form" class="centred">
                <form method="post" class="user-data-form" action="<?php echo esc_url(add_query_arg('action', 'regSpring2018', admin_url('admin-post.php'))); ?>">
                    <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">


                    <input type="text" name="name" value="" placeholder="<?php echo $lang ? 'Имя и фамилия' : 'Ім\'я та прізвище'; ?>" autocomplete="off">

                    <input type="email" name="mail" value="" placeholder="Email">

                    <input type="phone" name="phone" id="userPhone" value="" placeholder="Телефон">

                    <input id="free-select" name="user_selected_profession_IT" />

                    <div class="course-select">
                        <div class="header-select">
                            <h2>
                                <?php echo $lang ? 'Какое направление Вас интересует?' : 'Який напрямок в ІТ цікавить?'; ?>
                            </h2>
                        </div>
                        <div class="flex-blocks">
                            <ul class="list">
                                <li>Java programming</li>
                                <li>QA</li>
                                <li>C++ programming</li>
                                <li>PHP programming</li>
                                <li>C# programming</li>
                                <li>Python programming</li>
                                <li>Product Design</li>
                                <li><?php echo $lang ? 'Курсы для детей' : 'Курси для дітей'; ?></li>
                                <li>Project Management</li>
                                <li><?php echo $lang ? 'Управление персоналом' : 'Управління персоналом'; ?></li>
                            </ul>
                            <ul>
                                <li>Frontend development</li>
                                <li>IOS development</li>
                                <li>Android development</li>
                                <li>DEVOPS</li>
                                <li>Data Science</li>
                                <li>Game Development</li>
                                <li>IT recruiting</li>
                                <li>Business Analisys</li>
                                <li>AGILE/SCRUM</li>
                                <li>Digital Marketing</li>
                            </ul>
                        </div>
                    </div>

                    <input type="submit" name="submit" value="<?php echo $lang ? 'Участвовать' : 'Взяти участь'; ?>">

<!--  ******************************** ACTION DISABLE ******************* -->

<!--                    <div class="form-alert__share">-->
<!--                        --><?php //echo $lang ? 'Акция закончилась 15.01.18.' : 'Акція завершилась 15.01.18.'; ?>
<!--                    </div>-->

                    <div class="more-block">
                        <a href="https://itea.ua/courses-itea/" class="know-more">
                            <?php echo $lang ? 'Узнать больше о курсах' : 'Дізнатись більше про курси'; ?>
                        </a>
                    </div>


                    <span class="form-validation">
                <?php echo $lang ? 'все поля обязательны для заполнения' : 'всі поля обов\'язкові для заповнення'; ?>
            </span>
                </form>
            </section>
        </div>
    </div>
</div>

<footer>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/spring-f-scripts.js"></script>
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

</body>
</html>