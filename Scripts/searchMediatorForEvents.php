<?php
	@session_start();
	include 'classes/events.php';
	$event_name = $_GET["q"];
	$email = $_SESSION["email"];
	$eventObj = new Events();
	$eventObj->connect();
	$eventId = $eventObj->getId($event_name,$email);
	echo $event_name;
	echo $eventId;

	$link = "../pages/event.php?id=".$eventId;

	header("location:".$link);

?>
