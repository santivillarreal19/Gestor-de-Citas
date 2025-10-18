<?php

//REQUERIMOS LA CONEXION Y EL MODELO PARA LLAMAR LAS FUNCIONES QUE CONECTAN A LA BASE DE DATOS

require_once('../conn/conn.php');
require_once('../model/functions.php');

//POR SEGURIDAD ESPECIFICAMOS QUE EL METODO DE ENVIO DE DATOS
//  DEBE SER POST Y CAPTURAMOS LOS VALORES DE LOS INPUT

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
}

//SI DE ALGUNA MANERA LOS DATOS SON VACIOS O NULOS SE DEVOLVERA AL INDEX SINO, SE EJECUTA LA VALIDACION
if (!empty($email) && !empty($phone)) {

    ValidateLogin($conn,$email,$phone);

}
else {
    echo 
    '
    <script>
    alert("Lo sentimos, faltan datos");
    window.location.href="../";
    </script>
    ';
}
?>