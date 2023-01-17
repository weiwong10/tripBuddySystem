<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];

    //new
    
    if (isset($_POST['price'])){
    
    $tripID = $_POST['tripID'];
    $price = $_POST['price'];

    //Insert the data to the payment table
    $sql = "INSERT INTO payment (payment_date, amount) VALUES (SYSDATE(),'$price')";
    $insert_payment = mysqli_query($conn, $sql);
    $last_payment = mysqli_insert_id($conn);

    //Update the trip based on the payment id that generate just now
    //Before update try select the auto increment id from the payment we insert just now    
    $update_payment = "UPDATE trip set paymentID = '$last_payment' WHERE tripID = '$tripID'";
    $run = mysqli_query($conn, $update_payment);

    if($run){
       echo "<script>alert('Payment Success!!!');</script>";
       echo"<meta http-equiv='refresh' content='0; url=../main/mainTrip.php'/>";
    }
    else{
        echo "Error: " . $update_payment . "<br>" . mysqli_error($conn);
        echo "<script>alert('Payment failed!!!');</script>";
    }

}
?>