<?php

$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");
$Nombre =  "";
$Genero =  "";
$Telefono = "";
$username = "";
$email =   "";
$password = "";


if (isset($_POST['AgregarUsuarios'])) {
    $Nombre =  $_POST['Nombre'];
    $Genero =  $_POST['Genero'];
    $Telefono = $_POST['Numero'];
    $username = $_POST['Username'];
    $email =   $_POST['Email'];
    $password = $_POST['Password'];


    $Detector = $link->query("SELECT * FROM tbl_usuario WHERE Numero= $Telefono");
    if ($Detector->num_rows) {
        header('location:  dashboard.php?usuarios=true&message=No se puede registrar el numero ya existe&message_type=warning');
    } else {
        $InformacionPersonal = $link->query("INSERT INTO tbl_usuario (Nombres,Genero,Numero) VALUES ('$Nombre','$Genero','$Telefono')");
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


    $update = $link->query("UPDATE usuarios set Correo ='$correo', Nombre_usuario='$username' where ID=$id");
    $ConsultarFore = mysqli_fetch_assoc($link->query("SELECT FK_usuarios FROM usuarios where ID =$id"));
    $Codigo = $ConsultarFore['FK_usuarios'];
    if ($genero == "0") {
        $query = "UPDATE tbl_usuario SET  Nombres = '$nombres',    Numero = '$numero' WHERE PK_codigo_us = $Codigo";
        mysqli_query($link, $query);
    } else {
        $query = "UPDATE tbl_usuario SET  Nombres = '$nombres',  Genero ='$genero',  Numero = '$numero' WHERE PK_codigo_us = $Codigo";
        mysqli_query($link, $query);
    }


    // $_SESSION['message'] = "Datos actualizados exitosamente";
    // $_SESSION['message_type'] =  'warning';
    header("location: dashboard.php?empleados=false&usuarios=true&message=El usuario se ha actualizado exitosamente&message_type=warning");
}




if (isset($_GET['usuariosActualizar'])) {
    $id = $_GET['id'];
    header(("location: dashboard.php?usuarios=true&usuariosActualizar=true&id=$id&Actualizar=true"));
}

