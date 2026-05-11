<?php  
include 'conexion.php';

$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dest = trim($_POST['destinatario'] ?? '');
    $dir  = trim($_POST['direccion'] ?? '');
    $desc = trim($_POST['descripcion'] ?? '');

    if (empty($dest) || empty($dir)) {

        $mensaje = '⚠️ El destinatario y dirección son obligatorios';
        $tipoMensaje = 'danger';

    } else {

        $stmt = $conn->prepare("INSERT INTO envios (destinatario, direccion, descripcion) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $dest, $dir, $desc);

        if ($stmt->execute()) {

            $mensaje = '✅ Envío registrado correctamente';
            $tipoMensaje = 'success';

        } else {

            $mensaje = '❌ Error al guardar: ' . $conn->error;
            $tipoMensaje = 'danger';
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
    <title>PannyPan | Crear Envío</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            min-height:100vh;
            background:
            linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
            url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1400&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px;
        }

        .card-modern{
            width:100%;
            max-width:550px;
            border:none;
            border-radius:25px;
            backdrop-filter: blur(15px);
            background: rgba(255,255,255,0.12);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            overflow:hidden;
        }

        .header-box{
            background: linear-gradient(135deg,#ff9800,#ff5722);
            padding:35px;
            text-align:center;
            color:white;
        }

        .header-box img{
            width:90px;
            margin-bottom:10px;
        }

        .header-box h2{
            font-weight:700;
            margin:0;
        }

        .form-container{
            padding:35px;
            color:white;
        }

        .form-label{
            font-weight:500;
        }

        .form-control{
            border-radius:15px;
            border:none;
            padding:14px;
            background: rgba(255,255,255,0.85);
        }

        .form-control:focus{
            box-shadow:0 0 10px rgba(255,152,0,.7);
            border:none;
        }

        .btn-modern{
            border-radius:15px;
            padding:12px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-save{
            background: linear-gradient(135deg,#00c853,#009624);
            border:none;
            color:white;
        }

        .btn-save:hover{
            transform:translateY(-2px);
            box-shadow:0 5px 15px rgba(0,200,83,.5);
        }

        .btn-cancel{
            background:#6c757d;
            border:none;
            color:white;
        }

        .btn-cancel:hover{
            background:#5a6268;
        }

        .icon-input{
            position:relative;
        }

        .icon-input i{
            position:absolute;
            top:50%;
            left:15px;
            transform:translateY(-50%);
            color:#ff5722;
            font-size:18px;
        }

        .icon-input input,
        .icon-input textarea{
            padding-left:45px;
        }

        .alert{
            border-radius:15px;
        }

        .footer-text{
            text-align:center;
            color:#ddd;
            font-size:14px;
            margin-top:15px;
        }

    </style>
</head>

<body>

    <div class="card-modern">

        <!-- HEADER -->
        <div class="header-box">

            <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="logo">

            <h2><i class="bi bi-box-seam"></i> Crear Envío</h2>

            <p class="mt-2 mb-0">
                Gestión moderna de envíos PannyPan
            </p>

        </div>

        <!-- FORMULARIO -->
        <div class="form-container">

            <?php if ($mensaje): ?>

                <div class="alert alert-<?php echo $tipoMensaje; ?>">

                    <?php echo htmlspecialchars($mensaje); ?>

                </div>

            <?php endif; ?>

            <form method="POST" class="needs-validation" novalidate>

                <!-- DESTINATARIO -->
                <div class="mb-4">

                    <label class="form-label">
                        Destinatario
                    </label>

                    <div class="icon-input">

                        <i class="bi bi-person-fill"></i>

                        <input 
                            type="text"
                            name="destinatario"
                            class="form-control"
                            placeholder="Ingresa el nombre"
                            required
                        >

                    </div>

                    <div class="invalid-feedback">
                        Por favor ingresa el destinatario.
                    </div>

                </div>

                <!-- DIRECCIÓN -->
                <div class="mb-4">

                    <label class="form-label">
                        Dirección
                    </label>

                    <div class="icon-input">

                        <i class="bi bi-geo-alt-fill"></i>

                        <input 
                            type="text"
                            name="direccion"
                            class="form-control"
                            placeholder="Ingresa la dirección"
                            required
                        >

                    </div>

                    <div class="invalid-feedback">
                        La dirección es obligatoria.
                    </div>

                </div>

                <!-- DESCRIPCIÓN -->
                <div class="mb-4">

                    <label class="form-label">
                        Descripción
                    </label>

                    <div class="icon-input">

                        <i class="bi bi-card-text"></i>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="4"
                            placeholder="Describe el envío..."
                        ></textarea>

                    </div>

                </div>

                <!-- BOTONES -->
                <div class="d-grid gap-3">

                    <button type="submit" class="btn btn-modern btn-save">

                        <i class="bi bi-check-circle-fill"></i>
                        Guardar Envío

                    </button>

                    <a href="index.php" class="btn btn-modern btn-cancel">

                        <i class="bi bi-arrow-left-circle-fill"></i>
                        Cancelar

                    </a>

                </div>

            </form>

            <div class="footer-text">

                🚚 Sistema inteligente de logística y entregas

            </div>

        </div>

    </div>

    <!-- Validación Bootstrap -->
    <script>

        (() => {

            'use strict';

            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {

                form.addEventListener('submit', event => {

                    if (!form.checkValidity()) {

                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');

                }, false);

            });

        })();

    </script>

</body>
</html>