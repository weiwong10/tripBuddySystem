<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mainInformation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Theme Detail</title>
</head>
<body>
	<?php include("nav/nav_home.php")?>

	<section class="details">
		<?php
			include "../connect.php";
            session_start();
            $username = $_SESSION['username'];
			$themeID = $_POST['themeID'];
			$sql = "SELECT * FROM theme WHERE themeID = '".$themeID."'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>
		
		<h1 class="themename"><?php echo $row["themeName"]?></h1>
		<hr>

		<div class="cards">
			<div class="images">
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				?>
			</div>

			<div class="caption">
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

    <section class="container" id="c1">

        <h1 class="related">Feature Trip</h1>
        <hr>

        <?php

            $trip_feature = "SELECT DISTINCT t.tripID, start_date, t.image, current_people, title, t.description, price FROM trip t, theme h WHERE t.themeID = h.themeID AND h.themeID = '$themeID' AND start_date > sysdate() AND featuredID != 'NULL' AND sysdate() <= featured_exp;";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {

        ?>

        <div class="box-container" id="box-container">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            //New
            $tripID = $row['tripID'];
            ?>

            <div class="box" id="box">
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
                    <?php 
                        echo $row["description"];	
                    ?>
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

        <div class="btn-load" id="load-more"> Load More </div><br>

        </div>

        <script>
        let loadMoreBtn = document.querySelector('#load-more');
        let currentItem = 3;

        loadMoreBtn.onclick = () =>{
        let boxes = [...document.querySelectorAll('#c1 #box-container #box')];
        for (var i = currentItem; i < currentItem + 3; i++){
        boxes[i].style.display = 'inline-block';
        }
        currentItem += 3;

        if(currentItem >= boxes.length){
        loadMoreBtn.style.display = 'none';
        }
        }

        </script>

        <?php  
            }
            else{
        ?>
                <h2 style="text-align: center;">--No Record Found--</h2>

        <?php
            }
        ?>

    </section>

    <br>


    <section class="container" id="c2">
        
        <h1 class="related">Related Trip</h1>
        <hr>
        
        <?php

            $trip = "SELECT DISTINCT tripID, start_date, t.image, current_people, title, t.description, price FROM trip t, theme h WHERE t.themeID = h.themeID AND h.themeID = '$themeID' AND start_date > sysdate()";
            $result1 = mysqli_query($conn,$trip) or die(mysqli_error($conn));

            if (mysqli_num_rows($result1) > 0) {
        ?>
                
        <div class="box-container" id="box-container1">
            <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                //New
                $tripID = $row['tripID'];
            ?>

            <div class="box" id="box1">
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
                    <?php 
                        echo $row["description"];
                        echo $tripID;	
                    ?>
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

        <div class="btn-load" id="load-more1"> Load More </div><br>

        </div>

        <script>
        let loadMoreBtn1 = document.querySelector('#load-more1');
        let currentItem1 = 3;

        loadMoreBtn1.onclick = () =>{
        let boxes1 = [...document.querySelectorAll('#c2 #box-container1 #box1')];
        for (var j = currentItem1; j < currentItem1 + 3; j++){
        boxes1[j].style.display = 'inline-block';
        }
        currentItem1 += 3;

        if(currentItem1 >= boxes1.length){
        loadMoreBtn1.style.display = 'none';
        }
        }

        </script>

        <?php  
            }
            else{
        ?>
                <h2 style="text-align: center;">--No Record Found--</h2>

        <?php
            }
        ?>

    </section>


    <button onclick="window.open('mainTheme.php', '_self')" id="home">Back</button>


</body>
</html>