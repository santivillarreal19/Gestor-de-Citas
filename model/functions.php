<?php

//FUNCION PARA VALIDAR EL LOGIN
function ValidateLogin($conn,$email,$phone)
{
    //CONSULTA A LA BASE DE DATOS
    $sql = "SELECT  ur.id_user AS iduser, ur.*, u.*, r.*
            FROM usuarios_rol AS ur 
            INNER JOIN usuarios AS u ON ur.id_user = u.id_user 
            INNER JOIN roles AS r ON ur.id_rol = r.id_rol
            WHERE u.email = ? AND phone = ?";

    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$email,$phone);
    mysqli_stmt_execute($stmt);
    
    $res = mysqli_stmt_get_result($stmt);

    //SE BUSCA LOS DATOS QUE NOS DE LA CONSULTA, SI SE ENCUNETRAN EMPEZAMOS A COMPARAR POR SU ROL QUE
    // ACCION VAMOS A REALIZAR SINO SE ENCUENTRA USUARIO SE REDIRIGE AL INDEX

    if ($row = mysqli_fetch_assoc($res)) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //CAPTURAMOS EL ROL DE LA PERSONA QUE LOGUEO
        $rol = $row['id_rol'];

        if ($rol == 1) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['rol'] = $rol;
            
            header("Location:../view/Administrador/principal.php");
        }
        elseif ($rol == 2) {
            $_SESSION['iduser'] = $row['iduser'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['rol'] = $rol;
            
            
            header("Location: ../view/profesionales/principal.php");
            
        }
        elseif ($rol == 3) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['rol'] = $rol;
            
            header("Location: ../view/usuarios/principal.php");
        }
    }
    else {
        echo
        '
        <script>
        alert("Usuario no encontrado");
        window.location.href="../";
        </script>
        ';
    }
}


//FUNCION PARA MOSTRAR LAS PROFESIONES DE LA BASE DE DATOS
function SelectProfesiones($conn)
{

    //REALIZAMOS LA CONSULTA
 $sql = "SELECT * FROM especialidades";
 $res = mysqli_query($conn,$sql);

 //Y MIENTRAS ASOCIE DATOS ME LOS VA A MOSTRAR EN UN OPTION CUANDO LLAME ESTE FUNCION EN LA VISTA
 while($row = mysqli_fetch_assoc($res))
 {
    echo "<option value={$row['id_especialidad']}>{$row['especialidad']}</option>";
 }
}


//FUNCION PARA AGREGAR UNA PERSONA CON PROFESION COMO ADMINISTRADOR
function AddProfessional($conn,$name,$email,$profesion,$phone)
{
    // YA QUE VAMOS A INSERTAR UN PROFESIONAL DEBEMOS INSERTAR EN TRES TABLAS, UNA DONDE SON 
    // LOS DATOS DE LA PERSONA, LA OTRA QUE ESPECIFICA EL ROL DE LA PERSONA, Y LA TERCERA 
    // QUE AL SER PROFESIONAL ESPECIFICAMOS SU PROFESION

    $sql = "INSERT INTO usuarios (name,email,phone) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"sss",$name,$email,$phone);
    

    //A CONTINUACION HACEMOS EL SEGUNDO INSERT


    if (mysqli_stmt_execute($stmt)) {
        $iduser = mysqli_insert_id($conn);
        $idrol = 2;

        $sql1 = "INSERT INTO usuarios_rol (id_user,id_rol) VALUES (?,?)";
        $stmt1 = mysqli_prepare($conn,$sql1);
        mysqli_stmt_bind_param($stmt1,"ii",$iduser,$idrol);


        if (mysqli_stmt_execute($stmt1)) {

            //SI ESTE SEGUNDO INSERT SE REALIZO PODREMOS CONTINUAR CON EL ULTIMO, CAPTURAREMOS EL 
            // ID_USER_ROL QUE SE GENERA PARA INSERTARLO EN LA 3 TABLA CON LA ESPECIALIDAD

            $id_usrol = mysqli_insert_id($conn);

            $sql2 = "INSERT INTO profesional_especialidad (id_user_rol,id_especialidad) VALUES (?,?)";
            $stmt2 = mysqli_prepare($conn,$sql2);
            mysqli_stmt_bind_param($stmt2,"ii",$id_usrol,$profesion);

            if (mysqli_stmt_execute($stmt2)) {
                echo
                '
                <script>
                alert("Has Registrado al Profesional '.$name.'");
                window.location.href="../view/Administrador/principal.php";
                </script>
                ';
            }           
        }
    }
}


