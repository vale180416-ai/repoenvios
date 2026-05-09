<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CourierExpress | Sistema Empresarial</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-slate-100 to-blue-100 min-h-screen font-sans">

    <!-- NAVBAR -->
    <nav class="bg-gradient-to-r from-blue-900 to-blue-700 shadow-2xl p-4">

        <div class="container mx-auto flex justify-between items-center">

            <h1 class="text-white text-3xl font-bold tracking-wide">

                <i class="fas fa-box-open mr-2"></i>

                CourierExpress

            </h1>

            <div class="text-white text-sm text-right">

                <p>
                    <i class="fas fa-calendar mr-1"></i>
                    <?php echo date("d/m/Y"); ?>
                </p>

                <p class="text-blue-200">
                    Sistema Empresarial
                </p>

            </div>

        </div>

    </nav>

    <!-- LOGO -->
    <div class="text-center mt-8">

        <img 
            src="logo.png"
            class="mx-auto w-32 drop-shadow-2xl hover:scale-110 transition duration-300"
        >

    </div>

    <!-- CONTENIDO -->
    <main class="container mx-auto mt-10 px-4">

        <!-- TITULO -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">

            <div>

                <h2 class="text-4xl font-extrabold text-slate-800">

                    📦 Gestión Inteligente de Envíos

                </h2>

                <p class="text-gray-500 mt-2 text-lg">

                    Plataforma moderna para administrar paquetes y entregas

                </p>

            </div>

            <a href="crear.php"
               class="mt-4 md:mt-0 bg-blue-800 hover:bg-blue-950 text-white px-6 py-3 rounded-2xl shadow-lg transition duration-300 font-bold">

                <i class="fas fa-plus mr-2"></i>

                Nuevo Envío

            </a>

        </div>

        <!-- TARJETAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- TOTAL -->
            <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-100">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Total Envíos
                        </p>

                        <h3 class="text-4xl font-bold text-blue-800 mt-2">

                            <?php
                            $total = $conn->query("SELECT COUNT(*) total FROM envios")->fetch_assoc();
                            echo $total['total'];
                            ?>

                        </h3>

                    </div>

                    <div class="bg-blue-100 p-4 rounded-full">

                        <i class="fas fa-box text-blue-700 text-2xl"></i>

                    </div>

                </div>

            </div>

            <!-- SISTEMA -->
            <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-100">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Estado del Sistema
                        </p>

                        <h3 class="text-3xl font-bold text-green-600 mt-2">
                            Activo
                        </h3>

                    </div>

                    <div class="bg-green-100 p-4 rounded-full">

                        <i class="fas fa-circle-check text-green-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <!-- FECHA -->
            <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-100">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm">
                            Fecha Actual
                        </p>

                        <h3 class="text-2xl font-bold text-slate-700 mt-2">

                            <?php echo date("d/m/Y"); ?>

                        </h3>

                    </div>

                    <div class="bg-orange-100 p-4 rounded-full">

                        <i class="fas fa-calendar-days text-orange-600 text-2xl"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- TABLA -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden border border-gray-200">

            <table class="min-w-full">

                <thead>

                    <tr class="bg-blue-100 text-slate-700 uppercase text-sm">

                        <th class="px-6 py-5 text-left">
                            ID
                        </th>

                        <th class="px-6 py-5 text-left">
                            Destinatario
                        </th>

                        <th class="px-6 py-5 text-left">
                            Dirección
                        </th>

                        <th class="px-6 py-5 text-left">
                            Descripción
                        </th>

                        <th class="px-6 py-5 text-center">
                            Imagen
                        </th>

                        <th class="px-6 py-5 text-center">
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

                        <td class="px-6 py-4 border-b font-semibold">

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

                        <!-- IMAGEN -->
                        <td class="px-6 py-4 border-b text-center">

                            <?php if (!empty($row['imagen'])) { ?>

                                <img 
                                    src="imagenes/<?php echo $row['imagen']; ?>"
                                    class="w-24 h-24 object-cover rounded-2xl mx-auto shadow-lg hover:scale-105 transition"
                                >

                            <?php } else { ?>

                                <span class="text-gray-400">
                                    Sin imagen
                                </span>

                            <?php } ?>

                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4 border-b text-center">

                            <a href="editar.php?id=<?php echo $row['id']; ?>"
                               class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-xl shadow mx-1 transition">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a href="eliminar.php?id=<?php echo $row['id']; ?>"
                               class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded-xl shadow mx-1 transition"
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

    <!-- FOOTER -->
    <footer class="mt-12 bg-blue-900 text-white text-center p-5 shadow-inner">

        <p class="text-sm">

            © <?php echo date("Y"); ?> CourierExpress | Plataforma Empresarial de Gestión de Envíos

        </p>

    </footer>

</body>
</html>