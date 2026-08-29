<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ctg_inven_db";
 
/* Attempt to connect to MySQL database */
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function getMaterialById($conn, $id) {
    $material = '';

    // Prepare a select statement
    $query = "SELECT material FROM soap_costing WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        // Bind the ID to the statement
        $stmt->bind_param("i", $id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Bind the result
            $stmt->bind_result($material);
            $stmt->fetch();
        }
        $stmt->close();
    }

    return $material; // Return the material or an empty string if not found
}

?>
