<?php
	include "../connect.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_SESSION['username'];

    //new
    $last_id = $_SESSION['last_id'];

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

        <div id="home"><a href="createTrip2.php">Back</a></div>

    </div>


</section>

</body>
</html>