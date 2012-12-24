<?php

acl();

include "../mvc/controller/components/thumb/ThumbLib.inc.php";

echo img('Lighthouse.jpg');

if($_FILES){
	copy($_FILES['foto']['tmp_name'],'/dirA/Lighthouse.jpg');
}

?>