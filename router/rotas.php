<?php

// Define Home
$home = array("controller"=>"posts","action"=>"list");
// Define Rotas
$rotas[] = rota("/criar",array("controller"=>"posts","action"=>"add"));
$rotas[] = rota("/post",array("controller"=>"posts","action"=>"view",'varsQuant'=>1));

// Tem que ser por ultimo
//$rotas[] = rota("*",array("controller"=>"teste","action"=>"teste"));
?>