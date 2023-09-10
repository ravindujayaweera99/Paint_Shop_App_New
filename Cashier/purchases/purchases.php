<!-- purchase_items.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Purchase Items</title>
    <link rel="stylesheet" href="purchasing.css">
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
            session_destroy();
            header("Location: ../../login/login.php");
        } elseif ($userType === 'cashier') {
            // session_destroy();
            // header("Location: ../../login/login.php");
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
            <a href="../cashier.php">Cashier Panel</a>
            <a href="../billing/billing.php">Billing</a>
            <a href="../Stock/stock.html">Stock</a>
            <a href="purchases.php">Purchases</a>
            <a href="../quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <div class="sc">
            <div class="add-new-item">
                <a href="../Stock/addStock/addstock.html">Add New Item to The Stock</a>
                <a href="../Stock/viewStock/viewstock.php">View Current Stock</a>
                <a href="viewPurchases.php">View Previous Purchases</a>
            </div>

            <form action="purchasing.php" method="post" onsubmit="validateForm()">

                <label for="item_code">Item Code:</label>
                <select id="itemCode" name="itemCode" required onchange="loadItemData()">
                    <option value="">Select an item</option>
                    <?php
                    $query = "SELECT item_code FROM stock";
                    $result = mysqli_query($connection, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['item_code'] . "'>" . $row['item_code'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No items found</option>";
                    }
                    ?>
                </select><br>

                <label for="supplier_id">Supplier ID:</label>
                <input type="text" name="supplier_id" id="supplier_id" required><br>

                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" required><br>

                <label for="item_type">Item Type:</label>
                <input type="text" name="item_type" id="item_type" required><br>

                <label for="volume">Volume:</label>
                <input type="text" name="volume" id="volume" required><br>

                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" id="quantity" required oninput="calculateCost()"><br>

                <label for="unit_price">Unit Price:</label>
                <input type="text" name="unit_price" id="unit_price" required oninput="calculateCost()"><br>

                <label for="discount">Discount (%):</label>
                <input type="text" name="discount" id="discount" oninput="calculateCost()"><br>

                <label for="cost">Cost: Rs.</label>
                <input type="text" id="cost" name="cost"></input><br>

                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea><br>

                <input type="submit" value="Purchase Item">
            </form>

            <table id="itemTable">
                <tr>
                    <th>Item Code</th>
                    <th>Supplier ID</th>
                    <th>Item Name</th>
                    <th>Item Type</th>
                    <th>Volume</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Cost</th>
                    <th>Description</th>
                </tr>

                <?php

                $query = "SELECT * FROM getpurchase";
                $result = mysqli_query($connection, $query);

                // Display rows from temporarystock table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['item_code'] . "</td>";
                    echo "<td>" . $row['supplier_id'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['item_type'] . "</td>";
                    echo "<td>" . $row['volume'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unit_price'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['total_cost'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>
                    <a href='edit_purchase.php?id=" . $row['purchase_id'] . "'>Edit</a> 
                    <a href='delete_purchase.php?id=" . $row['purchase_id'] . "'>Delete</a> 
                    <a href='confirm_purchase.php?id=" . $row['purchase_id'] . "'>Confirm</a>
                  </td>";
                    echo "</tr>";

                }
                ?>
            </table>
        </div>

    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>


    <script src="purchases.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        function loadItemData() {
            var itemCode = document.getElementById("itemCode").value;
            if (itemCode !== "") {
                console.log(itemCode);
                $.ajax({
                    url: 'getItem.php',
                    type: 'POST',
                    data: {
                        itemCode: itemCode
                    },
                    success: function (response) {
                        var responseObject = JSON.parse(response);
                        if (responseObject.success) {
                            var itemData = responseObject.data;
                            console.log(itemData);

                            document.getElementById("supplier_id").value = itemData?.supplier_id;
                            document.getElementById("item_name").value = itemData?.item_name;
                            document.getElementById("item_type").value = itemData?.item_type;
                            document.getElementById("volume").value = itemData?.volume;
                            document.getElementById("unit_price").value = itemData?.unit_price;
                        } else {
                            console.log(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            } else {
                // Clear the item data fields if no item is selected
                document.getElementById("supplier_id").value = "";
                document.getElementById("item_name").value = "";
                document.getElementById("item_type").value = "";
                document.getElementById("volume").value = "";
                document.getElementById("unit_price").value = "";
            }
        }

        // function validateForm() {

        //     event.preventDefault();
        //     $.ajax({
        //         url: 'purchasing.php',
        //         type: 'POST',
        //         data: $('#itemForm').serialize(),
        //         success: function (response) {
        //             addItem()
        //         },
        //         error: function (xhr, status, error) {
        //             alert(error)
        //         }
        //     });
        // }

        // function addItem() {
        //     var itemCode = document.getElementById("itemCode").value;
        //     var supplierId = document.getElementById("supplier_id").value;
        //     var itemName = document.getElementById("item_name").value;
        //     var itemType = document.getElementById("item_type").value;
        //     var volume = document.getElementById("volume").value;
        //     var quantity = parseInt(document.getElementById("quantity").value);
        //     var unitPrice = parseFloat(document.getElementById("unit_price").value);
        //     var discount = parseFloat(document.getElementById("discount").value);
        //     var cost = parseFloat(document.getElementById("cost").value);

        //     var table = document.getElementById("itemTable");
        //     var row = table.insertRow(-1);

        //     var cell1 = row.insertCell(0);
        //     cell1.innerHTML = itemCode;

        //     var cell2 = row.insertCell(1);
        //     cell2.innerHTML = supplierId;

        //     var cell3 = row.insertCell(2);
        //     cell3.innerHTML = itemName;

        //     var cell3 = row.insertCell(3);
        //     cell3.innerHTML = itemType;

        //     var cell4 = row.insertCell(4);
        //     cell4.innerHTML = volume;

        //     var cell5 = row.insertCell(5);
        //     cell5.innerHTML = quantity;

        //     var cell6 = row.insertCell(6);
        //     cell6.innerHTML = unitPrice;

        //     var cell7 = row.insertCell(7);
        //     cell7.innerHTML = discount;

        //     var cell8 = row.insertCell(8);
        //     cell8.innerHTML = cost;
        //     cell8.style.fontWeight = 700;

        //     clearForm();
        // }

        // function clearForm() {
        //     document.getElementById("itemCode").value = "";
        //     document.getElementById("supplier_id").value = "";
        //     document.getElementById("item_name").value = "";
        //     document.getElementById("item_type").value = "";
        //     document.getElementById("volume").value = "";
        //     document.getElementById("quantity").value = "";
        //     document.getElementById("unit_price").value = "";
        //     document.getElementById("discount").value = "";
        //     document.getElementById("cost").value = "";
        // }
    </script>
</body>

</html>