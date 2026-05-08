<?php 
include 'conexion.php';
if ($_POST) {
    $dest = $_POST['destinatario'];
    $dir = $_POST['direccion'];
    $desc = $_POST['descripcion'];
    $conn->query("INSERT INTO envios (destinatario, direccion, descripcion) VALUES ('$dest', '$dir', '$desc')");
    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="destinatario" placeholder="Destinatario" required><br>
    <input type="text" name="direccion" placeholder="Dirección" required><br>
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <button type="submit">Guardar Envío</button>
</form>