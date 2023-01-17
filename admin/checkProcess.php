<?php

include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
$admin_username = $_SESSION['admin_username'];

$suggestID = $_GET['suggestID'];

$update = "UPDATE suggest_form SET status ='Complete' WHERE suggestID = '$suggestID';";

if(mysqli_query($conn, $update)){

    echo "<script>alert('Update Success!!!');</script>";
    echo"<meta http-equiv='refresh' content='0; url=checkSuggest.php'/>";
    
}
else{
    echo "Error: " . $update . "<br>" . mysqli_error($conn);
}

?>