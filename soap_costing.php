<?php 
include('tbl_conn_files/soap_costing_conn.php'); 
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
	<link rel="stylesheet" type="text/css" href="styles/soap_costing_style.css">
	<!-- below script tags are used for downloading the table as an excel spreadsheet -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
	<title>CTG Limited: Production</title>

</head>
<body>
	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<h2>CTG Soap Costing</h2>
	<script>
    $(document).ready(function () {
        $("#btnExportXlsx").click(function () {
            let table = document.getElementsByTagName("table");
            console.log(table);
            debugger;
            TableToExcel.convert(table[0], {
                name: `CTG_Soap_Costing_Table.xlsx`,
                sheet: {
                    name: 'CTG_Soap_Costing_Table'
                }
            });
        });
    });
</script>
	<?php if ($_SESSION['role'] == 'Production Manager') { ?>
	<div class="ctg_links">
	<a href="add_soap_costing.php">Add Material Description</a>
	<button type="button" class="btn" id="btnExportXlsx">Export Table</button><br><br>
	<?php } ?>
	</div>
	<div class="table_wrapper">
	<table id="ctg_soap_costing" border="1">
	<thead>
		<tr>
		<th>Material</th>
		<th>UoM</th>
		<th>%</th>
		<th>1000 Kg Batch Qty</th>
		<th>Price Per Kg in ZMW</th>
		<th>Price in ZMW Per Mt</th>
		<?php if ($_SESSION['role'] == 'Production Manager') { ?>
		<th colspan="2">Actions</th>
		<?php } ?>
		
	</tr>
	</thead>
	<tbody>
		<?php
		$num = "1000";
		$num2 = "100";
		$query = "SELECT * FROM soap_costing";
		$result = mysqli_query($conn, $query);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
		?>
			<tr>
				<td><?php echo $row['material']; ?></td>
				<td><?php echo $row['uom']; ?></td>
				<td><?php echo $row['percent']; ?></td>
				<td><?php echo round($row['percent'] *  intval($num) / intval($num2),1); ?></td>
				<td><?php echo $row['price_per_kg']; ?></td>
				<td><?php echo round($row['percent'] *  intval($num) / intval($num2) * $row['price_per_kg'],2);  ?></td>
				<?php if ($_SESSION['role'] == 'Production Manager') { ?>
					<td><a href="update_soap_costing.php?updateid=<?php echo $row['id']; ?>">Edit</a></td>
					<td><a href="delete_soap_costing.php?id=<?php echo $row['id']; ?>">Remove</a></td>
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
				$result = mysqli_query($conn, "SELECT count(*) FROM soap_costing");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo "Total Materials: " . $rows['count(*)']; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * summation field
				$result = mysqli_query($conn, "SELECT sum(percent) FROM soap_costing");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo $rows['sum(percent)'] . "%"; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * calculated field
				$result = mysqli_query($conn, "SELECT sum(percent) FROM soap_costing");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo $rows['sum(percent)'] * intval($num) / intval($num2)  . " Kg"; ?> 
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * calculated field
				$result = mysqli_query($conn, "SELECT sum(price_per_kg) FROM soap_costing");
				while ($rows = mysqli_fetch_array($result)){?>
				<?php echo $rows['sum(price_per_kg)'] . " ZMW"; ?>
				<?php
				}
				?>
			</td>
			<td>
				<?php 
				// * calculated field
				$g_total = "SELECT * from soap_costing";
				$total_result = mysqli_query($conn,$g_total);
				$sumTotal = 0;

				while($row = mysqli_fetch_array($total_result)) {
					$percent2 = $row['percent'] * intval($num) / intval($num2);
					$price_per_kg2 = $row['price_per_kg'];

					// the below code sums the column values from 'percent' column and 'price per kg', multiplies it by 
				    $total = $percent2 * $price_per_kg2;

				    // the below code sums the multiplied column values 'percent', 'price per kg' multiplied by $num divided by $num2 and rounds it to 2 decimal places
				    $sumTotal = round($sumTotal + $total,2);

				    // echo " <p> Total $total </p>";
				    // echo " <p> Running total: $sumTotal </p>";
					}
					// echo "Grand Total $sumTotal";
					echo "$sumTotal" . " ZMW";
				?>
			</td>
			<?php if ($_SESSION['role'] == 'Production Manager') { ?>
			<td colspan="2">Actions</td>
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

</body>
</html>