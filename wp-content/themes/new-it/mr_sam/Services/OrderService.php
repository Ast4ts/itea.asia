<?php

require_once(__DIR__ . '/../Utils/LoggerUtil.php');
define('ITEA_PROD', (bool) ($_SERVER['HTTP_HOST'] == 'itea.asia' || $_SERVER['SERVER_NAME'] == 'itea.asia'));
define('ITEA_LOCAL', (bool) ($_SERVER['HTTP_HOST'] == 'itea.loc' || $_SERVER['SERVER_NAME'] == 'itea.loc'));
define('ITEA_DEV', (bool) ($_SERVER['HTTP_HOST'] == 'iteaua-develop.demo.gns-it.com' || $_SERVER['SERVER_NAME'] == 'iteaua-develop.demo.gns-it.com'));

require_once('OAuth2CrmAspNetService.php');

require_once('OAuth2CrmSymfonyService.php');
require_once('Bitrix.php');
require_once('OAuth2CrmSymfonyService_demo.php');
require_once('OAuth2CrmSymfonyService_dev.php');


class OrderService
{
    const TYPE_DAY = 'day';
    const TYPE_EVENING = 'evening';
    const TYPE_DEBUG = 'debug';

    private static $arrayKeyTranslation = [
        'segment_type'  => 'Сегмент',
        'name'          => 'Имя',
        'phone'         => 'Номер телефона',
        'mail'          => 'Эл. почта',
        'name_of_child' => 'Имя ребенка',
        'age_of_child'  => 'Возраст ребенка',
        'comment'       => 'Комментарий',
        'road_id'       => 'Roadmap',
        'course_id'     => 'Курс',
        'course'        => 'Курс',
        'course-items'  => 'Выборочно',
        'price'         => 'Полная стоимость',
        'parts_price'   => 'Оплата частями',
        'rental_date'   => 'Выбранная дата аренды',
        'user_selected_profession_IT' => 'Направление IT для консультации',
        'date_birth'    => 'День Рожденья',
        'id'            => 'Ссылка на резюме',
        'linkedin'      => 'Linkedin',
        'portfolio'     => 'Портфолио',
        'email'         => 'Эл. почта',

        'sum'           => 'sum',
        'roadmapUuid'   => 'roadmapUuid',
        'coursesUuid'   => 'coursesUuid',
        'trial'         => 'trial',
        'city'          => 'city',
        'locationCourses' => 'locationCourses',

        'format'      => 'format',
        'discountFromSite'  => 'discountFromSite'
    ];

    private $segmentType;
    private $segmentInfo = [
        'b2b_rent'         => ['redirect' => '11731', 'title' => 'Заявка на аренду помещения'],
        'b2b_order'        => ['redirect' => '6874',  'title' => 'Заявка на дневной курс'],
        'b2c_order'        => ['redirect' => '6868',  'title' => 'Заявка на вечерний курс'],
        'roadmap_order'    => ['redirect' => '7613',  'title' => 'Запись на комплекс курсов'],
        'b2c_free'         => ['redirect' => '6870',  'title' => 'Заявка на бесплатную консультацию'],
        'b2c_first_lesson' => ['redirect' => NULL,    'title' => 'Заявка на первое пробное занятие'],        // AJAX
        'callback_order' => ['redirect' => NULL,    'title' => 'Заказ обратного звонка для консультации'], // AJAX
        'consultation'     => ['redirect' => '12441', 'title' => 'Заявка на участие в акции и бесплатной консультации'],
    ];

    private $logger;

