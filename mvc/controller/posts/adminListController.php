<?php
acl();

$layout = 'admin';

$pluginsJsCss = array('tablesorter'=>array('style'));
$pluginsJs = array('tablesorter'=>array('tablesorter'));

$paginationLimit = 1;

$total = totalRecords('posts');
$posts = pagination('posts');

?>