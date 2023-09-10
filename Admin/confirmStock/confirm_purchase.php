<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    // confirm_purchase.php
    //db details
    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    // Connection
    $connection = mysqli_connect($host, $username, $password, $dbname);

    // Ensuring connection
    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $purchaseId = $_GET['id'];

        // Retrieve the purchase details from temporarystock table
        $query = "SELECT * FROM temporarystock WHERE purchase_id = '$purchaseId'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $supplierId = $row['supplier_id'];
            $itemCode = $row['item_code'];
            $itemName = $row['item_name'];
            $itemType = $row['item_type'];
            $volume = $row['volume'];
            $quantity = $row['quantity'];
            $unitPrice = $row['unit_price'];
            $discount = $row['discount'];
            $cost = $row['cost'];
            $totalCost = $row['total_cost'];
            $description = $row['description'];

            // Check if the item already exists in the stock table
            $existingQuery = "SELECT * FROM stock WHERE item_code = '$itemCode' AND item_name = '$itemName' AND item_type = '$itemType'";
            $existingResult = mysqli_query($connection, $existingQuery);
            $existingRow = mysqli_fetch_assoc($existingResult);

            if ($existingRow) {
                ?>

                <script>
                    Swal.fire({
                        icon: 'question',
                        title: 'You Sure want to Move this row to Stock?',
                        //showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            <?php
                            $existingQuantity = $existingRow['quantity'];
                            $newQuantity = $existingQuantity + $quantity;

                            //Update the quantity in the stock table
                            $updateQuery = "UPDATE stock SET quantity = '$newQuantity' WHERE item_code = '$itemCode' AND item_name = '$itemName' AND item_type = '$itemType'";
                            mysqli_query($connection, $updateQuery);

                            // Delete the purchase row from the temporarystock table
                            $deleteQuery = "DELETE FROM temporarystock WHERE purchase_id = '$purchaseId'";
                            mysqli_query($connection, $deleteQuery);
                            ?>
                            window.location.href = "confirmstock.php";
                        }
                        // else  (result.isDenied) {
                        // window.location.href = "confirmstock.php";
                        // }
                    })
                </script>

                <?php

            } else {

                ?>

                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Item Not Found in the Stock. Add to the stock before Purchase!',
                        //showDenyButton: true,
                        //showCancelButton: true,
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "confirmstock.php";
                        }
                        // } else if (result.isDenied) {
                        //     Swal.fire('Changes are not saved', '', 'info')
                        // }
                    })
                </script>';

                <?php

            }

            ?>

            <!-- <script>
                Swal.fire({
                    title: 'You Sure want to Move this row to Stock?',
                    //showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        //query should enter
                        window.location.href = "confirmstock.php";
                    }
                    // else  (result.isDenied) {
                    //     window.location.href = "confirmstock.php";
                    // }
                })
            </script>'; -->

    <?php

        } else {

            ?>

            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Item Not Found in the Stock. Add to the stock before Purchase!',
                    //showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "confirmstock.php";
                    }
                    // } else if (result.isDenied) {
                    //     Swal.fire('Changes are not saved', '', 'info')
                    // }
                })
            </script>';

            <?php
        }
    } else {

        ?>

        <script>

        </script>

    <?php
    }

    mysqli_close($connection);
    ?>
</body>

</html>