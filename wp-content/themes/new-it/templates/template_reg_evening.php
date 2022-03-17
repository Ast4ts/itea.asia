<?php /* Template Name: Заявка на вечерний курс */ ?>
<?php
global $post;
$segment_type = str_replace('_step1', '', $post->post_name);

switch ($segment_type) {
    case 'b2c_order':
    case 'b2c_free':
    case 'b2c_first_lesson':
    case 'roadmap_order':
        break;
    default:
        wp_redirect(get_permalink(11993));
        exit;
}
?>
<?php
hideLangSwitchAndSetCorrectLang();
get_header();
$lang = (bool)stristr(get_locale(), 'ru');
?>

<?php
/**
 * @param $segmentType
 * @return string
 */
function getAttrActionAndIdForForm($segmentType)
{
    if ($segmentType == 'b2c_first_lesson') {
        return ' action="javascript:void(null);" id="for_payment" ';
    } else {
        return 'action="' . esc_url(add_query_arg('action', 'regForEveningCourses', admin_url('admin-post.php'))) . '"';
    }
}

$course_id = array_key_exists('course_id', $_POST) ? $_POST['course_id'] : 0;
$road_id = array_key_exists('road_id', $_POST) ? $_POST['road_id'] : 0;
$weeks = empty($_POST['parts_weeks']) ? '' : $_POST['parts_weeks'];

//if($segment_type == 'b2c_first_lesson'){
//    $_POST[ 'full_price' ] = 400;
//}

