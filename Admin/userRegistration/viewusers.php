<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="viewusers.css">
  <title>Registered Users</title>
</head>

<body>

  <div class="header">
    <h2>Ananda Paint Center</h2>
  </div>

  <div class="bc">
    <nav>
      <a href="../admin.php">Admin Panel</a>
      <a href="userReg.php">Add System User</a>
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

    $host = "localhost";
    $username = "root";
    $password = 'admin';
    $dbname = "paintshopdb";

    $connection = mysqli_connect($host, $username, $password, $dbname);

    if (!$connection) {
      die("Connection failed!" . mysqli_connect_error());
    }

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th>User Type</th><th>User Code</th></th><th>Name</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["user_type"] . "</td>";
        echo "<td>" . $row["user_code"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "</tr>";
      }

      echo "</table>";

    } else {
      echo "No Users found";
    }
    ?>
  </div>

  <div class="footer">
    <h3>Copyright</h3>
  </div>

</body>

</html>