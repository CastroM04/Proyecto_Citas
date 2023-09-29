<?php
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

} else {
    header('location: email.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <style type="text/css">
    table {
      border: 1px solid gray;
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
    

      
        <form action="verificacion.php" class="formulario" method="post">
       <p> Ingrese el codigo que se le ha enviado ha    <label for="">"<?php echo $email ?>"</label>   para cambiar su contraseña</p>
       <br>
           
     
            <input type="hidden" name="email" id="email" value="<?php echo $email ?>">

            <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
            <input type="number" name="codigo" class="input" placeholder="Ingrese su codigo..." id="codigo">
            <button type="submit" class="funciones">Restablecer</button>

            
            <div>
                <br>
                ¿No es tu correo?<a href="email.php" style=" 
            text-decoration: none;
            margin-left: 10px;
            padding: 7px;
            border: none;
            width: 90px;
            height: 50px;
            border-radius: 30px;
            box-sizing: border-box;
            background-color: #FFFFFF55;
            color: black;
            font-size: 14px;">Cambiar correo</a>
            </div>
           
            
        </form>

    </div>

</html>