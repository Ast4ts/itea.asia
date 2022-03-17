<?php
    $api_key = '63a7487844a14af2a4541f1655bd6939';
    $list_id = '89568';
    $method  = 'listSubscribeOptInNow';
    $email   = $_POST['mailSub'];
    $parameters = "apikey=$api_key&list_id=$list_id&email=$email&phone=&mobilecountry=&fname=&lname=&names=&values=&optin=true&update_existing=true";

    $api_url = "http://api.feedgee.com/1.0/$method?$parameters&output=json";
    $result  = file_get_contents($api_url);

    $headers = 'From: ITEA  <iteaEvents@mail.gns-it.com>' . "\r\n";
    $headers.= 'Content-type: text/html; charset=utf-8';

    $text  = '<html><head><title>Новое сообщение</title><meta charset="utf-8"></head><body>';
    $text .= '<p>Запрос на подписку на рассылку по событиям от <b>'.$email.'</b></p>';
    $text .= '</body></html>';

    mail('nykolay@gns-it.com', 'Запрос на подписку на рассылку', $text, $headers);

    echo 'OK';
