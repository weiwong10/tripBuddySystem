<?php
session_start();
include "../connect.php";

	if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role']))
	{
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);
		$role = test_input($_POST['role']);

		if(empty($username)){
			header("Location: login.php?error=Username is Required");
		}
		elseif (empty($password)) 
		{
			header("Location: login.php?error=Password is Required");
		}
		elseif($role !='admin' && $role !='user')
		{
			header("Location: login.php?error=User Role is Required");
		}
		else
		{
			switch ($role) {
				case 'admin':
					$sql = "SELECT * FROM admin WHERE admin_username = '".$username."' AND password = '".$password."'";

					$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

					if(mysqli_num_rows($result) > 0)
					{

						$row = mysqli_fetch_assoc($result);
						if($row['admin_username'] === $username && $row['password'] === $password)
						{				
							//To store the data into the session[admin_username] for future use
							$_SESSION['admin_username'] = $row['admin_username'];

							//To go for the customer login page
							header("Location: ../admin/admin_login.php");							
						}
					}
					else
					{
						header("Location: login.php?error=Incorrect Username and Password");
					}
					break;

				case 'user':
					$sql = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";

					$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

					if(mysqli_num_rows($result) > 0)
					{

						$row = mysqli_fetch_assoc($result);
						if($row['username'] === $username && $row['password'] === $password)
						{
							
							if($row['status_acc'] == 'Active' ){
							
								//To store the data into the session[admin_username] for future use
								$_SESSION['username'] = $row['username'];

								//To go for the customer login page
								header("Location: ../main/main.php");
							}
							else{
								header("Location: login.php?error=Your Account has been banned");
							}
						}
					}
					else
					{
						header("Location: login.php?error=Incorrect Username and Password");
					}

					break;
			}

		}
	}
	else
	{
		header("Location: login.php");
	}
