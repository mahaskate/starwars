<?php 
$titulo = "Posts";

$posts = find('posts',array('fields'=>"id, title, body, date_format(created,'%d/%m/%Y') AS created"));

?>