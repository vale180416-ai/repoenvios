<?php
include 'conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM envios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
}
?>