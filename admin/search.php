<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Result</title>

</head>
<body>

		<?php include("navAdmin/nav_admin.php");

			include ("../connect.php");

            $search = $_POST['search'];
			
			if(empty($search)){
				echo "<script>alert('Please insert the keyword');</script>";
				echo"<meta http-equiv='refresh' content='0; url=travelSpot.php'/>";
			}
			else{

            $sql = "SELECT * from travel_spot WHERE spot_name LIKE '%$search%' OR state LIKE '%$search%'";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
             
			?>
                
            <div class="container">
            <?php
            if (mysqli_num_rows($result) > 0) {

                ?>

                <h1 class="heading">Search Result</h1>
                <div class="box-container">
            
                <?php

                while ($row = mysqli_fetch_assoc($result)) 
                {

                    ?>
     <table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">SpotID</th>
      <th scope="col">Spot Name</th>
      <th scope="col">State</th>
      <th scope="col">Address</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
                

    <?php

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $spotID = $row['spotID'];
                    $spot_name = $row['spot_name'];
                    $state = $row['state'];
                    $address = $row['address'];
                    $description = $row['description'];
                    $image = $row['image'];
                    echo '<tr>
            <th scope="row">' . $spotID . '</th>
            <td>' . $spot_name . '</td>
            <td>' . $state . '</td>
            <td>' . $address . '</td>
            <td>' . $description . '</td>
            <td><img src="data:image;base64,' . base64_encode($row['image']) . '"alt="Image";" width="125px" height="125px""></td>
            
            <td>
            <button class="btn btn-primary"><a href="updateTravel.php? updatespotID=' . $spotID . '"class="text-light">Update</a></button>
            </td>
          </tr>';
                }
            }
            
                }
                
            ?>    
                <?php
        
            }

            else{
                echo "<script>alert('No Record Found');</script>";
				echo"<meta http-equiv='refresh' content='0; url=travelSpot.php'/>";
				}
		 	?>
            <!-- <div class="back">
		 	<button onclick="window.open('http://localhost/workshop2/workshop%202/admin/travelSpot.php?', '_self')">Back</button>
		 	</div>
             </div> -->
		 <?php

            }
            ?>
              </tbody>
</table>
</body>
</html>