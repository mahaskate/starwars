<?php

//echo $_SERVER['SCRIPT_NAME'];
//require "../mvc/controller/components/wideImage/lib/wideImage.php";

include "../mvc/controller/components/wideImage/teste.php";

if($_POST){

	wideImage::loadFromUpload('foto')->resize(50,50)->saveToFile(path('img/'.$_FILES['foto']['name']));
}

?>