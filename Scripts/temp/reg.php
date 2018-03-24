<?php
	include '../classes/registeration.php';
	$user = $_POST["u"];
	$pass = $_POST["p"];
	$name = $_POST["n"];
	$mail = $_POST["e"];
	$regObj = new Registration();
	$regObj->connect();
	$result = $regObj->registerUser($user,$pass,$name,$mail);
	echo $result;
?>