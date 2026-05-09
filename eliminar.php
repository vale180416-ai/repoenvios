<?php
include 'conexion.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit();
}

/* =========================
   ELIMINAR REGISTRO
========================= */
if (isset($_POST['eliminar'])) {

    $stmt = $conn->prepare("DELETE FROM envios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?delete=success");
        exit();
    }

    $error = "No se pudo eliminar el envío.";
}

/* =========================
   OBTENER DATOS
========================= */
$stmtInfo = $conn->prepare("SELECT * FROM envios WHERE id = ?");
$stmtInfo->bind_param("i", $id);
$stmtInfo->execute();

$result = $stmtInfo->get_result();
$envio = $result->fetch_assoc();

if (!$envio) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Eliminar Envío</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Poppins',sans-serif;
    overflow:hidden;
    position:relative;
    background:#0f172a;
}

/* GIF DE FONDO */

.bg-gif{
    position:absolute;
    width:100%;
    height:100%;
    object-fit:cover;
    z-index:-2;
    filter:brightness(.35);
}

/* OVERLAY */

.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        135deg,
        rgba(15,23,42,.7),
        rgba(30,41,59,.8),
        rgba(88,28,135,.7)
    );
    z-index:-1;
}

/* CARD MODERNA */

.delete-card{
    width:450px;
    border-radius:30px;
    overflow:hidden;
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,.15);
    box-shadow:0 15px 40px rgba(0,0,0,.45);
    animation:showCard .8s ease;
}

/* GIF SUPERIOR */

.top-gif{
    width:100%;
    height:240px;
    object-fit:cover;
    border-bottom:1px solid rgba(255,255,255,.1);
}

/* CONTENIDO */

.content{
    padding:30px;
    color:white;
    text-align:center;
}

.content h1{
    font-size:2rem;
    font-weight:700;
    margin-bottom:10px;
}

.subtitle{
    color:#cbd5e1;
    margin-bottom:25px;
}

/* INFO BOX */

.info-box{
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:20px;
    text-align:left;
    margin-bottom:25px;
}

.info-box p{
    margin-bottom:12px;
    font-size:15px;
    color:#f1f5f9;
}

.info-box strong{
    color:#38bdf8;
}

/* BOTONES */

.btn-delete{
    background:linear-gradient(135deg,#ff416c,#ff4b2b);
    border:none;
    padding:14px;
    border-radius:15px;
    font-weight:600;
    transition:.3s;
    box-shadow:0 8px 20px rgba(255,75,43,.35);
}

.btn-delete:hover{
    transform:translateY(-3px) scale(1.02);
    background:linear-gradient(135deg,#ff2d55,#ff3d00);
}

.btn-back{
    padding:13px;
    border-radius:15px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.1);
    color:white;
    transition:.3s;
}

.btn-back:hover{
    background:rgba(255,255,255,.15);
    color:white;
}

/* ALERTA */

.alert{
    border-radius:15px;
}

/* ANIMACION */

@keyframes showCard{
    from{
        opacity:0;
        transform:translateY(40px) scale(.95);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

</style>
</head>
<body>

<!-- GIF FONDO -->
<img
class="bg-gif"
src="https://media.giphy.com/media/3o7TKtnuHOHHUjR38Y/giphy.gif"
alt="Background">

<div class="overlay"></div>

<!-- CARD -->
<div class="delete-card">

    <!-- GIF SUPERIOR -->
    <img
    class="top-gif"
    src="https://media.giphy.com/media/l3vR85PnGsBwu1PFK/giphy.gif"
    alt="Delete Gif">

    <div class="content">

        <h1>Eliminar Envío</h1>

        <p class="subtitle">
            Estás a punto de eliminar este registro permanentemente.
        </p>

        <!-- INFO -->
        <div class="info-box">

            <p>
                <strong>ID:</strong>
                <?= $envio['id'] ?>
            </p>

            <p>
                <strong>Cliente:</strong>
                <?= htmlspecialchars($envio['cliente']) ?>
            </p>

            <p>
                <strong>Destino:</strong>
                <?= htmlspecialchars($envio['destino']) ?>
            </p>

        </div>

        <?php if(isset($error)): ?>

            <div class="alert alert-danger">
                <?= $error ?>
            </div>

        <?php endif; ?>

        <!-- FORM -->
        <form method="POST">

            <div class="d-grid gap-3">

                <button
                    type="submit"
                    name="eliminar"
                    class="btn btn-delete text-white">

                    🗑️ Eliminar Ahora

                </button>

                <a href="index.php"
                   class="btn btn-back">

                    ← Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>