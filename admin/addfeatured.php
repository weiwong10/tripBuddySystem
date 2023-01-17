<?php
include "../connect.php";
include("navAdmin/nav_admin.php");

if (isset($_POST['submit'])) {
  $duration = $_POST['duration'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  // $newimage = $row['image'];

  $sql = "insert into featured (duration,price,description) values ('$duration','$price', '$description')";
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

    <div class="container my-5">

    <div class="d-flex justify-content-center
    -align-items-center">
     <form action=""
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

           <h1 class="text-center pb-5 display-4 fs-3">
        Add New Featured
      </h1>
    
    <div class="form-group">
  <label>Duration</label>
    <input type="text" class="form-control" placeholder="Enter Duration" name="duration" autocomplete="off">
  </div>
  <div class="form-group">
  <label>Price</label>
    <input type="text" class="form-control" placeholder="Enter Price" name="price" autocomplete="off">
    </div>
    <div class="form-group">
  <label>Description</label>    
    <input type="text" class="form-control" placeholder="Enter Description" name="description" autocomplete="off">
    </div>
    <!--<form class="form-inline" method="post"> -->
  <div>
  <button type="submit" class="btn btn-primary my-3" name="submit">Submit</button>
</form>
    <div>
</body>

</html>


	 