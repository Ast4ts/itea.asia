<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

$lang = (get_locale() == 'ru_RU');

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

?>

<div>
    <?php echo tribe_event_featured_image( null, 'full' ) ?>
</div>


<!-- Event Title -->
<div>
    <h2 class="tribe-events-list-event-title entry-title summary">
        <a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
            <?php the_title() ?>
        </a>
    </h2>

    <!-- Event Content -->
    <div class="tribe-events-list-event-description tribe-events-content description entry-summary">
        <?php $string = get_the_excerpt();
        $string = substr($string, 0, 470);
        $string = rtrim($string, "!,.-");
        $string = substr($string, 0, strrpos($string, ' '));
        echo $string."… ";
        ?>
    </div>
    <!-- .tribe-events-list-event-description -->
</div>

<div>
    <?php do_action( 'tribe_events_before_the_meta' ) ?>
    <?php echo '<div class="evDetails">'; ?>

    <?php echo '<div class="date">' . tribe_get_start_date( get_the_id(), true, 'd.m.Y / G:i') . '</div>'; ?>
    <?php echo '<div class="location">' . tribe_get_address( get_the_id() ) . '</div>'; ?>
    <?php echo '<div class="cost">' . tribe_get_formatted_cost( get_the_id() ) . '</div>'; ?>

    <?php echo '</div>'; ?>

    <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php echo ($lang ? 'Узнать больше' : 'Дізнайтеся більше'); ?> &raquo;</a>
</div>
