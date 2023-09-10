<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php

    //getting values from the form
    $suppliername = $_POST['name'];
    $shortcode = $_POST['shortcode'];
    $supplieraddress = $_POST['address'];
    $suppliertelno = $_POST['telno'];
    $contactperson = $_POST['contactperson'];
    $contactpersontelno = $_POST['contactpersontelno'];

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
    $sql = "INSERT INTO supplier(supplier_name, short_code, address, tel_no, contact_person, tel_no_contact_person) VALUES ('$suppliername', '$shortcode', '$supplieraddress', '$suppliertelno', '$contactperson', '$contactpersontelno')";


    //confirming the query success
    $rs = mysqli_query($connection, $sql);

    ?>

    <script>
        Swal.fire({
            title: 'Supplier Added Successfully!',
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
    </script>';

    <?php

    //close connection
    mysqli_close($connection);

    ?>
</body>

</html>