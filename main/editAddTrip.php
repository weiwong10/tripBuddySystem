<?php
	include "../connect.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_SESSION['username'];

    //new
    $last_id = $_SESSION['update'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../travelspot1.css">

</head>
<body>
    <?php include("nav/nav_createTrip.php")?>

   <section class="search">
    
    <form action="editSearch.php" method="post">
      <input type="hidden" name="last_id" value="<?php echo $last_id?>">
      <input type="text" name="search" placeholder=" Type here to search....">
      <button type="submit" name="submit">Search</button>
    </form>

   </section>

   <section>
    <div class="container">

        <h1 class="heading">Select Travel Itinerary</h1>

        <div class="box-container">
            <?php
                $sql = "SELECT * FROM travel_spot WHERE spotID NOT IN (SELECT spotID FROM travel_itinerary WHERE tripID = '$last_id')";
                $all_spot = mysqli_query($conn,$sql) or die(mysqli_error($conn));

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

                <form action="updateTravel.php" method="post">
                    <input type="hidden" name="spotID" value="<?php echo $row["spotID"]; ?>">						
                    <input type="hidden" name="last_id" value="<?php echo $last_id ?>">						
                    <button class="btn" type="submit">Choose</button>
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
        <div id="load-more"> load more </div><br>
        <div id="home"><a href="editTrip2.php?tripID=<?php echo $last_id?>">Back</a></div>

    </div>

    <script>

        let loadMoreBtn = document.querySelector('#load-more');
        let currentItem = 3;

        loadMoreBtn.onclick = () =>{
        let boxes = [...document.querySelectorAll('.container .box-container .box')];
        for (var i = currentItem; i < currentItem + 3; i++){
            boxes[i].style.display = 'inline-block';
        }
        currentItem += 3;

        if(currentItem >= boxes.length){
            loadMoreBtn.style.display = 'none';
        }
        }

    </script>

</section>

</body>
</html>