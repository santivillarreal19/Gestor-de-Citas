<?php

require_once('../../conn/conn.php');


    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    if (!isset($_SESSION['rol'])) {
        header("Location: ../../");
    }
    elseif ($_SESSION['rol'] != 2) {
        header("Location: ../../");
    }


    $name = $_SESSION['name'];
    $iduser = $_SESSION['iduser'];
    

    //ESTA CONSULTA EN LA VISTA SE VA A REALIZAR PARA PODER CONSEGUIR EL ID DEL USUARIO ROL Y CON ESE ID 
    // USUARIO ROL PODAMOS CONSEGUIR EL ID DEL PROFESIONAL Y MANDARLO A LAS FUNCIONES PARA TRAER LAS 
    // CITAS ASIGNADAS
    $sql = "SELECT * FROM usuarios_rol WHERE id_user = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"i",$iduser);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($res)) {
        $id_user_rol = $row['id_user_role'];
    }

    $sql1 = "SELECT * FROM profesional_especialidad WHERE id_user_rol = ?";
    $stmt1 = mysqli_prepare($conn,$sql1);
    mysqli_stmt_bind_param($stmt1,"i",$id_user_rol);
    mysqli_stmt_execute($stmt1);

    $res1 = mysqli_stmt_get_result($stmt1);

    while ($row1 = mysqli_fetch_assoc($res1)) {
        $idprofesional = $row1['id_profesional'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Pagina Profesionales</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="">Estadisticas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li>
                </ul>
                <span class="navbar-text">
                Bienvenido a la vista de profesionales
                </span>
            </div>
        </nav>
        <h4>Bienvenido</h4> <h2><?php echo $name ?></h2>

        <?php
        require_once('../../model/functions.php');
        require_once('../../conn/conn.php');

        CitasAsignadas($conn,$idprofesional);
        ?>
</body>
</html>