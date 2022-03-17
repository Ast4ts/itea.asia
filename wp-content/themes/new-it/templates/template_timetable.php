<?php /* Template Name: Расписание вечерних курсов */
global $wpdb;
$lang = (get_locale() == 'ru_RU');

get_header();
?>

<div class="head-section head-section__schedule">
    <div class="container">
        <div class="head-section__left">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
        <div class="head-section__right">
            <div class="head-section__right-item">
                <span class="start-courses">&#8211; <?php echo($lang ? 'дата старта может меняться' : 'дата старту може змінюватися'); ?></span>
                <span class="garant-courses">&#8211; <?php echo($lang ? 'старт курса гарантирован' : 'старт курсу гарантований'); ?></span>
                <span class="soon-courses">&#8211; <?php echo($lang ? 'для старта не хватает 2-3 человека' : 'для старту не вистачає 2-3 людини'); ?></span>
            </div>
        </div>
    </div>
</div>

<?php
$year = (int)date('y');
$month = (int)date('m');
$day = (int)date('d');
if ($lang) {
	$all_months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
} else {
	$all_months = array('Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
}
$m1 = $all_months[$month - 1];
$m2 = ($month > 11) ? $all_months[$month - 12] : $all_months[$month];
$m3 = ($month + 1 > 11) ? $all_months[$month - 11] : $all_months[$month + 1];
$m4 = ($month + 2 > 11) ? $all_months[$month - 10] : $all_months[$month + 2];

$bands = [
//	'soon' => [
//		'title' => $lang ? 'Ближайшие даты' : 'Найближчі дати'
//	],
	'beresteyka' => [
//		'title' => $lang ? 'Берестейская' : 'Берестейська',
		'title' => $lang ? 'Ближайшие даты' : 'Найближчі дати',
		'meta_filiation' => '1dbf8164-52df-41f4-bbbc-48b6fe762a57'
	],
//	'poznyaki' => [
//		'title' => $lang ? 'Позняки' : 'Позняки',
//		'meta_filiation' => 'ed944588-9ae7-45e2-8a2e-4482ee973cb0',
//		'discount' => ''
//	],
//	'vdnh' => [
//		'title' => $lang ? 'ВДНХ' : 'ВДНГ',
//		'meta_filiation' => 'd6272609-b556-4d4d-8cf4-6d72b4517181',
//		'discount' => ''
//	]
];

$word1 = ($lang ? 'Длительность' : 'Тривалість');
$word2 = ($lang ? 'Стоимость курса (без НДС)' : 'Вартість курсу (без ПДВ)');
$word3 = ($lang ? 'Ближайшие даты' : 'Найближчі дати');

$categories = getListRoadmaps();
?>
<style>
    .b-schedule-courses-table {
        display: none;
    }

    .b-schedule-courses-table.b-schedule-courses--active {
        display: block;
    }

    .schedule-nav {
        display: flex;
    }

    .schedule-nav a {
        display: block;
        max-width: 300px;
        width: 100%;
        padding: 28px 0px;
        color: #0f3147;
        font-size: 20px;
        text-align: center;
        text-decoration: none;
        font-weight: 400;
        box-shadow: 5px -5px 20px rgba(177, 177, 177, 0.1);
        background-color: #ffffff;
    }
    .schedule-nav a + a{
        border-left: 1px solid #d4d4d4
    }

    .schedule-nav a:hover,
    .schedule-nav a:focus {
        text-decoration: none;
        color: #133a54;
    }

    .schedule-nav a.schedule-nav--active {
        background-color: #f3f3f5;
        border-top: 2px solid #e6194b;
        color: #133a54;
        font-weight: 700;
        box-shadow: none;
    }

    .schedule-nav a div {
        position: relative;
        display: inline-block;
    }

    .b-inforow .b-inforow-heading .p0 {
        padding: 0;
    }

    #soon .b-inforow-courses__hide{
        /*display: none;*/
    }

    #soon .b-inforow-courses-discounts-icon {
        width: 100%;
        background-size: contain;
        top: -11px;
        height: 74%;
    }

    #soon .b-inforow-courses-discounts-icon .b-inforow-courses-discounts {
        font-size: 12px !important;
    }

    #soon ul.b-inforow {
        overflow: initial;
    }

    #soon ul.b-inforow .b-inforow-heading {
        position: sticky;
        top: 56px;
        z-index: 1;
    }

    #soon .filials {
        position: relative;
    }

    #soon .filials:after, #soon .filials:before {
        content: '';
        position: absolute;
        height: 100%;
        width: 1px;
        background-color: #ECEFF1;
        top: 0;
    }

    #soon .filials:after {
        left: 50%;
    }

    #soon .filials:before {
        right: 50%;
    }

    #soon .filials > div {
        padding: 0;
        border: 0;
    }

    #soon .filials .otstup {
        padding-top: 10px;
    }

    @media (max-width: 1200px) {
        .schedule-nav a {
            max-width: 160px;
            padding: 15px 0px;
            color: #0f3147;
            font-size: 12px;
        }
    }

    @media (max-width: 767px) {
        .schedule-nav a {
            font-size: 12px;
            padding: 9px 0px;
        }

        .schedule-nav a.schedule-nav--active {
            border-top: 1px solid #e6194b;
        }

        .location-item__discount {
            font-size: 10px;
        }

        #soon .filials .otstup {
            padding-top: 0px;
        }

        #soon .filials:after, #soon .filials:before {
            display: none;
        }

        #soon .filials > div {
            background-color: #fff;
            border-bottom: 1px solid #ECEFF1;
        }

        #soon .b-inforow-courses-discounts-icon {
            width: 50%;
            height: 50%;
            top: 0;
        }

        #soon .b-inforow-courses-discounts-icon .b-inforow-courses-discounts {
            font-size: 10px !important;
        }
    }

    @media (max-width: 560px){
        .schedule-nav a {
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .location-item__discount{

        }
    }

</style>
<div class="container" id="flip-scroll">
    <div class="schedule-nav">
	    <?php foreach ($bands as $key => $band): ?>
<!--        <a href="#--><?//=$key;?><!--" class="schedule-nav__--><?//=$key;?><!----><?//=($key === 'soon' ? ' schedule-nav--active' : '');?><!--" target="_self">-->
        <a href="#<?=$key;?>" class="schedule-nav__<?=$key;?><?=($key === 'beresteyka' ? ' schedule-nav--active' : '');?>" target="_self">
            <?php if ($band['discount']): ?>
            <div><?=$band['title'];?><span class="location-item__discount"><?=$band['discount'];?></span></div>
            <?php else: ?>
            <?=$band['title'];?>
            <?php endif; ?>
        </a>
		<?php endforeach; ?>
    </div>
    <div class="col-md-12 b-schedule-courses-table" id="soon">
        <ul class="b-inforow">
            <li class="b-inforow-heading">
                <div class="col-sm-4">
                    <p class="b-inforow-heading-item b-inforow-heading-first-item">
                        <span><?=($lang ? 'Название курса' : 'Назва курсу');?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?=$word1;?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?=$word2;?></span>
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-12 p0">
                        <p class="b-inforow-heading-item" style="padding-bottom: 10px;">
                            <span><?=$word3;?></span>
                        </p>
                    </div>
                    <div class="col-sm-12 p0">
                        <div class="col-sm-6 p0">
                            <p class="b-inforow-heading-item">
                                <span><?=$bands['beresteyka']['title'];?></span>
                            </p>
                        </div>
                        <div class="col-sm-6 p0">
                            <p class="b-inforow-heading-item">
                                <span><?=$bands['poznyaki']['title'];?></span>
                            </p>
                        </div>
<!--                        <div class="col-sm-4 p0">-->
<!--                            <p class="b-inforow-heading-item">-->
<!--                                <span>--><?//=$bands['vdnh']['title'];?><!--</span>-->
<!--                            </p>-->
<!--                        </div>-->
                    </div>
                </div>
            </li>
			<?php
			foreach ($categories as $category) {
				$cat_data_ru = get_option('category_' . pll_get_term($category->cat_ID, 'ru'));
				if (!is_array($cat_data_ru)) {
					$cat_data_ru = array();
				}
				$minimized = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
				$word3 = $minimized ? ($lang ? ' мес.' : ' міс.') : ($lang ? ' ч.' : ' год.');
				echo '<li class="b-inforow-title"><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';
				$courses = get_posts(array('category' => $category->cat_ID, 'numberposts' => -1));
				$courses = array_reverse($courses);
				foreach ($courses as $course) {
					$course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost_online', true);
                    if ($course_price == 0){
                        $course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost', true);
                    }
                    
					$discounts = array();
					$discounts['beresteyka'] = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont', true);
					$discounts['poznyaki'] = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont-left', true);
//					$discounts['vdnh'] = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont-vdnh', true);
					$price_val = (int)$course_price;
					$all_dates = array();
					$dates_bg_color = array();
					$id = pll_get_post($course->ID, 'ru');
					$sql = "
                        SELECT `meta_key`, `meta_value`, `meta_filiation`
                        FROM  $wpdb->postmeta 
                        WHERE post_id = $id 
                        AND (meta_key = 'date1' 
                        OR meta_key = 'date2'
                        OR meta_key = 'date3'
                        OR meta_key = 'date4'
                        OR meta_key = 'date5'
                        OR meta_key = 'date6'
                        OR meta_key = 'date1-bg-color'
                        OR meta_key = 'date2-bg-color'
                        OR meta_key = 'date3-bg-color'
                        OR meta_key = 'date4-bg-color'
                        OR meta_key = 'date5-bg-color'
                        OR meta_key = 'date6-bg-color')";
					$result = $wpdb->get_results($sql);
					foreach ($result as $k => $item) {
						switch ($item->meta_filiation) {
							case $bands['beresteyka']['meta_filiation']:
								if (strpos($item->meta_key, 'date') !== false) {
									if (strpos($item->meta_key, 'bg-color') !== false) {
										$d = explode('-', $item->meta_key);
										$dates_bg_color['beresteyka'][$d[0]] = $item->meta_value;
									} else {
										$all_dates['beresteyka'][$item->meta_key] = $item->meta_value;
									}
								}
							break;
							case $bands['poznyaki']['meta_filiation']:
								if (strpos($item->meta_key, 'date') !== false) {
									if (strpos($item->meta_key, 'bg-color') !== false) {
										$d = explode('-', $item->meta_key);
										$dates_bg_color['poznyaki'][$d[0]] = $item->meta_value;
									} else {
										$all_dates['poznyaki'][$item->meta_key] = $item->meta_value;
									}
								}
							break;
//							case $bands['vdnh']['meta_filiation']:
//								if (strpos($item->meta_key, 'date') !== false) {
//									if (strpos($item->meta_key, 'bg-color') !== false) {
//										$d = explode('-', $item->meta_key);
//										$dates_bg_color['vdnh'][$d[0]] = $item->meta_value;
//									} else {
//										$all_dates['vdnh'][$item->meta_key] = $item->meta_value;
//									}
//								}
//							break;
						}
					}
					$dates = array();
					$hide_course = true;
					foreach ($all_dates as $key_f => $filial) {
						foreach ($all_dates[$key_f] as $key_d => $date) {
							if (time() > strtotime($date . ' 19:00')) {
								continue;
							}
							$mo_m = explode('.', $date);
							if ((int)substr($mo_m[2], -2) >= $year) {
							    if ($mo_m[1] > $month || ($mo_m[1] == $month && $mo_m[0] + 5 > $day)
                                    || (($mo_m[1] == 01 || $mo_m[1] == 02) && $month == 12)  ) {//fix 12 month and 1
							        if ($dates[$key_f]) {
									    $mo_m2 = explode('.', $dates[$key_f]);
									    if ($mo_m2[1] > $mo_m[1]) {
											$dates[$key_f] = (empty($dates_bg_color[$key_f][$key_d]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$key_f][$key_d] . ';">') . $date . '</span>';
                                        } else {
										    continue;
                                        }
                                    } else {
                                        $dates[$key_f] = (empty($dates_bg_color[$key_f][$key_d]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$key_f][$key_d] . ';">') . $date . '</span>';
                                    }
									$hide_course = false;
								}
							}
						}
					}
				?>
                <li class="b-inforow-courses<?=$hide_course ? ' b-inforow-courses__hide' : ''?>">
                    <div class="col-sm-4">
                        <p class="b-inforow-courses-item b-inforow-courses-first-item">
                        <span>
                            <a href="<?php echo get_permalink($course->ID); ?>"><?php echo $course->post_title; ?></a>
                        </span>
                        </p>
                    </div>

                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item ">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word1; ?></span>
                            <span><?php echo get_post_meta(pll_get_post($course->ID, 'ru'), 'long', true), $word3; ?></span>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word2; ?></span>
													<?= "<span>$course_price</span>"; ?>
                        </p>
                    </div>
                    <div class="col-sm-4 filials">
                        <?php
                        $ot1 = $discounts['beresteyka'] && $dates['beresteyka'];
                        $ot2 = $discounts['poznyaki'] && $dates['poznyaki'];
//                        $ot3 = $discounts['vdnh'] && $dates['vdnh'];
                        $otstup = $ot1 || $ot2 //|| $ot3;
                        ?>
                        <div class="col-sm-6<?= $otstup ? ' otstup' : ''; ?>">
                            <p class="b-inforow-courses-item">
                                <span class="b-inforow-courses-item-characteristics"><?= $bands['beresteyka']['title']; ?></span>
                                <span class="b-inforow-courses-date-item<?php echo($discounts['beresteyka'] ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                                    <?= $dates['beresteyka']; ?>
                                </span>
								<?php if ($discounts['beresteyka'] && $dates['beresteyka']) { ?>
                                <span class="b-inforow-courses-discounts-icon">
                                    <span class="b-inforow-courses-discounts">-<?= $discounts['beresteyka']; ?> %</span>
                                </span>
								<?php } ?>
                            </p>
                        </div>
                        <div class="col-sm-6<?= $otstup ? ' otstup' : ''; ?>">
                            <p class="b-inforow-courses-item">
                                <span class="b-inforow-courses-item-characteristics"><?= $bands['poznyaki']['title']; ?></span>
                                <span class="b-inforow-courses-date-item<?php echo($discounts['poznyaki'] ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                                <?php echo $dates['poznyaki']; ?>
                                </span>
								<?php if ($discounts['poznyaki'] && $dates['poznyaki']) { ?>
                                <span class="b-inforow-courses-discounts-icon">
                                    <span class="b-inforow-courses-discounts">-<?= $discounts['poznyaki']; ?> %</span>
                                </span>
								<?php } ?>
                            </p>
                        </div>
<!--                        <div class="col-sm-4--><?//= $otstup ? ' otstup' : ''; ?><!--">-->
<!--                            <p class="b-inforow-courses-item">-->
<!--                                <span class="b-inforow-courses-item-characteristics">--><?//= $bands['vdnh']['title']; ?><!--</span>-->
<!--                                <span class="b-inforow-courses-date-item--><?php //echo($discounts['vdnh'] ? ' b-inforow-courses-date-item-discounts' : ''); ?><!--">--><?//= $dates['vdnh']; ?><!--</span>-->
<!--								--><?php //if ($discounts['vdnh'] && $dates['vdnh']) { ?>
<!--                                <span class="b-inforow-courses-discounts-icon">-->
<!--                                    <span class="b-inforow-courses-discounts">---><?//= $discounts['vdnh']; ?><!-- %</span>-->
<!--                                </span>-->
<!--								--><?php //} ?>
<!--                            </p>-->
<!--                        </div>-->
                    </div>
                </li>
				<?php }
			} ?>
        </ul>
    </div>
    <div class="col-md-12 b-schedule-courses-table b-schedule-courses--active" id="beresteyka">
        <ul class="b-inforow">
            <li class="b-inforow-heading">
                <div class="col-sm-4">
                    <p class="b-inforow-heading-item b-inforow-heading-first-item">
                        <span><?php echo($lang ? 'Название курса' : 'Назва курсу'); ?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $word1; ?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $word2; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m1; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m2; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m3; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m4; ?></span>
                    </p>
                </div>
            </li>

					<?php
					foreach ($categories as $category) {
						$cat_data_ru = get_option('category_' . pll_get_term($category->cat_ID, 'ru'));
						if (!is_array($cat_data_ru)) {
							$cat_data_ru = array();
						}
						$minimized = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
						$word3 = $minimized ? ($lang ? ' мес.' : ' міс.') : ($lang ? ' ч.' : ' год.');
						echo '<li class="b-inforow-title"><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';

						$courses = get_posts(array('category' => $category->cat_ID, 'numberposts' => -1));
						$courses = array_reverse($courses);

						foreach ($courses as $course) {
							$course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost_online', true);
                            if ($course_price == 0){
                                $course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost', true);
                            }
							$di = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont-online', true);
                            if ($di == 0){
                                $di = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont', true);
                            }
							$price_val = (int)$course_price;

							if ($di > 0 && $course_price > 0) {
								$course_price = '<span>' . $course_price . '</span>';
								$price_val = nicePrice(ceil($price_val * (100 - $di) / 100));
								$course_price .= '<span>' . $price_val . '</span> тмт.';
							} else {
								$di = false;
								if (0 == $course_price) {
									$course_price = '<b>Free</b>';
								} else {
									$course_price = '<span>' . $course_price . ' тмт.</span>';
								}
							}

							$all_dates = array();
							$dates_bg_color = array();
							$id = pll_get_post($course->ID, 'ru');

							$result = $wpdb->get_results("
                SELECT * 
                FROM  $wpdb->postmeta
                    WHERE post_id = $id AND meta_filiation = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
            ");

							foreach ($result as $k => $item) {
//                var_dump($item);
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key == 'date1') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key == 'date2') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key == 'date3') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key == 'date4') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}

