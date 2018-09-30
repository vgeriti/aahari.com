<?php
session_start();

require_once('../manag/php/classes/DBConnect.php'); 
require 'config1.php';

$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  //  var_dump($user_profile);
  } catch (FacebookApiException $e) {
    error_log($e);
    //var_dump($e);
  }
}
else
{
  $loginUrl = $facebook->getLoginUrl(array(
  'scope'=>'email',
  'redirect_uri' => 'http://aahari.com/fb-Auth/login_fb.php'
  ));
  header('Location:'.$loginUrl);
}

  $d = new DBConnect();  
  $db = $d->getDBConnection();    
  $session = sha1(uniqid(""));
  $_SESSION['email'] = $user_profile['email'];
  $_SESSION['name'] = $user_profile['first_name'];
  $_SESSION['session'] = $session;
//echo $user_profile['first_name'];
  $THE_REFER=strval(isset($_SERVER['HTTP_REFERER']));
  date_default_timezone_set('Asia/Calcutta');
  $st = $db->prepare("INSERT into activity(session_id,http_ref,fb_email,action,date_time,user_agent) values (:session_id,:http_ref,:fb_email,:action,:date_time,:user_agent)");
  $arpy = array(':session_id' => $_SESSION['session'], ':http_ref'=> $THE_REFER,':fb_email'=>$_SESSION['email'],':action'=>"login_success",'date_time'=>date("Y-m-d H:i:s"),':user_agent'=>$_SERVER["REMOTE_ADDR"]."\/@#$/".$_SERVER["HTTP_USER_AGENT"]);
  $st->execute($arpy) or die($st->errorInfo());
  
header('Location:../index.php');
?>