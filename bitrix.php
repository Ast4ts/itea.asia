<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 05.12.18
 * Time: 18:56
 */

require( dirname(__FILE__) . '/wp-load.php' );
include_once( dirname(__FILE__) . '/wp-content/themes/new-it/mr_sam/Services/Bitrix.php');
//  include( dirname(get_template_directory_uri()) . '/mr_sam/Services/OrderService.php');

//  var_dump( dirname(__FILE__));

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');



if (!empty($_GET['name']) && !empty($_GET['email']) && !empty($_GET['phone'])) {
    $bitrix = new Bitrix();
    $bitrix->createLeadBitrixFromGetcourse();
}

//  $service = new OrderService();
//  $service->sendTildaFormToCrmSymfony();

