<?php
$price = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
$priceOnline = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost_online', true);
if ($priceOnline == 0) {
    $priceOnline = get_post_meta(pll_get_post($post->ID, 'ru'), 'cost', true);
}
$dis = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont', true);
$disOnline = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-online', true);
$dis_left = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-left', true);
$dis_vdbh = get_post_meta(pll_get_post($post->ID, 'ru'), 'discont-vdnh', true);
$isMonth = get_post_meta(pll_get_post($post->ID, 'ru'), 'ismonth', true);
$weeks = get_post_meta(pll_get_post($post->ID, 'ru'), 'weeks', true);


$parentCategoryList = get_the_category($post->ID);
$advancedTemplate = !get_post_meta($post->ID, 'advanced', true);

$segment_type = str_replace('_step1', '', $post->post_name);
$partsPrice = nicePrice(ceil($price / $weeks * 1.15));
$partsPriceOnline = nicePrice(ceil($priceOnline / $weeks * 1.15));
$verification = wp_create_nonce('ITEA_of_the_best!');
if (!empty($disOnline)) {
    $priceDisOnline = nicePrice(ceil($priceOnline * (100 - $disOnline) / 100));
}
if (!empty($dis_left)) {
    $priceDisLeft = nicePrice(ceil($price * (100 - $dis_left) / 100));
}
if (!empty($dis)) {
    $priceDis = nicePrice(ceil($price * (100 - $dis) / 100));
}
$h1_title = get_field('h1_title', $term);

?>
<h1 style='width:0;height: 0;visibility: hidden'><?php echo $h1_title; ?></h1>
<section class="new__template <?= $advancedTemplate ? 'advanced_template' : ''?>">
    <div class="header block">
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </div>
    <div class="block block--main">
        <div class="block__white"></div>
        <div class="container">
            <div class="block__main">
                <div class="block__main-content">
                    <div class="block__main-item">
                        <h2 class="title  title--xl block__main-title text-demi"><?php the_title(); ?></h2>
                        <p class="desc block__main-desc text-medium">
                            <?=get_post_meta($post->ID, 'sub_title', true)?>
                        </p>
                    </div>
                    <div class="block__main-item">
                        <div class="block__main-row block__main-row--top">
                            <div class="desc text-bold text-brand">СТАРТ</div>
                            <div class="block__main-col">
                                <div class="second-desc text-brand">
                                    <span class="text-bold">
                                        <?php
                                        if ($all_dates[0] == null) {
                                            echo($lang ? 'Дату уточните у администрации' : 'Старт курсу запитуйте в адміністрації');
                                        } else {
                                            echo $all_dates[0];
                                        }
                                        ?>
                                    </span>
<!--                                    — --><?//= $lang ? 'Берестейская' : 'Берестейська'; ?>
                                </div>
<!--                                <div class="second-desc text-brand">-->
<!--                                    <span class="text-bold">-->
<!--                                        --><?php
//                                        if ($all_dates_left[0] == null) {
//                                            pll_e("Дату уточните у администрации");
//                                        } else {
//                                            echo $all_dates_left[0];
//                                        }
//                                        ?>
<!--                                    </span> — --><?//= $lang ? 'Позняки' : 'Позняки'; ?><!--</div>-->
                            </div>
                        </div>
                        <div class="block__main-body">
                            <div class="block__main-row">
                                <div class="desc text-bold text-brand"><?php pll_e("ВРЕМЯ");?></div>
                                <div class="block__main-col">
                                    <div class="second-desc text-bold text-brand"><?= $course_during . ($lang ? ' час.' : ' год.'); ?></div>
                                    <div class="second-desc"><?php pll_e("по 2-3 раза в неделю");?></div>
                                    <?php
                                    $time_from = get_post_meta(pll_get_post($post->ID, 'ru'), 'time_from', true) || "19:00";
                                    $time_to = get_post_meta(pll_get_post($post->ID, 'ru'), 'time_to', true) || "22:00";
                                    ?>
                                    <div class="second-desc"><?php pll_e("с $time_from до $time_to");?> по МСК</div>
                                </div>
                            </div>
                            <div class="block__main-row">
                                <div class="desc text-bold text-brand"><?php pll_e("ЦЕНА");?></div>
                                <div class="block__main-col">
                                    <div class="tooltip__new">
                                        <div class="second-desc text-brand">
                                            <?php if (!empty($priceDis) || !empty($priceDisLeft) || !empty($priceDisOnline)):?>
                                                <span class="text-cross"><?=$priceOnline;?> </span>
                                                <span class="text-bold"><?= max($priceDis, $priceDisLeft, $priceDisOnline)?> тмт</span>
                                            <?php else:;?>
                                            <span class="text-bold"><?=$price?> тмт</span>
                                            <?php endif;?>
<!--                                            <span class="text-cross">2500 </span> <span class="text-bold">1500 тмт</span>-->
                                        </div>
                                        <div class="tooltip-icon" style="width: 18px; height: 18px;">
                                            <svg width="100%" height="100%" style="display:block;" viewBox="0 0 25 25"><g stroke="none" stroke-width="1.5" fill="none" fill-rule="evenodd"><g><g transform="translate(9.000000, 6.800000)"><path d="M3.48833774,8.19927008 C3.48833774,7.88872587 3.3487997,6.65099635 4.37688754,5.90659633 C5.69058476,4.88826489 7.04132628,4.41067505 7.04132628,2.75352263 C7.04132628,1.62587484 6.231817,0.131200155 4.07587217,0.0202534993 C2.22064757,-0.103393555 0.471623579,1.06713456 0.500349002,2.75352263" stroke="#000000"></path><ellipse fill="#000000" cx="3.5" cy="11.3" rx="1.2" ry="1.2"></ellipse></g></g></g></svg>
                                        </div>
                                        <div class="tooltip-text"><?php pll_e("Для юр. лиц цена указана без НДС");?></div>
                                    </div>
                                    <?php if(!empty($weeks)):?>
                                        <div class="second-desc"><?php pll_e("Оплата частями:");?></div>
                                        <?php if (!empty($priceDis) || !empty($priceDisLeft) || !empty($priceDisOnline)):?>
                                            <span class="second-desc text-bold"><?=nicePrice(ceil(max($priceDis, $priceDisLeft, $priceDisOnline) / $weeks * 1.15)) . 'тмт x' . $weeks?></span>
                                        <?php else:?>
                                            <span class="second-desc text-bold"><?=$partsPrice . 'тмт x' . $weeks?></span>
                                        <?php endif;?>
                                    <?php else:?>
                                        <div class="second-desc"><?php pll_e("Не предусмотрено");?></div>
                                    <?php endif;?>
