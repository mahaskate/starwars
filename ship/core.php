<?php
session_start();

error_reporting(E_ALL);

//CONFIGURAÇÕES
//COLOQUE AQUI A RAIZ
$_SESSION['root'] = root();

if($_POST)
	$data = $_POST;


//carrega engine para o crud
require "crud.php";
require "login.php";
require "util.php";
require "html.php";
require "uploadFiles.php";
require "components.php";
//Carrega variaveis de configuração
require "../vars/vars.php";
//require "database.php";
//Carrega rota
require "../router/rotas.php";

//Se não setar titulo insere o titulo default
if (!isset($titulo))
	$titulo = "Star Wars Framework";

function pluginJs($a){
	echo "<script type='text/javascript' src='".root()."/plugins/".$a."/js/".$a.".js'></script>";
	require "../plugins/".$a."/core.php";
}

function path($caminho){
	return "../garagem/".$caminho;
}

function getValues(){
	$parametros = explode("?", $_SERVER['REQUEST_URI']);
	//Se array possuir duas posições significa que teve parametros por get passado, caso contrario passa uma variavel vazia
	if (count($parametros)!=1) {
		$parametros = $parametros[1];
		$parametros = explode("&", $parametros);
		foreach ($parametros as $value) {
			//Explode cada valor do array para separar nome de valor para montar o array depois com chave e valor respectivo
			$id = explode('=',$value);
			$chave[] = $id[0];
			//Decode por causa de acentos e espaços
			$valor[] = urlDecode($id[1]);
		}
		$array = array_combine($chave, $valor);
		return $array; 
	}else{
		$array = null;
		return $array;
	}
	
}

function btnDelete($valor,$msg,$id,$options=array()){
	if (!isset($options['class'])) {
		$options['class'] = "";
	}
	$destino = "/".$options['controller']."/".$options['action'];
	$on = "return deleteAjax(/post/delete,'quer',1)/";
	$r = "<button class='btn ".$options['class']."' onclick='".$on."'>".$valor."</button>";
	return $r;
}

function ajaxPost($options=array()){
	$parametros = "";
	foreach ($options['valores'] as $key => $value) {
		$parametros .= $key.":'".$value."',";
	}
	$parametros = substr($parametros, 0, -1);
	$r = "<script type='text/javascript'>";
		$r .= "$(document).ready(function(){
			if(confirm('oiiiiiiiiii')){
				$.post('".root()."/mvc/ajax/".$options['controller']."/".$options['action'].".php',{".$parametros."},function(callback){
					return callback;

				});
			}else{
				return false;

			}
		});";
	$r .= "</script>";
	echo $r;
}

// Função de rota
function urlFinal($urlExplode = array(),$flag=0){
	$urlFinal = "";
	foreach ($urlExplode as $value) {
		$urlFinal .= $value."/";
	}
	$urlFinal = substr($urlFinal, 0, -1);
	return $urlFinal;
}

//função ROTA

function root(){
	$root = $_SERVER['SERVER_NAME'];
	if ($root == "localhost" OR preg_match("/192.168/", $root)) {
		$root = $_SERVER['PHP_SELF'];
		$root = explode("/",$root);
		$root = "/".$root[1];
	}else{
		$root = "http://".$_SERVER['SERVER_NAME'];
	}
	return $root;
}

function rota($rota,$parametros = array()){
	// Variaveis recebem valor default
	if (!isset($parametros['varsQuant']))
			$parametros['varsQuant'] = 0;
	if (!isset($parametros['infiniteVars']))
			$parametros['infiniteVars'] = false;
	if (!isset($parametros['firstVar']))
			$parametros['firstVar'] = false;
	if ($parametros['firstVar'] == true)
		$parametros['varsQuant']++;
	if ($rota == "*")
		$parametros['firstVar'] = true;

	if ($rota != '*')
		$rota = substr($rota, 1);
	
	$rotaExplode = explode("/", $rota);
	$rotaTotal = count($rotaExplode);

	$rotas = array('rota'=>$rota, 'controller' => $parametros['controller'], 'action' => $parametros['action'], 'varsQuant' => $parametros['varsQuant'],'infiniteVars'=>$parametros['infiniteVars'],'firstVar'=>$parametros['firstVar'],'rotaTotal'=>$rotaTotal);
	return $rotas;
}

