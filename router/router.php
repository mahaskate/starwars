<?php
//Insere core por que qualquer pagina que venha a ser abreta aqui usa o core
require "../ship/core.php";
// Se variavel url existir faz os testes, caso contrario faz o include da home
if (isset($_GET['url'])) {
	//variaveis da URL
	$url = $_GET['url'];

	// Faz comparação com as rotas
	foreach ($rotas as $key => $rota) {
		// Se o cara colocar barra no final ele ignora
		if (substr($url, -1) == "/")
			$url = substr($url, 0, -1);

		$urlExplode = explode("/", $url);
		$urlTotal = count($urlExplode);

		// Reinicia variavel URL FINAL
		$urlFinal = "";
		// Reinicia variavel VARS
		$vars = "";
		// Se firstVar estiver true e a URL tiver só um parametro, manda pra pagina e passa oq ta digitado como parametro
		if ($rota['rota'] == "*" AND $urlTotal == 1 AND $rota['firstVar'] == true) {
			$controller = $rota['controller'];
			$action = $rota['action'];

			if (file_exists("../mvc/controller/".$rota['action']."Controller.php")){
				$vars[] = $url;
				print_r($vars);
				require "../mvc/controller/".$controller."/".$rota['action']."Controller.php";
				if (!isset($layout))
					$layout = "default";
				require "../mvc/view/layout/".$layout.".war";
				exit();

			}else{
				echo "404";
				exit();
			}
		}
		// Se a url tiver mais de um parametro e o firstVar habilitado ele passa o primeiro parametro como variavel e a url final fica sem o primeiro parametro
		if ($urlTotal > 1 AND $rota['firstVar'] == true) {
			// Já passa o primeiro parametro como variavel
			$vars[] = $urlExplode[0];
			// Deleta o primeiro parametro da url pois ele n faz parte da url
			unset($urlExplode[0]);
			// Remonta array URLEXPLODE
			$i = 0;
			foreach ($urlExplode as $value) {
				$novaUrlExplode[$i] = $value;
				$i++;
			}
			$urlExplode = $novaUrlExplode;
			$urlTotal = count($urlExplode);
		}
		// Url final deve ter a mesma quatidade da rota, o resto é variavel
		if ($urlTotal >= $rota['rotaTotal']) {
			for ($i=0; $i < $rota['rotaTotal']; $i++) { 
				$urlFinal .= $urlExplode[$i]."/";
			}
			$urlFinal = substr($urlFinal, 0, -1);
		}
		// Carrega variaveis, ou seja, oq não é url vira variavel
		for ($i=$rota['rotaTotal']; $i < $urlTotal; $i++) { 
			$vars[] = $urlExplode[$i];
		}

		if (is_array($vars))
			$varsTotal = count($vars);
		else
			$varsTotal = 0;

		if ($rota['infiniteVars'] == true OR $varsTotal == $rota['varsQuant']) {	
			if ($urlFinal == $rota['rota']) {
				$controller = $rota['controller'];
				$action = $rota['action'];

				if (file_exists("../mvc/controller/".$controller."/".$rota['action']."Controller.php")){
					require "../mvc/controller/".$controller."/".$rota['action']."Controller.php";
					if (!isset($layout))
						$layout = "default";
					require "../mvc/view/layout/".$layout.".war";
					exit();

				}else{
					echo "404";
					exit();
				}
			}
		}
	}


	// Se não casar com nenhuma rota direciona para o caminho normal
	$urlExplode = explode("/", $url);
	$urlTotal = count($urlExplode);
	$vars = "";
	// Se tiver mais de 1 parametro OK caso contrario 404
	if ($urlTotal > 1) {
		$controller = $urlExplode[0];
		$action = $urlExplode[1];
		// Se quantidade de parametros forem maiores que dois monta array com variaveis a serem passadas
		if ($urlTotal > 2) {
			for ($i=2; $i < $urlTotal; $i++) { 
				$vars[] = $urlExplode[$i];
			}
		}

		// Redireciona
		if (file_exists("../mvc/controller/".$controller."/".$action."Controller.php") == true){
			require "../mvc/controller/".$controller."/".$action."Controller.php";
			if (!isset($layout))
				$layout = "default";
			require "../mvc/view/layout/".$layout.".war";
			exit();
		}else{
			echo "404";
			exit();
		}
	}else{
		echo "404";
	}


}else{
	$controller = $home['controller'];
	$action = $home['action'];

	if (file_exists("../mvc/controller/".$controller."/".$home['action']."Controller.php")){
		require "../mvc/controller/".$controller."/".$home['action']."Controller.php";
		if (!isset($layout))
			$layout = "default";
		require "../mvc/view/layout/".$layout.".war";
		exit();

	}else{
		echo "Nenhuma home como padrão";
		exit();
	}
}