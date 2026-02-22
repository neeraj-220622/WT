<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

session_start();

$client = new Google\Client();
$env = parse_ini_file('.env');

$client->setClientId($env['GOOGLE_CLIENT_ID']);
$client->setClientSecret($env['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri("http://localhost/WT/callback.php");

$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        echo "Token Error: " . $token['error_description'];
        exit();
    }

    $client->setAccessToken($token);

    $service = new Google\Service\Oauth2($client);
    $user = $service->userinfo->get();

    echo "Name: " . $user->name . "<br>";
    echo "Email: " . $user->email . "<br>";
    echo "<img src='" . $user->picture . "' width='100'>";
}
