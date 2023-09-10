<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticiations About Stock</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        flex-direction: column;
        background-image: url(../../images/background.avif);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    nav {
        height: 100vh;
        background-color: rgba(182, 204, 161, 0.7);
        width: 20vw;
        display: flex;
        flex-direction: column;
    }

    .bc {
        display: flex;
        flex-direction: row;
    }

    nav a {
        color: rgb(255, 255, 255);
        text-decoration: none;
        border: 2px solid rgb(255, 255, 255);
        margin-right: 10px;
        padding: 15px;
        background-color: rgb(48, 1, 30);
        font-size: 15px;
        text-transform: uppercase;
        border-radius: 15px;
        font-weight: 700;
    }

    nav a:hover {
        background-color: rgb(215, 252, 212);
        color: rgb(48, 1, 30);
    }

    nav>span {
        margin-top: 25px;
    }

    nav span>a {
        background-color: rgb(255, 0, 0);
    }

    nav span>a:hover {
        background-color: rgb(98, 6, 6);
    }

    body {
        background-image: url(../images/background.avif);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    table {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        color: #000000;
        width: fit-content;
        height: fit-content;
        margin-left: auto;
        margin-right: auto;
        background-color: #fff;
    }

    td {
        text-align: center;
        font-size: 15px;
        padding-left: 50px;
    }

    th {
        text-align: center;
        color: blue;
        font-size: 15px;
        padding-left: 50px;
    }

    .header {
        background-color: rgb(48, 1, 30);
    }

    h2 {
        text-align: center;
        color: rgb(255, 255, 255);
        font-size: 40px;
        padding: 5px;
    }

    .footer {
        background-color: rgb(48, 1, 30);
        height: 100px;
        margin-top: 140px;
        display: grid;
        place-items: center;
    }

    .footer h3 {
        text-align: center;
        color: rgb(255, 255, 255);
    }
</style>

<body>

    <div class="header">
        <h2>Ananda Paint Center</h2>
    </div>

    <div class="bc">
        <nav>
            <a href="admin.php">Admin Panel</a>
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


        session_start();

        // Check if the user type is stored in the session
        if (isset($_SESSION['userType'])) {
            $userType = $_SESSION['userType'];

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

        $query = "SELECT * FROM stock WHERE quantity <= min_qty";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {

            echo "<table>";
            echo "<tr><th>Item Code</th><th>Item Name</th></th><th>Current Quantity</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["item_code"] . "</td>";
                echo "<td>" . $row["item_name"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

        } else {
            echo "All item have enough Stock";
        }

        ?>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

</body>

</html>