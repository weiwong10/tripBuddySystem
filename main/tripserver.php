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

  $title = $_POST['title'];
  $price = $_POST['price'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  //$duration = $_POST['duration'];
  //$current_people = $_POST['current_people'];
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
        header("Location:createtrip.php?error=Image is too big");
      
      }
      else{
        $image = addslashes(file_get_contents($insert_image_tmp_name));
       
      }
    }
    else{
      header("Location:createtrip.php?error=Image is Required");
    }

  //$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

  if(empty($title))
  {
    header("Location:createtrip.php?error=Title is Required");
  }
//  elseif (empty($price)) 
//  {
//    header("Location:createtrip.php?error=Price is Required");
//  }
  elseif ($price < 0 || $price > 9999) 
  {
    header("Location:createtrip.php?error=Price need to be between 0.00 - 9999.00");
  }
  elseif (empty($start_date)) 
  {
    header("Location:createtrip.php?error=Start Date is Required");
  }
  elseif (empty($end_date)) 
  {
    header("Location:createtrip.php?error=End Date is Required");
  }
  elseif ($end_date < $start_date) 
  {
    header("Location:createtrip.php?error=End Date must be after Start Date");
  }
  elseif (empty($max_people)) 
  {
    header("Location:createtrip.php?error=Maximum number of people is Required");
  }
  elseif (empty($accommodation)) 
  {
    header("Location:createtrip.php?error=Accommodation is Required");
  }
  elseif (empty($description)) 
  {
    header("Location:createtrip.php?error=Description is Required");
  }
  elseif (empty($themeID)) 
  {
    header("Location:createtrip.php?error=Please select a Theme");
  }
  elseif (empty($image)) 
  {
    header("Location:createtrip.php?error=Trip picture is Required");
  }
  elseif (!empty($image)){
      if($insert_image_size > 60000){
        header("Location:createtrip.php?error=Image is too big");
      }else{

    if (empty($price)) 
    {
      $price =0;
    }

        mysqli_query($conn, "INSERT INTO trip (title, price, start_date, end_date, duration, current_people, max_people, accommodation, description, created_date, featured_exp, username, themeID, paymentID, featuredID, image) VALUES ('$title', '$price', '$start_date', '$end_date', 0, 0, '$max_people', '$accommodation', '$description', SYSDATE(), NULL, '$username', '$themeID', NULL, NULL, '$image')");
    
        //new
        $_SESSION['last_id'] = mysqli_insert_id($conn);

        mysqli_query($conn, "UPDATE trip SET duration = (SELECT DATEDIFF(end_date, start_date) + 1)");
    
        header('location:createTrip2.php');
      }
  }
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
    header("Location: createTrip3.php?error=Please select Transportation");
  }
  elseif(empty($description))
  {
    header("Location: createTrip3.php?error=Description is Required");
  }
  else
  {
    mysqli_query($conn, "INSERT INTO transportation_trip (transportationID, tripID, description, carPlateNo) VALUES ('$transportationID', '$tripID', '$description', '$carPlateNo')");

    header('location: createTrip3.php');
  }
}

if (isset($_POST['next'])) 
{
    header('location: createtrip_4.php');
}

/*-----------------------------------------------------------CHOOSE_FEATURE-----------------------------------------------------------*/


if (isset($_POST['save5'])) 
{
  $featuredID = $_POST['featuredID'];
  $yesno = $_POST['yesno'];
  $tripID = $_POST['tripID'];

  if($yesno == 1)
  {
    if(empty($featuredID))
    {
      header("Location: createtrip_4.php?error=Please select Feature Type");
    }
    else
    {
      mysqli_query($conn, "UPDATE trip set featuredID = '$featuredID' WHERE tripID = '$tripID' ");

    
        $sql="SELECT * FROM featured WHERE featuredID = '$featuredID'";
        $result=mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)){
          $duration = intval($row['duration']);
          $price = $row['price'];
        }

        mysqli_query($conn, "UPDATE trip set featured_exp = (SELECT DATE_ADD(created_date, INTERVAL '$duration' DAY)FROM trip WHERE tripID = '$tripID') WHERE tripID ='$tripID'");    
      
    
      header("location:../payment/index.php?price=".$price."&tripID=".$tripID);
    }
  }
  else if ($yesno == 2)
  {
    header('location: myTrip.php');
  }
}