//função insere todos os css e script
function scriptCore(){
	global $pluginsJs;

	$r = "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>";
	$r .= "<script src='".root()."/garagem/js/bootstrap.min.js' type='text/javascript'></script>";
	$r .= "<script src='".root()."/garagem/js/core.js' type='text/javascript'></script>";

	if (!empty($pluginsJs)) {
		foreach ($pluginsJs as $key =>$value) {
			foreach ($value as $js){
				$r .= "<script src='".root()."/pluginsJs/".$key."/js/".$js.".js' type='text/javascript'></script>";
			}
			$r .= "<script src='".root()."/pluginsJs/".$key."/core.js' type='text/javascript'></script>";
		}
	}
	return $r;
}

function cssCore(){
	global $pluginsJsCss;

	$r = "<link rel='stylesheet' href='".root()."/garagem/css/bootstrap.min.css' type='text/css' media='screen'>";
	$r .= "<link rel='stylesheet' href='".root()."/garagem/css/core.css' type='text/css' media='screen'>";

	if (!empty($pluginsJsCss)) {
		foreach ($pluginsJsCss as $key =>$value) {
			foreach ($value as $css){
				$r .= "<link rel='stylesheet' href='".root()."/pluginsJs/".$key."/css/".$css.".css' type='text/css' media='screen'>";
			}
		}
	}

	return $r;
}

function favicon($favicon){
	global $root;
	$r = "<link rel='shortcut icon' href='".$root."/garagem/img/".$favicon.".ico' type='image/x-icon' />";
	return $r;
}

/**
* Insere conteúdo no layout
* 
*/
function content(){
	global $controller;
	global $action;

	$r = "../mvc/view/".$controller."/".$action.".war";
	return $r;
}

// Insere vazio em variaveis

//Pega variaveis por get
function param($num){
	global $param;
	return $param[$num];
}

function element($element) {
	global $root;
	$r = require "../mvc/view/element/".$element.".war";
	return $r;		
}

function css($css){
	global $root;
	$r = "<link rel='stylesheet' href='".$root."/garagem/css/".$css.".css' type='text/css' media='screen' charset='utf-8'>";
	return $r;
}

function script($script){
	$r = "<script src='".root()."/garagem/js/".$script.".js' type='text/javascript'></script>";
	return $r;
}

/**
* Função Inserir uma mensagem tipo flash
*
* @param string $msg Mensagem que será exibida
* @param string $style Estilo de cor da caixa
* @param boolean $close Se a caixa terá a opção de ser fechada
*
* @return string Caixa de mensagem com a mensagem setada
*/
function setFlash($msg,$style=null,$close=true){

	if(!is_null($style))
		$style = "alert-".$style;
	$r =  "<div class='alert ".$style."'>";
		if ($close)
			$r .= "<button type='button' class='close' data-dismiss='alert'>×</button>";
		$r .= $msg;
	$r .= "</div>";
	$_SESSION['flash'] = $r;
}
//Container que exibirá a mensagem flash
function flash(){
	if(isset($_SESSION['flash'])){
		$r = "<div id='flash' class='flash'>";
			$r .= $_SESSION['flash'];
		$r .= "</div>";
		unset($_SESSION['flash']);
		return $r;
	}
}

function redirect($options = array(null)){
	global $rotas;
	if (count($rotas) > 0){
		foreach ($rotas as $key => $rota) {
			if ($rota['controller']."/".$rota['action'] == $options['controller']."/".$options['action']) {
				header("Location: ".root()."/".$rota['rota']);
				exit();
			}
		}
	}
	header("Location: ".root()."/".$options['controller']."/".$options['action']);
	exit();
}

?>