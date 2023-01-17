<?php
  include "../connect.php";
  session_start();
  $username = $_SESSION['username'];
  //new
  $last_id = $_SESSION['last_id'];

  if(isset($_POST['cancel'])){
    $transID = $_POST['transID'];
    $delete = "DELETE FROM transportation_trip WHERE transportationID = '$transID' AND tripID = '$last_id'";
    $result = mysqli_query($conn, $delete);
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="manageTrans.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Theme Detail</title>
</head>
<body>
	<?php include("nav/nav_createTrip.php")?>

    <section class="container">

        <h1 class="related">Manage Transportation</h1>
        <hr>
        <br>

        <?php
            $trans = "SELECT t.transportationID, trans_type, description, carPlateNo FROM transportation_trip t, transportation s WHERE t.transportationID = s.transportationID AND tripID = '$last_id'";
            $result = mysqli_query($conn,$trans) or die(mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {

        ?>

        <div class="box-container" id="box-container">
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="box" id="box">
                <div class="content">
                    <h3>
                    <?php 
                        echo $row["trans_type"];			
                    ?>	
                    </h3>
                    <p>  Description: 
                    <?php 
                        echo $row["description"];	
                    ?>
                    </p>
                    <p> Car Plate Number:
                        <?php echo $row["carPlateNo"];?>
                    </p>

                    <form action="" method="post">
                        <button class="btn" type="submit" name="cancel">Cancel</button>
                        <input type="hidden" name="transID" value="<?php echo $row["transportationID"]; ?>">						
                    </form>
                </div>
            </div>

            <?php
                }
            ?>

        </div>

        <?php  
            }
            else{
        ?>
                <h2 style="text-align: center;">--No Record Found--</h2>

        <?php
            }
        ?>

    </section>

    <br>

    <button onclick="window.open('createTrip3.php', '_self')" id="home">Back</button>


</body>
</html>