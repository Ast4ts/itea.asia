<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

$lang = (get_locale() == 'ru_RU');
?>

<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" class="linkCourseToT"> <?php echo '&laquo; ', ($lang ? 'Все Мероприятия' : 'Всі Заходи'); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>
    <?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>

<!--	<div class="tribe-events-schedule tribe-clearfix">-->
<!--		--><?php //echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
<!--		--><?php //if ( tribe_get_cost() ) : ?>
<!--			<span class="tribe-events-cost">--><?php //echo tribe_get_cost( null, true ) ?><!--</span>-->
<!--		--><?php //endif; ?>
<!--	</div>-->

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

            <?php echo '<div class="evDetails">'; ?>
                <?php echo '<div class="date">'     . tribe_get_start_date( get_the_id(), true, 'd.m.Y / G:i') . '</div>'; ?>
                <?php echo '<div class="location">' . tribe_get_address( get_the_id() ) . '</div>'; ?>
                <?php echo '<div class="cost">'     . tribe_get_formatted_cost( get_the_id() ) . '</div>'; ?>
                <?php echo '<a href="'              . tribe_get_event_website_url( get_the_id() ) . '" target="_blank">' .($lang ? 'Купить билет' : 'Купити квиток'). ' &rarr;</a>'; ?>
            <?php echo '</div>'; ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
<!--			--><?php //do_action( 'tribe_events_single_event_before_the_meta' ) ?>
<!--			--><?php //tribe_get_template_part( 'modules/meta' ); ?>
<!--			--><?php //do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer -->
    <div id="subBlock">

        <div class="subForm">
            <h3><?php echo ($lang ? 'Подпишись на рассылку' : 'Підпишись на розсилку'); ?> ITEA</h3>
            <?php if($lang){ ?>
                <p>Узнавай о свежих <b>акциях и скидках</b>, вакансиях компании, предстоящих мероприятиях и многом другом</p>
            <?php } else { ?>
                <p>Дізнавайся про нові <b>акції та знижки</b>, вакансії компанії, події та багато іншого.</p>
            <?php } ?>
            <form>
                <input type="email" name="mailSub" required placeholder="<?php echo ($lang ? 'Введите ваш' : 'Введіть ваш'); ?> email">
                <button><img src="<?php bloginfo('template_directory'); ?>/relize/img/icons/grnMail.png"> <?php echo ($lang ? 'Подписаться' : 'Підписатись'); ?> </button>
            </form>
        </div>

        <div class="subLinks">
            <a href="https://www.facebook.com/ITEAUA/" class="fbL" target="_blank">
                <span class="rotate">Facebook</span>
            </a>
            <a href="https://twitter.com/ITEAua" class="twL" target="_blank">
                <span class="rotate">Twiter</span>
            </a>
            <a href="https://www.linkedin.com/company/iteaua/" class="inL" target="_blank">
                <span class="rotate">Linkedin</span>
            </a>
            <a href="https://www.youtube.com/channel/UCVB7J1qH_NgGr_B-LgEvElA" class="ytL" target="_blank">
                <span class="rotate">YouTube</span>
            </a>
            <a href="https://plus.google.com/+IteducateUa" class="gpL" target="_blank">
                <span class="rotate">Google+</span>
            </a>
        </div>

    </div>

    <script type="text/javascript">
        $('#subBlock form').on('submit',function(e) {
            $.ajax({
                type: 'POST',
                url: "https://itea.ua/wp-content/plugins/the-events-calendar/src/views/subscribe.php",
                data: $(this).serialize(),
                success: function (argument) {
                    $('#subBlock .subForm').html("<h3><?php echo ($lang ? 'Спасибо за подписку' : 'Дякую за підписку'); ?></h3>");
                }
            });
            e.preventDefault();
            return false;
        });
    </script>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
