<?php 
include('crud_conn_files/add_issue_to_production_conn.php');
include ('session.php');
?> 


<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/search_material.css">
	<title>CTG Limited: Add Issue</title>
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
	<div class="header">
		<h2>Add Issue</h2>
	</div>
	<form method="post" action="add_issue_to_production.php">

			<?php include('errors.php'); ?>

		<div class="input-group">
	  <select class="opt" name="department" value="<?php echo $department; ?>">
	  	<option value="0">Department</option>
	    <option value="Cosmetics">Cosmetics</option>
	    <option value="Laundry">Laundry</option>
	    <option value="Home Fragrances">Home Fragrances</option>
	    <option value="Bodycare">Bodycare</option>
	  </select>
	  </div>
		<div class="input-group">
			<label>Created By</label>
			<input type="text" name="created_by" value="<?php echo $created_by; ?>">
		</div>
		<!-- search material php code -->
      <div class="material-input">
      	<label>Item</label><br>
        <input type="text" name="material_name" autocomplete="off" value="<?php echo $material_name; ?>">
        <div class="autocom-box">
          <!-- the list is inserted here from the materials.js file -->
        </div>
        <div class="dropdown"></i></div>
      </div>

    <script src="js_scripts/materials.js"></script>
    <script src="js_scripts/script.js"></script>

		<div class="input-group">
			<select class="opt" name="unit" value="<?php echo $unit; ?>">
				<option value="0">Unit</option>
		    <option value="Kg">Kg</option>
		    <option value="Pcs">Pcs</option>
	  	</select>
	  </div>
		<div class="input-group">
			<label>Quantity</label>
			<input type="text" name="itp_qty" value="<?php echo $itp_qty; ?>">
		</div>
		
		<div class="input-group">
			<p>
			<button type="submit" class="btn" name="add_issue">Add</button>	
			<button type="reset" class="btn" value="reset">Clear</button>
			<a href="issue_to_production.php" value="back"class="btn">Back</a>
			</p>
		</div>
	</form>
	<div class="footer">
	    <p>CTG Limited</p>  
	    <p>Copyright&nbsp;&copy; 2024</p>         
	    <p>All Rights Reserved</p>
    </div>

    <div class="footer-box">
    <ul class="footer-social">
      <li><a href="http://facebook.com"><img src="icons/facebook-icon.png" alt="Facebook"></a></li>
      <li><a href="https://whatsapp.com/"><img src="icons/whatsapp-icon.png" alt="WhatsApp"></a></li>
      <li><a href="http://instagram.com"><img src="icons/instagram-icon.png" alt="Instagram"></a></li>
      <li><a href="https://telegram.org/"><img src="icons/telegram-icon.png" alt="Telegram"></a></li>
    </ul>    
  	</div>
</body>
</html>