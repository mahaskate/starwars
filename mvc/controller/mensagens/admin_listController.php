<?php
acl();
$layout = 'admin';

$pluginsJsCss = array('tablesorter'=>array('style'));
$pluginsJs = array('tablesorter'=>array('tablesorter'));

$paginationLimit = 10;

$total = totalRecords('mensagens');
$mensagens = pagination('mensagens',array('where'=>getQ(array('nome'))));
?>