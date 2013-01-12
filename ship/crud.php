<?php

function form($options=array()){
	if (!isset($options['type']))
		$options['type'] = "form-horizontal";
	else
		$options['type'] = "form-".$options['type'];

	if (!isset($options['id']))
		$options['id'] = "";
	if (!isset($options['action']))
		$options['action'] = "";
	else
		$options['action'] = "action='".$options['action']."'";
	if (!isset($options['method']))
		$options['method'] = "POST";
	if (isset($options['enctype'])){
		if($options['enctype'])
			$options['enctype'] = "enctype='multipart/form-data'";
		else
			$options['enctype'] = "";
	}else
		$options['enctype'] = "";

	$r = "<form ".$options['action']." method='".$options['method']."' class='".$options['type']."' id='".$options['id']."' ".$options['enctype'].">";
	return $r;
}

function formActions(){
		$r = "<div class='form-actions'>";	
		return $r;
}

function formActionsEnd(){
		$r = "</div>";	
		return $r;
}

function formLegend($a){
	$a = "<legend>".$a."</legend>";
	return $a;
}

function formList($name,$valores = array(),$options=array(),$label2=true){
	if (!isset($options['class']))
		$options['class'] = "";
	if (!isset($options['label']))
		$options['label'] = "";
	if (!isset($options['style']))
		$options['style'] = "";
	if (!isset($options['firstField']))
		$options['firstField'] = "";

	// Se não setar label trata o name como label
	if ($options['label'] == "")
		$nameLabel = ucfirst($name);
	else
		$nameLabel = $options['label'];

	global $data;

	$r = "<div class='control-group'>";
		if ($label2)
			$r .= "<label class='control-label' for='".$name."'>".$nameLabel."</label>";
		$r .= "<div class='controls'>";
			$r .= "<select id='".$name."' class='".$options['class']."' style='".$options['style']."' name='".$name."'>";
				$r .= "<option value=\"\">Selecione:</option>";
				foreach ($valores as $key => $valor) {

					if ($options['firstField'] == $key)
						$selected = "selected";
					else
						$selected = "";

					if ($data[$name] == $key)
						$selected = 'selected';
					else
						$selected = '';

					$r .= "<option value=".$key." ".$selected.">".$valor."</option>";
				}
			$r .= "</select>";
		$r .= "</div>";
	$r .= "</div>";
	return $r;
}


function formText($name,$options=array(),$label2=true){
	if (!isset($options['class']))
		$options['class'] = "";
	if (!isset($options['label']))
		$options['label'] = "";
	if (!isset($options['class']))
		$options['class'] = "";
	if (!isset($options['placeholder']))
		$options['placeholder'] = "";
	if (!isset($options['style']))
		$options['style'] = "";
	if (!isset($options['maxlength']))
		$options['maxlength'] = "";
	if (!isset($options['help-block']))
		$options['help-block'] = "";
	if (!isset($options['help-inline']))
		$options['help-inline'] = "";
	
	if (!isset($options['type']))
		$type = "text";
	else
		$type = $options['type'];

	if ($type == 'password' OR $name == 'password' OR $name == 'senha')
		$type = 'password';


	// Se não setar label trata o name como label
	if ($options['label'] == "")
		$nameLabel = ucfirst($name);
	else
		$nameLabel = $options['label'];

	global $data;

	if(isset($options['value']))
		$value = $options['value'];
	else{
		if (isset($data[$name]))
			$value = $data[$name];
		else
			$value = '';
	}

	$r = "<div class='control-group'>";
		if ($label2)
			$r .= "<label class='control-label' for='".$name."'>".$nameLabel."</label>";
		$r .= "<div class='controls'>";
			if ($type == 'textarea')
				$r .= "<textarea id='".$name."' class='".$options['class']."' style='resize:none;".$options['style']."' name='".$name."' placeholder='".$options['placeholder']."' maxlength=".$options['maxlength'].">".$value."</textarea>";
			else
				$r .= "<input type='".$type."' id='".$name."' class='".$options['class']."' style='".$options['style']."' name='".$name."' value='".$value."' placeholder='".$options['placeholder']."' maxlength=".$options['maxlength'].">";
			if ($options['help-block'] !="")
				$r .= "<span class='help-block'>".$options['help-block']."</span>";
			if ($options['help-inline'] !="")
				$r .= "<span class='help-inline'>".$options['help-inline']."</span>";
		$r .= "</div>";
	$r .= "</div>";
	return $r;
}

function formChoice($value,$options = array()){
	if (!isset($options['type']))
		$options['type'] = "";
	if (!isset($options['class']))
		$options['class'] = "";
	if (!isset($options['id']))
		$options['id'] = "";
	if (!isset($options['align']))
		$options['align'] = "";

	if (!isset($options['name']))
		$options['name'] = "";

	if (!isset($options['label']))
		$options['label'] = ucfirst($value);

	$r = "<label class='".$options['type']." ".$options['align']."'>";
		$r .= "<input type='".$options['type']."' name='".$options['name']."' id='".$options['id']."' value='".$value."'>";
		$r .= $options['label'];
	$r .= "</label>";	
	return $r;
}

