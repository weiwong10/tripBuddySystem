<?php
include "../connect.php";
include("navAdmin/nav_admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div>
  
<br>
<div class="container" >
<button class="btn btn-primary my-"><a href="addTheme.php"  class="text-light">Add Theme </a></button>

<form action="searchTheme.php" class="d-flex" role="search" method="post">
      <input name="search" class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-1" type="submit">Search</button>
    </form>
    <br>
<table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">Theme ID</th>
      <th scope="col">Theme Name</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select themeID,themeName,description,image from theme";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $themeID = $row['themeID'];
            $themeName = $row['themeName'];
            $description = $row['description'];
            $image = $row['image'];
            echo '<tr>
            <th scope="row">'.$themeID.'</th>
            <td>'.$themeName.'</td>
            <td>' .$description.'</td>
            <td><img src="data:image;base64,'.base64_encode($row['image']).'"alt="Image"; " width="125px" height="125px""></td>
            <td>
            <button class="btn btn-primary"><a href="updateTheme.php? updatethemeID='.$themeID.'"class="text-light">Update</a></button>
            <button class="btn btn-danger"><a href="deletetheme.php? deletethemeID='.$themeID.'"class="text-light">Delete</a></button> 
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