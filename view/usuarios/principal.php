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

    $name = $_SESSION['name'];
    $iduser = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Bienvenido</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="AgendarCita.php?iduser=<?= $iduser ?>">Agendar cita<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="MisCitas.php?iduser=<?= $iduser ?>">Mis Citas</a>
                </li>
                
                </ul>
                <span class="navbar-text">
                Bienvenido a nuestro software
                </span>
            </div>
        </nav>
    <h3>Bienvenido <?php echo $name ?></h3>
</body>
</html>