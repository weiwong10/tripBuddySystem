<?php
include "../connect.php";
include("navAdmin/nav_admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container" >
<br>
    <button class="btn btn-primary my-1"><a href="addfeatured.php"  class="text-light">Add Featured </a></button>

    <table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">Featured ID</th>
      <th scope="col">Duration</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Operation</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select featuredID,duration,price,description from featured";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $featuredID = $row['featuredID'];
            $duration = $row['duration'];
            $price = $row['price'];
            $description = $row['description'];
            echo '<tr>
            <th scope="row">'.$featuredID .'</th>
            <td>'.$duration.'</td>
            <td>' .$price.'</td>
            <td>'.$description.'</td>
            <td>
            <button class="btn btn-primary"><a href="updatefeatured.php? updatefeaturedID='.$featuredID.'"class="text-light">Update</a></button>
            <button class="btn btn-danger"><a href="deletefeatured.php? deletefeaturedID='.$featuredID.'"class="text-light">Delete</a></button> 
            </td>
          </tr>';
        }
    }

    
    ?>
  </tbody>
</table>
</div>
</body>
</html>

<!-- <button class="btn btn-danger"><a href="delete.php? deleteusername='.$username.'"class="text-light">Delete</a></button> -->