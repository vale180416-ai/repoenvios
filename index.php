<?php
// CONEXIÓN MYSQL
$conexion = new mysqli("localhost", "root", "", "gestion_envios");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// GUARDAR ENVÍO
if (isset($_POST['guardar'])) {

    $cliente   = $_POST['cliente'];
    $direccion = $_POST['direccion'];
    $telefono  = $_POST['telefono'];
    $guia      = $_POST['guia'];
    $estado    = $_POST['estado'];

    $sql = "INSERT INTO envios(cliente,direccion,telefono,guia,estado)
            VALUES('$cliente','$direccion','$telefono','$guia','$estado')";

    $conexion->query($sql);

    header("Location:index.php");
}

// ELIMINAR ENVÍO
if (isset($_GET['eliminar'])) {

    $id = $_GET['eliminar'];

    $conexion->query("DELETE FROM envios WHERE id=$id");

    header("Location:index.php");
}

// LISTAR ENVÍOS
$envios = $conexion->query("SELECT * FROM envios ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestión de Envíos</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
            min-height:100vh;
            overflow-x:hidden;
            padding:30px;
            position:relative;
        }

        /* FONDO ANIMADO */

        .fondo-animado{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            overflow:hidden;
            z-index:-1;
        }

        .caja{
            position:absolute;
            width:90px;
            opacity:0.15;
            animation:mover linear infinite;
        }

        .caja1{
            left:10%;
            animation-duration:15s;
        }

        .caja2{
            left:45%;
            width:130px;
            animation-duration:20s;
        }

        .caja3{
            left:80%;
            width:100px;
            animation-duration:17s;
        }

        @keyframes mover{

            0%{
                transform:translateY(100vh) rotate(0deg);
            }

            100%{
                transform:translateY(-120vh) rotate(360deg);
            }
        }

        /* CONTENEDOR */

        .contenedor{
            max-width:1200px;
            margin:auto;
        }

        .titulo{
            text-align:center;
            color:white;
            margin-bottom:30px;
            font-size:45px;
            font-weight:bold;
            letter-spacing:2px;
            text-shadow:0 5px 15px rgba(0,0,0,0.3);
        }

        .card{
            background:rgba(255,255,255,0.95);
            border-radius:25px;
            padding:30px;
            margin-bottom:30px;
            box-shadow:0 15px 40px rgba(0,0,0,0.25);
            backdrop-filter:blur(10px);
        }

        /* FORMULARIO */

        .formulario{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }

        input, select{

            width:100%;
            padding:15px;
            border-radius:15px;
            border:1px solid #ddd;
            font-size:15px;
            transition:0.3s;
            outline:none;
        }

        input:focus,
        select:focus{
            border-color:#2c5364;
            box-shadow:0 0 10px rgba(44,83,100,0.3);
        }

        .btn{

            background:linear-gradient(135deg,#11998e,#38ef7d);
            color:white;
            border:none;
            padding:15px;
            border-radius:15px;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 20px rgba(0,0,0,0.2);
        }

        /* TABLA */

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:20px;
        }

        table thead{
            background:#203a43;
            color:white;
        }

        table th{
            padding:18px;
            font-size:15px;
        }

        table td{
            padding:16px;
            text-align:center;
        }

        table tbody tr{
            background:#f8f9fa;
            border-bottom:1px solid #ddd;
            transition:0.3s;
        }

        table tbody tr:hover{
            background:#e3f2fd;
            transform:scale(1.01);
        }

        /* ESTADOS */

        .estado{
            padding:8px 15px;
            border-radius:30px;
            color:white;
            font-size:13px;
            font-weight:bold;
        }

        .pendiente{
            background:#f39c12;
        }

        .transito{
            background:#3498db;
        }

        .entregado{
            background:#2ecc71;
        }

        /* BOTÓN ELIMINAR */

        .eliminar{
            background:#e74c3c;
            color:white;
            text-decoration:none;
            padding:10px 15px;
            border-radius:10px;
            transition:0.3s;
            font-size:14px;
        }

        .eliminar:hover{
            background:#c0392b;
        }

        /* RESPONSIVE */

        @media(max-width:768px){

            body{
                padding:15px;
            }

            .titulo{
                font-size:30px;
            }

            table{
                font-size:12px;
            }

            table th,
            table td{
                padding:10px;
            }
        }

    </style>

</head>

<body>

    <!-- IMÁGENES EN MOVIMIENTO -->

    <div class="fondo-animado">

        <img src="https://cdn-icons-png.flaticon.com/512/679/679720.png" class="caja caja1">

        <img src="https://cdn-icons-png.flaticon.com/512/679/679720.png" class="caja caja2">

        <img src="https://cdn-icons-png.flaticon.com/512/679/679720.png" class="caja caja3">

    </div>

    <div class="contenedor">

        <h1 class="titulo">📦 Gestión de Envíos</h1>

        <!-- FORMULARIO -->

        <div class="card">

            <form method="POST" class="formulario">

                <input type="text"
                       name="cliente"
                       placeholder="Nombre del Cliente"
                       required>

                <input type="text"
                       name="direccion"
                       placeholder="Dirección"
                       required>

                <input type="text"
                       name="telefono"
                       placeholder="Teléfono"
                       required>

                <input type="text"
                       name="guia"
                       placeholder="Número de Guía"
                       required>

                <select name="estado" required>

                    <option value="">Estado del Envío</option>

                    <option value="Pendiente">Pendiente</option>

                    <option value="En tránsito">En tránsito</option>

                    <option value="Entregado">Entregado</option>

                </select>

                <button type="submit"
                        name="guardar"
                        class="btn">

                    Guardar Envío

                </button>

            </form>

        </div>

        <!-- TABLA -->

        <div class="card">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Guía</th>
                        <th>Estado</th>
                        <th>Acción</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($fila = $envios->fetch_assoc()) { ?>

                        <tr>

                            <td><?= $fila['id'] ?></td>

                            <td><?= $fila['cliente'] ?></td>

                            <td><?= $fila['direccion'] ?></td>

                            <td><?= $fila['telefono'] ?></td>

                            <td><?= $fila['guia'] ?></td>

                            <td>

                                <?php

                                    $clase = '';

                                    if($fila['estado'] == 'Pendiente'){

                                        $clase = 'pendiente';

                                    }elseif($fila['estado'] == 'En tránsito'){

                                        $clase = 'transito';

                                    }else{

                                        $clase = 'entregado';
                                    }

                                ?>

                                <span class="estado <?= $clase ?>">

                                    <?= $fila['estado'] ?>

                                </span>

                            </td>

                            <td>

                                <a class="eliminar"
                                   href="index.php?eliminar=<?= $fila['id'] ?>">

                                    Eliminar

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>