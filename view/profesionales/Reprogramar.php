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
    <title>Document</title>
</head>
<body>
    
</body>
</html>