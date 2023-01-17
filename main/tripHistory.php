<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mainInformation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Join Trip</title>
</head>
<body>
	<?php include("nav/nav_tripHistory.php")?>

     <section class="container" id="c1">

        <h1 class="related">Hosted Trip</h1>
		<hr>

        <?php
             $trip_feature = "SELECT DISTINCT tripID, start_date, duration, image, title, description, price, current_people from trip WHERE username = '$username' AND start_date < sysdate();";
             $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));

            if(mysqli_num_rows($result) > 0){
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

                    <form action="historyHost.php" method="post">
                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                        <button class="btn" type="submit">View Detail</button>
                    </form>

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

    
    <section class="container" id="c2">

        <h1 class="related">History Trip</h1>
		<hr>

        <?php
            $trip_feature = "SELECT DISTINCT tripID, start_date, duration, duration, image, title, description, price, current_people from trip WHERE tripID IN (SELECT tripID from trip_joining WHERE username = '$username') AND start_date < sysdate();";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));
            
            if(mysqli_num_rows($result) > 0){
            ?>

        <div class="box-container" id="box-container2">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="box" id="box2">
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

                    <form action="tripRating.php" method="post">
                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                        <button class="btn" type="submit">Rate</button>
                    </form>

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

        <div class="btn-load" id="load-more2"> Load More </div><br>

        </div>

        <script>
        let loadMoreBtn2 = document.querySelector('#load-more2');
        let currentItem2 = 3;

        loadMoreBtn2.onclick = () =>{
        let boxes2 = [...document.querySelectorAll('#c2 #box-container2 #box2')];
        for (var j = currentItem; j < currentItem + 3; j++){
        boxes2[j].style.display = 'inline-block';
        }
        currentItem2 += 3;

        if(currentItem2 >= boxes2.length){
        loadMoreBtn2.style.display = 'none';
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

</body>
</html>