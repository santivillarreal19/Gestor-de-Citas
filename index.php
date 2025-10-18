<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incio de Sesión</title>
</head>
<body>
    <form action="backend/validate.php" method="post">
        <input type="email" name="email" id="email" placeholder="Ingresa tu correo electrónico" required><br>
        <input type="number" name="phone" id="phone" placeholder="Ingresa tu número telefónico" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
    <span>No tienes cuenat aún? </span><a href="view/Registro.php">Registrate</a>
</body>
</html>