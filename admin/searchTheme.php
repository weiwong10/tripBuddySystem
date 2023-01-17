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
				echo"<meta http-equiv='refresh' content='0; url=theme.php'/>";
			}
			else{

            $sql = "SELECT * FROM theme WHERE themeID LIKE '%$search%' OR themeName LIKE '%$search%'";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            
			?>
                
            <div class="container">
            <?php
            if (mysqli_num_rows($result) > 0) {

                ?>

                <h1 class="heading">Search Result</h1>
                <div class="box-container">

                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Theme ID</th>
                        <th scope="col">Theme Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Operations</th>
                        </tr>
                    </thead>
                <tbody>
            
                <?php

                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
    <?php

                    // $sql = "Select themeID,themeName,description from theme";
                    // $result = mysqli_query($conn, $sql);
                    // if ($result) {
                    //     while ($row = mysqli_fetch_assoc($result)) {
                            $themeID = $row['themeID'];
                            $themeName = $row['themeName'];
                            $description = $row['description'];
                            $image = $row['image'];
                            echo '<tr>
                            <th scope="row">' . $themeID . '</th>
                            <td>' . $themeName . '</td>
                            <td>' . $description . '</td>
                            <td><img src="data:image;base64,'.base64_encode($row['image']).'"alt="Image"; " width="125px" height="125px""></td>
                            <td>
                            <button class="btn btn-primary"><a href="updateTheme.php? updatethemeID=' . $themeID . '"class="text-light">Update</a></button>
                            <button class="btn btn-danger"><a href="deletetheme.php? deletethemeID=' . $themeID . '"class="text-light">Delete</a></button> 
                            </td>
                            </tr>';
                        //}
                   // }
                }
    
            ?>
            <?php
        
            }

            else{
                echo "<script>alert('No Record Found');</script>";
				echo"<meta http-equiv='refresh' content='0; url=theme.php'/>";
				}
		 	?>
		 <?php

            }
            ?>
              </tbody>
</table>
</body>
</html>