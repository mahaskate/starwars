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

function ola($conteudo,$options=array(),$vars=null){


	if(!isset($options['class']))
		$options['class'] = "";

	$check = explode('_', $options['action']);

	if (isset($check[0]) AND $check[0] == 'admin')
		$caminho = root()."/admin/".$options['controller']."/".$check[1];
	else
		$caminho = root()."/".$options['controller']."/".$options['action'];

	$vars = json_encode($vars);
	
	$r = "<button class='btn' id='".$options['id']."' url='".$caminho."' vars='".$vars."'>".$conteudo."</button>\n";
	$r .= "<div></div>";

	return $r;
}

function toModal($conteudo,$options=array(),$vars=null){


	if(!isset($options['class']))
		$options['class'] = "";

	$check = explode('_', $options['action']);

	if (isset($check[0]) AND $check[0] == 'admin')
		$caminho = root()."/admin/".$options['controller']."/".$check[1];
	else
		$caminho = root()."/".$options['controller']."/".$options['action'];

	$vars = json_encode($vars);
	
	$r = "<button class='btn ".$options['class']."' id='".$options['id']."'>".$conteudo."</button>\n";
	$r .= "<div></div>";
	$r .= "<script>\n";
		$r .= "\t$(function(){
			\t$(\"button#".$options['id']."\").click(function(){\n
				\t\t$(this).next(\"div\").load(\"".$caminho."\",function(){\n
					\t\t\t$(\"#".$options['id']."\").modal(\"show\");\n
				\t});\n
			});
		});\n";
	$r .= "</script>\n";

	return $r;
}


function modal(){
	$r = "<div class='modal hide fade' id='myModal'>";
	return $r;
}

function modalEnd(){
	$r = "</div>";
	return $r;
}

?>