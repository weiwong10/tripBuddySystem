<?php
  include "../connect.php";
  session_start();
  $username = $_SESSION['username'];
  $tripID = $_GET['tripID'];
?>


<?php  
include('updateserver.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="createtrip.css">
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">-->
  <title>Create Trip</title>
</head>
<body>
		
<?php 
include("nav/nav_createTrip.php");

$update ="SELECT * FROM trip WHERE tripID = '$tripID'";
$select = mysqli_query($conn, $update) or die(mysqli_error($conn));

if(mysqli_num_rows($select) > 0){
   $fetch = mysqli_fetch_assoc($select);
}

?>



<div>
<br>
<table class="center_table" id="table1">
  <form method="post" action="updateserver.php" enctype="multipart/form-data">
    <tr>
      <td>
        <?php if (isset($_GET['error'])) { ?>
        <div class="alert" role="alert">
          <?=$_GET['error']?>
        </div>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td>
      <label>Title :</label><br>
      <input class="input" type="text" name="title" placeholder="Title" value="<?php echo $fetch['title']?>">
      </td>
    </tr>
    <tr>      
      <td>
      <label>Price :</label><br>
      <input class="input" type="number" name="price" min="0" placeholder="0000.00" value="<?php echo $fetch['price']?>">
      </td>     
    </tr>
    <tr>
      <td>
      <label>Start Date :</label><br>
      <input class="input" type="date" id="datePickerId" name="start_date" value="<?php echo $fetch['start_date']?>">
      </td>     
    </tr>
    <tr>
      <td>
      <label>End Date :</label><br>
      <input class="input" type="date" id="datePickerId2" name="end_date" value="<?php echo $fetch['end_date']?>">
      </td>     
    </tr>
    <tr>      
      <td>
      <label>Maximum Number Of People :</label><br>
      <input class="input" type="text" name="max_people" placeholder="0" value="<?php echo $fetch['max_people']?>">
      </td>     
    </tr>
    <tr>      
      <td>
      <label>Accommodation :</label><br>
      <input class="input" type="text" name="accommodation" placeholder="Accommodation" value="<?php echo $fetch['accommodation']?>">
      </td>     
    </tr>
    <tr>      
      <td>
      <label>Description :</label><br>
      <input class="input" type="text" name="description" placeholder="Description" value="<?php echo $fetch['description']?>">
      </td>     
    </tr>
    <!--<tr>      
      <td>
      <input class="input" type="hidden" name="username" >
      </td>     
    </tr>-->
    <tr>      
      <td>
      <label>Theme :</label><br>
      <select class="input" name="themeID">
      <option value="">--- Select ---</option> 
      <?php 
      $sql = mysqli_query($conn, "SELECT * FROM theme");
      while ($themeID = $sql->fetch_assoc())
      {
      ?>
        <option value="<?php echo $themeID['themeID'];?>"><?php echo $themeID['themeName'];?></option>
      <?php
      }
      ?>
      </select>
      <br><br>
      </td>     
    </tr>
    <tr>
      <td>
      <label>Trip Picture :</label><br>
      <input class="input" type="file" name="image" id="image" accept="image/jpg, image/jpeg, image/png">  
      </td>     
    </tr>
    <tr>
      <td>
        <br>
        <input type="hidden" name="tripID" value="<?php echo $tripID;?>">
        <input type="hidden" name="current_people" value="<?php echo $fetch['current_people'];?>">
        <button class="btn" type="submit" name="save" id="save" >Next</button>
      </td>  
    </tr>
  </form>
</table>
<br>
</div>

<script>
  datePickerId.min = new Date().toISOString().split("T")[0];
  datePickerId2.min = new Date().toISOString().split("T")[0];
</script>


</body>
</html>