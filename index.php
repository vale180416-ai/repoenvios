<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Empresarial de Envíos</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-100 font-sans leading-normal tracking-normal">

    <!-- Barra superior -->
    <nav class="bg-blue-900 p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-between">

            <h1 class="text-white text-2xl font-bold">
                <i class="fas fa-box-open mr-2"></i>
                CourierExpress
            </h1>

            <p class="text-white text-sm">
                <?php echo date("d/m/Y"); ?>
            </p>

        </div>
    </nav>

    <!-- Logo -->
    <div class="text-center mt-8">
        <img src="logo.png" class="mx-auto w-28 drop-shadow-lg">
    </div>

    <!-- Contenido -->
    <main class="container mx-auto mt-8 px-4">

        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h2 class="text-3xl font-bold text-slate-800">
                    📦 Sistema Empresarial de Envíos
                </h2>

                <p class="text-gray-500 mt-1">
                    Gestión moderna y segura de paquetes
                </p>
            </div>

            <a href="crear.php"
               class="bg-blue-800 hover:bg-blue-950 text-white font-bold py-3 px-5 rounded-xl shadow-md transition duration-300">

                <i class="fas fa-plus mr-2"></i>
                Nuevo Envío
            </a>
        </div>

        <!-- Tabla -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <table class="min-w-full leading-normal">

                <thead>
                    <tr class="bg-blue-100 text-slate-700 uppercase text-sm">

                        <th class="px-6 py-4 border-b font-bold text-left">
                            ID
                        </th>

                        <th class="px-6 py-4 border-b font-bold text-left">
                            Destinatario
                        </th>

                        <th class="px-6 py-4 border-b font-bold text-left">
                            Dirección
                        </th>

                        <th class="px-6 py-4 border-b font-bold text-left">
                            Descripción
                        </th>

                        <th class="px-6 py-4 border-b font-bold text-center">
                            Acciones
                        </th>

                    </tr>
                </thead>

                <tbody class="text-gray-700">

                    <?php
                    $res = $conn->query("SELECT * FROM envios ORDER BY id DESC");

                    while($row = $res->fetch_assoc()):
                    ?>

                    <tr class="hover:bg-slate-100 transition duration-200">

                        <td class="px-6 py-4 border-b text-sm font-semibold">
                            #<?php echo $row['id']; ?>
                        </td>

                        <td class="px-6 py-4 border-b font-medium">
                            <?php echo $row['destinatario']; ?>
                        </td>

                        <td class="px-6 py-4 border-b text-sm">
                            <?php echo $row['direccion']; ?>
                        </td>

                        <td class="px-6 py-4 border-b text-sm text-gray-500">
                            <?php echo $row['descripcion']; ?>
                        </td>

                        <td class="px-6 py-4 border-b text-center">

                            <a href="editar.php?id=<?php echo $row['id']; ?>"
                               class="bg-green-500 hover:bg-green-700 text-white px-3 py-2 rounded-lg mx-1 transition">

                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="eliminar.php?id=<?php echo $row['id']; ?>"
                               class="bg-red-500 hover:bg-red-700 text-white px-3 py-2 rounded-lg mx-1 transition"
                               onclick="return confirm('¿Eliminar registro?')">

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