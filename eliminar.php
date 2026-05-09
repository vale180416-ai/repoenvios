<?php
include 'conexion.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM envios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$envio = $result->fetch_assoc();

if (!$envio) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmtDelete = $conn->prepare("DELETE FROM envios WHERE id = ?");
    $stmtDelete->bind_param("i", $id);

    if ($stmtDelete->execute()) {
        header("Location: index.php?msg=eliminado");
        exit();
    }

    $error = "No se pudo eliminar el envío.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Eliminar Envío</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#0f172a,#1e293b);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family: 'Segoe UI', sans-serif;
}

.card-delete{
    width:420px;
    border:none;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.4);
    background:white;
    animation:fadeIn .8s ease;
}

.header-img{
    height:220px;
    background:url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1200&auto=format&fit=crop') center/cover;
    position:relative;
}

.overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.45);
    display:flex;
    justify-content:center;
    align-items:center;
}

.overlay h1{
    color:white;
    font-size:2rem;
    font-weight:bold;
}

.content{
    padding:30px;
    text-align:center;
}

.icon-warning{
    width:90px;
    margin-top:-70px;
    border-radius:50%;
    border:5px solid white;
    background:white;
}

.btn-delete{
    background:#ef4444;
    border:none;
    padding:12px;
    font-weight:bold;
    transition:.3s;
}

.btn-delete:hover{
    background:#dc2626;
    transform:scale(1.03);
}

.btn-cancel{
    padding:12px;
    font-weight:bold;
}

.data-box{
    background:#f8fafc;
    border-radius:15px;
    padding:15px;
    margin:20px 0;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>
</head>
<body>

<div class="card-delete">

    <div class="header-img">
        <div class="overlay">
            <h1>Eliminar Envío</h1>
        </div>
    </div>

    <div class="content">

        <img 
        class="icon-warning"
        src="https://cdn-icons-png.flaticon.com/512/1828/1828843.png"
        alt="Eliminar">

        <h3 class="mt-3 text-danger fw-bold">
            ¿Deseas eliminar este envío?
        </h3>

        <div class="data-box">
            <p class="mb-1"><strong>ID:</strong> <?= $envio['id'] ?></p>
            <p class="mb-1"><strong>Cliente:</strong> <?= htmlspecialchars($envio['cliente']) ?></p>
            <p class="mb-0"><strong>Destino:</strong> <?= htmlspecialchars($envio['destino']) ?></p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="d-grid gap-2">

                <button type="submit" class="btn btn-delete text-white">
                    🗑️ Sí, eliminar
                </button>

                <a href="index.php" class="btn btn-outline-secondary btn-cancel">
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>