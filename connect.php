<?php
$host = 'localhost';
$dbuser = 'root';
$dbpwd = 'root';
$db = 'accounts';

$conn = new mysqli($host, $dbuser, $dbpwd, $db);

if($conn->connect_error) {
    die('Connection failed! ' . $conn->connect_error);
}
?>
