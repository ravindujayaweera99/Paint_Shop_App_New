<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stock.css">
    <title>Stock Management</title>
</head>

<body>
    <?php

    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    $connection = mysqli_connect($host, $username, $password, $dbname);

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

    ?>

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

        <div class="container">
            <div class="buttons">
                <a href="addStock/addstock.html">Add Items</a>
                <a href="viewStock/viewstock.php">View Stock</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

</body>

</html>