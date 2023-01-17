<?php
	include "connect.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="informationtest.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Join Trip</title>
</head>
<body>
	<?php include("index_nav.php")?>

    <section class="container" id="c1">

        <h1 class="related">Feature Trip</h1>
		<hr>
        
        <?php

            $trip_feature = "SELECT DISTINCT start_date, image, current_people, title, description, price FROM trip WHERE start_date > sysdate() AND featuredID != 'NULL' AND sysdate() <= featured_exp;";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {

          ?>

        <div class="box-container" id="box-container">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
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

                    <a href="login/login.php" class="btn">Book Now</a>

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
        
        <h1 class="related">All Trip</h1>
		<hr>
        
        <?php

            $trip = "SELECT DISTINCT start_date, image, current_people, title, description, price FROM trip WHERE start_date > sysdate();";
            $result1 = mysqli_query($conn,$trip) or die(mysqli_error($conn));

            if (mysqli_num_rows($result1) > 0) {
        ?>
                
        <div class="box-container" id="box-container1">
            <?php
                while ($row = mysqli_fetch_assoc($result1)) {
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
                    ?>
                    </p>

                    <a href="login/login.php" class="btn">Book Now</a>

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

    <div id="home"><a href="indextest.php">Back</a></div>

</body>
</html>