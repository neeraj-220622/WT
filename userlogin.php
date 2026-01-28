<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password_db, $dbname);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_details 
            WHERE FName = '$username' 
            AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "Login successful";
    } else {
        echo "Invalid username or password";
    }
}

mysqli_close($conn);
