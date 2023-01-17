<?php

include "../connect.php";
session_start();
$username = $_SESSION['username'];

if(isset($_POST['submit'])){
    $spot_name = $_POST['spot_name'];
    $state = $_POST['state'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $insert = "INSERT INTO suggest_form (spot_name, state, address, message, status, username) VALUES ('$spot_name','$state','$address','$message', 'In-Process', '$username');";
      
        if(mysqli_query($conn, $insert)){

            echo "<script>alert('Submit Success!!!');</script>";
            echo"<meta http-equiv='refresh' content='0; url=main.php'/>";
            
        }
        else{
            echo "Error: " . $insert . "<br>" . mysqli_error($conn);
        }


}


?>