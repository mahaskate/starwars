<?php

include "../mvc/controller/components/thumb/ThumbLib.inc.php";

echo img('Lighthouse.jpg');

if($_FILES){
	uploadImg($_FILES['foto'],'img');
}

?>