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

$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html>

<body>

    <a href="<?= $login_url ?>">
        <button>Login with Google</button>
    </a>

</body>

</html>