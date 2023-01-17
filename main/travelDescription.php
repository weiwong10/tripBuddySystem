<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];
    $last_id = $_SESSION['last_id'];
    $spotID = $_POST['spotID'];

    if (isset($_POST['save2'])) 
    {
        $tripID = $_POST['tripID'];
        $spotID = $_POST['spotID'];
        $description = $_POST['description'];

        if(empty($spotID))
        {
            header("Location: createtrip_2.php?error=Please select a Travel Spot");
        }
        elseif(empty($description))
        {
            echo "<script>alert('Please select at least one travel spot!');</script>";
            echo"<meta http-equiv='refresh' content='0; url=createTrip2.php'/>";
        }
        else
        {
            mysqli_query($conn, "INSERT INTO travel_itinerary (tripID, spotID, description) VALUES ('$tripID', '$spotID', '$description')");

            header('location: createTrip2.php');
        } 
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="tripDetails.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Join Trip</title>
</head>
<body>
    <?php include("nav/nav_createTrip.php")?>

    <section class="details">
        
        <h1 class="trip">Travel Spot</h1>
		<hr>
        <?php
			$sql = "select DISTINCT spot_name, image FROM travel_spot WHERE spotID = '$spotID'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>

        <form action="" method="POST">

		<div class="cards">
			<div class="images">
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				?>
			</div>
			<div class="caption">
                <p class="description">

                <b><h2><?php echo $row["spot_name"];?></h2></b>

                </p>
				<p class="description">

                    <h3>Description: </h3>
                    <textarea rows="5" cols="10" name="description" placeholder="  Description" style="font-size: 18px;"></textarea>
                    <br>
                    <input type="hidden" name="tripID" value="<?php echo $last_id; ?>">
                    <input type="hidden" name="spotID" value="<?php echo $spotID; ?>">
				</p>
			</div>
            
		</div>

        <button type="submit" name="save2" id="back">Next</button>
        <div id="back"><a href="createTrip2.php">Back</a></div>

        </form>


	<?php 
		}

	?>
	</section>

</body>
</html>