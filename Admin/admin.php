<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Panel</title>
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
    if (isset($_SESSION['userType'], $_SESSION['UserName'])) {
        $userType = $_SESSION['userType'];
        $UserName = $_SESSION['UserName'];

        if ($userType === 'admin') {
            // session_destroy();
            // header("Location: ../../login/login.php");
        } elseif ($userType === 'cashier') {
            session_destroy();
            header("Location: ../login/login.php");
        }
    } else {
        session_destroy();
        header("Location: ../login/login.php");
    }

    ?>

    <div class="header">
        <h3>Ananda Paint Center</h3>
        <?php
        echo "<h4> WELCOME! <br> $UserName </h4>"
            ?>
        <div class="bell">
            <a href="minQtyCheck.php">These Items should be Purchase Immediately!</a>
            <img src="../images/bell.png" alt="bell icon">
        </div>
    </div>

    <h1>Admin Panel</h1>
    <div class="container">
        <div class="buttons">
            <a href="userRegistration/userReg.php">Add System User</a>
            <a href="addCustomerSupplier/addCustomerSupplier.php">Customer and Supplier Registration</a>
            <a href="addCustomerSupplier/viewcustomers.php">Registered Customers</a>
            <a href="addCustomerSupplier/viewsuppliers.php">Registered Suppliers</a>
            <a href="confirmStock/confirmstock.php">Confirm Products</a>
            <a href="Stock/stock.php">Stock</a>
            <a href="">Reports</a>
            <a href="purchases/purchases.php">Purchased Items</a>
            <a href="expenses/expensesMain.php">Expenses</a>
            <a href="quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../login/logout.php">Log Out</a></span>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

</body>

</html>