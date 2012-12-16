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

?>