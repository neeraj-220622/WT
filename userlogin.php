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
    $username = strtolower($username);
    $username = str_replace(' ', '', $username);
    $sql = "SELECT * FROM user_details 
            WHERE username = '$username' 
            AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "Login successful";
        header("Location: LAB-02.html");
    } else {
        echo "Invalid username or password";
    }
}

mysqli_close($conn);
