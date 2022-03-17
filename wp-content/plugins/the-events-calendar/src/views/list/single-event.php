<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

$lang = (get_locale() == 'ru_RU');

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<!-- Event Image -->
<div>
    <?php echo tribe_event_featured_image( null, 'full' ) ?>
</div>

<!-- Event Title -->
<div>
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
    <h2 class="tribe-events-list-event-title entry-title summary">
        <a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
            <?php the_title() ?>
        </a>
    </h2>
    <?php do_action( 'tribe_events_after_the_event_title' ) ?>

    <!-- Event Content -->
    <?php do_action( 'tribe_events_before_the_content' ) ?>
    <div class="tribe-events-list-event-description tribe-events-content description entry-summary">
        <?php $string = get_the_excerpt();
        $string = substr($string, 0, 450);
        $string = rtrim($string, "!,.-");
        $string = substr($string, 0, strrpos($string, ' '));
        echo $string . "… ";
        ?>
    </div>
    <!-- .tribe-events-list-event-description -->

    <?php
    do_action( 'tribe_events_after_the_content' );
    ?>
</div>

<!-- Event Meta -->
<div>
    <?php do_action( 'tribe_events_before_the_meta' ) ?>
    <?php echo '<div class="evDetails">'; ?>

    <?php echo '<div class="date">' . tribe_get_start_date( get_the_id(), true, 'd.m.Y / G:i') . '</div>'; ?>
    <?php echo '<div class="location">' . tribe_get_address( get_the_id() ) . '</div>'; ?>
    <?php echo '<div class="cost">' . tribe_get_formatted_cost( get_the_id() ) . '</div>'; ?>

    <?php echo '</div>'; ?>

    <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php echo ($lang ? 'Узнать больше' : 'Дізнайтеся більше'); ?> &raquo;</a>
</div>
