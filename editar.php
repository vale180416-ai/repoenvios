<?php 
include 'conexion.php';
$id = intval($_GET['id'] ?? 0);
$mensaje = '';
$data = null;

if ($id <= 0) {
    die('ID inválido');
}

$stmt = $conn->prepare("SELECT * FROM envios WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$data = $res->fetch_assoc();
$stmt->close();

if (!$data) {
    die('Envío no encontrado');
}

if ($_POST) {
    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');
    
    if (empty($dest) || empty($dir)) {
        $mensaje = 'El destinatario y dirección son obligatorios';
    } else {
        $stmt = $conn->prepare("UPDATE envios SET destinatario=?, direccion=?, descripcion=? WHERE id=?");
        $stmt->bind_param('sssi', $dest, $dir, $desc, $id);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $mensaje = 'Error al actualizar: ' . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Envío</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { max-width: 400px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { background: orange; color: white; padding: 10px; border: none; cursor: pointer; }
        .mensaje { color: red; margin-bottom: 10px; }
        a { text-decoration: none; color: blue; margin-left: 10px; }
    </style>
</head>
<body>
    <h2>Editar Envío</h2>
    <?php if ($mensaje): ?><p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="destinatario" value="<?php echo htmlspecialchars($data['destinatario']); ?>" required><br>
        <input type="text" name="direccion" value="<?php echo htmlspecialchars($data['direccion']); ?>" required><br>
        <textarea name="descripcion"><?php echo htmlspecialchars($data['descripcion']); ?></textarea><br>
        <button type="submit">Actualizar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>