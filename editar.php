<?php 
include 'conexion.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM envios WHERE id = $id");
$data = $res->fetch_assoc();

if ($_POST) {
    $dest = $_POST['destinatario'];
    $dir = $_POST['direccion'];
    $desc = $_POST['descripcion'];
    $conn->query("UPDATE envios SET destinatario='$dest', direccion='$dir', descripcion='$desc' WHERE id=$id");
    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="destinatario" value="<?php echo $data['destinatario']; ?>" required><br>
    <input type="text" name="direccion" value="<?php echo $data['direccion']; ?>" required><br>
    <textarea name="descripcion"><?php echo $data['descripcion']; ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>