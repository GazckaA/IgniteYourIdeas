<?php
$mysqli = new mysqli(
    "159.223.198.130",
    "admin",
    "43adf71e7430dde6c2b8c7a3e90141a7af72ba5c0d2b0f20",
    "IgniteYourIdeas",
    "3306"
);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

?>