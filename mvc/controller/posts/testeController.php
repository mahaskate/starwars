<?php

require "../mvc/controller/components/facebook/src/base_facebook.php";
require "../mvc/controller/components/facebook/src/facebook.php";

$facebook = new Facebook(array(
  'appId'  => '404699592875095',
  'secret' => '7a77bc1476389c95a89b0094a1fd380f',
));

$me = $facebook->api('/cevalinho');

print_r($me);

?>
<img src="https://graph.facebook.com/cevalinho/picture">