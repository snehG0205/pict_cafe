<?php
	include_once 'connect.php';
	/**
	* Class for events table
	*/
	class Events extends Connection
	{

		function addEvent($eventName,$eventDesc,$eventDate,$eventLocation,$eventCreator)
		{
			$sql = "INSERT INTO event (event_name,event_location,event_date,event_description,event_creator) VALUES ('".$eventName."','".$eventLocation."','".$eventDate."','".$eventDesc."','".$eventCreator."');";
			//echo $sql;

			if (mysqli_query($this->conn, $sql))
			{
				return 'true';

			}
			else
			{

				return'false';
			}
		}
		function getId($eventName,$eventCreator)
		{
			$sql = "SELECT MAX(event_id) FROM event WHERE event_name LIKE '".$eventName."' AND event_creator LIKE '".$eventCreator."';";
			//echo $sql;
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			//echo $row["MAX(event_id)"];
			return $row["MAX(event_id)"];
		}
		function getEvent($id)
		{
			$sql = "SELECT event_name,event_date FROM event WHERE event_id = ".$id.";";
			//echo $sql;
			$events = array();
			$result = $this->conn->query($sql);
			//$row = $result->fetch_assoc();
			// print_r($row);
			$row = $result->fetch_assoc();
				$events[0] = $row["event_name"];
				$events[1] = $row["event_date"];

			return $events;
		}
		function getAllEvents($email)
		{
			$sql = "SELECT event_id,event_name,event_date FROM event WHERE event_creator LIKE '".$email."' ORDER BY event_date DESC;";
			//echo $sql;
			$events = array();
			$k=0;
			$result = $this->conn->query($sql);
			//$row = $result->fetch_assoc();
			// print_r($row);
			while($row = $result->fetch_assoc()){
				$events[$k][0] = $row["event_name"];
				$events[$k][1] = $row["event_date"];
				$events[$k][2] = $row["event_id"];
				$k++;
			}
			$sql = "SELECT event_id FROM event_members WHERE email LIKE '".$email."';";
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			$shared = $row["event_id"];
			$temp = explode(',', $shared);
			//print_r($temp);
			$count = count($temp);
			$i=1;
			while($i<$count)
			{
				$sql = "SELECT event_id,event_name,event_date FROM event WHERE event_id = ".$temp[$i];
				$i++;
				$result = $this->conn->query($sql);
				$row = $result->fetch_assoc();
				$events[$k][0] = $row["event_name"];
				$events[$k][1] = $row["event_date"];
				$events[$k][2] = $row["event_id"];
				$k++;
			}
			//print_r($events);
			foreach ($events as $key => $row) {
			    $date[$key] = $row[1];
			}
			if(count($events)!=0){array_multisort($date, SORT_DESC, $events);}
			// echo "sorted<br>";
			// print_r($events);
			return $events;
		}
		function getMyEvents($email)
		{
			$sql = "SELECT event_id,event_name,event_date FROM event WHERE event_creator LIKE '".$email."' ORDER BY event_date DESC LIMIT 6;";
			//echo $sql;
			$events = array();
			$k=0;
			$result = $this->conn->query($sql);
			//$row = $result->fetch_assoc();
			// print_r($row);
			while($row = $result->fetch_assoc()){
				$events[$k][0] = $row["event_name"];
				$events[$k][1] = $row["event_date"];
				$events[$k][2] = $row["event_id"];
				$k++;
			}
			return $events;
		}
		function addMemers($eventId,$eventMembers)
		{
			$count = count($eventMembers);
			$i=0;
			print_r($eventMembers);

			while ($i<$count)
			{
				$sql = "SELECT * FROM event_members WHERE email LIKE '".$eventMembers[$i]."';";
				$result = $this->conn->query($sql);
				$row = $result->fetch_assoc();
				$events = $row["event_id"];
				$events = $events.",".$eventId;
				$sql = "UPDATE event_members SET event_id ='".$events."' WHERE email LIKE '".$eventMembers[$i]."';";
				if (mysqli_query($this->conn, $sql))
				{
					//return 'true';

				}
				else
				{

					//return'false';
				}
					$i++;
			}
			return;
		}
	}

?>
