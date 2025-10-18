<?php
require_once('../conn/conn.php');
require_once('../model/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $iduser = $_POST['iduser'];
    $profesional = $_POST['profesional'];
    $consulta = $_POST['consulta'];
    $fecha = $_POST['fecha'];
    $estado = 5;
}

$fecha_actual = date('Y-m-d');

if ($fecha < $fecha_actual) {
    echo
    '
    <script>
    alert("oops parece que has ingresado una fecha que no se permite");
    window.location.href="../view/usuarios/principal.php";
    </script>
    ';
}

if (!empty($iduser) && !empty($profesional) && !empty($consulta) && !empty($fecha)) {
    AgendarCita($conn,$iduser,$profesional,$consulta,$fecha,$estado);
}
else {
    echo
    '
    <script>
    alert("Faltan Datos");
    window.location.href="../view/usuarios/principal.php";
    </script>
    ';
}
?>