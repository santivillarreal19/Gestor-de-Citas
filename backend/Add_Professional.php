<?php
require_once('../conn/conn.php');
require_once('../model/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'] ?? null;
    $profesion = $_POST['profesion'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
}

if (!empty($email) && !empty($phone) && !empty($name) && !empty($profesion)) {

    AddProfessional($conn,$name,$email,$profesion,$phone);

}
else {
    echo
            '
            <script>
            alert("Faltan Datos");
            window.location.href="../view/Administrador/principal.php";
            </script>
            ';
}
?>