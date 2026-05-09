<?php 
include 'conexion.php';
$mensaje = '';

if ($_POST) {
    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');
    
    if (empty($dest) || empty($dir)) {
        $mensaje = 'El destinatario y dirección son obligatorios';
    } else {
        $stmt = $conn->prepare("INSERT INTO envios (destinatario, direccion, descripcion) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $dest, $dir, $desc);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $mensaje = 'Error al guardar: ' . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Envío</title>
    <style>
        body { font-family: Times New Roman; margin: 30px; }
        form { max-width: 400px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { background: green; color: white; padding: 10px; border: none; cursor: pointer; }
        .mensaje { color: fuchsia; margin-bottom: 10px; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Crear Envío</h2>
    <?php if ($mensaje): ?><p class="mensaje"><?php echo htmlspecialchars($mensaje); ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="destinatario" placeholder="Destinatario" required><br>
        <input type="text" name="direccion" placeholder="Dirección" required><br>
        <textarea name="descripcion" placeholder="Descripción"></textarea><br>
        <button type="submit">Guardar Envío</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>