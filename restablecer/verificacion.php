<?php

$link = new mysqli('localhost','root','','procita');
if (!empty($_REQUEST['email']) && !empty($_REQUEST['token']) && !empty($_REQUEST['codigo'])) {

    $email = $_POST['email'];
    $token = $_POST['token'];
    $codigo = $_POST['codigo'];
    $correcto = true;
} else {
    $email = "";
    $token = "";
    $codigo = "";
    $correcto = false;
}
$Newpassword = "";
$confirmpassword = "";


$res = $link->query("SELECT US.*, RE.Token, RE.Codigo 
                     FROM usuarios AS US join recuperacion  AS RE ON (US.ID=RE.FK_Usuario)
                     where US.Correo='$email' and RE.Token='$token' and RE.Codigo='$codigo'") or die($conexion->error);
 


            

if (mysqli_num_rows($res) > 0) {
    $fila = mysqli_fetch_row($res);
    $fecha = $fila[4];
    $fecha_actual = date("Y-m-d:m:s");
    $seconds = strtotime($fecha_actual) - strtotime($fecha);
    $minutos = $seconds / 60;
    if ($minutos > 10) {
        echo "<script languaje='javascript'>alert('Token Vencido')</script>";
    } else {
        $correcto = true;
    }
} else {
    $correcto = false;
}






if (isset($_REQUEST['Actualizar'])) {
  $Newpassword = $_REQUEST['password'];
  $confirmpassword = $_REQUEST['ConfirmPassword'];
  $email = $_REQUEST['email'];

  if (!empty($Newpassword) && !empty($confirmpassword)) {
      if ($Newpassword == $confirmpassword) {
          // Generar el hash de la nueva contraseña
          // $hash_newpassword = password_hash($Newpassword, PASSWORD_BCRYPT);

          // Actualizar la contraseña en la base de datos
          $Newpassword_hash = password_hash($Newpassword, PASSWORD_DEFAULT);
          $update = "UPDATE usuarios SET Contraseña='$Newpassword_hash' WHERE ID = (SELECT ID FROM usuarios WHERE Correo='$email')";
          $respuesta = mysqli_query($link, $update);

          if ($respuesta) {
              echo "<script languaje='javascript'>alert('Contraseña actualizada correctamente')</script>";
              header('location:../login.php');
              exit(); // ¡No olvides salir del script después de redirigir!
          } else {
              echo "<script languaje='javascript'>alert('Error al actualizar la contraseña')</script>";
          }
      } else {
          echo "<script languaje='javascript'>alert('Las contraseñas deben ser iguales')</script>";
      }
  } else {
      echo "<script languaje='javascript'>alert('Complete todos los campos')</script>";
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contraseña nueva</title>
    <style type="text/css">
    table {
      border: 1px solid gray;
    }

    body {
      display: grid;
      justify-content: center;
      background: linear-gradient(to left, #006EFF8B, #06FF7E7E);
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
      width: 200px;
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

    <link rel="stylesheet" href="../CSS/servicios.css">

    <!-- AJAX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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


    <?php
    if ($correcto) {
    ?>
       
        <form action="" class="formulario">
        <h3 class="display-5">Nueva contraseña</h3>
            <label for="password">Nueva contraseña</label>
            <input type="text" class="input" name="password" id="password">
            <label for="ConfirmPassword">Confirmar contraseña</label>
            <input type="text" class="input" name="ConfirmPassword" id="ConfirmPassword">
            <input type="hidden" name="email" id="email" value="<?php echo $email ?>">
            <button type="submit" class="funciones" name="Actualizar" id="Actualizar">Actualizar contraseña</button>

        </form>
    <?php } else { ?>
        <div class="alert alert-danger" >
            Codigo incorrecto o vencido
        </div>
    <?php } ?>

</body>

</html>