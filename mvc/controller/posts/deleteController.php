<?php
$layout = 'ajax';

if ($_POST) {
	$id = $_POST['id'];
	$delete = mysql_query("DELETE FROM posts WHERE id=".$id);
	$count = mysql_query("SELECT id FROM posts");
	$count = mysql_num_rows($count);
	if ($delete) {
		if($count == 0)
			echo 2;
		else
			echo 1;
	}else{
		echo 0;
	}
}

echo false;

?>