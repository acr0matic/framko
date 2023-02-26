<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Проверяем отравленность сообщения
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

  // Переменные

  $target_page = urlencode($_POST['page']);
  $target = $_POST['target'];
  $subject = $_POST['subject'];
  $price = $_POST['price'];

  $first_name = (!empty($_POST['first_name'])) ? $_POST['first_name'] : 'Не указано';
  $last_name = (!empty($_POST['last_name'])) ? $_POST['last_name'] : 'Не указана';
  $user_phone = (!empty($_POST['user_phone'])) ? FormatPhone($_POST['user_phone']) : 'Не указан';
  $user_email = (!empty($_POST['user_email'])) ? $_POST['user_email'] : 'Не указана';

  if (empty($target))
    die('SPAM DETECTED');

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
}

echo json_encode($status);