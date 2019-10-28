<?php
$username="yourusername";
$password="yourpassword";
$hostname = "localhost"; //localhost if SQL server is on same server as website
$dbname = "yourdatabasename";
$youridentifier = isset($_GET["youridentifier"]) ? strip_tags($_GET["youridentifier"]) : false;  //checks if $_GET is not empty, and prevents code injection through strip_tags
$conn = mysqli_connect($hostname, $username, $password, $dbname);
$variable = isset($_GET["yourvariable"]) ? strip_tags($_GET["yourvariable"]) : false;
//connection string with database
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

  $sql = $conn->prepare("UPDATE yourtablename SET yourcolomnname = ? WHERE youridentifier=?"); //prepares the query and prevents SQL injection by parameterizing the query
  $sql->bind_param("ii", intval($yourvariable), intval($youridentifier)); //sets type of the variables
  if (!$sql->execute()) { //executes query and returns boolean whether it succeeded or failed
    die("Problem inserting comment!");
  }
  $sql->close();//closes connection


mysqli_close($conn);//closes connection
?>
