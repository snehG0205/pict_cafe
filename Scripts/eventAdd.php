<?php
	include 'classes/events.php';
	@session_start();

	$eventCreator = $_SESSION["email"];
	$eventName = $_POST["eventName"];
	$eventDesc = $_POST["eventDesc"];
	$eventDate = $_POST["eventDate"];
	$eventMembers = $_POST["eventMembers"];
	$eventLocation = $_POST["eventLocation"];
	$eventPhotos = array();
	$eventPhotos = $_FILES["eventPhotos"]["name"];
	$temp = $_POST["eventMembers"];
    $eventMembers = explode(',', $temp[0]);


	{
		// echo "<br>Name = $eventName";
		// echo "<br>Desc = $eventDesc";
		// echo "<br>date = $eventDate";
		// echo "<br>loc = $eventLocation";
		// echo "<br>members = $eventMembers";
		// echo "<br>photos";
		// print_r($eventPhotos);
	}

	$eventObj = new Events();
	$eventObj->connect();
	$result = $eventObj->addEvent($eventName,$eventDesc,$eventDate,$eventLocation,$eventCreator);

	// echo $result;
	// if($result==="true"){echo "success";}
	// else{echo "fail";}

	$eventId = $eventObj->getId($eventName,$eventCreator);
	$result = $eventObj->addMemers($eventId,$eventMembers);
	//echo $eventId;

	if(mkdir('../assets/events/'.$eventId))
	{//echo "<br>folder created";
}

	$total = count($_FILES['eventPhotos']['name']);
	// Loop through each file
	for($i=0; $i<$total; $i++) {
	  //Get the temp file path
	  $tmpFilePath = $_FILES['eventPhotos']['tmp_name'][$i];

	  //Make sure we have a filepath
	  if ($tmpFilePath != ""){
	    //Setup our new file path
	    $newFilePath = "../assets/events/".$eventId."/". $_FILES['eventPhotos']['name'][$i];

	    //Upload the file into the temp dir
	    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

	      //Handle other code here

	    }
	  }
	}
	header("location:../pages/dash.php");
?>