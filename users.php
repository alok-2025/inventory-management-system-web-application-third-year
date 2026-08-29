<?php 
include('tbl_conn_files/users_conn.php'); 
include ('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="styles/users_style.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<!-- below script tags are used for downloading the table as an excel spreadsheet -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<title>CTG Limited: Users</title>
</head>
<body>
	
	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<h2>CTG Users </h2>
	<script>
    $(document).ready(function () {
        $("#btnExportXlsx").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: `CTG_Users_Table.xlsx`,
                sheet: {
                    name: 'CTG_Users_Table'
                }
            });
        });
    });
	</script>
	<div class="ctg_links">
		<?php if ($_SESSION['role'] == 'System Administrator') { ?>
		<a href="add_user.php">Add User</a>
		<button type="button" class="btn" id="btnExportXlsx">Export Table</button><br><br>
		<?php } ?>
	</div>
	<div class="table_wrapper">
	<table id="ctg_users_table" border="1">
	<thead>
		<tr>
		<th>#</th>
		<th>Fullname</th>
		<th>Email Address</th>
		<th>Username</th>
		<th>Role</th>
		<?php if ($_SESSION['role'] == 'System Administrator') { ?>
		<th colspan="2">Actions</th>
		<?php } ?>
	</tr>
	</thead>
	<tbody>
        <?php
        $query = "SELECT * FROM ctg_users";
        $result = mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['role']; ?></td>
                
                <?php if ($_SESSION['role'] == 'System Administrator') { ?>
                    <td><a href="update_user.php?updateid=<?php echo $row['id']; ?>">Update</a></td>
                    
                    <!-- Show Delete link only if the user's role is NOT 'System Administrator' -->
                    <?php if ($row['role'] != 'System Administrator') { ?>
                        <td><a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
                    
                <?php } ?>
            </tr>
        <?php
            }
        }
        ?>
    </tbody>
	<tfoot>
		<tr>
			<td colspan="7">
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT count(*) FROM ctg_users");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo "Total Users: " . $rows['count(*)']; ?> 
				<?php
				}
				?>
			</td>
		</tr>
	</tfoot>
	</table>
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
    
    <script src="js_scripts/script.js"></script>

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