//FUNCION PARA MOSTRAR LOS PROFESIONALES DE LA ESPECIALIDAD QUE SE ESCOGIO
function MostrarProfesionales($conn,$especialidad)
{
    $sql = "SELECT pe.*, ur.*, u.*, e.*
            FROM profesional_especialidad AS pe 
            INNER JOIN usuarios_rol AS ur ON pe.id_user_rol = ur.id_user_role 
            INNER JOIN usuarios AS u ON ur.id_user = u.id_user 
            INNER JOIN especialidades AS e ON pe.id_especialidad = e.id_especialidad
            WHERE pe.id_especialidad = ?";

    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"i",$especialidad);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<option value={$row['id_profesional']}>{$row['name']}</option>";
    }
}


//FUNCION QUE AGENDA LAS CITAS DE UNA PERSONA
function AgendarCita($conn,$iduser,$profesional,$consulta,$fecha,$estado)
{

    //VAMOS A VALIDAR QUE LA CITA NO PUEDA SER AGENDADA A LA MISMA HORA QUE OTRA A UN MISMO PROFESIONAL
    $validate = "SELECT * FROM citas WHERE fecha = ? AND id_profesional = ?";
    $val = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"si",$fecha,$idprofesional);
    mysqli_stmt_execute($val);
    $res = mysqli_stmt_get_result($val);

    //SI EL SOFTWARE ENCEUNTRA UNA FILA CON LA FECHA Y HORA Y A ESE PROFESIONAL, NO PERMITE AGENDAR LA CITA
    if (mysqli_num_rows($res) > 0) {
        echo
        '
        <script>
        alert("Lo sentimos parece que el profesional ya tiene ocupada ese agenda");
        window.location.href="../view/usuarios/principal.php";
        </script>
        ';
    }

    $sql = "INSERT INTO citas (id_profesional,id_usuario,id_estado,consulta,fecha_agendada) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"iiiss",$profesional,$iduser,$estado,$consulta,$fecha);
    
    if (mysqli_stmt_execute($stmt)) {
        echo
        '
        <script>
        alert("Has Programado tu cita para el '.$fecha.'");
        window.location.href="../view/usuarios/principal.php";
        </script>
        ';
    }

}

function MisCitas($conn,$iduser)
{
   $sql = "SELECT c.*, u.*, pe.*, e.*
            FROM citas AS c 
            INNER JOIN usuarios AS u ON c.id_usuario = u.id_user 
            INNER JOIN profesional_especialidad AS pe ON c.id_profesional = pe.id_profesional 
            INNER JOIN estados AS e ON c.id_estado = e.id_estado
            WHERE id_usuario = ?";
            
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt, "i",$iduser);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    echo "
    <table>
        <tr>
            <th>Consulta</th>
            <th>Fecha Agendada</th>
            <th>Estado de la Cita</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($res)) {
        echo 
        "
        <tr>
            <td>{$row['consulta']}</td>
            <td>{$row['fecha_agendada']}</td>
            <td>{$row['estado']}</td>
        </tr>
        ";
    }
}


