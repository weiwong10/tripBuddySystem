<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="mainSearch.css">
    <title>Search Result</title>

</head>
<body>

		<?php include("nav/nav_home.php");

			include ("../connect.php");
            session_start();
            $username = $_SESSION['username'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $spot = $_POST['spot'];
			
			if(empty($start_date) && !empty($end_date) && empty($spot)){
				echo "<script>alert('Please insert the start date');</script>";
				echo"<meta http-equiv='refresh' content='0; url=main.php'/>";
			}
            else{
			
                if(empty($spot) && empty($end_date) && !empty($start_date)){

                $sql = "SELECT DISTINCT * FROM trip WHERE start_date >= '$start_date' AND start_date > sysdate()";
			    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                }
                elseif(empty($end_date) && !empty($start_date) && !empty($spot)){
                    $sql = "SELECT DISTINCT t.tripID, title, price, t.image, current_people, t.description, start_date FROM trip t, travel_itinerary i, travel_spot s WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND start_date >= '$start_date' AND spot_name LIKE '%$spot%' AND start_date > sysdate()";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                }
                elseif(empty($spot) && !empty($start_date) && !empty($end_date)){
                    $sql = "SELECT DISTINCT * FROM trip WHERE start_date BETWEEN '$start_date' AND '$end_date' AND start_date > sysdate()";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                }
                elseif(empty($start_date) && empty($end_date) && !empty($spot)){
                    $sql = "SELECT DISTINCT t.tripID, title, price, t.image, current_people, t.description, start_date FROM trip t, travel_itinerary i, travel_spot s WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND spot_name LIKE '%$spot%' AND start_date > sysdate()";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                }
                else{
                    $sql = "SELECT DISTINCT t.tripID, title, price, t.image, current_people, t.description, start_date FROM trip t, travel_itinerary i, travel_spot s WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND start_date BETWEEN '$start_date' AND '$end_date' AND spot_name LIKE '%$spot%' AND start_date > sysdate()";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                }
                
                ?>
                <div class="container">
                <?php
                if(mysqli_num_rows($result) > 0)
                {

                ?>

                    <h1 class="heading">Search Result</h1>
                    <div class="box-container">

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) 
                    {						
                        //New
                        $tripID = $row['tripID'];
                    ?>
                    <div class="box">
                    <div class="image">
                        <?php 
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
                        ?>
                        </div>
                        <div class="content">
                            <h3>
                                <?php 
                                    echo $row["title"];			
                                ?>	
                            </h3>
                            <p>
                                <?php echo $row["description"];?>
                            </p>

                            <?php
                                $check_host = "SELECT DISTINCT tripID FROM trip WHERE username = '$username' AND tripID = '$tripID';";
                                $host_result = mysqli_query($conn,$check_host) or die(mysqli_error($conn));

                                if(mysqli_num_rows($host_result) >0){
                            ?>
                                <form action="hostTripDetails.php" method="post">
                                    <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>"> 					
                                    <button class="btn" type="submit">View Details</button>
                                </form>                        
                            <?php
                                }else{
                                    $check_join = "SELECT DISTINCT tripID FROM trip_joining WHERE username = '$username' AND tripID = '$tripID';";
                                    $join_result = mysqli_query($conn,$check_join) or die(mysqli_error($conn));
                                    
                                    if(mysqli_num_rows($join_result) >0){
                            ?>
                                    <form action="cancelTripDetails.php" method="post">
                                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>"> 					
                                        <button class="btn" type="submit">Cancel Booking</button>
                                    </form>
                            <?php
                                    }else{
                            ?>
                                    <form action="tripDetails.php" method="post">
                                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>"> 					
                                        <button class="btn" type="submit">Book Now</button>
                                    </form>
                            <?php            
                                    }
                                }

                            ?>
                            <div class="icons">
                                <span><i class="fa-solid fa-calendar-days"></i><?php echo $row["start_date"]?></span>
                                <span><i class="fa-solid fa-tag"></i><?php echo $row["price"]?></span>
                                <span><i class="fa-solid fa-user"></i><?php echo $row["current_people"];?> </span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                
                <?php
                }

                else{
                    echo "<script>alert('No Record Found');</script>";
                    echo"<meta http-equiv='refresh' content='0; url=main.php'/>";
                    }
                ?>

                <div class="back"><a href="main.php">Back</a></div>

                </div>
            <?php
            }
            ?>
            


</body>
</html>