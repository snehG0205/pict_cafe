<?php
	include_once 'connect.php';
	/**
	* Class for users table
	*/
	class Users extends Connection
	{
		
		
		function checkUser($email,$password)
		{
			$sql = "SELECT * FROM user_cred WHERE email ='".$email."' AND password = '".$password."';";
			$result = $this->conn->query($sql);
			if ($result->num_rows > 0)
			{
				return "true"; 
		    }
		    else
		    {
		    	return "false";
		    }

		}
		function getName($email)
		{
			$sql = "SELECT name FROM user_details WHERE email ='".$email."';";
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			return $row["name"];
		}
		function getImg($email)
		{
			$sql = "SELECT profile_pict FROM user_details WHERE email ='".$email."';";
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			return $row["profile_pict"];
		}
		function getAllEmail($email)
		{
			$sql = "SELECT email FROM user_details WHERE email NOT IN ('".$email."');";
			//echo $sql;
			$result = $this->conn->query($sql);
			$k=0;
			$email = array();
			while($row = $result->fetch_assoc()){
				$email[$k] = $row["email"];
				$k++;
			}
			//print_r($email);
			return $email;
		}
		function getAllName($email)
		{
			$sql = "SELECT name FROM user_details WHERE email NOT IN ('".$email."');";
			//echo $sql;
			$result = $this->conn->query($sql);
			$k=0;
			$email = array();
			while($row = $result->fetch_assoc()){
				$email[$k] = $row["name"];
				$k++;
			}
			print_r($email);
			//return $email;
		}
	}

?>