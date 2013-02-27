<?php

function newfolder($folder){
	if(!file_exists(path('/garagem/'.$folder))){
		mkdir(path('/garagem/'.$folder));
		return true;
	}else{
		return false;
	}
}

function copyFile($remetente,$destino,$delete=false){
	if (!file_exists(path('/garagem'.$remetente))){
		return false;
	}
	if (copy(path('/garagem'.$remetente),path('/garagem'.$destino))){
		if ($delete){
			if(unlink(path('/garagem'.$remetente))){
				return true;
			}else{
				return false;
			}
		}
		return true;
	}else{
		return false;
	}
	return false;
}

function renameFile($remetente,$destino){
	if (!file_exists(path('/garagem'.$remetente)))
		return false;
	else{
		if (rename(path('/garagem'.$remetente), path("/garagem".$destino)))
			return true;
		else
			return false;
	}
}

function sizeLimit($file,$max){
	$tamanho = round($file['size']/1024);
	if ($tamanho > $max)
		return false;
	else
		return true;
}

function checkExt(){

}

?>