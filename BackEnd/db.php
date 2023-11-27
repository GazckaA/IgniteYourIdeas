<?php
$mysqli = new mysqli(
    "24.144.88.50",
    "IgniteYourIdeas",
    "codxa1-Ridtuv",
    "IgniteYourIdeas",
    "3306"
);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

?>