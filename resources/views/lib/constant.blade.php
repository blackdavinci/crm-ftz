<?php
define ('WEBROOT',dirname($_SERVER['SCRIPT_NAME']).'/');
$public_path = public_path();;
	$WEBROOT =  $str = str_replace('\\', '/', $public_path);
?>

