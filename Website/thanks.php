<?php
 // Makes a connection with the database
 $connect = mysqli_connect("localhost", "yourusername", "yourpassword", "yourdatabasename");
 // Counts all the colors/answersin the database and store them in a result variable
 $query = "SELECT yourvoteresponsecolumn, count(*) as number FROM yourvotetable GROUP BY yourvoteresponsecolumn";
 $result = mysqli_query($connect, $query);
 ?>


<!DOCTYPE html>
<html id="body">
<head>
  <title>Digital Society School Feedback </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  // Load the Visualization API and the piechart package
  google.charts.load('current', {'packages':['corechart']});
   // Set a callback to run when the Google Visualization API is loaded
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table with MySQL data, instantiates the pie chart, passes in the data and draws it
  function drawChart()
  {
       // Create the data table
       var data = google.visualization.arrayToDataTable([
                 ['Color', 'Number'],
                 <?php
                 while($row = mysqli_fetch_array($result))
                 {
                      echo "['".$row["color"]."', ".$row["number"]."],";
                 }
                 ?>
            ]);

       // Set chart options
       var options = {
             title: 'Percentage of Responses',
             pieHole: 0.4,
             colors: ['rgb(219,44,41)', 'rgb(55,100,167)', 'rgb(0,148,87)', 'rgb(255,233,16)']
            };

       // Instantiate and draw the chart, passing in some options
       var chart = new google.visualization.PieChart(document.getElementById('piechart'));
       chart.draw(data, options);
  }
  </script>
  <style type="text/css">
  @font-face {
    font-family: Bungee;
    src: url(fonts/OpenSans-Bold.ttf) format("truetype");
  }

  .spacer {
    height: 20px;
  }

  .chart-wrapper {
    width:100%;
    text-align: center;
    /*height:100vh;*/
    position: relative;
  }

  #piechart {
    max-width:900px;
    max-height:500px;
  }


  .btn-teal{
    background-color: #0099ff;
    color:#ffffff;
    font-size: 20px;
    font-weight: 900;
    border: none;
  }
  .btn-green{
    background-color: #339933;
    color:#ffffff;
    font-size: 20px;
    font-weight: 900;
    border: none;
  }
  .btn-red{
    background-color: #ff0000;
    color:#ffffff;
    font-size: 20px;
    font-weight: 900;
    border: none;
  }
  .btn-yellow{
    background-color: #eeee00;
    color:#ffffff;
    font-size: 20px;
    font-weight: 900;
    border: none;
  }
  .row{
    padding-top: 10px;
  }
  .max {

    height:75px;
    width:135px;
  }
  h1 {
    font-weight: 1000;
    font-size: 32pt;
  }
  .center-block {
    margin-left: auto;
    margin-right: auto;
    display: block;
    text-align: center;
  }
  </style>

</head>
<body id="bodyID">
  <div class="container" id="containerID">
    <div class="row">
      <div class="col">
        <img src="/img/thankyoupageHeader.png" class="img-fluid" alt="header" width="100%">
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h1><span style="font-family: Bungee;font-weight:900; font-size: 30px;">Thank you!</span></h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p style="font-size: 18px; color:lightgrey; text-align:left;"><b>Thank you for your feedback! These are the results so far:</b></p>
      </div>
    </div>
    <div class="row" style="padding-top:10px">
      <div class="col">
        <div class="chart-wrapper">
          <div id="piechart"></div>
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col-6 justify-content-center offset-3">
      <button type="button" class="btn btn-block btn-primary" onclick="location.href ='tinder.html';">Continue</button>
    </div>
  </div>
</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="vote.js"></script>


</body>
</html>
