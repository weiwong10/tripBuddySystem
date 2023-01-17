<?php
    include "../connect.php";
    session_start();
    $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Suggest Travel Spot</title>
	<link rel="stylesheet" type="text/css" href="suggest.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
    <?php include("nav/nav_suggest.php")?>
    
    <form action="suggestProcess.php" method="post">
        <div class="container">
            <div class="contact-box">
                <div class="left"></div>
                <div class="right">
                    <h2>Suggest Travel Spot</h2>
                    <input type="text" class="field" placeholder="Travel Spot Name" name="spot_name" require>
                    <input type="text" class="field" placeholder="State" name="state" require>
                    <input type="text" class="field" placeholder="address" name="address" require>
                    <textarea placeholder="Message" class="field" name="message"></textarea>
                    <button class="btn" name="submit">Send</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>