//ESTA FUNCION ES EL REGISTRO NORMAL, INSERTAMOS EN DOS TABLAS DIFERENTES 
function RegistroUsuario($conn,$name,$email,$phone)
{
    $sql = "INSERT INTO usuarios(name,email,phone) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"sss",$name,$email,$phone);

    if (mysqli_stmt_execute($stmt)) {

        $idresultado = mysqli_insert_id($conn);
        $idrol = 3;
        $sql1 = "INSERT INTO usuarios_rol(id_user,id_rol) VALUES (?,?)";
        $stmt1 = mysqli_prepare($conn,$sql1);
        mysqli_stmt_bind_param($stmt1,"ii",$idresultado,$idrol);

        if (mysqli_stmt_execute($stmt1)) {
            echo
            '
            <script>
            alert("Registro Exitoso");
            window.location.href="index.php";
            </script>
            ';
        }else {
            echo
            '
            <script>
            alert("Error al realizar el registro");
            window.location.href="../";
            </script>
            ';
        }
        
    }else {
        echo
        '
        <script>
        alert("Error al realizar el registro");
        window.location.href="../";
        </script>
        ';
    }
}

function TodasLasCitas($conn)
{
    $sql = "SELECT c.*, u.*, pe.*, e.*
            FROM citas AS c 
            INNER JOIN usuarios AS u ON c.id_usuario = u.id_user 
            INNER JOIN profesional_especialidad AS pe ON c.id_profesional = pe.id_profesional 
            INNER JOIN estados AS e ON c.id_estado = e.id_estado";

    $stmt = mysqli_query($conn,$sql);

    echo "
    <table border='1'>
        <tr>
            <th>Identificador de la cita</th>
            <th>Nombre de Cliente</th>
            <th>Consulta</th>
            <th>Fecha Agendada</th>
            <th>Estado de la Cita</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($stmt)) {
        echo 
        "
        <tr>
            <td>{$row['id_cita']}</td>
            <td>{$row['name']}</td>
            <td>{$row['consulta']}</td>
            <td>{$row['fecha_agendada']}</td>
            <td>{$row['estado']}</td>
        </tr>

        </table>
        ";
    }

    

}

function CitasAsignadas($conn,$idprofesional)
{
    $sql = "SELECT c.*, u.*, pe.*, e.*
            FROM citas AS c 
            INNER JOIN usuarios AS u ON c.id_usuario = u.id_user 
            INNER JOIN profesional_especialidad AS pe ON c.id_profesional = pe.id_profesional 
            INNER JOIN estados AS e ON c.id_estado = e.id_estado
            WHERE c.id_profesional = ?";

    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"i",$idprofesional);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

            echo "
    <table border='1'>
        <tr>
            <th>Identificador de la cita</th>
            <th>Nombre de Cliente</th>
            <th>Consulta</th>
            <th>Fecha Agendada</th>
            <th>Estado de la Cita</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($res)) {
        echo 
        "
        <tr>
            <td>{$row['id_cita']}</td>
            <td>{$row['name']}</td>
            <td>{$row['consulta']}</td>
            <td>{$row['fecha_agendada']}</td>
            <td>{$row['estado']}</td>
            <td><a href='CambiarEstado.php?id_cita=".$row['id_cita']."'>Actualizar Estado</a></td>
            <td><a href='Reprogramar.php?id_cita=".$row['id_cita']."'>reprogramar Cita</a></td>
        </tr>

        </table>
        ";
    }



}

//FUNCION PARA MOSTRAR LOS DIFERENTES ESTADOS DE LAS CITAS
function Estados($conn)
{
    $sql = "SELECT * FROM estados";

    $res = mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<option value={$row['id_estado']}>{$row['estado']}</option>";
    }
}

//FUNCION PARA ACTUALZIAR LOS ESTADOS DE LAS CITAS
function ActualizarEstado($conn,$estado,$id_cita)
{
    $sql = "UPDATE citas SET id_estado = ? WHERE id_cita = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ii",$estado,$id_cita);
    
    if (mysqli_stmt_execute($stmt)) {
        echo
        '
        <script>
        alert("Has Actualizado Tu cita con exito");
        window.location.href="../view/profesionales/principal.php";
        </script>
        ';
    }
    else {
        echo
        '
        <script>
        alert("Has Actualizado Tu cita con exito");
        window.location.href="../view/profesionales/principal.php";
        </script>
        ';
    }
}
?>