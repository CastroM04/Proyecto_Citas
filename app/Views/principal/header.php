<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>/css/header.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>/fontawesome/css/all.min.css">

    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>

    <title>Paradise</title>
</head>

<body>
    <header class="container-fluid header">

        <nav class="navbar navbar-expand-lg ">
            <ul class="navbar-nav row">

                <li class="nav-item col-sm-2 col-md-2 col-lg-2 Title-logo ">
                    <img class="spa-logo" src="<?php echo base_url() ?>/img/logo.png" alt="">
                    <a class="nav-link" href="<?php echo base_url() ?>/">Spa Paradise</a>
                </li>

                <li class="nav-item col-sm-2 col-md-2 col-lg-2 ">
                    <a class="nav-link" href="">Servicios</a>
                </li>
                <li class="nav-item col-sm-2 col-md-2 col-lg-2 ">
                    <a class="nav-link" href="">Productos</a>
                </li>
                <li class="nav-item col-sm-2 col-md-2 col-lg-2 ">
                    <a class="nav-link" href="">Quienes somos</a>
                </li>
                <li class="nav-item col-sm-2 col-md-2 col-lg-2 ">
                    <a class="nav-link" href="">Contacto</a>
                </li>

            </ul>

        </nav>

    </header>
    <nav class="sidebar locked">

        <div class="logo_items flex">
            <span class="nav_image" style="margin-top:10px;">
                <i class="fa-solid fa-toolbox fa-2xl"></i>
            </span>


        </div>

        <div class="menu_container">
            <div class="sidebar_profile flex">
                <span class="nav_image">
                    <?php if ( /*$TipoUser*/"Admin" == "Admin") { ?>
                        <i onclick="Modificaciones()" class="fa-solid fa-envelope fa-2xl"></i>
                    <?php } ?>
                </span>
                <div class="data_text" style="margin-left:5px">
                    <!--
                    <span class="name">
                        <?php /*  echo $_SESSION['nombre']; */ ?>
                    </span> <br>
                    <span class="email_User">
                        <?php /* echo $_SESSION['usuario']; */ ?>
                        
                    </span>
                    -->
                </div>
            </div>

            <?php if ( /*$TipoUser*/"Admin" == "Admin") { ?>
                <div class="menu_items">
                    <ul class="menu_item">
                        <div class="menu_title flex">

                            <span class="line"></span>
                        </div>
                        <li class="item">

                            <a href="dashboard.php?empleados" type="submit" name="empleados" class="link flex">
                                <i class="fas fa-users me-2"></i>
                                <span>Empleados</span>
                            </a>


                        </li>
                        <li class="item">
                            <a href="<?php echo base_url() ?>Servicios" class="link flex">
                                <i class="fas fa-concierge-bell me-2"></i>
                                <span>Servicios</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="dashboard.php?productos" class="link flex">
                                <i class="fas fa-shopping-basket"></i>
                                <span>Productos</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="dashboard.php?citas" class="link flex">
                                <i class="far fa-calendar-alt"></i>
                                <span>Citas</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="dashboard.php?proveedores" class="link flex">
                                <i class="fa-solid fa-truck"></i>
                                <span>Proveedores</span>
                            </a>
                        </li>
                        <li class="item">
                            <a href="dashboard.php?usuarios" class="link flex">
                                <i class="fas fa-user me-2"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                    </ul>


                </div>
            <?php } else { ?>
                <div class="menu_items">
                    <ul class="menu_item">
                        <div class="menu_title flex">

                            <span class="line"></span>
                        </div>

                        <li class="item">
                            <a href="dashboard.php?citas" class="link flex">
                                <i class="far fa-calendar-alt"></i>
                                <span>Citas</span>
                            </a>
                        </li>

                    </ul>
                </div>


            <?php } ?>
        </div>
    </nav>
</body>
<!--
    <section class="row seccion">
        <div class="seccion-content col-sm-12 col-md-12 col-lg-6  col-xl-6 p-4 mt-4" >
            <h1 class="display-5">Bienvenido</h1>
            <p class="texto-index">Esta es una pagina web para Agendamiento de citas <br> y tambien podras encontrar
                algunos
                productos que
                tenemos a la ventas <br>
                Tambien nos puedes buscar en nuestras redes sociales </p>
        </div>
        <div class="seccion-content col-sm-12 col-md-12 col-lg-5  col-xl-5  p-4 mt-4 offset-sm-0 offset-md-0 offset-lg-1">
            <h1 class="display-5">Novedades</h1>
            <p class="texto-index">Esta es una pagina web para Agendamiento de citas <br> y tambien podras encontrar
                algunos
                productos que
                tenemos a la ventas <br>
                Tambien nos puedes buscar en nuestras redes sociales </p>

        </div>

    </section>
-->