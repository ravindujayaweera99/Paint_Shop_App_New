<?php
session_start();

$host = "localhost";
$username = "root";
$password = '';
$dbname = "paintshopdb";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE name = '$username' AND psw= '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $userType = $row["user_type"];
        $UserName = $row["name"];

        $_SESSION['UserName'] = $UserName;
        $_SESSION['userType'] = $userType; // Storing user type in a session variable

        if ($userType == "admin") {
            header("Location: ../Admin/admin.php");
            exit();
        } elseif ($userType == "cashier") {
            header("Location: ../Cashier/cashier.php");
            exit();
        }
    } else {
        echo '<script>alert("Invalid username or password")</script>';
    }

    mysqli_free_result($result);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>

    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>