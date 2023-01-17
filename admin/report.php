<?php
    session_start();
    include_once '../connect.php';
    //Admin nav bar
     include("navAdmin/nav_admin.php");

     //$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name ="viewreport" content="width=device-width, initial-scale =1.0">
    <link rel="stylesheet" type="text/css" href="report.css">
    <title>Report</title>
    <h1>REPORT</h1>
</head>
<body>


<form action="" method="post" action="">
<table class="center_table">
    <tr>
        <th width="27%" height="63" scope="row">Report Type: </th>
        <td width="73%">
            <select name="type">
                <option value="null">--- Select ---</option>
                <option value="user">User</option>
                <option value="spot">Travel Spot</option>
                <option value="feature">Feature</option>
            </select>
        </td>
    </tr>
    <tr>
        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
            <button class="btn-primary btn" type="submit" name="submit">Check</button>
        </td>
    </tr>
</table>
</form>
    
<hr>

<?php
    if(isset($_POST['submit'])){
        $type = $_POST['type'];
        

    if($type == 'user'){
        header('Location:reportUser.php');
    }
    elseif($type == 'spot'){
        header('Location:reportSpot.php');
    }
    elseif($type == 'feature'){
        header('Location:featureReport.php');
    }
    else{
        echo "<script>alert('Please Select the Valid Report Type');</script>";
        echo"<meta http-equiv='refresh' content='0; url=admin_login.php'/>";
    }
}
?>


</body>
</html>
