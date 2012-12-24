<?php 

/***
 * Função para remover acentos de uma string
 *
 * @autor Thiago Belem <contato@thiagobelem.net>
 */
function slug($str){
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

function limitaFrase($frase,$limite){
	$conta = strlen($frase);
	if($conta > $limite){
		$frase = substr($frase,0,$limite);
		$frase = $frase."...";
	}
	return ($frase);
}

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
	//$a = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$a);// remove palavras que contenham sintaxe sql
	$a = trim($a);//limpa espaços vazio
	$a = strip_tags($a);//tira tags html e php
	$a = addslashes($a);//Adiciona barras invertidas a uma string
	return $a;
}

?>