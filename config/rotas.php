<?php
// Define Home
$home = array("controller"=>"pages","action"=>"home");
// Define Rotas
$rotas[] = rota("login/^[0-9]+$/^[0-9]+$",array("controller"=>"login","action"=>"home"));
?>