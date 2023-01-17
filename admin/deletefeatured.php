<?php
include "../connect.php";
include("navAdmin/nav_admin.php");


if(isset($_GET['deletefeaturedID'])){
	$featuredID=$_GET['deletefeaturedID'];

	$sql="delete from featured where featuredID= ".$featuredID."";
	
    $result = mysqli_query($conn, $sql);

	if ($result) {
        echo "Deleted";
        header('location: featured.php');
        
        // header('location: display.php');
      } else {
        // echo "updated successfully";
    echo "error" . (mysqli_error($conn));
      }
  mysqli_close($conn);
}


