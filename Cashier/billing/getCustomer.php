<?php
$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error())));
}

if (isset($_POST['customernic'])) {
    $customernic = $_POST['customernic'];

    $query = "SELECT * FROM customer WHERE nic='$customernic'";
    $result1 = mysqli_query($connection, $query);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $customerData = mysqli_fetch_assoc($result1);
        echo json_encode(array('success' => true, 'data' => $customerData));
        exit;
    } else {
        echo json_encode(array('success' => false, 'message' => 'Item not found'));
        exit;
    }
}

echo json_encode(array('success' => false, 'message' => 'Invalid request'));
?>