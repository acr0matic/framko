<?php

require 'required/Hmac.php';

$secret_key = '';
$headers = apache_request_headers();

$phone = $_POST['customer_phone'];
$email = $_POST['customer_email'];
$name = rawurlencode($_POST['customer_extra']);
$product = $_POST['products'][0]['name'];
$status = $_POST['payment_status'];

$api_key = '6topn3fqm3m9d5eekgnmkb3g5prz9npnmzb9iqco';

try {
  if (empty($_POST)) {
    throw new Exception('$_POST is empty');
  } elseif (empty($headers['Sign'])) {
    throw new Exception('signature not found');
  } elseif (!Hmac::verify($_POST, $secret_key, $headers['Sign'])) {
    throw new Exception('signature incorrect');
  }

  switch ($product) {
    case 'Тариф Стандарт':
      $list_id = 4;
      break;

    case 'Тариф Комфорт':
      $list_id = 5;
      break;

    case 'Тариф Комфорт +':
      $list_id = 6;
      break;

    case 'Тариф VIP':
      $list_id = 7;
      break;
  }

  http_response_code(200);
  $url = "https://api.unisender.com/ru/api/subscribe?format=json&api_key=$api_key&list_ids=$list_id&fields[email]=$email&fields[Name]=$name&double_optin=3&overwrite=0";

  if ($status == 'success') fopen($url, "r");
  echo 'success';
}

catch (Exception $e) {
  http_response_code($e->getCode() ? $e->getCode() : 400);
  printf('error: %s', $e->getMessage());
}

?>