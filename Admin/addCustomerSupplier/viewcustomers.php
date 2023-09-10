<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="viewcustomers.css">
  <title>Registred Customer List</title>
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
      <a href="viewcustomers.php">Registered Customers</a>
      <a href="viewsuppliers.php">Registered Suppliers</a>
      <a href="../confirmStock/confirmstock.php">Confirm Products</a>
      <a href="../Stock/stock.php">Stock</a>
      <a href="">Reports</a>
      <a href="../purchases/purchases.php">Purchased Items</a>
      <a href="../expenses/expensesMain.php">Expenses</a>
      <a href="../quotation/quotation.php">Quotation</a>
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

    $query = "SELECT * FROM customer";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th>Customer Code</th><th>Customer Name</th></th><th>Address</th><th>Telephone No</th><th>Contact Person</th><th>Contact Person - Tel No</th><th>NIC</th><th>Credit Limit</th><th>Customer Type</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["customer_code"] . "</td>";
        echo "<td>" . $row["customer_name"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["tel_no"] . "</td>";
        echo "<td>" . $row["contact_person"] . "</td>";
        echo "<td>" . $row["tel_no_contact_person"] . "</td>";
        echo "<td>" . $row["nic"] . "</td>";
        echo "<td>" . $row["credit_limit"] . "</td>";
        echo "<td>" . $row["vat_or_non_vat"] . "</td>";
        echo "</tr>";
      }

      echo "</table>";

    } else {
      echo "No Customer found in the Database.";
    }
    ?>
  </div>

  <div class="footer">
    <h3>Copyright</h3>
  </div>

</body>

</html>