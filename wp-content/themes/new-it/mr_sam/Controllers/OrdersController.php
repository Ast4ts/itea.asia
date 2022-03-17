<?php

require_once(__DIR__ . '/../Services/OrderService.php');
require_once(__DIR__ . '/../Models/HalloweenModel.php');
function sendEmailWithTrial($email,$course_id){
    get_post( intval($course_id) );
    $send_to = $email;
    $subject = 'Запись занятия «' . get_the_title( $course_id ) . '»';
    $headers = array('From: ITEA Online <noreply@onlineitea.com>');
    $headers[] = 'Content-Type: text/html; charset=utf-8';
    $message = get_field('first_mail', $course_id);
    wp_mail($send_to,$subject,$message,$headers);
}

function regForEveningCourses() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        //session_worm
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") Hi, I'm Session worm. I'll help you walk through the code." ;
        try {
            $service = new OrderService;

            //*****************************
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>sendEmailEveningDepartment()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i>";
            $service->sendEmailEveningDepartment();
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>sendEmailEveningDepartment()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i><br>";

            //******************************
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>sendToCrmAspNet()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i>";
            $service->sendToCrmAspNet();
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>sendToCrmAspNet()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i><br>";

            //******************************
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>sendToCrmSymfony()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i>";
            $service->sendToCrmSymfony();
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>sendToCrmSymfony()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i><br>";

            //*******************************
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='green'>BEFORE</font> method <b>checkAndReportByEmailWhenFail()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i>";
            $service->checkAndReportByEmailWhenFail();
            $_SESSION['session_worm'].="<br>&#9;".($_SESSION['worm_counter']++).") -> <font color='blue'>AFTER</font> method <b>checkAndReportByEmailWhenFail()</b> in function <b>regForEveningCourses()</b> of <i>OrderService.php</i><br>";
            if (empty(get_field('first_mail',$_POST['course_id']))){
                $service->sendEmailToUser();
            } else {
                $email = empty($_POST['mail']) ? $_POST['email'] : $_POST['mail'];
                sendEmailWithTrial($email,$_POST['course_id']);
                global $wpdb;
                        $wpdb->query("
                        INSERT table_cron (`courseID`, `userMAIL`) 
                        VALUES ( '" . $_POST['course_id'] ."',  '". $email . "');

                        ");
            }
            

            wp_redirect(get_permalink( $service->getRedirectId() )); exit;
        } catch (Exception $e) {}
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;
}
add_action('admin_post_nopriv_regForEveningCourses', 'regForEveningCourses', 10, 0);
add_action('admin_post_regForEveningCourses'       , 'regForEveningCourses', 10, 0);



function regForConsultation() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        try {
            $service = new OrderService;
            $service->sendEmailEveningDepartment();
            $service->sendToCrmAspNet();
            $service->checkAndReportByEmailWhenFail();

            wp_redirect(get_permalink( $service->getRedirectId() )); exit;
        } catch (Exception $e) {}
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;

}
add_action('admin_post_nopriv_regForConsultation', 'regForConsultation', 10, 0);
add_action('admin_post_regForConsultation'       , 'regForConsultation', 10, 0);

// ///////////////////
function regForResume() {
    try {
        $service = new OrderService;
        $service->sendResumeToCrmSymfony();

        wp_redirect( add_query_arg('id', $_POST['id'], get_permalink(7633)) );
        exit;
    } catch (Exception $e) {}
    exit;
}

// Send tilda form to crm
//function sendTildaFormToCrm()
//{
//  try {
////    OrderService::sendTildaFormToCrmSymfony();
//    $service = new OrderService;
//    $service->sendTildaFormToCrmSymfony();
//    exit;
//  } catch (Exception $e) {}
//  exit;
//}
//add_action('wp_ajax_nopriv_sendTildaFormToCrm', 'sendTildaFormToCrm', 10, 0);
//add_action('wp_ajax_nopriv_sendTildaFormToCrm', 'sendTildaFormToCrm', 10, 0);


function callback_order() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        $status_mail = OrderService::sendToEmail('callback_order', 'evening', ['Заказ обратного звонка для консультации']);
        OrderService::sendCallbackOrder();

         if (!$status_mail) {
             OrderService::sendToEmail(OrderService::TYPE_DEBUG);
         }
    }

    // echo(json_encode( array('status'=>'ok','request_vars'=>$_REQUEST) ));
    exit;
}
add_action('wp_ajax_nopriv_callback_order', 'callback_order', 10, 0);
add_action('wp_ajax_callback_order',        'callback_order', 10, 0);



