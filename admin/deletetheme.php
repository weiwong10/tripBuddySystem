<?php
include "../connect.php";
include("navAdmin/nav_admin.php");


if(isset($_GET['deletethemeID'])){
	$themeID=$_GET['deletethemeID'];

	$sql="delete from theme where themeID= ".$themeID."";
	
    $result = mysqli_query($conn, $sql);

	if ($result) {
        echo "Deleted";
        header('location: theme.php');
        
        // header('location: display.php');
      } else {
        // echo "updated successfully";
    echo "error" . (mysqli_error($conn));
      }
  mysqli_close($conn);
}


