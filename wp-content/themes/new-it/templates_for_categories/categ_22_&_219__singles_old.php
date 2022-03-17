<style>
    .course-content-block .course__details-info {
        padding-left: 40px;
    }

    .course-content-block .course__start-title:before {
        left: -40px;
    }

    .course-content-block .course__bank-data.course__bank-data--empty {
        font-size: 12px;
    }

    .course__bank > div {
        box-sizing: border-box;
        padding-right: 5px;
        width: 50%;
    }

    @media (max-width: 430px) {
        .course__bank > div {
            padding: 0;
            width: 100%;
        }

        .course__bank > div + div {
            margin-top: 15px;
        }

        .course-content-block .course__bank {
            flex-wrap: wrap;
        }
    }
</style>
<?php $h1_title = get_field('h1_title', $term); ?>
<h1 style='width:0;height: 0;visibility: hidden'><?php echo $h1_title; ?></h1>
<section class="course-content-block">
    <div class="container">
        <div class="main__course-wrapper">
            <div class="course__wrapper-header">
                <div class="course__title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="course__details-info">
                    <div class="course__start-title">
                        <?php echo $lang ? 'Старт обучения' : 'Старт навчання' ?>
                    </div>
                    <div class="course__bank">
                        <div class="course__bank-right">
                            <span class="course__bank-title">
<!--                            --><?//= $lang ? 'Берестейская' : 'Берестейська'; ?>
                            </span>
                            <span class="course__bank-data<?= ($all_dates_right[0] == null) ? ' course__bank-data--empty' : ''; ?>">
                            <?php
                            if ($all_dates_right[0] == null) {
                                echo($lang ? 'Дату уточните у администрации' : 'Старт курсу запитуйте в адміністрації');
                            } else {
                                echo $all_dates_right[0];
                            }
                            ?>
                            </span>
                        </div>
