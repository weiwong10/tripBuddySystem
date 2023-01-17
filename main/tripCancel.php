<?php
session_start();
include "../connect.php";
$username = $_SESSION['username'];
$tripID = $_POST['tripID'];

$check = "SELECT current_people, max_people from trip WHERE tripID = '".$tripID."'";
$result = mysqli_query($conn, $check);

if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);

    $current_people = $row["current_people"];
    $max_people = $row["max_people"];

    $cancel_trip = "DELETE FROM trip_joining WHERE username = '" . $username . "' AND tripID = '" . $tripID . "'";

    if(mysqli_query($conn, $cancel_trip)){

        echo "<script>alert('Cancel Success!!!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=mainTrip.php'/>";
            
        $update_people = "UPDATE trip SET current_people = '" . ($current_people - 1) . "'WHERE tripID ='" . $tripID . "'";
        $result = mysqli_query($conn, $update_people) or die(mysqli_error($conn));    
    }
    else
    {
        echo "Error: " . $cancel_trip . "<br>" . mysqli_error($conn);
    }

}
else{
        echo "<script>alert('No record found');</script>";
        echo"<meta http-equiv='refresh' content='0; url=mainTrip.php'/>";
    }

?>