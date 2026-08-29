<?php 
	// variable declaration
	$department = "";
	$created_by = "";
	$material_name = "";
	$unit = "";
	$itp_qty = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db');

	// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

	// ADD ISSUE
	if (isset($_POST['add_issue'])) {

		// receive all input values from the form

		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$created_by = mysqli_real_escape_string($conn, $_POST['created_by']);
		$material_name = mysqli_real_escape_string($conn, $_POST['material_name']);
		$unit = mysqli_real_escape_string($conn, $_POST['unit']);
		$itp_qty = mysqli_real_escape_string($conn, $_POST['itp_qty']);

		// form validation: ensure that the form is correctly filled

		if (empty($department)) { array_push($errors, "Department is required"); }

		if (empty($created_by)) { array_push($errors, "Created By is required"); }

		if (empty($material_name)) { array_push($errors, "Material is required"); }

		if (empty($unit)) { array_push($errors, "Unit is required"); }

		if (empty($itp_qty)) { array_push($errors, "Quantity is required"); }

		// add issue if there are no errors in the form
		if (count($errors) == 0) {
            $query = "INSERT INTO issue_to_production (department, created_by, material_name, unit, itp_qty) 
                      VALUES('$department', '$created_by', '$material_name', '$unit', '$itp_qty')";
            
            // Debugging - print the query
            echo $query;

            // Execute query and check for errors
            if (mysqli_query($conn, $query)) {
                header('location: issue_to_production.php');
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }

	}
	

?>