    /**
     * OrderService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $user_phone   = (array_key_exists('phone', $_POST) ? $_POST['phone'] : '');
        if(!empty($_POST['id'])){
            $user_email2   = (array_key_exists('email', $_POST)  ? $_POST['email']  : '');
        }else{
            $segment_type = (array_key_exists('segment_type', $_POST) ? $_POST['segment_type'] : '');
            $user_name    = (array_key_exists('name', $_POST)  ? $_POST['name']  : '');
            $user_email   = (array_key_exists('mail', $_POST)  ? $_POST['mail']  : '');
            $num_of_IDs   = array_key_exists('course_id', $_POST) + array_key_exists('road_id', $_POST);
        }

        $error = 0;
        @$error += empty($user_phone);
        if(!empty($_POST['id'])){
            @$error += empty($user_email2);
        }else {
            @$error += !array_key_exists($segment_type, $this->segmentInfo);
            @$error += $num_of_IDs > 1;
            @$error += empty($user_name);
            @$error += empty($user_email);
        }

        if ($_POST['city'] != 'kharkiv') {
            if ($error) {
                throw new Exception($error);
            } else {
                if(empty($_POST['id'])){
                    $this->segmentType = $segment_type;
                }
                $this->logger = new LoggerUtil;
            }
        }


//        $segment_type = (array_key_exists('segment_type', $_POST) ? $_POST['segment_type'] : '');
//        $user_name    = (array_key_exists('name', $_POST)  ? $_POST['name']  : '');
//        $user_phone   = (array_key_exists('phone', $_POST) ? $_POST['phone'] : '');
//        $user_email   = (array_key_exists('mail', $_POST)  ? $_POST['mail']  : '');
//        $num_of_IDs   = array_key_exists('course_id', $_POST) + array_key_exists('road_id', $_POST);
//
//        $error = 0;
//        @$error += !array_key_exists($segment_type, $this->segmentInfo);
//        @$error += $num_of_IDs > 1;
//        @$error += empty($user_name);
//        @$error += empty($user_phone);
//        @$error += empty($user_email);
//
//        if ($error) {
//            throw new Exception();
//        } else {
//            $this->segmentType = $segment_type;
//            $this->logger = new LoggerUtil;
//        }
    }

    /**
     * @return string
     */
    public function getSegmentType()
    {
        return $this->segmentType;
    }

    /**
     * @return string
     */
    public function getSegmentTitle()
    {
        return $this->segmentInfo[$this->segmentType]['title'];
    }

    /**
     * @return string
     */
    public function getRedirectId()
    {
        return $this->segmentInfo[$this->segmentType]['redirect'];
    }

    /**
     * @param string $str
     * @return string
     */
    private function getSendersLabel($str)
    {
        $stack = explode('_', $str);
        return (isset($stack[0]) ? $stack[0] : '');
    }

    /**
     * @return string
     */
    private function getTotalPrice()
    {
        $sumPrices = '';

        if (!empty($_POST['price'])) {
            $sumPrices = $_POST['price'];
        } elseif (!empty($_POST['parts_price'])) {
            $numbers = preg_split('/[\D]+/', $_POST['parts_price'], NULL, PREG_SPLIT_NO_EMPTY);

            if (count($numbers) >= 2)
            {
                $sumPrices = (int) $numbers[0] * (int) $numbers[1];
            }
        }

        return (string) $sumPrices;
    }

    /**
     * @param $course_id
     * @return string
     */
    private function getCourseUuid($course_id)
    {
        $uuid = get_post_meta(pll_get_post($course_id, 'ru'), 'uuid_for_itea_crm', true);
        return $uuid;
    }

    /**
     * @param $road_id
     * @return string
     */
    private function getRoadUuid($road_id)
    {
        $uuid = get_term_meta(pll_get_term($road_id, 'ru'), 'uuid_for_itea_crm', true);
        return $uuid;
    }

    /**
     * @param $road_id
     * @return array
     */
    private function getRoadCoursesUuid($road_id)
    {
        $coursesUuid = [];

        $roadCourses = get_posts([
            'numberposts' => -1,
            'cat' => pll_get_term($road_id, 'ru'),
        ]);

        foreach ($roadCourses as $course) {
            $coursesUuid[] = $this->getCourseUuid($course->ID);
        }

        return $coursesUuid;
    }

    /**
     * @param string $stack
     * @return string
     */
    private function id_price__to__name_price($stack)
    {
        $stack = explode(' | ', $stack);
        return get_the_title($stack[0]) . ' – ' . $stack[1] . ' тмт.';
    }

    /**
     * @param string $stack
     * @return array
     */
    private function id_price__to__uuid_price($stack)
    {
        $stack = explode(' | ', $stack);
        $uuid  = $this->getCourseUuid($stack[0]);
        return [$uuid => $stack[1]];
    }

    /**
     * @param string $stack
     * @return string
     */
    private function id_price__to__uuid($stack)
    {
        $uuid = $this->getCourseUuid((int) $stack);
        return $uuid;
    }