//              var_dump($all_dates);

								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date1-bg-color') {
									$dates_bg_color[0] = $item->meta_value;
								} else {
									$dates_bg_color[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date2-bg-color') {
									$dates_bg_color[1] = $item->meta_value;
								} else {
									$dates_bg_color[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date3-bg-color') {
									$dates_bg_color[2] = $item->meta_value;
								} else {
									$dates_bg_color[] = '';
								}
								if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date4-bg-color') {
									$dates_bg_color[3] = $item->meta_value;
								} else {
									$dates_bg_color[] = '';
								}

							}


							$months = array_fill(0, 4, '');
							for ($i = 0; $i < sizeof($all_dates); $i++) {
								if (time() > strtotime($all_dates[$i] . ' 19:00')) {
									continue;
								}
								$mo_m = explode('.', $all_dates[$i]);

								if ((int)substr($mo_m[2], -2) > $year) {
									$dif = 12 - $month + $mo_m[1];
									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
								} elseif ($mo_m[1] > $month || ($mo_m[1] == $month && $mo_m[0] + 5 > $day)) {
									$dif = $mo_m[1] - $month;
									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
								}
							}
							?>
                <li class="b-inforow-courses">
                    <div class="col-sm-4">
                        <p class="b-inforow-courses-item b-inforow-courses-first-item">
                        <span>
                            <a href="<?php echo get_permalink($course->ID); ?>"><?php echo $course->post_title; ?></a>
                        </span>
													<?php if ($di) { ?>
                              <span class="b-inforow-courses-discounts-icon">
                                <span class="b-inforow-courses-discounts">-<?php echo $di; ?> %</span>
                            </span>
													<?php } ?>
                        </p>
                    </div>

                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item ">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word1; ?></span>
                            <span><?php echo get_post_meta(pll_get_post($course->ID, 'ru'), 'long', true), $word3; ?></span>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item<?php echo($di ? ' b-inforow-courses-item-discounts' : ''); ?>">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word2; ?></span>
													<?php echo $course_price; ?>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m1; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[0]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m2; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[1]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m3; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[2]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m4; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[3]; ?>
                        </span>
                        </p>
                    </div>
                </li>
						<?php }
					} ?>

        </ul>
    </div>
    <div class="col-md-12 b-schedule-courses-table" id="poznyaki">
        <ul class="b-inforow">

            <li class="b-inforow-heading">
                <div class="col-sm-4">
                    <p class="b-inforow-heading-item b-inforow-heading-first-item">
                        <span><?php echo($lang ? 'Название курса' : 'Назва курсу'); ?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $word1; ?></span>
                    </p>
                </div>
                <div class="col-sm-2">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $word2; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m1; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m2; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m3; ?></span>
                    </p>
                </div>
                <div class="col-sm-1">
                    <p class="b-inforow-heading-item">
                        <span><?php echo $m4; ?></span>
                    </p>
                </div>
            </li>

					<?php
					foreach ($categories as $category) {
						$cat_data_ru = get_option('category_' . pll_get_term($category->cat_ID, 'ru'));
						if (!is_array($cat_data_ru)) {
							$cat_data_ru = array();
						}
						$minimized = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
						$word3 = $minimized ? ($lang ? ' мес.' : ' міс.') : ($lang ? ' ч.' : ' год.');

						echo '<li class="b-inforow-title"><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';

						$courses = get_posts(array('category' => $category->cat_ID, 'numberposts' => -1));
						$courses = array_reverse($courses);

						foreach ($courses as $course) {
							$course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost_online', true);
                            if ($course_price == 0){
                                $course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost', true);
                            }
							$di = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont-online', true);
                            if ($di == 0){
                                $di = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont', true);
                            }
							$price_val = (int)$course_price;

							if ($di > 0 && $course_price > 0) {
								$course_price = '<span>' . $course_price . '</span>';
								$price_val = nicePrice(ceil($price_val * (100 - $di) / 100));
								$course_price .= '<span>' . $price_val . '</span> тмт.';
							} else {
								$di = false;
								if (0 == $course_price) {
									$course_price = '<b>Free</b>';
								} else {
									$course_price = '<span>' . $course_price . ' тмт.</span>';
								}
							}

							$all_dates = array();
							$dates_bg_color = array();
//            $current_filiation = get_post_meta(pll_get_post($course->ID, 'ru'), 'date1-filiation-uuid', true);
							$id = pll_get_post($course->ID, 'ru');

							$result = $wpdb->get_results("
                  SELECT * 
                  FROM  $wpdb->postmeta
                      WHERE post_id = $id AND meta_filiation = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0'
              ");


							foreach ($result as $k => $item) {
								if ($item->meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $item->meta_key == 'date1') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $item->meta_key == 'date2') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $item->meta_key == 'date3') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
								if ($item->meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $item->meta_key == 'date4') {
									$all_dates[] = $item->meta_value;
								} else {
									$all_dates[] = '';
								}
							}


							if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date1-bg-color') {
								$dates_bg_color[0] = $item->meta_value;
							} else {
								$dates_bg_color[] = '';
							}
							if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date2-bg-color') {
								$dates_bg_color[1] = $item->meta_value;
							} else {
								$dates_bg_color[] = '';
							}
							if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date3-bg-color') {
								$dates_bg_color[2] = $item->meta_value;
							} else {
								$dates_bg_color[] = '';
							}
							if ($item->meta_filiation === '1dbf8164-52df-41f4-bbbc-48b6fe762a57' && $item->meta_key === 'date4-bg-color') {
								$dates_bg_color[3] = $item->meta_value;
							} else {
								$dates_bg_color[] = '';
							}

