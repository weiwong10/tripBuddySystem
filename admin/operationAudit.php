<?php
include "../connect.php";
include("navAdmin/nav_admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div>
  
<table class="table table-light table-striped">
  <thead>
    <tr>
      <th scope="col">Admin Username</th>
      <th scope="col">Spot ID</th>
      <th scope="col">Audit Time </th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select admin_username,spotID,audit_time,operation from operation_audit";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $admin_username = $row['admin_username'];
            $spotID = $row['spotID'];
            $audit_time = $row['audit_time'];
            $operation = $row['operation'];
            echo '<tr>
            <th scope="row">'.$admin_username.'</th>
            <td>'.$spotID.'</td>
            <td>' .$audit_time.'</td>
            <td>' .$operation.'</td>
  
            <td>
            </td>
          </tr>';
        }
    }

    
    ?>
  </tbody>
</table>
</div>
</body>
</html>

<!-- <button class="btn btn-danger"><a href="delete.php? deleteusername='.$username.'"class="text-light">Delete</a></button> -->