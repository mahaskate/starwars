<?php

//Datas
function isDate($data){
	$data = explode("/", $data);
	if (count($data) != 3) {
		return false;
	}else{
		if ($data[0] == 0 OR $data[0] > 31 OR $data[1] == 0 OR $data[1] > 12 OR $data[2] < 1601 OR $data[2] > 9999) {
			return false;
		}else{
			return true;
		}
	}

}
function dateSql($data){
	if (isDate($data)) {
		$data = explode("/", $data);
		$data = $data[2]."-".$data[1]."-".$data[0]." ".date("h:i:s");
		return $data;
	}else
		return false;
}
function dateBrasil($data){
	$data = explode("-", $data);
	$data = $data[2]."/".$data[1]."/".$data[0];
	return $data;
}

?>