<!--                                    text-brand-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block__main-controls">
                    <a  href="#contacts" class="btn block__main-btn"><?php pll_e("Записаться на курс");?></a>
                    <?php
                    if(empty(get_field('second_mail', $post__ID))){
                        $sideBar .= '<form action="' . get_permalink(12002) . '" method="POST">
                        <input type="hidden" name="course_id" value="' . $post->ID . '">
                        <input type="hidden" name="price" value="' . $price . '">
                        <input type="hidden" name="parts_price" value="' . $partsPrice . ' x' . $weeks . '">
                        <input type="submit" class="link link--black block__main-link" value="' . ($lang ? 'ПРОБНОЕ ЗАНЯТИЕ' : 'ПРОБНЕ ЗАНЯТТЯ') . '"></form>';
                           
                    } else {
                        $sideBar .= '<form action="' . get_permalink(12002) . '" method="POST">
                        <input type="hidden" name="course_id" value="' . $post->ID . '">
                        <input type="hidden" name="price" value="' . $price . '">
                        <input type="hidden" name="parts_price" value="' . $partsPrice . ' x' . $weeks . '">
                        <input type="submit" class="link link--black block__main-link" value="' . ($lang ? 'Получить запись занятия' : 'Отримати запис заняття') . '"></form>';
                    }
                    echo $sideBar;
                    ?>
                </div>
            </div>
            <div class="block__main-down">
                <img class="" src="<?php bloginfo('template_directory'); ?>/images/new_template/down.svg" alt="">
            </div>
            <img class="block__main-img" src="<?php bloginfo('template_directory'); ?>/images/new_template/boy.svg" alt="">
        </div>
    </div>
    <?php $youtubeIframe = get_post_meta($post->ID, 'youtube', true);
    if(empty($youtubeIframe)):?>
    <div class="block__about block block--brand">
        <div class="container">
            <div class="block__container">
                <div class="block__row">
                    <div class="block__item block__item--top">
                        <div class="second-title text-white text-demi"><?php pll_e("О курсе");?></div>
                    </div>
                    <div class="block__column">
                        <div class="second-desc second-desc--md text-medium text-white">
                            <?=get_post_meta($post->ID, 'about', true);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else:?>
    <div class="block__about block block--sub block--brand">
        <div class="container">
            <div class="block__container">
                <div class="block__row">
                    <div class="block__column">
                        <div class="second-title block__second-title block__second-title--left text-white text-demi"><?php pll_e("О курсе");?></div>
                        <div class="second-desc second-desc--md text-medium text-white">
                            <?=get_post_meta($post->ID, 'about', true);?>
                        </div>
                    </div>
                    <div class="block__video">
                        <div class="block__video-media">
                            <?=$youtubeIframe;?>
                        </div>
<!--                        <div class="small-desc block__video-small-desc text-white text-bold">Курс PHP — ITEA KIEV</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="block__who_is_course block <?= $advancedTemplate ? '' : 'block--brand'?>">
        <div class="container">
            <div class="block__container">
                <div class="second-title text-demi block__title <?= $advancedTemplate ? '' : 'text-white'?>">
                    <?php pll_e($advancedTemplate ? 'Для кого данный курс' : 'Требования к студентам')?>
                </div>
                <div class="block__row block__row--wrap">
                    <?php $count = 0; while (have_rows('who_is_course')): the_row();$count++;?>
                        <div class="block__item">
                            <div class="block__item-icon text-demi <?= $advancedTemplate ? '' : 'block__item-icon--light'?>"><?=$count;?></div>
                            <div class="block__item-info">
                                <div class="title block__item-title title--sm text-medium <?= $advancedTemplate ? '' : 'text-white'?>">
                                    <?php the_sub_field('title')?>
                                </div>
                                <div class="second-desc second-desc--md <?= $advancedTemplate ? '' : 'text-white'?>">
                                    <?php the_sub_field('text')?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            </div>
        </div>
    </div>
    <div class="block__what_learn">
        <div class="block block--sm <?= $advancedTemplate ? 'block--brand':''?>">
            <div class="container">
                <div class="block__container">
                    <div class="block__row">
                        <div class="block__element <?= $advancedTemplate ? 'block__element--white' : 'block__element--brand'?>">
                            <div class="title text-bold <?= $advancedTemplate ? '' : 'text-white'?> block__element-title"><?php pll_e("Чему вы научитесь?");?></div>
                            <div class="block__element-row">
                                <?php while (have_rows('what_learn')): the_row()?>
                                    <div class="block__element-col">
                                        <div class="desc desc--xs <?= $advancedTemplate ? '' : 'text-white'?>">
                                            <?php the_sub_field('text')?>
                                        </div>
                                    </div>
                                <?php endwhile;?>
                            </div>
                        </div>
                        <div class="block__element">
                            <div class="title text-bold <?= $advancedTemplate ? 'text-white' : ''?> block__element-title"><?php pll_e("Чего не будет");?></div>
                            <ul>
                                <li class="desc desc--dashed <?= $advancedTemplate ? 'text-white' : ''?>">
                                    <?php pll_e("Теории без практики");?>
                                </li>
                                <li class="desc desc--dashed <?= $advancedTemplate ? 'text-white' : ''?>">
                                    <?php pll_e("Устаревших механик работы");?>
                                </li>
                                <li class="desc desc--dashed <?= $advancedTemplate ? 'text-white' : ''?>">
                                    <?php pll_e("Пересказа чужих лекций и книг");?>
                                </li>
                                <li class="desc desc--dashed <?= $advancedTemplate ? 'text-white' : ''?>">
                                    <?php pll_e("Вопросов без ответа");?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block--sub <?= $advancedTemplate ? 'block--brand' : ''?>">
            <div class="container">
                <div class="second-desc second-desc--lg block__second-desc <?= $advancedTemplate ? 'text-white' : ''?> text-medium desc--center">
                    <?php pll_e("В рамках курса вы будете работать в группах над реальными проектами.<br>Это будет увлекательно и эффективно!");?>
                </div>
                <a href="#contacts" class="btn block__btn <?= $advancedTemplate ? 'btn--second' : ''?>">
                    <?php pll_e("Записаться на курс");?>
                </a>
            </div>
        </div>
    </div>

    <div class="block__course_include block">
        <div class="container">
            <div class="block__container">
                <div class="second-title text-demi block__title"><?php pll_e("Что включает курс?");?></div>
                <div class="block__list">
                    <div class="block__list-row">
                    <?php while (have_rows('course_include')): the_row();?>
                        <div class="block__list-col">
                            <div class="block__list-item">
                                <div class="desc desc--xs text-medium">
                                    <?php the_sub_field('text')?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block__training_program block <?= $advancedTemplate ? 'block--brand' : ''?>">
        <div class="container">
            <div class="block__container">
                <div class="text-bold second-title block__second-title <?= $advancedTemplate ? 'text-white' : ''?>">
                    <?php pll_e("Программа обучения");?>
                </div>
                <div class="desc text-bold <?= $advancedTemplate ? 'text-white' : ''?> block__desc">
                    <?php pll_e("Данный курс есть частью является частью программы");?>
                    <?php $count = 0; foreach ($parentCategoryList as $parentCategory):?>
                    <?php if ($count >= 1) { echo ", "; }?>
                        <a href="<?= get_category_link( $parentCategory->term_id ); ?>" class="link link--blue"><?= $parentCategory->name ?></a>
                    <?php $count++; endforeach;?>
                </div>
<!--                <div class="block__row block__row--between">-->
                    <?php $count = 0; while (have_rows('training_program')): the_row(); $count++;?>
                    <?php if($count === 1): ?>
                <div class="block__row block__row--wrap block__row--center">
                    <?php endif;?>
                    <?php if($count === 7): ?>
                            </div>
                        <button id="show"
                                class="<?= $advancedTemplate ? 'btn btn--second block__btn' : 'btn block__btn'?>"><?php pll_e("Показать всю программу");?></button>
                            <div id="text" class="hidden block__hidden block__row block__row--wrap block__row--center">
                        <?php endif;?>
                        <div class="block__card  <?= $advancedTemplate ? 'block__card--blue' : 'block__card--brand'?>">
                            <div class="block__card-header">
                                <div class="text-bold title title--xs text-white">
                                    <?php the_sub_field('title')?>
                                </div>
                            </div>
                            <div class="block__card-body">
                                <?php the_sub_field('list')?>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            </div>
        </div>
    </div>