function formSubmit($value=null,$options=array()){

	if(!isset($options['class']))
		$options['class'] = "";
	if(!isset($options['actions']))
		$options['actions'] = false;


	if (is_null($value))
		$value = "Enviar";

	if ($options['actions']){
		$r = "<div class='form-actions'>";
			$r .= "<button type='submit' class='btn ".$options['class']."'>".$value."</button>";
		$r .= "</div>";
	}else{
		$r = "<button type='submit' id='btn-submit' class='btn ".$options['class']."'>".$value."</button>";
	}
	return $r;
}

function formControlGroup(){
		$r = "<div class='control-group'>";
	$r .= "<div class='controls'>";
	return $r;
}

function formControlGroupEnd(){
		$r = "</div>";
	$r .= "</div>";
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
				//Valida se numero
				if ($outro == "email") {
					if (!isEmail($data[$key]))
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

function delete($tabela,$id){
	$r = "DELETE FROM ".$tabela." WHERE id=".$id;
	return $r;
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
					if (array_key_exists($campo, $model)){
						$campos .= $campo.",";
						if (!is_numeric($value))
							$valores .= "'".$value."',";
						else
							$valores .= $value.",";
					}
				}
				else{
					if (!is_numeric($value))
						$update = $update.",".$campo." = '".$value."'";
					else
						$update = $update.",".$campo." = ".$value;
				}
			}
		}

		if (is_null($id)) {
			// Só salva se todos os camps do model estiverem em todos os campos do form.. lembrado que soh vale para insert
			$camposExplode = substr($campos, 0,-1);
			$camposExplode = explode(",",$camposExplode);
			foreach ($model as $key => $value) {
				if (!in_array($key, $camposExplode)) {
					return false;
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
				return mysql_query($r) or die ("Erro ao inserir no banco de dados: ".mysql_error());
			}
		}
	}else{
		return false;
	}
	return false; 
}

function isEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL))
		return true;
	else
		return false;
}

function select($select){
	$sel = mysql_query($select) or die ('Erro na tabela'.mysql_error());

	$sel = mysql_query("SELECT * FROM ".$tabela);
	$total = mysql_num_rows($sel);
	for ($i=0; $i < $total; $i++) { 
		$var[] = mysql_fetch_assoc($sel);
	}
	return $var;
}

//Busca todos os dados de uma tabela especifica

function totalRecords($tabela,$options=array()){

	if(!isset($options['where']))
		$options['where'] = "";
	else
		$options['where'] = " WHERE ".$options['where'];

	$total = mysql_query("SELECT count(id) as total FROM ".$tabela.$options['where']);

	$total = mysql_fetch_assoc($total);
	$total = $total['total'];
	return $total;
}

function pagination($tabela,$options=array()){
	global $paginationLimit;
	$varByGet = varsByGet();

	$pagina = getPage();

	$inicio = $pagina - 1;
	$inicio = $paginationLimit * $inicio;

	$options['limit'] = $inicio.",".$paginationLimit;

	$result = find($tabela,$options);

	return $result;

}

function paginatorGmail($totalReg,$options=array()){
	global $paginationLimit;
	$varByGet = varsByGet();

	if (!isset($options['align']) OR $options['align'] == 'left') {
		$options['align'] = 'pull-left';
	}else{
		$options['align'] = 'pull-right';
	}

	if (!isset($options['color']) OR $options['color'] != 'inverse'){
		$options['color'] = '';
		$iconwhite = '';
	}else{
		$options['color'] = 'btn-inverse ';
		$iconwhite = 'icon-white';
	}

	$paginas = ceil($totalReg / $paginationLimit);

	$pagina = getPage();

	//Calculos para manter o link orignal e só trocar a pagina
	$uri = $_SERVER['REQUEST_URI'];

	if (!empty($varByGet) AND array_key_exists('pagina', $varByGet))
		unset($varByGet['pagina']);

	$total = count($varByGet);

	if ($total == 0) {
		$mais = '?pagina='.($pagina+1);
		$menos = '?pagina='.($pagina-1);
	}else{
		$variaveis = '?';
		foreach ($varByGet as $key => $value) {
			$variaveis .= $key."=".$value."&";
		}
		$mais = $variaveis.'pagina='.($pagina+1);
		$menos = $variaveis.'pagina='.($pagina-1);
	}

	//Só faz tudo se existir página
	if($paginas > 1){
		//Se a pagina for menos ou igual o total de paginas, caso contrario pagina inexistente
		if ($pagina <= $paginas) {
			echo "<div class='".$options['align']."'>";
				echo "Página ".$pagina." - ".$paginas." de ".$totalReg."&nbsp;&nbsp;";
				echo "<div class='btn-group pull-right'>";
					//Ver se mostra voltar ou n
					if ($pagina > 1) {
						$disabled = '';
					}else{
						$disabled = 'disabled';
						$menos = 'javascript:void(0)';
					}
					echo "<a href='".$menos."' class='btn btn-small ".$options['color'].$disabled."'><i class='icon-chevron-left ".$iconwhite."'></i></a>";
					//ver se mostra proximo ou não
					if ($pagina <  $paginas) {
						$disabled = '';
					}else{
						$disabled = 'disabled';
						$mais = 'javascript:void(0)';
					}
					echo "<a href='".$mais."' class='btn btn-small ".$options['color'].$disabled."'><i class='icon-chevron-right ".$iconwhite."'></i></a>";
				echo "</div>";
			echo "</div>";
		}else{
			redirect(array('controller'=>'errors','action'=>'404'));
		}
	}

}

