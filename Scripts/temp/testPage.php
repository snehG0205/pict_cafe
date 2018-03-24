<?php

	include 'classes/users.php';
	include 'classes/events.php';
	include 'classes/photos.php';
	// $obj = new Connection();
	// echo $obj->username;
	// $obj->connect();
	// $obj->users();
	// $obj->events();
	// $obj->photos();
	// echo "user:  ";
	// $userObj = new Users();
	// $userObj->connect();
	// $userObj->viewUsers();
	// echo "events:  ";
	// $eventObj = new Events();
	// $eventObj->connect();
	// $eventObj->viewEvents();
	echo "photos:  ";
	$photoObj = new Photos();
	$photoObj->connect();
	$photoObj->viewPhotos();
?>