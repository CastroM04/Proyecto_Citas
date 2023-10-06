<?php
$CorreoUser = "";
$S_User = "";
$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");
$CorreoUser = $_SESSION['usuario'];

$Analizar = $link->query("SELECT * FROM empleados WHERE Correo='$CorreoUser'");

$UserData = mysqli_fetch_assoc($Analizar);
$S_User = $UserData['FK_personal'];

if (isset($_POST['RegistrarEmpleado'])) {

    $Especialidad = $_POST['Razon_social'];
    $Nombres = $_POST['Nombres'];
    $Apellidos = $_POST['Apellidos'];
    $identificacion = $_POST['identificacion'];
    $Genero = $_POST['Genero'];
    $Direccion = $_POST['Direccion'];
    $Numero = $_POST['Numero'];
    $Correo = $_POST['email'];
    $Contraseña = $_POST['password'];
    $Rol = $_POST['roles'];
    $Estado = "1";

    if (!empty($Especialidad) && !empty($Nombres) && !empty($identificacion) && !empty($Genero) && !empty($Direccion) && !empty($Numero) && !empty($Correo) && !empty($Contraseña)) {

        $Insertar = $link->query("INSERT INTO tbl_personal (N_identificacion ,Razon_social,Nombres, Apellidos, Genero, Direccion, Numero) 
    VALUES ($identificacion,'$Especialidad','$Nombres','$Apellidos','$Genero','$Direccion','$Numero')");

        $Comprobacion = $link->query("SELECT * FROM tbl_personal WHERE N_identificacion =$identificacion");
        if ($Comprobacion->num_rows > 0) {
            while ($row = $Comprobacion->fetch_assoc()) {

                $Primary = $row['PK_codigo_pe'];
            }

            $hash_contraseña = password_hash($Contraseña, PASSWORD_DEFAULT);

            $Guardar = $link->query("INSERT INTO empleados (Correo, Contraseña, FK_personal, FK_rol, FK_Estado) VALUES('$Correo','$hash_contraseña','$Primary',$Rol,'$Estado')");
            //    $_SESSION['message'] = 'Empleado guardado exitosamente';
            //   $_SESSION['message_type'] = 'success';

            $Especialidad = "";
            $Nombres = "";
            $Apellidos = "";
            $identificacion = "";
            $Genero = "";
            $Direccion = "";
            $Numero = "";
            $Correo = "";
            $Contraseña = "";
            $Rol = "";

            header("location: dashboard.php?message=El empleado ha sido guardado exitosamente&message_type=success");
        } else {
            $delete = $link->query("DELETE FROM tbl_personal where N_identificacion=$identificacion");
        }
    }
}

/* Si existe el id del empleado a eliminar */
if (isset($_GET['id']) && $_GET['Eliminar'] == "true") {

    $id = $_GET['id'];
    if ($S_User !=  $id) {


        $delete = $link->query("DELETE FROM empleados WHERE FK_personal = $id");
        $query = "DELETE FROM tbl_personal WHERE PK_codigo_pe = $id";
        $resultado = mysqli_query($link, $query);

        if (!$resultado) {
            die("Consulta fallida.");
        }


        // $_SESSION['message'] = 'Datos Eliminados Satisfactoriamente';
        //  $_SESSION['message_type'] =  'danger';
        header("location: dashboard.php?message=Empleado eliminado exitosamente&message_type=danger");
    } else {
        header("location: dashboard.php?message=No puedes eliminar tu propia cuenta&message_type=info");
    }
}


if (isset($_POST['Confirmar'])) {
    $id = $_POST['id'];

    $query = "SELECT  * FROM empleados e WHERE ID_emp = $id";
    $resultado = mysqli_query($link, $query);

    $info = mysqli_fetch_assoc($resultado);
    $codigo = $info['FK_personal'];

    $identificacion = $_POST['identificacion'];

    $especialidad = $_POST['Razon_social'];
    $nombres = $_POST['Nombres'];
    $apellidos = $_POST['Apellidos'];
    $genero = $_POST['Genero'];
    $direccion = $_POST['Direccion'];
    $numero = $_POST['Numero'];
    $correo = $_POST['Correo'];

    $Estado = $_POST['PK_estado'];


    $update = $link->query("UPDATE empleados set Correo ='$correo', FK_Estado = '$Estado' where ID_emp= $id");

    if (empty($genero)) {
        $query = $link->query("UPDATE tbl_personal SET N_identificacion = '$identificacion', Razon_social = '$especialidad', Nombres = '$nombres', Apellidos = '$apellidos', Direccion = '$direccion', Numero = '$numero' WHERE PK_codigo_pe = $codigo");
    } else {
        $query = $link->query("UPDATE tbl_personal SET N_identificacion = '$identificacion', Razon_social = '$especialidad', Nombres = '$nombres', Apellidos = '$apellidos', Genero = '$genero', Direccion = '$direccion', Numero = '$numero' WHERE PK_codigo_pe = $codigo");
    }



    //   $_SESSION['message'] = "Datos actualizados exitosamente";
    //   $_SESSION['message_type'] =  'warning';

      header('location:  dashboard.php?message=Los datos han sido actualizados exitosamente&message_type=warning');

}
