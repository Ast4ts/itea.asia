<?php /* Template Name: Спасибо, присоединяйтесь в fb */
$lang = (get_locale() == 'ru_RU');
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
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-68457841-1');
    </script>


    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function()

      {n.callMethod?   n.callMethod.apply(n,arguments):n.queue.push(arguments)}
      ;
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '474899822710267');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=474899822710267&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
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
		 			<p><?php echo get_the_title(); ?></p>
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

                  <div class="fb-two-btns">
                    <a href="https://www.facebook.com/ITEAUA/" target="_blank" class="b-thank-you-fb-link">
                      <span>Follow ITEA Kiev</span>
                    </a>

                    <?php if (!$lang) { ?>
                        <a href="https://www.facebook.com/ITEA.lviv/" target="_blank" class="b-thank-you-fb-link">
                            <span>Follow ITEA Lviv</span>
                        </a>
                    <?php } ?>

                  </div>

                </div>
                <div class="b-thank-you-home">
                    <a href="<?php echo get_home_url(); ?>">
                        <?php echo $lang ? 'На главную' : 'На головну'; ?>
                    </a>
                </div>
            </div>
        </div>
     </main>
</body>
</html>