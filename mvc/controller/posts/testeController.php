<?php

if($_POST){
	require component('wideImage/lib/wideImage.php');

	wideImage::loadFromUpload('foto')->resize(50,50)->saveToFile(path('img/'.$_FILES['foto']['name']));
}

?>