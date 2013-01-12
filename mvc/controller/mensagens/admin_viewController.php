<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$mensagen = findOne('mensagens','id',$vars[0]);
?>
