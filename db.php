<?php
$host = "localhost";
$user = "uppbmi0whibtc";
$pass = "bjgew6ykgu1v";
$dbname = "db5lsehmmp0uwb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
