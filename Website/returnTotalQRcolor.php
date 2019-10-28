<?php
 $connect = mysqli_connect("localhost", "yourusername", "yourpassword", "yourdatabasename");
 $query = "SELECT COUNT(yourvotecolumn) FROM yourvoteresponsetable"; //returns the amount of votes
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
      echo "<rates> "; //used to encapsulate the response to be read on the microprocessor.
      echo $row[0];
      echo " </rates>";
 }
 ?>
