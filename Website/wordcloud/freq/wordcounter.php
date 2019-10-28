<?php
$servername = "localhost";
$username = "yourusername";
$password = "yourpassword";
$dbname = "yourdatabasename";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM yourcommenttable";
$result = $conn->query($sql);

// put the database data in an array (comment and the upvotes)
$wordcloud = array();
if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
       if (array_key_exists($row["yourcommentcolumn"], $wordcloud)) {
         $wordcloud[$row["yourcommentcolumn"]] += intval($row["yourvotecolumn"]);
       } else {
         $wordcloud[$row["yourcommentcolumn"]] = intval($row["yourvotecolumn"]);
       }
   }
} else {
   echo "[\"0 results\",1]";
}

$conn->close();
arsort($wordcloud); // sort the comments and corresponding upvotes in an ascending order

// Removes the ',' comma at the end of the data output
echo "[";
$first = True;
foreach($wordcloud as $key => $value) {
  if (!$first) {
    echo ",";
  } else {
    $first = False;
  }
  echo "[\"" . $key . "\"," . $value . "]";
}

echo "]";
?>
