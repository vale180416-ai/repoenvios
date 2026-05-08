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
        $res = $conn->query("SELECT * FROM envios ORDER BY id DESC");
        while($row = $res->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['destinatario']; ?></td>
            <td><?php echo $row['direccion']; ?></td>
            <td><?php echo $row['descripcion']; ?></td>
            <td>
                <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn edit">Editar</a>
                <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn del" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>