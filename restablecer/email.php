<?php

$conexion = new mysqli('localhost', 'root', '', 'procita');


if (isset($_REQUEST['Restablecer'])) {

  $email = $_REQUEST['email'];

  function generarCodigoAleatorio($longitud)
  {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    $caracteresLength = strlen($caracteres);// la línea $caracteresLength = strlen($caracteres); calcula la longitud de la cadena 
    for ($i = 0; $i < $longitud; $i++) {
      $codigo .= $caracteres[rand(0, $caracteresLength - 1)]; // genera un número aleatorio entre 0 y la longitud de la cadena de caracteres posibles menos 1. Esto se utiliza como índice para acceder a un carácter aleatorio de la cadena $caracteres.
    }

    return $codigo;
  }

  // Generar un código aleatorio de 6 caracteres
  $token =  generarCodigoAleatorio(10);



  $para = $email;

  // título del correo
  $título = 'Restablecer la contraseña de SPA PARADISE';
  $codigo = rand(1000, 9999);

  // Cuerpo  del correo debe ser expresada en forma de html
  $mensaje = '
<html>
<head>
  <title>Restablecer</title>
</head>
<body>
  <h1>Spa Paradise</h1>
  <div style="background-color: #f2f2f2; text-align: center;padding: 24px; border-radius: 40px;">
  <p style="font-size: 20px;">Cordial saludo le enviamos su codigo de recuperacion de contraseña, si usted no solicito ningun codigo ignore este correo</p>
  <p> <a style="font-size: 20px;" href="https://localhost/Proyecto_citas/restablecer/reset.php?email=' . $email . '&token=' . $token . '">Para restablecer su contraseña da click aqui</a> </p>
  <h3>' . $codigo . '</h3>
  </div>
</body>
</html>
';

  // Para enviar un correo HTML, debe establecerse la cabecera Content-type
  $cabeceras = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $cabeceras .= 'From: spaParadise@gmail.com' . "\r\n"; // Cambiar por tu dirección de correo electrónico


  // Verificar si existe un usuario con el correo ingresado
  $Consulta = "SELECT ID FROM usuarios where Correo='$email'";
  $respuesta = mysqli_query($conexion, $Consulta);


  if ($respuesta->num_rows) {

    // Verificar si el correo ya habia solicitado codigos recuperacion anteriormente para no sobre saturar el servidor
    $CodCheck = "SELECT RE.ID from recuperacion as RE join usuarios as US on (US.ID=RE.FK_Usuario)
                              WHERE US.Correo='$email'";
    $answer = mysqli_query($conexion, $CodCheck);

    if ($answer->num_rows) {
      $CodDelete = "DELETE R FROM recuperacion AS R
      JOIN usuarios AS U ON (U.ID = R.FK_Usuario)
      WHERE U.Correo = '$email';";

      mysqli_query($conexion, $CodDelete);
    }

    $fila = mysqli_fetch_row($respuesta);
    $usuario = $fila[0];

    // Enviar el correo electrónico
    $enviado = mail($para, $título, $mensaje, $cabeceras);

    //Aqui se verifica si el correo fue enviado con la funcion mail
    if ($enviado) {

      $conexion->query(" INSERT INTO recuperacion(FK_Usuario,Token,Codigo)
  VALUES ('$usuario','$token','$codigo')") or die($conexion->error);
      echo "<script languaje='javascript'>alert('Su codigo de restablecimineto ha sido enviado, verifica tu email')</script>";
    } else {
      echo "<script languaje='javascript'>alert('Error al enviar el codigo')</script>";
    }
  } else {
    echo "<script languaje='javascript'>alert('El correo no se encuentra vinculado a ninguna cuenta')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enviar</title>
  <style type="text/css">
    table {
      border: 1px solid gray;
    }

    body {
      display: grid;
      justify-content: center;
      background: url(../CSS/Spa.jpg) no-repeat; 
      /* background: linear-gradient(to left, #006EFF8B, #06FF7E7E); */
    }



    .formulario {
      margin-top: 40px;
      display: block;
      padding: 50px;
      width: 70%;
      border: 1px solid gray;
      box-sizing: border-box;
      width: 500px;
      border-radius: 30px;
      background-color: #f2f2f2d3;

    }

    .formulario label,
    .formulario h2 {
      font-family: Comic Sans MS;

    }

    .funciones {

      padding: 7px;
      border: none;
      width: 90px;
      height: 50px;
      border-radius: 30px;
      box-sizing: border-box;
      background-color: #FFFFFF55;
      font-size: 14px;

    }

    .funciones:hover {
      background-color: transparent;
      outline: 2px solid #f2f2f2;

    }

    .formulario .input {
      width: 85%;
      height: 30px;
      margin-top: 10px;
      margin-bottom: 20px;
      border-top: none;
      border-left: none;
      border-right: none;
      background: none;
    }

    .input:focus {
      outline: none;
    }

    * {
      font-family: sans-serif;
      margin: 0px;
      padding: 0px;
    }
  </style>

<link rel="stylesheet" href="../Boostrap/CSS/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/index.css">
    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Script -->
    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>

  

    <!-- AJAX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                     
                        <li class="nav-item">
                            <a class="nav-link" href="../servicios.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Acerca.php">Quienes somos</a>
                        </li>

                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="ingre" style="padding: 10px 20px 7px 20px; background-color: rgba(60, 255, 255, 0.521); border-radius: 20px 0px; color: rgb(0, 0, 0);" class="nav-link" href="../index.php">Inicio</a>
                    </li>
                </ul>

            </div>

        </nav>

    </header>
  <div class="container">


    <form action="" class="formulario" method="get">
      <h3>
        Restablecer contraseña

        <hr style="width: 70%; margin: 15px 0px;">
      </h3>
      <label for="email">Introduzca su correo</label>
      <input type="text" class="input" name="email" id="email" placeholder="Ingrese su correo...">

      <div style="display: inline-flex;; ">
        <center>
          <button type="submit" class="funciones" name="Restablecer">Restablecer</button>
          <a href="../login.php" class="funciones" style="text-decoration: none; color: black; font-size: 18px;margin-left: 200px">Regresar</a>

        </center>
      </div>

    </form>

  </div>

</html>