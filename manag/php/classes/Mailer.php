<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//require_once 'DBConnect.php';
date_default_timezone_set('Asia/Calcutta');
//date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
class Mailer{

	
	private $from;
	private $to;
	private $subject;
	private $body;
	private $replyTo;
	private $html_body;
	public $mail;

	function __construct(){
		$this->mail = new PHPMailer();
	//	echo "in mailer";
		$mail = $this->mail;
		$mail->IsSendmail();
//Tell PHPMailer to use SMTP
		//$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
		$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
//Set the hostname of the mail server
		//$mail->Host = 'smtp.gmail.com';
		//$mail->Host = 'relay-hosting.secureserver.net';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		//$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
		//$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
		//$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
		//$mail->Username = "jaganryali@gmail.com";
//Password to use for SMTP authentication
		//$mail->Password = "jagansurya@3603";
	}

	function setFrom($from)
	{
		$this->from = $from;		
	}
	function getFrom()
	{
		return $this->from;
	}
	function setTo($to)
	{
		$this->to = $to;
	}
	function getTo()
	{
		return $this->to;
	}
	function setSubject($subject)
	{
		$this->subject = $subject;
	}
	function getSubject()
	{
		return $this->subject;
	}
	function setBody($body)
	{
		$this->body = $body;
	}
	function getBody()
	{
		return $this->body;
	}
	function setReplyTo($replyTo)
	{
		$this->replyTo = $replyTo;
	}
	function getReplyTo()
	{
		return $this->replyTo;
	}

	function preSendMail()
	{
//Set who the message is to be sent from		
		$mail = $this->mail;
		$mail->setFrom($this->getFrom(), 'Aahari');
//Set an alternative reply-to address
		//$mail->addReplyTo($this->getReplyTo());
//Set who the message is to be sent to
		$mail->addAddress($this->getTo());
//Set the subject line
		$mail->Subject = $this->getSubject();
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('testmail.php'), dirname(__FILE__));
		$mail->msgHTML($this->getBody());
//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');

	}
	function sendEmail()
	{
		$mail = $this->mail;
		if (!$mail->send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//echo "Message sent!";
		}
	}
}
?>