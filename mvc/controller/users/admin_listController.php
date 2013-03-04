<?php
acl();
$layout = 'admin';

$pluginsJsCss = array('tablesorter'=>array('style'));
$pluginsJs = array('tablesorter'=>array('tablesorter'));

$paginationLimit = 10;

$varsByGet = varsByGet();

if (isset($varsByGet['q']))
	$clausulas = array('where'=>getQ(array('username'),$varsByGet['q']));
else
	$clausulas = '';

$total = totalRecords('users', $clausulas);
$users = pagination('users', $clausulas);
?>