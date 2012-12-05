<?php

function isEmpty($valores){
	if (in_array("",$valores))
		return true;
	else
		return false;
}

function save($tabela, $form, $id = null){
	global $salt;
	$campos = "";
	$valores = "";
	$update = "";
	foreach ($form as $campo => $value) {
		if ($value != "") {
			// Faz o anti sql injection
			$value = antiinjection($value);
			// Se senha ou password faz o hash
			if($campo == "password")
				$value = md5($value.$salt);
			if (is_null($id)){
				$campos .= $campo.",";
				if (!is_numeric($value))
					$valores .= "'".$value."',";
				else
					$valores .= $value.",";
			}
			else{
				if (!is_numeric($value))
					$update = $update.",".$campo." = '".$value."'";
				else
					$update = $update.",".$campo." = ".$value;
			}
		}
	}
	if ($campos != "" OR $update != "") {
		if ($id != "") {
			$update = substr($update, 1);
			$update = "UPDATE ".$tabela." SET ".$update.", modified = '".date("Y-m-d h:i:s")."' WHERE id = ".$id;
			return mysql_query($update) or die ("Erro ao editar dados no banco de dados: ".mysql_error());
		}else{
			$r = "INSERT INTO ".$tabela." (".$campos."created) VALUES (".$valores."'".date('Y-m-d H:i:s')."')";
			//echo $r;
			return mysql_query($r) or die ("Erro ao inserir no banco de dados: ".mysql_error());
		}
	}else
		return false;
}

//Busca todos os dados de uma tabela especifica
function find($tabela){
	$sel = mysql_query("SELECT * FROM ".$tabela);
	$total = mysql_num_rows($sel);
	for ($i=0; $i < $total; $i++) { 
		$var[] = mysql_fetch_assoc($sel);
	}
	return $var;
}

?>