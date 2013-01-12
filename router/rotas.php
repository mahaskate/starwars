<?php

// Define Home
$home = array("controller"=>"posts","action"=>"list");
// Define Rotas
$rotas[] = rota("/criar",array("controller"=>"posts","action"=>"add"));
$rotas[] = rota("/editar",array("controller"=>"posts","action"=>"edit",'varsQuant'=>1));
$rotas[] = rota("/post",array("controller"=>"posts","action"=>"view",'varsQuant'=>1));
$rotas[] = rota("/admin",array("controller"=>"posts","action"=>"admin_list"));

// Tem que ser por ultimo
//$rotas[] = rota("*",array("controller"=>"posts","action"=>"view"));
?>