$subtitle = '';
$hidensInputs = array();
$hidensInputs[] = (empty($_POST['price']) ? '' : '<input type="hidden" 
    data-parts_weeks="' . $_POST['parts_weeks'] . '" 
    data-discount_right="' . $_POST['discount_right'] . '" 
    data-discount_left="' . $_POST['discount_left'] . '" 
    data-discount_vdnh="' . $_POST['discount_vdnh'] . '" 
    data-full_price="' . $_POST['full_price'] . '" 
    data-full_parts_price="' . $_POST['full_parts_price'] . '" 
    data-parts_price_left="' . $_POST['parts_price_left'] . '" 
    data-parts_price_right="' . $_POST['parts_price_right'] . '"
    data-parts_price_vdnh="' . $_POST['parts_price_vdnh'] . '" 
    data-price_left="' . $_POST['price_left'] . '" 
    data-price_right="' . $_POST['price_right'] . '" 
    data-price_vdnh="' . $_POST['price_vdnh'] . '" 
    name="price" value="' . (empty($_POST['full_price']) ? $_POST['price'] : $_POST['full_price']) . '">');
$hidensInputs[] = (empty($_POST['parts_price']) ? '' : '<input type="hidden" name="parts_price" value="' . $_POST['parts_price'] . '">');
$hidensInputs[] = (empty($_POST['location']) ? '' : '<input type="hidden" name="location_city" value="' . $_POST['location'] . '">');
$hidensInputs[] = (empty($_POST['full_price']) ? '' : '<input type="hidden" name="price" value="'.$_POST['full_price']. '">');
$hidensInputs[] = '<input type="hidden" name="discountFromSite" value="">';


//  $Uuid_right_band = 'e7f33e0e-9605-4f0b-8ed3-7de8cde053b7';
//  $Uuid_left_band = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0';
define('ITEA_PROD', (bool)($_SERVER['HTTP_HOST'] == 'itea.ua' || $_SERVER['SERVER_NAME'] == 'itea.ua'));
$Uuid_right_band = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
$Uuid_left_band = 'a21a5029-91b4-4971-bb24-29fbaeaa695c';
$Uuid_vdnh_band = 'd6272609-b556-4d4d-8cf4-6d72b4517181';

$bands = [
    'beresteyka' => [
        'title' => $lang ? 'Берестейская' : 'Берестейська',
        'uuid' => '1dbf8164-52df-41f4-bbbc-48b6fe762a57'
    ],
    'poznyaki' => [
        'title' => $lang ? 'Позняки' : 'Позняки',
        'uuid' => 'a21a5029-91b4-4971-bb24-29fbaeaa695c',
        'discount' => '-20%'
    ],
    'vdnh' => [
        'title' => $lang ? 'ВДНХ' : 'ВДНГ',
        'uuid' => '96523086-8ac6-49a3-be3e-0556af682452',
        'discount' => '-15%'
    ]
];

if (ITEA_PROD) {
    $Uuid_right_band = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
    $Uuid_left_band = 'ed944588-9ae7-45e2-8a2e-4482ee973cb0';
    $Uuid_vdnh_band = 'd6272609-b556-4d4d-8cf4-6d72b4517181';

    $bands = [
        'beresteyka' => [
            'title' => $lang ? 'Берестейская' : 'Берестейська',
            'uuid' => '1dbf8164-52df-41f4-bbbc-48b6fe762a57'
        ],
        'poznyaki' => [
            'title' => $lang ? 'Позняки' : 'Позняки',
            'uuid' => 'ed944588-9ae7-45e2-8a2e-4482ee973cb0',
            'discount' => '-20%'
        ],
        'vdnh' => [
            'title' => $lang ? 'ВДНХ' : 'ВДНГ',
            'uuid' => 'd6272609-b556-4d4d-8cf4-6d72b4517181',
            'discount' => '-15%'
        ]
    ];
}

switch ($segment_type) {
    case 'b2c_order':
    case 'b2c_free':
    case 'b2c_first_lesson':
        $hidensInputs[] = '<input type="hidden" name="course_id" value="' . $course_id . '">';

        if ($course_id) {
            $subtitle = get_the_title($course_id);
        }

        break;
    case 'roadmap_order':



        if ($road_id) {
            $hidensInputs[] = '<input type="hidden" 
                                name="road_id" value="' . $road_id . '" 
                                data-roadmap-full-price="' . $_POST['roadmap-full-price'] . '" 
                                data-roadmap-discount-price="' . $_POST['price'] . '" 
                                data-roadmap-part-price="' . $_POST['roadmap-part-price'] . '"
                                data-di-full="' . $_POST['roadmap-di-full'] . '">';
            $courseNames = array();
            if (array_key_exists('roadChoice_payOnce', $_POST)) {
                $courseSet = (array_key_exists('course-items', $_POST) ? $_POST['course-items'] : array());
                foreach ($courseSet as $id) {
                    $courseNames[] = get_the_title((int)$id);
                }
                $courseSet = implode(', ', $courseSet);
                $hidensInputs[] = '<input type="hidden" name="course-items" value="' . $courseSet . '">';
                $hidensInputs[] = '<input type="hidden" name="parts_price" value="' . $_POST['roadmap-part-price'] . ' x4">';
            } elseif (array_key_exists('roadChoice_payPart', $_POST)) {
                $courseSet = (array_key_exists('course-items', $_POST) ? $_POST['course-items'] : array());
                foreach ($courseSet as $id) {
                    $courseNames[] = get_the_title((int)$id);
                }
                $courseNames[] = 'в рассрочку';
                $courseSet = implode(', ', $courseSet);
                $hidensInputs[] = '<input type="hidden" name="course-items" value="' . $courseSet . '">';
                $hidensInputs[] = '<input type="hidden" name="parts_price" value="' . $_POST['roadChoice_parts_price'] . ' x4">';
            }
//        $hidensInputs[] = '<input type="hidden" name="price" value="' .$_POST['roadChoice_price']. '">';
            $courseNames = implode(', ', $courseNames);

            $subtitle .= get_cat_name($road_id) . (empty($courseNames) ? '' : ': ' . $courseNames);
        }

        $course_items = $_POST['course-items'];
//        echo var_dump($course_items);
//        $p = isset($_POST['price']) ? $_POST['price'] : '';

//    не знаю зачем этот код
        if (isset($course_items) && !empty($course_items) && gettype($course_items) == 'string') {

            unset( $hidensInputs );

            $hidensInputs[] = '<input type="hidden" data-roadmap-full-price="'.$_POST['full_price'] .'" data-roadmap-cousrse-list="1" data-roadmap-discount-price="'.$_POST['price'] .'" name="road_id"  value="'. $course_items . '">';


            foreach (getCoursesData($course_items) as $key=>$course){
                if($key !== 0){
                    $subtitle .= ' + ';
                }
                $subtitle .= $course['title'] ;

            }
            $hidensInputs[] = '<input type="hidden" name="course-items" value="'. $course_items . '">';
            $hidensInputs[] = '<input type="hidden" name="price" value="'. $_POST['price'] .'" data-roadmap-full-price="'. $_POST['full_price'] .'">';

        }

        break;


}

$hidensInputs = implode(' ', $hidensInputs);
?>

<section class="evening-form-reg">
    <div class="container">
        <div class="evening-form-reg__row">
            <?php

            if ($subtitle === ''): ?>
                <h1><?php echo $lang ? 'Форма записи на вечерний курс' : 'Форма запису на вечірній курс' ?></h1>
            
            
                <?php else: ?>
                <h1><?php echo $lang ? 'Форма записи на курс' : 'Форма запису на курс' ?> «<?php echo $subtitle; ?>»</h1>
          <?php  endif; ?>
        </div>
        <div class="evening-form-reg__row">
            <div class="evening-form-reg__left">
                <form method="POST" class="user-data-form" <?php echo getAttrActionAndIdForForm($segment_type); ?>>
                    <input type="hidden" name="verification"
                           value="<?php echo wp_create_nonce('ITEA_of_the_best!'); ?>">
                    <input type="hidden" name="sourceUuid" value="">
                    <input type="hidden" name="localvalue" value="<?php echo get_locale();?>">
                    <input type="hidden" name="segment_type" value="<?php echo $segment_type; ?>">
                    <?php
                    if (!($road_id + $course_id)  && !isset($course_items)) {
                        ?>
                        <input type="hidden" name="price" value="">
                    <?php } ?>
                    <?php echo(isset($hidensInputs) ? $hidensInputs : ''); ?>

                    <!--          <p class="b-courses-sing-up-hidden-tip">-->
                    <!--            --><?php //if ($lang) { ?>
                    <!--              Пожалуйста, заполните все обязательные поля формы-->
                    <!--            --><?php //} else { ?>
                    <!--              Будь ласка, заповніть всі обов'язкові поля форми-->
                    <!--            --><?php //} ?>
                    <!--          </p>-->

                    <div class="items">
                        <?php
                        if (!($road_id + $course_id) && !isset($course_items)) {
                            ?>
                            <div class="user-data-form__item group">
                                <div class="user-data-form__item-list">Курс *</div>
                                <div id="courses-list">
                                    <div class="courses-list-option-default">Выберите курс</div>
                                    <div class="courses-list-set">
                                        <input type="text" placeholder="Поиск">
                                        <input name="course" type="text" style="display: none;">
                                        <?php
                                        $posts = get_posts([
                                            'numberposts' => -1,
                                            'category' => '22',
                                            'post_type' => 'post',
                                            'post_status' => 'publish',
                                            'orderby' => 'title',
                                        ]);

                                        $options_id = [];
                                        foreach ($posts as $_post) {
                                            $options_id[] = $_post->ID;
                                            echo '<div class="courses-list-option">' . $_post->post_title . '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="user-data-form__item">
                            <label for="name">
                                <?php echo $lang ? 'Имя и Фамилия *' : 'Ім\'я і прізвище *' ?>
                            </label>
                            <input name="name" type="text" id="name" class="user-data-form__input-item">
                        </div>
                        <div class="user-data-form__item">
                            <label for="email">E-mail *</label>
                            <input name="mail" type="email" id="email" class="user-data-form__input-item">
                        </div>
                        <div class="user-data-form__item">
                            <label for="phone">Телефон *</label>
                            <input name="phone" type="tel" id="phone" class="user-data-form__input-item">
                        </div>
                        <div class="user-data-form__location location" style="display: none;">
                            <div class="title-label"> <?php echo $lang ? 'Выберите локацию *' : 'Виберіть локацію *' ?></div>
                            <div class="user-data-form__location-items">
                                <input type="radio" name="locationCourses" id="location1" checked
                                       value="<?php echo $Uuid_right_band; ?>">
                                <label class="location-item" for="location1">
                                    <span class="location-checked"></span>
                                    <div class="location-item__title"><?php echo $lang ? 'Берестейская' : 'Берестейська'; ?>
                                        <span class="location-item__discount location-item__discount-right"></span>
                                    </div>
                                </label>
<!--                                <input type="radio" name="locationCourses" id="location2"-->
<!--                                       value="--><?php //echo $Uuid_left_band; ?><!--">-->
<!--                                <label class="location-item" for="location2">-->
<!--                                    <span class="location-checked"></span>-->
<!--                                    <div class="location-item__title">--><?php //echo $lang ? 'Позняки' : 'Позняки'; ?><!--<span-->
<!--                                                class="location-item__discount location-item__discount-left"></span>-->
<!--                                    </div>-->
<!--                                </label>-->
<!--                                <input type="radio" name="locationCourses" id="location3"-->
<!--                                       value="--><?php //echo $Uuid_vdnh_band; ?><!--">-->
<!--                                <label class="location-item" for="location3">-->
<!--                                    <span class="location-checked"></span>-->
<!--                                    <div class="location-item__title">--><?php //echo $lang ? 'ВДНХ' : 'ВДНГ'; ?><!--<span-->
<!--                                                class="location-item__discount location-item__discount-left"></span>-->
<!--                                    </div>-->
<!--                                </label>-->
                            </div>
                        </div>


                        <!--            <div class="user-data-form__format format">-->
                        <!--              <div class="title-label"> -->
                        <?php //echo $lang ? 'Формат обучения *' : 'Форма навчання *'?><!--</div>-->
                        <!--              <div class="user-data-form__format-items">-->
                        <!--                <input type="radio" name="format" id="online" checked value="ONLINE">-->
                        <!--                <label class="format-item" for="online">-->
                        <!--                  <span class="format-checked"></span>-->
                        <!--                  <div class="format-item__title">--><?php //echo 'ONLINE' ?><!--</div>-->
                        <!--                </label>-->
                        <!--                <input type="radio" name="format" id="offline" value="OFFLINE">-->
                        <!--                <label class="format-item" for="offline">-->
                        <!--                  <span class="format-checked"></span>-->
                        <!--                  <div class="format-item__title">--><?php //echo 'OFFLINE'; ?><!--</div>-->
                        <!--                </label>-->
                        <!--              </div>-->
                        <!--            </div>-->

                        <?php
                        if ($road_id == 105 || $road_id == 226 ||
                            in_category(105, $course_id) || in_category(226, $course_id)) {
                            ?>
                            <div class="group">
                                <input name="name_of_child" type="text">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label><span class="red">* </span><?php echo $lang ? 'Имя ребенка' : "Ім'я дитини"; ?>
                                </label>
                            </div>
                            <div class="group">
                                <input name="age_of_child" type="text">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label><span
                                            class="red">* </span><?php echo $lang ? 'Возраст ребенка' : 'Вік дитини'; ?>
                                </label>
                            </div>
                        <?php } ?>
                        <div class="user-data-form__item user-data-form__item-comment">
                            <label><?php echo $lang ? 'Комментарий' : 'Коментар'; ?></label>
                            <textarea name="comment" type="text" class="user-data-form__input-item" rows="4"
                                      cols="50"> </textarea>

                        </div>
                        <div class="user-data-form__item user-data-form__item-button">
                                
                            <input type="submit" class="submit "
                            <?php if(!empty(get_field('first_mail',$_POST['course_id']))): ?>
                                value="<?php echo $lang ? 'Получить запись занятия' : 'Отримати запис заняття'; ?>">
                            <?php else:?>
                                   value="<?php echo $lang ? 'Записаться' : 'Записатися'; ?>">
                            <?php endif; ?>
                        </div>

                    </div>
                    <style>
                        #privacy-policy {
                            width: 100%;
                            display: flex;
                            margin-top: 25px
                        }

                        #privacy-policy > label {
                            padding-right: 10px;
                            box-sizing: border-box;
                            position: relative;
                            display: block;
                            top: 0;
                            left: 0;
                            margin: 0;
                        }

                        #privacy-policy > label > input {
                            display: none;
                        }

                        #privacy-policy > label > span {
                            display: block;
                            width: 20px;
                            height: 20px;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                            border-radius: 3px;
                            background-color: #ffffff;
                            border: 1px solid #010101;
                            position: relative;
                            cursor: pointer;
                        }

                        #privacy-policy > label > input.error + span {
                            border-color: #e61a4b;
                            box-shadow: 0 2px 10px rgba(230, 26, 75, 0.2);
                        }

                        #privacy-policy > label > input.error:checked + span {
                            border-color: #010101;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        }

                        #privacy-policy > label > span:after {
                            content: "";
                            position: absolute;
                            width: 11px;
                            height: 5px;
                            border: 2px solid #0bac7c;
                            border-top: 0;
                            border-right: 0;
                            top: 42%;
                            left: 50%;
                            -webkit-transform: translate(-50%, -50%) rotate(-45deg);
                            transform: translate(-50%, -50%) rotate(-45deg);
                            display: none;
                        }

                        #privacy-policy > label > input:checked + span:after {
                            display: block;
                        }

                        #privacy-policy > p, #privacy-policy > p > a {
                            font-size: 11px;
                            color: #606f7e;
                            line-height: 16px;
                        }

                        #privacy-policy > p > a {
                            color: #e61a4b;
                        }
                    </style>
                    <div class="user-data-form__item-policy">
                        <div id="privacy-policy" class="privacy-policy__wrapper">
                            <label for="input-privacy-policy">
                                <input type="checkbox" id="input-privacy-policy" name="inputPrivacyPolicy">
                                <span></span>
                            </label>
                            <p>
                                <?php
                                echo $lang ? 'Подписанием и отправкой этой заявки я подтверждаю, что я ознакомлен с <br><a href="/politika-konfidentsialnosti/" target="_blank">Политикой конфиденциальности</a> и принимаю её условия, включая регламентирующие обработку моих персональных данных, и согласен с ней. Я даю своё согласие на обработку персональных данных в соответствии с данной Политикой конфиденциальности.' :
                                    'Підписанням та надсиланням цієї заявки я підтверджую, що я ознайомлений з <br><a href="/uk/politika-konfidentsiynosti/" target="_blank">Політикою конфіденційності</a> і приймаю її умови, включно з регламентуючими обробку моїх персональних даних, і згоден з нею. Я надаю свою згоду на обробку персональних даних згідно з цією Політикою конфіденційності.';
                                ?>
                            </p>
                        </div>
                    </div>
                </form>

                <div class="evening-form-reg__price">
                    <div class="evening-form-reg__price-wrapper">
                        <div class="evening-form-reg__right-price">
                            <?php if ($segment_type == 'b2c_first_lesson'): ?>
                                <h3><?php echo $lang ? 'Цена пробного<br> занятия' : 'Ціна пробного<br> заняття' ?></h3>

                            <?php else: ?>
                                <h3><?php echo $lang ? 'Цена курса' : 'Ціна курса' ?></h3>
                            <?php endif; ?>
                            <?php

                            if ($subtitle !== '') {
                                ?>
                                <div class="evening-form-reg__right-price-block">
                                    <div class="right-full-price">
                                        <span class="right-full-price__course"></span>
                                        <span class="right-discount-full-price__course"> </span> тмт.
                                    </div>

                                    <?php if ($_POST['parts_weeks'] !== '') { ?>

                                        <div class="evening-part-price__title"><?php echo $lang ? 'Оплата по частям' : 'Оплата по частинам' ?></div>

                                        <div class="right-part-price">
                                            <span class="right-part-price__course"></span>
                                            <span class="right-discount-part-price__course"> </span> тмт. <span
                                                    class="partlyPay-x">x</span><span
                                                    class="partlyPay-weeks"><?php echo $weeks ?></span>
                                        </div>

                                    <?php } else { ?>
                                        <div class="right-part-price">
                                            <span class="not-found"><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="evening-form-reg__right-price-block  order-new-course">
                                    <div class="right-full-price">
                                        <span class="right-full-price__course"></span>
                                        <span class="right-discount-full-price__course"> </span> тмт.
                                    </div>
                                    <div class="evening-part-price__title"><?php echo $lang ? 'Оплата по частям' : 'Оплата по частинам' ?></div>
                                    <?php if ($_POST['parts_weeks'] !== '') { ?>
                                        <div class="right-part-price">
                                            <span class="right-part-price__course"></span>
                                            <span class="right-discount-part-price__course"> </span> тмт. <span
                                                    class="partlyPay-x">x</span><span
                                                    class="partlyPay-weeks"><?php echo $weeks ?></span>
                                        </div>

                                    <?php } else { ?>
                                        <div class="right-part-price">
                                            <span class="not-found"><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
<!--                        <div class="evening-form-reg__right-phone">-->
<!--                            <a href="tel:+380445990179">+380 44 599 01 79</a>-->
<!--                            <p>--><?php //echo $lang ? 'Свяжитесь с нами, если у вас возникли вопросы или предложения' : 'Зв\'яжіться з нами, якщо у вас виникли питання або пропозиції' ?><!--</p>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
            <div class="evening-form-reg__right">
                <div class="evening-form-reg__right-top">
                <?php  if(!empty(get_field('first_mail',$_POST['course_id']))):  ?>
                <h1><?php echo $lang ? 'Оставь свои данные ' : 'Залиш свої дані' ?> </h1>
                <h4><?php echo $lang ? 'и мы вышлем тебе запись занятий, чтобы ты лично<br>убедился в эффективности наших курсов ' : 'і ми надішлемо тобі запис занять, щоб ти особисто <br> переконався в ефективності наших курсів' ?></h4>
                <?php else: ?>
                    
                    <ul>
                        <li class="test-level-evening"><?php echo $lang ? 'Тест на определение уровня' : 'Тест на визначення рівня' ?></li>
                        <li class="sertification-evening"><?php echo $lang ? 'Сертификат об окончании' : 'Сертифікат про закінчення' ?></li>
                        <li class="work-help-evening"><?php echo $lang ? 'Помощь в трудоустройстве' : 'Допомога в працевлаштуванні' ?></li>
                    </ul>
                    <ul>
                        <li class="wallet-evening"><?php echo $lang ? 'Возможность оплаты частями' : 'Можливість оплати частинами' ?></li>
                        <li class="train-evening"><?php echo $lang ? 'Стажировка в ИТ-компаниях лучшим студентам' : 'Стажування в ІТ-компаніях кращим студентам' ?></li>
                        <li class="disscount-evening"><?php echo $lang ? 'Скидка -10% на следующий курс' : 'Знижка -10% на наступний курс' ?></li>
                    </ul>
                    <?php endif;?>
                </div>
                <?php if(empty(get_field('first_mail',$_POST['course_id']))): ?>
                <div class="evening-form-reg__right-bottom">
                    <div class="evening-form-reg__right-price">


                        <?php if ($segment_type == 'b2c_first_lesson'): ?>
                            <h3><?php echo $lang ? 'Цена пробного<br> занятия' : 'Ціна пробного<br> заняття' ?></h3>

                        <?php else: ?>
                            <h3><?php echo $lang ? 'Цена курса' : 'Ціна курса' ?></h3>
                        <?php endif; ?>


                        <?php

                        if ($subtitle !== '') {
                            ?>

                            <div class="evening-form-reg__right-price-block">
                                <div class="right-full-price">
                                    <span class="right-full-price__course"></span>
                                    <!--TODO ціна пробного заняття не виводиться тут-->
                                    <span class="right-discount-full-price__course"></span> тмт.
                                </div>

                                <div class="evening-part-price__title"><?php echo $lang ? 'Оплата по частям' : 'Оплата по частинам' ?></div>
                                <?php if ($_POST['parts_weeks'] !== '') { ?>
                                    <div class="right-part-price">
                                        <span class="right-part-price__course"></span>
                                        <span class="right-discount-part-price__course"> </span> тмт. <span
                                                class="partlyPay-x">x</span><span
                                                class="partlyPay-weeks"><?php echo $weeks ?></span>
                                    </div>
                                <?php } else { ?>
                                    <div class="right-part-price">
                                        <span class="not-found"><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="evening-form-reg__right-price-block  order-new-course">
                                <div class="right-full-price">
                                    <span class="right-full-price__course"></span>
                                    <span class="right-discount-full-price__course"> </span> тмт.
                                </div>
                                <div class="evening-part-price__title"><?php echo $lang ? 'Оплата по частям' : 'Оплата по частинам' ?></div>
                                <?php if ($_POST['parts_weeks'] !== '') { ?>
                                    <div class="right-part-price">
                                        <span class="right-part-price__course"></span>
                                        <span class="right-discount-part-price__course"> </span> тмт. <span
                                                class="partlyPay-x">x</span><span
                                                class="partlyPay-weeks"><?php echo $weeks ?></span>
                                    </div>
                                <?php } else { ?>
                                    <div class="right-part-price">
                                        <span class="not-found"><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
<!--                    <div class="evening-form-reg__right-phone">-->
<!--                        <a href="tel:+380445990179">+380 44 599 01 79</a>-->
<!--                        <p>--><?php //echo $lang ? 'Свяжитесь с нами, если у вас возникли вопросы или предложения' : 'Зв\'яжіться з нами, якщо у вас виникли питання або пропозиції' ?><!--</p>-->
<!--                    </div>-->
                </div>
                

                <style>
                    .charity-text {
                        color: #133a54;
                        font-size: 16px;
                        font-weight: 400;
                        line-height: 24px;
                        margin-top: 20px;
                        margin-bottom: 20px;
                    }
                </style>
                <p class="charity-text">
                    <?= $lang ? '*5% от каждой оплаты переводится на счет благотворительного фонда "Наш мир"' : '*5% від кожної оплати переводиться на рахунок благодійного фонду "Наш мир"' ?>
                </p>

            </div>
            <?php endif;?>
        </div>
    </div>
</section>
<script src="<?php bloginfo('template_directory'); ?>/js/form_evening_validation.js"></script>
<script>

    (function () {

        var list = document.querySelector('.courses-list-option-default');
        if (list){
            list.addEventListener('click', function (e) {
                toggleList();
            });
        }
        var inp = document.querySelector('#courses-list input'),
            options = document.querySelectorAll('#courses-list .courses-list-option'),
            data = <?php echo json_encode($options_id); ?>,
            responseItem = {};
        $('.order-new-course').hide();
        $('.user-data-form__location.location input[type=radio]').change(function () {
           if (Object.keys(responseItem).length === 0) {
               return;
           }
            if ($(this).val() === uuidRightBand) {
                if (responseItem['discont'] === '') {
                    $('.order-new-course .right-full-price__course').hide();
                    $('.order-new-course .right-part-price__course').hide();
                    $('input[name=discountFromSite]').val('');
                } else {
                    $('input[name=discountFromSite]').val(responseItem['discont']);
                    $('.order-new-course .right-full-price__course').text(responseItem['old_price']).show();
                    $('.order-new-course .right-part-price__course').text(responseItem['old_part_price']).show();
                }
                $('.order-new-course .right-discount-part-price__course').text(responseItem['new_part_price_right']).show();
                $('.order-new-course .right-discount-full-price__course').text(responseItem['price_right']).show();
                $('input[name=price]').val(responseItem['old_price']);
            } else if ($(this).val() === uuidVdnhBand) {
                if (responseItem['discont-vdnh'] == '') {
                    $('.order-new-course .right-full-price__course').hide();
                    $('.order-new-course .right-part-price__course').hide();
                    $('input[name=discountFromSite]').val('');
                } else {
                    $('input[name=discountFromSite]').val(responseItem['discont-vdnh']);
                    $('.order-new-course .right-full-price__course').text(responseItem['old_price']).show();
                    $('.order-new-course .right-part-price__course').text(responseItem['old_part_price']).show();
                }

                $('.order-new-course .right-discount-part-price__course').text(responseItem['new_part_price_left']).show();
                $('.order-new-course .right-discount-full-price__course').text(responseItem['price_vdnh']).show();
                $('input[name=price]').val(responseItem['old_price']);
            } else {
                if (responseItem['discont-left'] == '') {
                    $('.order-new-course .right-full-price__course').hide();
                    $('.order-new-course .right-part-price__course').hide();
                    $('input[name=discountFromSite]').val('');
                } else {
                    $('input[name=discountFromSite]').val(responseItem['discont-left']);
                    $('.order-new-course .right-full-price__course').text(responseItem['old_price']).show();
                    $('.order-new-course .right-part-price__course').text(responseItem['old_part_price']).show();
                }

                $('.order-new-course .right-discount-part-price__course').text(responseItem['new_part_price_left']).show();
                $('.order-new-course .right-discount-full-price__course').text(responseItem['price_left']).show();
                $('input[name=price]').val(responseItem['old_price']);
            }
        });

        function getRespondeItem(item) {

            $('.order-new-course').show();
            $('input[name=discountFromSite]').val(item['discont']);
            if ($(this).val() === uuidRightBand) {
                $('input[name=discountFromSite]').val(item['discont']);
            } else if ($(this).val() === uuidVdnhBand) {
                $('input[name=discountFromSite]').val(item['discont-vdnh']);
            } else {
                $('input[name=discountFromSite]').val(item['discont-left']);
            }
            if (item['discont'] == '') {
                $('.order-new-course .right-full-price__course').hide();
                $('.order-new-course .right-part-price__course').hide();
                $('.order-new-course .right-discount-part-price__course').text(item['old_part_price']);
                $('.order-new-course .right-discount-full-price__course').text(item['price_right']).show();
                $('.order-new-course .partlyPay-weeks').text(item['weeks']);
            } else if (item['discont-vdnh']) {
                $('input[name=discountFromSite]').val(item['discont-vdnh']);
                $('.order-new-course .right-full-price__course').text(item['old_price']).show();
                $('.order-new-course .right-part-price__course').text(item['old_part_price']).show();
                $('.order-new-course .right-discount-part-price__course').text(item['new_part_price_vdnh']).show();
                $('.order-new-course .right-discount-full-price__course').text(item['price_vdnh']).show();
                $('.order-new-course .partlyPay-weeks').text(item['weeks']);
            } else {
                $('input[name=discountFromSite]').val(item['discont-left']);
                $('.order-new-course .right-full-price__course').text(item['old_price']).show();
                $('.order-new-course .right-part-price__course').text(item['old_part_price']).show();
                $('.order-new-course .right-discount-part-price__course').text(item['new_part_price_right']).show();
                $('.order-new-course .right-discount-full-price__course').text(item['price_right']).show();
                $('.order-new-course .partlyPay-weeks').text(item['weeks']);
            }

            $('.not-found').remove();
            if (item['weeks'] === 0 || item['weeks'] === '') {
                $('.right-part-price').hide();
                $('.order-new-course').append('<div class="not-found"><?php echo $lang ? 'Не предусмотрено' : 'Не передбачено' ?></div>');
            } else {
                $('.not-found').remove();
                $('.right-part-price').show();
            }
        }

        for (var i = 0; i < options.length; i++) {
            (function (i) {
                options[i].addEventListener('click', function (e) {
                    document.querySelector('.courses-list-option-default').innerText = e.target.innerText;
                    toggleList();
                    document.querySelector('.courses-list-option-default').style.borderColor = 'rgb(19, 59, 84)';
                    (document.getElementById('courses-list')).classList.remove('survey_check_error');
                    document.querySelector('#courses-list input[name=course]').value = data[i];
                    // var response = [];
                    $.ajax({
                        url: '<?php echo admin_url("admin-ajax.php") ?>',
                        type: 'POST',
                        // dataType: "json",
                        data: ({
                            'action': 'my_action_callback',
                            'courseID': $('#courses-list input[name=course]').val()
                        }),
                        success: function (data) {
                            // response
                            var response = JSON.parse(data);
                            responseItem = JSON.parse(data);

                            $('input[name=price]').val(response['old_price']);
                            $('input[name=course_id]').val(response['ID']);

                            if (response['discont'] == '') {
                                $('.right-full-price__course').hide();
                                $('.right-part-price__course').hide();
                                $('.right-discount-part-price__course').text(response['old_part_price']);
                                $('.right-discount-full-price__course').text(response['price_right']).show();
                                $('.partlyPay-weeks').text(response['weeks']);
                            } else {
                                $('input[name=discountFromSite]').val(response['discont-left']);
                                $('.right-full-price__course').text(response['old_price']).show();
                                $('.right-part-price__course').text(response['old_part_price']).show();
                                $('.right-discount-part-price__course').text(response['new_part_price_right']).show();
                                $('.right-discount-full-price__course').text(response['price_right']).show();
                                $('.partlyPay-weeks').text(response['weeks']);
                            }

                            getRespondeItem(response);

                        },
                        error: function (errorThrown) {
                            console.log(errorThrown)
                        }
                    });
                });
            })(i)
        }

        inp.addEventListener('input', function (e) {
            //Search implementation on Course Name
            var reg = new RegExp(e.target.value, 'i');
            for (var key in options) {
                if (!options.hasOwnProperty(key)) continue;

                if (!reg.test(options[key].innerText)) {
                    options[key].style.display = 'none';
                } else {
                    options[key].style.display = 'block';
                }
            }
        });

        function toggleList() {
            $('.courses-list-set').toggleClass('active');
        }

        function setId(i) {
            return (function (id) {
                console.log(data[id]);
            })(i)
        }
    })();
</script>
<script>
    <?php if(ITEA_PROD){ ?>
    var uuidRightBand = '1dbf8164-52df-41f4-bbbc-48b6fe762a57';
    var uuidVdnhBand = 'd6272609-b556-4d4d-8cf4-6d72b4517181';
    <?php }else{ ?>
    var uuidRightBand = 'c5320dfe-7170-4fad-a524-420560355718';
    var uuidVdnhBand = '96523086-8ac6-49a3-be3e-0556af682452';
    <?php } ?>

    var currentPrice = $('input[name=price]');
    var currentPartPrice = $('input[name=parts_price]');

    var fullPrice = $(currentPrice).data('full_price');
    if (fullPrice == undefined) {
        fullPrice = currentPrice;
    }
    var fullPatrsPrice = $(currentPrice).data('full_parts_price');
    var leftBandPart = $(currentPrice).data('parts_price_right');
    var leftBandPrice = $(currentPrice).data('price_right');
    var rightBandPrice = $(currentPrice).data('price_left');
    var rightBandPart = $(currentPrice).data('parts_price_left');
    var vdnhBandPrice = $(currentPrice).data('price_vdnh');
    var vdnhBandPart = $(currentPrice).data('parts_price_vdnh');

    var discLeft = $(currentPrice).data('discount_left');
    var discRight = $(currentPrice).data('discount_right');
    var discVdnh = $(currentPrice).data('discount_vdnh');

    var roadmap = $('input[name=road_id]');

    // Full price and price with discount
    // console.log($('input[name=road_id]').data('roadmap-full-price'));
    // console.log($('input[name=price]').val());

    //
    if ($('input[name="location_city"]').length > 0) {
        if ($('.user-data-form input[name=location_city]').val() == uuidRightBand) {
            $('.user-data-form input#location1').click();
            $('input[name=discountFromSite]').val(discRight);
            if (discRight != '') {
                $('.right-full-price__course').text(fullPrice).show();
                $('.right-part-price__course').text(fullPatrsPrice).show();
            } else {
                $('.right-full-price__course').hide();
                $('.right-part-price__course').hide();
            }
        } else if ($('.user-data-form input[name=location_city]').val() == uuidVdnhBand) {
            $('.user-data-form input#location3').click();
            $('input[name=discountFromSite]').val(discVdnh);
            if (discVdnh != '') {
                $('.right-full-price__course').text(fullPrice).show();
                $('.right-part-price__course').text(fullPatrsPrice).show();
            } else {
                $('.right-full-price__course').hide();
                $('.right-part-price__course').hide();
            }
        } else {
            $('.user-data-form input#location2').click();

            $('input[name=discountFromSite]').val(discLeft);

            if (discLeft != '') {
                $('.right-full-price__course').text(fullPrice).show();
                $('.right-part-price__course').text(fullPatrsPrice).show();
            } else {
                $('.right-full-price__course').hide();
                $('.right-part-price__course').hide();
            }
        }
    }

    // Roadmap courses
    // console.log(roadmap.data('di-full'));
    if ($('input[name=segment_type]').val() == 'roadmap_order') {
        if (roadmap.data('di-full') != '') {
            $('.right-discount-full-price__course').text($('input[name=road_id').data('roadmap-discount-price'));
            $('.right-full-price__course').text(roadmap.data('roadmap-full-price')).show();
            $('.right-full-price__course').show();
            //TODO если убрать эту проверку заявка отправляется с нулевой ценой
            if(roadmap.data('roadmap-full-price') !== undefined ) {
                $(currentPrice).val(roadmap.data('roadmap-full-price'));
            } else{
                $(currentPrice).val($('input[name=price]').val());
            }

            $('input[name=discountFromSite]').val(roadmap.data('di-full'));
        } else {
            $('.right-full-price__course').hide();
            $('.right-discount-full-price__course').text($('input[name=road_id').data('roadmap-full-price'));
        }
        $('.right-part-price__course').hide();
        $('.right-discount-part-price__course').text(roadmap.data('roadmap-part-price')).show();
        $('.partlyPay-weeks').text('4');
    } else {
        if ($('.user-data-form input[name=location_city]').val() == uuidRightBand) {
            $('.right-discount-full-price__course').text(leftBandPrice);
            $('.right-discount-part-price__course').text(leftBandPart);
        } else if ($('.user-data-form input[name=location_city]').val() == uuidVdnhBand) {
            $('.right-discount-full-price__course').text(vdnhBandPrice);
            $('.right-discount-part-price__course').text(vdnhBandPart);
        } else {
            $('.right-discount-full-price__course').text(rightBandPrice);
            $('.right-discount-part-price__course').text(rightBandPart);
        }
    }
    if ($('input[name=segment_type]').val() == 'b2c_first_lesson') {
        $('.evening-form-reg__right-price .right-full-price__course').hide();
        $('.evening-form-reg__right-price .evening-part-price__title').hide();
        $('.evening-form-reg__right-price .right-part-price').hide();
        $('.right-discount-full-price__course').text(400);

    }
    //data-roadmap-cousrse-list
    if($('input[name=road_id]').data('roadmap-cousrse-list') === 1){
        $('.evening-form-reg__right-price .right-full-price__course').hide();
        $('.evening-form-reg__right-price .evening-part-price__title').hide();
        $('.evening-form-reg__right-price .right-part-price').hide();
    }



    //
    $('.user-data-form__location.location input[type=radio]').change(function () {
        if ($('input[name=segment_type]').val() == 'roadmap_order') {
            // $(currentPrice).val(currentPrice.val());
        } else if (fullPrice) {
            if ($(this).val() == uuidRightBand) {
                $('input[name=discountFromSite]').val(discRight);
                $('input[name=parts_price]').val(leftBandPart);
                // if (leftBandPrice) {
                //     $(currentPrice).val(leftBandPrice);
                // } else {
                    $(currentPrice).val(fullPrice);
                // }

                if (discRight != '') {
                    $('.right-full-price__course').text(fullPrice).show();
                    $('.right-part-price__course').text(fullPatrsPrice).show();
                } else {
                    $('.right-full-price__course').hide();
                    $('.right-part-price__course').hide();
                }
                $('.right-discount-full-price__course').text(leftBandPrice);
                $('.right-discount-part-price__course').text(leftBandPart);

            } else if ($(this).val() == uuidVdnhBand) {
                $('input[name=discountFromSite]').val(discVdnh);
                $('input[name=parts_price]').val(vdnhBandPart);

                  // if (vdnhBandPrice) {
                  //   $(currentPrice).val(vdnhBandPrice);
                // } else {
                    $(currentPrice).val(fullPrice);
                // }
                if (discVdnh != '') {
                    $('.right-full-price__course').text(fullPrice).show();
                    $('.right-part-price__course').text(fullPatrsPrice).show();
                } else {
                    $('.right-full-price__course').hide();
                    $('.right-part-price__course').hide();
                }
                $('.right-discount-full-price__course').text(vdnhBandPrice);
                $('.right-discount-part-price__course').text(vdnhBandPart);

            } else {
                $('input[name=discountFromSite]').val(discLeft);
                $('input[name=parts_price]').val(rightBandPart);

                  // if (rightBandPrice) {
                  //   $(currentPrice).val(rightBandPrice);
                // } else {
                    $(currentPrice).val(fullPrice);
                // }
                $('.right-discount-full-price__course').text(rightBandPrice);
                $('.right-discount-part-price__course').text(rightBandPart);
                if (discLeft != '') {
                    $('.right-full-price__course').text(fullPrice).show();
                    $('.right-part-price__course').text(fullPatrsPrice).show();
                } else {
                    $('.right-full-price__course').hide();
                    $('.right-part-price__course').hide();
                }
            }
        } else {
            // console.log('ok')
        }
    });

</script>
<?php
if ($segment_type == 'b2c_first_lesson'):
    ?>
    <form action="https://secure.platononline.com/payment/auth" method="post" class="hidden payment">
        <input type="hidden" name="payment" value=""/>
        <input type="hidden" name="key" value=""/>
        <input type="hidden" name="url" value=""/>
        <input type="hidden" name="data" value=""/>
        <input type="hidden" name="sign" value=""/>
        <input type="hidden" name="email" value=""/>
        <input type="hidden" name="phone" value=""/>
        <input type="hidden" name="ext1" value=""/>
        <input type="hidden" name="first_name" value=""/>
    </form>

    <script type="text/javascript">
        var callNew;
        $(document).ready(function () {
            callNew = function (e) {
                // console.log('sending');
                $.ajax({
                    method: 'POST',
                    url: window.location.protocol + '//' + window.location.host + '/wp-admin/admin-ajax.php?action=payment_order',
                    data: $('#for_payment').serialize(),
                    success: function (data) {
                        if (data == 'error') {
                            location.href = "<?php echo get_permalink(11993); ?>";
                        }
                        data = JSON.parse(data);
                        $('.payment input[name="key"]').val(data['key']);
                        $('.payment input[name="payment"]').val(data['payment']);
                        $('.payment input[name="url"]').val(data['url']);
                        $('.payment input[name="data"]').val(data['data']);
                        $('.payment input[name="sign"]').val(data['sign']);
                        $('.payment input[name="email"]').val(data['email']);
                        $('.payment input[name="locationCourses"]:checked').val(data['locationCourses']);
                        $('.payment input[name="phone"]').val(data['phone']);
                        $('.payment input[name="ext1"]').val(data['ext1']);
                        $('.payment input[name="first_name"]').val(data['first_name']);
                        // $('.payment').submit();
                        <?php if (empty(get_field('first_mail',$_POST['course_id']))): ?>
                        document.location.href = window.location.protocol + '//' + window.location.host + '/b2c_first_lesson/step2/';//data['redirect_link'];
                        <?php else: ?>
                        document.location.href = window.location.protocol + '//' + window.location.host + '/trial_thanks/';//data['redirect_link'];
                        <?php endif; ?>
                    },
                    error: function (xhr, str) {
                    }
                });
            };
            // look at form_validations_v4.js
        });
    </script>
    
    <?php endif; ?>
<?php get_footer(); ?>
