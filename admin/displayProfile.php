<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Profile</title>

    <link rel="stylesheet" href="profile.css">

</head>
<body>
  

<div class = "update-profile" >

<form action="manageprofile.php" method="POST" >

<div class="flex">
<div class="inputBox">
<!-- <img src="images/default-avatar.png" alt=""> -->
<?php
if (isset($_SESSION['admin_username'])) {
  $admin_username = $_SESSION['admin_username'];
  $sql = "Select name,contactNo,email,password,image from admin where admin_username='$admin_username'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $name = $row['name'];
      $contactNo = $row['contactNo'];
      $email = $row['email'];
      $password = $row['password'];
      $image = $row['image'];
      echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" ;">';
    
      // echo '<tr>
      //            <td>' . $name . '</td>
      //            <td>' . $contactNo . '</td>
      //            <td>' . $email . '</td>
      //            <td>

      //          </tr>';
    }
  }
}
         ?> 

         <span>Name:</span>
         <input type="text" class="box" name="name" autocomplete="off" disabled placeholder="<?php echo $name;?>">
            
            <span>Contact Number:</span>
            <input type="text" class="box" name="contactNo" autocomplete="off" disabled placeholder=<?php echo $contactNo;?>>

            <span>Email:</span>
            <input type="text" class="box" name="email" autocomplete="off" disabled placeholder=<?php echo $email;?>>
    
            <span>Current Password :</span>
            <input type="text" name="password" disabled placeholder="*********" class="box">
          
       
         </div>
         <!--<div class="inputBox">
       
         
         </div>-->
      </div>
      <!-- <input type="submit" value="update profile" name="update_profile" class="btn">  -->
       
         <button class="btn btn-primary"><a href="manageProfile.php? updateadmin_username='.$admin_username.'"class="text-light">Update</a></button>
</form>
</div>
        </body>
</html>
