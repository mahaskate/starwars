<?php 

function component($caminho){
	return path("/mvc/controller/components".$caminho.".php");
}

?>