<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Result</title>

</head>
<body>

		<?php include("navAdmin/nav_admin.php");

			include ("../connect.php");

      $search = $_POST['search'];
			
			if(empty($search)){
				echo "<script>alert('Please insert the keyword');</script>";
				echo"<meta http-equiv='refresh' content='0; url=display.php'/>";
			}
			else{

      $sql = "SELECT username,name,contactNo,email,status_acc from users WHERE username LIKE '%$search%' OR name LIKE '%$search%'";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            
			?>
                
            <div class="container">
            <?php
            if (mysqli_num_rows($result) > 0) {

                ?>

                <h1 class="heading">Search Result</h1>
                <div class="box-container">
            
                <?php

                while ($row = mysqli_fetch_assoc($result)) 
                {

                    ?>
    <table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Contact No</th>
      <th scope="col">Email</th>
      <th scope="col">Status Account</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>


    <?php

    // $sql = "Select username,name,contactNo,email,status_acc from users";
    // $result = mysqli_query($conn,$sql);
    //if($result){
     //   while($row=mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $name = $row['name'];
            $contactNo = $row['contactNo'];
            $email = $row['email'];
            $status_acc = $row['status_acc'];
            echo '<tr>
            <th scope="row">'.$username.'</th>
            <td>'.$name.'</td>
            <td>' .$contactNo.'</td>
            <td>'.$email.'</td>
            <td>'.$status_acc.'</td>
            <td>
            <button class="btn btn-primary"><a href="update.php? updateusername='.$username.'"class="text-light">Update</a></button>
            </td>
          </tr>';
       // }
    //}
}     
    
    ?>
    <?php
            }

            else{
                echo "<script>alert('No Record Found');</script>";
				echo"<meta http-equiv='refresh' content='0; url=display.php'/>";
				}
            ?>
            <?php
            }
            ?>
    
              </tbody>
</table>
</body>
</html>