function paginatorBlog($total,$options=array()){
	global $paginationLimit;
	$varByGet = varsByGet();

	if (!isset($options['previous'])) {
		$options['previous'] = 'Anterior';
	}
	if (!isset($options['next'])) {
		$options['next'] = 'Próximo';
	}

	if (isset($options['alignSides']) AND $options['alignSides'] == true) {
		$previous = 'previous';
		$next = 'next';
	}else{
		$previous = '';
		$next = '';
	}

	$paginas = ceil($total / $paginationLimit);

	$pagina = getPage();

	//Calculos para manter o link orignal e só trocar a pagina
	$uri = $_SERVER['REQUEST_URI'];

	if (!empty($varByGet) AND array_key_exists('pagina', $varByGet))
		unset($varByGet['pagina']);

	$total = count($varByGet);

	if ($total == 0) {
		$mais = '?pagina='.($pagina+1);
		$menos = '?pagina='.($pagina-1);
	}else{
		$variaveis = '?';
		foreach ($varByGet as $key => $value) {
			$variaveis .= $key."=".$value."&";
		}
		$mais = $variaveis.'pagina='.($pagina+1);
		$menos = $variaveis.'pagina='.($pagina-1);
	}

	//Só faz tudo se existir página
	if($paginas > 1){
		//Se a pagina for menos ou igual o total de paginas, caso contrario pagina inexistente
		if ($pagina <= $paginas) {
			//Ver se mostra voltar ou n
			echo "<ul class='pager'>";
				if ($pagina > 1) {
					$disabled = '';
				}else{
					$disabled = 'disabled';
					$menos = 'javascript:void(0)';
				}
				echo "<li class='".$previous." ".$disabled."'><a href='".$menos."'>".$options['previous']."</a></li>";
				//ver se mostra proximo ou não
				if ($pagina <  $paginas) {
					$disabled = '';
				}else{
					$disabled = 'disabled';
					$mais = 'javascript:void(0)';
				}
				echo "<li class='".$next." ".$disabled."'><a href='".$mais."'>".$options['next']."</a></li>";
			echo "</ul>";
		}else{
			redirect(array('controller'=>'errors','action'=>'404'));
		}
	}

}

function getPage(){
	$varByGet = varsByGet();

	if (!empty($varByGet) AND array_key_exists('pagina', $varByGet)){
		$pagina = $varByGet['pagina'];
		
		if (is_numeric($pagina) AND $pagina > 0 AND $pagina < 99999999999999)
			$pagina = $varByGet['pagina'];
		else
			// SE digitar letra ou numero negativo
			redirect(array('controller'=>'erros','action'=>'404'));
	}else
		$pagina = 1;

	return $pagina;
}

