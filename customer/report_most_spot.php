<?php
    session_start();
    include_once '../connect.php';
    //Admin nav bar
    include_once '../main/nav/nav_reportSpot.php';

     $username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name ="viewreport" content="width=device-width, initial-scale =1.0">
    <link rel="stylesheet" type="text/css" href="report.css">
    <title>User Report</title>
    <h1 align="center">TRAVEL SPOT REPORT</h1>

  </head>
  <body>

    <!---select date and method-->
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
            <option value="all_year">All year</option>
            <?php while ($row = mysqli_fetch_array($result)):; ?>
                <option value="<?php echo $row[0]?>"><?php echo $row[0]?></option>
            <?php endwhile;?>
        </select>
        </td>
        </tr>
        <tr>
        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
        <select name="month">
                    <option value="all">All</option>
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
        </tr>
        <tr>
        <th width="27%" height="63" scope="row">Report Type:</th>
        <td width="73%">
        <select name="type">
          <option value="null">--- Select Type ---</option>
          <option value="host">Leader</option>
          <option value="join">Participant</option>
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
            if(isset($_POST['apply']))
            {
                $year = $_POST['year'];
                $month = $_POST['month'];
                $type = $_POST['type'];
             
                if($type == 'null'){
                  echo "<script>alert('Please Select the Report Type');</script>";
                  echo"<meta http-equiv='refresh' content='0; url=report_most_spot.php'/>";  
                }
                elseif($type == 'host'){

                    if($year == 'all_year' && $month == 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip t, travel_itinerary i, travel_spot s , users u WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.username = u.username AND t.username = '$username' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year != 'all_year' && $month == 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip t, travel_itinerary i, travel_spot s, users u WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.username = u.username AND t.username = '$username' AND YEAR(t.start_date) = '$year' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year != 'all_year' && $month != 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip t, travel_itinerary i, travel_spot s, users u WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.username = u.username AND t.username = '$username' AND YEAR(t.start_date) = '$year' AND MONTH(t.start_date) = '$month' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year == 'all_year' && $month !='all'){
                    $query="SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip t, travel_itinerary i, travel_spot s, users u WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.username = u.username AND t.username = '$username' AND MONTH(t.start_date) = '$month' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result=mysqli_query($conn, $query);
                    }
                }elseif($type == 'join'){
                    if($year == 'all_year' && $month == 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip_joining j, trip t, travel_itinerary i, travel_spot s WHERE j.tripID = t.tripID AND t.tripID = i.tripID AND i.spotID = s.spotID AND j.username = '$username' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year != 'all_year' && $month == 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip_joining j, trip t, travel_itinerary i, travel_spot s WHERE j.tripID = t.tripID AND t.tripID = i.tripID AND i.spotID = s.spotID AND j.username = '$username' AND YEAR(t.start_date) = '$year' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year != 'all_year' && $month != 'all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip_joining j, trip t, travel_itinerary i, travel_spot s WHERE j.tripID = t.tripID AND t.tripID = i.tripID AND i.spotID = s.spotID AND j.username = '$username' AND YEAR(t.start_date) = '$year' AND MONTH(t.start_date) = '$month' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                    elseif($year == 'all_year' && $month !='all'){
                    $query = "SELECT spot_name, COUNT(t.tripID) AS 'trip' FROM trip_joining j, trip t, travel_itinerary i, travel_spot s WHERE j.tripID = t.tripID AND t.tripID = i.tripID AND i.spotID = s.spotID AND j.username = '$username' AND MONTH(t.start_date) = '$month' GROUP BY spot_name ORDER BY spot_name LIMIT 10;";
                    $result = mysqli_query($conn, $query);
                    }
                }

                if(mysqli_num_rows($result) >= 1 ){
                  
        ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Travel Spot', 'Trip'],

          <?php
          //display data from db
            while ($row = $result->fetch_assoc()) {

              echo "['" . $row['spot_name'] . "'," . $row['trip'] . "],";

              }

          ?>
        ]);

        var options = {
          title: 'Top Visited Travel Spot Report',
          legend: { position: 'none' },
          colors: ['#00b38f'],
          chart: { title: 'Top Visited Travel Spot Report',
                   subtitle: 'popularity by number of trips' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Travel Spot'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <div id="top_x_div" style="height: 500px;"></div>


        <?php
        }
        else{
          echo "<script>alert('No Record Found');</script>";
          echo"<meta http-equiv='refresh' content='0; url=report_most_spot.php'/>";
        }
        }
        ?>

</body>
</html>
