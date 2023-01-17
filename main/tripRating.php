<?php session_start();
include "../connect.php";
$username = $_SESSION['username'];
$tripID = $_POST['tripID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="tripRating.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Trip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        include("nav/nav_myTrip.php");
	
	?>

    <h1 style="text-align: center; margin-top: 50px;">Feedback</h1>
    
    <section class="trip_details">

        <div class="cards">

			<div class="caption">
            <form action="rate_sql.php" method="POST">
                
				<label for="">Score: </label>
				<input type="number" name="score" class="form-control" placeholder="1 - 5" min="0" max="5" step="1" />
           
				<label for="">Feedback: </label><br>
				<textarea rows="3" cols="90" name="feedback" placeholder="Feedback"></textarea>
                <br>
				<input type="hidden" name="tripID" value="<?php echo $tripID; ?>">
				<button type="submit" name="rate" class="btn btn-primary">Submit</button>

            </form>
			</div>
		</div>

    </section>

    <section class="details">
        <h1 class="spotname">Other user</h1>
        <hr>
		<?php
			include "../connect.php";
			$sql = "SELECT name, u.image, feedback, rating FROM trip t, trip_joining j, users u WHERE t.tripID = j.tripID AND j.username = u.username AND t.tripID = '$tripID'";

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
				<p class="name">

					<b>Name</b> :
					<?php echo $row["name"];?>
					
				</p>
				<p class="rating">

					<b>Rating</b> :
					<?php echo $row["rating"]?> / 5
					
				</p>
                <p class="feedback">

                    <b>Feedback</b> :
                    <?php echo $row["feedback"]?>

                </p>

			</div>
		</div>

	<?php 
		}

	?>
	</section>

    <div id="back"><a href="tripHistory.php">Back</a></div>

</body>
</html>