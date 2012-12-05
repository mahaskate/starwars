<?php

$rotas[] = rota("/",array("controller"=>"home","action"=>"index"));
$rotas[] = rota("/contato/url",array("controller"=>"teste","action"=>"teste"));

$rotas[] = rota("/oi/home",array("controller"=>"home","action"=>"index"));
$rotas[] = rota("/oi",array("controller"=>"teste","action"=>"index"));

?>