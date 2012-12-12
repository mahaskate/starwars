<?php

function form($method="POST", $id="", $class="", $enctype=false){
	if ($enctype)
		$enctype="enctype='multipart/form-data'";
	$r = "<form action='' method='".$method."' class='".$class."' id='".$id."'>";
	return $r;
}

function formText($name){
	$r = "<div class='control-group'>";
		$r .= "<label class='control-label' for='".$name."'>".$name."</label>";
		$r .= "<div class='controls'>";
			$r .= "<input type='text' id='".$name."' class='' name='".$name."'>";
		$r .= "</div>";
	$r .= "</div>";
	return $r;
}

function formSubmit($value=null,$class=null,$action=false){
	if (is_null($value))
		$value = "Enviar";

	if ($action){
		$r = "<div class='form-actions'>";
			$r .= "<button type='submit' class='btn ".$class."'>".$value."</button>";
		$r .= "</div>";
	}else{
		$r = "<button type='submit' class='btn ".$class."'>".$value."</button>";
	}
	return $r;
}

function formEnd(){
	$r = "</form>";
	return $r;
}

function isEmpty($valores=array()){
	if (in_array("",$valores))
		return true;
	else
		return false;
}
 
function validation($tabela,$data){
	require "../mvc/model/".$tabela."Model.php";
	$validation = model();
	// Faz um foreach na variavel de validação
	foreach ($validation as $key => $valor) {
		// ve se a key da variavel validation existe na variavel passada que contem os campos do form, pois só sera validado os dados passados
		if (array_key_exists($key,$data)) {
			foreach ($valor as $chave2 =>$outro) {
			// Valida required, numeric e data
				// Valida se required
				if ($outro == "required") {
					if ($data[$key] == "")
						return false;
				}
				//Valida se numero
				if ($outro == "numeric") {
					if (!is_numeric($data[$key]))
						return false;
				}
				//Valida se data
				if ($outro == "date") {
					if (!isDate($data[$key]))
						return false;
				}
				// Válida minimo
				if ($chave2 == 'minLength') {
					if (strlen($data[$key]) < $outro) {
						return false;
					}
				}
			}
		}
	}
	return true;
}

function save($tabela, $form, $id = null){
	global $salt;
	$campos = "";
	$valores = "";
	$update = "";

	/**
	* VALIDAÇÃO DOS CAMPOS BASEADO NO ARRAY DO MODEL
	*
	*/
	if (validation($tabela,$form)){
		$model = model();
		foreach ($form as $campo => $value) {
			// Só faz as operações se o campo pertencer a tabela
			if(array_key_exists($campo,$model)){
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
		}
	}else{
		return false;
	}
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