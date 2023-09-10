<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    //getting values from the form
    $customername = $_POST['name'];
    $customeraddress = $_POST['address'];
    $telephoenno = $_POST['telno'];
    $contactperson = $_POST['contactperson'];
    $contactpersontelno = $_POST['contactpersontelno'];
    $nic = $_POST["nic"];
    $creditlimit = $_POST['creditlimit'];
    $vat = $_POST["vat"];


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
    $sql = "INSERT INTO `customer`(`customer_name`, `address`, `tel_no`, `contact_person`, `tel_no_contact_person`,`nic`, `credit_limit`,`vat_or_non_vat`) VALUES ('$customername', '$customeraddress', '$telephoenno', '$contactperson', '$contactpersontelno', '$nic', '$creditlimit', '$vat')";
    $sql2 = "INSERT INTO `creditcustomers`(`customer_nic`, `customer_name`, `credit_limit`,`remaining_credit`) VALUES ('$nic','$customername','$creditlimit', '$creditlimit')";

    //confirming the query success
    $rs = mysqli_query($connection, $sql);
    $rs2 = mysqli_query($connection, $sql2);

    ?>

    <script>
        Swal.fire({
            title: 'Customer Added Successfully!',
            //showDenyButton: true,
            //showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.href = "addCustomerSupplier.php";
            }
            // } else if (result.isDenied) {
            //     Swal.fire('Changes are not saved', '', 'info')
            // }
        })
    </script>


    <?php

    //close connection
    mysqli_close($connection);

    ?>
</body>

</html>