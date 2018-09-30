<?php
require 'src/facebook.php';
$user_profile = null;
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '356784271129528',
  'secret' => '7bc95a01c753f7e8546dc645a1083825'
));
/*$facebook = new Facebook(array(
  'appId'  => '327733180679535',
  'secret' => 'c210c2fa4d43dbd98b05718c9327b96b'
));*/
// Get User ID
$user = $facebook->getUser();


//echo "fucker";
echo var_dump($user);
if ($user) {
  
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    echo "Helloo";
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl(array('scope'=>'user_birthday,user_likes,user_location,email,sms'));
}

// This call will always work since we are fetching public data.
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>


	 ?>
  </body>
</html>