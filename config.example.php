<?php


require_once('facebook-php-sdk/src/facebook.php');

  $config = array(
    'appId' => 'Your_App_Id',
    'secret' => 'App_Secret',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );
  $facebook = new Facebook($config);
  $access_token = $facebook->getAccessToken();
  ?>