//            if ($result[2] -> meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $result[2] -> meta_key === 'date1-bg-color') {
//              $dates_bg_color[0] = $result[2] -> meta_value;
//            } else {
//              $dates_bg_color[0] = '';
//            }
//            if ($result[2] -> meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $result[2] -> meta_key === 'date2-bg-color') {
//              $dates_bg_color[1] = $result[2] -> meta_value;
//            } else {
//              $dates_bg_color[1] = '';
//            }
//            if ($result[2] -> meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $result[2] -> meta_key === 'date3-bg-color') {
//              $dates_bg_color[2] = $result[2] -> meta_value;
//            }else {
//              $dates_bg_color[2] = '';
//            }
//            if ($result[2] -> meta_filiation === 'ed944588-9ae7-45e2-8a2e-4482ee973cb0' && $result[2] -> meta_key === 'date4-bg-color') {
//              $dates_bg_color[3] = $result[2] -> meta_value;
//            } else {
//              $dates_bg_color[3] = '';
//            }
//                $dates_bg_color[0] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date1-bg-color', true);
//                $dates_bg_color[1] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date2-bg-color', true);
//                $dates_bg_color[2] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date3-bg-color', true);
//                $dates_bg_color[3] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date4-bg-color', true);

//              }
//              } else {
//                $all_dates[0] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date1', true);
//                $all_dates[1] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date2', true);
//                $all_dates[2] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date3', true);
//                $all_dates[3] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date4', true);
//
//
//                $dates_bg_color[0] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date1-bg-color-left', true);
//                $dates_bg_color[1] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date2-bg-color-left', true);
//                $dates_bg_color[2] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date3-bg-color-left', true);
//                $dates_bg_color[3] = get_post_meta(pll_get_post($course->ID, 'ru'), 'date4-bg-color-left', true);
//              }

							$months = array_fill(0, 4, '');
							for ($i = 0; $i < sizeof($all_dates); $i++) {
								if (time() > strtotime($all_dates[$i] . ' 19:00')) {
									continue;
								}
								$mo_m = explode('.', $all_dates[$i]);

								if ((int)substr($mo_m[2], -2) > $year) {
									$dif = 12 - $month + $mo_m[1];
									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
								} elseif ($mo_m[1] > $month || ($mo_m[1] == $month && $mo_m[0] + 5 > $day)) {
									$dif = $mo_m[1] - $month;
									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
								}
							}
							?>
                <li class="b-inforow-courses">
                    <div class="col-sm-4">
                        <p class="b-inforow-courses-item b-inforow-courses-first-item">
                        <span>
                            <a href="<?php echo get_permalink($course->ID); ?>"><?php echo $course->post_title; ?></a>
                        </span>
													<?php if ($di) { ?>
                              <span class="b-inforow-courses-discounts-icon">
                                <span class="b-inforow-courses-discounts">-<?php echo $di; ?> %</span>
                            </span>
													<?php } ?>
                        </p>
                    </div>

                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item ">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word1; ?></span>
                            <span><?php echo get_post_meta(pll_get_post($course->ID, 'ru'), 'long', true), $word3; ?></span>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <p class="b-inforow-courses-item<?php echo($di ? ' b-inforow-courses-item-discounts' : ''); ?>">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $word2; ?></span>
													<?php echo $course_price; ?>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m1; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[0]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m2; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[1]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m3; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[2]; ?>
                        </span>
                        </p>
                    </div>
                    <div class="col-sm-1">
                        <p class="b-inforow-courses-item">
                            <span class="b-inforow-courses-item-characteristics"><?php echo $m4; ?></span>
                            <span class="b-inforow-courses-date-item<?php echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?>">
                            <?php echo $months[3]; ?>
                        </span>
                        </p>
                    </div>
                </li>
						<?php }
					} ?>

        </ul>
    </div>
