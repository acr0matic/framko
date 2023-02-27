<?php
require 'required/phpmailer/PHPMailer.php';
require 'required/phpmailer/SMTP.php';
require 'required/phpmailer/Exception.php';
require 'required/Hmac.php';

function SendMail($mail, &$status)
{
  if ($mail->send())
    $status = "Сообщение успешно отправлено";
  else
    $status = "Сообщение не было отправлено. Причина ошибки: " . $mail->ErrorInfo;
}

function FormatPhone($phone, $target = '')
{
  $formatted = str_replace(['(', ')', '-', ' ', ''], '', $phone);
  if ($target == 'telegram')
    return "%2B" . str_replace('+', '', $formatted);

  return $formatted;
}

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->SMTPKeepAlive = true;
$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->SMTPAuth = true;
$mail->isHTML(true);
$mail->Debugoutput = function ($str, $level) {
  $GLOBALS['status'][] = $str;
};

// Настройки вашей почты
$mail->Host = 'smtp.yandex.ru'; // SMTP сервера вашей почты
$mail->Username = ''; // Логин на почте
$mail->Password = ''; // Пароль на почте
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('', 'FRAMKO'); // от кого будет уходить письмо?

// -------------------------

$target = $_POST['target'];
$subject = $_POST['subject'];
$price = $_POST['price'];
$discount = $price - $_POST['discount'];

$first_name = (!empty($_POST['user_fn'])) ? $_POST['user_fn'] : 'Не указано';
$last_name = (!empty($_POST['user_ln'])) ? $_POST['user_ln'] : 'Не указана';
$user_phone = (!empty($_POST['user_phone'])) ? FormatPhone($_POST['user_phone']) : 'Не указан';
$user_email = (!empty($_POST['user_email'])) ? $_POST['user_email'] : 'Не указана';


// Формирование содержимого письма
$title = "Заявка с сайта framko.ru";
$body =
  "
    <html>
     <p>
      Контактная информация: <br> <br>
      <b>Имя: </b> $first_name <br>
      <b>Фамилия: </b> $last_name <br>
      <b>Электронная почта: </b> <a href='mailto:$user_email'>$user_email</a><br>
      <b>Телефон: </b>$user_phone <br><br>

      <b>Тариф: </b>$subject <br>
      <b>Сумма: </b>$price
     </p>
    </html>
   ";

// Получатель письма
$mail->addAddress('');

// Отправка сообщения
$mail->Subject = $title;
$mail->Body = $body;

SendMail($mail, $status);

// -------------

$linktoform = 'https://framko.payform.ru/';
$secret_key = '';

$data = [
  // хххх - номер заказ в системе интернет-магазина
  'order_id' => random_int(100000, 999999),

  'customer_phone' => $user_phone,
  'customer_email' => $user_email,
  'customer_extra' => "$first_name $last_name",

  'products' => [
    [
      'sku' => random_int(100000, 999999),
      'name' => $subject,
      'price' => $price,
      'quantity' => 1,
    ],
  ],

  'do' => 'link',
  'discount_value' => $discount,
];

$data['signature'] = Hmac::create($data, $secret_key);

$link = sprintf('%s?%s', $linktoform, http_build_query($data));
$url = file_get_contents($link);

echo json_encode($url);
?>