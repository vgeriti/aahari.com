<?php
require_once 'Mailer.php';
$mailer = new Mailer();

$mailer->setTo('jaganryali@gmail.com');
$mailer->setFrom('Jagan@aahari.com');
$mailer->setSubject('Welcome to Aahari');
$mailer->setReplyTo('105@srkrcse.org');
$mailer->setBody('
<div dir="ltr">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" style="font-size:medium;background-color:rgb(255,255,225);font-family:\'Times New Roman\'">
<tbody><tr><td>
<span class="HOEnZb"><font color="#888888">
</font></span><table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center"><tbody><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="100%" style="padding:5px 50px;font-family:Pacifico;background-color:rgb(253,74,78)">


<a href="http://www.aahari.com/" style="text-decoration:none;font-size:33px;color:rgb(255,255,255)" target="_blank"><img src=\'images\aahari_logo.png\'/></a></td></tr></tbody></table></td></tr><tr><td align="center">

</td>
</tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="10%">&nbsp;</td><td width="80%" align="left" valign="top"><p><font style="font-family:Georgia,\'Times New Roman\',Times,serif;color:rgb(1,1,1);font-size:24px"><strong><em>Hi Satish,</em></strong></font><br>


<br><font style="font-family:Verdana,Geneva,sans-serif;color:rgb(102,103,102);font-size:13px;line-height:21px">Its a great pleasure to have you in Aahari. We value  your relationship and look forward to delight you with our services.<br>

<p><font style="font-family:Verdana,Geneva,sans-serif;color:rgb(102,103,102);font-size:13px;line-height:21px"><br>Stay connected with us, we love our friends :)&nbsp;<br>


<br><a href="https://www.facebook.com/pages/Aahari/427042970729213" style="background-color:rgb(80,159,254);color:rgb(255,255,255);min-height:30px;width:100px;font-weight:bold;text-decoration:none;padding:10px 10px 10px 5px" target="_blank">Facebook</a>&nbsp;<a href="https://twitter.com/aahariaahari" style="background-color:rgb(78,211,244);color:rgb(255,255,255);min-height:30px;width:100px;font-weight:bold;text-decoration:none;padding:10px 10px 10px 5px" target="_blank">Twitter</a></font></p>


<p><font style="font-family:Verdana,Geneva,sans-serif;color:rgb(102,103,102);font-size:13px;line-height:21px">Sales Team,<br>Aahari.</font></p></td><td width="10%">&nbsp;</td></tr><tr><td>&nbsp;</td><td align="right" valign="top">


<table width="108" border="0" cellspacing="0" cellpadding="0"></table></td><td>&nbsp;</td></tr></tbody></table></td></tr><tr><td style="background-color:rgb(253,74,78);height:30px;padding-left:20px"><font style="font-family:Verdana,Geneva,sans-serif;color:rgb(255,255,255);font-size:13px;line-height:21px">Copyright(c) 2014 <a href="https://aahari.com" target="_blank">aahari.com</a>. All Rights Reserved.</font></td></tr></tbody></table></td></tr></tbody></table></div>');


$mailer->preSendMail();
$mailer->sendEmail();

?>