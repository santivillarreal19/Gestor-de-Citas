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
    <title>Primera Fase - Escoge especialidad</title>
</head>
<body>
    <form action="AgendarCita2.php" method="post">
        <label for="">Selecciona el tipo de profesional que necesitas para tu consulta</label><br>
        <select name="especialidad" id="" required>
            <option value="">- - - -  Esocge el tipo de profesional - - - - - </option>
            <?php
            require_once('../../conn/conn.php');
            require_once('../../model/functions.php');

            SelectProfesiones($conn);
            ?>
        </select>
        <input type="hidden" name="iduser" value="<?= $iduser ?>">
        <button type="submit">Continuar</button>
    </form>
</body>
</html>