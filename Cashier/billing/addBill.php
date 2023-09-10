<?php

$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed!" . mysqli_connect_error());
}
$totalValue = $_POST["totalPrice"];
$vat = $_POST["vat"];

$query5 = "INSERT INTO `invoice`(`included_vat`, `total`) VALUES ($totalValue, $vat)";
$updateResult = mysqli_query($connection, $query5);

?>