<?php
$teachers = get_post_meta($post->ID, 'teachers', true);
if (!empty($teachers)):?>
    <div class="block__teachers">
        <div class="block block--sm <?= $advancedTemplate ? '' : 'block--brand'?>">
            <div class="container">
                <div class="block__container">
                    <div class="text-demi second-title block__second-title <?= $advancedTemplate ? '' : 'text-white'?>">
                        <?php pll_e("Преподаватели");?>
                    </div>
                    <div class="desc text-bold block__desc <?= $advancedTemplate ? '' : 'text-white'?>">
                        <?php pll_e("Сделайте первые шаги в обучении под руководством практикующих специалистов!");?>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block--sub <?= $advancedTemplate ? '' : 'block--brand'?>">
            <div class="container">
                <div class="block__container">
                    <div class="block__row block__row--wrap block__row--center">
                        <?php foreach ($teachers as $teacher):?>
                                <div class="block__card">
                                    <img class="block__card-photo" src="<?= get_the_post_thumbnail_url($teacher); ?>" />
                                    <div class="block__card-top <?= $advancedTemplate ? '' : 'block__card-top--light'?>">
                                        <a href="<?= get_the_permalink($teacher)?>" class="title title--sm block__card-title text-demi <?= $advancedTemplate ? '' : 'text-white'?>">
                                            <?= get_the_title($teacher); ?>
                                        </a>
                                        <div class="second-desc <?= $advancedTemplate ? '' : 'text-white'?>">
                                            <?=get_post_meta($teacher, 'Специальность', true);?>
                                        </div>
                                    </div>
                                    <div class="block__card-info">
                                        <div class="desc <?= $advancedTemplate ? '' : 'text-white'?>">
                                            <?=get_post_meta($teacher, 'О преподавателе', true);?>
                                        </div>
                                    </div>
                                </div>
                        <? endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

    <div class="block__employment block block--brand">
        <div class="container">
            <div class="text-bold second-title text-white block__second-title">
                <?php pll_e("Трудоустройство");?>
            </div>
            <div class="desc text-bold text-white block__desc" style="display: none!important;">
                <?php pll_e("Помогаем в трудоустройстве после прохождения комплексной программы обучения");?>
                <?php $count = 0; foreach ($parentCategoryList as $parentCategory):?>
                    <?php if ($count >= 1) { echo ", "; }?>
                    <a href="<?= get_category_link( $parentCategory->term_id ); ?>" class="link link--blue"><?= $parentCategory->name ?></a>
                    <?php $count++; endforeach;?>
            </div>
            <div class="desc text-bold text-white block__desc">
                <?php pll_e("Мы предоставляем нашим студентам возможность трудоустройства в компании-партнеры по их запросу. Также ITEA активно сотрудничает с платформой <a class='link link--blue' href='https://jungo.dev/'>Jungo</a>, которая помогает Junior-специалистам найти работу.Благодаря этому Вы получаете:");?>
            </div>

            <div class="block__row block__row--evenly">
                <div class="employment__block">
                    <svg xmlns="http://www.w3.org/2000/svg" id="_x31__x2C_5" height="80" viewBox="0 0 36 36" width="80"> <g> <path d="m4.167 8.377c0 6.917-3.583 11.667-3.583 15s1.916 10.333 17.249 10.333 17.583-9.417 17.583-13.083c.001-17.167-31.249-24.5-31.249-12.25z" fill="#efefef"/> </g> <g> <g> <path d="m29.875 1h1v2h-1z" fill="#a4afc1"/> </g> <g> <path d="m32.125 4h2v1h-2z" fill="#a4afc1"/> </g> </g> <g> <path d="m29.25 8.75v13.5c0 1.1-.9 2-2 2h-11.5l-5 5v-5h-2c-1.1 0-2-.9-2-2v-13.5c0-1.1.9-2 2-2h18.5c1.1 0 2 .9 2 2z" fill="#f3f3f1"/> </g> <g> <path d="m22.25 20.25h-8.5c-.552 0-1-.448-1-1v-4.5c0-.552.448-1 1-1h8.5c.552 0 1 .448 1 1v4.5c0 .552-.448 1-1 1z" fill="#2fdf84"/> </g> <g> <path d="m13 27v-2.75h-2c-1.1 0-2-.9-2-2v-13.5c0-1.1.9-2 2-2h-2.25c-1.1 0-2 .9-2 2v13.5c0 1.1.9 2 2 2h2v5z" fill="#d5dbe1"/> </g> <g> <path d="m15 19.25v-4.5c0-.552.448-1 1-1h-2.25c-.552 0-1 .448-1 1v4.5c0 .552.448 1 1 1h2.25c-.552 0-1-.448-1-1z" fill="#00b871"/> </g> <g> <path d="m10.75 30c-.097 0-.194-.019-.287-.057-.28-.116-.463-.389-.463-.693v-4.25h-1.25c-1.517 0-2.75-1.233-2.75-2.75v-13.5c0-1.517 1.233-2.75 2.75-2.75h18.5c1.517 0 2.75 1.233 2.75 2.75v13.5c0 1.517-1.233 2.75-2.75 2.75h-11.189l-4.78 4.78c-.144.144-.336.22-.531.22zm-2-22.5c-.689 0-1.25.561-1.25 1.25v13.5c0 .689.561 1.25 1.25 1.25h2c.414 0 .75.336.75.75v3.189l3.72-3.72c.141-.141.331-.22.53-.22h11.5c.689 0 1.25-.561 1.25-1.25v-13.499c0-.689-.561-1.25-1.25-1.25z"/> </g> <g> <path d="m22.25 21h-8.5c-.965 0-1.75-.785-1.75-1.75v-4.5c0-.965.785-1.75 1.75-1.75h8.5c.965 0 1.75.785 1.75 1.75v4.5c0 .965-.785 1.75-1.75 1.75zm-8.5-6.5c-.138 0-.25.112-.25.25v4.5c0 .138.112.25.25.25h8.5c.138 0 .25-.112.25-.25v-4.5c0-.138-.112-.25-.25-.25z"/> </g> <g> <path d="m21 13.75h-1.5v-1.5c0-.138-.112-.25-.25-.25h-2.5c-.138 0-.25.112-.25.25v1.5h-1.5v-1.5c0-.965.785-1.75 1.75-1.75h2.5c.965 0 1.75.785 1.75 1.75z"/> </g> <g> <path d="m12.75 16h10.5v1.5h-10.5z"/> </g> <g> <path d="m17.25 15h1.5v3.5h-1.5z"/> </g> </svg>
                     <div class="desc desc--xxs text-white text-demi">
                          <?php pll_e("Карьерную консультацию");?>
                    </div>
                </div>
                <div class="employment__block">
                    <svg xmlns="http://www.w3.org/2000/svg" id="_x31__x2C_5" height="80" viewBox="0 0 36 36" width="80"> <g> <path d="m8.377 4.167c6.917 0 11.667-3.583 15-3.583s10.333 1.916 10.333 17.249-9.417 17.583-13.083 17.583c-17.167.001-24.5-31.249-12.25-31.249z" fill="#efefef"/> </g> <g> <g> <path d="m27.5 4.5h1v2h-1z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 4.312 21.41)"/> </g> <g> <path d="m31.566 8.566h1v2h-1z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 2.628 25.476)"/> </g> <g> <path d="m26.823 9.066h2v1h-2z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 1.385 22.476)"/> </g> <g> <path d="m30.889 5h2v1h-2z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 5.451 24.16)"/> </g> </g> <g> <path d="m20.277 26.25h-11.527c-1.1 0-2-.9-2-2v-15.5c0-1.1.9-2 2-2h11.5c1.1 0 2 .9 2 2l.027 15.497c.001 1.105-.895 2.003-2 2.003z" fill="#f3f3f1"/> </g> <g> <circle cx="14.5" cy="11" fill="#2fdf84" r="1.25"/> </g> <g> <path d="m17.75 18v-1.25c0-1.105-.895-2-2-2h-2.5c-1.105 0-2 .895-2 2v1.25z" fill="#2fdf84"/> </g> <g> <path d="m27.34 22.75h-2.5s.47-.7.47-1.87c0-1.4-.7-2.11-1.17-2.11-.46 0-.95.48-.95 1.65 0 1.228-1.447 2.401-2.091 2.833-.174-.295-.481-.503-.849-.503h-.5c-.552 0-1 .448-1 1v4.5c0 .552.448 1 1 1h.5c.55 0 1-.45 1-1v-.01c.56.32 2.31 1.01 4.99 1.01h.51c.94 0 1.79-.68 1.94-1.6.01 0 .56-2.72.56-2.99 0-1.03-.84-1.91-1.91-1.91z" fill="#2fdf84"/> </g> <g> <path d="m9 24.25v-15.5c0-1.1.9-2 2-2h-2.25c-1.1 0-2 .9-2 2v15.5c0 1.1.9 2 2 2h2.25c-1.1 0-2-.9-2-2z" fill="#d5dbe1"/> </g> <g> <path d="m15.5 11c0-.19.049-.365.125-.526-.2-.425-.625-.724-1.125-.724-.69 0-1.25.56-1.25 1.25s.56 1.25 1.25 1.25c.5 0 .925-.299 1.125-.724-.076-.161-.125-.336-.125-.526z" fill="#00b871"/> </g> <g> <path d="m15.5 14.75h-2.25c-1.105 0-2 .895-2 2v1.25h2.25v-1.25c0-1.105.895-2 2-2z" fill="#00b871"/> </g> <g> <path d="m22 22.75h.5c.368 0 .675.208.849.503.528-.354 1.585-1.21 1.952-2.182.003-.064.009-.124.009-.191 0-1.4-.7-2.11-1.17-2.11-.46 0-.95.48-.95 1.65 0 .929-.827 1.825-1.51 2.395.102-.035.207-.065.32-.065z" fill="#00b871"/> </g> <g> <path d="m21 28.25v-4.5c0-.216.083-.405.199-.568-.032.023-.071.052-.1.071-.174-.295-.481-.503-.849-.503h-.5c-.552 0-1 .448-1 1v4.5c0 .552.448 1 1 1h.5c.383 0 .706-.225.874-.543-.072-.139-.124-.289-.124-.457z" fill="#00b871"/> </g> <g> <path d="m10 19.5h9v1.5h-9z"/> </g> <g> <path d="m10 22.5h6.02v1.5h-6.02z"/> </g> <g> <path d="m14.5 13c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-2.5c-.276 0-.5.224-.5.5s.224.5.5.5.5-.224.5-.5-.224-.5-.5-.5z"/> </g> <g> <path d="m18.5 18h-1.5v-1.25c0-.689-.561-1.25-1.25-1.25h-2.5c-.689 0-1.25.561-1.25 1.25v1.25h-1.5v-1.25c0-1.517 1.233-2.75 2.75-2.75h2.5c1.517 0 2.75 1.233 2.75 2.75z"/> </g> <g> <path d="m16.03 27h-7.28c-1.517 0-2.75-1.233-2.75-2.75v-15.5c0-1.517 1.233-2.75 2.75-2.75h11.5c1.517 0 2.75 1.233 2.75 2.75v7.27h-1.5v-7.27c0-.689-.561-1.25-1.25-1.25h-11.5c-.689 0-1.25.561-1.25 1.25v15.5c0 .689.561 1.25 1.25 1.25h7.28z"/> </g> <g> <path d="m20.25 30h-.5c-.965 0-1.75-.785-1.75-1.75v-4.5c0-.965.785-1.75 1.75-1.75h.5c.965 0 1.75.785 1.75 1.75v4.5c0 .965-.785 1.75-1.75 1.75zm-.5-6.5c-.138 0-.25.112-.25.25v4.5c0 .138.112.25.25.25h.5c.136 0 .25-.114.25-.25v-4.5c0-.138-.112-.25-.25-.25z"/> </g> <g> <path d="m26.75 30h-.51c-2.759 0-4.387-.694-5.112-1.108l.744-1.303c.479.274 1.865.911 4.368.911h.51c.584 0 1.111-.426 1.2-.971.005-.029.011-.058.019-.086.072-.31.509-2.511.532-2.811-.001-.611-.522-1.132-1.161-1.132h-2.5c-.277 0-.532-.153-.662-.397s-.115-.541.039-.771.343-.551.343-1.452c0-.897-.353-1.317-.481-1.368.042.029-.139.259-.139.908 0 1.674-1.624 2.87-2.322 3.306l-.795-1.272c.782-.488 1.617-1.279 1.617-2.034 0-1.658.854-2.4 1.7-2.4.944 0 1.92 1.07 1.92 2.86 0 .427-.053.803-.127 1.12h1.407c1.467 0 2.66 1.193 2.66 2.66 0 .093 0 .248-.29 1.739-.124.637-.208 1.072-.292 1.369l.012.002c-.207 1.272-1.359 2.23-2.68 2.23z"/> </g> </svg>
                     <div class="desc desc--xxs text-white text-demi">
                          <?php pll_e("Помощь в создании перспективного резюме");?>
                    </div>
                </div>
            </div>
            <div class="block__row block__row--evenly">
                <div class="employment__block">
                    <svg xmlns="http://www.w3.org/2000/svg" id="_x31__x2C_5" height="80" viewBox="0 0 36 36" width="80"> <g> <path d="m4.167 27.623c0-6.917-3.583-11.667-3.583-15s1.916-10.333 17.249-10.333 17.583 9.417 17.583 13.083c.001 17.167-31.249 24.5-31.249 12.25z" fill="#efefef"/> </g> <g> <g> <path d="m9.033 2.467h2v1h-2z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 .841 7.963)"/> </g> <g> <path d="m4.967 6.533h2v1h-2z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 -3.226 6.279)"/> </g> <g> <path d="m5.644 1.967h1v2h-1z" fill="#a4afc1" transform="matrix(.707 -.707 .707 .707 -.298 5.214)"/> </g> </g> <g> <path d="m28.25 10.75c.552 0 1 .448 1 1v11h-22.5v-11c0-.552.448-1 1-1z" fill="#f3f3f1"/> </g> <g> <path d="m6.75 22.75h22.5v2.5c0 .552-.448 1-1 1h-20.5c-.552 0-1-.448-1-1z" fill="#2fdf84"/> </g> <g> <path d="m19.75 26.25s.245 1.765 1.48 3h.02-6.5c1.25-1.25 1.48-3 1.48-3z" fill="#2fdf84"/> </g> <g> <path d="m20.75 16.25h-5.5v-8.25l5.5-1.25z" fill="#2fdf84"/> </g> <g> <path d="m20.75 7.261v-.511l-5.5 1.25v8.25h2.25v-8.25z" fill="#00b871"/> </g> <g> <path d="m10 10.75h-2.25c-.552 0-1 .448-1 1v11h2.25v-11c0-.552.448-1 1-1z" fill="#d5dbe1"/> </g> <g> <path d="m9 25.25v-2.5h-2.25v2.5c0 .552.448 1 1 1h2.25c-.552 0-1-.448-1-1z" fill="#00b871"/> </g> <g> <path d="m16.23 26.25s-.23 1.75-1.48 3h2.25c1.25-1.25 1.48-3 1.48-3z" fill="#00b871"/> </g> <g> <path d="m13 15.5h10v1.5h-10z"/> </g> <g> <path d="m28.25 27h-20.5c-.965 0-1.75-.785-1.75-1.75v-13.5c0-.965.785-1.75 1.75-1.75h4.25v1.5h-4.25c-.138 0-.25.112-.25.25v13.5c0 .138.112.25.25.25h20.5c.138 0 .25-.112.25-.25v-13.5c0-.138-.112-.25-.25-.25h-4.25v-1.5h4.25c.965 0 1.75.785 1.75 1.75v13.5c0 .965-.785 1.75-1.75 1.75z"/> </g> <g> <path d="m6.75 22h22.5v1.5h-22.5z"/> </g> <g> <path d="m21.25 30h-6.5c-.303 0-.577-.183-.693-.463s-.052-.603.163-.817c1.041-1.041 1.265-2.553 1.267-2.567l1.487.195c-.008.059-.147 1.066-.744 2.152h3.523c-.591-1.08-.738-2.088-.746-2.147l1.485-.208c.002.015.221 1.458 1.184 2.488.196.136.324.361.324.617 0 .414-.336.75-.75.75z"/> </g> <g> <path d="m21.5 16.25h-1.5v-8.561l-4 .909v7.651h-1.5v-8.249c0-.351.242-.653.584-.731l5.5-1.25c.222-.051.456.003.634.146.178.142.282.356.282.585z"/> </g> <g> <path d="m14.5 9.5h4v1.5h-4z"/> </g> <g> <path d="m14.5 12.5h4v1.5h-4z"/> </g> </svg>
                    <div class="desc desc--xxs text-white text-demi">
                         <?php pll_e("Доступ к рекомендательной системе повышения квалификации, которая поможет адаптировать ваши навыки под современный IT-рынок");?>
                    </div>
                </div>
                <div class="employment__block">
                    <svg xmlns="http://www.w3.org/2000/svg" id="_x31__x2C_5" height="80" viewBox="0 0 36 36" width="80"> <g> <path d="m8.377 4.167c6.917 0 11.667-3.583 15-3.583s10.333 1.916 10.333 17.249-9.417 17.583-13.083 17.583c-17.167.001-24.5-31.249-12.25-31.249z" fill="#efefef"/> </g> <g> <path d="m23.5 13c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5 1.5.673 1.5 1.5-.673 1.5-1.5 1.5zm0-2c-.275 0-.5.224-.5.5s.225.5.5.5.5-.224.5-.5-.225-.5-.5-.5z" fill="#a4afc1"/> </g> <g> <path d="m28.25 29.25h-8.5c-.552 0-1-.448-1-1v-4.5c0-.552.448-1 1-1h8.5c.552 0 1 .448 1 1v4.5c0 .552-.448 1-1 1z" fill="#2fdf84"/> </g> <g> <circle cx="11" cy="9" fill="#f3f3f1" r="2.25"/> </g> <g> <path d="m15.25 16.75c0-1.657-1.343-3-3-3h-2.5c-1.657 0-3 1.343-3 3v4.132c0 .379.214.725.553.894l.894.447c.339.169.553.516.553.894v5.132c0 .552.448 1 1 1h2.5c.552 0 1-.448 1-1v-5.132c0-.379.214-.725.553-.894l.894-.447c.339-.169.553-.516.553-.894z" fill="#f3f3f1"/> </g> <g> <path d="m11 9c0-.831.455-1.548 1.125-1.938-.332-.193-.713-.312-1.125-.312-1.243 0-2.25 1.007-2.25 2.25s1.007 2.25 2.25 2.25c.412 0 .793-.119 1.125-.312-.67-.39-1.125-1.107-1.125-1.938z" fill="#d5dbe1"/> </g> <g> <path d="m11 28.25v-5.132c0-.379-.214-.725-.553-.894l-.894-.447c-.339-.17-.553-.516-.553-.895v-4.132c0-1.657 1.343-3 3-3h-2.25c-1.657 0-3 1.343-3 3v4.132c0 .379.214.725.553.894l.894.447c.339.169.553.516.553.894v5.132c0 .552.448 1 1 1h2.25c-.552.001-1-.447-1-.999z" fill="#d5dbe1"/> </g> <g> <path d="m21 28.25v-4.5c0-.552.448-1 1-1h-2.25c-.552 0-1 .448-1 1v4.5c0 .552.448 1 1 1h2.25c-.552 0-1-.448-1-1z" fill="#00b871"/> </g> <g> <path d="m28.25 30h-8.5c-.965 0-1.75-.785-1.75-1.75v-4.5c0-.965.785-1.75 1.75-1.75h8.5c.965 0 1.75.785 1.75 1.75v4.5c0 .965-.785 1.75-1.75 1.75zm-8.5-6.5c-.138 0-.25.112-.25.25v4.5c0 .138.112.25.25.25h8.5c.138 0 .25-.112.25-.25v-4.5c0-.138-.112-.25-.25-.25z"/> </g> <g> <path d="m27 22.75h-1.5v-1.5c0-.138-.112-.25-.25-.25h-2.5c-.138 0-.25.112-.25.25v1.5h-1.5v-1.5c0-.965.785-1.75 1.75-1.75h2.5c.965 0 1.75.785 1.75 1.75z"/> </g> <g> <path d="m18.75 25h10.5v1.5h-10.5z"/> </g> <g> <path d="m23.25 24h1.5v3.5h-1.5z"/> </g> <g> <path d="m11 12c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm0-4.5c-.827 0-1.5.673-1.5 1.5s.673 1.5 1.5 1.5 1.5-.673 1.5-1.5-.673-1.5-1.5-1.5z"/> </g> <g> <path d="m12.25 30h-2.5c-.965 0-1.75-.785-1.75-1.75v-5.132c0-.095-.053-.181-.138-.224l-.895-.447c-.596-.298-.967-.898-.967-1.565v-4.132c0-2.068 1.683-3.75 3.75-3.75h2.5c2.067 0 3.75 1.682 3.75 3.75v4.132c0 .667-.371 1.267-.968 1.565l-.895.447c-.084.043-.137.129-.137.224v5.132c0 .965-.785 1.75-1.75 1.75zm-2.5-15.5c-1.24 0-2.25 1.009-2.25 2.25v4.132c0 .095.053.181.138.224l.895.447c.596.298.967.898.967 1.565v5.132c0 .138.112.25.25.25h2.5c.138 0 .25-.112.25-.25v-5.132c0-.667.371-1.267.968-1.565l.895-.447c.085-.042.138-.128.138-.224v-4.132c0-1.241-1.01-2.25-2.25-2.25z"/> </g> </svg>
                     <div class="desc desc--xxs text-white text-demi">
                          <?php pll_e("Первый опыт работы на стажировке/фрилансе/аутстаффинге, в том числе в и на зарубежных рынках");?>
                    </div>
                </div>
            </div>



           <div class="block__row block__row--between" style="display: none!important;">
                <div class="block__card">
                    <div class="block__card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="-29 0 441 441.74" width="100px"> <path d="m293.410156 361.46875v50.269531c0 16.570313-13.429687 30-30 30h-233.039062c-16.570313 0-30-13.429687-30-30v-311.46875c0-16.570312 13.429687-30 30-30h70v261.199219c0 16.570312 13.429687 30 30 30zm0 0" fill="#64b0ed"></path> <path d="m383.410156 89.671875v251.796875c0 16.570312-13.429687 30-30 30h-233.039062c-16.570313 0-30-13.429688-30-30v-311.46875c0-16.570312 13.429687-30 30-30h176l1 1.03125-1 .96875v71.371094c0 9 7.296875 16.300781 16.300781 16.300781h68.738281l1.03125-1zm0 0" fill="#ffffff"></path> <path d="m382.441406 88.671875-1.03125 1h-68.738281c-9.003906 0-16.300781-7.300781-16.300781-16.300781v-71.371094l1-.96875zm0 0" fill="#b2d3ed"></path> <g fill="#1040ac"> <path d="m328.191406 213.179688h-187.621094c-5.523437 0-10-4.476563-10-10 0-5.523438 4.476563-10 10-10h187.621094c5.523438 0 10 4.476562 10 10 0 5.523437-4.476562 10-10 10zm0 0"></path> <path d="m252.890625 157.238281h-112.320313c-5.523437 0-10-4.476562-10-10 0-5.519531 4.476563-10 10-10h112.320313c5.523437 0 10 4.480469 10 10 0 5.523438-4.476563 10-10 10zm0 0"></path> <path d="m328.191406 273.179688h-187.621094c-5.523437 0-10-4.476563-10-10 0-5.523438 4.476563-10 10-10h187.621094c5.523438 0 10 4.476562 10 10 0 5.523437-4.476562 10-10 10zm0 0"></path> </g> </svg>
                    </div>
                    <div class="desc desc--xxs desc--center text-white text-demi">
                        <?php pll_e("Поможем составить резюме и проверим результат");?>
                    </div>
                </div>
                <div class="block__card">
                    <div class="block__card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="-49 0 449 449.22" width="100"> <path d="m246.410156 353.390625v65.828125c-.007812 16.566406-13.433594 29.996094-30 30h-186c-16.570312 0-30-13.429688-30-30v-65.828125zm0 0" fill="#b2d3ed"></path> <path d="m246.410156 30v41.308594h-246v-41.308594c0-16.570312 13.429688-30 30-30h186c16.566406.0078125 29.992188 13.433594 30 30zm0 0" fill="#b2d3ed"></path> <path d="m.109375 61.609375h246v302h-246zm0 0" fill="#ffffff"></path> <path d="m246.410156 106.699219c59.847656 1.667969 107.015625 51.535156 105.347656 111.382812-1.601562 57.507813-47.84375 103.746094-105.347656 105.347657-1.050781.03125-2.101562.050781-3.148437.050781-12.84375.027343-25.578125-2.296875-37.582031-6.859375l-62.929688 11.027344 18.191406-42.347657c-16.75-19.507812-25.953125-44.371093-25.941406-70.082031.003906-59.953125 48.605469-108.554688 108.558594-108.558594.953125 0 1.902344.011719 2.851562.039063zm0 0" fill="#64b0ed"></path> <g fill="#1040ac"> <path d="m258.109375 200.609375h-61c-5.523437 0-10-4.476563-10-10s4.476563-10 10-10h61c5.523437 0 10 4.476563 10 10s-4.476563 10-10 10zm0 0"></path> <path d="m298.109375 240.609375h-101c-5.523437 0-10-4.476563-10-10s4.476563-10 10-10h101c5.523437 0 10 4.476563 10 10s-4.476563 10-10 10zm0 0"></path> </g> </svg>
                    </div>
                    <div class="desc desc--xxs desc--center text-white text-demi">
                        <?php pll_e("Подберем вакансии в партнерских компаниях и рекомендуем ваc");?>
                    </div>
                </div>
                <div class="block__card">
                    <div class="block__card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 -1 480.08011 480" width="100"> <path d="m382.601562.0390625c53.910157.0742185 97.554688 43.8398435 97.476563 97.7499995-.074219 53.910157-43.835937 97.554688-97.75 97.480469-11.5625.027344-23.03125-2.070312-33.839844-6.179687l-56.660156 9.941406 16.382813-38.140625c-15.070313-17.570313-23.355469-39.953125-23.359376-63.101563.003907-53.984374 43.765626-97.7460932 97.75-97.7499995zm0 0" fill="#2591f9"></path> <path d="m191.601562 387.890625v7.089844l-41.460937 33.847656-41.71875-33.847656v-7.089844l7.867187-24.851563.132813-.390624c21.890625 7.320312 45.648437 6.808593 67.207031-1.449219l.101563.269531zm0 0" fill="#edb288"></path> <path d="m247.199219 160.449219v109.171875c-.011719 54.773437-44.421875 99.164062-99.195313 99.152344-54.757812-.007813-99.144531-44.394532-99.152344-99.152344v-69.207032s47.597657 7.640626 83.308594-39.960937v-.058594c.660156.039063 1.320313.058594 1.980469.058594zm0 0" fill="#f7caa5"></path> <path d="m132.160156 170.390625v.058594c-35.710937 47.601562-83.308594 39.960937-83.308594 39.960937v-39.960937s6.75-49.070313 54.910157-48.347657c-8.082031 16.777344-1.03125 36.925782 15.746093 45.007813 3.960938 1.90625 8.261719 3.023437 12.652344 3.28125zm0 0" fill="#4b5d63"></path> <path d="m98.917969 121.988281c5.746093-11.941406 17.828125-19.535156 31.082031-19.527343h71.011719c38.097656-.003907 68.984375 30.878906 68.988281 68.980468v.007813h-140c-.675781 0-1.351562-.019531-2.027344-.058594-19.015625-1.117187-33.527344-17.4375-32.410156-36.453125.265625-4.496094 1.40625-8.890625 3.359375-12.949219zm0 0" fill="#3f5054"></path> <path d="m232.621094 389.015625h-41.019532l-41.460937 33.847656-41.71875-33.847656h-40.761719c-37.394531.027344-67.6874998 30.363281-67.660156 67.753906v.027344 21.21875h300v-21.21875c.171875-37.265625-29.898438-67.609375-67.160156-67.78125-.074219 0-.144532 0-.21875 0zm0 0" fill="#64b0ed"></path> <path d="m105.710938 266.019531c-14.871094-.003906-26.929688-12.058593-26.929688-26.929687v-4.230469c0-5.523437 4.476562-10 10-10s10 4.476563 10 10v4.230469c0 3.828125 3.101562 6.929687 6.929688 6.929687 3.824218 0 6.929687-3.101562 6.929687-6.929687v-4.230469c0-5.523437 4.476563-10 10-10s10 4.476563 10 10v4.230469c-.019531 14.867187-12.066406 26.914062-26.929687 26.929687zm0 0" fill="#edb288"></path> <path d="m190.339844 266.019531c-14.871094-.003906-26.925782-12.058593-26.929688-26.929687v-4.230469c0-5.523437 4.476563-10 10-10 5.523438 0 10 4.476563 10 10v4.230469c0 3.828125 3.105469 6.929687 6.929688 6.929687 3.824218-.007812 6.917968-3.105469 6.921875-6.929687v-4.230469c0-5.523437 4.476562-10 10-10 5.519531 0 10 4.476563 10 10v4.230469c-.015625 14.863281-12.058594 26.910156-26.921875 26.929687zm0 0" fill="#edb288"></path> <g fill="#1040ac"> <path d="m395 84.988281h-61c-5.523438 0-10-4.476562-10-10 0-5.519531 4.476562-10 10-10h61c5.523438 0 10 4.480469 10 10 0 5.523438-4.476562 10-10 10zm0 0"></path> <path d="m435 124.988281h-101c-5.523438 0-10-4.476562-10-10 0-5.519531 4.476562-10 10-10h101c5.523438 0 10 4.480469 10 10 0 5.523438-4.476562 10-10 10zm0 0"></path> </g> </svg>
                    </div>
                    <div class="desc desc--xxs desc--center text-white text-demi">
                        <?php pll_e("Предоставим поддержку и консультации при прохождении собеседований");?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="contacts" class="block__contacts block block--grey">
        <div class="container">




            <div class="block__container">
                <div class="text-demi second-title block__second-title">
                    <?php pll_e("Успей забронировать свое место в группе");?>
                </div>
                <div class="desc text-bold desc--center">
                    <?php pll_e("Выбери удобный формат");?>
                </div>
                <div class="block__controls">
                    <div class="tab block__tab" id="offline_open"><?php pll_e("Офлайн");?></div>
                    <div class="tab block__tab active" id="online_open"><?php pll_e("Онлайн");?></div>
                </div>


                <div id="offline" class="block__row block__row--reverse hidden">
                    <form method="POST"
                          class="block__form"
                          action="<?= esc_url(add_query_arg('action', 'regForEveningCourses', admin_url('admin-post.php'))) ?>">
                        <input type="hidden" name="verification"
                               value="<?= $verification; ?>">
                        <input type="hidden" name="sourceUuid" value="">

                        <input type="hidden" name="segment_type" value="b2c_order">
                        <input type="hidden" name="price" value="<?=$price;?>">
                        <input type="hidden" name="parts_price" value="<?=$partsPrice?> x<?=$weeks?>">
                        <input id="discountFromSite" type="hidden" name="discountFromSite" value="<?=$dis;?>">
                        <input type="hidden" name="course_id" value="<?= $post->ID; ?>">
                        <input type="hidden" name="format" value="OFFLINE">
                        <div class="block__formgroup">
                            <input type="text" name="name" placeholder="<?php pll_e("Ваше имя");?>" class="input">
                        </div>
                        <div class="block__formgroup">
                            <input type="text" name="mail" placeholder="<?php pll_e("Ваш E-mail");?>" class="input">
                        </div>
                        <div class="block__formgroup">
                            <div class="second-desc block__formgroup-second-desc">
                                <?php pll_e("Ваш номер телефона");?>
                            </div>
                            <input name="phone" type="tel" class="input">
                        </div>
                        <div class="block__formgroup" style="display:none;">
                            <div class="second-desc block__formgroup-second-desc">
                                <?php pll_e("Выберите локацию");?>
                            </div>
                            <select id="location_city" name="locationCourses" class="select">
                                <option class="select__icon" data-location="right" data-dis="<?=$dis?>" value="<?=$Uuid_right_band;?>" selected><?php pll_e("Берестейская");?></option>
