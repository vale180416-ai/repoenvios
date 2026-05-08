<?php 
include 'conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM envios WHERE id = $id");
header("Location: index.php");
?>