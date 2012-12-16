<?php 
if (!isset($vars[0]))
	$vars[0] = 0;
$post = findOne('posts','id',$vars[0],array('fields'=>"title, body, date_format(created,'%d/%m/%Y') AS created"));

$titulo = "Post - ".$post['title'];

?>