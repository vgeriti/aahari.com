<?php
require_once 'Mailer.php';
$mailer = new Mailer();

$mailer->setTo('jaganryali@gmail.com');
$mailer->setFrom('Jagan@aahari.com');
$mailer->setSubject('Test mail from localhost using phpmailer');
$mailer->setReplyTo('105@srkrcse.org');

?>