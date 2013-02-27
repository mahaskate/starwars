<?php
//Insere core por que qualquer pagina que venha a ser abreta aqui usa o core
require "../core.php";
// Se variavel url existir faz os testes, caso contrario faz o include da home
if (isset($_GET['url'])) {
	//variaveis da URL
	$urlReal = $_GET['url'];
	// Se o cara colocar barra no final ele ignora
	if (substr($urlReal, -1) == "/")
		$urlReal = substr($urlReal, 0, -1);

	//foreach das rotas
	foreach ($rotas as $key => $value) {
		$erro = 1;
		unset($vars);

		$url = $urlReal;
		$urlSplit = explode('/', $url);
		$urlTotal = count($urlSplit);

		//Explode rota
		$rotaSplit = explode('/', $value['rota']);
		$rotaTotal = count($rotaSplit);
		if ($rotaSplit[0] == '*' AND $urlTotal > 1) {
			$vars[] = $urlSplit[0];
			unset($urlSplit[0]);
			$urlSplit = array_values($urlSplit);
			$urlTotal = count($urlSplit);
			$url = implode('/', $urlSplit);
			$value['rota'] = substr($value['rota'], 2);
			unset($rotaSplit[0]);
			$rotaSplit = array_values($rotaSplit);
		}else if ($value['rota'] == '*'){
			$vars[] = $urlSplit[0];
			$controller = $value['controller'];
			$action = $value['action'];
			$erro = 0;
			break;	
		}

		$rotaSplit = explode('/', $value['rota']);
		$rotaTotal = count($rotaSplit);

		if ($urlTotal >= $rotaTotal AND $urlTotal <= ($rotaTotal + $value['vars'])) {
			$url = '';
			for ($i=0; $i < $rotaTotal; $i++) { 
				$url .= $urlSplit[$i].'/';
			}
			$url = substr($url, 0, -1);


			if ($url == $value['rota']) {
				if ($value['vars'] > 0) {
					for ($i = $rotaTotal; $i < $urlTotal; $i++) { 
						$vars[] = $urlSplit[$i];
					}
				}
				$erro = 0;
				$controller = $value['controller'];
				$action = $value['action'];
				break;
			}
		}else{
			$erro = 1;
		}
	}

	if ($erro == 1) {
		$erro = 0;
		$urlSplit = explode('/', $urlReal);
		$urlTotal = count($urlSplit);
		unset($vars);

		if ($urlSplit[0] == 'admin' AND $urlTotal > 2) {
			$controller = $urlSplit[1];
			$action = 'admin_'.$urlSplit[2];
			if ($urlTotal > 3) {
				for ($i=3; $i < $urlTotal; $i++) { 
					$vars[] = $urlSplit[$i];
				}
			}
		} else{
			if ($urlTotal > 1) {
				$controller = $urlSplit[0];
				$action = $urlSplit[1];
				if ($urlTotal > 2) {
					for ($i=2; $i < $urlTotal; $i++) { 
						$vars[] = $urlSplit[$i];
					}
				}
			}
		}
	}

}else{
	$erro = 0;
	$controller = $home['controller'];
	$action = $home['action'];
}

if (isset($controller) AND isset($action)) {	
	if (file_exists(path("/mvc/controller/".$controller."/".$action."Controller.php"))){
		require path("/mvc/controller/".$controller."/".$action."Controller.php");
		if (!isset($layout))
			$layout = "default";
		require path("/mvc/view/layout/".$layout.".war");
	}else
		$erro = 1;
}else{
	$erro = 1;
}

if ($erro == 1) {
	echo 'erro 404';
}