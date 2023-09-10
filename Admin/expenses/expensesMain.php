<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="expenses.css">
    <title>Expenses</title>
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
            <a href="expensesMain.php">Expenses</a>
            <a href="../quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <div class="container">
            <div class="form">
                <form action="expenses.php" method="POST">
                    <label for="type">Bill Type</label>
                    <select name="type" id="type">
                        <option value="Water">Water</option>
                        <option value="Electricity">Electricity</option>
                        <option value="Salary">Employee Salary</option>
                    </select>

                    <label for="description">Employee Name / Description</label>
                    <input type="text" name="description" id="description">

                    <label for="month">Select Month</label>
                    <select name="month" id="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="Auguest">Auguest</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>

                    <label for="amount">Amount</label>
                    <input type="decimal" name="amount" id="amount">

                    <input type="submit">
                </form>
            </div>
            <button><a href="viewExpenses.php">View Expenses</a></button>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

    <script>
        function validateform() {
            var description = document.getElementById("description").value;
            var amount = document.getElementById("amount").value;

            var nameRegex = /^[A-Za-z\s]+$/;

            if (!nameRegex.test(name)) {
                alert("Invalid Name. Please enter a valid name using only letters and spaces.");
                return false;
            }

            if (!amount >= 0) {
                alert("Invalid Amount!");
                return false;
            }
        }
    </script>
</body>

</html>