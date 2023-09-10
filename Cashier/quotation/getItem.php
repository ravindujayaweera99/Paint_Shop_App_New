<?php
$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error())));
}

if (isset($_POST['itemCode'])) {
    $itemCode = $_POST['itemCode'];

    $query = "SELECT * FROM stock WHERE item_code='$itemCode'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $itemData = mysqli_fetch_assoc($result);
        echo json_encode(array('success' => true, 'data' => $itemData));
        exit;
    } else {
        echo json_encode(array('success' => false, 'message' => 'Item not found'));
        exit;
    }
}

echo json_encode(array('success' => false, 'message' => 'Invalid request'));
?>