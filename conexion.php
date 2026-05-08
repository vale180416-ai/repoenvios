<?php
$host = "mysql-vaaleeoortiiz.alwaysdata.net";
$usuario = "vaaleeoortiiz";
$contrasena = "clase1234";
$bd = "vaaleeoortiiz_mensajeria";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
