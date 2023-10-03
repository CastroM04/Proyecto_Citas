<?php
include('conexion/conexion.php');

$correoL = "";
$passwordL = "";
$correoR = "";
$passwordR = "";
$nombres = "";
$nombre_usuario = "";
$telefono = "";
$genero = "";
$identificacion = "";
$tp_documento = "";

// Función Registrar
if (isset($_REQUEST['Registrar'])) {
    $nombres = $_REQUEST['nombres'];
    $nombre_usuario = $_REQUEST['nombreUS'];
    $identificacion = $_REQUEST['identificacion'];
    $correoR = $_REQUEST['correoR'];
    $passwordR = $_REQUEST['passwordR'];
    $telefono = $_REQUEST['telefonoR'];
    $genero = $_REQUEST['genero'];
    $tp_documento = $_REQUEST['tp_documento'];

    if (!empty($nombres) && !empty($identificacion) && !empty($correoR) && !empty($passwordR) && !empty($telefono) && !empty($genero) && !empty($nombre_usuario)) {
        // Verificar si la identificación ya existe en la base de datos
        $validacionIdentificacion = $link->query("SELECT * FROM tbl_usuario WHERE N_identificacion='$identificacion'");

        if ($validacionIdentificacion->num_rows) {
            echo "<script language='javascript'>alert('La identificación ya se encuentra registrada')</script>";
        } else {
            $validacionCorreo = $link->query("SELECT * FROM usuarios WHERE Correo='$correoR'");
            $validacionEmpleadoAdmin = $link->query("SELECT * FROM empleados WHERE Correo='$correoR' AND (FK_rol='33' OR FK_rol='34')");

            if ($validacionCorreo->num_rows || $validacionEmpleadoAdmin->num_rows) {
                echo "<script language='javascript'>alert('El correo ya se encuentra registrado')</script>";
            } else {
                $Guardar = $link->query("INSERT INTO tbl_usuario (Nombres, N_identificacion, tp_documento, Genero, Numero) VALUES ('$nombres', '$identificacion', '$tp_documento', '$genero', '$telefono');");

                if ($Guardar) {
                    $consultar = $link->query("SELECT PK_codigo_us FROM tbl_usuario WHERE Nombres='$nombres'");
                    $fila = mysqli_fetch_row($consultar);
                    $usuario = $fila[0];

                    $hash_newpasswordR = password_hash($passwordR, PASSWORD_DEFAULT);
                    $Guardar2 = $link->query("INSERT INTO usuarios (FK_usuarios, Nombre_usuario, Correo, Contraseña) VALUES ($usuario, '$nombre_usuario', '$correoR', '$hash_newpasswordR');");

                    if ($Guardar2) {
                        echo "<script language='javascript'>alert('Registro exitoso. ¡Ahora puedes iniciar sesión!'); window.location.href='Login.php';</script>";
                        exit();
                    } else {
                        $borrar = $link->query("DELETE FROM tbl_usuario WHERE PK_codigo_us='$usuario'");
                    }
                }
            }
        }
    } else {
        echo "<script language='javascript'>alert('Complete todos los campos')</script>";
    }
}




