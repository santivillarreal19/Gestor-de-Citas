<?php
require_once('../conn/conn.php');
require_once('../model/functions.php');
require_once('../Send_Email.php');



if (!empty($name) && !empty($email) && !empty($phone)) {
    
    RegistroUsuario($conn,$name,$email,$phone);

}
else {
    echo
    '
    <script>
    alert("Hacen falta datos");
    window.location.href="../";
    </script>
    ';
}
?>