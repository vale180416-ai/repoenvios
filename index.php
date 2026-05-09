<?php
include("conexion.php");

/* ELIMINAR */

if(isset($_GET['eliminar'])){

    $id = $_GET['eliminar'];

    $stmt = $conn->prepare("DELETE FROM envios WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>CourierApp | Gestión Inteligente</title>

    <!-- TAILWIND -->

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ICONOS -->

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body class="bg-black min-h-screen overflow-x-hidden text-white font-sans">

    <!-- FONDO -->

    <div class="fixed inset-0 -z-10">

        <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500 rounded-full blur-[140px] opacity-30 animate-pulse"></div>

        <div class="absolute bottom-0 right-0 w-96 h-96 bg-fuchsia-600 rounded-full blur-[140px] opacity-30 animate-pulse"></div>

        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-600 rounded-full blur-[160px] opacity-20 animate-pulse"></div>

    </div>

    <!-- NAVBAR -->

    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-white/5 border-b border-white/10 shadow-2xl">

        <div class="container mx-auto px-8 py-5 flex justify-between items-center">

            <!-- LOGO -->

            <div class="flex items-center gap-4">

                <div class="relative">

                    <div class="absolute inset-0 bg-cyan-400 blur-xl opacity-60 rounded-full"></div>

                    <div class="relative bg-gradient-to-r from-cyan-500 to-blue-600 p-4 rounded-2xl shadow-2xl">

                        <i class="fas fa-truck-fast text-3xl"></i>

                    </div>

                </div>

                <div>

                    <h1 class="text-3xl font-black tracking-widest bg-gradient-to-r from-cyan-400 to-fuchsia-500 bg-clip-text text-transparent">

                        COURIERAPP

                    </h1>

                    <p class="text-gray-400 text-sm tracking-wider">

                        Plataforma Inteligente de Envíos

                    </p>

                </div>

            </div>

            <!-- BOTON -->

            <a href="crear.php"

            class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:scale-105 transition-all duration-300 px-6 py-4 rounded-2xl shadow-2xl shadow-cyan-500/40 font-bold">

                <i class="fas fa-plus mr-2"></i>

                Nuevo Envío

            </a>

        </div>

    </nav>

    <!-- CONTENIDO -->

    <main class="container mx-auto px-8 py-12">

        <!-- HERO -->

        <div class="grid lg:grid-cols-2 gap-10 items-center mb-14">

            <!-- TEXTO -->

            <div>

                <span class="bg-cyan-500/20 text-cyan-300 px-4 py-2 rounded-full text-sm tracking-wider border border-cyan-500/30">

                    SISTEMA PREMIUM

                </span>

                <h2 class="text-6xl font-black leading-tight mt-6">

                    Gestión de

                    <span class="bg-gradient-to-r from-cyan-400 to-fuchsia-500 bg-clip-text text-transparent">

                        Envíos

                    </span>

                    Inteligente

                </h2>

                <p class="text-gray-300 text-lg mt-6 leading-relaxed">

                    Administra destinatarios, direcciones y paquetes
                    desde una plataforma moderna y futurista.

                </p>

                <!-- STATS -->

                <div class="flex gap-6 mt-8 flex-wrap">

                    <div class="backdrop-blur-xl bg-white/5 border border-white/10 px-6 py-5 rounded-2xl shadow-xl">

                        <h3 class="text-3xl font-black text-cyan-400">

                            24/7

                        </h3>

                        <p class="text-gray-400 text-sm">

                            Seguimiento

                        </p>

                    </div>

                    <div class="backdrop-blur-xl bg-white/5 border border-white/10 px-6 py-5 rounded-2xl shadow-xl">

                        <h3 class="text-3xl font-black text-fuchsia-400">

                            +500

                        </h3>

                        <p class="text-gray-400 text-sm">

                            Envíos diarios

                        </p>

                    </div>

                </div>

            </div>

            <!-- IMAGEN -->

            <div class="relative flex justify-center">

                <div class="absolute w-80 h-80 bg-cyan-500 blur-[120px] opacity-30 rounded-full"></div>

                <img
                src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"

                class="relative w-96 drop-shadow-[0_0_50px_rgba(34,211,238,0.7)] animate-bounce">

            </div>

        </div>

        <!-- TABLA -->

        <div class="backdrop-blur-2xl bg-white/5 border border-white/10 rounded-[30px] overflow-hidden shadow-[0_20px_80px_rgba(0,0,0,0.5)]">

            <!-- HEADER TABLA -->

            <div class="flex justify-between items-center px-8 py-6 border-b border-white/10">

                <div>

                    <h3 class="text-2xl font-bold">

                        📦 Lista de Envíos

                    </h3>

                    <p class="text-gray-400 text-sm mt-1">

                        Información actualizada en tiempo real

                    </p>

                </div>

                <div class="bg-cyan-500/20 text-cyan-300 px-5 py-2 rounded-full border border-cyan-500/30 text-sm">

                    Activos

                </div>

            </div>

            <!-- TABLA -->

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="bg-white/5 text-gray-300 uppercase text-sm tracking-widest">

                            <th class="px-8 py-6 text-left">ID</th>

                            <th class="px-8 py-6 text-left">
                                Destinatario
                            </th>

                            <th class="px-8 py-6 text-left">
                                Dirección
                            </th>

                            <th class="px-8 py-6 text-left">
                                Descripción
                            </th>

                            <th class="px-8 py-6 text-center">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $res = $conn->query("SELECT * FROM envios ORDER BY id DESC");

                        while($row = $res->fetch_assoc()):
                        ?>

                        <tr class="border-b border-white/5 hover:bg-white/5 transition-all duration-300">

                            <!-- ID -->

                            <td class="px-8 py-6 font-black text-cyan-400">

                                #<?php echo $row['id']; ?>

                            </td>

                            <!-- DESTINATARIO -->

                            <td class="px-8 py-6">

                                <div class="flex items-center gap-4">

                                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg">

                                        <i class="fas fa-user"></i>

                                    </div>

                                    <div>

                                        <h4 class="font-bold">
                                            <?php echo $row['destinatario']; ?>
                                        </h4>

                                        <p class="text-sm text-gray-400">
                                            Cliente registrado
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- DIRECCION -->

                            <td class="px-8 py-6 text-gray-300">

                                <div class="flex items-center gap-2">

                                    <i class="fas fa-location-dot text-fuchsia-400"></i>

                                    <?php echo $row['direccion']; ?>

                                </div>

                            </td>

                            <!-- DESCRIPCION -->

                            <td class="px-8 py-6">

                                <span class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-sm text-gray-300">

                                    <?php echo $row['descripcion']; ?>

                                </span>

                            </td>

                            <!-- ACCIONES -->

                            <td class="px-8 py-6">

                                <div class="flex justify-center gap-4">

                                    <!-- EDITAR -->

                                    <a href="editar.php?id=<?php echo $row['id']; ?>"

                                    class="bg-gradient-to-r from-amber-400 to-orange-500 hover:scale-110 transition-all duration-300 px-5 py-3 rounded-2xl shadow-xl">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <!-- ELIMINAR -->

                                    <a href="?eliminar=<?php echo $row['id']; ?>"

                                    onclick="return confirm('¿Eliminar registro?')"

                                    class="bg-gradient-to-r from-red-500 to-pink-600 hover:scale-110 transition-all duration-300 px-5 py-3 rounded-2xl shadow-xl">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</body>

</html>