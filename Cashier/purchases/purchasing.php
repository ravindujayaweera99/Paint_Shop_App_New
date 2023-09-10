<?php
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

// Retrieve form data
$supplier_id = $_POST['supplier_id'];
$item_code = $_POST['itemCode'];
$item_name = $_POST['item_name'];
$item_type = $_POST['item_type'];
$volume = $_POST['volume'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];
$discount = $_POST['discount'];
$cost = $_POST['cost'];
$total_cost = $cost * $quantity;
$description = $_POST['description'];


// Insert data into temp_stock table
$query = "INSERT INTO temporarystock (supplier_id, item_code, item_name, item_type, volume, quantity, unit_price, discount, cost, total_cost, description) 
          VALUES ('$supplier_id', '$item_code', '$item_name', '$item_type', '$volume', '$quantity', '$unit_price', '$discount', '$cost', '$total_cost', '$description')";
$result1 = mysqli_query($connection, $query);


$query2 = "INSERT INTO `purchases`(`supplier_id`, `item_code`, `item_name`, `item_type`, `volume`, `quantity`, `unit_price`, `discount`, `cost`,`total_cost`, `description`) VALUES ('$supplier_id','$item_code','$item_name','$item_type','$volume','$quantity','$unit_price]','$discount','$cost', '$total_cost','$description')";
$result2 = mysqli_query($connection, $query2);

$query3 = "INSERT INTO `getpurchase`(`item_code`, `supplier_id`, `item_name`, `item_type`, `volume`, `quantity`, `unit_price`, `discount`, `total_cost`,`description`) VALUES ('$item_code', '$supplier_id', '$item_name','$item_type','$volume','$quantity','$unit_price','$discount','$total_cost', '$description')";
$result3 = mysqli_query($connection, $query3);


if ($result1 and $result2 and $result3) {
    header("Location: purchases.php");
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>