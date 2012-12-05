<?php
//Insere core por que qualquer pagina que venha a ser abreta aqui usa o core
require "../ship/core.php";

if (isset($_GET['url'])) {
	$urlCompleta = $_GET['url'];
	$url = explode("/", $urlCompleta);
	$total = count($url);
	//faz um loop nas rotas se existir alguma redireciona
	foreach ($rotas as $key => $value) {
		// Explode URL COMPLETA E PEGA SOH A PARTE SEM APRAMETRO
		//echo $urlCompleta;
		$urlCompletaFinal = "";
		if ($total >= $value['params']) {
			for ($i=0; $i < $value['params']; $i++) { 
				$urlCompletaFinal .= "/".$url[$i];
			}
		}else{
			$urlCompletaFinal = $urlCompleta;
		}
		/* FIM */
		if ($urlCompletaFinal == $value['url']) {
			$controller = $value['controller'];
			$action = $value['action'];

			for ($i=$value['params']; $i < $total; $i++) { 
				$param[] = $url[$i];
			}

			require "../mvc/controller/".$controller.".php";
			//Recebe a variavel para incluir o layout, se vazio inclui o default
			if (!isset($layout))
				$layout = "default";

			require "../mvc/view/layout/".$layout.".php";
			exit();
		}
	}
	//FIM FOREACH
}else{
	foreach ($rotas as $key => $value) {
		if ($value['url'] == "/"){
			$controller = $value['controller'];
			$action = $value['action'];

			require "../mvc/controller/".$controller.".php";

			//Recebe a variavel para incluir o layout, se vazio inclui o default
			if (!isset($layout))
				$layout = "default";

			require "../mvc/view/layout/".$layout.".php";
			exit();
		}
	}

}

//Se não redirecionar pelas rotas a url deve conter no minimo dois parametros
if ($total < 2) {
	echo "url inválida, manda 404";
	exit();
}else{
	$controller = $url[0];
	$action = $url[1];
	for ($i=2; $i < $total; $i++) { 
		$param[] = $url[$i];
	}
}

if (file_exists("../mvc/view/".$controller."/".$action.".php")) {
	require "../mvc/controller/".$controller.".php";
	//Recebe a variavel para incluir o layout, se vazio inclui o default
	if (!isset($layout))
		$layout = "default";
	require "../mvc/view/layout/".$layout.".php";
}else{
	echo "url inválida";
}
?>
