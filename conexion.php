<?php
$host = "mysql-vaaleeoortiiz.alwaysdata.net";
$usuario = "vaaleeoortiiz";
$contrasena = "clase12345";
$bd = "vaaleeoortiiz_mensajeria";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
