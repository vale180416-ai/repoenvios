<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');

    // NUEVOS CAMPOS
    $peso = trim($_POST['peso'] ?? '');
    $alto = trim($_POST['alto'] ?? '');
    $ancho = trim($_POST['ancho'] ?? '');
    $largo = trim($_POST['largo'] ?? '');

    if (empty($dest) || empty($dir)) {

        $mensaje = 'El destinatario y la dirección son obligatorios';

    } else {

        $stmt = $conn->prepare("INSERT INTO envios 
        (destinatario, direccion, descripcion, peso, alto, ancho, largo) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {

            $stmt->bind_param(
                "sssdddd",
                $dest,
                $dir,
                $desc,
                $peso,
                $alto,
                $ancho,
                $largo
            );

            if ($stmt->execute()) {

                header("Location: index.php");
                exit();

            } else {

                $mensaje = "Error al guardar: " . $stmt->error;
            }

            $stmt->close();

        } else {

            $mensaje = "Error en la consulta SQL";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Envío</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:
            linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
            url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1470&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
            padding:20px;
        }

        .contenedor{
            width:100%;
            max-width:1200px;
            display:flex;
            background:rgba(255,255,255,0.08);
            border-radius:25px;
            overflow:hidden;
            backdrop-filter: blur(12px);
            box-shadow:0 10px 35px rgba(0,0,0,0.4);
        }

        .info{
            width:45%;
            padding:50px;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
            background:linear-gradient(135deg,#0f172a,#1e293b);
        }

        .info h1{
            font-size:45px;
            margin-bottom:20px;
            font-weight:700;
            line-height:1.1;
        }

        .info p{
            font-size:16px;
            color:#d1d5db;
            line-height:1.8;
        }

        .mensajero{
            width:100%;
            margin-top:30px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
        }

        .formulario{
            width:55%;
            padding:50px;
            background:white;
        }

        .titulo{
            font-size:35px;
            color:#111827;
            margin-bottom:10px;
            font-weight:700;
        }

        .subtitulo{
            color:#6b7280;
            margin-bottom:35px;
        }

        .mensaje{
            background:#fee2e2;
            color:#b91c1c;
            padding:12px;
            border-radius:10px;
            margin-bottom:20px;
            font-size:14px;
        }

        .grupo{
            margin-bottom:22px;
        }

        .grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            color:#374151;
            font-weight:500;
        }

        input,
        textarea{
            width:100%;
            padding:15px;
            border:none;
            border-radius:14px;
            background:#f3f4f6;
            font-size:15px;
            transition:0.3s;
        }

        input:focus,
        textarea:focus{
            outline:none;
            background:white;
            border:2px solid #2563eb;
            box-shadow:0 0 10px rgba(37,99,235,0.2);
        }

        textarea{
            resize:none;
            height:120px;
        }

        .medidas{
            background:#f9fafb;
            padding:25px;
            border-radius:18px;
            margin-bottom:25px;
            border:1px solid #e5e7eb;
        }

        .medidas h3{
            margin-bottom:20px;
            color:#111827;
            font-size:20px;
        }

        .botones{
            display:flex;
            gap:15px;
            margin-top:25px;
        }

        button{
            flex:1;
            padding:15px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 20px rgba(37,99,235,0.3);
        }

        .cancelar{
            flex:1;
            text-decoration:none;
            text-align:center;
            padding:15px;
            border-radius:14px;
            background:#e5e7eb;
            color:#111827;
            font-weight:600;
            transition:0.3s;
        }

        .cancelar:hover{
            background:#d1d5db;
        }

        @media(max-width:950px){

            .contenedor{
                flex-direction:column;
            }

            .info,
            .formulario{
                width:100%;
            }

            .grid{
                grid-template-columns:1fr;
            }

            .info{
                text-align:center;
            }

            .info h1{
                font-size:35px;
            }
        }

    </style>
</head>

<body>

<div class="contenedor">

    <!-- PANEL IZQUIERDO -->
    <div class="info">

        <h1>Gestión Inteligente de Envíos</h1>

        <p>
            Administra tus paquetes de forma rápida y moderna.
            Controla medidas, peso y detalles de cada envío
            en una plataforma elegante y profesional.
        </p>

        <img 
            class="mensajero"
            src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1200&auto=format&fit=crop"
            alt="Mensajero"
        >

    </div>

    <!-- FORMULARIO -->
    <div class="formulario">

        <h2 class="titulo">Registrar Envío</h2>
        <p class="subtitulo">Ingresa los datos del paquete</p>

        <?php if ($mensaje): ?>
            <div class="mensaje">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="grupo">
                <label>Destinatario</label>
                <input 
                    type="text" 
                    name="destinatario" 
                    placeholder="Nombre del destinatario"
                    required
                >
            </div>

            <div class="grupo">
                <label>Dirección</label>
                <input 
                    type="text" 
                    name="direccion" 
                    placeholder="Dirección de entrega"
                    required
                >
            </div>

            <div class="grupo">
                <label>Descripción</label>
                <textarea 
                    name="descripcion"
                    placeholder="Descripción del paquete"
                ></textarea>
            </div>

            <!-- MEDIDAS -->
            <div class="medidas">

                <h3>📦 Medidas del Envío</h3>

                <div class="grid">

                    <div class="grupo">
                        <label>Peso (kg)</label>
                        <input 
                            type="number" 
                            step="0.01"
                            name="peso"
                            placeholder="Ej: 2.5"
                        >
                    </div>

                    <div class="grupo">
                        <label>Alto (cm)</label>
                        <input 
                            type="number" 
                            step="0.01"
                            name="alto"
                            placeholder="Ej: 40"
                        >
                    </div>

                    <div class="grupo">
                        <label>Ancho (cm)</label>
                        <input 
                            type="number" 
                            step="0.01"
                            name="ancho"
                            placeholder="Ej: 30"
                        >
                    </div>

                    <div class="grupo">
                        <label>Largo (cm)</label>
                        <input 
                            type="number" 
                            step="0.01"
                            name="largo"
                            placeholder="Ej: 60"
                        >
                    </div>

                </div>

            </div>

            <div class="botones">

                <button type="submit">
                    Guardar Envío
                </button>

                <a href="index.php" class="cancelar">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>