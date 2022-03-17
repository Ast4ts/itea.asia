<?php
get_header();

global $post;
define('ITEA_PROD', (bool)($_SERVER['HTTP_HOST'] == 'itea.ua' || $_SERVER['SERVER_NAME'] == 'itea.ua'));
$lang = (get_locale() == 'ru_RU');
$Uuid_right_band = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
$Uuid_left_band = 'a21a5029-91b4-4971-bb24-29fbaeaa695c';
$Uuid_vdnh_band = '96523086-8ac6-49a3-be3e-0556af682452';
$Uuid_online_band = "e7f33e0e-9605-4f0b-8ed3-7de8cde053b7";
if (ITEA_PROD) {
    $Uuid_right_band = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
    $Uuid_left_band = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0';
    $Uuid_vdnh_band = 'd6272609-b556-4d4d-8cf4-6d72b4517181';
    $Uuid_online_band = "e7f33e0e-9605-4f0b-8ed3-7de8cde053b7";
}
$course_during = get_post_meta(pll_get_post($post->ID, 'ru'), 'long', true);
$ID = pll_get_post($id, 'ru');

?>

<!--<section class="broadcrumbs">-->
<!--    <nav class="container">-->
<!--        --><?php
//        if (function_exists('dimox_breadcrumbs')) {
//            dimox_breadcrumbs();
//        }
//        ?>
<!--    </nav>-->
<!--</section>-->
<?php
$all_dates = [];
$all_dates_right = array();
$all_dates_left = array();
$all_dates_vdnh = array();
$result = $wpdb->get_results("
                  SELECT * 
                  FROM  $wpdb->postmeta
                      WHERE post_id = $ID AND meta_filiation == ''
              ");
foreach ($result as $k => $item) {
    if (strtotime(date("d.m.y")) < strtotime($item->meta_value)) {
        $all_dates[] = $item->meta_value;
    }
}
$result = $wpdb->get_results("
                  SELECT * 
                  FROM  $wpdb->postmeta
                      WHERE post_id = $ID AND meta_filiation != ''
              ");

foreach ($result as $k => $item) {
    if ($item->meta_filiation === $Uuid_left_band && ($item->meta_key == 'date1' || $item->meta_key == 'date2' || $item->meta_key == 'date3' || $item->meta_key == 'date4' || $item->meta_key == 'date5' || $item->meta_key == 'date6')) {
        if (strtotime(date("d.m.y")) < strtotime($item->meta_value)) {
            $all_dates_left[] = $item->meta_value;
            $all_dates[] = $item->meta_value;
        }
    }
    if ($item->meta_filiation === $Uuid_right_band && ($item->meta_key == 'date1' || $item->meta_key == 'date2' || $item->meta_key == 'date3' || $item->meta_key == 'date4' || $item->meta_key == 'date5' || $item->meta_key == 'date6')) {
        if (strtotime(date("d.m.y")) < strtotime($item->meta_value)) {
            $all_dates_right[] = $item->meta_value;
            $all_dates[] = $item->meta_value;
        }
    }
    if ($item->meta_filiation === $Uuid_vdnh_band && ($item->meta_key == 'date1' || $item->meta_key == 'date2' || $item->meta_key == 'date3' || $item->meta_key == 'date4' || $item->meta_key == 'date5' || $item->meta_key == 'date6')) {
        if (strtotime(date("d.m.y")) < strtotime($item->meta_value)) {
            $all_dates_vdnh[] = $item->meta_value;
            $all_dates[] = $item->meta_value;
        }
    }
}
//  var_dump($all_dates_right, $ID);

$tildaOn = get_post_meta(pll_get_post($post->ID), '_tilda', true);


//говно
$price = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
$priceOnline = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost_online', true);
$dis = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont', true);
$disOnline = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-online', true);
$dis_left = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-left', true);
$dis_vdbh = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-vdnh', true);
$isMonth = get_post_meta(pll_get_post($post->ID, 'ru'), 'ismonth', true);
$weeks = get_post_meta(pll_get_post($post->ID, 'ru'), 'weeks', true);

if (!empty($dis) || !empty($dis_left) || !empty($dis_vdbh)) {
    $oldPrice = $price;
    $price = nicePrice(ceil($price * (100 - $dis) / 100));
    $oldPartsPrice = nicePrice(ceil($oldPrice / $weeks * 1.15));
    $partsPrice = nicePrice(ceil($price / $weeks * 1.15));
    $partsPriceLeft = nicePrice(ceil($price / $weeks * 1.15));
} else {
    $partsPrice = nicePrice(floor($price / $weeks * 1.15));
}
//end govna


if (!empty($tildaOn) && (pll_get_post($id, pll_current_language()) === $post->ID) && $tildaOn['status'] !== 'off'):?>
    <?php require_once('categ_22_&_219__singles_tilda.php'); ?>
<?php elseif (get_post_meta($post->ID, 'new_template', true)): ?>
    <?php require_once('categ_22_&_219__singles_new.php'); ?>
<?php else: ?>
    <?php require_once('categ_22_&_219__singles_old.php'); ?>
<?php endif; ?>

<!--schema.org-->
<?php
$schema_description = str_replace('&nbsp;', ' ', get_post_meta($post->ID, 'Описание', true));
$schema_description = str_replace('\n', '', $schema_description);
$schema_description = str_replace('\r', '', $schema_description);
$schema_description = str_replace('\t', '', $schema_description);

$temp_schema_date = explode('.', $nearest_date);
$schema_date = $temp_schema_date[2] . '-' . $temp_schema_date[1] . '-' . $temp_schema_date[0];

$getEdAl = array();
$isEduAl = preg_match_all('|<li(.+)?>(.+)</li>|isU', get_post_meta($post->ID, 'После курса', true), $getEdAl);

function clearTags($var)
{
    $item = strip_tags($var);

    return '{"@type": "AlignmentObject","alignmentType": "teaches","targetDescription": "' . $item . '"}';
}

$getEdAl = array_map('clearTags', $getEdAl[count($getEdAl) - 1]);
//print_r($getEdAl);
//var_dump(get_post_meta($post->ID, 'После курса', true));
?>

<script>
  var hash = window.location.hash
  if (hash === '#location2') {
    $('.course-location input').removeAttr('checked')
    $('#location2').click()
    $('#location2').prop('checked', true)
  }
  if (hash === '#location3') {
    $('.course-location input').removeAttr('checked')
    $('#location3').click()
    $('#location3').prop('checked', true)
  }
</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Course",
  "name": "<?php the_title(); ?>",
  "description": "<?php echo strip_tags($schema_description); ?>",
  "provider": {
    "@type": "Organization",
    "name": "ITEA - Education academy",
    "sameAs": "http://itea.ua"
  },
  <?php if ($nearest_date = array_shift($date_for_schema)): ?>
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "evening-time",
    "name": "<?php the_title(); ?>",
    "startDate": "<?php echo $schema_date; ?>",
    "duration": "P<?php echo $minimized ? (get_post_meta(pll_get_post($post->ID, 'ru'), 'long', true)) . 'M' : 'T' . (get_post_meta(pll_get_post($post->ID, 'ru'), 'long', true)) . 'H' ?>",
    "location": {
      "@type" : "Place",
      "name" : "ITEA-Kiev",
      "address" : "<?php echo($lang ? 'ул. Смоленская, 31-33, корп. 3, 03005, Киев, Украина' : 'вул. Смоленська, 31-33, корп. 3, 03005, Київ, Україна'); ?>"
    },
    "offers": {
      "@type": "Offer",
      "name": "<?php echo($lang ? 'Запись на курс' : 'Запис на курс'); ?>. <?php echo($lang ? 'Единоразовая оплата' : 'Одноразова оплата'); ?>",
      "price": "<?php echo $price; ?>",
      "priceCurrency": "UAH"
    }
  },
  <?php endif; ?>
  <?php if (count($getEdAl) > 0): ?>
  "educationalAlignment": [
    <?php echo implode(',', $getEdAl); ?>
  ]
  <?php endif; ?>
}

</script>

<?php get_footer(); ?>
