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

    $especialidad = $_POST['especialidad'] ?? null;
    $iduser = $_POST['iduser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segunda Fase - Especialista y agendar</title>
</head>
<body>
    <form action="../../backend/Agendacion.php" method="post">

        <span>A continuanción, esocge un profesional de la categoria que seleccionaste</span><br>
        <select name="profesional" id="" required>
            <option value="">- - - - - Escoge Profesional - - - - - - </option>
            <?php
            require_once('../../conn/conn.php');
            require_once('../../model/functions.php');

            MostrarProfesionales($conn,$especialidad);
            ?>
        </select><br><br>
        <input type="hidden" name="iduser" value="<?= $iduser ?>">

        <span>A que se debe tu consulta</span><br>
        <textarea name="consulta" id="" cols="40" rows="8" required></textarea><br><br>

        <span>Agenda la fecha para tu cita</span><br>
        <input type="datetime-local" name="fecha" id="" required><br><br>

        <button type="submit">Solicitar Agenda</button>
    </form>
</body>
</html>