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

/* Delete using username */
$deleteResult = $users->deleteOne([
    'username' => $_SESSION['user_id']
]);

if ($deleteResult->getDeletedCount() === 1) {
    session_destroy();
    header("Location: LAB-02.php");
    exit();
} else {
    echo "Error deleting account.";
}
