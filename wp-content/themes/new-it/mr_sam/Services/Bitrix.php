<?php

class Bitrix
{
    protected $apiBitrixUrl;
    public function __construct()
    {
        $this->apiBitrixUrl  = 'https://itea.bitrix24.ua/rest/1/dk0ao9qm5sguhga4/';
    }
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
    private function id_price__to__name_price($stack)
    {
        $stack = explode(' | ', $stack);
        return get_the_title($stack[0]) . ' – ' . $stack[1] . ' тмт.';
    }

    public function createLeadBitrix ($title = 'itea.ua', $price = null, $comment = null) {

        $comments = '';
//        if(!empty($_POST['roadmapUuid'])) $comments .= '<br> roadmapUuid = ' . $_POST['roadmapUuid'];
//        if(!empty($_POST['coursesUuid'])) $comments .= '<br> coursesUuid = ' . $_POST['coursesUuid'];
//        if(!empty($_POST['discountFromSite'])) $comments .= '<br> discountFromSite = ' . $_POST['discountFromSite'];
//        if(!empty($_POST['city'])) $comments .= '<br> city = ' . $_POST['city'];
//        if(!empty($comment)) $comments .= '<br> comment = ' . $comment;

        $dataPostKeys = [
//            'sourceUuid' => '',
            'location_city' => 'UF_CRM_1597823198',
            'location_courses' => 'UF_CRM_1597823213',
            'roadmap_uuid' => 'UF_CRM_1597823228',
            'format' => 'UF_CRM_1597823436',
            'coursesUuid' => 'UF_CRM_1597823284',

            'site url' => 'UF_CRM_1598864673',
            'сегмент' => 'UF_CRM_1597823271',
        ];
        $currency = "UAH";
//Сум - UZS
//Бел. рубль - BYN
//Евро - EUR
//Укр - UAH
//Казах - KZT
//Доллар - USD
//Руб - RUB


        $dataPostArr = [];


        $source_id = 15;//15 Сайт ITEA, 11 Звонок, 191 Tilda
        switch($title) {
            case 'Tilda':
            case 'tilda':
                $source_id = 191;
                $title = $_POST['host'];
                $currency = "USD";
                break;
            case 'itea.ua Callback':
                $source_id = 27;
                $title = $_POST['host'];
                break;
            case 'getcourse':
                break;
        };


        try {
            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case 'sourceUuid':
//                    break;
                    case 'location_city':
                    case 'location_courses':
                    case 'roadmap_uuid':
                    case 'format':
                        if (!empty($value) && !empty($dataPostKeys[$key])) {
                            $dataPostArr[$dataPostKeys[$key]] = $value;
                        }
                        $stack = self::_as($key, $value);
                        $comments .= "<p>{$stack['key']}: {$stack['value']}</p>";
                        break;
                    case 'action':
                    case 'verification':
                    case 'rental_date_submit':
                        $comments .= ($comments == 'debug' ? "<p>{$key}: {$value}</p>" : '');
                        break;
                    case 'comment':
                        $comments .= (empty($value) ? '' : "<p>Заявка сопровождалась комментарием: {$value}</p>");
                        break;
                    case 'coursesUuid':
                        global $wpdb;
                        $courseName = '';
                        if ($source_id !== 191) {
                            foreach(explode(', ', $value) as $item) {
                                $result = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE wp_postmeta.meta_value='$item'");
                                if (!empty($result)) {
                                    $courseName .= get_the_title($result[0]->post_id);
                                } else {
                                    $courseName .= $value;
                                }
                            }
                        } else {
                            $courseName = $value;
                        }

                        if (!empty($dataPostKeys[$key])) {
                            $dataPostArr[$dataPostKeys[$key]] = $courseName;
                        }
                        $comments .= "<p>Курс: $courseName</p>";
                        break;
                    default:
                        $stack = self::_as($key, $value);
                        $comments .= "<p>{$stack['key']}: {$stack['value']}</p>";
                }
            }
        } catch (Exception $e) {

        }

        $opportunity = $price;
        if (empty($opportunity)) {
            $opportunity = !empty($_POST['sum']) ? $_POST['sum'] : "";
        }
        $dataArr = array(
            'TITLE' => 'Заявка с ' .  $title,
            'STATUS_ID' => 'NEW',
            'SOURCE_ID' => $source_id,
            'NAME' => $_POST['name'],
            'PHONE' => array(array('VALUE' => $_POST['phone'], 'VALUE_TYPE' => 'WORK')),
            'EMAIL' => array(array('VALUE' => !empty($_POST['email']) ? $_POST['email'] : $_POST['mail'], 'VALUE_TYPE' => 'WORK')),
            'UTM_SOURCE' => !empty($_POST['sourceUuid']) ? $_POST['sourceUuid'] : "",
            'CURRENCY_ID' => $currency,
            'OPPORTUNITY' => $opportunity,
            'UF_CRM_1598864673' => !empty($_POST['host']) ? $_POST['host'] : '',
//                'UTM_MEDIUM' => $_POST['utm_medium'],
//                'UTM_CAMPAIGN' => $_POST['utm_campaign'],
//                'UTM_CONTENT' => $_POST['utm_content'],
//                'UTM_TERM' => $_POST['utm_term'],
            'COMMENTS' => $comments
        );


        $arLeadDuplicate = [];
        $lead_id = $this->checkDuplicate($dataArr['EMAIL'], 'EMAIL');
        if (!empty($lead_id)) {
            $dataArr['LEAD'] = array_merge($arLeadDuplicate, $lead_id);
        }
        $lead_id = $this->checkDuplicate($dataArr['PHONE'], 'PHONE');
        if (!empty($lead_id)) {
            $dataArr['LEAD'] = array_merge($arLeadDuplicate, $lead_id);;
        }

        if (!empty($_POST['employment'])) {
            $dataArr['SOURCE_ID'] = 'WEB';
            $dataArr['STATUS_ID'] = '13';
            $dataArr['TITLE'] = 'Працевлаштування itea.ua';
        }
        $data = array_merge($dataArr, $dataPostArr);

        $queryData = http_build_query(array(
            'fields' => $data,
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->apiBitrixUrl.'crm.lead.add.json',
            CURLOPT_POSTFIELDS => $queryData,
        ));

        $result = curl_exec($curl);
        curl_close($curl);


        $result = json_decode($result, 1);
    }

    public function createLeadBitrixFromGetcourse() {
        $title = 'Getcourse';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->apiBitrixUrl.'crm.lead.add.json',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'fields' => array(
                    'TITLE' => 'Заявка с ' . $title,
                    'STATUS_ID' => 'NEW',
//                    'SOURCE_ID' => 0,
                    'NAME' => $_GET['name'],
                    'PHONE' => array(array('VALUE' => $_GET['phone'], 'VALUE_TYPE' => 'WORK')),
                    'EMAIL' => array(array('VALUE' => $_GET['email'], 'VALUE_TYPE' => 'WORK')),
                    'UF_CRM_1598864673' => 'getcourse.ru',
//                    'UTM_SOURCE' => !empty($_POST['sourceUuid']) ? $_POST['sourceUuid'] : "",
//                'UTM_MEDIUM' => $_POST['utm_medium'],
//                'UTM_CAMPAIGN' => $_POST['utm_campaign'],
//                'UTM_CONTENT' => $_POST['utm_content'],
//                'UTM_TERM' => $_POST['utm_term'],
//                    'COMMENTS' => $comments
                ),
                'params' => array("REGISTER_SONET_EVENT" => "Y")
            )),
        ));

        $result = curl_exec($curl);
        // var_dump($result);
        curl_close($curl);
    }
    private function checkDuplicate($value, $type = "EMAIL", $entity_type = "LEAD") {
        // $type EMAIL, PHONE
        // $entity_type LEAD, CONTACT, COMPANY
        $data = array(
            'type' => $type,
            'entity_type' => $entity_type,
            'values' => [$value],
        );
        $queryData = http_build_query($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->apiBitrixUrl.'crm.duplicate.findbycomm',
            CURLOPT_POSTFIELDS => $queryData,
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        try {
            $result = json_decode($result);
            if (!empty($result->result->{$entity_type})) {
                $lead_id = $result->result->{$entity_type}; //[0] TODO: check what return array or int
                return $lead_id;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
