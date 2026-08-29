<?php 
	// variable declaration
	$material_title = "";
	$unit = "";
	$avl_qty = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db');

	// ADD PRODUCT
	if (isset($_POST['add_inven'])) {
		// receive all input values from the form
		$material_title = mysqli_real_escape_string($conn, $_POST['material_title']);
		$unit = mysqli_real_escape_string($conn, $_POST['unit']);
		$avl_qty = mysqli_real_escape_string($conn, $_POST['avl_qty']);

		// Check if the material already exists in the database
	    $material_check_query = "SELECT * FROM ctg_itp_inventory WHERE material_title='$material_title' LIMIT 1";
	    $result = mysqli_query($conn, $material_check_query);
	    $material = mysqli_fetch_assoc($result);

	    if ($material) { // if material already exists
	        array_push($errors, "Material already exists");
	    }

		// form validation: ensure that the form is correctly filled
		if (empty($material_title)) { array_push($errors, "Material Name is required"); }

		if (empty($unit)) { array_push($errors, "Category is required"); }

		if (empty($avl_qty)) { array_push($errors, "Quantity is required"); }

		// add product if there are no errors in the form
		if (count($errors) == 0) {
				$query = "INSERT INTO ctg_itp_inventory (material_title, unit, avl_qty)
					  VALUES('$material_title', '$unit', $avl_qty)";
				mysqli_query($conn, $query);
				header('location: inventory.php');

		}

	}
	

?>