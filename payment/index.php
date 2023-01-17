<?php
  include "../connect.php";
  session_start();
  $username = $_SESSION['username'];
  //new
  $tripID = $_GET['tripID'];
  $price = $_GET['price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

    <form action="indexnew.php" method="post">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>Price :</span>
                    <input type="text" placeholder="Name" value="RM <?php echo $price ?>" disabled>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="example@example.com" require>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="Address" require>
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="City" require>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" placeholder="State" require>
                    </div>
                    <div class="inputBox">
                        <span>Post code :</span>
                        <input type="text" placeholder="Postcode" require>
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="Name" require>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444" require>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" placeholder="00/00" require>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="2022" require>
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="123" require>
                    </div>
                </div>

            </div>
    
        </div>

        <input type="hidden" name="price" value="<?php echo $price?>">
        <input type="hidden" name="tripID" value="<?php echo $tripID?>">
        <input type="submit" value="proceed to checkout" class="submit-btn">

    </form>

</div>    

</body>
</html>