<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    //getting values from the form
    $expensetype = $_POST['type'];
    $desc = $_POST['description'];
    $month = $_POST['month'];
    $amount = $_POST['amount'];

    //db details
    $host = "localhost";
    $username = "root";
    $password = '';
    $dbname = "paintshopdb";

    //connection
    $connection = mysqli_connect($host, $username, $password, $dbname);

    //ensuring connection
    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }



    //data entry query
    $sql = "INSERT INTO `expenses`(`type`, `description`, `month`, `amount`) VALUES ('$expensetype', '$desc', '$month', '$amount')";

    //confirming the query success
    $rs = mysqli_query($connection, $sql);

    if ($rs) {

        ?>
        <script>
            Swal.fire({
                title: 'Expense Added to the Records Successfully!',
                //showDenyButton: true,
                //showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "expensesMain.php";
                }
                // } else if (result.isDenied) {
                //     Swal.fire('Changes are not saved', '', 'info')
                // }
            })
        </script>';

        <?php
    }

    //close connection
    mysqli_close($connection);

    ?>
</body>

</html>