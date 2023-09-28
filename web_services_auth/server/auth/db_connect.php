<?php
// edit here
$host = 'localhost:3306';
$username = 'root'; 
$password = ''; 
$database = 'auth_web_server'; 

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
