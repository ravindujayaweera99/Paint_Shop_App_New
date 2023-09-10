<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    //getting values from the form
    $usertype = $_POST['usertype'];
    $usercode = $_POST['code'];
    $name = $_POST['name'];
    $psw = $_POST['psw'];
    $pswrepeat = $_POST['psw-repeat'];


    //db details
    $host = "localhost";
    $username = "root";
    $password = 'admin';
    $dbname = "paintshopdb";

    //connection
    $connection = mysqli_connect($host, $username, $password, $dbname);

    //ensuring connection
    if (!$connection) {
        die("Connection failed!" . mysqli_connect_error());
    }



    //data entry query
    $sql = "INSERT INTO `users`(`user_type`, `user_code`, `name`, `psw`, `repeat_password`) VALUES ('$usertype', '$usercode', '$name', '$psw', '$pswrepeat')";


    //confirming the query success
    $rs = mysqli_query($connection, $sql);
    ?>

    <script>
        Swal.fire({
            title: 'User Added Successfully!',
            //showDenyButton: true,
            //showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href = "userReg.php";
            }
            // } else if (result.isDenied) {
            //     Swal.fire('Changes are not saved', '', 'info')
            // }
        })
    </script>';

    <?php

    //close connection
    mysqli_close($connection);

    ?>
</body>

</html>