// Función Confirmar
if (isset($_REQUEST['Confirmar'])) {
    $correoL = $_REQUEST['correoL'];
    $passwordL = $_REQUEST['passwordL'];

    if (!empty($correoL) && !empty($passwordL)) {
        $consultaUsuario = "SELECT Correo, Contraseña FROM usuarios WHERE Correo='$correoL'";
        $respuestaUsuario = mysqli_query($link, $consultaUsuario);

        $consultaEmpleado = "SELECT Correo, Contraseña FROM empleados WHERE Correo='$correoL'";
        $respuestaEmpleado = mysqli_query($link, $consultaEmpleado);

        if ($respuestaUsuario->num_rows > 0) {
            $usuarioRow = mysqli_fetch_assoc($respuestaUsuario);
            $storedHashedPassword = $usuarioRow['Contraseña'];

            if (password_verify($passwordL, $storedHashedPassword)) {
                $consulta = "SELECT Nombre_usuario FROM usuarios WHERE Correo='$correoL'";
                $respuesta = mysqli_query($link, $consulta);
                $nombreRow = mysqli_fetch_assoc($respuesta);
                $nombre = $nombreRow['Nombre_usuario'];

                include 'includes/session.php';
                $_SESSION['usuario'] = $correoL;
                $_SESSION['Login'] = true;

                header('Location: index.php?user=' . $correoL);
                exit();
            } else {
                echo "<script language='javascript'>alert('Contraseña incorrecta')</script>";
            }
        } elseif ($respuestaEmpleado->num_rows > 0) {
            $empleadoRow = mysqli_fetch_assoc($respuestaEmpleado);
            $storedHashedPassword = $empleadoRow['Contraseña'];

            if (password_verify($passwordL, $storedHashedPassword)) {
                $consultaE = "SELECT Correo FROM empleados WHERE Correo='$correoL'";
                $respuestaE = mysqli_query($link, $consultaE);
                $nombreRow = mysqli_fetch_assoc($respuestaE);
                $nombre = $nombreRow['Correo'];

                include 'includes/session.php';
                $_SESSION['usuario'] = $correoL;
                $_SESSION['Login'] = true;

                header('Location: index.php?user=' . $correoL);
            } else {
                echo "<script language='javascript'>alert('Contraseña incorrecta')</script>";
            }
        } else {
            echo "<script language='javascript'>alert('No se encuentra registrado')</script>";
        }
    } else {
        echo "<script language='javascript'>alert('Complete todos los campos')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise</title>
    <!-- Bootsrtrap -->
    <link rel="stylesheet" href="Boostrap/CSS/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="CSS/login.css">
    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Script -->
    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .login-section {
            background-color: #F2F2F2B6;
            border-radius: 80px;
        }
    </style>
</head>


<body>
    <!-- NAVBAR CREATION -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse menu" id="navbarNavDropdown">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="servicios.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Acerca.php">Quienes somos</a>
                        </li>

                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="ingre" style="padding: 10px 20px 7px 20px; background-color: rgba(60, 255, 255, 0.521); border-radius: 20px 0px; color: rgb(0, 0, 0);" class="nav-link" href="index.php">Inicio</a>
                    </li>
                </ul>

            </div>

        </nav>

    </header>
    <!-- Fondo -->
    <div class="background"></div>

    <div class="container">
        <div class="login-section">
            <div class="form-box login">
                <form action>
                    <h2>Iniciar sesión</h2>
                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope icon"></i></span>
                        <input type="email" name="correoL" required>
                        <label>Correo</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-sharp fa-solid fa-lock icon"></i></span>
                        <input type="password" name="passwordL" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="remember-password">
                        <!-- <label for><input type="checkbox">Recordar</label> -->
                        <a href="restablecer/email.php">¿Has olvidado tu Contraseña?</a>
                    </div>
                    <button class="btn" name="Confirmar">Iniciar sesión</button>
                    <div class="create-account">
                        <p>
                            ¿Crea una cuenta nueva? <a href="#" class="register-link">Registrarse</a></p>
                    </div>
                </form>
            </div>
            <div class="form-box register">
                <form action>

                    <h2>Registrarse</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" name="nombres" required>
                        <label>Nombres</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" name="nombreUS" required>
                        <label>Nombre de usuario</label>
                    </div>
                    <div class="inputgenero">
                        <label for="tp_documento">Tipo documento:</label>
                        <select name="tp_documento" id="tp_documento">
                            <option value="CC">Cedula Ciudadania</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='fa-solid fa-user-lock'></i></span>
                        <input type="number" name="identificacion" required>
                        <label>Numero de Documento</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-regular fa-envelope icon"></i></span>
                        <input type="email" name="correoR" required>
                        <label>Correo</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-solid fa-phone"></i></span>
                        <input type="number" name="telefonoR" required>
                        <label>Telefono</label>
                    </div>
                    <div class="inputgenero">
                        <label for="genero">Género:</label>
                        <select name="genero" id="genero">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="I">Indefinido</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class="fa-sharp fa-solid fa-lock icon"></i></span>
                        <input type="password" name="passwordR" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="remember-password">
                        <label for><input type="checkbox"><a href="Politica_Privacidad.php"> Aceptar politica de privacidad</a></label>
                    </div>
                    <button class="btn" name="Registrar">Registrarse</button>
                    <div class="create-account">
                        <p>
                            ¿Ya tienes una cuenta? <a href="#" class="login-link">
                                Iniciar sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="js/index.js"></script>
</body>

</html>