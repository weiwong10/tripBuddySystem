<?php 
//error_reporting(0);

include "../connect.php";
//session_start();
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
//$conn = mysqli_connect('localhost', 'root', '', 'newtest');


$username = $_SESSION['username'];

/*-------------------------------------------------------------CREATE_TRIP-------------------------------------------------------------*/

if (isset($_POST['save'])) 
{
  $tripID = $_POST['tripID'];
  $title = $_POST['title'];
  $price = $_POST['price'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  //$duration = $_POST['duration'];
  $current_people = $_POST['current_people'];
  $max_people = $_POST['max_people'];
  $accommodation = $_POST['accommodation'];
  $description = $_POST['description'];
  //$username = $_POST['username'];
  $themeID = $_POST['themeID'];
  //$paymentID = $_POST['paymentID'];
  //$featuredID = $_POST['featuredID'];

   $insert_image = $_FILES['image']['name'];
   $insert_image_size = $_FILES['image']['size'];
   $insert_image_tmp_name = $_FILES['image']['tmp_name'];

  if(!empty($insert_image)){
      if($insert_image_size > 60000){
        header("Location:editTrip.php?error=Image is too big");
      
      }
      else{
        $image = addslashes(file_get_contents($insert_image_tmp_name));
       
        $image_update_query = mysqli_query($conn, "UPDATE trip SET image = '$image' WHERE tripID = '$tripID'") or die(mysqli_error($conn));

      }
    }


  //$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

  if(empty($title))
  {
    header("Location:editTrip.php?error=Title is Required");
  }
//  elseif (empty($price)) 
//  {
//    header("Location:createtrip.php?error=Price is Required");
//  }
  elseif ($price < 0 || $price > 9999) 
  {
    header("Location:editTrip.php?error=Price need to be between 0.00 - 9999.00");
  }
  elseif (empty($start_date)) 
  {
    header("Location:editTrip.php?error=Start Date is Required");
  }
  elseif (empty($end_date)) 
  {
    header("Location:editTrip.php?error=End Date is Required");
  }
  elseif ($end_date < $start_date) 
  {
    header("Location:editTrip.php?error=End Date must be after Start Date");
  }
  elseif (empty($max_people)) 
  {
    header("Location:editTrip.php?error=Maximum number of people is Required");
  }
  elseif (empty($accommodation)) 
  {
    header("Location:editTrip.php?error=Accommodation is Required");
  }
  elseif (empty($description)) 
  {
    header("Location:editTrip.php?error=Description is Required");
  }
  elseif (empty($themeID)) 
  {
    header("Location:editTrip.php?error=Please select a Theme&tripID=".$tripID);
  }
  elseif (!empty($image)){
      if($insert_image_size > 60000){
        header("Location:editTrip.php?error=Image is too big");
      }
    }

    if (empty($price)) 
    {
      $price =0;
    }

        $_SESSION['update'] = $tripID;

        mysqli_query($conn, "UPDATE trip SET title ='$title', price ='$price', start_date ='$start_date', end_date ='$end_date', max_people ='$max_people', accommodation ='$accommodation', description ='$description', themeID ='$themeID' WHERE tripID ='$tripID'");

        mysqli_query($conn, "UPDATE trip SET duration = (SELECT DATEDIFF(end_date, start_date) + 1) WHERE tripID ='$tripID'");
    
        header("location:editTrip2.php?tripID=".$tripID);

      
  
}
  //else
 // {
  //  echo "'$title', '$price', '$start_date', '$end_date', 0, 0, '$max_people', '$accommodation', '$description', SYSDATE(), NULL, '$username', '$themeID', NULL, NULL, '$image'";
 //   mysqli_query($conn, "INSERT INTO trip (title, price, start_date, end_date, duration, current_people, max_people, accommodation, description, created_date, featured_exp, username, themeID, paymentID, featuredID, image) VALUES ('$title', '$price', '$start_date', '$end_date', 0, 0, '$max_people', '$accommodation', '$description', SYSDATE(), NULL, '$username', '$themeID', NULL, NULL, '$image')");

  //  mysqli_query($conn, "UPDATE trip SET duration = (SELECT DATEDIFF(end_date, start_date) + 1)");

 //   header('location:createtrip_2.php');
 // }
//}


/*-----------------------------------------------------------SELECT_TRAVEL_SPOT-----------------------------------------------------------*/
/*if (isset($_POST['save2'])) 
{
	$tripID = $_POST['tripID'];
  $spotID = $_POST['spotID'];
  $description = $_POST['description'];

  if(empty($spotID))
  {
    header("Location: createtrip_2.php?error=Please select a Travel Spot");
  }
  elseif(empty($description))
  {
    header("Location: travelDescription.php?error=Description is Required");

  }
  else
  {
    mysqli_query($conn, "INSERT INTO travel_itinerary (tripID, spotID, description) VALUES ('$tripID', '$spotID', '$description')");

    header('location: createTrip2.php');
  } 
}

if (isset($_POST['save3'])) 
{
  $tripID = $_POST['tripID'];
  $spotID = $_POST['spotID'];
  $description = $_POST['description'];

  if(empty($spotID))
  {
    header("Location: createtrip_2.php?error=Please select a Travel Spot");
  }
  elseif(empty($description))
  {
    header("Location: createtrip_2.php?error=Description is Required");
  }
  else
  {
    mysqli_query($conn, "INSERT INTO travel_itinerary (tripID, spotID, description) VALUES ('$tripID', '$spotID', '$description')");

    header('location: createtrip_3.php');
  }
}

*/

/*---------------------------------------------------------SELECT_TRANSPORTATION---------------------------------------------------------*/


if (isset($_POST['save4'])) 
{
  $transportationID = $_POST['transportationID'];
  $tripID = $_POST['tripID'];
  $description = $_POST['description'];
  $carPlateNo = $_POST['carPlateNo'];

  if(empty($transportationID))
  {
    header("Location: editTrip3.php?error=Please select Transportation");
  }
  elseif(empty($description))
  {
    header("Location: editTrip3.php?error=Description is Required");
  }
  else
  {
    mysqli_query($conn, "INSERT INTO transportation_trip (transportationID, tripID, description, carPlateNo) VALUES ('$transportationID', '$tripID', '$description', '$carPlateNo')");

    header('location: editTrip3.php');
  }
}

if (isset($_POST['next'])) 
{
    echo "<script>alert('Update Success');</script>";
    echo"<meta http-equiv='refresh' content='0; url=myTrip.php'/>";
}

