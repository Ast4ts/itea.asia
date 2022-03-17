<?php /* Template Name: Payment is successful */

//if (stristr($_SERVER['HTTP_REFERER'], 'https://secure.platononline.com') === false) {
//    wp_redirect(home_url()); exit;
//}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">
    <title><?php wp_title(); ?></title>

    <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/survey_v5.css" />
    <!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css"><![endif]-->

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
<main id="b-survey-main-thanks">
    <div class="b-survey-container container">
        <div class="b-thank-you">
            <div class="b-thank-you-logo">
                <a href="<?php echo get_home_url(); ?>" id="logo">
                    <img src="<?php bloginfo('template_directory'); ?>/relize/img/logo-itea.svg" alt="ITEA">
                </a>
            </div>
            <div class="b-thank-you-icon-ok">
                <img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/thank-you-icon.png" alt="ok">
            </div>
            <div class="b-thank-you-about">
                <p>
                    <?php echo get_the_title(); ?>
                </p>
                <p>
                    <?php if (!empty($_GET['order'])) {
                        echo "Ваш номер платежа: {$_GET['order']}";
                    } ?>
                </p>
                <p>
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            the_content();
                        }
                    }
                    ?>
                </p>
                <a href="https://www.facebook.com/groups/274217216364139/" target="_blank" class="b-thank-you-fb-link">
                    <span>Присоединиться</span>
                </a>
            </div>
            <div class="b-thank-you-home">
                <a href="<?php echo get_home_url(); ?>">На главную</a>
            </div>
        </div>
    </div>
</main>
</body>
</html>