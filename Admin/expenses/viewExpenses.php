<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewExpenses.css">
    <title>Expenses</title>
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
            <a href="expensesMain.php">Expenses</a>
            <a href="../purchases/purchases.php">Purchased Items</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <?php

        $host = "localhost";
        $username = "root";
        $password = '';
        $dbname = "paintshopdb";

        $connection = mysqli_connect($host, $username, $password, $dbname);

        if (!$connection) {
            die("Connection failed!" . mysqli_connect_error());
        }

        $query = "SELECT * FROM expenses";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {

            echo "<table>";
            echo "<tr><th>Expense Type</th><th>Description</th></th><th>Month</th><th>Amount</th><th>Time</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["month"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "<td>" . $row["time"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

        } else {
            echo "No Expenses found";
        }

        ?>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

</body>

</html>