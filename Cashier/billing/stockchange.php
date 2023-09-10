<html>

<head>

</head>

<body>
    <?php

    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    $itemCode = $_POST['itemCode'];
    $itemName = $_POST['itemName'];
    $itemType = $_POST['itemtype'];
    $quantity = $_POST['quantity'];

    $databaseConnection = mysqli_connect($host, $username, $password, $dbname);
    if (!$databaseConnection) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    $query = "SELECT * FROM stock WHERE item_code = '$itemCode' AND item_name = '$itemName' AND item_type = '$itemType'";
    $result = mysqli_query($databaseConnection, $query);

    $query2 = "SELECT quantity FROM stock WHERE item_code = '$itemCode' AND item_name = '$itemName' AND item_type = '$itemType'";

    if (mysqli_num_rows($result) > 0) {
        // Item exists, update the quantity
        $updateQuery = "UPDATE stock SET quantity = quantity - $quantity WHERE item_code = '$itemCode'";
        $updateResult = mysqli_query($databaseConnection, $updateQuery);

        if (!$updateResult) {
            echo "Failed to update stock: " . mysqli_error($databaseConnection);
            // echo '<script>
            //     window.location.href="billing.php";
            //     </script>';
            // Perform other necessary actions
        }
    } else {
        echo "Item not found in stock.";
    }

    // Close the database connection
    mysqli_close($databaseConnection);
    ?>

    <script>
        var totalPrice = 0;
        var vat = 0;

        function addItem() {
            var itemCode = document.getElementById("itemCode").value;
            var itemName = document.getElementById("itemName").value;
            var itemType = document.getElementById("itemtype").value;
            var quantity = parseInt(document.getElementById("quantity").value);
            var mrp = parseFloat(document.getElementById("mrp").value);
            var discount = parseFloat(document.getElementById("discount").value);

            var table = document.getElementById("itemTable");
            var row = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            cell1.innerHTML = itemCode;

            var cell2 = row.insertCell(1);
            cell2.innerHTML = itemName;

            var cell3 = row.insertCell(2);
            cell3.innerHTML = itemType;

            var cell3 = row.insertCell(3);
            cell3.innerHTML = quantity;

            var cell4 = row.insertCell(4);
            cell4.innerHTML = mrp;

            var cell5 = row.insertCell(5);
            cell5.innerHTML = discount;

            var itemTotal = ((mrp - (mrp * (discount / 100))) * quantity);
            totalPrice += itemTotal;

            var cell6 = row.insertCell(6);
            cell6.innerHTML = itemTotal;
            cell6.style.fontWeight = 700;

            document.getElementById("totalPrice").innerHTML = totalPrice.toFixed(2);

            vat = totalPrice * 0.15;

            document.getElementById("vat").innerHTML = vat.toFixed(2);

            clearForm();

        }

        function clearForm() {
            document.getElementById("itemCode").value = "";
            document.getElementById("itemName").value = "";
            document.getElementById("itemtype").value = "";
            document.getElementById("quantity").value = "";
            document.getElementById("mrp").value = "";
            document.getElementById("discount").value = "";
        }
    </script>
</body>

</html>