<?php
get_header();

$lang   = (get_locale() == 'ru_RU');
$term = get_queried_object();


// vars
$h1_title = get_field('h1_title', $term);

?>
<h1 style='width:0;height: 0;visibility: hidden'><?php echo $h1_title; ?></h1>
<section class="broadcrumbs">
    <nav class="container">
        <?php
        if (function_exists('dimox_breadcrumbs')) {
            dimox_breadcrumbs();
        }
        ?>
    </nav>
</section>

<div class="container" id="flip-scroll"><div class="head-section"></div><div class="block-news clearfix">
    <div id="course" class="eVe">

    <?php
    $road_id = get_query_var('cat');
    $coursesForChildren = (
            $road_id == 105  || $road_id == 226  ||
            $road_id == 1005 || $road_id == 1007 ||
            $road_id == 1009 || $road_id == 1011
    );

    query_posts([
        'posts_per_page' => -1,
        'cat'   => $road_id,
        'order' => 'DESC',
    ]);
    if (have_posts()) {
    $cat_data = get_option('category_' . $road_id);
    if (!is_array($cat_data)) {
        $cat_data = array();
    }
    $cat_data_ru = get_option('category_' . pll_get_term($road_id, 'ru'));
    if (!is_array($cat_data_ru)) {
        $cat_data_ru = array();
    }

    $di_full = (array_key_exists('di_full', $cat_data_ru) ? $cat_data_ru['di_full'] : 0);
    $di_part = (array_key_exists('di_part', $cat_data_ru) ? $cat_data_ru['di_part'] : 0);
    $num_courses_for_di_part = (array_key_exists('for_di_part', $cat_data_ru) ? $cat_data_ru['for_di_part'] : 0);

    $minimized  = array_key_exists('roadmap_type', $cat_data_ru) ? $cat_data_ru['roadmap_type'] == 'minimized' : false;
    $active_tab = (array_key_exists('active_tab', $cat_data_ru) ? $cat_data_ru['active_tab'] : 'full'); ?>

        <div id="b-level-course-container" class="b-level-container container ">

            <div id="left-column" class="col-md-6">
                <section class="col-md-12 col-sm-12 col-xs-12 b-level-course-discription">
                    <div class="b-level-course-discription__title">
                        <h2><?php echo single_cat_title(); ?></h2>
                        <!--<p class="b-level-course-discription__date">Старт <span>2016</span></p>-->
                    </div>

                    <div class="grid">
                        <section class="col-md-12 b-whole-package-sales-section course-list">
                            <?php
                            if (!$coursesForChildren) {
                                ?>
                                <div class="col-md-12 b-choose-courses-sales">
                                    <div class="col-md-3 b-choose-courses-sales--round">
                                        <p>
                                            95%
                                        </p>
                                    </div>
                                    <div class="col-md-9 b-choose-courses-sales--text">
                                        <p>
                                            <?php echo($lang ? 'Вероятность трудоустройства после<br>обучения по комплексной программе' : 'Імовірність працевлаштування після<br>навчання за комплексною програмою'); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            if ($di_full) {
                                ?>
                                <div class="col-md-12 b-choose-courses-sales">
                                    <div class="col-md-3 b-choose-courses-sales--round">
                                        <p class="full-sale-discount">
                                            -<?php echo $di_full; ?>%
                                        </p>
                                    </div>
                                    <div class="col-md-9 b-choose-courses-sales--text">
                                        <p>
                                            <?php echo($lang ? 'Экономия при покупке полной <br> комплексной программы <br>' : 'Економія при купівлі повної <br> комплексної програми <br>'), single_cat_title(); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </section>

                        <section class="col-md-12 b-choose-courses-sales-section course-choice">
                            <?php
                            if ($di_part and $num_courses_for_di_part) {
                                ?>
                                <div class="col-md-12 b-choose-courses-sales select-course">
                                    <div class="col-md-3 b-choose-courses-sales--round">
                                        <p>
                                            -<span class="number-of-percent"
                                                   data-num-courses="<?php echo $num_courses_for_di_part; ?>"><?php echo $di_part; ?></span>%
                                        </p>
                                    </div>
                                    <div class="col-md-9 b-choose-courses-sales--text">
                                        <p>
                                            <?php echo($lang ? 'Скидка при выборе ' . $num_courses_for_di_part . ' и более курсов<br><span>(Скидки не суммируются)</span>' : 'Знижка при виборі ' . $num_courses_for_di_part . ' і більше курсів<br><span>(Знижки не сумуються)</span>'); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-md-12 b-roadmap-select-course-books">
                                <div class="b-roadmap-select-course-books--inner">
                                    <p>
                                        <?php
                                        if ($coursesForChildren) {
                                            if ($lang) {
                                                echo '<span>Детские курсы от ITEA </span> – это интересное и перспективное хобби, развитие интеллекта, усидчивости и творческих способностей.<br><nobr>IT-специалист –</nobr> всегда востребован, ведь технологии идут вперед. А значит, детские <nobr>IT-курсы –</nobr> выгодное обучение, которое обеспечит будущее Вашего ребенка уже сегодня.';
                                            } else {
                                                echo '<span>Дитячі курси</span> – перспективне хобі, розвиток посидючості, інтелекту та творчих здібностей.<br><nobr>IT-фахівець –</nobr> завжди затребуваний, адже технології крокують вперед. Тому дитячі <nobr>IT-курси –</nobr> вигідне навчання, що забезпечує майбутнє дитини сьогодні.';
                                            }
                                        } else {
                                            if ($lang) {
                                                echo '<span>Комплексная программа обучения от ITEA</span> – залог перспективной карьеры в IT. Пройдя подготовку у нас, ты получаешь качественные навыки и умения, востребованные ведущими <nobr>IT-компаниями.</nobr> Инвестируя в обучение, ты инвестируешь в свое успешное будущее.';
                                            } else {
                                                echo '<span>Комплексна програма навчання</span> – запорука перспективної кар’єри в IT. Пройшовши підготовку в нас, ти отримаєш якісні вміння та навички, затребувані топовими <nobr>IT-компаніями.</nobr> Інвестуючи в навчання, ти інвестуєш в успішне майбутнє.';
                                            }
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="grid b-level-course-discription__wrapper">
                        <div class="b-level-course-discription__text course-list">
                            <?php
                            // парсинг описания категории на заголовки для сео оптимизации
                            mb_regex_encoding('UTF-8');
                            $temp_array = mb_split('\s[-–—]\s', html_entity_decode(category_description()), 2);

                            if (!$coursesForChildren && count($temp_array) > 1 && mb_strlen($temp_array[0] < 60)) {
                                $seo_heading = strip_tags($temp_array[0]);
                                echo '<h2>', $seo_heading, '</h2>';

                                $seo_heading = explode(' ', $seo_heading);

                                $first_word = array_shift($seo_heading);
                                if ($first_word) {
                                    $pos_first_word = mb_strpos($temp_array[0], $first_word);

                                    $last_word = array_pop($seo_heading);
                                    if ($last_word) {
                                        $pos_last_word = mb_strpos($temp_array[0], $last_word);
                                        $temp_array[0] = mb_substr($temp_array[0], 0, $pos_first_word) . mb_substr($temp_array[0], $pos_last_word + mb_strlen($last_word));
                                    } else {
                                        $temp_array[0] = mb_substr($temp_array[0], 0, $pos_first_word) . mb_substr($temp_array[0], $pos_first_word + mb_strlen($first_word));
                                    }
                                }
                                echo implode(' — ', $temp_array);
                            } else {
                                echo category_description();
                            }
                            ?>
                        </div>
                    </div>
                </section>

                <section class="col-md-12 col-sm-12 col-xs-12 b-level-course_skills">
                    <div class="grid">
                        <div class="b-level-course-skills_items course-list">
                            <?php
                            if ($cat_data['cat_text']) {
                                echo '<h2>', ($lang ? 'После изучения курса Вы сможете:' : 'Після вивчення курсу Ви зможете:'), '</h2>';
                                echo $cat_data['cat_text'];
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>

            <div id="right-column" class="col-md-6">
                <section class="col-md-12 col-sm-12 col-xs-12 b-level-course-list-block">

                    <?php if (!$minimized) { ?>
                        <div class="b-level-course-list-table_header">
                            <button data-filter=".course-list"
                                    class="b-level-course-list-table_header--btn-left ">
                                <?php echo($lang ? 'Полный пакет' : 'Повний пакет'); ?>
                            </button>
                            <button data-filter=".course-choice"
                                    class=" b-level-course-list-table_header--btn-right ">
                                <span><?php echo($lang ? 'Подобрать курсы' : 'Підібрати курси'); ?></span>
                            </button>
                        </div>
                    <?php } ?>

                    <!-- таблица полнлго пакета -->
                    <div class="grid level-form-course-wrapper">
                        <div id="level-form_course-list" class="course-list">
                            <ul class="course-list_items">
                                <?php
                                $choose_courses = '';
                                $fullPriceRoad = 0;
                                $word1 = ($lang ? 'Подробнее' : 'Докладніше');
                                $word2 = ($lang ? ' ч.' : ' год.');
                                $word3 = ($lang ? 'Купить' : 'Купити');
                                while (have_posts()) {
                                    the_post();

                                    $idd = get_the_ID();
                                    $getTitle = get_the_title();

                                    echo '<li><p class="col-sm-6 col-xs-6 course-list-item_title"><a href="' . get_the_permalink($idd) . '">';
                                    $choose_courses .= '<li><p class="col-sm-6 col-xs-5 course-list-item_title"' . (mb_strlen($getTitle) > 70 ? ' style="padding-bottom:45px;"' : '') . '>';

                                    echo $getTitle, '</a>';

                                    $ti = get_post_meta(pll_get_post($idd, 'ru'), 'long', true);
                                    $courseDuration = '';
                                    if ($ti) {
                                        $courseDuration  = '<span class="b-level-course-list-table-item-course_duration">';
                                        $courseDuration .= $ti . ($minimized ? ($lang ? ' мес.' : ' міс.') : $word2);
                                        $courseDuration .= '</span>';
                                    }

                                    echo $courseDuration, '</p>';

                                    $pr = get_post_meta(pll_get_post($idd, 'ru'), 'cost_online', true);
                                    if ($pr == 0){
                                        $pr = get_post_meta(pll_get_post($idd, 'ru'), 'cost', true);
                                    }
                                    

                                    $price_then_more = '<p class="col-sm-2 col-xs-3 course-list-item_price">';

                                    if ($di_full and $di_part and $num_courses_for_di_part) {
                                        $di = 0;
                                    } else {
                                        $di = get_post_meta(pll_get_post($idd, 'ru'), 'discont-online', true);
                                            if ($di == 0){
                                                $di = get_post_meta(pll_get_post($idd, 'ru'), 'discont', true);
                                            }
                                    }

                                    if ($di > 0) {
                                        $price_then_more .= '<span>' . $pr . '</span>';
                                        $pr = nicePrice(ceil($pr * (100 - $di) / 100));
                                        $price_then_more .= '<span>' . $pr . '</span> тмт.' . ($minimized ? ($lang ? '/мес.' : '/міс.')  : '');
                                    } else {
                                        if (0 == $pr) {
                                            $price_then_more .= '<b>Free</b>';
                                        } else {
                                            $price_then_more .= $pr . ' тмт.' . ($minimized ? ($lang ? '/мес.' : '/міс.')  : '');
                                        }
                                    }
                                    $fullPriceRoad += $pr;

                                    $choose_courses .= '<input type="checkbox" id="course-item-' . $idd . '" class="css-checkbox" name="course-items[]" value="' . $idd . ' | ' . $pr . '">';
                                    $choose_courses .= '<label for="course-item-' . $idd . '" name="checkbox-' . $idd . '" class="css-label lite-cyan-check">' . $getTitle;
                                    $choose_courses .= $courseDuration . '</label></p>';

                                    $price_then_more .= '</p>';
                                    echo $price_then_more;
                                    $choose_courses .= $price_then_more;
                                    $price_then_more = '<a href="' . get_the_permalink($idd) . '" class="col-sm-4 col-xs-4 course-list-item_more-link more-link"><span class="more-link__word">' . $word1 . '</span><span class="glyphicon glyphicon-chevron-right more-link__right-direction"></span></a></li>';
                                    echo $price_then_more;
                                    $choose_courses .= $price_then_more;
                                }

                                $diFullPriceRoad = (int)($fullPriceRoad * (100 - $di_full) / 100 + 0.99);
                                $partsPriceRoad  = (int)($diFullPriceRoad * 1.1 / 4 + 0.99);

                                $diFullPriceRoad = nicePrice($diFullPriceRoad);
                                $partsPriceRoad  = nicePrice($partsPriceRoad);
                                ?>
                            </ul>


                            <?php if (!$minimized) { ?>
                            <form method="POST" action="<?php echo get_permalink(7611); ?>">
                                <input type="hidden" name="price" value="<?php echo $diFullPriceRoad; ?>">
                                <input type="hidden" name="roadmap-full-price" value="<?php echo $fullPriceRoad; ?>">
                                <input type="hidden" name="roadmap-part-price" value="<?php echo $partsPriceRoad; ?>">
                                <input type="hidden" name="roadmap-di-full" value="<?php echo $di_full; ?>">
                                <input type="hidden" name="road_id" value="<?php echo $road_id; ?>">
                                <ul class="course-list-total">
                                    <li class="r-total-price-wrapper">
                                        <p class="col-sm-6 col-xs-6 course-list-total_title"><?php echo($lang ? 'Единоразовая оплата' : 'Разова оплата'); ?></p>
                                        <p class="col-sm-2 col-xs-2 course-list-total_price r-total-price">
                                            <?php
                                            if ( $fullPriceRoad > ($diFullPriceRoad+500) ) {
                                                ?>
                                                <span class="r-total-price__full r-total-price__full--greyed"><?php echo $fullPriceRoad; ?></span>
                                                <?php
                                            }
                                            ?>
                                            <span class="r-total-price__full"><?php echo $diFullPriceRoad; ?> тмт</span>
                                        </p>
                                        <p class="col-sm-4 col-xs-4 course-list-total_submit">
                                            <button class="order-courses-btn" type="submit" name="roadFull_payOnce" style="letter-spacing: -1px;white-space: nowrap;min-width: 140px;">
                                                <?php echo($lang ? 'Получить скидку' : 'Отримати знижку'); ?>
                                            </button>
                                        </p>
                                    </li>
                                </ul>
                            </form>

                            <div class="course-help_pay">
                                <?php if ($lang) { ?>
                                    <p class="course-help_title">Не хватает суммы</p>
                                    <p class="course-help_text">Мы не допустим, чтобы это стало
                                        препятствием для вашего будущего.
                                        Вы можете оплачивать курс в рассрочку, четырьмя равными
                                        платежами.</p>
                                <?php } else { ?>
                                    <p class="course-help_title">Не вистачає суми</p>
                                    <p class="course-help_text">Ми не допустимо, щоб це стало перешкодою
                                        для вашого майбутнього.
                                        Ви можете оплачувати курс у розстрочку, чотирма рівними
                                        платежами.</p>
                                <?php } ?>
                            </div>

                            <form method="POST" action="<?php echo get_permalink(7611); ?>">
                                <input type="hidden" name="parts_price" value="<?php echo $partsPriceRoad; ?> x4">
                                <input type="hidden" name="price" value="<?php echo $diFullPriceRoad; ?>">
                                <input type="hidden" name="roadmap-full-price" value="<?php echo $fullPriceRoad; ?>">
                                <input type="hidden" name="roadmap-part-price" value="<?php echo $partsPriceRoad; ?>">
                                <input type="hidden" name="roadmap-di-full" value="<?php echo $di_full; ?>">
                                <input type="hidden" name="road_id" value="<?php echo $road_id; ?>">
                                <ul class="course-list-part">
                                    <li>
                                        <p class="col-sm-6 col-xs-6 course-list-part_title">
                                            <?php echo($lang ? 'Оплата частями' : 'Оплата частинами'); ?>
                                        </p>
                                        <p class="col-sm-2 col-xs-2 course-list-part_price">
                                            <nobr>
                                                <?php echo $partsPriceRoad; ?> тмт.
                                                <span class="choice-parts-number">X4</span>
                                            </nobr>
                                        </p>
                                        <p class="col-sm-4 col-xs-4 course-list-part_submit">
                                            <button class="order-courses-btn" type="submit" name="roadFull_payPart">
                                                <?php echo $word3; ?>
                                            </button>
                                        </p>
                                    </li>
                                </ul>
                            </form>
                            <?php } ?>
                        </div>


                        <!-- таблица "подобрать курсы" -->
                        <div id="level-form_course-choice" class="course-choice">
                            <form id="choice_course_form" method="POST" action="<?php echo get_permalink(7611); ?>">
                                <input type="hidden" name="road_id" value="<?php echo $road_id; ?>">
                                <ul class="course-choice_items">
                                    <?php echo $choose_courses; ?>
                                </ul>

                                <ul class="course-list-total">
                                    <li>
                                        <input type="hidden" name="roadChoice_price" value="0">
                                        <input type="hidden" name="roadmap-full-price" value="0">
                                        <input type="hidden" name="roadmap-part-price" value="0">
                                        <p class="col-sm-6 col-xs-6 course-list-total_title">
                                            <?php echo($lang ? 'Единоразовая оплата' : 'Разова оплата'); ?>
                                        </p>
                                        <p class="col-sm-2 col-xs-2 course-list-total_price">
                                            <span class="choice-total-price"></span>
                                        </p>
                                        <p class="col-sm-4 col-xs-4 course-list-total_submit">
                                            <button class="order-courses-btn" type="submit" name="roadChoice_payOnce">
                                                <?php echo $word3; ?>
                                            </button>
                                        </p>
                                    </li>
                                </ul>
                                <div style="position: relative;">
                                    <div class="course-help_pay">
                                        <?php if ($lang) { ?>
                                            <p class="course-help_title">Не хватает суммы</p>
                                            <p class="course-help_text">Мы не допустим, чтобы это стало
                                                препятствием для вашего будущего.
                                                Вы можете оплачивать курс в рассрочку, четырьмя равными
                                                платежами.</p>
                                        <?php } else { ?>
                                            <p class="course-help_title">Не вистачає суми</p>
                                            <p class="course-help_text">Ми не допустимо, щоб це стало
                                                перешкодою для вашого майбутнього.
                                                Ви можете оплачувати курс у розстрочку, чотирма рівними
                                                платежами.</p>
                                        <?php } ?>
                                    </div>

                                    <ul class="course-list-part">
                                        <li>
                                            <input type="hidden" name="roadChoice_parts_price" value="0">
                                            <input type="hidden" name="roadmap-full-price" value="0">
                                            <input type="hidden" name="roadmap-part-price" value="0">
                                            <p class="col-sm-6 col-xs-6 course-list-part_title">
                                                <?php echo($lang ? 'Оплата частями' : 'Оплата частинами'); ?>
                                            </p>
                                            <p class="col-sm-2 col-xs-2 course-list-part_price">
                                                <nobr>
                                                    <span class="choice-part-price"></span>
                                                    <span class="choice-parts-number">X4</span>
                                                </nobr>
                                            </p>
                                            <p class="col-sm-4 col-xs-4 course-list-part_submit">
                                                <button class="order-courses-btn" type="submit" name="roadChoice_payPart">
                                                    <?php echo $word3; ?>
                                                </button>
                                            </p>
                                        </li>
                                    </ul>
                                    <p class="form-disabled text-center">
                                        <?php echo($lang ? 'Выберите курс' : 'Оберіть курс'); ?>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

        </div>


        <?php
        if ($cat_data_ru['courses']) {
            $courses = explode(',', $cat_data_ru['courses']);
            echo '<h3 class="additional-courses-discription__title">', ($lang ? 'Дополнительные курсы' : 'Додаткові курси'), '</h3>';
            echo '<div style="margin-top:0;">';

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
                echo '<h3>', get_the_title($cours_id), '</h3>';

                $pr = get_post_meta(pll_get_post($cours_id, 'ru'), 'cost_online', true);
                if ($pr == 0){
                    $pr = get_post_meta(pll_get_post($cours_id, 'ru'), 'cost', true);
                }
                
                if ($di > 0) {
                    echo '<span>', $pr, '</span>';
                    $new_pr = nicePrice(ceil($pr * (100 - $di) / 100));
                    echo '<span>', $new_pr, ' тмт.</span>';
                } else {
                    echo '<span>', $pr, ' тмт.</span>';
                }

                $ti = get_post_meta(pll_get_post($cours_id, 'ru'), 'long', true);
                if ($ti) {
                    echo '<p>', ($lang ? 'Длительность курса: ' : 'Тривалість курсу: '), $ti, $word2, '</p>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
    }
    ?>

    </div>
</div></div>


<?php
if ($active_tab == 'full') {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.b-level-course-list-table_header--btn-left').addClass('active');
            $grid = $('.grid');
            $('.grid .course-choice').hide();
            setTimeout(function(){
                $grid.isotope({filter: '.course-list'});
            },500);
        });
    </script>
<?php } else { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.b-level-course-list-table_header--btn-left').removeClass('active');
            $('.b-level-course-list-table_header--btn-right').addClass('active');
            $grid = $('.grid');
            $('.grid .course-list').hide();
            setTimeout(function(){
                $grid.isotope({filter: '.course-choice'});
            },500);
        });
    </script>
<?php } ?>

    <script src="<?php bloginfo('template_directory'); ?>/js/roadmap_v5.js"></script>

<?php get_footer(); ?>
