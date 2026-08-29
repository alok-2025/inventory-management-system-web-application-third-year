<?php 
	// variable declaration
	$prod_name = "";
	$prod_category = "";
	$prod_price = "";
	$qty = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db');

	// ADD PRODUCT
	if (isset($_POST['add_prod'])) {
		// receive all input values from the form
		$prod_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
		$prod_category = mysqli_real_escape_string($conn, $_POST['prod_category']);
		$prod_price = mysqli_real_escape_string($conn, $_POST['prod_price']);	
		$qty = mysqli_real_escape_string($conn, $_POST['qty']);

		$prod_name_check_query = "SELECT * FROM ctg_products WHERE prod_name='$prod_name' LIMIT 1";
	    $result = mysqli_query($conn, $prod_name_check_query);
	    $product = mysqli_fetch_assoc($result);

	    if ($product) { // if product exists
	        array_push($errors, "Product already exists");
	    }

		// form validation: ensure that the form is correctly filled
		if (empty($prod_name)) { array_push($errors, "Product Name is required"); }

		if (empty($prod_category)) { array_push($errors, "Category is required"); }

		if (empty($prod_price)) { array_push($errors, "Price is required"); }
		if (empty($qty)) { array_push($errors, "Quantity is required"); }

		// add product if there are no errors in the form
		if (count($errors) == 0) {
				$query = "INSERT INTO ctg_products (prod_name, prod_category, prod_price, qty)
					  VALUES('$prod_name', '$prod_category', '$prod_price', $qty)";
				mysqli_query($conn, $query);
				header('location: products.php');

		}

	}
	

?>