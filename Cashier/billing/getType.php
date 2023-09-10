<?php
$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

$connection = mysqli_connect($host, $username, $password, $dbname);
if (!$connection) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error())));
}

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $result ='';
    if($type != ""){
        $query = "SELECT item_code FROM stock WHERE item_type like '$type%'";
        $result = mysqli_query($connection, $query);
    }

    if ($result && mysqli_num_rows($result) > 0) {
        $codesData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $codesData[] = $row;
        }
        echo json_encode(array('success' => true, 'data' => $codesData));
        exit;
    } else {
        echo json_encode(array('success' => false, 'message' => 'Type not found'));
        exit;
    }
}

echo json_encode(array('success' => false, 'message' => 'Invalid request'));
?>