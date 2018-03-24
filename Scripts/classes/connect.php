<?php
/**
* class for connectivity to entire database
*/
	class Connection
	{

			public $conn=null;
	    public $servername = "localhost";
			public $username = "root";
			public $password = "";
			public $dbname = "pict-cafe";

		//connection function
		function connect()
		{
			// Create connection
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		}

	}
?>
