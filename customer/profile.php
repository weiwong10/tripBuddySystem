<?php
include '../connect.php';
session_start();
$username = $_SESSION['username'];


if(isset($_POST['update_profile'])){
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_contact = mysqli_real_escape_string($conn, $_POST['update_contact']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
   $update_date = $_POST['update_dob'];

   mysqli_query($conn, "UPDATE users SET name = '$update_name', email = '$update_email', dob = '$update_date', contactNo = '$update_contact', address = '$update_address' WHERE username = '$username'") or die(mysqli_error($conn));

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, $_POST['update_pass']);
   $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
   $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_pass']);

   if(!empty($update_pass)){
   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE users SET password = '$confirm_pass' WHERE username = '$username'") or die(mysqli_error($conn));
         $message[] = 'password updated successfully!';
      }
   }
    }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];


   if(!empty($update_image)){
      if($update_image_size > 60000){
         $message[] = 'image is too large';
      }else{
         $img_ex = pathinfo($update_image, PATHINFO_EXTENSION);
         $img_ex_lc = strtolower($img_ex);

         $allowed_exs = array("jpg", "jpeg", "png");

         if(in_array($img_ex_lc,$allowed_exs)){
            //$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				//$img_upload_path = 'uploads/'.$new_img_name;
				//move_uploaded_file($tmp_name, $img_upload_path);

            $image = addslashes(file_get_contents($update_image_tmp_name));

            $image_update_query = mysqli_query($conn, "UPDATE users SET image = '$image' WHERE username = '$username'") or die(mysqli_error($conn));

				// Insert into Database
            //$image_update_query = mysqli_query($conn, "UPDATE users SET image = '$update_image' WHERE username = '$username'") or die(mysqli_error($conn));

            $message[] = 'image updated succssfully!';
         }else{
            $message[] = 'Not a supported file type';
         }
      }

}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="profile.css">

</head>
<body>
   
<div class="update-profile">
    
   <?php

      $update ="SELECT * FROM users WHERE username = '$username'";
      $select = mysqli_query($conn, $update) or die(mysqli_error($conn));
      
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="data:image/jpeg;base64,'.base64_encode($fetch['image']).'"/>';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>date of birth :</span>
            <input type="date" name="update_dob" value="<?php echo $fetch['dob']; ?>" class="box">
            <span>contact number :</span>
            <input type="text" name="update_contact" value="<?php echo $fetch['contactNo']; ?>" class="box">
            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            <span>address :</span>
            <textarea rows="5" cols="30" class="box" name="update_address"><?php echo $fetch['address']?></textarea>
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="Update Profile" name="update_profile" class="btn">
      <a href="../main/main.php" class="delete-btn">Go Back</a>
   </form>

</div>

</body>
</html>