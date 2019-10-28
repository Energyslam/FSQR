<?php
$username="omegausr";
$password="JakeIsAwesome";
$hostname = "localhost";
//connection string with database
$dbhandle = mysqli_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
echo "";
// connect with database
$selected = mysqli_select_db($dbhandle, "omega")
or die("Could not select examples");
//query fire
$result = mysqli_query($dbhandle,"select * from comments order by rand()");
if (!$result) {
    printf("Error: %s\n", mysqli_error($dbhandle));
    exit();
}
$json_response = array();
// fetch data in array format
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
// Fetch data of Fname Column and store in array of row_array
$row_array['id'] = $row['id'];
$row_array['comment'] = $row['comment'];
$row_array['upvotes'] = $row['upvotes'];
array_push($json_response,$row_array);

//push the values in the array

}
echo json_encode($json_response, JSON_NUMERIC_CHECK);
mysqli_free_result($result);
?>
