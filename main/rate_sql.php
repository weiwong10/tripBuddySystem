<?php 
session_start();
include "../connect.php";
$tripID = $_POST['tripID'];
$score = $_POST['score'];
$feedback = $_POST['feedback'];
$username = $_SESSION['username'];

if(isset($_POST['rate'])){

	$update = "UPDATE trip_joining set feedback = '".$feedback."' , rating = '".$score."' WHERE tripID = '".$tripID."' AND username = '".$username."' ";
	$result = mysqli_query($conn, $update) or die(mysqli_error($conn));

	if($result){
        echo "<script>alert('Rate Success!!!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=myTrip.php'/>";
	} else {
        echo "<script>alert('Rate Failed!!!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=myTrip.php'/>";
	}

}
	
?>