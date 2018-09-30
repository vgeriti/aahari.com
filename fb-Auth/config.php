<?php
require 'config1.php';


$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

//var_dump($user);
if ($user) {
  
  //header('Location:../index.php');

} else {

  $loginUrl = $facebook->getLoginUrl(array(
  'scope'=>'email',
  'redirect_uri' => 'http://aahari.com/fb-Auth/login_fb.php'
  ));
}
?>