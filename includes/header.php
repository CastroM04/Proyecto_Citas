<?php
$ADMIN = "";
include "includes/session.php";
$Dashboard = false;
if ($ADMIN == '33' || $ADMIN == '34') {
    $Dashboard = true;
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
    <link rel="stylesheet" href="CSS/header.css">
    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Script -->
    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="CSS/servicios.css">

    <!-- AJAX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .login-section {
            background-color: #F2F2F2B6;
            border-radius: 80px;
        }

        #login {
            border: 1px 2px 3px 4px solid black;
        }

        #content-header {
            width: 100%;
        }

        .header {
            background: url(Spa.jpg);
            padding: 15px 5%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;

        }

        #cart-shopping {
            position: absolute;
            top: 170px;
            left: 100px;
        }


        @media screen and (max-width: 991.98px) {
            #cart-shopping {
                position: initial;

            }

            .header {
                background: none;
            }

            #contenido-header,
            #contenido-boot {
                background-color: white;
                display: flex;
                justify-content: center;
                text-align: center;

            }

            .navbar-nav,
            .header {
                display: inline-flex;
                justify-content: center;
                align-items: center;
            }




        }
    </style>
</head>


<body>
    <header class="header" id="contenido-header">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid" id="contenido-boot">

                <div class="row">


                    <ul class="navbar-nav">
                        <li class="nav-item col-sm-12 col-md-2 col-lg-2  ">

                            <a class="navbar-brand" href="index.php">Inicio</a>
                        </li>

                        <li class="nav-item col-sm-12 col-md-2 col-lg-2 ">
                            <a class="nav-link" href="servicios.php?">Servicios</a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-2 col-lg-2 ">
                            <a class="nav-link" href="Productos.php">Productos</a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-2 col-lg-2 ">
                            <a class="nav-link" href="Acerca.php">Quienes somos</a>
                        </li>
                        <li class="nav-item col-sm-12 col-md-2 col-lg-2 ">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>




                    </ul>



                </div>
            </div>
            <?php
            $NamePagina = basename($_SERVER['PHP_SELF']);

            if ($NamePagina == "servicios.php") {

            ?>
                <div class="col-sm-12 col-md-2 col-lg-2">
                    <button id="cart-shopping" onclick="mostrarVentanaEmergente()"><i class="fa-solid fa-cart-shopping fa-xl"></i></button>
                </div>

            <?php } ?>

            <ul class="navbar-nav">
                <?php if ($Dashboard) {
                    if ( $ADMIN == '34') {  ?>
                         <li class="nav-item">
                        <a class="nav-link " id="login" aria-current="page" href="Administrador/dashboard.php?User=Empleado&message=!! Bienvenido <?php echo $_SESSION['nombre']; ?> !! &message_type=info">Citas</a>
                    </li>

                    <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link " id="login" aria-current="page" href="Administrador/dashboard.php?User=Adminmessage=!! Bienvenido <?php echo $_SESSION['nombre']; ?> !! &message_type=info">Dashboard</a>
                    </li>

                <?php } }  ?>

            </ul>


            <ul class="navbar-nav">
                <?php if ($check) { ?>

                    <form action="includes/session.php" method="POST">
                        <button class="nav-link" id="logout" type="submit" name="logout">Cerrar sesión</button>
                    </form>


                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" id="login" aria-current="page" href="Login.php">Ingresar</a>
                    </li>

                <?php } ?>


            </ul>



        </nav>




    </header>
</body>

</html>