<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
$username=$_GET['updateusername'];
$sql = "select name,contactNo,email,status_acc from users where username ='$username'";
$result = mysqli_query($conn,$sql);
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $contactNo = $row['contactNo'];
    $email = $row['email'];
    $status_acc = $row['status_acc'];
  }
}

if (isset($_POST['submit'])) {
  $newName = $_POST['name'];
  $newContactNo = $_POST['contact'];
  $newEmail = $_POST['email'];
  $status_acc = $_POST['status_acc'];

  $sql = "update users set name='$newName', contactNo ='$newContactNo', email='$newEmail', status_acc='$status_acc' where username= '$username'";
  $result = mysqli_query($conn, $sql);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   
  } else {
    
    echo "Updated";
    header('location: display.php');
  } 
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
    
    <h1 class="text-center pb-5 display-4 fs-3">
        Update User
      </h1>

    <form method="post">
    <div class="form-group">
  <label>Name</label>
    <input type="text" class="form-control" placeholder="Enter Name"
    name="name" autocomplete="off" value=<?php echo $name;?>>
  </div>
  <div class="form-group">
  <label>Contact Number</label>
    <input type="text" class="form-control" placeholder="Enter Contact No"
    name="contact" autocomplete="off" value=<?php echo $contactNo;?>>
  </div>
  <div class="form-group">
  <label>Email</label>
    <input type="text" class="form-control" placeholder="Enter Email"
    name="email" autocomplete="off" value=<?php echo $email;?>>
    </div>
   
  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Status Account</label>
  <select name="status_acc" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected>Choose...</option>
    <option value="Active">Active</option>
    <option value="Inactive">Unactive</option>
  </select>
  <div>
  <button type="submit" class="btn btn-primary my-1" name="submit">Submit</button>
</form>
    <div>
</body>

</html>


	 
