<?php 
include 'conexion.php';
$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');
    
    if (empty($dest) || empty($dir)) {
        $mensaje = 'El destinatario y dirección son obligatorios';
        $tipoMensaje = 'danger';
    } else {
        $stmt = $conn->prepare("INSERT INTO envios (destinatario, direccion, descripcion) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $dest, $dir, $desc);
        
        if ($stmt->execute()) {
            $mensaje = '✅ Envío guardado correctamente';
            $tipoMensaje = 'success';
        } else {
            $mensaje = '❌ Error al guardar: ' . $conn->error;
            $tipoMensaje = 'danger';
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
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">📦 Crear Envío</h2>

        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="card p-4 shadow-sm needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Destinatario</label>
                <input type="text" name="destinatario" class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa el destinatario.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
                <div class="invalid-feedback">La dirección es obligatoria.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar Envío</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Validación Bootstrap -->
    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
