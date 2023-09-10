<?php
// edit_purchase.php
//db details
$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

// Connection
$connection = mysqli_connect($host, $username, $password, $dbname);

// Ensuring connection
if (!$connection) {
    die("Connection failed!" . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $purchaseId = $_GET['id'];

    // Retrieve the purchase details from temporarystock table
    $query = "SELECT * FROM getpurchase WHERE purchase_id = '$purchaseId'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the updated values from the form
            $supplier_id = $_POST['supplier_id'];
            $item_code = $_POST['itemCode'];
            $item_name = $_POST['item_name'];
            $item_type = $_POST['item_type'];
            $volume = $_POST['volume'];
            $quantity = $_POST['quantity'];
            $unit_price = $_POST['unit_price'];
            $discount = $_POST['discount'];
            $total_cost = $_POST['total_cost'];
            $description = $_POST['description'];

            // Update the purchase details in the temporarystock table
            $updateQuery1 = "UPDATE getpurchase SET supplier_id = '$supplier_id', item_code = '$item_code', item_name = '$item_name', item_type = '$item_type',
                            volume = '$volume', quantity = '$quantity', unit_price = '$unit_price', discount = '$discount',
                            total_cost = '$total_cost', description = '$description' WHERE purchase_id = '$purchaseId'";
            $result1 = mysqli_query($connection, $updateQuery1);

            $updateQuery2 = "UPDATE temporarystock SET supplier_id = '$supplier_id', item_code = '$item_code', item_name = '$item_name', item_type = '$item_type',
                            volume = '$volume', quantity = '$quantity', unit_price = '$unit_price', discount = '$discount',
                            total_cost = '$total_cost', description = '$description' WHERE purchase_id = '$purchaseId'";
            $result2 = mysqli_query($connection, $updateQuery2);

            if ($result1 and $result2) {
                header("Location: purchases.php");
            }
        }

        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Edit Purchase</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <link rel="stylesheet" href="edit.css">
        </head>

        <body>
            <h1>Edit Purchase</h1>
            <form method="post">
                <label for="supplier_id">Supplier ID:</label>
                <input type="text" name="supplier_id" value="<?php echo $row['supplier_id']; ?>"><br>

                <label for="item_code">Item Code:</label>
                <input type="text" name="item_code" value="<?php echo $row['item_code']; ?>"><br>

                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" value="<?php echo $row['item_name']; ?>"><br>

                <label for="item_type">Item Type:</label>
                <input type="text" name="item_type" value="<?php echo $row['item_type']; ?>"><br>

                <label for="volume">Volume:</label>
                <input type="text" name="volume" value="<?php echo $row['volume']; ?>"><br>

                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"><br>

                <label for="unit_price">Unit Price:</label>
                <input type="text" name="unit_price" value="<?php echo $row['unit_price']; ?>"><br>

                <label for="discount">Discount:</label>
                <input type="text" name="discount" value="<?php echo $row['discount']; ?>"><br>

                <label for="total_cost">Total Cost:</label>
                <input type="text" name="total_cost" value="<?php echo $row['total_cost']; ?>"><br>

                <label for="description">Description:</label>
                <input type="text" name="description" value="<?php echo $row['description']; ?>"><br>

                <a href="edit_confirm.php"><input type="submit" value="Submit"></a>
            </form>


        </body>

        </html>
        <?php
    } else {
        echo "Purchase not found.";
    }
} else {
    echo "Invalid purchase ID.";
}

mysqli_close($connection);
?>