<?php
$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");


if (isset($_POST['RegistrarProveedor'])) {

    $tipoId = $_POST['tipoId'];
    $id = $_POST['identificacionProveedor'];
    $razonPr = $_POST['Razon_Proveedores'];
    $nombrePr = $_POST['NombresProveedor'];
    $apellidoPr = $_POST['ApellidosProovedor'];
    $direccionPr = $_POST['DireccionProovedor'];
    $telefonoPr = $_POST['TelefonoProveedor'];
    $emailPr = $_POST['emailProveedor'];

    if (!empty($razonPr) || !empty($nombrePr) && !empty($apellidoPr)) {

        if (!empty($tipoId) && !empty($id) && !empty($direccionPr) && !empty($telefonoPr) && !empty($emailPr)) {

            $insert = $link->query("INSERT INTO tbl_proveedor (Tipo_id, N_identificacion, Razon_social, Nombres, Apellidos, Direccion, Numero, Correo) 
            VALUES ($tipoId, $id, '$razonPr', '$nombrePr', '$apellidoPr', '$direccionPr', '$telefonoPr', '$emailPr') ");

            if ($insert == true) {
                // $_SESSION['message'] = 'Provedor guardado exitosamente';
                // $_SESSION['message_type'] = 'success';
                $razonPr = "";
                $nombrePr = "";

                header("location:dashboard.php?empleados=false&Prov=true&message=El proveedor ha sido guardado exitosamente&message_type=success");
            } else {
                echo "No se ha podido registrar al provedor: " . mysqli_error($link);
            }
        }
    }
}


// Eliminar Proveedor

if (isset($_GET['id']) && $_GET['Eliminar'] == "true") {
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_proveedor WHERE PK_codigo_pro = $id";
    $resultado = mysqli_query($link, $query);

    if (!$resultado) {
        die("Consulta fallida.");
    } else {
        //   $_SESSION['mensaje'] = 'Datos Eliminados Satisfactoriamente';
        //  $_SESSION['color_mensaje'] = 'danger';
        header("location:dashboard.php?empleados=false&Prov=true&message=El proveedor ha sido eliminado exitosamente&message_type=danger");
    }
}



//   Actualizar proveedor

if (isset($_POST['ActualizarProveedor'])) {
    $codigo = $_POST['id'];
    $Tipo_id = $_POST['tipoId'];

    $id = $_POST['N_identificacion'];
    $razonPr = $_POST['Razon_social'];
    $nombrePr = $_POST['Nombres'];
    $apellidoPr = $_POST['Apellidos'];
    $direccionPr = $_POST['Direccion'];
    $telefonoPr = $_POST['Numero'];
    $emailPr = $_POST['Correo'];

    if (!empty($codigo)) {
        if (empty($Tipo_id)) {
            $actualizar = $link->query("UPDATE tbl_proveedor SET N_identificacion='$id', Razon_social='$razonPr', Nombres='$nombrePr', Apellidos='$apellidoPr', Direccion ='$direccionPr',Numero='$telefonoPr' , Correo ='$emailPr' where PK_codigo_pro=$codigo");
        } else {
            $actualizar = $link->query("UPDATE tbl_proveedor SET N_identificacion='$id', Tipo_id='$Tipo_id', Razon_social='$razonPr', Nombres='$nombrePr', Apellidos='$apellidoPr', Direccion ='$direccionPr',Numero='$telefonoPr' , Correo ='$emailPr' where PK_codigo_pro=$codigo");
        }

        if ($actualizar) {
            //  $_SESSION['message'] = "Datos editados exitosamente";
            //  $_SESSION['message_type'] = 'warning';
            $_POST['id'] = "";

            header("location:dashboard.php?empleados=false&Prov=true&message=Los datos se han actualizado exitosamente&message_type=warning");
        }
    }
}
