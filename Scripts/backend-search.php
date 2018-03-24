<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
@session_start();
$link = mysqli_connect("localhost", "root", "", "pict-cafe");


// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$query = mysqli_real_escape_string($link, $_REQUEST['query']);

if(isset($query)){
    // Attempt select query execution
    $sql = "SELECT * FROM event WHERE event_name LIKE '" . $query . "%' AND event_creator LIKE '".$_SESSION["email"]."'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo "<p>" . $row['event_name'] . "</p>";
            }
            // Close result set
            mysqli_free_result($result);
        } else{
            echo "<p>No matches found for <b>$query</b></p>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

// close connection
mysqli_close($link);
?>
