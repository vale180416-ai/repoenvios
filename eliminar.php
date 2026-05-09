<?php 
include 'conexion.php';
$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("DELETE FROM envios WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>