<?php 
	// variable declaration
	$material = "";
	$uom = "";
	$percent = "";
	$price_per_kg = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db'); 

	// ADD MATERIAL
	if (isset($_POST['add_material_description'])) {
		// receive all input values from the form
		$material = mysqli_real_escape_string($conn, $_POST['material']);
		$uom = mysqli_real_escape_string($conn, $_POST['uom']);
		$percent = mysqli_real_escape_string($conn, $_POST['percent']);	
		$price_per_kg = mysqli_real_escape_string($conn, $_POST['price_per_kg']);

		$material_check_query = "SELECT * FROM soap_costing WHERE material='$material' LIMIT 1";
	    $result = mysqli_query($conn, $material_check_query);
	    $added_material = mysqli_fetch_assoc($result);

	    if ($added_material) { // if material exists
	        array_push($errors, "Material already exists");
	    }

		// form validation: ensure that the form is correctly filled
		if (empty($material)) { array_push($errors, "Material Name is required"); }

		if (empty($uom)) { array_push($errors, "UoM is required"); }

		if (empty($percent)) { array_push($errors, "% is required"); }
		if (empty($price_per_kg)) { array_push($errors, "Price is required"); }

		// add user if there are no errors in the form
		if (count($errors) == 0) {
				$query = "INSERT INTO soap_costing (material, uom, percent, price_per_kg)
					  VALUES('$material', '$uom', '$percent', $price_per_kg)";
				mysqli_query($conn, $query);
				header('location: soap_costing.php');

		}

	}
	

?>