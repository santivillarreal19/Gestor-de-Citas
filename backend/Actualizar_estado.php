<?php
require_once('../conn/conn.php');
require_once('../model/functions.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $estado = $_POST['estado_nuevo'] ?? null;
    $id_cita = $_POST['id_cita'] ?? null;
}

if (!empty($estado)) {

    ActualizarEstado($conn,$estado,$id_cita);

}
else {
    echo
            '
            <script>
            alert("Faltan Datos");
            window.location.href="../view/profesionales/principal.php";
            </script>
            ';
}
?>