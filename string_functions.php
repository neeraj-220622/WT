<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //string functions
    if (strlen($password) > 8 && str_contains($password, '#')) {
        echo "Strong Password";
    } else {
        echo "Weak Password";
    }
    echo "<br>";
    echo "The word count in the username is: " . str_word_count($username) . "<br>";
    echo "The reversed username is : " . strrev($username) . "<br>";
    //Case conversion
    echo "The username in lowercase is : " . strtolower($username) . "<br>";
    echo "The username in uppercase is : " . strtoupper($username) . "<br>";
    echo "The username with first letter capitalized is : " . ucfirst($username) . "<br>";
    echo "The username with first letter of each word capitalized is : " . ucwords($username) . "<br>";
    //search and replace
    echo "The username replaced 'a' with '@' is : " . str_replace('a', '@', $username) . "<br>";
    echo "The position of '@' in username is : " . strpos($username, 'a') . "<br>";
    //substring and trimming
    echo "The substring of username from index 2 to 5 is : " . substr($username, 2, 5) . "<br>";
    $trimmed_username = "   " . $username . "   ";
    echo "The trimmed username is : '" . trim($trimmed_username) . "'<br>";
    echo "The ltrim username is : '" . ltrim($trimmed_username) . "'<br>";
    echo "The rtrim username is : '" . rtrim($trimmed_username) . "'<br>";
    //string comparison
    $compare_str = "TestUser";
    echo "Comparing username with 'TestUser': " . strcmp($username, $compare_str) . "<br>";
    echo "Comparing username with 'testuser' (case-insensitive): " . strcasecmp($username, "testuser") . "<br>";
    //special characters and security
    echo "The HTML special characters in username are : " . htmlspecialchars($username) . "<br>";
    echo "The escaped password is : " . addslashes($password) . "<br>";
}
