<?php
//Insere core por que qualquer pagina que venha a ser abreta aqui usa o core
require "../ship/core.php";

// Se variavel url existir faz os testes, caso contrario faz o include da home
if (isset($_GET['url'])) {
	//variaveis da URL
	$url = $_GET['url'];
	// Se o cara colocar barra no final ele ignora
	if (substr($url, -1) == "/")
		$url = substr($url, 0, -1);

	$urlExplode = explode("/", $url);
	$urlTotal = count($urlExplode);

	echo $_SERVER['HTTP_HOST'];

	// Faz comparação com as rotas
	foreach ($rotas as $key => $rota) {
		
	}

}else{
	echo "entra home";
}
