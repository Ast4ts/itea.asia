<?php /* Template Name: Страница "Спасибо за заявку2" */ ?>

<?php
hideLangSwitchAndSetCorrectLang();
get_header();
$lang = (get_locale() == 'ru_RU');
?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/relize/css/thanks_page.css" />

<div class="container regDiv">
<div class="thanks-block" style="background-image:url(<?php bloginfo('template_directory'); ?>/images/registration_evening/thanks<?php echo ($lang ? '.png' : '_ua.png'); ?>); ">
<h1 style='left:5%;'><?php echo ($lang ? 'Мы получили твою заявку на запись урока!' : 'Ми отримали твою заявку на запис уроку!'); ?>
    <span class="heading"><?php echo ($lang ? 'проверяй свой емейл - там будет ссылка на запись. <br> обязательно проверь спам, если не найдешь наше письмо в общей папке' : 'перевіряй свій емейл - там буде посилання на запис. <br> обов\'язково перевір спам, якщо не знайдеш наш лист в загальнодоступному місці'); ?></span>
</h1>
<div class="button-block">
    <a class="first-btn" href="#" onclick="history.go(-2);return false;"><?php echo ($lang ? 'Вернуться к содержанию курса' : 'Повернутися до змісту курсу'); ?></a>
    <a class="second-btn" href="<?php echo get_permalink( ($lang ? 17 : 7863) ); ?>"><?php echo ($lang ? 'Перейти к расписанию' : 'Перейти до розкладу'); ?></a>
</div>
</div>
</div>

<?php get_footer(); ?>