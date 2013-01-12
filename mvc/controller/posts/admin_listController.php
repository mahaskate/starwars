<?php
acl();
$layout = 'admin';

$pluginsJsCss = array('tablesorter'=>array('style'));
$pluginsJs = array('tablesorter'=>array('tablesorter'));

$paginationLimit = 30;

$total = totalRecords('posts');
$posts = pagination('posts',array('where'=>getQ(array('title'))));
?>