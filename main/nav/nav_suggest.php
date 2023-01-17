<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" type="text/css" href="nav_style1.css">

</head>
<body>
	<!--The nav bar-->
		<div class="menu_bar">

			<h1 class="logo"> Trip<span>Buddy</span><h1>

			<ul>
				<li>
					<a href="main.php">Home</a>
				</li>
				<li>
					<a href="#">Trip <i class="fas fa-caret-down"></i></a>
					<div class="dropdown_menu">
						<ul>
							<li><a class="active" href="mainTrip.php">Join Trip</a></li>
							<li><a href="createtrip.php">Create Trip</a></li>
							<li><a href="myTrip.php">My Trip</a></li>
							<li><a href="tripHistory.php">Trip History</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#">Report<i class="fas fa-caret-down"></i></a>
					<div class="dropdown_menu">
						<ul>
							<li><a href="../customer/paymentHistory.php">Payment History</a></li>
							<li><a href="../customer/report_most_spot.php">Most Visited Travel Spot</a></li>
						</ul>
					</div>
				</li>
                <li>
					<a href="suggest.php"  class="active">Submit Suggestion</a>
				</li>
				<li>
					<a href="#">My Profile <i class="fas fa-caret-down"></i></a>
					<div class="dropdown_menu">
						<ul>
							<li><a href="../customer/profile.php">Profile</a></li>
							<li><a href="../logout.php">Logout</a></li>
						</ul>
				</li>
			</ul>
		</div>

</body>
</html>

</body>
</html>