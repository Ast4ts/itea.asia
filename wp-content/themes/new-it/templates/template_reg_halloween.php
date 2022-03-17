<?php /* Template Name: Регистрация на "Halloween" */
$lang = (get_locale() == 'ru_RU');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title><?php wp_title(); ?></title>

    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reg-halloween.css">
</head>
<body>

<header class="centred">
    <a class="img-responsive apply-form-link" href="<?php echo get_home_url(); ?>">
        <img src="<?php bloginfo('template_directory'); ?>/images/reg_consultation/white-logo.png" alt="itea">
    </a>
</header>

<div id="loading"><div id="loading-animation"></div></div>

<section id="main-form" class="centred">
    <form method="post" class="user-data-form" action="<?php echo esc_url(add_query_arg('action', 'regForHalloween', admin_url('admin-post.php'))); ?>">
        <input type="hidden" name="verification" value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">

        <h1><?php echo get_the_title(); ?></h1>
		      <p class="underform-paragraph">Оставьте свои данные, выберите направление обучения получите шанс выиграть ценные призы</p>
        <input type="text" name="name" value="" placeholder="Имя" autocomplete="off">

				    <input type="email" name="mail" value="" placeholder="Email">

        <input type="phone" name="phone" id="userPhone" value="" placeholder="Телефон">

        <input id="free-select" name="user_selected_profession_IT" />

		      <div class="course-select">
				      <div class="header-select">
						      <h2>Какое направление Вас интересует?</h2>
				      </div>
				      <div class="flex-blocks">
						      <ul class="list">
								      <li>Java programming</li>
								      <li>QA</li>
								      <li>C++ programming</li>
								      <li>PHP programming</li>
								      <li>C# programming</li>
						      </ul>
						      <ul>
								      <li>Frontend development</li>
								      <li>IOS development</li>
								      <li>Android development</li>
								      <li>DEVOPS</li>
								      <li>IT recruiting</li>
						      </ul>
						      <ul>
								      <li>UI/UX design</li>
								      <li>Курсы для детей</li>
								      <li>Project Management</li>
								      <li>Business Analisys</li>
								      <li>AGILE/SCRUM</li>
						      </ul>
				      </div>
		      </div>

        <input type="submit" name="submit" value="Отправить заявку">

		    <span class="form-validation">поле обязательное для заполнения</span>
    </form>
</section>

<footer>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/masked-input.min.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/halloween-scripts.js"></script>
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