<?php
//conecta no banco de dados
header('Content-Type: text/html; charset=utf-8');
$link = mysql_connect ($servidor,$usuario_bd) or die ("Erro ao conectar no banco de dados: ".mysql_error());
mysql_set_charset("utf8",$link);
$db = mysql_select_db ($bd) or die ("Erro ao encontrar o banco de dados: ".mysql_error());

?>