<?php /* Template Name: Страница "Спасибо за заявку" */ ?>

<?php
hideLangSwitchAndSetCorrectLang();
get_header();
$lang = (get_locale() == 'ru_RU');
?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/thanks_page.css" />

<div class="container regDiv">
<div class="thanks-block" style="background-image:url(<?php bloginfo('template_directory'); ?>/images/registration_evening/thanks<?php echo ($lang ? '.png' : '_ua.png'); ?>);">
<h1><?php echo ($lang ? 'Ваша заявка принята.' : 'Ваша заявка прийнята.'); ?>
    <span class="heading"><?php echo ($lang ? 'Наш менеджер свяжется с вами в ближайшее время!' : 'Наш менеджер зв\'яжеться з Вами найближчим часом!'); ?></span>
</h1>

<div class="button-block">
    <a class="first-btn" href="#" onclick="history.go(-2);return false;"><?php echo ($lang ? 'Вернуться к содержанию курса' : 'Повернутися до змісту курсу'); ?></a>
    <a class="second-btn" href="<?php echo get_permalink( ($lang ? 17 : 7863) ); ?>"><?php echo ($lang ? 'Перейти к расписанию' : 'Перейти до розкладу'); ?></a>
</div>
</div>
</div>

<?php get_footer(); ?>