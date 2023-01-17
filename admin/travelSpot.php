<?php
include "../connect.php";
include("navAdmin/nav_admin.php");
session_start();
$admin_username = $_SESSION['admin_username'];

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
    <button class="btn btn-primary my-1"><a href="addTravel.php"  class="text-light">Add Travel Spot </a></button>
    <button class="btn btn-primary my-1"><a href="operationAudit.php"  class="text-light"> Operation Audit</a></button>
    

   <form action="search.php" class="d-flex" role="search" method="post">
      <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-1" type="submit">Search</button>
    </form> 

    <table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">SpotID</th>
      <th scope="col">Spot Name</th>
      <th scope="col">State</th>
      <th scope="col">Address</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select spotID,spot_name,state,address,description,image from travel_spot";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $spotID = $row['spotID'];
            $spot_name = $row['spot_name'];
            $state = $row['state'];
            $address = $row['address'];
            $description = $row['description'];
            $image = $row['image'];
            echo '<tr>
            <th scope="row">'.$spotID .'</th>
            <td>'.$spot_name.'</td>
            <td>' .$state.'</td>
            <td>'.$address.'</td>
            <td>'.$description.'</td>
            <td><img src="data:image;base64,'.base64_encode($row['image']).'"alt="Image"; " width="125px" height="125px""></td>
            
            <td>
            <button class="btn btn-primary"><a href="updateTravel.php? updatespotID='.$spotID.'"class="text-light">Update</a></button>
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