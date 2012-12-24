<?php

require component('facebook/core.php');

$me = $facebook->api('/cevalinho');

print_r($me);

?>
<img src="https://graph.facebook.com/cevalinho/picture">