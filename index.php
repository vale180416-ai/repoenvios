<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ENVI GIRL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-950 via-fuchsia-900 to-slate-950 text-white min-h-screen font-sans">

    <!-- CONTENIDO -->
    <section class="container mx-auto px-6 py-10">

        <h1 class="text-5xl font-extrabold text-center mb-10">

            <span class="text-pink-400">
                ENVI GIRL
            </span>

        </h1>

        <!-- TABLA -->
        <div class="bg-white/5 backdrop-blur-2xl rounded-3xl overflow-hidden shadow-2xl border border-pink-400/20">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead>

                        <tr class="bg-pink-500/10 text-pink-300 uppercase text-sm">

                            <th class="px-6 py-5">
                                ID
                            </th>

                            <th class="px-6 py-5">
                                Destinatario
                            </th>

                            <th class="px-6 py-5">
                                Dirección
                            </th>

                            <th class="px-6 py-5">
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

                    <tbody>

                        <?php
                        $res = $conn->query("SELECT * FROM envios ORDER BY id DESC");

                        while($row = $res->fetch_assoc()):
                        ?>

                        <tr class="border-b border-white/10 hover:bg-pink-500/5 transition duration-300">

                            <!-- ID -->
                            <td class="px-6 py-5 font-bold text-pink-300">

                                #<?php echo $row['id']; ?>

                            </td>

                            <!-- DESTINATARIO -->
                            <td class="px-6 py-5 font-semibold">

                                <?php echo $row['destinatario']; ?>

                            </td>

                            <!-- DIRECCION -->
                            <td class="px-6 py-5 text-gray-300">

                                <?php echo $row['direccion']; ?>

                            </td>

                            <!-- DESCRIPCION -->
                            <td class="px-6 py-5 text-gray-400">

                                <?php echo $row['descripcion']; ?>

                            </td>

                            <!-- IMAGEN -->
                            <td class="px-6 py-5 text-center">

                                <?php if(!empty($row['imagen'])) { ?>

                                    <img
                                    src="imagenes/<?php echo $row['imagen']; ?>"
                                    class="w-20 h-20 object-cover rounded-2xl mx-auto border border-pink-400/30 shadow-lg">

                                <?php } else { ?>

                                    <span class="text-gray-500">
                                        Sin imagen
                                    </span>

                                <?php } ?>

                            </td>

                            <!-- ACCIONES -->
                            <td class="px-6 py-5 text-center">

                                <!-- EDITAR -->
                                <a href="editar.php?id=<?php echo $row['id']; ?>"
                                class="bg-green-500 hover:bg-green-600 px-4 py-3 rounded-xl mx-1 inline-block transition shadow-lg">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <!-- ELIMINAR -->
                                <a href="eliminar.php?id=<?php echo $row['id']; ?>"
                                onclick="return confirm('¿Eliminar envío?')"
                                class="bg-red-500 hover:bg-red-600 px-4 py-3 rounded-xl mx-1 inline-block transition shadow-lg">

                                    <i class="fas fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="border-t border-pink-400/10 py-6 text-center text-gray-400 text-sm mt-10">

        © <?php echo date('Y'); ?> ENVI GIRL | Plataforma Inteligente de Gestión

    </footer>

</body>
</html>