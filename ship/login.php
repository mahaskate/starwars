<?php

function login($username,$password,$campos=array()){
	$dados = "";

	if (isset($campos)) {
		foreach ($campos as $key => $value) {
			$dados .= $value.",";
		}
	}

	$dados = $dados."username,role_id";

	$username = antiInjection($username);
	$password = hashIt($password);

	$verify = mysql_query("SELECT ".$dados." FROM users WHERE username ='".$username."' AND password = '".$password."'") or die (mysql_error());
	$conta = mysql_num_rows($verify);
	$auth = mysql_fetch_assoc($verify);
	if ($conta == 1) {
		$_SESSION['auth'] = true;
		$dados = explode(',',$dados);
		foreach ($dados as $value) {
			$_SESSION['auth_'.$value] = $auth[$value];
		}
		//Se a variavel URLTEMP estiver setado redireciona para ela, caso contrario só retorna true e deixa rolar
		if (isset($_SESSION['tempUrl'])) {
			$temp = $_SESSION['tempUrl'];
			unset($_SESSION['tempUrl']);
			header("location: ".$temp);
			exit();
		}
		return true;
	}else{
		return false;
	}
}

function acl($options=array()){
	global $login;
	if (!empty($options)) {
		$tipo = array_keys($options);
		$tipo = $tipo[0];
	}
	//Primeiro verifica se está logado, caso contraio nem faz os restos dos testes
	if (!$_SESSION['auth']) {
		$_SESSION['tempUrl'] = $_SERVER['REQUEST_URI'];
		redirect($login);
	}

	//Verifica se a variavel n está vazia.. pois caso esteja não faz nada e simplesmente a função servira para ver se o usuario está logado
	if (!empty($options)){
		foreach ($options[$tipo] as $value) {
			$ids[] = $value;
		}

		if ($tipo == 'allow') {
			if (in_array($_SESSION['auth_role_id'], $ids)) {
				return true;
			}else{
				redirect($login);
			}
		}elseif ($tipo == 'deny') {
			if (!in_array($_SESSION['auth_role_id'], $ids)) {
				return true;
			}else{
				redirect($login);
			}
		}
		return false;
	}
}

function logout(){
	global $logoutRedirect;

	if (session_destroy()) {
		redirect($logoutRedirect);
	}else{
		setFlash('Erro ao fazer o logout','error');
	}
}

?>