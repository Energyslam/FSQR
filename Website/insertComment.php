<?php
$username="yourusername";
$password="yourpassword";
$hostname = "localhost"; //localhost if SQL server is on same server as website
$dbname = "omega";
$yourvariable = isset($_GET["yourvariable"]) ? strip_tags($_GET["yourvariable"]) : false; //checks if $_GET is not empty, and prevents code injection through strip_tags
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn){ //ends script if no succesfull connection can be made
  die("Connection failed :( " . mysqli_connect_error());
}
if ($answer){
  $sql = $conn->prepare("INSERT INTO yourcommenttable (yourcommentcolumn) VALUES (?)"); //prepares the query and prevents SQL injection by parameterizing the query
  $sql->bind_param("s",$answer); //string for first parameter $answer
  if (!$sql->execute()) { //executes query and returns boolean whether it succeeded or failed
    die("Problem inserting comment!");
  }
  $sql->close();//closes connection
} else {
  die("No answer given!");
}
mysqli_close($conn);//closes connection
?>
