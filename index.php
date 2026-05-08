<?php
include 'conexion.php';

$sql = "SELECT * FROM envios ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Envíos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container mt-5">

    <div class="card shadow-lg p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="titulo">📦 Gestión de Envíos</h1>

            <a href="crear.php" class="btn btn-success btn-lg">
                Nuevo Envío
            </a>
        </div>

        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Destinatario</th>
                    <th>Dirección</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
       <tbody>

            <?php while($fila = $resultado->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['destinatario']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>

                    <td>
                        <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-primary btn-sm">
                            Editar
                        </a>

                        <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Deseas eliminar este envío?')">
                            Eliminar
                        </a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
    </div>
</body>
</html>