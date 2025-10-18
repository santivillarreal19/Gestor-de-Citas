<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    if (!isset($_SESSION['rol'])) {
        header("Location: ../../");
    }
    elseif ($_SESSION['rol'] != 2) {
        header("Location: ../../");
    }

    
    $id_cita = $_GET['id_cita'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualiza el Estado la cita</title>
</head>
<body>
    <form action="../../backend/Actualizar_estado.php" method="post">
        <input type="hidden" name="id_cita" value="<?= $id_cita ?>"required>
        <select name="estado_nuevo" id=""required>
            <option value="">- - - - - Actualiza el Estado de la cita - - - - - </option>
            <?php
            require_once('../../model/functions.php');
            require_once('../../conn/conn.php');

            Estados($conn);
            ?>
        </select>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>