<?php
    include ("tbl_conn_files/orders_conn.php"); 
    include("session.php"); 

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Initialise variables
    $item_name = "";
    $quantity_kg = "";
    $prod_name = "";
    $id = $_GET['viewid'];
    $status = $_POST['status'];
    $errors = array();

    // Get the product name and quantity from the purchase order form
    $query_order = mysqli_query($conn, "SELECT item_name, quantity_kg FROM ctg_purchase_orders WHERE id='$id'");
    $order = mysqli_fetch_assoc($query_order);
    
    if ($order) {
        $item_name = $order['item_name'];   // Assign product name from purchase order
        $ordered_qty = $order['quantity_kg'];

        // Fetch the available quantity from the ctg_products table based on the product name
        $query_product = mysqli_query($conn, "SELECT qty FROM ctg_products WHERE prod_name='$item_name'");
        $product = mysqli_fetch_assoc($query_product);

        if ($product) {
            $available_qty = $product['qty'];  // Get available quantity

            // Check if there is enough stock
            if ($available_qty >= $ordered_qty) {
                // Update the purchase order status to 'Approved'   
                $query = mysqli_query($conn, "UPDATE ctg_purchase_orders SET status='Approved' WHERE id='$id'");
                
                // Deduct the ordered quantity from the ctg_products table
                $new_qty = $available_qty - $ordered_qty;
                $query_update_product = mysqli_query($conn, "UPDATE ctg_products SET qty='$new_qty' WHERE prod_name='$item_name'");

                // Redirect or show a success message
                if ($query && $query_update_product) {
                    header('location: orders.php');
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        } else {
            // Handle case where product is not found in ctg_products
            echo "Product not found in inventory.";
        }
    } else {
        // Handle case where order is not found
        echo "Order not found.";
    }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/purchase_order_form_style.css">
	<title>CTG Purchase Order Form</title>
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
    <script>
      var navLinks = document.getElementById("side-nav-links");
      function showMenu(){
        navLinks.style.left = "0";
      }
      function hideMenu(){
        navLinks.style.left = "-250px";
      }
    </script>
    <h1 class="ctg_heading">Commodity Trading Group Limited</h1>
    <div class="logo_section">
        <a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
    </div>
	<div id="po_form_content" class="ctg_po_container">
    <h2 class="po_heading">Purchase Order</h2>

    <form method="post">
    <?php

    include ('tbl_conn_files/orders_conn.php');
        $id = $_GET['viewid'];
        $query = mysqli_query($conn, "SELECT * FROM ctg_purchase_orders WHERE id='$id'");
        $row = mysqli_fetch_array($query);
    ?> 

    <div class="header">
        <div>
            
            <h3>From, <?php echo $row['customer_name']; ?></h3>
            <h3>Company: <?php echo $row['company_name']; ?></h3>
            <p>City: <?php echo $row['city_name']; ?></p>
            <p>Adress: <?php echo $row['street_address']; ?></p>
            <p>Phone: <?php echo $row['contact_no']; ?></p>
            <p>Email: <?php echo $row['email']; ?></p>

        </div>
        <div>
            <h3>Date: <?php echo $row['date_created']; ?></h3>
            <h3>To, CTG Limited</h3>
            <p>Address: G7VW+HG9</p>
            <p>City: Lusaka, Zambia</p>
            <p>Phone: +260 654 999 87</p>
            <p>Website: ctgzmltd.com</p>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Order #</th>
            <th>Description</th>
            <th>Quantity (Kg)</th>
            <th>Unit Price (ZMW)</th>
            <th>Total Price (ZMW)</th>
        </tr>
        </thead>
        <tbody id="order-items">
        <tr>
            <td><?php echo $row['order_no']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['quantity_kg']; ?></td>
            <td><?php echo $row['unit_price']; ?></td>
            <td><?php echo $row['sum_price']; ?></td>
        </tr>
        </tbody>
    </table>

    
    <div class="approv">

        <label for="approval">Status:</label>
        
        <input type="text" class="po_status" value="<?php echo $row['status']?>" name="status" readonly>
        <!-- Input field where 'Approved' will be set upon submission -->
        <?php
        // Only show the approve button if the status is still 'Pending'
        if ($row['status'] == 'Pending' && $_SESSION['role'] == 'Warehouse Manager') { ?>
            <!-- Hidden field to set status to 'Approved' -->
            <input type="hidden" name="status" value="Approved">
            <button type="submit" class="btn-po" name="update_po">Approve</button>
            

        <?php }

        // Display error message if there's insufficient stock
        if (isset($available_qty) && $available_qty < $ordered_qty) {
            echo "<div class='stock-error'>$item_name quantity is low. Only $available_qty kg available.</div>";
        }

        ?>
    </div>
     
    <div class="total-section">
        
        <div>
            <label for="subtotal">Subtotal:</label>
            <input type="number" id="ctg_sbt" name="sum_price" value="<?php echo $row['sum_price']; ?>" readonly>
        </div>
        <div>
            <label for="tax">Sales Tax (30%):</label>
            <input type="number" class="ctg_slstx" name="sales_tax" value="" readonly>
        </div>
        <div>
            <label for="shipping">Shipping (10%):</label>
            <input type="number" class="ctg_shipping" value="" readonly>
        </div>
        <div>
            <label for="grand-total">Grand Total:</label>
            <input type="number" class="ctg_gt" value="" readonly>      
        </div>
    </div>
    <!-- Button for PDF Download -->
    <div class="po_btns">
    <button type="button" id="download-pdf" class="btn-po">Download PDF</button>
    <a href="orders.php" value="back"class="btn-po">Back</a>
    </div>
    <script src="js_scripts/grand_total_calculation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script>
        // JavaScript to generate PDF
        document.getElementById('download-pdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;

            // Capture only the form content
            const formContent = document.getElementById('po_form_content');

            html2canvas(formContent).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');

                // Define the dimensions and position in the PDF
                const imgWidth = 190; // adjust width if needed
                const pageHeight = pdf.internal.pageSize.height;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;

                let position = 10; // initial position on the page
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                // Add a new page if the content is taller than the page
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                
                pdf.save('purchase_order.pdf');
            }).catch(function(error) {
                console.error("Error generating PDF: ", error);
            });
        });
    </script>
    </form>

</div>

</body>
</html>