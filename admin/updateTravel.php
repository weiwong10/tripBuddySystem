<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
$admin_username = $_SESSION['admin_username'];

$spotID=$_GET['updatespotID'];

    if (isset($_POST['submit'])) {
      $newname = $_POST['spot_name'];
      $newstate = $_POST['state'];
      $newaddress = $_POST['address'];
      $newdescription = $_POST['description'];
      
  $update_travel = "UPDATE travel_spot set spot_name ='$newname', state='$newstate', address='$newaddress', description='$newdescription' WHERE spotID ='$spotID'";
    
  $insert_audit = "INSERT into operation_audit(admin_username,spotID,operation) values ('$admin_username','$spotID','UPDATE')";


      $update_image = $_FILES['image']['name'];
      $update_image_size = $_FILES['image']['size'];
      $updata_image_tmp_name = $_FILES['image']['tmp_name'];

      if(!empty($update_image)){
        if($update_image_size > 60000){

          echo "<script>alert('Image is too big')</script>";
          echo "<meta http-equiv='refresh' content='0; url=travelSpot.php'/>";

        }else{
          $image = addslashes(file_get_contents($updata_image_tmp_name));

          $sql = "UPDATE travel_spot set image='$image' where spotID='$spotID'";
    
          $image_update_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        }

      }

     
    if(mysqli_query($conn, $update_travel))
    {
        mysqli_query($conn, $insert_audit);
        echo "Updated";
    header('location: travelSpot.php');
    }
    else
    {
        echo "Error: " . $update_travel . "<br>" . mysqli_error($conn);
    }
    }

  //}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Travel</title>
    
    
    <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- bootstrap 5 Js bundle CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
<?php
    $sql="Select spot_name,state,address,description from travel_spot where spotID='$spotID'";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result); 
        $spot_name = $row['spot_name'];
        $state = $row['state'];
        $address = $row['address'];
        $description = $row['description'];
    }
?>

<div class="d-flex justify-content-center
-align-items-center">
     <form action=""
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;"
           enctype="multipart/form-data">

      <h1 class="text-center pb-5 display-4 fs-3">
        Update Travel Spot
      </h1>

    <div class="form-group">
  <label for="inputName" class="form-label">Spot Name</label>
    <input type="text" class="form-control" placeholder="Enter Spot Name" name="spot_name" autocomplete="off" value="<?php echo $spot_name;?>">
  </div>
 
  <div class="form-group">
  <label for="inputState" class="form-label">State</label>
    <input type="text" class="form-control" placeholder="Enter State" name="state" autocomplete="off" value="<?php echo $state;?>">
    </div>

    <div class="form-group">
  <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" placeholder="Enter Address" name="address" autocomplete="off" value="<?php echo $address;?>">
    </div>
 
    <div class="form-group">
  <label for="inputDescription" class="form-label">Description</label>    
    <input type="text" class="form-control" placeholder="Enter Description" name="description" autocomplete="off" value="<?php echo $description;?>">
    </div>
    <!--<form class="form-inline" method="post"> -->

    <div class="form-group">
    <div class="col-sm-10">
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


	 