<?php
/* echo "This is the database configuration file <br>";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Database connected successfully";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = strtolower($username);
    $username = str_replace(' ', '', $username);
    echo "<br>Received data: First Name = $firstname, Last Name = $lastname, Username = $username, Email = $email, Password = $password<br>";
    $query = "SELECT * FROM user_details WHERE username = '{$username}'";
    $q = "SELECT * FROM user_details WHERE email = '{$email}'";
    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0 || mysqli_num_rows(mysqli_query($conn, $q)) > 0) {
        echo "Username or Email already exists. Please choose a different one.";
    } elseif (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    } elseif (!str_contains($email, '@')) {
        echo "Invalid email address.";
    } else {
        $sql = "INSERT INTO user_details (FName, LName, username, Email, Password) 
                VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            header("Location: login.html");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
} */

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';
$Client = new MongoDB\Client("mongodb://localhost:27017");
$db = $Client->MyTube;
$user = $db->user_details;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = strtolower($username);
    $username = str_replace(' ', '', $username);
    echo "<br>Received data: First Name = $firstname, Last Name = $lastname, Username = $username, Email = $email, Password = $password<br>";
    if ($user->findOne(['username' => $username]) || $user->findOne(['email' => $email])) {
        echo "Username or Email already exists. Please choose a different one.";
    } elseif (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
    } elseif (!str_contains($email, '@')) {
        echo "Invalid email address.";
    } else {
        $insertResult = $user->insertOne([
            'FName' => $firstname,
            'LName' => $lastname,
            'username' => $username,
            'Email' => $email,
            'Password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        if ($insertResult->getInsertedCount() === 1) {
            echo "New record created successfully";
            header("Location: login.html");
        } else {
            echo "Error inserting record.";
        }
    }
}
