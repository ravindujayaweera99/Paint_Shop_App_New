<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="viewPurchases.css">
  <title>Previous Expenses</title>
</head>

<body>

  <div class="header">
    <h2>Ananda Paint Center</h2>
  </div>

  <div class="bc">
    <nav>
      <a href="../cashier.php">Cashier Panel</a>
      <a href="../billing/billing.php">Billing</a>
      <a href="../Stock/stock.html">Stock</a>
      <a href="purchases.php">Purchases</a>
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

    $query = "SELECT * FROM purchases";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th>Supplier Id</th><th>Item Code</th></th><th>Item Name</th><th>Item Type</th><th>Volume</th><th>Quantity</th><th>Unit Price</th><th>Discount</th><th>Cost</th><th>Description</th><th>Time</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["supplier_id"] . "</td>";
        echo "<td>" . $row["item_code"] . "</td>";
        echo "<td>" . $row["item_name"] . "</td>";
        echo "<td>" . $row["item_type"] . "</td>";
        echo "<td>" . $row["volume"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["unit_price"] . "</td>";
        echo "<td>" . $row["discount"] . "</td>";
        echo "<td>" . $row["cost"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["time"] . "</td>";
        echo "</tr>";
      }

      echo "</table>";

    } else {
      echo "No Purchases found";
    }
    ?>
  </div>

  <div class="footer">
    <h3>Copyright</h3>
  </div>

</body>

</html>