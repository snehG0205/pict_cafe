<?php
	include '../classes/photos.php';
	$event = $_POST["e"];
	$image = $_FILES["i"]["name"];
	$photoObj = new Photos();
	$photoObj->connect();
	$result = $photoObj->uploadPhoto($event,$image);
	echo $result;
?>