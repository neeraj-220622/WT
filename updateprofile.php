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

/* Fetch current user */
$currentUser = $users->findOne([
    'username' => $_SESSION['user_id']
]);

if (!$currentUser) {
    echo "User not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $username  = strtolower(trim($_POST['username']));
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];

    /* Check duplicate username (if changed) */
    if ($username !== $_SESSION['user_id']) {
        $existingUsername = $users->findOne(['username' => $username]);
        if ($existingUsername) {
            die("Username already taken.");
        }
    }

    /* Check duplicate email */
    $existingEmail = $users->findOne([
        'Email' => $email,
        'username' => ['$ne' => $_SESSION['user_id']]
    ]);

    if ($existingEmail) {
        die("Email already in use.");
    }

    $updateData = [
        'FName' => $firstname,
        'LName' => $lastname,
        'username' => $username,
        'Email' => $email
    ];

    if (!empty($password)) {
        $updateData['Password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $users->updateOne(
        ['username' => $_SESSION['user_id']],
        ['$set' => $updateData]
    );

    /* Update session if username changed */
    $_SESSION['user_id'] = $username;

    echo "<script>
            alert('Profile updated successfully');
            window.location.href='profile.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            padding: 25px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            background-color: red;
            color: white;
        }

        .btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Update Profile</h2>

        <form method="POST">
            <input type="text" name="firstname"
                value="<?php echo $currentUser['FName']; ?>" required>

            <input type="text" name="lastname"
                value="<?php echo $currentUser['LName']; ?>" required>

            <input type="text" name="username"
                value="<?php echo $currentUser['username']; ?>" required>

            <input type="email" name="email"
                value="<?php echo $currentUser['Email']; ?>" required>

            <input type="password" name="password"
                placeholder="New password (optional)">

            <button type="submit" class="btn">Update Profile</button>
        </form>
    </div>

</body>

</html>