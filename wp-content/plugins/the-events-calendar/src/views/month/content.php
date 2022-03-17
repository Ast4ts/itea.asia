<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 */

$lang = (get_locale() == 'ru_RU');

if($lang) {
    $all_months = array('00'=>'', '01'=>'Январь', '02'=>'Февраль', '03'=>'Март', '04'=>'Апрель', '05'=>'Май', '06'=>'Июнь', '07'=>'Июль', '08'=>'Август', '09'=>'Сентябрь', '10'=>'Октябрь', '11'=>'Ноябрь', '12'=>'Декабрь');
} else {
    $all_months = array('00'=>'', '01'=>'Січень', '02'=>'Лютий', '03'=>'Березень', '04'=>'Квітень', '05'=>'Травень', '06'=>'Червень', '07'=>'Липень', '08'=>'Серпень', '09'=>'Вересень', '10'=>'Жовтень', '11'=>'Листопад', '12'=>'Грудень');
}

$getEventDate = explode('-',tribe_get_month_view_date());

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-month">

	<!-- Month Title -->
	<?php //do_action( 'tribe_events_before_the_title' ) ?>
    <p style="padding-bottom:4px;">
    <a href="<?php echo get_home_url(), ($lang ? '' : '/uk'); ?>/events/list/" class="linkCourseToT"><?php echo ($lang ? 'Список мероприятий' : 'Список подій'); ?></a>
    </p>
    <h2 class="tribe-events-page-title"><?php echo ($lang ? 'Мероприятия | ' : 'Події | '), $all_months[$getEventDate[1]], ' ',  $getEventDate[0]; ?></h2>
	<?php //do_action( 'tribe_events_after_the_title' ) ?>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php tribe_get_template_part( 'month/nav' ); ?>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ) ?>

	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>

	<!-- Month Footer -->
	<?php do_action( 'tribe_events_before_footer' ) ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php //do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php //tribe_get_template_part( 'month/nav' ); ?>
		<?php //do_action( 'tribe_events_after_footer_nav' ); ?>

	</div>
	<!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>

	<?php tribe_get_template_part( 'month/mobile' ); ?>
	<?php //tribe_get_template_part( 'month/tooltip' ); ?>

</div><!-- #tribe-events-content -->
