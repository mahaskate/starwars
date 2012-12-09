<?php

$rotas[] = rota("/contato/novo",array("controller"=>"home","action"=>"index"));
$rotas[] = rota("/contato",array("controller"=>"home","action"=>"index"));

// Tem que ser por ultimo
//$rotas[] = rota("*",array("controller"=>"home","action"=>"index",'firstVar'=>true));
?>