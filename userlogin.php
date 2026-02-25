<?php
/*$servername = "localhost";
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

mysqli_close($conn);*/
session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';
$Client = new MongoDB\Client("mongodb://localhost:27017");
$db = $Client->MyTube;
$user = $db->user_details;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = strtolower($username);
    $username = str_replace(' ', '', $username);
    echo $password;
    if ($user->findOne(['username' => $username]) && password_verify($password, $user->findOne(['username' => $username])['Password'])) {
        echo "Login successful";
        $_SESSION['user_id'] = (string)$username;
        header("Location: LAB-02.php");
    } else {
        echo "Invalid username or password";
    }
}
