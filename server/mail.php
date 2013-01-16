<?php 
// phpinfo();
echo '<pre>';
var_dump($_FILES);
echo '</pre>';


// foreach ($_FILES['files']['name'] as $key => $value) {
//   echo $key."</br>";
//   echo $value."</br>";
//   echo $_FILES['files']['type'][$key];
// }

require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

$from = "miskovaleksey@gmail.com";
$to = "print@printzilla.ru";
$subject = 'Test mime message with an attachment';

$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

$text = 'Text version of email';// text and html versions of email.
$html = '<html><body>HTML version of email. <strong>This should be bold</strong></body></html>';

$file = './sample.txt'; // attachment
$crlf = "\n";

$mime = new Mail_mime($crlf);
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
foreach ($_FILES['files']['name'] as $key => $value) {
  $type = $_FILES['files']['type'][$key];
  $path = $_FILES['files']['tmp_name'][$key];
  $name = $_FILES['files']['name'][$key];
$mime->addAttachment($path, $type); 
}

//do not ever try to call these lines in reverse order
$body = $mime->get();
$headers = $mime->headers($headers);

$host = "smtp.gmail.com";
$post = "465";
$username = "123@gmail.com";
$password = "123";

$smtp = Mail::factory('smtp', 
  array ('host' => $host, 
         'port' => $port, 
         'auth' => true,
         'username' => $username,
         'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
}
else {
  echo("<p>Message successfully sent!</p>");
}
?>