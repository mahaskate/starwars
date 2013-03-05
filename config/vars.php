<?php
//Salt para segurança
$salt = "1234567890";

//Caminho do Jquery padrão
$jquery = '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js';
//$jquery = assets('jquery.min','js');

//Auth
//Configuraç~ões de login
$login = array('controller'=>'login','action'=>'home');
$loginRedirect = array('controller'=>'pages','action'=>'home');
$logoutRedirect = array('controller'=>'posts','action'=>'list');

//Nome da área administrativa
$admin_prefix = 'admin';

//Varivaies de banco de dados
$server_db = "localhost";
$db = "starwars";
$user_db = "root";
$password_db = "";
?>