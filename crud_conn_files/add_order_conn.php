<?php 
	// variable declaration
	$customer_name = "";
	$company_name = "";
	$street_address = "";
	$city_name = "";
	$contact_no = "";
	$email = "";
	$item_name = "";
	$quantity_kg = "";
	$unit_price = "";
	$sum_price = "";
	$errors = array(); 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'ctg_inven_db'); 

	// ADD ORDER
	if (isset($_POST['add_order'])) {
		// receive all input values from the form
		$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
		$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
		$street_address = mysqli_real_escape_string($conn, $_POST['street_address']);	
		$city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
		$contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
		$quantity_kg = mysqli_real_escape_string($conn, $_POST['quantity_kg']);
		$unit_price = mysqli_real_escape_string($conn, $_POST['unit_price']);
		$sum_price = mysqli_real_escape_string($conn, $_POST['sum_price']);

		// form validation: ensure that the form is correctly filled
		if (empty($customer_name)) { array_push($errors, "Customer Name is blank"); }

		if (empty($company_name)) { array_push($errors, "Company Name is blank"); }

		if (empty($street_address)) { array_push($errors, "Address is blank"); }

		if (empty($city_name)) { array_push($errors, "City is blank"); }

		if (empty($contact_no)) { array_push($errors, "Contact is blank"); }

		if (empty($email)) { array_push($errors, "Email is blank"); }

		if (empty($item_name)) { array_push($errors, "Item is blank"); }

		if (empty($quantity_kg)) { array_push($errors, "Quantity is blank"); }

		// add product if there are no errors in the form
		if (count($errors) == 0) {
				$query = "INSERT INTO ctg_purchase_orders (customer_name, company_name, street_address, city_name, contact_no, email, item_name, quantity_kg, unit_price, sum_price)
					  VALUES('$customer_name', '$company_name', '$street_address', '$city_name', '$contact_no', '$email', '$item_name', '$quantity_kg', '$unit_price', '$sum_price')";
				mysqli_query($conn, $query);
				header('location: orders.php');
		}

	}
	

?>