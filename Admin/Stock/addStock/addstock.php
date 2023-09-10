<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    $itemcode = $_POST['itemcode'];
    $supplier = $_POST['supplier'];
    $name = $_POST['name'];
    $itemtype = $_POST['type'];
    $volume = $_POST['volume'];
    $quantity = $_POST['quantity'];
    $minimumquantity = $_POST['minqty'];
    $unitprice = $_POST['unitprice'];
    $discount = $_POST['discount'];
    $netvalue = $_POST['netvalue'];

    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    $connection = mysqli_connect($host, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }

    $sql = "INSERT INTO `stock`(`item_code`, `supplier_id`, `item_name`, `item_type`, `volume`, `quantity`, `min_qty`, `unit_price`, `discount`, `net_value`) VALUES ('$itemcode', '$supplier',  '$name', '$itemtype','$volume', '$quantity', '$minimumquantity', $unitprice, '$discount', '$netvalue' )";

    $rs = mysqli_query($connection, $sql);


    if ($rs) {

        ?>


        <script>
            Swal.fire({
                title: 'Item Added to the Stock Successfully!',
                //showDenyButton: true,
                //showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "addstock.html";
                }
                // } else if (result.isDenied) {
                //     Swal.fire('Changes are not saved', '', 'info')
                // }
            })
        </script>';

        <?php
    }

    mysqli_close($connection);

    ?>
</body>

</html>