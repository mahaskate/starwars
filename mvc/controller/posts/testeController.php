<?php

include "../mvc/controller/components/thumb/ThumbLib.inc.php";

echo img('teste.jpg');

if($_FILES){
	$foto = PhpThumbFactory::create($_FILES['foto']['tmp_name']);
	$foto->adaptiveResize(100, 100);
	$foto->save('../garagem/img/teste.jpg');
}

?>