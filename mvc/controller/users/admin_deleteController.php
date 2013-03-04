<?php
$layout = 'ajax';

if(isRequest('post')){
	$delete = mysql_query('DELETE FROM users WHERE id='.$_POST['id']);
	if ($delete)
		echo true;
	else
		echo false;
}
?>