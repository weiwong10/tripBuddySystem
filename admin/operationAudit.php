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
				<div class = "alert alert-info">Operation Audit</div>
				<br />
				<br />
				<table id = "table" class = "table table-bordered">
					<thead>
						<tr>
							<th><center>Admin Username</th>
							<th><center>Spot ID</th>
							<th><center>Audit Time</th>
							<th><center>Operations</th>						
						</tr>
					</thead>
					<tbody>
					<?php
						$query = $conn->query("Select admin_username,spotID,audit_time,operation from operation_audit") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
					?>	
						<tr>
						<td><center><?php echo $fetch['admin_username']?></td>
							<td><center><?php echo $fetch['spotID']?></td>
							<td><center><?php echo $fetch['audit_time']?></td>
							<td><center><?php echo $fetch['operation']?></td>
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