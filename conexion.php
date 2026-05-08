<?php
$host = "mysql-vaaleeoortiiz.alwaysdata.net";
$user = "marcela"; 
$pass = "lina123";    
$db   = "vaaleeoortiiz_mensajeria";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
