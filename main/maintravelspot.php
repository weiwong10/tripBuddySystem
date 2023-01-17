<?php
	include "../connect.php";
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../travelspot1.css">

</head>
<body>
   <?php include("nav/nav_home.php")?>

   <section class="search">
    
    <form action="mainsearch.php" method="post">
      <input type="text" name="search" placeholder=" Type here to search....">
      <button type="submit" name="submit">Search</button>
    </form>

   </section>

   <div class="container">

      <h1 class="heading">Travel Spot</h1>

      <div class="box-container">
         <?php
            $sql = "SELECT * FROM travel_spot";
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

               <form action="mainInformation.php" method="post">
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

      <div id="load-more"> load more </div><br>
      <div id="home"><a href="main.php">Back</a></div>

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

</body>
</html>