<?php
	include "../connect.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Theme</title>

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/vendors/@fortawesome/fontawesome-free/css/all.min.css">
	<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">-->
	<link rel="stylesheet" type="text/css" href="mainTheme.css">

</head>

<body>
	<?php include("nav/nav_home.php")?>

    <div class = "title"><h1>Theme</h1></div>

    <section class="theme">

    <?php
		$sql = "SELECT * FROM theme";
		$theme = mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while ($row = mysqli_fetch_assoc($theme)) {
	?>

				<div class="card">
					<div class="image">

						<?php 
							echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
						?>
	
					</div>

					<div class="caption">
						<h2 class="theme_name">
							<?php 
							echo $row["themeName"];			
							?>	
						</h2>
					</div>
					<form action="mainThemeInfo.php" method="post">
						<input type="hidden" name="themeID" value="<?php echo $row["themeID"]; ?>">
						
						<button class="more" type="submit">Read More</button>
					</form>
				</div>
			<?php
			}
			?>       

    </section>

    <div id="back"><a href="main.php#">Back</a></div>