    /**
     * @param string $key
     * @param string $value
     * @return array
     */
    private static function _as($key, $value)
    {
        switch ($key) {
            case 'course_id':
                $value = (empty($value) ? 'не выбран' : get_the_title($value));
                break;
            case 'road_id':
                $value = (empty($value) ? 'не выбран' : get_cat_name($value));
                break;
            case 'course-items':
                $courseSet = explode(', ', $value);
                $courseSet = array_map('self::id_price__to__name_price', $courseSet);
                $value = implode(', ', $courseSet);
                break;
            case 'course':
                $value = (empty($value) ? '' : get_the_title($value));
                break;
        }

        if (array_key_exists($key, self::$arrayKeyTranslation)) {
            $key = self::$arrayKeyTranslation[$key];
        }

        return ['key' => $key, 'value' => $value];
    }

    /**
     * @param array $needles
     * @param array $outputArray
     * @return array
     */
    private function addNeedlesToArray($needles, $outputArray=[])
    {
        foreach ($needles as $key) {
            if (!empty($_POST[$key])) {
                $stack = self::_as($key, $_POST[$key]);
                $outputArray[] = "{$stack['key']}:{$stack['value']}";
            }
        }

        return $outputArray;
    }

    /**
     * @param string $segment
     * @param string $setting
     * @param array $messages
     * @return bool
     */
    public static function sendToEmail($segment, $setting = '', $messages = [])
    {
        $to = array();
        $subject = 'Новое письмо с сайта ITEA Киев';
        $messages = (array) $messages;

        switch ($setting) {
            case self::TYPE_EVENING:
                $to[] = 'miroslav@itea.ua';
                $to[] = 'nykolay@gns-it.com';
                $to[] = 'administration@itea.ua';
                $to[] = 'mirek.byk@gmail.com';
                $to[] = 'savchenko.kristina@itea.ua';
                $to[] = 'info@itea.asia';
                break;
            case self::TYPE_DAY:
                $to[] = 'miroslav@itea.ua';
                $to[] = 'nykolay@gns-it.com';
                $to[] = 'sales@itea.ua';
                $to[] = 'mirek.byk@gmail.com';
                $to[] = 'savchenko.kristina@itea.ua';
                $to[] = 'info@itea.asia';
                break;
            case self::TYPE_DEBUG:
            default:
                $to[] = 'nest@itea.ua';
                $to[] = 'serhiy.nikolskiy@gns-it.com';
                $to[] = 'eugene.mukhamedov@gns-it.com';
                $to[] = 'bogdan.illyashik@gns-it.com';
                $to[] = 'savchenko.kristina@itea.ua';
                $to[] = 'info@itea.asia';
                $messages[] = "SETTING : {$setting}";
        }

        $message  = '<html><head><title>Новое сообщение</title><meta charset="utf-8"></head><body>';
        foreach ($messages as $line) {
            $message .= "<p>{$line}</p>";
        }


        foreach ($_POST as $key => $value) {
            switch ($key) {
                case 'action':
                case 'verification':
                case 'rental_date_submit':
                    $message .= ($setting == 'debug' ? "<p>{$key}: {$value}</p>" : '');
                    break;
                case 'comment':
                    $message .= (empty($value) ? '' : "<p>Заявка сопровождалась комментарием: {$value}</p>");
                    break;
                default:
                    $stack = self::_as($key, $value);
                    $message .= "<p>{$stack['key']}: {$stack['value']}</p>";
            }
        }


        $roadmapUuid = '';
        $coursesUuid = [];

        if (!empty($_POST['road_id']) || !empty($_POST['course-items']) || !empty($_POST['course_id']) ) {
            $order_service = new OrderService();
            if (!empty($_POST['road_id']) && strpos($_POST['road_id'],"|") === false) {
                $roadmapUuid = $order_service->getRoadUuid($_POST['road_id']);

                if (!empty($_POST['course-items'])) {
                    $coursesUuid = array_map([$order_service, 'id_price__to__uuid'], explode(', ', $_POST['course-items']));
                } else {
                    $coursesUuid = $order_service->getRoadCoursesUuid($_POST['road_id']);
                }
            } elseif (!empty($_POST['course_id'])) {

                $coursesUuid[] = $order_service->getCourseUuid($_POST['course_id']);
            } else {

                $roadmapUuid = $_POST['road_id'];
            }
        }

        if (!empty($coursesUuid)) {
            $message .= '<p>Uuid Курса(ов): ' . implode($coursesUuid, ", ") . '</p>';
        }
        if (!empty($roadmapUuid)) {
            $message .= '<p>Uuid Роадмап: ' . $roadmapUuid . '</p>';
        }

        $message .= '<p>Время заявки: ' . date('d.m.Y , H:i:s') . '</p>';
        $message .= '<p>Отправленно с IP: ' . $_SERVER['REMOTE_ADDR'] . '</p>';
        $message .= '</body></html>';
        $headers[] = 'From: IT Education Academy ('.self::getSendersLabel($segment).") <{$segment}@itea.ua>";
        $headers[] = 'Content-Type: text/html; charset=utf-8';

//        $bitrix = new Bitrix();
//        $bitrix->createLeadBitrix('itea.ua', null, $message);

        if (ITEA_PROD) {
            $send_status = wp_mail(implode(',', $to), $subject, $message, $headers);
            return (bool) $send_status;
        } else {
            return TRUE;
        }
    }

