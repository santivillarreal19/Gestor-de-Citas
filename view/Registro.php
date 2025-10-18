<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Principal</title>
</head>
<body>
    <form action="../Send_Email.php" method="post">
        <span>Escribe tu nombre completo:</span><br>
        <input type="text" name="name" placeholder="Escribe tu nombre" required><br><br>

        <span>Correo Electrónico:</span><br>
        <input type="email" name="email" placeholder="Ingresa Correo Electrónico" required><br><br>

        <span>Número telefónico:</span><br>
        <input type="number" name="phone" placeholder="Digite su número telefónico" required><br>

        <button type="submit">Registrarme</button>
    </form>
</body>
</html>