<?php
$var = param(0);

echo "view teste";
echo "<br>";
echo "parametro --- ".$var;
echo "<br>";
$oi = $_SERVER['PHP_SELF'];
echo $oi;
$oi = explode("/",$oi);
echo "<br>";
echo $oi[1]

?>