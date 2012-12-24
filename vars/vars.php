<?php
//Salt para segurança
$salt = "dasdasdhasdas897ds89a8as";
//Auth
//Endereço da tela de login
$login = array('controller'=>'users','action'=>'login');
//Endereço que será direcionado após o logout
$logoutRedirect = array('controller'=>'posts','action'=>'list');
//Varivaies de banco de dados
$bd = "cake";
$senha_bd = "";
$usuario_bd = "root";
$servidor = "localhost";
?>