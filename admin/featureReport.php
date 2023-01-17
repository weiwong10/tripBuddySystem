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
        <title>Feature Report</title>
        <h1 align="center">FEATURE REPORT</h1>

  </head>
<body>

<!---select date and method-->
<form name="bwdatesdata" action="" method="post" action="">
<table class="center_table">
    <tr>
        <th width="27%" height="63" scope="row">Year: </th>
        <td width="73%">
        
            <?php 
                $query = "SELECT DISTINCT YEAR(created_date) FROM TRIP;";
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
        <th width="27%" height="63" scope="row">Month: </th>
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
        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
            <button class="btn-primary btn" type="submit" name="submit">Check</button>
        </td>
    </tr>
</table>
</form>
<hr>
<div class="row">
<div class="col-xs-12">
    <?php

        if(isset($_POST['submit']))
        {
            $year = $_POST['year'];
            $month = $_POST['month'];
            
    ?>

    <section class="container">
        <?php
            if($year == 'all_year' && $month == 'all'){
                $query = "SELECT f.featuredID,f.duration, f.price, f.description, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID GROUP BY f.duration, f.featuredID, f.price, f.description;";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            }
            elseif ($year != 'all_year' && $month == 'all') {
                $query = "SELECT f.featuredID,f.duration, f.price, f.description, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID AND YEAR(created_date) = '$year' GROUP BY f.duration, f.featuredID, f.price, f.description;";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            }
            elseif ($year == 'all_year' && $month != 'all'){
                $query = "SELECT f.featuredID,f.duration, f.price, f.description, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID  AND MONTH(created_date) = '$month' GROUP BY f.duration, f.featuredID, f.price, f.description;";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            }
            else{
                $query = "SELECT f.featuredID,f.duration, f.price, f.description, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID AND MONTH(created_date) = '$month' AND YEAR(created_date) = '$year' GROUP BY f.duration, f.featuredID, f.price, f.description;";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            }
        
            if (mysqli_num_rows($result) >= 1) {
        ?>
                <h1 class="related">Report</h1>
		        <hr>
                        <table style="width: 100%; text-align: center; border: 1px solid #a3a375;">
                            <tr style="background-color: #999966; color: white;">
                                <td>Featured ID</td>
                                <td>Duration</td>
                                <td>Price</td>
                                <td>Description</td>
                                <td>Total Trip</td>
                            </tr>
                            <tr>
                               <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <td style="background-color: #ebebe0; padding: 8px;"><?php echo $row["featuredID"] ?></td>
                                <td style="background-color: #ebebe0; padding: 8px;"><?php echo $row["duration"] ?></td>
                                <td style="background-color: #ebebe0; padding: 8px;"><?php echo $row["price"] ?></td>
                                <td style="background-color: #e0e0d1; padding: 8px;"><?php echo $row["description"] ?></td>
                                <td style="background-color: #ebebe0; padding: 8px;"><?php echo $row["number"] ?></td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>
        <?php
            }else
            {
                echo "<script>alert('No Record Found');</script>";
                echo"<meta http-equiv='refresh' content='0; url=featureReport.php'/>";                
            }
        ?>
    </section>

        <?php

        }
        ?>


</body>
</html>