<!--                                <option class="select__icon" data-location="left" data-dis="--><?//=$dis_left?><!--" value="--><?//=$Uuid_left_band;?><!--">--><?php //pll_e("Позняки");?><!--</option>-->
                            </select>
                        </div>
                        <input class="checkbox" type="checkbox" name="inputPrivacyPolicy">
                        <span class="small-desc">
                            <?php pll_e("Подписанием и отправкой этой заявки я подтверждаю, что я ознакомлен с Политикой конфиденциальности и принимаю её условия, включая регламентирующие обработку моих персональных данных, и согласен с ней. Я даю своё согласие на обработку персональных данных в соответствии с данной Политикой конфиденциальности");?>
                        </span>
                        <button type="submit" class="btn btn--sm block__form-btn">
                            <?php pll_e("Забронировать место");?>
                        </button>
                    </form>
                    <div class="block__section">
                        <div class="block__section-item">
                            <div class="third-title text-bold block__section-title">
                                <?php pll_e("Стоимость:");?>
                            </div>
                            <div id="block_price" class="block__section-element">
                            
                                <?php if (!empty($priceDis) || !empty($priceDisLeft) || !empty($priceDisOnline)):?>
                                    <span class="third-title text-cross text-grey block__section-text-cross"><?=$priceOnline;?> тмт</span>
                                    <div class="third-title text-brand"><?= max($priceDis, $priceDisLeft, $priceDisOnline)?> тмт</div>
                                <?php else:;?>
                                    <div class="third-title text-brand"> <?=$price?> тмт</div>
                                <?php endif;?>

                            </div>
                            <div id="block_price_left" class="block__section-element hidden">
                            <?php if (!empty($priceDis) || !empty($priceDisLeft) || !empty($priceDisOnline)):?>
                                    <span class="third-title text-cross text-grey block__section-text-cross"><?=$priceOnline;?> тмт</span>
                                    <div class="third-title text-brand"><?= max($priceDis, $priceDisLeft, $priceDisOnline)?> тмт</div>
                                <?php else:;?>
                                    <div class="third-title text-brand"> <?=$price?> тмт</div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="block__section-item">
                            <div class="third-title text-bold block__third-title"><?php pll_e("Что включает офлайн формат?");?></div>
                            <ul>
