<!DOCTYPE html>
<html dir="ltr" lang="pt">
<head>
	<title>Star Wars Framework</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="">
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<?php echo coreHead();?>

	<!-- FAVICON -->
	<?php echo favicon('favicon');?>

</head>
<body>

<?php

echo hashIt("123");

echo flash();

?>

<form action="" method="post">
	<input type="text" name="username">
	<input type="text" name="password">
	<button type="submit" class="btn" name="submitsds">Enviar</button>
</form>

</body>
</html>
