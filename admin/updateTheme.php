<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
$admin_username = $_SESSION['admin_username'];

$themeID=$_GET['updatethemeID'];

    if (isset($_POST['submit'])) {
     $newthemeName =$_POST['themeName'];
     $newdescription = $_POST['description'];

  mysqli_query($conn, "UPDATE theme set themeName='$newthemeName', description='$newdescription' where themeID='$themeID'");

  $update_image = $_FILES['image']['name'];
      $update_image_size = $_FILES['image']['size'];
      $updata_image_tmp_name = $_FILES['image']['tmp_name'];

  if (!empty($update_image)) {
    if ($update_image_size > 60000) {

      echo "<script>alert('Image is too big')</script>";
      echo "<meta http-equiv='refresh' content='0; url=theme.php'/>";

    } else {
      $image = addslashes(file_get_contents($updata_image_tmp_name));

      $sql = "UPDATE theme set image='$image' where themeID='$themeID'";

      $image_update_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
  }

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   
  } else {
    
    echo "Updated";
    header('location: theme.php');
  } 
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Theme</title>
    
     <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <!-- bootstrap 5 Js bundle CDN-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
<?php 
        $sql="Select themeName,description from theme where themeID='$themeID'";
        $result = mysqli_query($conn,$sql);
        if($result){
        $row = mysqli_fetch_assoc($result);
        $themeName = $row['themeName'];
        $description = $row['description'];
        }
?>
    <div class="container my-5">
    
    <div class="d-flex justify-content-center
    -align-items-center">
     <form action=""
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;"
           enctype="multipart/form-data">

           
      <h1 class="text-center pb-5 display-4 fs-3">
       Update Theme
      </h1>


    <div class="form-group">
  <label for="inputName" class="form-label">Theme Name</label>
    <input type="text" class="form-control" placeholder="Enter Theme Name" name="themeName" autocomplete="off" value="<?php echo $themeName;?>">
  </div>
 
    <div class="form-group">
  <label for="inputDescription" class="form-label">Description</label>    
    <input type="text" class="form-control" placeholder="Enter Description" name="description" autocomplete="off" value="<?php echo $description;?>">
    </div>
    <!--<form class="form-inline" method="post"> -->

    <div class="form-group">
    <div class="col-sm-12">
    <h4>Upload Images</h4>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-sm-4"><input type="file" name="image" accept="image/jpg, image/jpeg, image/png"> 
    </div>

    <div class="mb-3">
    </div>
    <div class="hr-dashed"></div>                 
    </div>

  <div>
  <button type="submit" class="btn btn-primary my-1" name="submit">Submit</button>
</form>
    <div>
</body>

</html>


	 