<?php
    include ('crud_conn_files/conn.php');
    include ('session.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_GET['updateid'];
        $material_title = $_POST['material_title'];
        $unit = $_POST['unit'];
        $avl_qty = $_POST['avl_qty'];
        $query = mysqli_query($conn, "UPDATE ctg_itp_inventory SET material_title='$material_title', unit='$unit', avl_qty='$avl_qty' WHERE id='$id'");
        if($query){
            header('location: inventory.php');
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>CTG Limited: Edit Material Info</title>
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
        <h2>Edit Material Details</h2>
    </div>
    <form method="post">
        <?php
        include ('crud_conn_files/conn.php');
            $id = $_GET['updateid'];
            $query = mysqli_query($conn, "SELECT * FROM ctg_itp_inventory WHERE id='$id'");
            while ($row = mysqli_fetch_array($query)) {
        ?>
                        
        <div class="input-group">
            <label>Material</label>
            <input type="text" value="<?php echo $row["material_title"]?>" name="material_title">
        </div>
        <div class="input-group">
            <label>UoM</label>
            <input type="text" value="<?php echo $row["unit"]?>" name="unit">
        </div>
        <div class="input-group">
            <label>Quantity</label>
            <input type="text" value="<?php echo $row["avl_qty"]?>" name="avl_qty">
        </div>

        <?php } ?>
        <div class="input-group">
            <p>
            <button type="submit" class="btn" name="update_material">Update</button>  
            <a href="inventory.php" value="back"class="btn">Back</a>
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