<!--    <div class="col-md-12 b-schedule-courses-table" id="vdnh">-->
<!--        <ul class="b-inforow">-->
<!--            <li class="b-inforow-heading">-->
<!--                <div class="col-sm-4">-->
<!--                    <p class="b-inforow-heading-item b-inforow-heading-first-item">-->
<!--                        <span>--><?php //echo($lang ? 'Название курса' : 'Назва курсу'); ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $word1; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $word2; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-1">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $m1; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-1">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $m2; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-1">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $m3; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-sm-1">-->
<!--                    <p class="b-inforow-heading-item">-->
<!--                        <span>--><?php //echo $m4; ?><!--</span>-->
<!--                    </p>-->
<!--                </div>-->
<!--            </li>-->
<!---->
<!--					--><?php
//					foreach ($categories as $category) {
//						$cat_data_ru = get_option('category_' . pll_get_term($category->cat_ID, 'ru'));
//						if (!is_array($cat_data_ru)) {
//							$cat_data_ru = array();
//						}
//						$minimized = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
//						$word3 = $minimized ? ($lang ? ' мес.' : ' міс.') : ($lang ? ' ч.' : ' год.');
//
//						echo '<li class="b-inforow-title"><a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a></li>';
//
//						$courses = get_posts(array('category' => $category->cat_ID, 'numberposts' => -1));
//						$courses = array_reverse($courses);
//
//						foreach ($courses as $course) {
//							$course_price = get_post_meta(pll_get_post($course->ID, 'ru'), 'cost', true);
//							$di = get_post_meta(pll_get_post($course->ID, 'ru'), 'discont-vdnh', true);
//							$price_val = (int)$course_price;
//
//							if ($di > 0 && $course_price > 0) {
//								$course_price = '<span>' . $course_price . '</span>';
//								$price_val = nicePrice(ceil($price_val * (100 - $di) / 100));
//								$course_price .= '<span>' . $price_val . '</span> тмт.';
//							} else {
//								$di = false;
//								if (0 == $course_price) {
//									$course_price = '<b>Free</b>';
//								} else {
//									$course_price = '<span>' . $course_price . ' тмт.</span>';
//								}
//							}
//
//							$all_dates = array();
//							$dates_bg_color = array();
////            $current_filiation = get_post_meta(pll_get_post($course->ID, 'ru'), 'date1-filiation-uuid', true);
//							$id = pll_get_post($course->ID, 'ru');
//
//							$result = $wpdb->get_results("
//                  SELECT *
//                  FROM  $wpdb->postmeta
//                      WHERE post_id = $id AND meta_filiation = 'd6272609-b556-4d4d-8cf4-6d72b4517181'
//              ");
//
//
//							foreach ($result as $k => $item) {
//								if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key == 'date1') {
//									$all_dates[] = $item->meta_value;
//								} else {
//									$all_dates[] = '';
//								}
//								if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key == 'date2') {
//									$all_dates[] = $item->meta_value;
//								} else {
//									$all_dates[] = '';
//								}
//								if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key == 'date3') {
//									$all_dates[] = $item->meta_value;
//								} else {
//									$all_dates[] = '';
//								}
//								if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key == 'date4') {
//									$all_dates[] = $item->meta_value;
//								} else {
//									$all_dates[] = '';
//								}
//							}
//
//							if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key === 'date1-bg-color') {
//								$dates_bg_color[0] = $item->meta_value;
//							} else {
//								$dates_bg_color[] = '';
//							}
//							if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key === 'date2-bg-color') {
//								$dates_bg_color[1] = $item->meta_value;
//							} else {
//								$dates_bg_color[] = '';
//							}
//							if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key === 'date3-bg-color') {
//								$dates_bg_color[2] = $item->meta_value;
//							} else {
//								$dates_bg_color[] = '';
//							}
//							if ($item->meta_filiation === 'd6272609-b556-4d4d-8cf4-6d72b4517181' && $item->meta_key === 'date4-bg-color') {
//								$dates_bg_color[3] = $item->meta_value;
//							} else {
//								$dates_bg_color[] = '';
//							}
//
//							$months = array_fill(0, 4, '');
//							for ($i = 0; $i < sizeof($all_dates); $i++) {
//								if (time() > strtotime($all_dates[$i] . ' 19:00')) {
//									continue;
//								}
//								$mo_m = explode('.', $all_dates[$i]);
//
//								if ((int)substr($mo_m[2], -2) > $year) {
//									$dif = 12 - $month + $mo_m[1];
//									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
//								} elseif ($mo_m[1] > $month || ($mo_m[1] == $month && $mo_m[0] + 5 > $day)) {
//									$dif = $mo_m[1] - $month;
//									$months[$dif] .= (empty($dates_bg_color[$i]) ? '<span>' : '<span style="background-color:#' . $dates_bg_color[$i] . ';">') . $all_dates[$i] . '</span>';
//								}
//							}
//							?>
<!--                <li class="b-inforow-courses">-->
<!--                    <div class="col-sm-4">-->
<!--                        <p class="b-inforow-courses-item b-inforow-courses-first-item">-->
<!--                        <span>-->
<!--                            <a href="--><?php //echo get_permalink($course->ID); ?><!--">--><?php //echo $course->post_title; ?><!--</a>-->
<!--                        </span>-->
<!--													--><?php //if ($di) { ?>
<!--                              <span class="b-inforow-courses-discounts-icon">-->
<!--                                <span class="b-inforow-courses-discounts">---><?php //echo $di; ?><!-- %</span>-->
<!--                            </span>-->
<!--													--><?php //} ?>
<!--                        </p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-sm-2">-->
<!--                        <p class="b-inforow-courses-item ">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $word1; ?><!--</span>-->
<!--                            <span>--><?php //echo get_post_meta(pll_get_post($course->ID, 'ru'), 'long', true), $word3; ?><!--</span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-sm-2">-->
<!--                        <p class="b-inforow-courses-item--><?php //echo($di ? ' b-inforow-courses-item-discounts' : ''); ?><!--">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $word2; ?><!--</span>-->
<!--													--><?php //echo $course_price; ?>
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-sm-1">-->
<!--                        <p class="b-inforow-courses-item">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $m1; ?><!--</span>-->
<!--                            <span class="b-inforow-courses-date-item--><?php //echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?><!--">-->
<!--                            --><?php //echo $months[0]; ?>
<!--                        </span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-sm-1">-->
<!--                        <p class="b-inforow-courses-item">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $m2; ?><!--</span>-->
<!--                            <span class="b-inforow-courses-date-item--><?php //echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?><!--">-->
<!--                            --><?php //echo $months[1]; ?>
<!--                        </span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-sm-1">-->
<!--                        <p class="b-inforow-courses-item">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $m3; ?><!--</span>-->
<!--                            <span class="b-inforow-courses-date-item--><?php //echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?><!--">-->
<!--                            --><?php //echo $months[2]; ?>
<!--                        </span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                    <div class="col-sm-1">-->
<!--                        <p class="b-inforow-courses-item">-->
<!--                            <span class="b-inforow-courses-item-characteristics">--><?php //echo $m4; ?><!--</span>-->
<!--                            <span class="b-inforow-courses-date-item--><?php //echo($di ? ' b-inforow-courses-date-item-discounts' : ''); ?><!--">-->
<!--                            --><?php //echo $months[3]; ?>
<!--                        </span>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </li>-->
<!--						--><?php //}
//					} ?>
<!--        </ul>-->
<!--    </div>-->
    <div style="margin-bottom: 30px;">
        <p>
            <span style="color:#E1102F;">*</span>
          <?php if ($lang) { ?>
              Примечание: указанные скидки не суммируются с другими действующими акциями и специальными предложениями.
              Скидка применяется только к новым заявкам и при условии полной оплаты.
              Если у Вас возникли вопросы, обращайтесь за консультацией к нашим менеджерам!
          <?php } else { ?>
              Примітка: зазначені знижки не сумуються з іншими діючими акціями та спеціальними пропозиціями.
              Знижка застосовується тільки до нових заявок та при умові повної оплати курсу.
              Якщо у Вас виникли питання, звертайтеся за консультацією до наших менеджерів!
           <?php } ?>
        </p>
    </div>
</div>

<script>
  var hash = window.location.hash;

  if (hash === '#poznyaki') {
    $('#soon').removeClass('b-schedule-courses--active');
    $('.schedule-nav__soon').removeClass('schedule-nav--active');

    $('#beresteyka').removeClass('b-schedule-courses--active');
    $('.schedule-nav__beresteyka').removeClass('schedule-nav--active');

    $('#poznyaki').addClass('b-schedule-courses--active');
    $('.schedule-nav__poznyaki').addClass('schedule-nav--active');

  }

  $('.schedule-nav a').on('click', function () {
    $('.schedule-nav a').removeClass('schedule-nav--active');
    $(this).addClass('schedule-nav--active');
    $(".b-schedule-courses-table").removeClass('b-schedule-courses--active');
    var selected_tab = $(this).attr("href");
    $(selected_tab).addClass('b-schedule-courses--active');
    return false;
  })

</script>

<?php get_footer(); ?>
