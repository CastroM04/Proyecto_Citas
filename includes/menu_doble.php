<?php

include("../includes/session.php");
if($TipoUser != ""){
    $TipoUser =$TipoUser;
}
if($PrimaryUser !=""){
    $PrimaryUser = $PrimaryUser;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Carpeta de iconos -->
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        #logout {
            padding: 10px;
            border-radius: 30px;
            background: none;
            color: black;
            border: 1px solid white;
            transition: all 0.7s ease;
        }

        #logout:hover {
            background-color: white;
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <!-- NAVBAR CREATION -->
    <header class="header">
        <nav class="navbar navbar-expand-lg " id="navbar">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item">

                        <a class="navbar-brand" href="../index.php" style="margin-left:5px">Inicio</a>
                    </li>
                </ul>

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
                    <ul class="navbar-nav">
                        <?php if ($check) { ?>

                            <form action="../includes/session.php" method="POST">
                                <button class="nav-link" id="logout" type="submit" name="logout">Cerrar sesión</button>
                            </form>

                        <?php } ?>

                    </ul>

                </div>


            </div>


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
                <?php  if ($TipoUser == "Admin") { ?>
                    <i onclick="Modificaciones()" class="fa-solid fa-envelope fa-2xl"></i>
                    <?php } ?>
                </span>
                <div class="data_text" style="margin-left:5px">

                    <span class="name"><?php echo $_SESSION['nombre']; ?></span> <br>
                    <span class="email_User"><?php echo $_SESSION['usuario']; ?></span>
                </div>
            </div>
       
            <?php  if ($TipoUser == "Admin") { ?>
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
                            <a href="dashboard.php?servicios" class="link flex">
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

</html>