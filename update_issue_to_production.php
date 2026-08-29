<?php

    include ('session.php');
    include ('crud_conn_files/conn.php');

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Initialise variables
    $material_name = "";
    $itp_qty = "";
    $material_title = "";
    $id = $_GET['updateid'];
    $itp_status = $_POST['itp_status'];
    $errors = array();

    // Get the item name and quantity from issue to production
    $query_issue = mysqli_query($conn, "SELECT material_name, itp_qty FROM issue_to_production WHERE id='$id'");
    $issue = mysqli_fetch_assoc($query_issue);
    
    if ($issue) {
        $material_name = $issue['material_name'];   // Assign item name from issue_to_production
        $issued_qty = $issue['itp_qty'];

        // Fetch the available quantity from the ctg_itp_inventory table based on the item name
        $query_product = mysqli_query($conn, "SELECT avl_qty FROM ctg_itp_inventory WHERE material_title='$material_name'");
        $product = mysqli_fetch_assoc($query_product);

        if ($product) {
            $available_itp_qty = $product['avl_qty'];  // Get available quantity

            // Check if there is enough stock
            if ($available_itp_qty >= $issued_qty) {
                // Update the issue_to_production itp_status to 'Approved'   
                $query = mysqli_query($conn, "UPDATE issue_to_production SET itp_status='Approved' WHERE id='$id'");
                
                // Deduct the ordered quantity from the ctg_itp_inventory table
                $new_itp_qty = $available_itp_qty - $issued_qty;
                $query_update_product = mysqli_query($conn, "UPDATE ctg_itp_inventory SET avl_qty='$new_itp_qty' WHERE material_title='$material_name'");

                // Redirect or show a success message
                if ($query && $query_update_product) {
                    header('location: issue_to_production.php');
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        } else {
            // Handle case where product is not found in ctg_itp_inventory
            echo "Item not found in inventory.";
        }
    } else {
        // Handle case where order is not found
        echo "Item not found.";
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
    <title>CTG Limited: Update Issue</title>
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
        <h2>Update Issue Details</h2>
    </div>
    <form method="post">
        <?php
        include ('crud_conn_files/conn.php');
            $id = $_GET['updateid'];
            $query = mysqli_query($conn, "SELECT * FROM issue_to_production WHERE id='$id'");
            while ($row = mysqli_fetch_array($query)) {
        ?>


        <div class="input-group">
            <label>Department</label>
            <input type="department" value="<?php echo $row["department"]?>" name="department" readonly >
        </div>
        <div class="input-group">
            <label>Created By</label>
            <input type="text" value="<?php echo $row["created_by"]?>" name="created_by" readonly>
        </div>  
        </div>
        <div class="input-group">
            <label>Item</label>
            <input type="text" value="<?php echo $row["material_name"]?>" name="material_name" readonly>
        </div>  
        </div>
        <div class="input-group">
            <label>Unit</label>
            <input type="text" value="<?php echo $row["unit"]?>" name="unit" readonly>
        </div>  
        </div>
        <div class="input-group">
            <label>Quantity</label>
            <input type="text" value="<?php echo $row["itp_qty"]?>" name="itp_qty" readonly>
        </div>  

        <div class="input-group">

            <label for="approval" class="ap_by">Status: <?php echo $row['itp_status']?></label>
        
            <!-- Input field where 'Approved' will be set upon submission -->

            <?php

            // Only show the approve button if the itp_status is still 'Pending'
            if ($row['itp_status'] == 'Pending' && $_SESSION['role'] == 'Warehouse Manager') { ?>

                <!-- Hidden field to set itp_status to 'Approved' -->
                <input type="hidden" name="itp_status" value="Approved">
                <button type="submit" class="btn-itp" name="update_po">Approve</button>
                
            <?php }

            // Display error message if there's insufficient stock
            if (isset($available_itp_qty) && $available_itp_qty < $issued_qty) {
                echo "<div class='stock-error'>$material_name quantity is low. Only $available_itp_qty kg available.</div>";
            }

            ?>
            
            <a href="issue_to_production.php" value="back" class="btn-itp">Back</a>

        </div>

        <?php } ?>

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