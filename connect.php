<?php

$servername = "localhost";
$user = "root";
$password="";
//$database="tripbuddytest";
$database = "tripbuddy";

$conn = new mysqli($servername, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connect success!";
?>



	
