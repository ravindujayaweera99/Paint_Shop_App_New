<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cashier.css">
    <title>Cashier Panel</title>
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
            session_destroy();
            header("Location: ../../login/login.php");
        } elseif ($userType === 'cashier') {
            // session_destroy();
            // header("Location: ../login/login.php");
        }
    } else {
        session_destroy();
        header("Location: ../login/login.php");
    }

    ?>

    <div class="header">
        <h2>Ananda Paint Center</h2>
        <?php
        echo "<h4> WELCOME! - $UserName </h4>"
            ?>
    </div>

    <div class="container">
        <h1>Cashier Panel</h1>
        <div class="buttons">
            <a href="./Stock/stock.html">Stock</a>
            <a href="./billing/billing.php">Billing</a>
            <a href="./purchases/purchases.php">Purchases</a>
            <a href="./quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../login/logout.php">Log Out</a></span>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>


</body>

</html>