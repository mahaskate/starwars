<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$user = findOne('users','id',$vars[0]);

if (empty($user))
	redirect (array('controller'=>'erros','action'=>'404'));
?>
