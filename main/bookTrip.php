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

    if($current_people < $max_people){
        $trip_detail = "INSERT INTO trip_joining(username, tripID) VALUES('" . $username . "','" . $tripID . "')";
        
        if(mysqli_query($conn, $trip_detail)){

            echo "<script>alert('Book Success!!!');</script>";
            echo"<meta http-equiv='refresh' content='0; url=mainTrip.php'/>";
            
            $update_people = "UPDATE trip SET current_people = '" . ($current_people + 1) . "'WHERE tripID ='" . $tripID . "'";
            $result = mysqli_query($conn, $update_people) or die(mysqli_error($conn));    
        }
        else{
            echo "Error: " . $trip_detail . "<br>" . mysqli_error($conn);
        }

    }
    else{
        echo "<script>alert('The Trip is full now');</script>";
        echo"<meta http-equiv='refresh' content='0; url=mainTrip.php'/>";
    }

}
else{
    echo "No Trip Selected";
}

?>