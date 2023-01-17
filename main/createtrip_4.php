<?php
  include "../connect.php";
  session_start();
  $username = $_SESSION['username'];
  //new
  $last_id = $_SESSION['last_id'];

?>


<?php  
include('tripserver.php');
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
    
<?php include("nav/nav_createTrip.php")?>



<div>
<br>
<table class="center_table" id="table1">
  <form method="post" action="tripserver.php" enctype="multipart/form-data">
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
        <label>Do you want your trip to be featured ?</label>
        <br><br>
      </td>
    </tr>
    <tr>      
      <td>
        <lable class="radio_lable">
        <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" <?php if (isset($yesno) && $yesno=="1")?> value="1"> Yes
        </lable>
        <lable class="radio_lable">
        <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" <?php if (isset($yesno) && $yesno=="2")?> checked="checked" value="2"> No
        </lable>
      </td>
    </tr>
    <tr>
      <td id="ifYes" style="display:none">
      <br>
      <label>Feature Type :</label><br>
      <select name="featuredID">
      <option value="">--- Select ---</option> 
      <?php 
      $sql = mysqli_query($conn, "SELECT * FROM featured");
      while ($featuredID = $sql->fetch_assoc())
      {
      ?>
        <option value="<?php echo $featuredID['featuredID'];?>"><?php echo $featuredID['description'], " (Price: RM".$featuredID['price'], ")";?></option>
      <?php
      }
      ?>
      </select>
      </td>     
    </tr>
    <tr>
      <td colspan="3">
        <input type="hidden" name="tripID" value="<?php echo $last_id; ?>">
        <button class="btn" type="submit" name="save5" id="save5" >Complete</button>
      </td>  
    </tr>
  </form>
</table>
<br>
</div>


<script type="text/javascript">
  function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) 
    {
      document.getElementById('ifYes').style.display = 'block';
    } 
    else
    {
      document.getElementById('ifYes').style.display = 'none';
    }
  }

  
</script>

</body>
</html>