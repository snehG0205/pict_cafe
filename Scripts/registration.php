<?php
	include 'classes/registeration.php';

	if (isset($_GET["t"])) {
		if ($_GET["t"]==="G") {
			$name = $_GET["name"];
			$email = $_GET["email"];
			$password = $_GET["ID"];
			$token = $_GET["ID"];
			$tokenType = $_GET["t"];
			$profilePicture = $_GET["img"];
		}
		else if($_GET["t"]==="F"){
			$email = $_GET["name"];
			$email = strtolower($email);
			$email = str_replace(" ", ".", $email);
			$email .= "@facebook.com";
			//echo $email;
			$profilePicture = "../assets/avatar1.png";
			$name = $_GET["name"];
			$password = $_GET["ID"];
			$token = $_GET["ID"];
			$tokenType = $_GET["t"];
		}	
	}
	else{

		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$profilePicture = "../assets/avatar1.png";
		$token = "self";
		$tokenType = "self";
	}
	
	
	
	$regObj = new Registration();
	$regObj->connect();

	$result = $regObj->updateUserDetails($email,$name,$profilePicture,$token,$tokenType);
	if ($result) {
		//echo "user details updated successfully";
	}
	else{
		echo "error in updateUserDetails";
		die();
	}

	$result = $regObj->updateUserCredentials($email,$password);
	if ($result) {
		//echo "user creds updated successfully";
	}
	else{
		echo "error in updateUserCredentials";
		die();
	}
	header("location:../index.html")
	
?>