<!--                        <div class="course__bank-left">-->
<!--                            <span class="course__bank-title">-->
<!--                            --><?//= $lang ? 'Позняки' : 'Позняки'; ?>
<!--                            </span>-->
<!--                            <span class="course__bank-data--><?//= ($all_dates_left[0] == null) ? ' course__bank-data--empty' : ''; ?><!--">-->
<!--                            --><?php
//                            if ($all_dates_left[0] == null) {
//                                echo($lang ? 'Дату уточните у администрации' : 'Старт курсу запитуйте в адміністрації');
//                            } else {
//                                echo $all_dates_left[0];
//                            }
//                            ?>
<!--                            </span>-->
<!--                        </div>-->
                        <!--                        <div class="course__bank-vdnh">-->
                        <!--                            <span class="course__bank-title">-->
                        <!--                            --><?php //echo $lang ? 'ВДНХ' : 'ВДНГ'; ?>
                        <!--                            </span>-->
                        <!--                            <span class="course__bank-data--><?//= ($all_dates_vdnh[0] == null) ? ' course__bank-data--empty' : ''; ?><!--">-->
                        <!--                            --><?php
                        //                            if ($all_dates_vdnh[0] == null) {
                        //                                echo($lang ? 'Дату уточните у администрации' : 'Старт курсу запитуйте в адміністрації');
                        //                            } else {
                        //                                echo $all_dates_vdnh[0];
                        //                            }
                        //                            ?>
                        <!--                            </span>-->
                        <!--                        </div>-->
                    </div>
                </div>
                <div class="course__during-time">
                    <?= $course_during . ($lang ? ' час.' : ' год.'); ?>
                    <span class="course__during-week"><?= $lang ? "по 2-3 раза в неделю" : "по 2-3 рази на тиждень" ?></span>
                </div>
            </div>
        </div>
        <div class="sidebar-wrapper">
            <div class="course__sidebar">
                <?php
                if (1 == count($parent_cat = get_the_category())) {
                    $road_id = $parent_cat[0]->term_id;
                    $cat_data_ru = get_option('category_' . pll_get_term($road_id, 'ru'));
                    $minimized = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
                } else {
                    $minimized = false;
                }
                $price = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
                $dis = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont', true);
                $dis_left = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-left', true);
                $dis_vdbh = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-vdnh', true);
                $isMonth = get_post_meta(pll_get_post($post->ID, 'ru'), 'ismonth', true);
                $weeks = get_post_meta(pll_get_post($post->ID, 'ru'), 'weeks', true);

                ?>
                <div style="display: none !important;">
                    <div id="location-price" data-price="<?php echo $price ?>"></div>
                    <div id="location-weeks" data-weeks="<?php echo $weeks ?>"></div>
                    <div id="location-part-weeks"
                         data-part-weeks="<?php echo $partsPrice = nicePrice(floor($price / $weeks * 1.15)); ?>"></div>
                </div>

                <p class="course__sidebar-header"><?php echo $lang ? 'Запись на курс' : 'Запис на курс'; ?></p>

                <?php
                if ($isMonth) {
                ?>
                <div class="course month-group">
                    <input type="hidden" name="locationCourses" id="location1" checked
                           value="<?php echo $Uuid_right_band ?>" data-dis="<?php echo $dis ?>">
                    <?php } else { ?>
                    <div class="course-location" style="display: none;">
                        <div class="title-label"><?php echo $lang ? 'Выберите локацию' : 'Виберіть локацію' ?></div>
                        <input type="radio" name="locationCourses" id="location1" checked
                               value="<?php echo $Uuid_right_band ?>" data-dis="<?php echo $dis ?>">
                        <label class="location-item" for="location1">
                            <span class="location-checked"></span>
                            <div class="location-item__title">
                                <?php echo $lang ? 'Берестейская' : 'Берестейська' ?>
                                <span class="location-item__discount">
                    <?php echo $dis ? '-' . $dis . '%' : '' ?>
                  </span>
                            </div>
                        </label>
<!--                        <input type="radio" name="locationCourses" id="location2" value="--><?php //echo $Uuid_left_band ?><!--"-->
<!--                               data-dis="--><?php //echo $dis_left ?><!--">-->
<!--                        <label class="location-item" for="location2">-->
<!--                            <span class="location-checked"></span>-->
<!--                            <div class="location-item__title">-->
<!--                                --><?php //echo $lang ? 'Позняки' : 'Позняки' ?>
<!--                                <span class="location-item__discount">-->
<!--                    --><?php //echo $dis_left ? '-' . $dis_left . '%' : '' ?>
<!--                  </span>-->
<!--                            </div>-->
<!--                        </label>-->
                        <!--                        <input type="radio" name="locationCourses" id="location3" value="--><?php //echo $Uuid_vdnh_band ?><!--"-->
                        <!--                               data-dis="--><?php //echo $dis_vdbh ?><!--">-->
                        <!--                        <label class="location-item" for="location3">-->
                        <!--                            <span class="location-checked"></span>-->
                        <!--                            <div class="location-item__title">-->
                        <!--                                --><?php //echo $lang ? 'ВДНХ' : 'ВДНГ' ?>
                        <!--                                <span class="location-item__discount">-->
                        <!--                    --><?php //echo $dis_vdbh ? '-' . $dis_vdbh . '%' : '' ?>
                        <!--                  </span>-->
                        <!--                            </div>-->
                        <!--                        </label>-->
                    </div>
                    <div class="course">
                        <?php }

                        if (!empty($dis) || !empty($dis_left) || !empty($dis_vdbh)) {
                            $oldPrice = $price;
                            $price = nicePrice(ceil($price * (100 - $dis) / 100));
                            $oldPartsPrice = nicePrice(ceil($oldPrice / $weeks * 1.15));
                            $partsPrice = nicePrice(ceil($price / $weeks * 1.15));
                            $partsPriceLeft = nicePrice(ceil($price / $weeks * 1.15));
                            ?>

                            <div class="fullPay">
                                <p><?php echo $lang ? 'Единоразовая оплата' : 'Одноразова оплата' ?></p>
                                <div class="fullPay-old-price" data-right-price="<?php echo $oldPrice ?>">
                                    <span class="fullPay-disc"><?php echo $oldPrice ?></span>
                                    <span class="fullPay-price"><?php echo $price ?></span>
                                    тмт. <?php echo $minimized ? ($lang ? '/мес.' : '/міс.') : '' ?>
                                </div>
                            </div>
                            <?php
                            if (!$minimized) { ?>
                                <div class="partlyPay">
                                    <p><?php echo $lang ? 'Оплата частями' : 'Оплата частинами' ?></p>
                                    <?php if (empty($weeks)) { ?>
                                        <span><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                    <?php } else { ?>
                                        <div class="partlyPay-old-part-price"
                                             data-patrs-right-price=" <?php echo $oldPartsPrice ?>">
                                            <span class="partlyPay-dis"><?php echo $oldPartsPrice ?></span>
                                            <span class="partlyPay-partPrice"><?php echo $partsPrice ?></span>тмт. <span
                                                class="partlyPay-x">x</span><span
                                                class="partlyPay-weeks"><?php echo $weeks ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php
                            }
                        } else {
                            $partsPrice = nicePrice(floor($price / $weeks * 1.15));
                            ?>
                            <div class="fullPay">
                                <p><?php echo $lang ? 'Единоразовая оплата' : 'Одноразова оплата' ?></p>

                                <div class="fullPay-old-price">
                                    <span class="fullPay-price"><?php echo $price ?></span>
                                    тмт. <?php echo $minimized ? ($lang ? '/мес.' : '/міс.') : '' ?>
                                </div>
                            </div>
                            <?php
                            if (!$minimized) { ?>
                                <div class="partlyPay">
                                    <p><?php echo $lang ? 'Оплата частями' : 'Оплата частинами' ?></p>
                                    <?php
                                    if (empty($weeks)) { ?>
                                        <span><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                    <?php } else { ?>
                                        <div class="partlyPay-old-part-price">
                                            <span class="partlyPay-partPrice"><?php echo $partsPrice ?></span>тмт. <span
                                                class="partlyPay-x">x</span><span
                                                class="partlyPay-weeks"><?php echo $weeks ?></span>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                                <?php
                            }
                        } ?>
                    </div>

                    <?php
                    $sideBar .= '<div class="contet_box contet-box__course-form">';

                    //          if ($lang) {
                    //            $sideBar .= '<form action="' . get_permalink(6847) . '" method="POST" class="sendCourseform">';
                    //          } else {
                    //            $sideBar .= '<form action="' . get_permalink(15933) . '" method="POST" class="sendCourseform">';
                    //          }

                    $sideBar .= '<form action="' . get_permalink(6847) . '" method="POST" class="sendCourseform">';


                    $sideBar .= '<input type="hidden" name="course_id" value="' . $post->ID . '">      
                 <input type="hidden" name="current_locale" value="' . get_locale() . '">
                 <input type="hidden" name="full_price" value="' . $oldPrice . '">
                 <input type="hidden" name="sourceUuid" value="">
                 <input type="hidden" name="price" value="' . $price . '">
                 <input type="hidden" name="price_right" value="' . $price . '">
                 <input type="hidden" name="full_parts_price" value="' . $oldPartsPrice . '">
                 <input type="hidden" name="parts_price" value="' . $partsPrice . ' x' . $weeks . '">
                 <input type="hidden" name="parts_price_right" value="' . $partsPrice . '">
                 <input type="hidden" name="parts_weeks" value="' . ($weeks ? $weeks : '') . '">
                 <input type="hidden" name="price_left" value="">
                 <input type="hidden" name="parts_price_left" value="">
                 <input type="hidden" name="price_vdnh" value="">
                 <input type="hidden" name="parts_price_vdnh" value="">
                 <input type="hidden" name="location" value="' . $price . '">
                 <input type="hidden" name="discount_left" value="' . $dis_left . '">
                 <input type="hidden" name="discount_right" value="' . $dis . '">
                 <input type="hidden" name="discount_vdnh" value="' . $dis_vdbh . '">
                 <input type="submit" id="sendCourseToForm" value="' . ($lang ? 'Записаться' : 'Записатись') . '"></form>';

                    $sideBar .= '<form action="' . get_permalink(12002) . '" method="POST">
                 <input type="hidden" name="course_id" value="' . $post->ID . '">
                 <input type="hidden" name="price" value="' . $price . '">
                 <input type="hidden" name="parts_price" value="' . $partsPrice . ' x' . $weeks . '">
                 <input type="submit" class="sendCourseFree" value="' . ($lang ? 'ПРОБНОЕ ЗАНЯТИЕ' : 'ПРОБНЕ ЗАНЯТТЯ') . '"></form>';
                    $sideBar .= '</div>'; // END div class contet_box
                    echo $sideBar;
                    ?>

                </div>
            </div>
            <div class="course__wrapper">

                <?php
                //да да это очень крассивый код) но было дано задание чтобы шрина блока менялась в зависимости от количества акционных курсов
                $coursesList1 = explode(',', get_post_meta(pll_get_post($post->ID, 'ru'), 'bandl1', true));
                $coursesList2 = explode(',', get_post_meta(pll_get_post($post->ID, 'ru'), 'bandl2', true));
                $coursesList3 = explode(',', get_post_meta(pll_get_post($post->ID, 'ru'), 'bandl3', true));
                $coursesList4 = explode(',', get_post_meta(pll_get_post($post->ID, 'ru'), 'bandl4', true));
                $coursesList5 = explode(',', get_post_meta(pll_get_post($post->ID, 'ru'), 'bandl5', true));
                $coursesList = [];
                $coursesList[1] = $coursesList1;
                $coursesList[2] = $coursesList2;
                $coursesList[3] = $coursesList3;
                $coursesList[4] = $coursesList4;
                $coursesList[5] = $coursesList5;
                ?>
                <div class="course-description-block"
                    <?php if(count($coursesList1) > 2 ||
                        count($coursesList2) > 2 ||
                        count($coursesList3) > 2 ||
                        count($coursesList4) > 2 ||
                        count($coursesList5) > 2 ) {echo "style='max-width: 850px;'";}  ?> >
                    <!-- <?php // the_content(); ?> -->

                    <?php if (get_post_meta($post->ID, 'Описание', true) != ''): ?>
                        <h2><?php echo($lang ? 'Описание курса' : 'Опис курсу'); ?></h2>
                        <?php echo get_post_meta($post->ID, 'Описание', true); ?>

                    <?php endif;
                    if (get_post_meta($post->ID, 'После курса', true) != ''): ?>
                        <h3><?php echo($lang ? 'После курса вы сможете:' : 'Після курсу Ви зможете:'); ?></h3>
                        <?php echo get_post_meta($post->ID, 'После курса', true); ?>
                    <?php endif; ?>

                    <?php if (false) { ?>
                        <h3><?php echo($lang ? 'Также вы получаете:' : 'Також ви отримуєте:'); ?></h3>
                        <div class="divSingleIcons">

                            <div class="icons3">
                                <div class="circleIco"><?php include('../relize/img/svg/9.svg'); ?></div>
                                <p class="centre"><?php echo($lang ? 'Сертификат об окончании курсов' : 'Сертифікат про закінчення курсів'); ?></p>
                            </div>

                            <div class="icons3">
                                <div class="circleIco"><?php include('../relize/img/svg/7.svg'); ?></div>
                                <p class="centre"><?php echo($lang ? 'Помощь в трудоустройстве' : 'Допомогу в працевлаштуванні'); ?></p>
                            </div>

                            <div class="icons3">
                                <div class="circleIco"><?php include('../relize/img/svg/8.svg'); ?></div>
                                <p class="centre"><?php echo($lang ? 'Программа стажировки' : 'Програму стажування'); ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $watchWork = get_post_meta(pll_get_post($post->ID, 'ru'), 'watch-work', true);
                    if (!empty($watchWork) && $watchWork) :?>
                        <a href="<?=$watchWork;?>" class="btn-watch-work" target="_blank">
                            <?=($lang ? 'Смотреть работы выпускников' : 'Дивитись роботи випускників'); ?>
                        </a>
                    <?php endif;?>
                    <?php if(count($coursesList1) > 1 || count($coursesList2) > 1 || count($coursesList3) > 1 || count($coursesList4) > 1 || count($coursesList5) > 1): ?>
                        <div class="courses-slider">
                            <div class="slider-header">
                                <h3><?=($lang ? 'Вместе дешевле' : 'Разом дешевше'); ?></h3>
                                <?php if(count($coursesList2) > 1 || count($coursesList3) > 1 || count($coursesList4) > 1 || count($coursesList5) > 1): ?>
                                    <div class="slider-header-nav">
                                        <div class="navigation">
                                        </div>
                                        <div class="prev"></div>
                                        <div class="next"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="courses-slides">
                                <!-- slider-->
                                <?php foreach ($coursesList as $num=>$courses) :
                                    if(isset($courses)):
                                        if (get_post_meta($post->ID, 'bandl'.$num, true) !== ''):

                                            $price = 0;
                                            $disc = (100 - (int)get_post_meta($post->ID, 'bandl'.$num.'_discount', true)) / 100; // получаем скидку в процентах
                                            ?>

                                            <form action="/roadmap_order_step1/" method="POST" class="courses-slide">
                                                <input type="hidden"
                                                       name="course-items"
                                                       value="<?php echo get_courseID_and_coursePrice($post->ID, $courses);?>">

                                                <div class="courses-list courses-list__count<?= count(array_slice($courses, 0, 3)) ?>" >

                                                    <?php
                                                    foreach (array_slice($courses, 0, 3) as $key=>$value):
                                                        $price += (int)get_post_meta($value, 'cost', true);
                                                        if($key !== 0): ?>
                                                            <span class="sumbol-plus">+</span>
                                                        <?php endif; ?>

                                                        <a href="<?php echo get_permalink($value); ?>">
                                                            <div class="courses-list__item">
                                                                <div class="courses-list__item-img">
                                                                    <?php echo get_the_post_thumbnail($value, array(175, 'auto')); ?>
                                                                </div>
                                                                <span class="courses-list__item-title"><?php echo get_post($value)->post_title; ?></span>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; ?>
                                                    <span class="sumbol-total">=</span>
                                                    <div class="courses-list__item courses-list__item-total">
                                                        <div class="total-wrapper">
                                                            <p class="old-price"> <?php echo $price; ?><span> тмт.</span></p>
                                                            <p class="price_with_discount"> <?php echo nicePrice($price * $disc); ?><span> тмт.</span></p>
                                                        </div>
                                                        <button type="submit"><?php echo $lang ?  "Получить скидку": "Отримати знижку"; ?></button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="price" value="<?php echo nicePrice($price * $disc); ?>">
                                                <input type="hidden" name="full_price" value="<?php echo $price; ?>">
                                            </form>

                                        <?php endif;
                                    endif;
                                endforeach; ?>


                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if (get_post_meta($post->ID, 'Программа', true) != ''): ?>
                        <h3><?php echo($lang ? 'Программа курса:' : 'Програма курсу:'); ?></h3>
                        <div class="event-program-course__list">
                            <?php echo get_post_meta($post->ID, 'Программа', true); ?>
                        </div>
                    <?php endif;

                    if (get_post_meta($post->ID, 'Требования', true) != ''): ?>
                        <h3><?php echo($lang ? 'Минимальные требования:' : 'Мінімальні вимоги:'); ?></h3>
                        <p>
                            <?php echo get_post_meta($post->ID, 'Требования', true); ?>
                        </p>
                    <?php endif;

                    if (get_post_meta($post->ID, 'Лекторы', true) != ''): ?>
                        <h3><?php echo($lang ? 'Лекторы:' : 'Лектори:'); ?></h3>
                        <p>
                            <?php echo get_post_meta($post->ID, 'Лекторы', true); ?>
                        </p>
                    <?php endif; ?>
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


        </div>
</section>

<?php
$courses = get_post_meta(pll_get_post($post->ID, 'ru'), 'courses', true);
$courses = explode(',', $courses);
if ($courses[0]) {
    echo '<section class="recommended-sources"><div class="container">';
    echo '<span class="recommended-courses-title" style="clear:both;">', ($lang ? 'Рекомендуемые курсы' : 'Рекомендовані курси'), '</span><div id="course">';

    foreach ($courses as $cours_id) {
        $cours_id = trim($cours_id);
        if (!is_numeric($cours_id)) {
            continue;
        }
        $cours_id = (int)$cours_id;
        if (!$lang) {
            $cours_id = pll_get_post($cours_id, 'uk');
        }

        $di = get_post_meta(pll_get_post($cours_id, 'ru'), 'discont', true);
        echo '<div class="grid_3 item val_cours">';
        echo '<div class="img">';
        if ($di > 0) {
            echo '<div class="val_course-discount"><span>-', $di, '%</span></div>';
        }
        echo get_the_post_thumbnail($cours_id);
        echo '<a href="', get_the_permalink($cours_id), '" class="view" title=', ($lang ? '"Перейти к курсу">Просмотреть' : '"Перейти до курсу"> Переглянути'), '</a>';
        echo '</div>';
        echo '<div class="course-title">', get_the_title($cours_id), '</div>';

        $pr = get_post_meta(pll_get_post($cours_id, 'ru'), 'cost', true);
        if ($di > 0) {
            echo '<div class="course_price"><span>', $pr, '</span>';
            $new_pr = nicePrice(ceil($pr * (100 - $di) / 100));
            echo '<span>', $new_pr, ' тмт.</span></div>';
        } else {
            echo '<div class="course_price"><span>', $pr, ' тмт.</span></div>';
        }

        $ti = get_post_meta(pll_get_post($cours_id, 'ru'), 'long', true);
        if ($ti && !$minimized) {
            echo '<p>', ($lang ? 'Длительность курса: ' : 'Тривалість курсу: '), $ti, ($lang ? ' ч.' : ' год.'), '</p>';
        }
        echo '</div>';
    }
    echo '</div></div></section>';
}
?>

<script>
    function nicePrice(price) {
        price = String(price);
        if (price.length > 2) {
            price = price.slice(0, -1);
            switch (price.slice(-1)) {
                case '1':
                case '2':
                    price = price.slice(0, -1) + '00';
                    break;
                case '3':
                case '4':
                case '5':
                case '6':
                case '7':
                    price = price.slice(0, -1) + '50';
                    break;
                case '8':
                case '9':
                    price = String(Number(price.slice(0, -1)) + 1) + '00';
                    break;
                default:
                    price += '0';
            }
        }
        return price;
    }

    //
    // $(document).ready(function() {
    //   var courseHeaderHeight = $('.course-section').height();
    //   console.log(courseHeaderHeight);
    //   $('.course__sidebar').css('margin-top', -(courseHeaderHeight - 54));
    //
    // })


    var locationPrice = $('#location-price').data('price');
    var locationDisLeft = $('#location2').data('dis');
    var locationDisVdnh = $('#location3').data('dis');
    var locationWeeks = $('#location-weeks').data('weeks');
    var currentLocationPrice = $('.fullPay-price').text();
    var currentLocationPriceDis = $('.partlyPay-partPrice').text();

    var locationPriceDisc = nicePrice(parseInt(locationPrice * (100 - locationDisLeft) / 100));
    var locationPricePart = nicePrice(parseInt(locationPriceDisc / locationWeeks * 1.15));

    var locationPriceDiscVdnh = nicePrice(parseInt(locationPrice * (100 - locationDisVdnh) / 100));
    var locationPricePartVdnh = nicePrice(parseInt(locationPriceDiscVdnh / locationWeeks * 1.15));

    <?php if(ITEA_PROD){?>
    var uuidLeftBand = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0';
    var uuidVdnhBand = 'd6272609-b556-4d4d-8cf4-6d72b4517181';
    <?php }else{ ?>
    var uuidLeftBand = 'a21a5029-91b4-4971-bb24-29fbaeaa695c';
    var uuidVdnhBand = '96523086-8ac6-49a3-be3e-0556af682452';
    <?php } ?>

    $('#sendCourseToForm').on('click', function (e) {

        $('input[name=price_left]').val(locationPriceDisc);
        $('input[name=parts_price_left]').val(locationPricePart);

        $('input[name=price_vdnh]').val(locationPriceDiscVdnh);
        $('input[name=parts_price_vdnh]').val(locationPricePartVdnh);

        if ($('.course-location input:checked').val() === uuidLeftBand) {
            $('input[name=price]').val(locationPriceDisc);
            $('input[name=parts_price]').val(locationPricePart);
            $('input[name=location]').val($('#location2').val());
            localStorage.setItem('locationCity', $('#location2').val());
        } else if ($('.course-location input:checked').val() === uuidVdnhBand) {
            $('input[name=price]').val(locationPriceDisc);
            $('input[name=parts_price]').val(locationPricePart);
            $('input[name=location]').val($('#location3').val());
            localStorage.setItem('locationCity', $('#location3').val());
        } else {
            $('input[name=location]').val($('#location1').val());
            localStorage.setItem('locationCity', $('#location1').val());
        }
    });

    if ($('#location1').data('dis') == '') {
        $('.fullPay-disc').text('').hide();
        $('.partlyPay-dis').text('').hide();
    }

    $('.course-location input[type=radio]').change(function () {
        if ($(this).val() == uuidLeftBand) {
            $('.fullPay-disc').text(locationPrice).show();
            $('.partlyPay-dis').text($('.partlyPay-old-part-price').data('patrs-right-price')).show();
            $('.fullPay .fullPay-price').text(locationPriceDisc);
            $('.partlyPay-partPrice').text(locationPricePart);
            if ($('#location2').data('dis') == '') {
                $('.fullPay-disc').text('').hide();
                $('.partlyPay-dis').text('').hide();
            }
        } else if ($(this).val() == uuidVdnhBand) {
            $('.fullPay-disc').text(locationPrice).show();
            $('.partlyPay-dis').text($('.partlyPay-old-part-price').data('patrs-right-price')).show();
            $('.fullPay .fullPay-price').text(locationPriceDiscVdnh);
            $('.partlyPay-partPrice').text(locationPricePartVdnh);
            if ($('#location3').data('dis') == '') {
                $('.fullPay-disc').text('').hide();
                $('.partlyPay-dis').text('').hide();
            }
        } else {
            if ($('#location1').data('dis')) {
                $('.fullPay-disc').text($('.fullPay-old-price').data('right-price')).show();
                $('.partlyPay-dis').text($('.partlyPay-old-part-price').data('patrs-right-price')).show();
                $('.discontsCourse span').text($('#location1').data('dis'));
            } else {
                $('.fullPay-disc').text('').hide();
                $('.partlyPay-dis').text('').hide();
            }
            $('.fullPay .fullPay-price').text(currentLocationPrice);
            $('.partlyPay-partPrice').text(currentLocationPriceDis);
        }
    })
</script>
