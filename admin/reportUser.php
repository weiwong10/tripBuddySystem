<?php
    session_start();
    include_once '../connect.php';
    //Admin nav bar
     include("navAdmin/nav_admin.php");

   $admin_username = $_SESSION['admin_username'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name ="viewreport" content="width=device-width, initial-scale =1.0">
    <link rel="stylesheet" type="text/css" href="report.css">
    <title>User Report</title>
    <h1 align="center">USER REPORT</h1>

  </head>
<body>

    <!---select date and method-->
<form name="bwdatesdata" action="" method="post" action="">
<table class="center_table">
    <tr>
        <th width="27%" height="63" scope="row">Type: </th>
        <td width="73%">
        	<select name="type">
            	<option value="null">--- Select Type ---</option>
            	<option value="rate">Top 10 User's Rating</option>
            	<option value="lead">Top 10 User's with the most amount of trips</option>
        	</select>
    </tr>
    <tr>
        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
        	<button class="btn-primary btn" type="submit" name="submit">Check</button>
        </td>
    </tr>
</table>
</form>
<br>
</div>
</div>
<hr>
<div class="row">
<br>
<div class="col-xs-12">
    <?php

        if(isset($_POST['submit']))
        {
            $type = $_POST['type'];

            if($type == 'null'){
                echo "<script>alert('Please Choose the valid Type');</script>";
                echo"<meta http-equiv='refresh' content='0; url=reportUser.php'/>";
            } 
            elseif($type == "rate"){
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Resort', 'Trip'],

           <?php
           //display by year
   
           $query = "SELECT username, average_rate FROM users ORDER BY average_rate DESC LIMIT 10;";
           $result = mysqli_query($conn, $query);
           //display data from db
           if (mysqli_num_rows($result) >= 1) {
               while ($row = $result->fetch_assoc()) {

                   echo "['" . $row['username'] . "'," . $row['average_rate'] . "],";

               }
           } else {
               echo "No data found.";
           }


           ?>
        ]);

        var options = {
          title: 'Top Users Rating Report',
          legend: { position: 'none' },
          colors: ['#aaaa55'],
          chart: { title: 'Top 10 Users Report',
                   subtitle: 'popularity by rating of user' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Username'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <div id="top_x_div" style="margin: auto; width: 700px; height: 500px;"></div>

    <?php
        }
        elseif($type == "lead")
        {
    ?>
 
<form name="bwdatesdata" action="" method="post" action="">
<table class="center_table">
    <tr>
    	<th width="27%" height="63" scope="row">Year: </th>
        <td width="73%">
            
        	<?php 
           		$query = "SELECT DISTINCT YEAR(start_date) FROM TRIP;";
            	$result = mysqli_query($conn,$query);
        	?>

        	<select name="year">
              <option value = "all_year">All year</option>
            	<?php while ($row = mysqli_fetch_array($result)):; ?>
                	<option value="<?php echo $row[0]?>"><?php echo $row[0]?></option>
            	<?php endwhile;?>
        	</select>
        </td>
    </tr>
    <tr>
        <th width="27%" height="63" scope="row">Month: </th>
        <td width="73%">
            <select name="month">
                <option value="all">All month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </td>
    </tr>
    <tr>
		<th width="27%" height="63" scope="row"></th>
        <td width="73%">
            <button class="btn-primary btn" type="submit" name="apply">Check</button>
        </td>
    </tr>
</table>
</form>
    <?php  
        }

        }
        elseif(isset($_POST['apply'])){
    
            $year = $_POST['year'];
            $month = $_POST['month'];
   
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Resort', 'Trip'],

           <?php
           //display by year
        if($year == 'all_year' && $month == 'all'){
          $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
          $result = mysqli_query($conn, $query);
        }
        elseif($year != 'all_year' && $month == 'all'){
            $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username AND YEAR(start_date) = '$year' GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
            $result = mysqli_query($conn, $query);
        }
        elseif($year == 'all_year' && $month != 'all'){
          $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username AND MONTH(start_date) = '$month' GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
          $result = mysqli_query($conn, $query);
        }
        else{
            $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username AND YEAR(start_date) = '$year' AND MONTH(start_date) = '$month' GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
            $result = mysqli_query($conn, $query);
        }
           

           //display data from db
           if (mysqli_num_rows($result) >= 1) {
               while ($row = $result->fetch_assoc()) {

                   echo "['" . $row['username'] . "'," . $row['count'] . "],";

               }
           } 
           else {
                echo "<script>alert('...');</script>";
                echo "<script>alert('No Record Found');</script>";
                echo"<meta http-equiv='refresh' content='0; url=reportUser.php'/>";
           	}


           ?>
        ]);

        var options = {
          title: 'Top Users Rating Report',
          legend: { position: 'none' },
          colors: ['#aaaa55'],
          chart: { title: 'Top 10 Users Report',
                   subtitle: 'the most amount of trips' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Username'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <div id="top_x_div" style="margin: auto; width: 700px; height: 500px;"></div>

    <?php        
        
    }

    ?>

</body>
</html>
