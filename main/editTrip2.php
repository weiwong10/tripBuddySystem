<?php
	include "../connect.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_SESSION['username'];

    //new
    $last_id = $_SESSION['update'];

    if(isset($_POST['remove'])){
        $spotID = $_POST['spotID'];

        $image_update_query = mysqli_query($conn, "DELETE FROM travel_itinerary WHERE tripID = '$last_id' AND spotID = '$spotID'") or die(mysqli_error($conn));

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="manageSpot.css">

</head>
<body>
    <?php include("nav/nav_createTrip.php")?>

   <section>
    <div class="container">

        <h1 class="heading">Manage Travel Itinerary</h1>

        <div class="box-container">
            <?php
                $sql = "SELECT * FROM travel_spot WHERE spotID IN (SELECT spotID FROM travel_itinerary WHERE tripID = '$last_id')";
                $all_spot = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                if(mysqli_num_rows($all_spot)>= 1){

                while ($row = mysqli_fetch_assoc($all_spot)) {
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
                        echo $row["spot_name"];			
                    ?>	
                </h3>
                <p>
                    <?php 
                        echo $row["address"];	
                    ?>
                </p>

                <form action="" method="post">
                    <input type="hidden" name="spotID" value="<?php echo $row["spotID"]; ?>">						
                    <button class="btn" type="submit" name="remove">Remove</button>
                </form>

                <div class="icons">
                    <span> <i class="fa-sharp fa-solid fa-location-pin"></i> <?php echo $row["state"];?> </span>
                </div>
                </div>
            </div>

            <?php
                }
            }else{
            ?>
                <h2 style="text-align: center; margin-left: 20px;">--No Record Found--</h2>
            <?php   
            }
            ?>

        </div>

        <form action="editAddTrip.php" method="post">						
            <button id="home" type="submit" name="add">Add Travel Itinerary</button>
            <input type="hidden" name="last_id" value="<?php echo $last_id ?>">						
        </form>
        
        <form action="" method="post">						
            <button id="home" type="submit" name="finish">Finish</button>
        </form>

        <?php
            if(isset($_POST['finish'])){
                $test_spot ="SELECT * FROM travel_itinerary WHERE tripID = '$last_id';";
                $result_spot = mysqli_query($conn, $test_spot);

                $row = mysqli_num_rows($result_spot);
                if($row>0){
                    echo "<script>alert('Add Success!');</script>";
				    echo"<meta http-equiv='refresh' content='0; url=editTrip3.php'/>";
                }
                else{
                    echo "<script>alert('Please select at least one travel spot!');</script>";
				    echo"<meta http-equiv='refresh' content='0; url=createTrip2.php'/>";

                }
            }
        ?>

    </div>


</section>

</body>
</html>