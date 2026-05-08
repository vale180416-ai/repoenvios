<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $destinatario = $_POST['destinatario'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO envios(destinatario, direccion, descripcion)
            VALUES('$destinatario', '$direccion', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Envío</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow-lg p-5 formulario">

        <h2 class="mb-4 text-center">Registrar Nuevo Envío</h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Destinatario</label>
                <input type="text" name="destinatario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4" required></textarea>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">
                    Guardar Envío
   </button>

                <a href="index.php" class="btn btn-secondary">
                    Volver
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>