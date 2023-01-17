<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");

if(isset($_POST['submit'])){
  $themeID=$_POST['themeID'];
  $name=$_POST['themeName'];
  $description=$_POST['description'];


  $insert_image = $_FILES['image']['name'];
  $insert_image_size = $_FILES['image']['size'];
  $insert_image_tmp_name = $_FILES['image']['tmp_name'];
  
  $image = addslashes(file_get_contents($insert_image_tmp_name));

  $sql="insert into theme (themeID,themeName,description,image) values ('$themeID','$name', '$description', '$image')";

  $image_insert_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $result = mysqli_query($conn, $sql);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      // header('location: display.php');
    } else {
      // echo "updated successfully";
      
      echo "Inserted";
      header('location: theme.php');
    } 
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Travel Spot</title>

    <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
  
<div class="d-flex justify-content-center
-align-items-center">
     <form action="addTheme.php"
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;"
           enctype="multipart/form-data">

      <h1 class="text-center pb-5 display-4 fs-3">
        Add New Theme
      </h1>
    
      <div class="mb-3">
        <label class="form-label">
                Theme Name
               </label>
        <input type="text" 
               class="form-control" 
               name="themeName" required>
    </div>

    <div class="mb-3">
        <label class="form-label">
                Description
               </label>
        <input type="text" 
               class="form-control" 
               name="description" required>
    </div>
    <div class="form-group">
    <div class="col-sm-12">
    <h4><b>Upload Images</b></h4>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-sm-4"><input type="file" name="image" required> 
    </div>

    <div class="mb-3">
    </div>
    <div class="hr-dashed"></div>                 
    </div>

      <button type="submit" name="submit" value="submit" class="btn btn-primary"> Submit </button>
     </form>
  </div>
</body>
</html>

