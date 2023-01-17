<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];
    $tripID = $_POST['tripID'];
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
	<?php include("nav/nav_trip.php")?>

    <section class="trip_details">
        <h1 class="tripDetails">Trip Details</h1>
        <hr>

        <?php
			$trip_detail = "select start_date, end_date, duration, accommodation, description FROM trip WHERE tripID = '".$tripID."'";

			$result = mysqli_query($conn,$trip_detail) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>

        <div class="cards">

			<div class="caption">
				<p class="description">
					<b>Start Date:</b>
					<?php echo $row["start_date"];?>
				</p>
                <p class="duration_stay">
                    <b>End Date:</b>
                    <?php echo $row["end_date"]?>
                </p>
                <p class="duration">
                    <b>Duration Stay:</b>
                    <?php echo $row["duration"]?>
                </p>
                <p class="accomodation">
                    <b>Accomdation:</b>
                    <?php echo $row["accommodation"]?>
                </p>
                <p class="description">
                    <b>Description:</b>
                    <?php echo $row["description"]?>
                </p>

			</div>
		</div>
	<?php 
		}

	?>

    </section>


    <section class="details">
        
        <h1 class="trip">Trip Itinerary</h1>
		<hr>
		
        <?php
			$sql = "select DISTINCT spot_name, s.image, i.description FROM trip t, travel_itinerary i, travel_spot s, theme m WHERE t.tripID = i.tripID AND i.spotID = s.spotID AND t.tripID = '".$tripID."'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>

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

					<b>Description</b>:<br>
					<?php echo $row["description"];?>

				</p>
			</div>
		</div>

	<?php 
		}

	?>
	</section>
    
	<div class="details"><h1 class="related">Your Tripmates</h1><hr></div>
	
	<section class="container">
            <?php
				$trip = "SELECT name, u.image FROM trip t, trip_joining j, users u WHERE t.tripID = j.tripID AND j.username = u.username AND t.tripID = '$tripID'";
				$result = mysqli_query($conn,$trip) or die(mysqli_error($conn));

			?>
                <div class="box-container">
			<?php
                while ($row = mysqli_fetch_assoc($result)) 
                {						
                
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
                                echo $row["name"];			
                            ?>	
                        </h3>
                    </div>
                </div>
                <?php
                }
                ?>
    </section>

   

    <section class="details">
        <h1 class="spotname">Trip Leader</h1>
        <hr>
		<?php
            $leader = "SELECT u.image,name, email, average_rate FROM trip t, users u WHERE t.username = u.username AND t.tripID = '".$tripID."'";
            $result1 = mysqli_query($conn,$leader) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result1)) {
		
		?>

		<div class="cards">
			<div class="images">
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				?>
			</div>

			<div class="caption">
				<p class="name">

					<b>Name</b> :
					<?php echo $row["name"];?>
					
				</p>
				<p class="rating">

					<b>Email</b> :
					<?php echo $row["email"]?>
					
				</p>
                <p class="feedback">

                    <b>Rating</b> :
                    <?php echo $row["average_rate"]?> / 5.0

                </p>

			</div>
		</div>

	<?php 
		}

	?>
	</section>

    <section class="details">
        
        <h1 class="trip">Transportation</h1>
		<hr>
		
        <?php
			$transport = "SELECT trans_type, r.description, carPlateNo FROM trip t, transportation_trip r, transportation a WHERE t.tripID = r.tripID AND r.transportationID = a.transportationID AND t.tripID = '".$tripID."'";

			$result = mysqli_query($conn,$transport) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>

		<div class="cards">

			<div class="caption">
                <p class="description">

                <b><h2><?php echo $row["trans_type"];?></h2></b>

                </p>
				<p class="description">

					<b>Description</b>:<br>
					<?php echo $row["description"];?>

				</p><br>
                <p class="duration_stay">
                    <b>Car Plate Number:</b>:<br>
                    <?php echo $row["carPlateNo"]?>
                </p>
			</div>
		</div>

	<?php 
		}

	?>
	</section>

    <div>
        <form action="bookTrip.php" method="post">
            <input type="hidden" name="tripID" value="<?php echo $tripID;?>">
            <button id="back" type="submit" onclick="return checkbook()">Book Now</button>
        </form>
    </div>
    
    <div id="back"><a href="mainTrip.php">Back</a></div>

    
    <script>
       
    function checkbook(){
    return confirm('Are you sure you want to book this trip?');
    }
    </script> 
   

</body>
</html>