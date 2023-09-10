<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php
    // delete_purchase.php
//db details
    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    // Connection
    $connection = mysqli_connect($host, $username, $password, $dbname);

    //Ensuring connection
    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {

        $purchaseId = $_GET['id'];

        ?>

        <script>
            Swal.fire({
                title: 'Purchase Record Deleted!',
                icon: 'warning',
                //showDenyButton: true,
                //showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    <?php
                    $deleteQuery = "DELETE FROM temporarystock WHERE purchase_id = '$purchaseId'";
                    mysqli_query($connection, $deleteQuery);
                    ?>
                    window.location.href = "confirmstock.php";
                }
                else if (result.isDenied) {
                    window.location.href = "confirmstock.php";
                }
            })
        </script>';

        <?php
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