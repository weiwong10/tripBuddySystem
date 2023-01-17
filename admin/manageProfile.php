<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
$admin_username=$_SESSION['admin_username'];
$sql = "Select name,contactNo,email,password from admin where admin_username='$admin_username'";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $contactNo = $row['contactNo'];
            $email = $row['email'];
            $password = $row['password'];
           
        }
    }


if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $newcontactNo = $_POST['contactNo'];
  $newemail = $_POST['email'];
  $newpassword = $_POST['password'];

  $sql = "update admin set name='$name', contactNo='$newcontactNo', email='$newemail', password='$newpassword' where admin_username='$admin_username'";
  $result = mysqli_query($conn, $sql);
  if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);
    
  } else {
    
    echo "Updated";
    header('location: displayProfile.php');
  } 
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name ="viewreport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main</title>
   <link rel="stylesheet" href="profile.css">
</head>
<body>

<div class = "update-profile">

<form method="POST" >
      <div class="flex">
         <div class="inputBox">
         
         <?php
         $sql = "Select image from admin where admin_username='$admin_username'";
         $result = mysqli_query($conn, $sql);
         if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['image'];
            echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" ;">';
          
          }
        }
       
         ?>
            <span >Name:</span>
            <input type="text" class="box" name="name" autocomplete="off" placeholder="Enter Name" value="<?php echo $name;?>">
            
            <span>Contact No:</span>
            <input type="text" class="box" name="contactNo" autocomplete="off" placeholder="Enter Contact No" value=<?php echo $contactNo;?>>

            <span>Email:</span>
            <input type="text" class="box" name="email" autocomplete="off" placeholder="Enter email" value=<?php echo $email;?>>

            <span>Change Password:</span>
            <input type="text" class="box" name="password" placeholder="*********" value=<?php echo $password;?>>
            </div>
          </div>
            <input type="submit" value="Update Profile" name="submit" class="btn">

        </form>
    </div>

</body>

</html>