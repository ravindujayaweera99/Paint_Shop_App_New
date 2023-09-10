<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirming.css">
    <title>Confirm Purchases</title>
</head>

<body>

    <div class="header">
        <h2>Ananda Paint Center</h2>
    </div>

    <div class="bc">
        <nav>
            <a href="../admin.php">Admin Panel</a>
            <a href="../userRegistration/userReg.php">Add System User</a>
            <a href="../addCustomerSupplier/addCustomerSupplier.php">Customer and Supplier Registration</a>
            <a href="../addCustomerSupplier/viewcustomers.php">Registered Customers</a>
            <a href="../addCustomerSupplier/viewsuppliers.php">Registered Suppliers</a>
            <a href="../confirmStock/confirmstock.php">Confirm Products</a>
            <a href="../Stock/stock.php">Stock</a>
            <a href="">Reports</a>
            <a href="../purchases/purchases.php">Purchased Items</a>
            <a href="../expenses/expensesMain.php">Expenses</a>
            <a href="../quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <?php
        // confirming_purchases.php
        //db details
        $host = "localhost";
        $username = "root";
        $password = '';
        $dbname = "paintshopdb";

        //connection
        $connection = mysqli_connect($host, $username, $password, $dbname);

        //ensuring connection
        if (!$connection) {
            die("Connection failed!" . mysqli_connect_error());
        }

        session_start();

        // Check if the user type is stored in the session
        if (isset($_SESSION['userType'])) {
            $userType = $_SESSION['userType'];

            if ($userType === 'admin') {
                // session_destroy();
                // header("Location: ../../login/login.php");
            } elseif ($userType === 'cashier') {
                session_destroy();
                header("Location: ../../login/login.php");
            }
        } else {
            session_destroy();
            header("Location: ../../login/login.php");
        }

        // Retrieve rows from temp_stock table
        $query = "SELECT * FROM temporarystock";
        $result = mysqli_query($connection, $query);
        ?>

        <div class="sc">
            <div class="add-new-item">
                <h1>Confirming Purchases</h1>
                <a href="../Stock/addStock/addstock.html">Add New Item to The Stock</a>
                <a href="../Stock/viewStock/viewstock.php">View Current Stock</a>
            </div>

            <table>
                <tr>
                    <th>Purchase ID</th>
                    <th>Supplier ID</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Item Type</th>
                    <th>Volume</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Cost</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>


                <?php
                // Display rows from temporarystock table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['purchase_id'] . "</td>";
                    echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "<td>" . $row['item_code'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['item_type'] . "</td>";
                    echo "<td>" . $row['volume'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unit_price'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['cost'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>
                    <a href='edit_purchase.php?id=" . $row['purchase_id'] . "'>Edit</a> 
                    <a href='delete_purchase.php?id=" . $row['purchase_id'] . "'>Delete</a> 
                    <a href='confirm_purchase.php?id=" . $row['purchase_id'] . "'>Confirm</a>
                  </td>";
                    echo "</tr>";

                }
                ?>
            </table>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>