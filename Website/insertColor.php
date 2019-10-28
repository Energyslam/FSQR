<?php
$username="yourusername";
$password="yourpassword";
$hostname = "localhost"; //localhost if SQL server is on same server as website
$dbname = "yourdatabasename";
$yourvariable = isset($_GET["yourvariablename"]) ? strip_tags($_GET["yourvariablename"]) : false; //checks if $_GET is not empty, and prevents code injection through strip_tags
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn){ //ends script if no succesfull connection can be made
  die("Connection failed: " . mysqli_connect_error());
}
$sql = $conn->prepare("INSERT INTO yourtablename (yourcolomnname) VALUES (?)"); //prepares the query and prevents SQL injection by parameterizing the query
$sql->bind_param("s", $yourvariable); //sets type of the variables

if ($sql->execute()){ //executes query and returns boolean whether it succeeded or failed
  echo "Inserted answer";
  $sql->close(); //closes connection
} else {
  die("Error: " . $sql . "<br>" . mysqli_error($conn));

}

mysqli_close($conn); //closes connection
?>
