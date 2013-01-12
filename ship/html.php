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

	//Explide action para ver se faz parte da rota de admin
	$admin = explode('_',$options['action']);


	//Se action explodida por "_" exisite e a primeira pos for admin, faz a logica do admin, caso contrario vai busca nas rotas
	if (isset($admin[0]) AND $admin[0] == 'admin') {
		$caminho = root()."/admin/".$options['controller']."/".$admin[1].$vars;
	}else{
		$totalRotas = count($rotas);
		if ($totalRotas > 0){
			foreach ($rotas as $key => $rota) {
				if ($rota['controller']."/".$rota['action'] == $options['controller']."/".$options['action']) {
					$caminho = root()."/".$rota['rota'].$vars; 
				}
			}
		}
	}
	//Caso n seja da rota do admin e nem nas rotas ele redireciona para o caminho normal
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