function paginator($total,$options=array()){
	global $paginationLimit;
	$varByGet = varsByGet();

	if (!isset($options['align'])) {
		$options['align'] = 'pagination-centered';
	}elseif ($options['align'] == 'right') {
		$options['align'] = 'pagination-right';
	}elseif ($options['align'] == 'left') {
		$options['align'] = 'pagination-left';
	}

	if (!isset($options['size'])) {
		$options['size'] = '';
	}elseif ($options['size'] == 'mini') {
		$options['size'] = 'pagination-mini';
	}elseif ($options['size'] == 'small') {
		$options['size'] = 'pagination-small';
	}elseif ($options['size'] == 'large') {
		$options['size'] = 'pagination-large';
	}

	$paginas = ceil($total / $paginationLimit);

	$pagina = getPage();

	//Calculos para manter o link orignal e só trocar a pagina
	$uri = $_SERVER['REQUEST_URI'];

	if (!empty($varByGet) AND array_key_exists('pagina', $varByGet))
		unset($varByGet['pagina']);

	$total = count($varByGet);

	if ($total == 0) {
		$mais = '?pagina='.($pagina+1);
		$menos = '?pagina='.($pagina-1);
		$link = '?pagina=';
	}else{
		$variaveis = '?';
		foreach ($varByGet as $key => $value) {
			$variaveis .= $key."=".$value."&";
		}
		$mais = $variaveis.'pagina='.($pagina+1);
		$menos = $variaveis.'pagina='.($pagina-1);
		$link = $variaveis.'pagina=';
	}

	//Só faz tudo se existir página
	if($paginas > 1){
		if ($pagina > $paginas) {
			redirect(array('controller'=>'errors','action'=>'404'));
		}
		//Se a pagina for menos ou igual o total de paginas, caso contrario pagina inexistente
		echo "<div class='pagination ".$options['align']." ".$options['size']."'>";
			echo "<ul>";
				if($pagina != 1) 
					echo "<li><a href='".$menos."'>«</a></li>"; 
				 
				if (($pagina-3) < 1 )
					$anterior = 1;
				else
					$anterior = $pagina-3;
				 
				if (($pagina+3) > $paginas )
					$posterior = $paginas;
				else
					$posterior = $pagina + 3;

				for($i=$anterior;$i <= $posterior;$i++) {
					if($i != $pagina) 
						echo "<li><a href='".$link.$i."'>".$i."</a></li>";
					else 
						echo "<li class='active'><span>".$i."</span></li>";
				}

				if($pagina < $paginas) 
					echo "<li><a href='".$mais."'>»</a></li>";
			echo "</ul>";
		echo "</div>";
	}

}

function find($tabela,$options=array()){
	$var = array();

	if(!isset($options['join']))
		$join = '';
	else
		$join =" ".$options['join'];

	if(!isset($options['fields']))
		$options['fields'] = "*";

	if(!isset($options['where']) OR $options['where'] == "")
		$options['where'] = "";
	else
		$options['where'] = " WHERE ".$options['where'];

	if(!isset($options['orderBy']))
		$options['orderBy'] = " ORDER BY ".$tabela.".created DESC";
	else
		$options['orderBy'] = " ORDER BY ".$options['orderBy'];

	if(!isset($options['limit']))
		$options['limit'] = "";
	else
		$options['limit'] = " LIMIT ".$options['limit'];

	//echo "SELECT ".$options['fields']." FROM ".$tabela.$options['where'].$options['orderBy'].$options['limit'];

	$sel = mysql_query("SELECT ".$options['fields']." FROM ".$tabela.$join.$options['where'].$options['orderBy'].$options['limit']) or die ('Erro na tabela(find) '.mysql_error());

	//echo "SELECT ".$options['fields']." FROM ".$tabela.$join.$options['where'].$options['orderBy'].$options['limit'];

	$total = mysql_num_rows($sel);
	for ($i=0; $i < $total; $i++) { 
		$var[] = mysql_fetch_assoc($sel);
	}

	return $var;
}

function somethingExists($tabela,$campo,$valor){
	if (!is_numeric($valor))
		$valor = "'".$valor."'";

	$sel = mysql_query("SELECT ".$campo." FROM ".$tabela." WHERE ".$campo." = ".$valor) or die (mysql_error());
	echo "SELECT ".$campo." FROM ".$tabela." WHERE ".$campo." = ".$valor;
	$total = mysql_num_rows($sel);

	if ($total == 0)
		return false;
	else if ($total > 0)
		return true;
	else
		return false;
}

function findOne($tabela,$campo,$valor){
	if (!is_numeric($valor))
		$valor = "'".$valor."'";

	$sel = mysql_query("SELECT * FROM ".$tabela." WHERE ".$campo." = ".$valor." LIMIT 1");
	$var = mysql_fetch_assoc($sel);
	return $var;
}

function findList($tabela,$camposLista,$options=array()){

	if(!isset($options['where']))
		$options['where'] = "";
	else
		$options['where'] = " WHERE ".$options['where'];
	if(!isset($options['orderBy']))
		$options['orderBy'] = "";
	else
		$options['orderBy'] = " ORDER BY ".$options['orderBy'];

	$sel = mysql_query("SELECT id, ".$camposLista." FROM ".$tabela.$options['where'].$options['orderBy']) or die ('Erro na tabela'.mysql_error());

	$total = mysql_num_rows($sel);

	for ($i=0; $i < $total; $i++) { 
		$var[] = mysql_fetch_assoc($sel);
	}

	foreach ($var as $value) {
		$varChaves[] = $value['id'];
	}
	foreach ($var as $value) {
		$varCampos[] = $value[$camposLista];
	}
	// Cria um array com as chaves sendo o id e os valoes sendo os valores dos campos
	$var = array_combine($varChaves, $varCampos);

	return $var;
}

?>