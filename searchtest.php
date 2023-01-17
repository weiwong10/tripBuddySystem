<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="searchtest.css">
    <title>Search Result</title>

</head>
<body>

		<?php include("index_nav.php");

			include ("connect.php");

            $search = $_POST['search'];
			
			if(empty($search)){
				echo "<script>alert('Please insert the keyword');</script>";
				echo"<meta http-equiv='refresh' content='0; url=travelspot1.php'/>";
			}
			else{

            $sql = "SELECT * FROM travel_spot WHERE spot_name LIKE '%".$search."%' OR state LIKE UPPER('%".$search."%')";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

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

                        <form action="informationtest.php" method="post">
                            <input type="hidden" name="spotID" value="<?php echo $row["spotID"]; ?>">						
                            <button class="btn" type="submit">Read More</button>
                        </form>
                        <div class="icons">
                            <span> <i class="fa-sharp fa-solid fa-location-pin"></i> <?php echo $row["state"];?> </span>
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
				echo"<meta http-equiv='refresh' content='0; url=travelspot1.php'/>";
				}
			?>

            <div class="back"><a href="travelspot1.php">Back</a></div>
            </div>
		<?php
		}
		?>


</body>
</html>