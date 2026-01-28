<?php
echo "This is the database configuration file <br>";
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    echo "<br>Received data: Name = $name, Email = $email, Message = $message<br>";
    $sql = "INSERT INTO contact_details (Name, Email, Message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
