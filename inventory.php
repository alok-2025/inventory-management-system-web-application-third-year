<?php 
include('tbl_conn_files/inventory_conn.php'); 
include('session.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/inventory_style.css">
	
	<!-- below script tags are used for downloading the table as an excel spreadsheet -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<title>CTG Limited: Inventory</title>

</head>


<body>
	
	
	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<h2>CTG Materials</h2>
	<script>
    $(document).ready(function () {
        $("#btnExportXlsx").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: `CTG_Inventory_Table.xlsx`,
                sheet: {
                    name: 'CTG_Inventory_Table'
                }
            });
        });
    });
</script>
	<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
	<div class="ctg_links">
	<a href="add_inven_material.php">Add Material</a>
	<button type="button" class="btn" id="btnExportXlsx">Export Table</button><br><br>
	<?php } ?>
	</div>
	<div class="table_wrapper">
	<table id="ctg_inventory" border="1">
	<thead>
		<tr>
		<th>Material #</th>
		<th>Name</th>
		<th>UoM</th>
		<th>Quantity</th>
		<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
		<th>Action</th>
		<?php } ?>
	</tr>
	</thead>
	<tbody>
		
		<?php
		$query = "SELECT * FROM ctg_itp_inventory";
		$result = mysqli_query($conn, $query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?php echo $row['material_no']; ?></td>
				<td><?php echo $row['material_title']; ?></td>
				<td><?php echo $row['unit']; ?></td>
				<td><?php echo $row['avl_qty']; ?></td>
				<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
					<td><a href="update_inven_material.php?updateid=<?php echo $row['id']; ?>">Edit</a></td>
				<?php } ?>
			</tr>
		<?php	}
			}
		?>

	</tbody>

	<tfoot>
		<tr>
			<td colspan="2">
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT count(*) FROM ctg_itp_inventory");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo "Total Materials: " . $rows['count(*)']; ?> 
				<?php
				}
				?>
			</td>
			<td colspan="3">
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT sum(avl_qty) FROM ctg_itp_inventory");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo "Total Qty: " . $rows['sum(avl_qty)']; ?> 
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