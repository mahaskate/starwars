<?php
$layout = 'ajax';

if(isRequest('post')){
	$layout = 'ajax';
	$delete = mysql_query('DELETE FROM posts WHERE id='.$_POST['id']);
	if ($delete)
		echo true;
	else
		echo false;
}
?>