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
    elseif ($_SESSION['rol'] != 1) {
        '
        <script>
        alert("Acceso Denegado");
        window.location.href="../../";
        </script>
        ';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrega un Profesional</title>
</head>
<body>
    <form action="../../backend/Add_Professional.php" method="post">
        <span>Nombre de Personal:</span><br>
        <input type="text" name="name" placeholder="Escribe nombre del profesional" required><br><br>

        <span>Seleccione Profesión:</span><br>
        <select name="profesion" id="profesion" required>
            <option value="">- -  - - Selecciona Profesión - - - - - </option>
            <?php
            require_once('../../conn/conn.php');
            require_once('../../model/functions.php');

            SelectProfesiones($conn);
            ?>
        </select><br><br>

        <span>Correo de la Persona:</span><br>
        <input type="email" name="email" placeholder="Ingresa el correo electrónico" required><br><br>

        <span>Telefono:</span><br>
        <input type="number" name="phone" id="phone" placeholder="Ingresa el telefono" required><br><br>

        <button type="submit">Realizar registro</button>


    </form>
</body>
</html>