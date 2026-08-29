<?php 
include('crud_conn_files/add_order_conn.php');
include ('session.php');
?> 


<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="styles/add_order_style.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<!-- link that allows the download of the shown table -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<title>CTG Limited: Add Purchase Order</title>
</head>
<body>

	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>

	<nav>
      <div class="links" id="side-nav-links">
        <img src="icons/s-menu.png" class="sideicon-1" onclick="hideMenu()" alt="Side-Icon-1">
        <ul>

        	<li><p><?php echo $_SESSION['username']; ?></p></li>
        	<li><a href="index.php?logout='1'">Logout</a></li>
          <?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Production Manager' or $_SESSION['role'] == 'Warehouse Manager') { ?>
          <li><a href="users.php">Users</a></li>
          <?php } ?>

          <li><a href="index.php">Home</a></li>
          <?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Warehouse Manager') { ?>
          <li><a href="inventory.php">Inventory</a></li>
          <?php } ?>
          
          <?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Production Manager' or $_SESSION['role'] == 'Warehouse Manager') { ?>
          <li><a href="issue_to_production.php">Production</a></li>
          <?php } ?>
          <?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Production Manager') { ?>
          <li><a href="soap_costing.php">Soap Costing</a></li>
          <?php } ?>
          <?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Warehouse Manager') { ?>
          <li><a href="products.php">Stock</a></li>
        	<?php } ?>
        	<?php if ($_SESSION['role'] == 'System Administrator' or $_SESSION['role'] == 'Warehouse Manager' or $_SESSION['role'] == 'Wholesaler') { ?>
          <li><a href="orders.php">Orders</a></li>
          <?php } ?>
        </ul>
      </div>
      <img src="icons/s-menu.png" class="sideicon-2" onclick="showMenu()" alt="Side-Icon-2">
    </nav>
	<script>
      var navLinks = document.getElementById("side-nav-links");
      function showMenu(){
        navLinks.style.left = "0";
      }
      function hideMenu(){
        navLinks.style.left = "-250px";
      }
    </script>
	<div class="po_header">
		<h2>Create Purchase Order </h2>
		
	</div>
	<form method="post" class="p_order" action="add_order.php">

		<?php include('errors.php'); ?>
	  
		<div class="input-po">
			<label>Customer Name</label>
			<input type="text" class="in-po" name="customer_name" value="<?php echo $customer_name; ?>">
		</div>
	
		<div class="input-po">
			<label>Company Name</label>
			<input type="text" name="company_name" value="<?php echo $company_name; ?>">
		</div>

		<div class="input-po">
			<label>Street Address</label>
			<input type="text" name="street_address" value="<?php echo $street_address; ?>">
		</div>

		<div class="input-po">
			<label>City</label>
			<input type="text" name="city_name" value="<?php echo $city_name; ?>">
		</div>

		<div class="input-po">
			<label>Contact No</label>
			<input type="tel" name="contact_no" min="" max="13" value="<?php echo $contact_no; ?>">
		</div>

		<div class="input-po">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>

		<table id="ctg_po" border="1">
			<thead>
				<tr>
				<th>Item</th>
				<th>Qty (Kg)</th>
				<th>ZMW Unit Price</th>
				<th>ZMW Total Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<select id="product-select" name="item_name">
					  <option value="0">Select Item</option>
					 		<option value="Skin Lotion">Skin Lotion</option>
							<option value="Bathing Soap">Bathing Soap</option>
							<option value="Vaseline">Vaseline</option>
							<option value="Glycerine">Glycerine</option>
							<option value="Candles">Candles</option>
							<option value="Hand Sanitiser">Hand Sanitiser</option>
					</td>
					<td>
						<input type="number" id="quantity" class="input-kg" name="quantity_kg" step="1" min="10" max="900" value="<?php echo $quantity_kg; ?>" >
					</td>
					<td>
						<input type="number" id="price-result" name="unit_price" value="<?php echo $unit_price; ?>" readonly>
					</td>
					<td><input type="number" id="total-price" name="sum_price" value="<?php echo $sum_price; ?>" readonly></td>					
				</tr>
				<script src="js_scripts/price_calculation.js"></script>

			</tbody>

		</table>
		<div class="input-po">
			<p>
			<button type="on" class="btn-po" name="add_order">Create</button>	
			<button type="reset" class="btn-po" value="reset">Clear</button>
			<a href="orders.php" value="back"class="btn-po">Back</a>
			</p>
		</div>
	</form>
</body>
</html>