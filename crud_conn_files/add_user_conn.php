<?php 
	// variable declaration
	$fullname = "";
	$email = "";
	$username = "";
	$role = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db'); 
	// ADD USER
	if (isset($_POST['add_user'])) {
		// receive all input values from the form
		$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);		
		$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
		$role = mysqli_real_escape_string($conn, $_POST['role']);

		$user_check_query = "SELECT * FROM ctg_users WHERE username='$username' OR email='$email' LIMIT 1";
	    $result = mysqli_query($conn, $user_check_query);
	    $user = mysqli_fetch_assoc($result);

	    if ($user) { // if user exists
	        if ($user['username'] === $username) {
	            array_push($errors, "Username already exists");
	        }
	        if ($user['email'] === $email) {
	            array_push($errors, "Email address already exists");
	        }
	    }

	    // Hash the password to compare with the stored hashed passwords
	    $hashed_password = sha1($password_1);

	    // Check if the hashed password already exists in the database
	    $password_check_query = "SELECT * FROM ctg_users WHERE password='$hashed_password' LIMIT 1";
	    $password_result = mysqli_query($conn, $password_check_query);
	    $password_row = mysqli_fetch_assoc($password_result);

	    if ($password_row) { // if password exists
	        array_push($errors, "Password already exists");
	    }

		// form validation: ensure that the form is correctly filled
		if (empty($fullname)) { array_push($errors, "Full Name is required"); }

		if (empty($email)) { array_push($errors, "Email Address is required"); }

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		if (empty($role)) { array_push($errors, "User Role is required"); }

		// add user if there are no errors in the form
		if (count($errors) == 0) {
			$password = sha1($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO ctg_users (fullname, email, username,  password, role) 
					  VALUES('$fullname', '$email', '$username', '$password', '$role')";
			mysqli_query($conn, $query);
			header('location: users.php');
		}

	}
	

?>