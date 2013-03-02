<?php

function newfolder($folder){
	if(!file_exists(path('/assets/'.$folder))){
		mkdir(path('/assets/'.$folder));
		return true;
	}else{
		return false;
	}
}

function copyFile($remetente,$destino,$delete=false){
	if (!file_exists(path('/assets'.$remetente))){
		return false;
	}
	if (copy(path('/assets'.$remetente),path('/assets'.$destino))){
		if ($delete){
			if(unlink(path('/assets'.$remetente))){
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
	if (!file_exists(path('/assets'.$remetente)))
		return false;
	else{
		if (rename(path('/assets'.$remetente), path("/assets".$destino)))
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