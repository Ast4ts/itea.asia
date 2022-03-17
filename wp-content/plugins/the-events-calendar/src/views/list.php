<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );
?>

	<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

	<!-- Main Events Content -->
<?php tribe_get_template_part( 'list/content' ); ?>

	<div class="tribe-clear"></div>

    <?php $lang = (get_locale() == 'ru_RU'); ?>
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
        $('#subBlock form').on('submit', function(e) {
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

<?php
do_action( 'tribe_events_after_template' );
