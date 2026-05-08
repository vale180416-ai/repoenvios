<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Envíos</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .add { background: green; color: white; }
        .edit { background: orange; color: white; }
        .del { background: red; color: white; }
    </style>
</head>
<body>
    <h2>Panel de Envíos</h2>
    <a href="crear.php" class="btn add">Nuevo Envío</a><br><br>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Destinatario</th>
            <th>Dirección</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        <?php
        $res = $conn->query("SELECT id, destinatario, direccion, descripcion FROM envios ORDER BY id DESC");
        if ($res && $res->num_rows > 0) {
            while($row = $res->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['destinatario']); ?></td>
            <td><?php echo htmlspecialchars($row['direccion']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td>
                <a href="editar.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn edit">Editar</a>
                <a href="eliminar.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn del" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
        </tr>
        <?php 
            endwhile;
        } else {
            echo '<tr><td colspan="5">No hay envíos registrados</td></tr>';
        }
        ?>
</body>
</html>