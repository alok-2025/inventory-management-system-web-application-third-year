<?php 
include('crud_conn_files/add_soap_costing_conn.php');
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
	<!-- link that allows the download of the shown table -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<title>CTG Limited: Add to Soap Costing</title>
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
		<h2>Add Material</h2>
	</div>
	<form method="post" action="add_soap_costing.php">

			<?php include('errors.php'); ?>

			<!-- search material php code -->
      <div class="material-input">
      	<label>Material</label><br>
        <input type="material" name="material" autocomplete="off" value="<?php echo $material; ?>">
        <div class="autocom-box">
          <!-- the list is inserted here from the materials.js file -->
        </div>
        <div class="dropdown"></i></div>
      </div>

    <script src="js_scripts/materials.js"></script>
    <script src="js_scripts/script.js"></script>

		<div class="input-group">
			<label>UoM</label>
			<select class="opt" name="uom">
		    <option value="Kg">Kg</option>
		    <option value="Pcs">Pcs</option>
	  	</select>
	  </div>
	  
		<div class="input-group">
			<label>%</label>
			<input type="number" min="" value="" step="0.01" name="percent" value="<?php echo $percent; ?>">
		</div>
	
		<div class="input-group">
			<label>Price Per Kg</label>
			<input type="number" min="" value="" step="0.01" name="price_per_kg" value="<?php echo $price_per_kg_in_dollar; ?>">
		</div>
		
		<div class="input-group">
			<p>
			<button type="submit" class="btn" name="add_material_description">Add</button>	
			<button type="reset" class="btn" value="reset">Clear</button>
			<a href="soap_costing.php" value="back"class="btn">Back</a>
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