<?php

$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");
$Nombre =  "";
$N_identificacion =  "";
$Genero =  "";
$Telefono = "";
$username = "";
$email =   "";
$password = "";
$tp_documento = "";


if (isset($_POST['AgregarUsuarios'])) {
    $Nombre =  $_POST['Nombre'];
    $tp_documento =  $_POST['tp_documento'];
    $N_identificacion =  $_POST['N_identificacion'];
    $Genero =  $_POST['Genero'];
    $Telefono = $_POST['Numero'];
    $username = $_POST['Username'];
    $email =   $_POST['Email'];
    $password = $_POST['Password'];


    $Detector = $link->query("SELECT * FROM tbl_usuario WHERE Numero= $Telefono");
    if ($Detector->num_rows) {
        header('location:  dashboard.php?usuarios=true&message=No se puede registrar el numero ya existe&message_type=warning');
    } else {
        $InformacionPersonal = $link->query("INSERT INTO tbl_usuario (Nombres,tp_documento,N_identificacion,Genero,Numero) VALUES ('$Nombre','$tp_documento','$N_identificacion','$Genero','$Telefono')");
        if ($InformacionPersonal) {
            $CodeUser = $link->query("SELECT PK_codigo_us FROM tbl_usuario WHERE Nombres='$Nombre' AND Genero ='$Genero' AND Numero='$Telefono'");
            if ($CodeUser->num_rows < 2) {
                $Datos = mysqli_fetch_assoc($CodeUser);
                $PKusuario = $Datos['PK_codigo_us'];
                $InicioSesion = $link->query("INSERT INTO usuarios (FK_usuarios,Nombre_usuario,Correo,Contraseña) VALUES ($PKusuario,'$username','$email','$password')");
                if ($InicioSesion) {
                    $Nombre =  "";
                    $Genero =  "";
                    $Telefono = "";
                    $username = "";
                    $email =   "";
                    $password = "";
                    header('location:  dashboard.php?usuarios=true&message=El Usuario ha sido registrado exitosamente&message_type=success');
                }
            }
        }
    }
}

if (isset($_POST['actualizar'])) {
    $id = $_GET['id'];
    $nombres = $_POST['Nombres'];
    $username = $_POST['Username'];
    $correo =  $_POST['Correo'];
    $numero =  $_POST['Numero'];
    $genero = $_POST['Genero'];
    $tp_documento = $_POST['tp_documento'];

    if (!empty($id)) {
        $update = $link->query("UPDATE usuarios SET Correo ='$correo', Nombre_usuario='$username' WHERE ID=$id");
        $ConsultarFore = mysqli_fetch_assoc($link->query("SELECT FK_usuarios FROM usuarios WHERE ID =$id"));
        $Codigo = $ConsultarFore['FK_usuarios'];

        if ($genero == "0") {
            $query = "UPDATE tbl_usuario SET  Nombres = '$nombres', Numero = '$numero', tp_documento = '$tp_documento' WHERE PK_codigo_us = $Codigo";
            mysqli_query($link, $query);
        } else {
            $query = "UPDATE tbl_usuario SET  Nombres = '$nombres', Genero ='$genero', Numero = '$numero', tp_documento = '$tp_documento' WHERE PK_codigo_us = $Codigo";
            mysqli_query($link, $query);
        }

        header("location: dashboard.php?empleados=false&usuarios=true&message=El usuario se ha actualizado exitosamente&message_type=warning");
    } else {
        // Muestra un mensaje de error si no se selecciona una opción válida
        header("location: dashboard.php?empleados=false&usuarios=true");
    }
}






if (isset($_GET['usuariosActualizar'])) {
    $id = $_GET['id'];
    header(("location: dashboard.php?usuarios=true&usuariosActualizar=true&id=$id&Actualizar=true"));
}

