<?php 

//Link
function a($conteudo,$options=array(),$vars=null){
	global $rotas;

	if(!isset($options['class']))
		$options['class'] = "";

	if(!isset($options['id']))
		$options['id'] = "";

	if (!is_null($vars))
		$vars = "/".$vars;

	if (count($rotas) > 0){
		foreach ($rotas as $key => $rota) {
			if ($rota['controller']."/".$rota['action'] == $options['controller']."/".$options['action']) {
				$caminho = root()."/".$rota['rota'].$vars; 
			}
		}
	}
	if (!isset($caminho))
		$caminho = root()."/".$options['controller']."/".$options['action'].$vars;
	
	$r = "<a href='".$caminho."' id='".$options['id']."' class='".$options['class']."'>".$conteudo."</a>";
	return $r;
}
//Inserir imagem
function img($img){
	$r = "<img src='".root()."/garagem/img/".$img."'>";
	return $r;
}

?>