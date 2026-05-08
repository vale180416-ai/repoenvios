<?php 
include 'conexion.php';
$mensaje = '';

if ($_POST) {

    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');

    // VARIABLE DE LA IMAGEN
    $imagen = '';

    // SUBIR IMAGEN
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

        $carpeta = "imagenes/";

        // CREA LA CARPETA SI NO EXISTE
        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        // NOMBRE DE LA IMAGEN
        $imagen = time() . "_" . $_FILES['imagen']['name'];

        // RUTA
        $ruta = $carpeta . $imagen;

        // MOVER IMAGEN
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    }

    if (empty($dest) || empty($dir)) {

        $mensaje = 'El destinatario y dirección son obligatorios';

    } else {

        // AGREGAMOS EL CAMPO IMAGEN
        $stmt = $conn->prepare("
            INSERT INTO envios 
            (destinatario, direccion, descripcion, imagen) 
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param('ssss', $dest, $dir, $desc, $imagen);

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

        body {
            font-family: Arial;
            margin: 20px;
        }

        form {
            max-width: 400px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background: green;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .mensaje {
            color: red;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: blue;
        }

    </style>
</head>

<body>

    <h2>Crear Envío</h2>

    <?php if ($mensaje): ?>

        <p class="mensaje">
            <?php echo htmlspecialchars($mensaje); ?>
        </p>

    <?php endif; ?>

    <!-- enctype PARA SUBIR IMÁGENES -->
    <form method="POST" enctype="multipart/form-data">

        <input 
            type="text" 
            name="destinatario" 
            placeholder="Destinatario" 
            required
        ><br>

        <input 
            type="text" 
            name="direccion" 
            placeholder="Dirección" 
            required
        ><br>

        <textarea 
            name="descripcion" 
            placeholder="Descripción"
        ></textarea><br>

        <!-- CAMPO DE IMAGEN -->
        <input type="file" name="imagen"><br>

        <button type="submit">
            Guardar Envío
        </button>

        <a href="index.php">
            Cancelar
        </a>

    </form>

</body>
</html>