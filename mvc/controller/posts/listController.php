<?php
$posts = find('posts',array('fields'=>"id,title,body,DATE_FORMAT(created,'%d/%m') AS created"));

?>