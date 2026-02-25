<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$client = new Client("mongodb://localhost:27017");
$db = $client->MyTube;
$users = $db->user_details;

/* Since session stores username */
$user = $users->findOne([
    'username' => $_SESSION['user_id']
]);

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .profile-container {
            width: 400px;
            margin: 60px auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container h2 {
            margin-bottom: 20px;
        }

        .profile-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 8px 0;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .update-btn {
            background-color: red;
            color: white;
        }

        .update-btn:hover {
            background-color: darkred;
        }

        .delete-btn {
            background-color: black;
            color: white;
        }

        .delete-btn:hover {
            background-color: gray;
        }

        .back-btn {
            background-color: #ccc;
            color: black;
        }

        .back-btn:hover {
            background-color: #aaa;
        }
    </style>
</head>

<body>

    <div class="profile-container">

        <h2><?php echo $user['username']; ?></h2>

        <div class="profile-info">
            <p><strong>First Name:</strong> <?php echo $user['FName']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $user['LName']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
        </div>

        <!-- Update Profile -->
        <form action="updateprofile.php" method="GET">
            <button type="submit" class="btn update-btn">Update Profile</button>
        </form>

        <!-- Delete Account -->
        <form action="deleteuser.php" method="POST"
            onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <button type="submit" class="btn delete-btn">Delete Account</button>
        </form>

        <!-- Back to Home -->
        <form action="LAB-02.php" method="GET">
            <button type="submit" class="btn back-btn">Back to Home</button>
        </form>

    </div>

</body>

</html>