<!DOCTYPE html>
<?php
include ('../connect.php');
include("navAdmin/nav_admin.php");
session_start();
$admin_username = $_SESSION['admin_username'];

  
?>
<html lang = "en">

<html lang = "en">
	<head>
		
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />
		<link rel = "stylesheet" type = "text/css" href = "bootstrap.css " />
		<link rel = "stylesheet" type = "text/css" href = "style.css" />
		<script src="https://kit.fontawesome.com/ba67cd3f0d.js" crossorigin="anonymous"></script>

	<br />
	<div class = "container-fluid">
		<div class = "panel panel-default">
			<div class = "panel-body">
				<div class = "alert alert-info">Manage Payment</div>
				<br />
				<br />
				<table id = "table" class = "table table-bordered">
					<thead>
						<tr>
							<th><center>Suggest ID</th>
							<th><center>Spot Name</th>
							<th><center>State</th>
							<th><center>Address</th>
							<th><center>Message</th>
							<th><center>Status</th>
						
							<th><center>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("SELECT * FROM suggest_form WHERE status='In-Process'") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>	
						<tr>
						<td><center><?php echo $fetch['suggestID']?></td>
							<td><center><?php echo $fetch['spot_name']?></td>
							<td><center><?php echo $fetch['state']?></td>
							<td><center><?php echo $fetch['address']?></td>
							<td><center><?php echo $fetch['message']?></td>
							<td><center><?php echo $fetch['status']?></td>
					

							<td><center><a class = "btn btn-warning" href = "checkProcess.php?suggestID=<?php echo $fetch['suggestID']?>"><i class="fa-solid fa-circle-check"></i> Approve</a> </center></td>
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
<script src = "js/jquery.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/jquery.dataTables.js"></script>
<script src = "js/dataTables.bootstrap.js"></script>	
<script type = "text/javascript">
	function confirmationDelete(anchor){
		var conf = confirm("Are you sure you want to process this form?");
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
</html>