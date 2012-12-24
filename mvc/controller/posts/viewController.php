<?php

if (!isset($vars[0]))
	$vars[0] = 0;

$post = findOne('posts','id',$vars[0]);

?>