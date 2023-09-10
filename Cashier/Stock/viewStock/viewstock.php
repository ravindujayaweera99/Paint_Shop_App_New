<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewstock.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Current Stock</title>
</head>

<body>

    <div class="header">
        <h3>Ananda Paint Center</h3>
    </div>

    <div class="bc">
        <nav>
            <nav>
                <a href="../../cashier.php">Cashier Panel</a>
                <a href="../../billing/billing.php">Billing</a>
                <a href="../stock.html">Stock</a>
                <a href="../../purchases/purchases.php">Purchases</a>
                <a href="../../quotation/quotation.php">Quotation</a>
                <span class="log-out"><a href="../../../login/logout.php">Log Out</a></span>
            </nav>
        </nav>


        <div>
                <input type="text" placeholder="Search Type" name="search" id="givenType">
                <button onclick="submitType()" type="button"><i class="fa fa-search"></i></button>
       
            <?php
            if (isset($_GET['type'])) {
                $searchType = $_GET['type'];
                $host = "localhost";
                $username = "root";
                $password = '';
                $dbname = "paintshopdb";

                $connection = mysqli_connect($host, $username, $password, $dbname);

                if (!$connection) {
                die("Connection failed!" . mysqli_connect_error());
                }
                $query = "SELECT * FROM stock WHERE item_type LIKE '$searchType%'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Item Code</th><th>Supplier</th></th><th>Item Name</th><th>Item Type</th><th>Volume (L)</th><th>Quantity</th><th>Minimum Quantity</th><th>Unit Price</th><th>Discount (%)</th><th>Net Value</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["item_code"] . "</td>";
                    echo "<td>" . $row["supplier_id"] . "</td>";
                    echo "<td>" . $row["item_name"] . "</td>";
                    echo "<td>" . $row["item_type"] . "</td>";
                    echo "<td>" . $row["volume"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["min_qty"] . "</td>";
                    echo "<td>" . $row["unit_price"] . "</td>";
                    echo "<td>" . $row["discount"] . "</td>";
                    echo "<td>" . $row["net_value"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                } else {
                echo "No items found in the stock.";
                }
            }else{
                $host = "localhost";
                $username = "root";
                $password = '';
                $dbname = "paintshopdb";

                $connection = mysqli_connect($host, $username, $password, $dbname);

                if (!$connection) {
                die("Connection failed!" . mysqli_connect_error());
                }
                $query = "SELECT * FROM stock";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Item Code</th><th>Supplier</th></th><th>Item Name</th><th>Item Type</th><th>Volume (L)</th><th>Quantity</th><th>Minimum Quantity</th><th>Unit Price</th><th>Discount (%)</th><th>Net Value</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["item_code"] . "</td>";
                    echo "<td>" . $row["supplier_id"] . "</td>";
                    echo "<td>" . $row["item_name"] . "</td>";
                    echo "<td>" . $row["item_type"] . "</td>";
                    echo "<td>" . $row["volume"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["min_qty"] . "</td>";
                    echo "<td>" . $row["unit_price"] . "</td>";
                    echo "<td>" . $row["discount"] . "</td>";
                    echo "<td>" . $row["net_value"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                } else {
                echo "No items found in the stock.";
                }
            }
            ?>
        </div>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>
    <script type="text/javascript">
    function submitType() {
        var type = document.getElementById("givenType").value;
        window.location.href = 'viewstock.php?type=' + type;
    }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>