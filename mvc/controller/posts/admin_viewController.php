<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$post = findOne('posts','id',$vars[0]);
redirect (array('controller'=>'erros','action'=>'404'));
?>
