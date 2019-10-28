<?php
 $connect = mysqli_connect("localhost", "yourusername", "yourpassword", "yourdatabasename");
 $query = "SELECT yourcommentcolumn FROM yourcommenttable WHERE 1 ORDER BY rand() LIMIT 1"; //returns a random comment
 $result = mysqli_query($connect, $query); //executes query
 while($row = mysqli_fetch_array($result))
 {
      echo $row[0];
 }
 ?>
