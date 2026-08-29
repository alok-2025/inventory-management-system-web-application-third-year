<?php 
	session_start();
	// variable declaration
	$username = "";
	$role = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db'); // this line of code is edited by ....

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$role = mysqli_real_escape_string($conn, $_POST['role']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		if (empty($role)) {
			array_push($errors, "User Role is required");
		}

		if (count($errors) == 0) {
			$password = sha1($password);
			$query = "SELECT * FROM ctg_users WHERE username='$username' AND password='$password' AND role='$role'";
			$results = mysqli_query($conn, $query);

			if (mysqli_num_rows($results) === 1) {
				// username has to be unique
				$row = mysqli_fetch_assoc($results);
				if ($row['password'] === $password && $row['role'] == $role) {
				$_SESSION['username'] = $row['username'];
				$_SESSION['role'] = $row['role'];
				header('location: index.php');
				}
				
			}else {
				array_push($errors, "Incorrect Role or Wrong Username/Password combination");
			}
			
		}
	}
?>