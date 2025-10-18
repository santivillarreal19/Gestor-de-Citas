<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    if (!isset($_SESSION['rol'])) {
        echo
        '
        <script>
        alert("Acceso Denegado");
        window.location.href="../../";
        </script>
        ';
    }
    elseif ($_SESSION['rol'] != 3) {
        '
        <script>
        alert("Acceso Denegado");
        window.location.href="../../";
        </script>
        ';
    }
    $iduser = $_GET['iduser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
</head>
<body>
    <?php
    require_once('../../conn/conn.php');
    require_once('../../model/functions.php');

    MisCitas($conn,$iduser);
    ?>
</body>
</html>