<?php
/* Template Name: Tilda Page */
//get_header();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(

            {'gtm.start': new Date().getTime(),event:'gtm.js'}
        );var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MZ3WL6B');</script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="yandex-verification" content="37ad0abcdc36f2be">

    <title><?php wp_title(); ?></title>
    <?php
    if ( is_404() or is_attachment() ) {
        echo '<meta name="robots" content="noindex,nofollow"><meta name="robots" content="none">';
    } elseif (is_front_page() or is_category() or is_single()) {
        echo '<meta name="robots" content="index,follow"><meta name="robots" content="all">';
    }
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
            if (f.fbq)return;
            n = f.fbq = function () {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '474899822710267');
        fbq('track', "PageView");
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
            };
            h._hjSettings = {hjid: 507818, hjsv: 5};
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
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
            { google_ad_client: "ca-pub-2426960159312896", enable_page_level_ads: true }
        );
    </script>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MZ3WL6B"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



    <?php
while(have_posts()) {
    the_post(); ?>
<!--    <h2>--><?php //the_title(); ?><!--</h2>-->
    <?php the_content(); ?>


<?php }?>
<script>
    window.addEventListener('load', function () {
       setTimeout(function() {
           $('select').each(function(index) {
               let option = $(this).find('option'),
                   element = $(this)
               if (option.length === 2) {
                   let DataString = option.last().val();
                   option.last().remove()
                   DataString.split('/n').forEach(function (el, i) {
                       element.append('<option value="'+el+'">'+el+'</option>')
                   })
               }
           })
       }, 1500)
    })
</script>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
<style>
    .t-prefix_3 {
        /*padding-left: 0!important;*/
    }
    b, strong {
        color: inherit!important;
    }
    .hide_body>*:not(#preload-it){
        opacity: 1!important;
    }
    body {
        margin: 0;
    }
    body * {
        font-family: 'Roboto', sans-serif!important;
    }
</style>
<?php


wp_footer();
//get_footer();

?>

<script>var telerTrackerWidgetId="2583c3d0-35b9-44ba-9f0e-6811232d9cac"; var telerTrackerDomain="itea.phonet.com.ua";</script>
<script src="//itea.phonet.com.ua/public/widget/call-tracker/lib.js"></script>
</body>
</html>
