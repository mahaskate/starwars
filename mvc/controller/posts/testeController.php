<?php

include "../mvc/controller/components/thumb/ThumbLib.inc.php";

if($_POST){

	wideImage::loadFromUpload('foto')->resize(50,50)->saveToFile(path('img/'.$_FILES['foto']['name']));
}

?>