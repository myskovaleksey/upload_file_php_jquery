upload_file_php_jquery
======================

Upload files with jquery+php 

1. sudo apt-get install php-pear

2.
sudo pear install -o Mail
sudo  pear install -o Mail_Mime
sudo  pear install -o Net_SMTP

3. Config send email:
/server/mail.php

send
$from - from email
$to - to email

setup send
$host = "smtp.gmail.com";
$post = "465";
$username = "exaple@gmail.com";
$password = "password";
