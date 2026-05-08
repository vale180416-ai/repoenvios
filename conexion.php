<?php
$host = "mysql-vaaleeoortiiz.alwaysdata.net";
$usuario = "vaaleeoortiiz";
$contrasena = "clase1234";
$bd = "mensajeria";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
