<?php
session_start();
//CONFIGURAÇÕES
//COLOQUE AQUI A RAIZ
$root = root();

//carrega engine para o crud
require "crud.php";
//Carrega variaveis de configuração
require "../vars/vars.php";
//Carrega rota
require "../router/rotas.php";

//Se não setar titulo insere o titulo default
if (!isset($titulo))
	$titulo = "Star Wars Framework";

//função ROTA

function root(){
	$conflen=strlen('SCRIPT');
	$B=substr(__FILE__,0,strrpos(__FILE__,'/'));
	$A=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
	$C=substr($B,strlen($A));
	$posconf=strlen($C)-$conflen-1;
	$D=substr($C,1,$posconf);
	$host='http://'.$_SERVER['SERVER_NAME'].'/'.$D;
	return $host;
}

function rota($caminho,$redirect = array()){
	$i = explode("/", $caminho);
	$i = count($i)-1;
	$rotas = array('url'=>$caminho,'controller'=>$redirect['controller'],'action'=>$redirect['action'],'params'=>$i);
	return $rotas;
}

//função insere todos os css e script
function coreHead(){
	$r = "<link rel='stylesheet' href='".root()."garagem/css/bootstrap.css' type='text/css' media='screen' charset='utf-8'>";
	$r .= "<link rel='stylesheet' href='".root()."garagem/css/core.css' type='text/css' media='screen' charset='utf-8'>";
	$r .= "<script src='".root()."garagem/js/jquery.js' type='text/javascript'></script>";
	$r .= "<script src='".root()."garagem/js/bootstrap.js' type='text/javascript'></script>";
	$r .= "<script src='".root()."garagem/js/core.js' type='text/javascript'></script>";
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

	require "../mvc/view/".$controller."/".$action.".php";
}

//Pega variaveis por get
function param($num){
	global $param;
	return $param[$num];
}

//conecta no banco de dados
header('Content-Type: text/html; charset=utf-8');
/*$link = mysql_connect ($servidor,$usuario_bd) or die ("Erro ao conectar no banco de dados: ".mysql_error());
mysql_set_charset("utf8",$link);
$db = mysql_select_db ($bd) or die ("Erro ao encontrar o banco de dados: ".mysql_error());
*/

function element($element) {
	global $root;
	$r = require "../mvc/view/element/".$element.".php";
	return $r;		
}

function css($css){
	global $root;
	$r = "<link rel='stylesheet' href='".$root."/garagem/css/".$css.".css' type='text/css' media='screen' charset='utf-8'>";
	return $r;
}

function script($script){
	global $root;
	$r = "<script src='".$root."/garagem/js/".$script.".js' type='text/javascript'></script>";
	return $r;
}
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
//Link
function a($conteudo,$destino){
	$r = "<a href=''>".$conteudo."</a>";
	return $r;
}
//Inserir imagem
function img($img){
	global $root;
	$r = "<img src='".$root."/garagem/img/".$img."'>";
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
		$r = "<div class='flash'>";
		$r .= $_SESSION['flash'];
		$r .= "</div>";
		unset($_SESSION['flash']);
		return $r;
	}
}

/**
* Função Hash
*/
function hashIt($a){
	global $salt;
	$a = md5($a.$salt);
	return $a;
}


/**
* Gera Senha aleatoria
*
* @author Thiago Belem <http://blog.thiagobelem.net/gerando-senhas-aleatorias-com-php/>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terá letras maiúsculas
* @param boolean $numeros Se terá números
* @param boolean $simbolos Se terá símbolos
* 
*/
function passwordGen($tamanho = 8, $maiusculas = false, $numeros = true, $simbolos = false){
$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';
$retorno = '';
$caracteres = '';

$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;

$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {
$rand = mt_rand(1, $len);
$retorno .= $caracteres[$rand-1];
}
return $retorno;
}

/**
* Gera um token de 32 Caracteres
*/
function tokenGen(){
	$a = passwordGen(32);
	$a = md5($a);
	return $a;
}

/**
* Função anti sql injection
*/
function antiInjection($a){
	$a = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$a);// remove palavras que contenham sintaxe sql
	$a = trim($a);//limpa espaços vazio
	$a = strip_tags($a);//tira tags html e php
	$a = addslashes($a);//Adiciona barras invertidas a uma string
	return $a;
}

?>