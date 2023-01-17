<?php
include "../connect.php";
include("../main/nav/nav_payment.php");
session_start();
$username = $_SESSION['username'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class = "container">

  <h1 style="margin-left:40% ;margin-top:80px"   class="">Payment History</h1>
     </div>
		
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />

	<br />
	<div class = "container-fluid">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<!--<div class = "alert alert-info">Manage Admin</div>-->
				<br />
				<br />
				<table id = "table" class = "table table-bordered">
					<thead>
						<tr>
							<th><center>trip ID</th>
        					<th><center>Trip Title</th>
        					<th><center>Date</th>
        					<th><center>Amount (RM)</th>
        						
						</tr>
					</thead>
					<tbody>
					<?php
				

						$query = $conn->query("SELECT tripID, title, payment_date, amount from trip t, payment p WHERE t.paymentID = p.paymentID AND username = '$username'") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>	
						<tr>
						
							<td><center><?php echo $fetch['tripID']?></td>
								<td><center><?php echo $fetch['title']?></td>
									<td><center><?php echo $fetch['payment_date']?></td>
										<td><center><?php echo $fetch['amount']?></td>
							
							

						</tr>
					<?php
						}
					?>	
					</tbody>
				</table>
					 
    			
			</div>
		</div>
	</div>
	<br />
	<br />
	
</body>
<script src = "../js/jquery.js"></script>
<script src = "../js/bootstrap.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<script src = "../js/dataTables.bootstrap.js"></script>	
<script type = "text/javascript">
	function confirmationDelete(anchor){
		var conf = confirm("Are you sure you want to delete this record?");
		if(conf){
			window.location = anchor.attr("href");
		}
	} 
</script>

<script type = "text/javascript">
	$(document).ready(function(){
		$("#table").DataTable();
	});
</script>

</body>
</html>