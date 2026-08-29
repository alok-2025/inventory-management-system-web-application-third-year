<?php 
include('tbl_conn_files/products_conn.php'); 
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
	<link rel="stylesheet" type="text/css" href="styles/products_style.css">
	<!-- below script tags are used for downloading the table as an excel spreadsheet -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<title>CTG Limited: Products</title>

</head>
<body>
	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<h2>CTG Products</h2>
	<script>
    $(document).ready(function () {
        $("#btnExportXlsx").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: `CTG_Products_Table.xlsx`,
                sheet: {
                    name: 'CTG_Products_Table'
                }
            });
        });
    });
</script>
	<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
	<div class="ctg_links">
	<a href="add_product.php">Add Product</a>
	<button type="button" class="btn" id="btnExportXlsx">Export Table</button><br><br>
	<?php } ?>
	</div>
	<div class="table_wrapper">
	<table id="ctg_products" border="1">
	<thead>
		<tr>
		<th>Stock Keeping Unit</th>
		<th>Product</th>
		<th>Category</th>
		<th>Price</th>
		<th>Kg</th>
		<th>Total Price</th>
		<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
		<th colspan="2">Actions</th>
		<?php } ?>
		
	</tr>
	</thead>
	<tbody>
		<?php
		$query = "SELECT * FROM ctg_products";
		$result = mysqli_query($conn, $query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?php echo $row['sku']; ?></td>
				<td><?php echo $row['prod_name']; ?></td>
				<td><?php echo $row['prod_category']; ?></td>
				<td><?php echo $row['prod_price']; ?></td>
				<td><?php echo $row['qty']; ?></td>
				<td><?php echo $row['prod_price'] * $row['qty']; ?></td>
				<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
					<td><a href="update_product.php?updateid=<?php echo $row['id']; ?>">Edit</a></td>
				<?php } ?>
			</tr>
		<?php	}
			}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3">
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT count(*) FROM ctg_products");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo "Total Products: " . $rows['count(*)']; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT sum(prod_price) FROM ctg_products");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo $rows['sum(prod_price)'] . " ZMW"; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT sum(qty) FROM ctg_products");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo $rows['sum(qty)']; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * calculated field
				$g_total = "SELECT * from ctg_products";
				$total_result = mysqli_query($conn,$g_total);
				$sumTotal = 0;

				while($row = mysqli_fetch_array($total_result)) {
					$total_p = $row['prod_price'] * $row['qty'] ;

				    // the below code sums the multiplied column values 'percent', 'price per kg' multiplied by $num divided by $num2 and rounds it to 2 decimal places
				    $sumTotal = $sumTotal + $total_p;
					}
					// echo "Grand Total $sumTotal";
					echo "$sumTotal" . " ZMW";
				?>
			</td>
			<?php if ($_SESSION['role'] == 'Warehouse Manager') { ?>
			<td colspan="5">Actions</td>
			<?php } ?>
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
	<script>

		// js hamburger menu code below

		var navLinks = document.getElementById("side-nav-links");
		function showMenu(){
		navLinks.style.left = "0";
		}
		function hideMenu(){
		navLinks.style.left = "-250px";
		}

	  // js set active class on the current link code below

		window.onload = function() {
		  var navLinks = document.querySelectorAll('.links ul li a'); // Get all links
		  var currentUrl = window.location.href; // Get the current URL
		  
		  navLinks.forEach(function(link) {
		    // If the link's href is in the current URL, add the 'active' class
		    if (currentUrl.includes(link.href)) {
		      link.classList.add('active');
		    }
		  });
		};

	</script>
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