    /**
     * @param array $arrayMessages
     */
    public function sendEmailEveningDepartment($arrayMessages=[])
    {
        //session_worm
        if(!isset($_SESSION)){
            session_start();
        }

        $arrayMessages = (array) $arrayMessages;
        $arrayMessages[] = $this->getSegmentTitle();

        $send_status = self::sendToEmail(
            $this->getSegmentType(),
            self::TYPE_EVENING,
            $arrayMessages
        );

//        $bitrix = new Bitrix();
//        $message = '';
//        foreach ($arrayMessages as $line) {
//            $message .= "<p>{$line}</p>";
//        }
//        $bitrix->createLeadBitrix('itea.ua Consultation', null, $message);

        if (!$send_status) {

            $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> IN method <b>sendEmailEveningDepartment()</b> of <i>OrderService.php</i> <small>do not working self::sendToEmail</small>";

            $this->logger->log('sendEmailEveningDepartment');
        }
    }

    public function sendEmailToUser () {
        $headers[] = 'From: IT Education Academy <noreply@itea.ua>';
        

        
            $messageForEmail = "Спасибо, что оставили заявку на обучение!
            Первый шаг на пути к заветной профессии сделан ;)
            Наш администратор скоро свяжется с вами, чтобы обсудить детали.
            А пока мы бы хотели рассказать подробнее о наших курсах.
            
            Вечерние занятия академии начинаются в 19:00 и заканчиваются в 22:00. Всё это время теория сразу же подкрепляется практическими задачами, что студенты могли лучше запомнить материал. И никакой начитки лекций!
            
            После каждого занятия преподаватель задаёт домашнее задание, выполнение которого — обязательный пункт. Студенты получают оценку за задание и развернутый фидбек. Самые популярные ошибки преподаватель открыто обсуждает со всеми студентами на следующем занятии.
            
            В ходе курса студенты получают профессиональные советы касательно выбранного направления: какие перспективы развития, где искать первые проекты, что ждать от работы в целом.
            
            Мы формируем небольшие группы — до 10-15 человек. Таким образом, преподаватель уделяет достаточно внимания каждому студенту, успевает внимательно проверить все задания и ответить на вопросы.
            
