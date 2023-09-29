<?php
include("../conexion/conexion.php");


if (isset($_GET['id']) && $_GET['Eliminar'] == "true") {
    $id = $_GET['id'];

    $delete = $link->query("DELETE FROM usuarios WHERE FK_usuarios =$id");

    if ($delete) {
        $query = "DELETE FROM tbl_usuario WHERE PK_codigo_us =$id";
        $resultado = mysqli_query($link, $query);

        if (!$resultado) {
            die("Consulta fallida.");
        } else {
         //   $_SESSION['message'] = 'Datos Eliminados Satisfactoriamente';
         //   $_SESSION['message_type'] =  'danger';
            header("location: dashboard.php?UserCheck=true&message=Usuario ha sido eliminado exitosamente&message_type=danger");
        }
    }
}

