<?php 
include('crud_conn_files/add_product_conn.php');
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
	<!-- link that allows the download of the shown table -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<title>CTG Limited: Add Product</title>
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
		<h2>Add Product</h2>
	</div>
	<form method="post" action="add_product.php">

			<?php include('errors.php'); ?>
	  
		<div class="input-group">
			<label>Product</label>
			<input type="text" name="prod_name" value="<?php echo $prod_name; ?>">
		</div>
	
		<div class="input-group">
			<label>Category</label>
			<input type="text" name="prod_category" value="<?php echo $prod_category; ?>">
		</div>

		<div class="input-group">
			<label>Price</label>
			<input type="number" min="" value="" step="0.01" name="prod_price" value="<?php echo $prod_price; ?>">
		</div>

		<div class="input-group">
			<label>Quantity</label>
			<input type="number" name="qty" value="<?php echo $qty; ?>">
		</div>
		
		<div class="input-group">
			<p>
			<button type="submit" class="btn" name="add_prod">Add</button>	
			<button type="reset" class="btn" value="reset">Clear</button>
			<a href="products.php" value="back"class="btn">Back</a>
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