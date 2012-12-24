<?php
//conecta no banco de dados
header('Content-Type: text/html; charset=utf-8');




$link = mysql_connect ('tunnel.pagodabox.com','cori','oWrju9HG') or die ("Erro ao conectar no banco de dados: ".mysql_error());
mysql_set_charset("utf8",$link);
$db = mysql_select_db ('dani') or die ("Erro ao encontrar o banco de dados: ".mysql_error());

?>