<!--                                <li class="desc block__section-desc desc--dashed">--><?php //pll_e("Занятия в одном из учебных центров на м.Позняки или м.Берестейская");?>
<!--                                </li>-->
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Готовый проект по окончании курса");?>
                                </li>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Помощь в трудоустройстве");?>
                                </li>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Сертификат об окончании курса");?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div id="online" class="block__row block__row--reverse">
                    <form method="POST"
                          class="block__form"
                          action="<?= esc_url(add_query_arg('action', 'regForEveningCourses', admin_url('admin-post.php'))) ?>">
                        <input type="hidden" name="verification"
                               value="<?= $verification; ?>">
                        <input type="hidden" name="segment_type" value="b2c_order">
                        <input type="hidden" name="price" value="<?=$priceOnline;?>">
                        <input type="hidden" name="sourceUuid" value="">
                        <input type="hidden" name="parts_price" value="<?=$partsPriceOnline?> x<?=$weeks?>">
                        <input type="hidden" name="locationCourses" value="<?=$Uuid_online_band;?>">
                        <input type="hidden" name="discountFromSite" value="<?=$disOnline;?>">
                        <input type="hidden" name="course_id" value="<?= $post->ID; ?>">
                        <input type="hidden" name="format" value="ONLINE">

                        <div class="block__formgroup">
                            <input type="text" name="name" placeholder="<?php pll_e("Ваше имя");?>" class="input">
                        </div>
                        <div class="block__formgroup">
                            <input type="text" name="mail" placeholder="<?php pll_e("Ваш E-mail");?>" class="input">
                        </div>
                        <div class="block__formgroup">
                            <div class="second-desc block__formgroup-second-desc">
                                <?php pll_e("Ваш номер телефона");?>
                            </div>
                            <input name="phone" type="tel" class="input">
                        </div>
                        <input class="checkbox" type="checkbox" name="inputPrivacyPolicy">
                        <span class="small-desc">
                            <?php pll_e("Подписанием и отправкой этой заявки я подтверждаю, что я ознакомлен с Политикой конфиденциальности и принимаю её условия, включая регламентирующие обработку моих персональных данных, и согласен с ней. Я даю своё согласие на обработку персональных данных в соответствии с данной Политикой конфиденциальности");?>
                        </span>
                        <button type="submit" class="btn btn--sm block__form-btn">
                            <?php pll_e("Забронировать место");?>
                        </button>
                    </form>

                    <div class="block__section">
                        <div class="block__section-item">
                            <div class="third-title text-bold block__section-title"><?php pll_e("Стоимость:");?></div>
                            <div class="block__section-element">
                            <?php if (!empty($priceDis) || !empty($priceDisLeft) || !empty($priceDisOnline)):?>
                                    <span class="third-title text-cross text-grey block__section-text-cross"><?=$priceOnline;?> тмт</span>
                                    <div class="third-title text-brand"><?= max($priceDis, $priceDisLeft, $priceDisOnline)?> тмт</div>
                                <?php else:;?>
                                    <div class="third-title text-brand"> <?=$priceOnline;?> тмт</div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="block__section-item">
                            <div class="third-title text-bold block__third-title"><?php pll_e("Что включает онлайн формат?");?></div>
                            <ul>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Обучение в формате просмотра стрима или записи занятий");?>
                                </li>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Готовый проект по окончании курса");?>
                                </li>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Помощь ментора курса");?>
                                </li>
                                <li class="desc block__section-desc desc--dashed"><?php pll_e("Личный кабинет с доступом к записи уроков");?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php $reviews = get_post_meta($post->ID, 'reviews', true); ?>
    <?php if (!empty($reviews)):?>
    <div class="block__reviews">
        <div class="block block--sm">
            <div class="container">
                <div class="text-demi second-title block__second-title">
                    <?php if (get_post_meta($post->ID, 'reviews_who', true) === 'graduate') {
                        pll_e("Что говорят наши выпускники");
                    } else {
                        pll_e("Что говорят наши работодатели");
                    } ?>
                </div>
                <div class="desc text-bold block__desc">
                    <?php if (get_post_meta($post->ID, 'reviews_who', true) === 'graduate') {
                        pll_e("Отзывы с ресурса");?>
                        <a href="https://dou.ua/" class="link link--brand">dou.ua</a>
                        <?php
                    } else {
                        pll_e("Отзывы о работе Карьерного центра ITEA");
                    } ?>
                </div>
            </div>
        </div>

            <div class="block block--sub">
                <div class="container">
                    <div class="block__container">
                        <div class="block__row block__row--wrap block__row--center">
                            <?php foreach ($reviews as $review):?>
                                <div class="block__feed">
                                    <img class="block__feed-photo" src="<?= get_the_post_thumbnail_url($review); ?>" />
                                    <div class="block__feed-info">
                                        <a href="<?=get_post_meta($review, 'url', true);?>" target="_blank" class="title--sm block__feed-title text-brand text-demi">
                                            <?= get_the_title($review); ?>
                                        </a>
                                        <div class="second-desc">
                                            <?= get_the_excerpt($review); ?>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach;?>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <?php endif;?>
    <?php $faqs = get_post_meta($post->ID, 'faqs', true); ?>
    <?php if (!empty($faqs)):?>
        <div class="block__faq block block--brand">
            <div class="container">
                <div class="block__container">
                    <div class="text-demi second-title text-white block__second-title">
                        <?php pll_e("Часто задаваемые вопросы");?>
                    </div>
                    <div class="block__row block__row--between">
                        <?php foreach ($faqs as $faq):?>
                            <div class="block__faq">
                                <div class="block__faq-header">
                                    <div class="desc text-medium text-white">
                                        <?= get_the_title($faq); ?>
                                    </div>
                                    <div class="block__faq-icon"></div>
                                </div>
                                <div class="second-desc block__faq-second-desc text-white">
                                    <?= get_the_excerpt($faq); ?>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

    <?php $seo = get_post_meta($post->ID, 'seo_html', true)?>
    <?php if (!empty($seo)):?>
    <div class="block__seo block block--grey">
        <div class="container">
            <div class="block__container">
                <div class="test">
                    <div id="pText" class="hideText small-desc block__small-desc">
                        <?=$seo;?>
                    </div>
                    <button id="btn1" class="btn btn--third"><?php pll_e("Показать весь текст");?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

