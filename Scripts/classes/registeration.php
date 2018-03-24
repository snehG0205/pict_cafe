<?php
	include_once 'connect.php';
	/**
	* 
	*/
	class Registration extends Connection
	{
		
		function updateUserDetails($email,$name,$profilePicture,$token,$tokenType)
		{
			$sql =  "INSERT INTO user_details VALUES ('".$email."','".$name."','".$profilePicture."','".$token."','".$tokenType."');";
			if (mysqli_query($this->conn, $sql)) 
			{
				//return 'true';
			}
			else 
			{
				return'false';
			}
			$sql =  "INSERT INTO event_members(email) VALUES ('".$email."');";
			if (mysqli_query($this->conn, $sql)) 
			{
				return 'true';
			}
			else 
			{
				return'false';
			}
		}

		function updateUserCredentials($email,$password)
		{
			$sql =  "INSERT INTO user_cred VALUES ('".$email."','".$password."');";
			if (mysqli_query($this->conn, $sql)) 
			{
				return 'true';
			}
			else 
			{
				return'false';
			}
		}
	}

?>