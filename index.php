<?php 
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
	<title>CTG Limited: Home</title>
</head>
<body>
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

    <script src="js_scripts/script.js"></script>

	<h1>Commodity Trading Group Limited </h1>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])):?>
			<div class="error success" >
				<h2>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h2>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php if (isset($_SESSION['username'])) : ?>
			<p>Welcome to CTG Home <?php echo $_SESSION['username']; ?></p>
			<?php if ($_SESSION['role'] == 'Wholesaler') { ?>
				<div class="jump_link">See available <a href="#ctg_products">products here</a></div>
			<?php } ?>
		<?php endif ?>
	</div>

	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<div class="about_ctg"><img src="icons/4_ctg_logo.png" alt="Commodity Trading Group">

		<p>Welcome to Commodity Trading Group, a company rooted in a storied legacy that traces its beginnings back to the previous century. For over 50 years, the promoters of the Commodity Trading Group have been esteemed figures in the manufacturing industry. Our journey started with the inauguration of the Power Plant in Mandsaur, Northern India. We expanded our horizons to Africa subsequently in 2003, we ventured into international markets, particularly the Southern African region by beginning operations in Zambia. <br><br> As we stride confidently towards new milestones in retailing, branding, and FMCG, we remain committed to our social responsibility. <br><br></p> 
	</div>

	<h3 class="vis_mis_idx">Vision & Mission</h3>
	<h4>Growing, Sustaining, and Innovating for a Better Tomorrow!</h4>
	<h5>Our commitment to positive impact is clear, in communities and industries worldwide.</h5>

	<div class="vision_mission"><img src="images/mission-vision.jpg" alt="Vision & Mission"><br>
			<h4 class="v_m_title">Vision Statement:</h4><br>
	    <p>"Our vision at Commodity Trading Group is to be a global leader in driving positive change. We aspire to create a future where innovation, integrity, and sustainability are at the core of our endeavors. Through dynamic partnerships and forward-thinking strategies, we aim to leave a lasting impact on industries, society, and the environment, setting new standards for excellence and responsibility."</p><br>
	    <h4 class="v_m_title">Mission Statement:</h4><br>
	    <p>"At Commodity Trading Group, we are committed to fostering sustainable growth and innovation across diverse industries. Our mission is to deliver exceptional value to our stakeholders by cultivating responsible business practices, prioritising customer satisfaction, and contributing to the well-being of communities we serve."</p>
	</div>
<!-- All images used have the Creative Commons license -->
	<h5 id="ctg_products" class="prod_head">Commodity Trading Group Products</h5>
	<div  class="ctg_container">
    <div class="ctg_prod">
      <img src="images/ctg_bathing_soap.jpeg" alt="Bathing Soap">
      <div class="product-content">
      <h6>Bathing Soap - Laundry</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div>

    <div class="ctg_prod">
      <img src="images/ctg_candles.jpg" alt="Candles">
      <div class="product-content">
      <h6>Candles - Home Fragrances</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div> 
    <div class="ctg_prod">
      <img src="images/ctg_glycerine.jpg" alt="Glycerine">
      <div class="product-content">
      <h6>Glycerine - Cosmetics</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div> 
    <div class="ctg_prod">
      <img src="images/ctg_hand_sanitiser.jpg" alt="Hand Sanitiser">
      <div class="product-content">
      <h6>Hand Sanitiser - Bodycare</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div> 
    <div class="ctg_prod">
      <img src="images/ctg_skin_lotion.jpg" alt="Skin Lotion">
      <div class="product-content">
      <h6>Skin Lotion - Cosmetics</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div> 
    <div class="ctg_prod">
      <img src="images/ctg_vaseline.png" alt="Vaseline">
      <div class="product-content">
      <h6>Vaseline - Cosmetics</h6>
      <a href="products.php" class="ctg_prod_link">Click here for more info</a>
      </div>
    </div> 
 </div>
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