<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="addCustomerSupplier.css">
    <title>User Registration</title>
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
            // session_destroy();
            // header("Location: ../../login/login.php");
        } elseif ($userType === 'cashier') {
            session_destroy();
            header("Location: ../../login/login.php");
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
            <a href="../admin.php">Admin Panel</a>
            <a href="../userRegistration/userReg.php">Add System User</a>
            <a href="../addCustomerSupplier/addCustomerSupplier.php">Customer and Supplier Registration</a>
            <a href="../addCustomerSupplier/viewcustomers.php">Registered Customers</a>
            <a href="../addCustomerSupplier/viewsuppliers.php">Registered Suppliers</a>
            <a href="../confirmStock/confirmstock.php">Confirm Products</a>
            <a href="../Stock/stock.php">Stock</a>
            <a href="">Reports</a>
            <a href="../purchases/purchases.php">Purchased Items</a>
            <a href="../expenses/expensesMain.php">Expenses</a>
            <a href="../quotation/quotation.php">Quotation</a>
            <span class="log-out"><a href="../../login/logout.php">Log Out</a></span>
        </nav>

        <div class="container">
            <h1>User Registration</h1>

            <div class="initial-select">
                <select name="usertype" id="usertype" onchange="check(value) ">
                    <option value="" selected disabled hidden>Choose User Type</option>
                    <option value="customer">Customer</option>
                    <option value="supplier">Supplier</option>
                </select>
            </div>

            <div class="customer" id="customer">
                <form action="addCustomer.php" method="POST" id="customer-form"
                    onsubmit="return validateCustomerForm()">

                    <label for="name"><b>Customer Name</b></label>
                    <input type="text" placeholder="Enter Customer Name" name="name" id="name" required>

                    <label for="address"><b>Address</b></label>
                    <input type="text" placeholder="Enter Address" name="address" id="address" required>

                    <label for="telno"><b>Telephone No</b></label>
                    <input type="text" placeholder="Enter Telephone No" name="telno" id="telno" required>

                    <label for="contactperson"><b>Contact Person</b></label>
                    <input type="text" placeholder="Enter Contact Person" name="contactperson" id="contactperson"
                        required>

                    <label for="contactpersontelno"><b>Telephone No - Contact Person</b></label>
                    <input type="text" placeholder="Enter Contact Person's Telephone No" name="contactpersontelno"
                        id="contactpersontelno" required>

                    <label for="nic"><b>NIC</b></label>
                    <input type="text" placeholder="Enter NIC" name="nic" id="nic" required>

                    <label for="creditlimit"><b>Credit Limit</b></label>
                    <input type="text" placeholder="Enter Credit Limit" name="creditlimit" id="creditlimit" required>

                    <label for="vat"><b>Customer Type</b></label>
                    <select name="vat" id="vat">
                        <option value="vat">Vat</option>
                        <option value="nonvat">Non - Vat</option>
                    </select>

                    <input type="submit" name="submit" id="submit" value="Add Customer" class="registerbtn ">
                </form>
            </div>

            <div class="supplier" id="supplier">
                <form action="addSupplier.php" method="POST" id="supplier-form"
                    onsubmit="return validateSupplierForm()">

                    <label for="name"><b>Supplier Name</b></label>
                    <input type="text" placeholder="Enter Supplier Name" name="name" id="supname" required>

                    <label for="shortcode"><b>Supplier Short Code</b></label>
                    <input type="text" placeholder="Enter Supplier Short Code" name="shortcode" id="shortcode" required>

                    <label for="address"><b>Supplier Address</b></label>
                    <input type="text" placeholder="Enter Supplier Address" name="address" id="supaddress" required>

                    <label for="telno"><b>Supplier Telephone No</b></label>
                    <input type="text" placeholder="Enter Supplier Telephone No" name="telno" id="suptelno" required>

                    <label for="contactperson"><b>Contact Person</b></label>
                    <input type="text" placeholder="Enter Contact Person's Name" name="contactperson"
                        id="supcontactperson" required>

                    <label for="contactpersontelno"><b>Telephone No - Contact Person</b></label>
                    <input type="text" placeholder="Enter Contact Person's Telephone No" name="contactpersontelno"
                        id="supcontactpersontelno" required>

                    <input type="submit" name="submit" id="submit" value="Add Supplier" class="registerbtn ">
                </form>
            </div>
        </div>

        </form>
    </div>

    <div class="footer">
        <h3>Copyright</h3>
    </div>

    <script src="adduser.js"></script>

    <script>
        function validateCustomerForm() {
            // Retrieve form elements
            var userType = document.getElementById("usertype").value;
            var name = document.getElementById("name").value;
            var address = document.getElementById("address").value;
            var telno = document.getElementById("telno").value;
            var contactperson = document.getElementById("contactperson").value;
            var contactpersontelno = document.getElementById("contactpersontelno").value;
            var nic = document.getElementById("nic").value;
            var creditlimit = document.getElementById("creditlimit").value;

            // Define regex patterns
            var telephoneRegex = /^\d{10}$|^0\d{9}$/;
            var nicRegex = /^\d{9}[vVxX]$|^\d{12}$/;
            var nameRegex = /^[A-Za-z\s]+$/;

            // Validate name
            if (!nameRegex.test(name)) {
                alert("Invalid Name. Please enter a valid name using only letters and spaces.");
                return false;
            }

            // Validate contact person name
            if (!nameRegex.test(contactperson)) {
                alert("Invalid Contact Person Name. Please enter a valid name using only letters and spaces.");
                return false;
            }

            // Validate telephone number
            if (userType === "customer" && !telephoneRegex.test(telno)) {
                alert("Invalid Telephone Number. Please enter a valid Sri Lankan telephone number.");
                return false;
            }

            // Validate contact person telephone number
            if (!telephoneRegex.test(contactpersontelno)) {
                alert("Invalid Contact Person Telephone Number. Please enter a valid Sri Lankan telephone number.");
                return false;
            }

            // Validate NIC
            if (!nicRegex.test(nic)) {
                alert("Invalid NIC. Please enter a valid Sri Lankan NIC number.");
                return false;
            }

            // Additional validation logic for other fields...

            // Form is valid
            return true;
        }

        function validateSupplierForm() {
            // Retrieve form elements
            var name = document.getElementById("supname").value;
            var shortcode = document.getElementById("shortcode").value;
            var address = document.getElementById("supaddress").value;
            var telno = document.getElementById("suptelno").value;
            var contactperson = document.getElementById("supcontactperson").value;
            var contactpersontelno = document.getElementById("supcontactpersontelno").value;

            // Define regex patterns
            var telephoneRegex = /^\d{10}$|^0\d{9}$/;
            var nameRegex = /^[A-Za-z\s]+$/;

            // Validate name
            if (!nameRegex.test(name)) {
                alert("Invalid Name. Please enter a valid name using only letters and spaces.");
                return false;
            }

            // Validate telephone number
            if (!telephoneRegex.test(telno)) {
                alert("Invalid Telephone Number. Please enter a valid Sri Lankan telephone number.");
                return false;
            }

            // Validate contact person name
            if (!nameRegex.test(contactperson)) {
                alert("Invalid Contact Person Name. Please enter a valid name using only letters and spaces.");
                return false;
            }

            // Validate contact person telephone number
            if (!telephoneRegex.test(contactpersontelno)) {
                alert("Invalid Contact Person Telephone Number. Please enter a valid Sri Lankan telephone number.");
                return false;
            }

            // Form is valid
            return true;
        }
    </script>

    <script>

    </script>

</html>