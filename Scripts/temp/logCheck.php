<?php
	include '../classes/login.php';
	$user = $_POST["u"];
	$pass = $_POST["p"];
	$loginObj = new Login();
	$loginObj->connect();
	$result = $loginObj->checkUser($user,$pass);
	echo $result;
?>