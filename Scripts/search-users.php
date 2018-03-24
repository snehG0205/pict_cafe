<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "pict-cafe");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$query = mysqli_real_escape_string($link, $_REQUEST['query']);
//echo "<select name='username'>";
 
    if(isset($query)){
        // Attempt select query execution
        $sql = "SELECT * FROM user_details WHERE email";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<option value ='" . $row['email'] . "'>". $row['email'] . "</option>";
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
//echo "</select>";
// close connection
mysqli_close($link);
?>