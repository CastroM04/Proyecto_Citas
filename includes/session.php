<?php
session_start();

$TipoUser = "";
$PrimaryUser ="";
$link = new mysqli('localhost', 'root', '', 'procita');
if (isset($_SESSION['usuario'])) {
    $user =  $_SESSION['usuario'];
    if (!empty($user)) {
        $check = true;
        $ConsultaUser = $link->query("SELECT * FROM usuarios where Correo='$user'");
        if ($ConsultaUser->num_rows) {
        } else {

            $ConsultaADMIN = $link->query("SELECT * FROM empleados where Correo='$user'");
            $datos = mysqli_fetch_assoc($ConsultaADMIN);
            $codigo = $datos['FK_personal'];
            $ConsultaInfo = $link->query("SELECT * FROM tbl_personal where PK_codigo_pe=$codigo");
            $Info = mysqli_fetch_assoc($ConsultaInfo);
            $Nombre =  $Info['Nombres'] . " ";
            $Nombre .= $Info['Apellidos'];
            $_SESSION['nombre'] = $Nombre;
            $ADMIN = $datos['FK_rol'];
            if ($ADMIN == '34') {
                $TipoUser = "Empleado";
                $PrimaryUser = $datos['FK_personal'];
              
            } else {
                $TipoUser = "Admin";
            }
        }

        $NamePagina = basename($_SERVER['PHP_SELF']);

        if (($NamePagina == "dashboard.php") &&  $ConsultaUser->num_rows) {
            header('location: ../index.php');
        }
    } else {
        session_destroy();
        header('location: ../index.php');
    }
} else {
    $_SESSION['Login'] = false;
    $check = false;
    $NamePagina = basename($_SERVER['PHP_SELF']);
    if (($NamePagina == "dashboard.php")) {
        header('location: ../index.php');
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    $_SESSION['Login'] = false;
    header('location: ../index.php');
}