</section>

<script>
    window.addEventListener('load', function(){
        //page-scroll
        window.addEventListener('scroll', function() {
            myFunction();
        })
        //page-scroll progress
        function myFunction() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;
            document.getElementById("myBar").style.width = scrolled + "%";
        }

        //accordeon if faq
        var acc = document.getElementsByClassName("block__faq-header");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("block__faq-header--active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = (panel.scrollHeight + 20) + "px";

                }
            });
        }
        $(".block__faq-header").on('click', function(){
            pText.classList.toggle('hideText');
            this.innerHTML.indexOf('Показать ') >-1 ?  this.innerHTML = "Свернуть" :
                this.innerHTML ="Показать весь текст";
        })
        $("#show").on('click', function () {
            $(this).hide()
            $("#text").removeClass('hidden')
        })
        //locations
        $("#location_city").on('change', function () {
            let _this = $(this).find(':selected'),
                dis = _this.attr('data-dis'),
                location = _this.attr('data-location');

            $("#discountFromSite").val(dis);

            switch (location) {
                case 'left':
                    $("#block_price").addClass('hidden')
                    $("#block_price_left").removeClass('hidden')
                    break;
                case 'right':
                    $("#block_price").removeClass('hidden')
                    $("#block_price_left").addClass('hidden')
                    break;
            }

        })
        //tabs//
        $("#offline_open").on('click', function (){
            $('#online').addClass('hidden')
            $('#offline_open').addClass('active')
            $('#online_open').removeClass('active')
            $('#offline').removeClass('hidden')
        })
        $("#online_open").on('click', function (){
            $('#online').removeClass('hidden')
            $('#offline_open').removeClass('active')
            $('#online_open').addClass('active')
            $('#offline').addClass('hidden')
        })
        $('.block__form').on('submit', function (e) {
            function checkVal (el, checkbox) {
                if (checkbox) {
                    if (!el.is( ":checked" )) {
                        el.addClass('error')
                        return false;
                    }
                } else {
                    if (!el.val()) {
                        el.addClass('error')
                        return false;
                    }
                }
                el.removeClass('error')
                return true;
            }
            let _this = $(this),
                name = _this.find('[name="name"]'),
                mail = _this.find('[name="mail"]'),
                phone = _this.find('[name="phone"]'),
                privacy = _this.find('[name="inputPrivacyPolicy"]'),
                submit = _this.find('button[type="submit"]');
            if (!checkVal(name) || !checkVal(mail) || !checkVal(phone) || !checkVal(privacy, true)) {
                e.preventDefault();
            } else {
                submit.attr('disabled', true);
            }
        })

    })
</script>
<?php
if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
    strpos($_SERVER['HTTP_USER_AGENT'],'Firefox')!==false ||
    strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false){ ?>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style_new_template.css">
<?php }else{ ?>
    <link rel="preload" href="<?php bloginfo('template_directory'); ?>/css/style_new_template.css" as="style" onload="this.onload=null;this.rel='stylesheet';">
<?php } ?>
