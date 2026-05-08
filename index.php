<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Envíos | CourierApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <nav class="bg-purple-600 p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-white text-xl font-bold"><i class="fas fa-truck-fast mr-2"></i> CourierApp</h1>
        </div>
    </nav>

    <main class="container mx-auto mt-10 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-700">Envíos Registrados</h2>
            <a href="crear.php" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-1"></i> Nuevo Envío
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-4 border-b font-bold text-left">ID</th>
                        <th class="px-6 py-4 border-b font-bold text-left">Destinatario</th>
                        <th class="px-6 py-4 border-b font-bold text-left">Dirección</th>
                        <th class="px-6 py-4 border-b font-bold text-left">Descripción</th>
                        <th class="px-6 py-4 border-b font-bold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php
                    $res = $conn->query("SELECT * FROM envios ORDER BY id DESC");
                    while($row = $res->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 border-b text-sm">#<?php echo $row['id']; ?></td>
                        <td class="px-6 py-4 border-b font-medium"><?php echo $row['destinatario']; ?></td>
                        <td class="px-6 py-4 border-b text-sm"><?php echo $row['direccion']; ?></td>
                        <td class="px-6 py-4 border-b text-sm text-gray-500"><?php echo $row['descripcion']; ?></td>
                        <td class="px-6 py-4 border-b text-center">
                            <a href="editar.php?id=<?php echo $row['id']; ?>" class="text-orange-500 hover:text-orange-700 mx-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('¿Eliminar registro?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>