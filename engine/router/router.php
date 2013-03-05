<?php
//Insere core por que qualquer pagina que venha a ser aberta aqui usa o core
require "../core.php";

//Primeiro testa se não existe pq caso n existe nem faz teste nenhum e já abre a home, oq agiliza a abertura da home que eh a pagina principal do app
if(!isset($_GET['url'])){
	$controller = $home['controller'];
	$action = $home['action'];
	$casou = 1;
}else{
	//variaveis da URL
	$url = $_GET['url'];
	$urlSplit = explode('/', $url);
	$urlTotal = count($urlSplit);
	$casou = 0;
	foreach ($rotas as $key => $rota) {
		//Somente faz as comparações se a rota possuir o mesmo numero de elementos da url
		if ($urlTotal == $rota['total']) {
			$count = 0;
			//Zera o array de variaveis
			$vars = array();
			//Faz um for echa na rota explodida e comparada cada elemento para ver se casa
			foreach ($rota['split'] as $key => $splited) {
				if ($splited[0] == "^") {
					if(preg_match("'".$splited."'", $urlSplit[$count])){
						$casou = 1;
						$vars[] = $urlSplit[$count];
					}else{
						$casou = 0;
					}
				}else if($splited == $urlSplit[$count]){
					$casou = 1;

				}else{
					$casou = 0;
					break;
				}
				$count++;
			}
			if($casou == 1){
				$controller = $rota['controller'];
				$action = $rota['action'];
				break;
			}
		}
	}
}

$vars = array();

if($casou == 0){
	if ($urlTotal >= 3 AND $urlSplit[0] == $admin_prefix){
		$controller = $urlSplit[1];
		$action = "admin_".$urlSplit[2];
		//Carrega variaveis
		if($totalUrl > 3){
			for ($i=3; $i < $urlTotal; $i++) { 
				$vars[] = $urlSplit[$i];
			}
		}
	}else if($urlTotal >= 2 AND $urlSplit[0] != $admin_prefix){
		$controller = $urlSplit[0];
		$action = $urlSplit[1];
		if($urlTotal > 2){
			for ($i=2; $i < $urlTotal; $i++) { 
				$vars[] = $urlSplit[$i];
			}
		}
	}
}
if (isset($controller) == false AND isset($action) == false) {
	$controller = "";
	$action = "";
}
if (file_exists(path("/mvc/controller/".$controller."/".$action."Controller.php"))){
	$casou = 1;
}else{
	$controller = 'errors';
	$action = '404';
}
require path("/mvc/controller/".$controller."/".$action."Controller.php");
if (!isset($layout))
	$layout = "default";
require path("/mvc/view/layout/".$layout.".war");