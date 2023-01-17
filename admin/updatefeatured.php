<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
$featuredID=$_GET['updatefeaturedID'];
$sql="Select duration,price,description from featured where featuredID='$featuredID'";
$result = mysqli_query($conn,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        $duration = $row['duration'];
        $price = $row['price'];
        $description = $row['description'];
  }
}

if (isset($_POST['submit'])) {
    $newduration = $_POST['duration'];
    $newprice = $_POST['price'];
    $newdescription = $_POST['description'];

  $sql = "update featured set duration='$newduration', price='$newprice', description='$newdescription' where featuredID='$featuredID'";
  $result = mysqli_query($conn, $sql);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    // header('location: display.php');
  } else {
    // echo "updated successfully";
    echo "Updated";
    header('location: featured.php');
  } 
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update User</title>
    
      <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <!-- bootstrap 5 Js bundle CDN-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>

<div class="d-flex justify-content-center
-align-items-center">
     <form action=""
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">
    
           <h1 class="text-center pb-5 display-4 fs-3">
        Update Featured
      </h1>

    <div class="form-group">
  <label for="inputDuration" class="form-label">Duration</label>
    <input type="text" class="form-control" placeholder="Enter Duration" name="duration" autocomplete="off" value="<?php echo $duration;?>">
  </div>
 
  <div class="form-group">
  <label for="inputPrice" class="form-label">Price</label>
    <input type="text" class="form-control" placeholder="Enter Price" name="price" autocomplete="off" value="<?php echo $price;?>">
    </div>
 
    <div class="form-group">
  <label for="inputDescription" class="form-label">Description</label>    
    <input type="text" class="form-control" placeholder="Enter Description" name="description" autocomplete="off" value="<?php echo $description;?>">
    </div>
    <!--<form class="form-inline" method="post"> -->
  <div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
</form>
    <div>
</body>

</html>


	 