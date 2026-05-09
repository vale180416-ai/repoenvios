<?php 
include 'conexion.php';

$id = intval($_GET['id'] ?? 0);
$mensaje = '';
$data = null;

if ($id <= 0) {
    die('ID inválido');
}

$stmt = $conn->prepare("SELECT * FROM envios WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$data = $res->fetch_assoc();
$stmt->close();

if (!$data) {
    die('Envío no encontrado');
}

if ($_POST) {
    $dest = trim($_POST['destinatario'] ?? '');
    $dir = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');
    
    if (empty($dest) || empty($dir)) {
        $mensaje = 'El destinatario y dirección son obligatorios';
    } else {

        $stmt = $conn->prepare("
            UPDATE envios 
            SET destinatario=?, direccion=?, descripcion=? 
            WHERE id=?
        ");

        $stmt->bind_param('sssi', $dest, $dir, $desc, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $mensaje = 'Error al actualizar: ' . $conn->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Envío | CourierApp</title>

    <!-- Fuente moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins', sans-serif;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;

            /* GIF DE FONDO */
            background:url('https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif');
            background-size:cover;
            background-position:center;
            position:relative;
        }

        /* Capa oscura elegante */
        body::before{
            content:'';
            position:absolute;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.65);
            backdrop-filter:blur(4px);
        }

        .contenedor{
            position:relative;
            z-index:2;
            width:420px;
            background:rgba(255,255,255,0.12);
            border:1px solid rgba(255,255,255,0.2);
            backdrop-filter:blur(15px);
            padding:35px;
            border-radius:20px;
            box-shadow:0 8px 32px rgba(0,0,0,0.4);
            animation:entrada 1s ease;
        }

        @keyframes entrada{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        h2{
            color:white;
            text-align:center;
            margin-bottom:25px;
            font-size:28px;
            font-weight:600;
        }

        .icono{
            text-align:center;
            font-size:55px;
            color:#a855f7;
            margin-bottom:15px;
        }

        .mensaje{
            background:#ff4d4d;
            color:white;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            text-align:center;
        }

        .grupo{
            margin-bottom:18px;
        }

        label{
            display:block;
            color:white;
            margin-bottom:6px;
            font-size:14px;
        }

        input,
        textarea{
            width:100%;
            padding:14px;
            border:none;
            outline:none;
            border-radius:12px;
            background:rgba(255,255,255,0.15);
            color:white;
            font-size:15px;
            font-family:'Poppins', sans-serif;
        }

        input::placeholder,
        textarea::placeholder{
            color:#ddd;
        }

        textarea{
            resize:none;
            height:110px;
        }

        .botones{
            display:flex;
            justify-content:space-between;
            margin-top:20px;
        }

        button{
            flex:1;
            margin-right:10px;
            background:linear-gradient(135deg,#9333ea,#7e22ce);
            color:white;
            border:none;
            padding:14px;
            border-radius:12px;
            cursor:pointer;
            font-size:15px;
            font-weight:600;
            transition:0.3s;
        }

        button:hover{
            transform:scale(1.03);
            box-shadow:0 0 15px rgba(168,85,247,0.6);
        }

        .cancelar{
            flex:1;
            text-align:center;
            background:rgba(255,255,255,0.15);
            color:white;
            padding:14px;
            border-radius:12px;
            text-decoration:none;
            transition:0.3s;
        }

        .cancelar:hover{
            background:rgba(255,255,255,0.25);
        }

    </style>
</head>

<body>

    <div class="contenedor">

        <div class="icono">
            <i class="fas fa-box-open"></i>
        </div>

        <h2>Editar Envío</h2>

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
                    value="<?php echo htmlspecialchars($data['destinatario']); ?>"
                    required
                >
            </div>

            <div class="grupo">
                <label>Dirección</label>
                <input 
                    type="text"
                    name="direccion"
                    value="<?php echo htmlspecialchars($data['direccion']); ?>"
                    required
                >
            </div>

            <div class="grupo">
                <label>Descripción</label>
                <textarea name="descripcion"><?php echo htmlspecialchars($data['descripcion']); ?></textarea>
            </div>

            <div class="botones">
                <button type="submit">
                    <i class="fas fa-save"></i> Actualizar
                </button>

                <a href="index.php" class="cancelar">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

</body>
</html>