            Надеемся, вам понравится обучение в нашей академии.
            Будем рады способствовать развитию нового IT-специалиста!
            ";
            $send_status = wp_mail($_POST['mail'], 'Спасибо за заявку на itea.ua!', $messageForEmail, $headers);
       

    }

    /**
     * @param array $arrayMessages
     */
    public function sendEmailDayDepartment($arrayMessages=[])
    {
        $arrayMessages = (array) $arrayMessages;
        $arrayMessages[] = $this->getSegmentTitle();

        $send_status = self::sendToEmail(
            $this->getSegmentType(),
            self::TYPE_DAY,
            $arrayMessages
        );

        if (!$send_status) {
            $this->logger->log('sendEmailDayDepartment');
        }
    }

    /**
     * @param array $arrayMessages
     */
    public function checkAndReportByEmailWhenFail($arrayMessages=[])
    {
        if ( !$this->logger->isEmpty() ) {
            $arrayMessages = (array) $arrayMessages;

            self::sendToEmail(
                self::TYPE_DEBUG,
                self::TYPE_DEBUG,
                array_merge($this->logger->getAllLogs(), $arrayMessages)
            );
        }
    }

    /**
     * DEPRECATION | OUTDATED
     * @param string $ik_amount
     * @param string $ik_description
     * @return array
     */
    public function getDataSetForPayment($ik_amount, $ik_description)
    {
        $dataSet = array('ik_co_id' => '58d29eeb3c1eafae368b4567');

        $dataSet['ik_am']    = $ik_amount;
        $dataSet['ik_desc']  = $ik_description;
        $dataSet['ik_cur']   = 'UAH';
        $dataSet['ik_pm_no'] = preg_replace('/[^0-9]/', '', $_POST['phone']);
        $dataSet['ik_cli']   = $_POST['mail'];

        ksort($dataSet, SORT_STRING);
        array_push($dataSet, 'Sgk1Y7naXflS0ztW');
        $signString = implode(':', $dataSet);
        $signString = base64_encode(md5($signString, true));
        array_pop($dataSet);
        $dataSet['ik_sign'] = $signString;

        return $dataSet;
    }

    /**
     * @param string $description
     * @return array
     */
    public function getDataPlaton($description)
    {
        $data['first_name'] = $_POST['name'];
        $data['email'] = $_POST['mail'];
        $data['phone'] = $_POST['phone'];
        $data['ext1']  = 'Kiev';

        $pass = 'KdMwfTynqcfVh5dpPDMM7wJYYSBu7jX1';
        $data['key'] = '0K9HBL3KDB';
        $data['url'] = 'https://itea.ua/payment-success/';
        $data['data'] = base64_encode(json_encode([
            'amount'      => $_POST['mail'] === 'info@itea.ua' ? '1.00' : '200.00',
            'currency'    => 'UAH',
            'description' => $description,
        ]));
        $data['payment'] = 'CC';
        $data['sign'] = md5(strtoupper(
            strrev($data['key']).
            strrev($data['payment']).
            strrev($data['data']).
            strrev($data['url']).
            strrev($pass)
        ));

        return $data;
    }

    public function sendToCrmAspNet()
    {
        $needlesForApiComment = [
            'segment_type',
            'course-items',
            'course',
            'price',
            'parts_price',
            'name_of_child',
            'age_of_child',
            'comment',
            'user_selected_profession_IT',
        ];
        $apiComment = $this->addNeedlesToArray($needlesForApiComment);

        if (!empty($_POST['road_id'])) {
            $paramCourse = get_cat_name($_POST['road_id']);
        } elseif (!empty($_POST['course_id'])) {
            $paramCourse = get_the_title($_POST['course_id']);
        } else {
            $paramCourse = 'не выбран';
        }

        $params = [
            'ClientName'  => (string) $_POST['name'],
            'ClientEmail' => (string) $_POST['mail'],
            'ClientTel'   => (string) $_POST['phone'],
            'Course'      => (string) $paramCourse,
            'Location'    => 'Киев',
            'Date'        => date('d.m.y , H:i'),
            'Comment'     => (string) implode('; ', $apiComment)
        ];

        if (ITEA_PROD) {

            //session_worm
            if(!isset($_SESSION)){
                session_start();
            }
            try {
                $service = new OAuth2CrmAspNetService;

                $_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>sendOrder()</b> of function <b>sendToCrmAspNet()</b> in <i>OrderService.php</i>";
                $result  = $service->sendOrder($params);
                $_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>sendOrder()</b> of function <b>sendToCrmAspNet()</b> in <i>OrderService.php</i>";

                if (!$result->isSuccessCode()) {
//                    $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>isSuccessCode()</b> of function <b>sendToCrmAspNet()</b> in <i>OrderService.php</i>";
//                    $this->logger->log($result->getCodeAndMessage());
                }
            } catch (Exception $ex) {
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>catch()</b> of function <b>sendToCrmAspNet()</b> in <i>OrderService.php</i> | <small>".$ex->getMessage()."</small>";
                $this->logger->log($ex->getMessage());
            }
        }
    }

    public function sendToCrmSymfony()
    {
        $needlesForApiComment = [
            'segment_type',
            'course-items',
            'course',
            'price',
            'parts_price',
            'name_of_child',
            'age_of_child',
            'comment'
        ];
        $apiComment = $this->addNeedlesToArray($needlesForApiComment);

        $roadmapUuid = '';
        $coursesUuid = [];

        if (!empty($_POST['road_id'])) {
            $roadmapUuid = $this->getRoadUuid($_POST['road_id']);

            if (!empty($_POST['course-items'])) {
//            echo 1;
                $coursesUuid = array_map([$this, 'id_price__to__uuid'], explode(', ', $_POST['course-items']));
            } else {

//            echo 2;
                $coursesUuid = $this->getRoadCoursesUuid($_POST['road_id']);
            }
        } elseif (!empty($_POST['course_id'])) {
//          echo 3;
            $coursesUuid[] = $this->getCourseUuid($_POST['course_id']);
        }
//        echo var_dump($coursesUuid);
//        echo var_dump($roadmapUuid);
//      die();exit;
        $params = [
            'coursesUuid' => $coursesUuid,
            'roadmapUuid' => $roadmapUuid,
            'sum'         => $this->getTotalPrice(),
            'name'        => $_POST['name'],
            'phone'       => $_POST['phone'],
            'email'       => $_POST['mail'],
            'format'      => !empty($_POST['format'] && $_POST['format'] !== "") ? $_POST['format'] : "OFFLINE",
            'discountFromSite'      => $_POST['discountFromSite'],
            'filiation'             => $_POST['locationCourses'],
            'comment'     => (string)implode('; ', $apiComment) .' — '. (string)$_SERVER['HTTP_HOST'],
            'cityUuid'    => 'af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
            'courseType'  => 'INNER_EVENING',
            'sourceUuid'  => '',
        ];
        if (!empty($_POST['sourceUuid'])) {
            switch ($_POST['sourceUuid']) {
                case 'ppc':
                case 'google':
                    $params['sourceUuid'] = '40c4b34f-3169-4121-8d55-1154fe26964f';
                    break;
                case 'smm':
                case 'facebook':
                case 'instagram':
                case 'fb':
                    $params['sourceUuid'] = '6722603c-a86b-47a1-b75d-d76945ad6a7d';
                    break;
                case 'telegram':
                case 'tg':
                    $params['sourceUuid'] = '52617945-2f66-4ba3-8d1f-92759b147c78';
                    break;
                case 'dou':
                    $params['sourceUuid'] = 'a8a94c21-0c08-4fc0-a964-4528e5bd4da8';
                    break;
                case 'pr':
                    $params['sourceUuid'] = '82e7aba0-26de-4d1b-a609-59192fe8fe5c';
                    break;
                case 'pathfinder':
                    $params['sourceUuid'] = '26249377-9bff-4854-9e62-c74367541472';
                    break;
                case 'linkedin':
                    $params['sourceUuid'] = '6a394f56-f5e7-4051-a0b4-3814011379f6';
                    break;
                case 'digitaltest':
                case 'dt':
                    $params['sourceUuid'] = 'ee798910-1b99-4d07-bbd4-478f46884d1f';
                    break;
                case 'email':
                    $params['sourceUuid'] = '588439dc-d650-4b20-a5ee-22079374eebe';
                    break;
//                case 'instagram':
//                    $params['sourceUuid'] = 'b87ff1d0-36ec-4063-92a7-410c64e39e64';
//                    break;
                default:
                    $params['sourceUuid'] = '';
                    break;
            }
        }


        // FOR api.itea-crm-dev.demo.gns-it.com
        //$serviceDev = new OAuth2CrmSymfonyService_dev;
        //$resultDev  = $serviceDev->sendOrder($params);
        //if (!$resultDev->isSuccessCode()) {
        //    $this->logger->log($resultDev->getCodeAndMessage());
        //}

        if (ITEA_PROD) {

            // var_dump($params);die();
            //session_worm
            if(!isset($_SESSION)){
                session_start();
            }
            try {

                // $bitrix = new Bitrix();
                // $bitrix->createLeadBitrix('itea.ua', $this->getTotalPrice(), $params['comment']);

                $serviceProd = new OAuth2CrmSymfonyService;
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>serviceProd->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
                $resultProd = $serviceProd->sendOrder($params);
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>serviceProd->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";


                if (!$resultProd->isSuccessCode()) {
                    $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>resultProd->isSuccessCode()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i>";
                    $this->logger->log($resultProd->getCodeAndMessage());
                }

//          Необходимо продебажить почему перестало работать соединение с http://itea-crm-dev.demo.gns-it.com

//                $serviceProdDemo = new OAuth2CrmSymfonyService_demo;
////              var_dump($params);die;
//                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>serviceProdDemo->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
//                $resultProdDemo = $serviceProdDemo->sendOrder($params);
//                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>serviceProdDemo->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
//
//                if (!$resultProdDemo->isSuccessCode()) {
//                    $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>resultProdDemo->isSuccessCode()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i>";
//                    $this->logger->log($resultProdDemo->getCodeAndMessage());
//                }
            } catch (Exception $ex) {
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>catch()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i> | <small>".$ex->getMessage()."</small>";
                $this->logger->log($ex->getMessage());
            }
        } elseif (ITEA_DEV) {
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['session_dev'] = "DEV";
            try {
                $serviceProd = new OAuth2CrmSymfonyService_dev;
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>serviceProd->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
                $resultProd = $serviceProd->sendOrder($params);
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>serviceProd->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";


                if (!$resultProd->isSuccessCode()) {
                    $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>resultProd->isSuccessCode()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i>";
                    $this->logger->log($resultProd->getCodeAndMessage());
                }

//          Необходимо продебажить почему перестало работать соединение с http://itea-crm-dev.demo.gns-it.com

//                $serviceProdDemo = new OAuth2CrmSymfonyService_demo;
////              var_dump($params);die;
//                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>serviceProdDemo->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
//                $resultProdDemo = $serviceProdDemo->sendOrder($params);
//                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>serviceProdDemo->sendOrder()</b> in function <b>sendToCrmSymfony()</b> of <i>OrderService.php</i>";
//
//                if (!$resultProdDemo->isSuccessCode()) {
//                    $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>resultProdDemo->isSuccessCode()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i>";
//                    $this->logger->log($resultProdDemo->getCodeAndMessage());
//                }
            } catch (Exception $ex) {
                $_SESSION['session_worm'].="<br>&#9;&nbsp;".($_SESSION['worm_counter']++).") -> <font color='red'>ERROR</font> method <b>catch()</b> of function <b>sendToCrmSymfony()</b> in <i>OrderService.php</i> | <small>".$ex->getMessage()."</small>";
                $this->logger->log($ex->getMessage());
            }
        }
    }

    public function sendResumeToCrmSymfony(){
        $newUrlResume = get_permalink(7633) . '?id=' . $_POST['id'];
        $params = [
            'resume'        => $newUrlResume,
            'birthday'      => $_POST['date_birth'],
            'linkedin'      => $_POST['linkedin'],
            'portfolio'     => $_POST['portfolio'],
            'email'         => $_POST['email'],
            'phone'         => $_POST['phone'],
        ];
        if (ITEA_PROD) {
            try {
                $serviceProd = new OAuth2CrmSymfonyService;
                $resultProd = $serviceProd->sendResume($params);
                if (!$resultProd->isSuccessCode()) {
                    $this->logger->log($resultProd->getCodeAndMessage());
                }

//          Необходимо продебажить почему перестало работать соединение с http://itea-crm-dev.demo.gns-it.com

//                $serviceProdDemo = new OAuth2CrmSymfonyService_demo;
//                $resultProdDemo = $serviceProdDemo->sendResume($params);
//                if (!$resultProdDemo->isSuccessCode()) {
//                    $this->logger->log($resultProdDemo->getCodeAndMessage());
//                }
            } catch (Exception $ex) {
                $this->logger->log($ex->getMessage());
            }
        }
    }

    public function sendTildaFormToCrmSymfony(){
        if (empty($_POST['name']) && empty($_POST['phone'])) {return;}

        $params = [
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'name' => $_POST['name'],
            'sum' => $_POST['sum'],
            'roadmapUuid' => $_POST['roadmapUuid'],
            'coursesUuid' => explode(', ', $_POST['coursesUuid']),
            'trial' => $_POST['trial'],
            'discountFromSite' => $_POST['discountFromSite'],
            'comment' => $_POST['promo'],
            'format' => "OFFLINE",
        ];
        if ($_POST['city'] == 'kharkiv') {
            $params['filiation'] = "e40b166d-d281-4f54-954d-c1398ce027b9";
        } elseif ($_POST['city'] == 'online') {
            $params['filiation'] = "d55af967-e350-4797-964b-de46132ff119";
            $params['format'] = "ONLINE";
        } elseif ( empty($_POST['filiation']) ) {
            $params['filiation'] = "e7f33e0e-9605-4f0b-8ed3-7de8cde053b7";
            $params['format'] = "ONLINE";
        } else {
            switch ($_POST['filiation']) {
                case "м. ВДНГ":
                    case "м. ВДНХ":
                    $params['filiation'] = "d6272609-b556-4d4d-8cf4-6d72b4517181";
                    break;
                case "м. Позняки":
                    $params['filiation'] = "ed944588-9ae7-45e2-8a2e-4482ee973cb0";
                    break;
                case "м. Берестейська":
                case "м. Берестейськая":
                $params['filiation'] = "e7f33e0e-9605-4f0b-8ed3-7de8cde053b7";
                    break;
            }

        }
        $city = [
            'city'          => $_POST['city']
        ];

        if (ITEA_PROD) {
            try {
                $serviceProd = new OAuth2CrmSymfonyService;
                $resultProd = $serviceProd->sendTildaFormToCrmSymfony($params, $city);

                // $bitrix = new Bitrix();
                // $bitrix->createLeadBitrix('Tilda');

                if (!$resultProd->isSuccessCode()) {
//            $this->logger->log($resultProd->getCodeAndMessage());
                    $this->logger->log(implode(",", $params));
//            self::sendToEmail(
//              self::TYPE_DEBUG,
//              self::TYPE_DEBUG,
//              [$resultProd->getCodeAndMessage()]
//            );
                }

//                $serviceProdDemo = new OAuth2CrmSymfonyService_demo;
//                $resultProdDemo = $serviceProdDemo->sendResume($params);
//                if (!$resultProdDemo->isSuccessCode()) {
//                    $this->logger->log($resultProdDemo->getCodeAndMessage());
//                }
            } catch (Exception $ex) {
//          $this->logger->log($ex->getMessage());
                $this->logger->log(implode(",", $params));
//          self::sendToEmail(
//            self::TYPE_DEBUG,
//            self::TYPE_DEBUG,
//            [$ex->getMessage()]
//          );
            }
        }
    }

    public static function sendCallbackOrder()
    {
        $params = [
            'name'        => $_POST['name'],
            'phone'       => $_POST['phone'],
            'cityUuid'    => 'af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
        ];

        if (ITEA_PROD) {
            try {
                $serviceProd = new OAuth2CrmSymfonyService;
                $resultProd = $serviceProd->sendCallbackOrder($params);
                if (!$resultProd->isSuccessCode()) {
                    self::sendToEmail(
                        self::TYPE_DEBUG,
                        self::TYPE_DEBUG,
                        [$resultProd->getCodeAndMessage()]
                    );
                }
                // $bitrix = new Bitrix();
                // $bitrix->createLeadBitrix('itea.ua Callback', null);

//          Необходимо продебажить почему перестало работать соединение с http://itea-crm-dev.demo.gns-it.com

//                $serviceProdDemo = new OAuth2CrmSymfonyService_demo;
//                $resultProdDemo = $serviceProdDemo->sendCallbackOrder($params);
//                if (!$resultProdDemo->isSuccessCode()) {
//                    self::sendToEmail(
//                        self::TYPE_DEBUG,
//                        self::TYPE_DEBUG,
//                        [$resultProdDemo->getCodeAndMessage()]
//                    );
//                }
            } catch (Exception $ex) {
                self::sendToEmail(
                    self::TYPE_DEBUG,
                    self::TYPE_DEBUG,
                    [$ex->getMessage()]
                );
            }
        }
    }
}
