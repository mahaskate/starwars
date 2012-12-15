<?php
$titulo = 'Meu titulo';

$usuarios = find('users',array('fields'=>"DATE_FORMAT(created,'%d/%m/%Y') AS created"));

?>