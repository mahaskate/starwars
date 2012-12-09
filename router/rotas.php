<?php

// Define Home
$home = array("controller"=>"teste","action"=>"teste",'quantVars'=>2);
// Define Rotas
$rota[] = rota("/novo/denovo",array("controller"=>"teste","action"=>"teste",'varsQuant'=>1));
$rotas[] = rota("/novo/denovo",array("controller"=>"teste","action"=>"teste",'varsQuant'=>1));

// Tem que ser por ultimo
$rotas[] = rota("*",array("controller"=>"teste","action"=>"teste"));
?>