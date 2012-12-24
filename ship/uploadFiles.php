<?php

function newfolder($folder){
	if(!file_exists("../garagem/".$folder)){
		mkdir("../garagem/".$folder);
		return true;
	}else{
		return false;
	}
}

function copyFile($remetente,$destino,$delete=false){
	if (!file_exists("../garagem/".$remetente))
		setFlash('Arquivo remetente não existe','error');
	elseif (!file_exists("../garagem/".$destino))
		setFlash('O caminho de destino não existe não existe','error');
	else{
		copy("../garagem/".$remetente, "../garagem/".$destino);
		//Se delete true deleta o arquivo origem
		if ($delete)
			unlink("../garagem/".$remetente);
	}
}

function renameFile($remetente,$destino){
	if (!file_exists("../garagem/".$remetente))
		setFlash('O arquivo que você deseja renomear não existe','error');
	else
		rename("../garagem/".$remetente, "../garagem/".$destino);
}

function uploadFile($remetente=array(),$destino,$options=array()){

	$erro = 0;

	if (!isset($options['extension']))
		$options['extension'] = null;

	if (!isset($options['size']))
		$options['size'] = null;
	//Pegando extensao
	$ext = explode(".",$remetente['name']);
	$ext = end($ext);
	//Pegando o tamanho
	$sizeK = round($remetente['size'] / 1000);

	//Se setar tamanho testar
	if (!is_null($options['extension'])) {
		if (!in_array($ext, $options['extension'])) {
			$erro  = 1;
		}
	}
	if (!is_null($options['size'])) {
		if ($sizeK > $options['size']) {
			$erro = 2;
		}
	}

	if($erro == 0){
		if (copy($remetente['tmp_name'],"../garagem/".$destino."/".$remetente['name']))
			$erro = 0;
		else
			$erro = 3;
	}

	return $erro;
}



function uploadImg($remetente=array(),$destino,$options=array()){

	$erro = 0;

	if (!isset($options['extension']))
		$options['extension'] = null;

	if (!isset($options['size']))
		$options['size'] = null;
	//Pegando extensao
	$ext = explode(".",$remetente['name']);
	$ext = end($ext);
	//Pegando o tamanho
	$sizeK = round($remetente['size'] / 1000);

	//Se setar tamanho testar
	if (!is_null($options['extension'])) {
		if (!in_array($ext, $options['extension'])) {
			$erro  = 1;
		}
	}
	if (!is_null($options['size'])) {
		if ($sizeK > $options['size']) {
			$erro = 2;
		}
	}

	if($erro == 0){
		if (copy($remetente['tmp_name'],"../garagem/".$destino."/".$remetente['name']))
			$erro = 0;
		else
			$erro = 3;
	}

	return $erro;
}
?>