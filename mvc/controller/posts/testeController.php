<?php

//echo $_SERVER['SCRIPT_NAME'];
//require "../mvc/controller/components/wideImage/lib/wideImage.php";

//echo dirname(__FILE__);

	require_once '../mvc/controller/components/wideImage/lib/Exception.php';
	
	require_once '../mvc/controller/components/wideImage/lib/Image.php';
	require_once '../mvc/controller/components/wideImage/lib/TrueColorImage.php';
	require_once '../mvc/controller/components/wideImage/lib/PaletteImage.php';
	
	require_once '../mvc/controller/components/wideImage/lib/Coordinate.php';
	require_once '../mvc/controller/components/wideImage/lib/Canvas.php';
	require_once '../mvc/controller/components/wideImage/lib/MapperFactory.php';
	require_once '../mvc/controller/components/wideImage/lib/OperationFactory.php';
	
	require_once '../mvc/controller/components/wideImage/lib/Font/TTF.php';
	require_once '../mvc/controller/components/wideImage/lib/Font/GDF.php';
	require_once '../mvc/controller/components/wideImage/lib/Font/PS.php';

include "../mvc/controller/components/wideImage/lib/wideImage.php";

if($_POST){

	wideImage::loadFromUpload('foto')->resize(50,50)->saveToFile(path('img/'.$_FILES['foto']['name']));
}

?>