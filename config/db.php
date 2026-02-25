<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

$Client = new MongoDB\Client("mongodb://localhost:27017");
$db = $Client->MyTube;
$user = $db->user_details;