function payment_order() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        try {
            $service = new OrderService;

            $course = empty($_POST['course_id']) ? '' : "'" . get_the_title($_POST['course_id']) . "'";
            $description = 'Первое занятие курса ' . $course;

            //$amount = '600'; // or add $typeOfPayment
            $_POST['Ожидаемая сумма'] = '600';

            $service->sendEmailEveningDepartment(['Оплата через сервис platononline.net']);
            $service->sendToCrmAspNet();
            $service->sendToCrmSymfony();
            $service->checkAndReportByEmailWhenFail();

            //$dataSet = $service->getDataSetForPayment($amount, $description);
            $data = $service->getDataPlaton($description);
            echo json_encode($data);
            exit;

        } catch (Exception $e) {}
    }
    echo 'error';
    exit;
}
add_action('wp_ajax_nopriv_payment_order', 'payment_order', 10, 0);
add_action('wp_ajax_payment_order',        'payment_order', 10, 0);



/**
 * action regForDayCourses
 * template_reg_day.php + template_reg_rent.php
 */
function regForDayCourses() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        try {
            $service = new OrderService;
            $service->sendEmailDayDepartment();
            $service->checkAndReportByEmailWhenFail();
            $service->sendEmailToUser();

            wp_redirect(get_permalink( $service->getRedirectId() )); exit;
        } catch (Exception $e) {}
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;
}
add_action('admin_post_nopriv_regForDayCourses', 'regForDayCourses', 10, 0);
add_action('admin_post_regForDayCourses'       , 'regForDayCourses', 10, 0);



function regForHalloween() {
    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        createOrUpdateHalloweenTable();

        $status = insertToHalloweenTable(
            $_POST['name'],
            $_POST['phone'],
            $_POST['mail'],
            $_POST['user_selected_profession_IT'],
            'Halloween'
        );
        if (!$status) {
            OrderService::sendToEmail(OrderService::TYPE_DEBUG);
        }

        wp_redirect(get_permalink(12441)); exit;
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;

}
add_action('admin_post_nopriv_regForHalloween', 'regForHalloween', 10, 0);
add_action('admin_post_regForHalloween'       , 'regForHalloween', 10, 0);



function regNewYear2018() {
    $ukr_version = $_COOKIE['pll_language'] == 'uk' || strripos($_SERVER['HTTP_REFERER'], 'uk/') !== false;

    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        createOrUpdateHalloweenTable();

        $status = insertToHalloweenTable(
            $_POST['name'],
            $_POST['phone'],
            $_POST['mail'],
            $_POST['user_selected_profession_IT'],
            $ukr_version ? 'NY2019_ukr' : 'NY2019_ru'
        );

        if (!$status) {
            OrderService::sendToEmail(OrderService::TYPE_DEBUG);
        }

        wp_redirect(get_permalink(!$ukr_version ? 13463 : 13631)); exit;
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;

}
add_action('admin_post_nopriv_regNewYear2018', 'regNewYear2018', 10, 0);
add_action('admin_post_regNewYear2018'       , 'regNewYear2018', 10, 0);


function regSpring2018() {
    $ukr_version = $_COOKIE['pll_language'] == 'uk' || strripos($_SERVER['HTTP_REFERER'], 'uk/') !== false;

    if ( wp_verify_nonce($_POST['verification'], 'ITEA_of_the_best!') )
    {
        createOrUpdateHalloweenTable();

        $status = insertToHalloweenTable(
            $_POST['name'],
            $_POST['phone'],
            $_POST['mail'],
            $_POST['user_selected_profession_IT'],
            $ukr_version ? 'Sp2018_ukr' : 'Sp2018_ru'
        );

        if (!$status) {
            OrderService::sendToEmail(OrderService::TYPE_DEBUG);
        }

        wp_redirect(get_permalink(!$ukr_version ? 14537 : 14542)); exit;
    }

    OrderService::sendToEmail(OrderService::TYPE_DEBUG);
    wp_redirect( get_permalink(11993) ); exit;

}
add_action('admin_post_nopriv_regSpring2018', 'regSpring2018', 10, 0);
add_action('admin_post_regSpring2018'       , 'regSpring2018', 10, 0);
