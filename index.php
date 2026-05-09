<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ENVI GIRL</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ICONOS -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<!-- FONDO -->
<body class="text-white min-h-screen font-sans bg-cover bg-center bg-fixed"
style="background-image:
linear-gradient(rgba(10,10,20,0.85), rgba(20,10,30,0.90)),
url('fondo.jpg');">

    <!-- EFECTO BLUR -->
    <div class="fixed inset-0 backdrop-blur-[2px] -z-10"></div>

    <!-- NAVBAR -->
    <nav class="bg-black/30 backdrop-blur-xl border-b border-pink-400/20 shadow-2xl">

        <div class="container mx-auto px-6 py-5 flex justify-between items-center">

            <!-- LOGO -->
            <div class="flex items-center gap-4">

                <div class="bg-pink-500 p-4 rounded-2xl shadow-lg shadow-pink-500/40">

                    <i class="fas fa-truck-fast text-2xl"></i>

                </div>

                <div>

                    <h1 class="text-4xl font-extrabold text-pink-400 tracking-wide">

                        ENVI GIRL

                    </h1>

                    <p class="text-gray-300 text-sm">

                        Plataforma Elegante de Envíos

                    </p>

                </div>

            </div>

            <!-- BOTON -->
            <a href="crear.php"
            class="bg-pink-500 hover:bg-pink-600 text-white font-bold px-6 py-3 rounded-2xl transition duration-300 shadow-lg shadow-pink-500/40">

                <i class="fas fa-plus mr-2"></i>

                Nuevo Envío

            </a>

        </div>

    </nav>

    <!-- TITULO -->
    <section class="container mx-auto px-6 py-12">

        <div class="text-center mb-12">

            <h2 class="text-6xl font-extrabold leading-tight">

                Gestión de

                <span class="bg-gradient-to-r from-pink-400 via-fuchsia-400 to-purple-400 bg-clip-text text-transparent">

                    Envíos Inteligente

                </span>

            </h2>

            <p class="text-gray-300 mt-5 text-xl">

                Plataforma moderna y futurista para administrar paquetes

            </p>

        </div>

        <!-- TABLA -->
        <div class="bg-white/5 backdrop-blur-2xl rounded-3xl overflow-hidden shadow-2xl border border-pink-400/20">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <!-- CABECERA -->
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

                    <!-- CONTENIDO -->
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
                                    class="w-20 h-20 object-cover rounded-2xl mx-auto border border-pink-400/30 shadow-lg hover:scale-105 transition duration-300">

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
    <footer class="border-t border-pink-400/10 py-6 text-center text-gray-300 text-sm mt-10 bg-black/20 backdrop-blur-xl">

        © <?php echo date('Y'); ?> ENVI GIRL | Plataforma Inteligente de Gestión

    </footer>

</body>
</html>