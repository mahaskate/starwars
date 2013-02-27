<?php
session_start();

error_reporting(E_ALL);

//CONFIGURAÇÕES
//COLOQUE AQUI A RAIZ
$_SESSION['root'] = root();

if($_POST)
	$data = $_POST;

//path
function path($a){
	$root = $_SERVER['SERVER_NAME'];
	$folder = $_SERVER['SCRIPT_NAME'];
	$folder = explode("/", $folder);
	$folder = $folder[1];
	if ($root == "localhost" OR preg_match("/192.168/", $root)) {
		$path = $_SERVER['DOCUMENT_ROOT']."/".$folder.$a;
	}else{
		$path = $_SERVER['DOCUMENT_ROOT']."/".$a;
	}
	return $path;
}

//Carrega rota
require path('/config/rotas.php');
//carrega engine para o crud
require "crud.php";
require "login.php";
require "util.php";
require "html.php";
require "uploadFiles.php";
require "components.php";
//Carrega variaveis de configuração
require path('/config/vars.php');
require "bd.php";

//Se não setar titulo insere o titulo default
if (!isset($titulo))
	$titulo = "Star Wars Framework";

function setUrl($controller, $action){
	if (file_exists(path("/mvc/controller/".$rota['action']."Controller.php"))){
		$vars[] = $url;
		require path("/mvc/controller/".$controller."/".$rota['action']."Controller.php");
		if (!isset($layout))
			$layout = "default";
		require path("/mvc/view/layout/".$layout.".war")	;
		exit();

	}else{
		echo "404";
		exit();
	}
}

function pluginJs($a){
	echo "<script type='text/javascript' src='".root()."/plugins/".$a."/js/".$a.".js'></script>";
	require path("/assets/js/plugins/".$a."/core.php");
}

function active($path=array()){
	global $controller;
	global $action;

	if (isset($path['action'])) {
		if ($path['controller'] == $controller AND $path['action'] == $action)
			return 'active';
	}else{
		if ($path['controller'] == $controller AND $path['action'] == $action)
			return 'active';
	}
	return '';
}

function getQ($campos=array(),$q){
	$q = antiInjection($q);
	$q = str_replace(' ', '%', $q);
	$arg = "";

	foreach ($campos as $value)
		$arg .= $value." LIKE '%".$q."%' OR ";

	$arg = substr($arg, 0, -4);
	return "(".$arg.")";
}

function keepGet($a,$b){
	$a['pagina'] = $b;
	$r = "?";
	foreach ($a as $key => $value) {
		$r .= $key."=".$value."&";
	}
	$r = substr($r, 0, -1);
	return $r;
}

function varsByGet(){
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

function redirectSelf(){
	header('location: '.$_SERVER['REQUEST_URI']);
}

function request(){
	$r = $_SERVER['REQUEST_METHOD'];
	return $r;
}

function isRequest($type){
	$type = strtoupper($type);
	if ($_SERVER['REQUEST_METHOD'] == $type)
		return true;
	else
		return false;
}

function deleteAjax($label,$question,$options,$id){
	if (!isset($options['class']))
		$class = ' btn-danger btn-mini';
	else
		$class = " ".$options['class'];

	$r = "<button class='btn".$class."' onclick=\"return deleteAjax('".root()."/admin/".$options['controller']."/".$options['action']."','".$question."',".$id.");\">";
		$r .= $label;
	$r .= "</button>";
	return $r;
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

function rota($rota,$parametros = array(),$vars=0){
	// Variaveis recebem valor default
/*	if (!isset($parametros['varsQuant']))
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
	$rotaTotal = count($rotaExplode); */

	$rotas = array('rota'=>$rota, 'controller' => $parametros['controller'], 'action' => $parametros['action'], 'vars'=>$vars);
	return $rotas;
}

//função insere todos os css e script
function scriptCore(){
	global $pluginsJs;
	global $jquery;

	$r = "<script src='".$jquery."'></script>\n";
	$r .= "<script src='".root()."/assets/js/bootstrap.min.js' type='text/javascript'></script>\n";
	$r .= "<script src='".root()."/assets/js/core.js' type='text/javascript'></script>\n";

	if (!empty($pluginsJs)) {
		foreach ($pluginsJs as $key =>$value) {
			foreach ($value as $js){
				$r .= "<script src='".root()."/assets/js/plugins/".$key."/js/".$js.".js' type='text/javascript'></script>\n";
			}
			$r .= "<script src='".root()."/assets/js/plugins/".$key."/core.js' type='text/javascript'></script>\n";
		}
	}
	return $r;
}

function cssCore(){
	global $pluginsJsCss;

	$r = "<link rel='stylesheet' href='".root()."/assets/css/bootstrap.min.css' type='text/css' media='screen'>\n";
	$r .= "<link rel='stylesheet' href='".root()."/assets/css/core.css' type='text/css' media='screen'>\n";

	if (!empty($pluginsJsCss)) {
		foreach ($pluginsJsCss as $key =>$value) {
			foreach ($value as $css){
				$r .= "<link rel='stylesheet' href='".root()."/assets/js/plugins/".$key."/css/".$css.".css' type='text/css' media='screen'>\n";
			}
		}
	}

	return $r;
}

function assets($a,$b){
	return root().'/assets/'.$b.'/'.$a.'.'.$b;
}

function favicon($favicon){
	global $root;
	$r = "<link rel='shortcut icon' href='".root()."/assets/img/".$favicon.".ico' type='image/x-icon' />";
	return $r;
}

/**
* Insere conteúdo no layout
* 
*/
function content(){
	global $controller;
	global $action;

	$r = path("/mvc/view/".$controller."/".$action.".war");
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
	$r = path('/mvc/view/elements/'.$element.'.war');
	return $r;		
}

function css($css){
	global $root;
	$r = "<link rel='stylesheet' href='".root()."/assets/css/".$css.".css' type='text/css' media='screen' charset='utf-8'>\n";
	return $r;
}

function script($script){
	$r = "<script src='".root()."/assets/js/".$script.".js' type='text/javascript'></script>";
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

	//Pegar rota admin
	$explode = explode("_", $options['action']);
	$total = count($explode);
	if ($total == 2) {
		header("Location: ".root()."/admin/".$options['controller']."/".$explode[1]);
		exit();
	}

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