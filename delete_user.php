<?php 
include ('session.php'); 
?>
<!-- process delete operation after confirmation -->

<?php
// Include delete_user_conn file
require_once "crud_conn_files/delete_user_conn.php";

// Initialise the fullname variable
$fullname = '';

// If the delete confirmation form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Set parameters
    $param_id = trim($_POST["id"]);
    
    // Fetch the fullname using the function from the connection file
    $fullname = getFullnameById($conn, $param_id);
    
    // Prepare a delete statement
    $query = "DELETE FROM ctg_users WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: users.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error_page.html");
        exit();
    } else {
        // If coming from GET request, fetch the fullname to display in the confirmation
        $param_id = trim($_GET["id"]);
        $fullname = getFullnameById($conn, $param_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CTG Limited: Delete User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" type="text/css" href="styles/delete_style.css">

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
    <div class="del_user">CTG Users </div>
    <div class="header">
        <h2>User deletion confirmation</h2>
    </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="del_warning"><img src="icons/warning.png" alt="Warning">

                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>

                <p>Do you you want to delete user: <?php echo htmlspecialchars($fullname); ?>?</p><br>

                    <button type="submit" value="yes" class="btn">Yes</button>
                    
                    <a href="users.php" value="no"class="btn">No</a>
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