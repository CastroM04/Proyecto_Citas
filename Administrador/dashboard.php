<?php

include("../includes/menu_doble.php");

$link = new mysqli("localhost", "root", "", "procita");
$consultaPRO = $link->query("select * from tbl_productos");
$empleados = true;
$servicios = false;
$productos = false;
$cita = false;
$usuarios = false;
$proovedores = false;
$EditarEmpleados = false;
$botonPresionado = false;
$message = "";
$TypeMessage = "";
$ValorSer = "";
$DescripcionSer = "";
$id = "";
if ($TipoUser == "Admin") {

    if (isset($_GET['empleados'])  || isset($_GET['Empleados'])) {
        $empleados = true;
        $servicios = false;
        $productos = false;
        $cita = false;
        $usuarios = false;
        $proovedores = false;
        $EditarEmpleados = false;
    }
    if (isset($_GET['servicios'])) {
        $empleados = false;
        $servicios = true;
        $productos = false;
        $cita = false;
        $usuarios = false;
        $proovedores = false;
        $EditarEmpleados = false;
    }
    if (isset($_GET['productos']) || isset($_GET['ProductSucces'])) {
        $empleados = false;
        $servicios = false;
        $productos = true;
        $cita = false;
        $usuarios = false;
        $proovedores = false;
        $EditarEmpleados = false;
    }
    if (isset($_GET['citas'])) {
        $empleados = false;
        $servicios = false;
        $productos = false;
        $cita = true;
        $usuarios = false;
        $EditarEmpleados = false;
    }
    if (isset($_GET['usuarios']) || isset($_GET['UserCheck'])) {
        $empleados = false;
        $servicios = false;
        $productos = false;
        $cita = false;
        $usuarios = true;
        $proovedores = false;
        $EditarEmpleados = false;
    }
    if (isset($_GET['proveedores']) || isset($_GET['Prov'])) {
        $empleados = false;
        $servicios = false;
        $productos = false;
        $cita = false;
        $usuarios = false;
        $proovedores = true;
        $EditarEmpleados = false;
    }
    if (isset($_GET['EditarEmpleados'])) {
        $empleados = false;
        $servicios = false;
        $productos = false;
        $cita = false;
        $usuarios = true;
        $proovedores = false;
        $EditarEmpleados = false;
    }





    if (isset($_GET['DetallesProducto']) && $_GET['DetallesProducto'] == "true") {
        $botonPresionado = true;

        $llave = $_GET['llave'];
        $consulta = $link->query("SELECT * FROM tbl_productos WHERE PK_codigo_pr=$llave");
        $datos = mysqli_fetch_assoc($consulta);
        $NombrePR = $datos['Nombre'];
        $PrecioPR = $datos['Precio'];
        $Existencia = $datos['existencia'];
        $UnidadMed = $datos['unidad_de_medida'];
        $StockMin = $datos['stock_minimo'];
        $StockMax = $datos['stock_maximo'];

        $FK_categoria = $datos['Categoria'];
        $FK_proveedor = $datos['FK_proveedor'];
        $date1 = $link->query("SELECT Nombre from tbl_detallesparametro WHERE PK_codigo_dp = $FK_categoria");
        $datos1 = mysqli_fetch_assoc($date1);
        $nameCategoria = $datos1['Nombre'];
        $date2 = $link->query("SELECT Razon_social, Nombres from tbl_proveedor where PK_codigo_pro=$FK_proveedor ");
        $datos2 = mysqli_fetch_assoc($date2);
        if (empty($datos2['Razon_social'])) {
            $nameProveedor = $datos2['Nombres'];
        } else {
            $nameProveedor = $datos2['Razon_social'];
        }
    }



    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        $TypeMessage = $_GET['message_type'];
    }

    if (isset($_GET['Confirmar']) && $_GET['Confirmar'] ==  "true") {
        $Confirmar = true;
    }
    if (isset($_GET["modalProductosUP"]) && $_GET["modalProductosUP"] == "true") {
        $VentanaActiva = true;


        $id = $_GET['Codigo'];

        $consulta2 = $link->query("SELECT * FROM tbl_productos WHERE PK_codigo_pr=$id ");

        if (mysqli_num_rows($consulta2) > 0) {
            $row2 = mysqli_fetch_array($consulta2);
            $PrimaryKey = $row2['PK_codigo_pr'];
            $nombre = $row2['Nombre'];
            $precio = $row2['Precio'];
            $existencia = $row2['existencia'];
            $unidadMedida = $row2['unidad_de_medida'];
            $stockMinimo = $row2['stock_minimo'];
            $stockMaximo = $row2['stock_maximo'];
            $categoria = $row2['Categoria'];

            //$imagen = file_get_contents($_FILES['FotoPro']['tmp_name']);
        }
    }
    if (isset($_GET['VerServicio']) && $_GET['VerServicio'] == "true") {
        $ServiciosPanel = true;
        $id = $_GET['id'];
        $InfoServicios = mysqli_fetch_assoc($link->query("SELECT * FROM tbl_servicio WHERE PK_codigo_se=$id"));
        $DescripcionSer = $InfoServicios['Descripcion'];
        $ValorSer = $InfoServicios['valor_servicio'];
    }
} else {
    $empleados = false;
    $servicios = false;
    $productos = false;
    $cita = true;
    $usuarios = false;
    $EditarEmpleados = false;
}





?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Carpeta de iconos -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../css/Productos.css" />
    <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>

    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        #dashboard {
            margin-left: 30px;
        }


        #Confirmacion {
            display: absolute;
            justify-content: center;
            width: 35%;
            text-align: center;
            margin-top: 15%;
            margin-left: 30%;
            overflow: hidden;

        }

        #ModalServicios {
            overflow: hidden;
            margin-left: 10%;
            margin-top: 1%;
            width: 85%;
        }

        .modal-content {
            padding: 20px;

        }

        body {
            margin-left: 80px;
        }


        .Form {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .modal {

            position: absolute;
            width: 60%;
            margin-top: 130px;
            margin-left: 25%;
            border-radius: 30px;
            overflow-y: auto;
        }

        .formulario {
            border-radius: 30px;
            padding: 30px;
            width: 100%;

        }

        table {
            margin-top: 40px;
            width: 90%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        table td {

            padding: 15px;
        }

        .contenedor-producto {
            display: grid;
            grid-template-columns: repeat(3, 1fr);

            /* Agregar espacio entre los elementos dentro del grid */
        }

        @media screen and (max-width: 1330px) {

            /* Estilos específicos para pantallas más grandes (ejemplo: tabletas) */
            .contenedor-producto {
                grid-template-columns: repeat(3, 1fr);
                /* Mostrar dos elementos por fila */
            }
        }

        @media screen and (max-width: 1030px) {

            /* Estilos específicos para pantallas más grandes (ejemplo: tabletas) */
            .contenedor-producto {
                grid-template-columns: repeat(2, 1fr);
                /* Mostrar dos elementos por fila */
            }
        }

        @media screen and (max-width: 700px) {

            /* Estilos específicos para pantallas más grandes (ejemplo: tabletas) */
            .contenedor-producto {
                justify-items: center;
                /* Alineación horizontal en el eje principal */
                align-items: center;
                grid-template-columns: repeat(1, 1fr);
                /* Mostrar dos elementos por fila */
            }
        }

        .contenedor-pro {
            display: inline-flex;
            justify-content: center;
            text-align: center;
            border: 2px solid #f2f2f2;
            width: 100%;
            /* Cambiar el ancho al 100% para que se ajuste al contenedor padre */
            max-width: 300px;
            height: 360px;
            padding: 20px;
            margin-top: 50px;
            margin-left: 30px;
            box-sizing: border-box;
            border-radius: 30px;
            transition: all 0.1s ease;
        }

        .Vista-prod {
            width: 400px;
            height: 400px;
            border-radius: 50%;
        }

        .Servicio-img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
        }

        #ServiciosProd {

            width: 600px;
            height: 250px;
            border-radius: 30px;
            transform: translate(55%, -110px);


        }

        .For {
            display: inline-flex;
            overflow-x: scroll;
            padding: 30px;
        }

        #MiniVista {
            margin-left: 20px;
            border-radius: 30px;
            padding: 10px;
            border: 1px solid gray;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            box-shadow: 1px 1px 1px 0px gray;
            transition: all 0.1s ease;
        }

        #MiniVista:hover {
            transform: scale(1.1);
        }

        .Servicios-prod {
            width: 100px;
            height: 100px;
        }

        .contenedor-pro:hover {
            transform: scale(1.1);
        }

        .titulo {
            font-size: 19px;
            margin-bottom: 20px;
        }

        .img-item {
            width: 200px;
            height: 170px;
            border-radius: 100px;

        }

        .container-input {
            display: inline-flex;
            border: 2px solid #f2f2f2;
            margin-top: 20px;
            padding: 10px;
            border-radius: 50px;
        }


        .Place-Products {
            width: 100%;

        }

        .navbar li {
            list-style: none;
        }

        .detalles {
            width: 100%;
            height: 9 0%;
            overflow: scroll;
        }

        #FormProductosAc {
            display: inline-flex;
        }

        /* Para ocultar los botones de incremento y decremento en todos los navegadores */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .Content-seccion-mobile {
            display: none;
        }

        .button-mobile {
            padding: 20px;
            width: 80%;
        }

        .content-emp {}


        @media screen and (max-width: 1330px) {
            .Content-seccion {
                display: none;
            }

            .Content-seccion-mobile {
                display: block;
            }

            .modal {
                width: 80%;
                margin-left: 15%;
            }

            .sidebar {
                position: initial;
                width: 100%;
                /* Ancho cuando está cerrado */
                background: #fff;

                z-index: 1000;

            }

            .sidebar:hover {
                width: 100%;

            }

            body {
                margin-left: 0;
            }


        }

        .Form-looks {
            display: none;
        }

        .Datos-looks {
            display: flex;
        }
    </style>
</head>

<body>
    <!-- NAVBAR CREATION -->

    <div class="container-fluid" id="dashboard">
        <div class="row">

            <?php if (!empty($message)) { ?>
                <div class="alert alert-<?php echo $TypeMessage ?> alert-dismissible fade show" role="alert" style="display: inline-flex;justify-content: center;align-items: center;">
                    <p style="font-size: 18px;"> <?php echo $message  ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
            <?php
            } ?>


            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <?php if ($empleados) {  ?>

                    <button class="btn btn-outline-dark mt-4" onclick="Empleado()">Agregar Empleados</button>

                    <!-- Agregar estado en empleados -->
                    <div class="Content-seccion">
                        <table>
                            <thead>
                                <td>Identificacion</td>
                                <td>Especialidad</td>
                                <td>Nombres</td>
                                <td>Apellidos</td>
                                <td>Genero</td>
                                <td>Direccion</td>
                                <td>Numero</td>
                                <td>Correo electrónico</td>
                                <td>Estado</td>
                            </thead>



                            <?php

                            $Consultar = $link->query("SELECT PE.*, EM.*,TE.nombre_estado  FROM tbl_personal as PE JOIN empleados as EM
                            ON PE.PK_codigo_pe = EM.FK_personal
                            JOIN tbl_estado as TE ON EM.FK_Estado = TE.PK_estado");


                            while ($row = mysqli_fetch_assoc($Consultar)) {
                                $id = $row['ID_emp'];
                                if (isset($_GET['Actualizar']) && $_GET['Actualizar'] == "true" && isset($_GET['id']) && $_GET['id'] == $id) {


                            ?>

                                    <tr>

                                        <form action="Empleados.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <td><input type="text" name="identificacion" class="form-control" readonly value="<?php echo $row['N_identificacion'] ?>"></td>
                                            <td><input type="text" name="Razon_social" class="form-control" value="<?php echo $row['Razon_social']; ?>"></td>
                                            <td><input type="text" name="Nombres" class="form-control" value="<?php echo $row['Nombres']; ?>"></td>
                                            <td><input type="text" name="Apellidos" class="form-control" value="<?php echo $row['Apellidos']; ?>"></td>


                                            <td> <select name="Genero" id="Genero" class="form-select" style="height: 50px;width: 200px;">
                                                    <option value="0">SELECCIONAR</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                    <option value="NONE">PREFIERO NO DECIRLO</option>
                                                </select></td>



                                            <td><input type="text" name="Direccion" class="form-control" value="<?php echo $row['Direccion']; ?>"></td>
                                            <td><input type="text" name="Numero" class="form-control" value="<?php echo $row['Numero']; ?>"></td>
                                            <td><input type="text" name="Correo" class="form-control" value="<?php echo $row['Correo']; ?>"></td>
                                            <td>
                                                <select name="PK_estado" id="PK_estado" class="form-select" style="height: 50px;">


                                                    <?php

                                                    $Consultar_estado = $link->query("SELECT * FROM tbl_estado WHERE PK_estado < 3 OR PK_estado > 6");

                                                    while ($row = mysqli_fetch_assoc($Consultar_estado)) {

                                                    ?>
                                                        <option value="<?php echo $row['PK_estado'] ?>">
                                                            <?php
                                                            if (!empty($row['nombre_estado'])) {
                                                                echo $row['nombre_estado'];
                                                            }
                                                            ?>

                                                        </option>

                                                    <?php  } ?>


                                                </select>
                                            </td>
                                            <td>

                                                <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="Confirmar" class="btn btn-outline-succes">Confirmar</button>

                                                <a href="dashboard.php" class="btn btn-outline-danger" style="border-radius: 30px;">
                                                    Cerrar
                                                </a>
                                            </td>


                                        </form>

                                    </tr>


                                <?php } else { ?>

                                    <tr>

                                        <?php
                                        $id = $row['ID_emp'];

                                        ?>
                                        <td><?php echo $row['N_identificacion'] ?></td>
                                        <td><?php echo $row['Razon_social']; ?></td>
                                        <td><?php echo $row['Nombres']; ?></td>
                                        <td><?php echo $row['Apellidos']; ?></td>
                                        <td><?php echo $row['Genero']; ?></td>
                                        <td><?php echo $row['Direccion']; ?></td>
                                        <td><?php echo $row['Numero']; ?></td>
                                        <td><?php echo $row['Correo']; ?></td>
                                        <td><?php echo $row['nombre_estado']; ?></td>
                                        <td>
                                            <a href="dashboard.php?Actualizar=true&id=<?php echo $id; ?>" class="btn btn-outline-info mb-2" style="border-radius: 100%;">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_pe'] ?>&accion=Eliminar&entidad=Empleados" class="btn btn-outline-danger mb-2" style="border-radius: 100%;"> <i class="fa-solid fa-trash"></i></a>

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php  } ?>
                        </table>
                    </div>
                    <div class="Content-seccion-mobile ">

                        <?php

                        $Consultar = $link->query("SELECT PE.*, EM.*,TE.nombre_estado  FROM tbl_personal as PE JOIN empleados as EM
                            ON PE.PK_codigo_pe = EM.FK_personal
                            JOIN tbl_estado as TE ON EM.FK_Estado = TE.PK_estado");

                        $iterador = 1;

                        while ($row = mysqli_fetch_assoc($Consultar)) {
                            $id = $row['ID_emp'];
                        ?>
                            <?php   ?>
                            <button class="btn btn-outline-dark button-mobile mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObject<?php echo $iterador ?>" aria-expanded="false" aria-controls="collapseObject<?php echo $iterador ?>">
                                <?php echo $row['Nombres'] . " " . $row['Apellidos'] . " / ";
                                if ($row['FK_rol'] == "33") {
                                    echo "Administrador";
                                } else {
                                    echo "Empleado";
                                }  ?>
                            </button>
                            </p>
                            <div class="collapse container-fluid" id="collapseObject<?php echo $iterador ?>" style="border: none;">
                                <div class="row Datos-looks" id="Datos<?php echo $iterador; ?>">

                                    <div class="col-6 mb-3">Identificacion</div>
                                    <div class="col-6 "><?php echo $row['N_identificacion'] ?></div>
                                    <div class="col-6 mb-3">Especialidad</div>
                                    <div class="col-6 "><?php echo $row['Razon_social']; ?></div>
                                    <div class="col-6 mb-3">Correo electrónico</div>
                                    <div class="col-6 "><?php echo $row['Correo']; ?></div>
                                    <div class="col-6 mb-3">Genero</div>
                                    <div class="col-6 "><?php echo $row['Genero']; ?></div>
                                    <div class="col-6 mb-3">Direccion</div>
                                    <div class="col-6 "><?php echo $row['Direccion']; ?></div>
                                    <div class="col-6 mb-3">Numero</div>
                                    <div class="col-6 "><?php echo $row['Numero']; ?></div>
                                    <div class="col-6 mb-3">Estado</div>
                                    <div class="col-6 "><?php echo $row['nombre_estado']; ?></div>
                                    <div class="col-4">
                                        <button id="FormOpen<?php echo $iterador ?>" class="btn btn-outline-info mb-2" style="border-radius: 100%;" onclick="UpdateRe('<?php echo $iterador ?>')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_pe'] ?>&accion=Eliminar&entidad=Empleados" class="btn btn-outline-danger mb-2" style="border-radius: 100%;"> <i class="fa-solid fa-trash"></i></a>

                                    </div>

                                </div>
                                <form action="Empleados.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="row  Form-looks" id="Form<?php echo $iterador; ?>">


                                        <div class="col-5 mb-3">Nombres</div>
                                        <div class="col-6 mb-3"><input type="text" name="Nombres" class="form-control" value="<?php echo $row['Nombres']; ?>"></div>
                                        <div class="col-5 mb-3">Apellidos</div>
                                        <div class="col-6 mb-3"><input type="text" name="Apellidos" class="form-control" value="<?php echo $row['Apellidos']; ?>"></div>
                                        <div class="col-5 mb-3">Identificacion</div>
                                        <div class="col-6 mb-3"><input type="text" name="identificacion" class="form-control" readonly value="<?php echo $row['N_identificacion'] ?>"></div>
                                        <div class="col-5 mb-3">Especialidad</div>
                                        <div class="col-6 mb-3"><input type="text" name="Razon_social" class="form-control" value="<?php echo $row['Razon_social']; ?>"></div>
                                        <div class="col-5 mb-3">Correo electrónico</div>
                                        <div class="col-6 mb-3"><input type="text" name="Correo" class="form-control" value="<?php echo $row['Correo']; ?>"></div>
                                        <div class="col-5 mb-3">Genero</div>
                                        <div class="col-6 mb-3"> <select name="Genero" id="Genero" class="form-select" style="height: 50px;width: 200px;">
                                                <option value="0">SELECCIONAR</option>
                                                <option value="F">FEMENINO</option>
                                                <option value="M">MASCULINO</option>
                                                <option value="NONE">PREFIERO NO DECIRLO</option>
                                            </select></div>
                                        <div class="col-5 mb-3">Direccion</div>
                                        <div class="col-6 mb-3"><input type="text" name="Direccion" class="form-control" value="<?php echo $row['Direccion']; ?>"></div>
                                        <div class="col-5 mb-3">Numero</div>
                                        <div class="col-6 mb-3"><input type="text" name="Numero" class="form-control" value="<?php echo $row['Numero']; ?>"></div>
                                        <div class="col-5 mb-3">Estado</div>
                                        <div class="col-6 mb-3">
                                            <select name="PK_estado" id="PK_estado" class="form-select" style="height: 50px;">

                                                <?php

                                                $Consultar_estado = $link->query("SELECT * FROM tbl_estado WHERE PK_estado < 3 OR PK_estado > 6");

                                                while ($row1 = mysqli_fetch_assoc($Consultar_estado)) {

                                                ?>
                                                    <option value="<?php echo $row1['PK_estado']; ?>">
                                                        <?php
                                                        if (!empty($row1['nombre_estado'])) {
                                                            echo $row1['nombre_estado'];
                                                        }
                                                        ?>

                                                    </option>

                                                <?php  } ?>


                                            </select>

                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="Confirmar" class="btn btn-outline-succes">Confirmar</button>

                                            <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="UpdateRe('<?php echo $iterador ?>')" style="border-radius: 30px;"> Cerrar</a>

                                        </div>



                                    </div>
                                </form>





                            </div>



                        <?php $iterador++;
                        }  ?>


                    </div>

                <?php  } else if ($servicios) { ?>

                    <button class="btn btn-outline-dark mt-4" onclick="Servicios()">Agregar Servicios</button>
                    <div class="Place-Products">
                        <?php

                        $consul = "select * from tbl_productos";
                        $con = mysqli_query($link, $consul);


                        if ($con) {

                        ?>
                            <div class="contenedor-producto">
                                <?php
                                $consultaServicio = $link->query("SELECT * from tbl_servicio ");
                                while ($ServiciosVista = mysqli_fetch_assoc($consultaServicio)) {

                                    echo '<div class="contenedor-pro" >';
                                    echo '<div class="contenedor" >';
                                    echo '<h3 class="titulo" >' . $ServiciosVista['Descripcion'] . '</h3>';
                                    echo ' <img class="img-item" src="data:image/jpeg;base64, ' . base64_encode($ServiciosVista['Imagen']) . '" />';


                                ?>
                                    <div class="container-input">


                                        <a class="btn btn-outline-dark mr-4" style="border-radius: 100%;" href="Servicios.php?&VerServicios=true&id=<?php echo $ServiciosVista['PK_codigo_se'] ?>"><i class=" fa-solid fa-eye"></i></a>
                                        <a class="btn btn-outline-info mr-4" style="border-radius: 100%;" href=""><i class="fa-solid fa-pen"></i></a>

                                        <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $ServiciosVista['PK_codigo_se'] ?>&accion=Eliminar&entidad=Servicios&entidad2=servicios" class="btn btn-outline-danger " style="border-radius: 100%;"><i class="fa-solid fa-xmark"></i></a>



                                    </div>
                                    <?= '</div>' ?>
                                    <?= '</div>' ?>
                                <?php } ?>
                            </div>
                        <?php
                        }


                        ?>
                    </div>




                <?php  } else if ($productos) {  ?>

                    <button class="btn btn-outline-dark mt-4" onclick="Productos()">Agregar Productos</button>

                    <div class="Place-Products">
                        <?php

                        $consul = "select * from tbl_productos";
                        $con = mysqli_query($link, $consul);


                        if ($con) {

                        ?>

                            <div class="contenedor-producto">
                                <?php
                                while ($producto = mysqli_fetch_assoc($con)) {

                                    echo '<div class="contenedor-pro" >';

                                    echo '<div class="contenedor" >';
                                    echo '<h3 class="titulo" >' . $producto['Nombre'] . '</h3>';
                                    echo ' <img class="img-item" src="data:image/jpeg;base64, ' . base64_encode($producto['Imagen']) . '" />';


                                ?>
                                    <div class="container-input">


                                        <a class="btn btn-outline-dark mr-4" style="border-radius: 100%;" href="EditarProd.php?Detalles=true&Cod=<?php echo $producto['PK_codigo_pr'] ?>"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-outline-info mr-4" style="border-radius: 100%;" href="EditarProd.php?VentanaActualizar=true&id=<?php echo $producto['PK_codigo_pr'] ?>"><i class="fa-solid fa-pen"></i></a>

                                        <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $producto['PK_codigo_pr'] ?>&accion=Eliminar&entidad=EliminarProducto&entidad2=productos" class="btn btn-outline-danger" style="border-radius: 100%;"><i class="fa-solid fa-xmark"></i></a>



                                    </div>
                                    <?= '</div>' ?>
                                    <?= '</div>' ?>
                                <?php } ?>
                            </div>

                        <?php
                        }


                        ?>
                    </div>

                <?php  } else if ($usuarios) {

                ?>
                    <button class="btn btn-outline-dark mt-4" onclick="AgregarUsuarios()">Agregar Usuarios</button>

                    <div class="Content-seccion">
                        <table>
                            <thead>

                                <td>Nombres</td>
                                <td>Nombre de Usuario</td>
                                <td>Tipo Documento</td>
                                <td>No. Documento</td>
                                <td>Correo</td>
                                <td>Numero</td>
                                <td>Genero</td>
                            </thead>



                            <?php
                            $Consultar = $link->query("SELECT U.ID, TU.Nombres, U.Nombre_usuario, TU.tp_documento, TU.N_identificacion, U.Correo, TU.Numero, TU.Genero, TU.PK_codigo_us
                                    FROM  tbl_usuario as TU
                                    JOIN usuarios AS U ON (TU.PK_codigo_us = U.FK_usuarios)");


                            while ($row = mysqli_fetch_assoc($Consultar)) {

                                $nombres = $row['Nombres'];
                                $username = $row['Nombre_usuario'];
                                $tp_documento = $row['tp_documento'];
                                $N_identificacion = $row['N_identificacion'];
                                $genero = $row['Genero'];
                                $numero = $row['Numero'];
                                $correo = $row['Correo'];

                                if (isset($_GET['usuariosActualizar']) && $_GET['id'] == $row['ID']) {

                            ?>
                                    <tr>

                                        <form action="usuarios.php?id=<?php echo $_GET['id']; ?>" method="post">
                                            <td> <input type="text" name="Nombres" class="form-control" value="<?php echo $nombres; ?>" placeholder="Nombres"></td>
                                            <td><input type="text" name="Username" class="form-control" value="<?php echo $username; ?>" placeholder="usuario"></td>
                                            <td>
                                                <select name="tp_documento" id="tp_documento" class="form-select" style="height: 50px;width: 200px;">
                                                    <option value="0">SELECCIONAR</option>
                                                    <option value="CC">CEDULA CIUDADANIA</option>
                                                    <option value="TI">Tarjeta De Identidad</option>
                                                    <option value="CE">Cedula Extranjera</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="N_identificacion" class="form-control" readonly value="<?php echo $N_identificacion; ?>" placeholder="N_identificacion"></td>
                                            <td> <input type="email" name="Correo" class="form-control" value="<?php echo $correo; ?>" placeholder="Correo electrónico"></td>
                                            <td><input type="text" name="Numero" class="form-control" value="<?php echo $numero; ?>" placeholder="Número"></td>
                                            <td>
                                                <select name="Genero" id="Genero" class="form-select" style="height: 50px;width: 200px;">
                                                    <option value="0">SELECCIONAR</option>
                                                    <option value="F">FEMENINO</option>
                                                    <option value="M">MASCULINO</option>
                                                    <option value="NONE">PREFIERO NO DECIRLO</option>
                                                </select>
                                            </td>
                                            <td>

                                                <button class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="actualizar">
                                                    Actualizar
                                                </button>

                                                <a href="dashboard.php?usuarios=true" class="btn btn-outline-danger " style="border-radius: 30px;">Cerrar</a>


                                            </td>
                                        </form>

                                    </tr>




                                <?php } else { ?>
                                    <tr>

                                        <td><?php echo $row['Nombres']; ?></td>
                                        <td><?php echo $row['Nombre_usuario']; ?></td>
                                        <td><?php echo $row['tp_documento']; ?></td>
                                        <td><?php echo $row['N_identificacion']; ?></td>
                                        <td><?php echo $row['Correo']; ?></td>
                                        <td><?php echo $row['Numero']; ?></td>
                                        <td><?php echo $row['Genero']; ?></td>
                                        <td>

                                            <a href="usuarios.php?id=<?php echo $row['ID'] ?>&usuariosActualizar" class="btn btn-outline-info" style="border-radius: 100%;">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_us'] ?>&accion=Eliminar&entidad=EliminarUs&entidad2=usuarios" class="btn btn-outline-danger" style="border-radius: 100%;"><i class="fa-solid fa-trash"></i></a>


                                        </td>

                                    </tr>



                            <?php }
                            } ?>
                        </table>
                    </div>
                    <div class="Content-seccion-mobile ">

                        <?php

                        $iterador = 1;

                        $Consultar = $link->query("SELECT U.ID, TU.Nombres, U.Nombre_usuario, TU.tp_documento, TU.N_identificacion, U.Correo, TU.Numero, TU.Genero, TU.PK_codigo_us
                        FROM  tbl_usuario as TU
                        JOIN usuarios AS U ON (TU.PK_codigo_us = U.FK_usuarios)");


                        while ($row = mysqli_fetch_assoc($Consultar)) {

                            $nombres = $row['Nombres'];
                            $username = $row['Nombre_usuario'];
                            $tp_documento = $row['tp_documento'];
                            $N_identificacion = $row['N_identificacion'];
                            $genero = $row['Genero'];
                            $numero = $row['Numero'];
                            $correo = $row['Correo'];

                        ?>

                            <button class="btn btn-outline-dark button-mobile mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObject<?php echo $iterador ?>" aria-expanded="false" aria-controls="collapseObject<?php echo $iterador ?>">
                                <?php echo  $nombres; ?>
                            </button>
                            </p>
                            <div class="collapse container-fluid" id="collapseObject<?php echo $iterador ?>" style="border: none;">
                                <div class="row Datos-looks" id="Datos<?php echo $iterador; ?>">

                                    <div class="col-6 mb-3">Tipo documento</div>
                                    <div class="col-6 "><?php echo $tp_documento; ?></div>
                                    <div class="col-6 mb-3">Identificacion</div>
                                    <div class="col-6 "><?php echo $N_identificacion ?></div>

                                    <div class="col-6 mb-3">Correo electrónico</div>
                                    <div class="col-6 "><?php echo $correo; ?></div>
                                    <div class="col-6 mb-3">Genero</div>
                                    <div class="col-6 "><?php echo $genero; ?></div>
                                    <div class="col-6 mb-3">Numero</div>
                                    <div class="col-6 "><?php echo $numero; ?></div>

                                    <div class="col-4">
                                        <button id="FormOpen<?php echo $iterador ?>" class="btn btn-outline-info " style="border-radius: 100%;" onclick="UpdateRe('<?php echo $iterador ?>')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_us'] ?>&accion=Eliminar&entidad=EliminarUs&entidad2=usuarios" class="btn btn-outline-danger" style="border-radius: 100%;"><i class="fa-solid fa-trash"></i></a>

                                    </div>

                                </div>
                                <form action="usuarios.php?id=<?php echo $row['ID']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="row  Form-looks" id="Form<?php echo $iterador; ?>">


                                        <div class="col-5 mb-3">Nombres</div>
                                        <div class="col-6 mb-3"><input type="text" name="Nombres" class="form-control" value="<?php echo $row['Nombres']; ?>"></div>
                                        <div class="col-5 mb-3">Tipo de documento</div>
                                        <div class="col-6 mb-3"> <select name="tp_documento" id="tp_documento" class="form-select" style="height: 50px;width: 200px;">
                                                <option value="0">SELECCIONAR</option>
                                                <option value="CC">CEDULA CIUDADANIA</option>
                                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                                <option value="CE">CEDULA DE EXTRANJERIA</option>
                                            </select></div>


                                        <div class="col-5 mb-3">Identificacion</div>
                                        <div class="col-6 mb-3"><input type="text" name="N_identificacion" class="form-control" readonly value="<?php echo $row['N_identificacion'] ?>"></div>
                                        <div class="col-5 mb-3">Correo electrónico</div>
                                        <div class="col-6 mb-3"><input type="text" name="Correo" class="form-control" value="<?php echo $row['Correo']; ?>"></div>
                                        <div class="col-5 mb-3">Genero</div>
                                        <div class="col-6 mb-3"> <select name="Genero" id="Genero" class="form-select" style="height: 50px;width: 200px;">
                                                <option value="0">SELECCIONAR</option>
                                                <option value="F">FEMENINO</option>
                                                <option value="M">MASCULINO</option>
                                                <option value="NONE">PREFIERO NO DECIRLO</option>
                                            </select></div>
                                        <div class="col-5 mb-3">Numero</div>
                                        <div class="col-6 mb-3"><input type="text" name="Numero" class="form-control" value="<?php echo $row['Numero']; ?>"></div>
                                        <!--
                                        <div class="col-5 mb-3">Estado</div>
                                        <div class="col-6 mb-3">
                                            <select name="PK_estado" id="PK_estado" class="form-select" style="height: 50px;">

                                                <?php
                                                /*
                                                $Consultar_estado = $link->query("SELECT * FROM tbl_estado WHERE PK_estado < 3 OR PK_estado > 6");

                                                while ($row1 = mysqli_fetch_assoc($Consultar_estado)) {

                                                ?>
                                                    <option value="<?php echo $row1['PK_estado']; ?>">
                                                        <?php
                                                        if (!empty($row1['nombre_estado'])) {
                                                            echo $row1['nombre_estado'];
                                                        }
                                                        ?>

                                                    </option>

                                                <?php  }  */ ?>


                                            </select>

                                        </div>
                                        -->

                                        <div class="col-6">
                                            <button class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="actualizar">
                                                Actualizar
                                            </button>
                                            <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="UpdateRe('<?php echo $iterador ?>')" style="border-radius: 30px;"> Cerrar</a>

                                        </div>



                                    </div>
                                </form>





                            </div>



                        <?php $iterador++;
                        }  ?>


                    </div>






                <?php } else if ($proovedores) { ?>

                    <button class="btn btn-outline-dark mt-4" onclick="Proveedor()">Agregar Proveedores</button>

                    <div class="Content-seccion">
                        <table>
                            <thead>
                                <td>Codigo</td>
                                <td>Tipo de ID</td>
                                <td>Numero de Identificacion</td>
                                <td>Razon Social</td>
                                <td>Nombre</td>
                                <td>Apellido</td>
                                <td>Direccion</td>
                                <td>Numero</td>
                                <td>Correo</td>
                            </thead>



                            <?php

                            $Consultar = $link->query("SELECT * FROM tbl_proveedor");

                            while ($row = mysqli_fetch_assoc($Consultar)) {

                                $Ident = $row['PK_codigo_pro'];
                                $codigo = $row['Tipo_id'];
                                $Search = $link->query("SELECT Nombre FROM tbl_detallesparametro where PK_codigo_dp =$codigo");
                                $filas = mysqli_fetch_assoc($Search);
                                $nombre = $filas['Nombre'];


                                if (isset($_GET['ActualizarPr']) && $_GET['ActualizarPr'] == "true" && isset($_GET['id']) && $_GET['id'] == $Ident) {

                            ?>
                                    <tr>
                                        <form action="Proveedores.php" method="POST">



                                            <td>
                                                <input type="hidden" name="id" value="  <?php echo $row['PK_codigo_pro']; ?>">
                                                <?php

                                                echo $row['PK_codigo_pro'];
                                                ?>
                                            </td>
                                            <td>
                                                <select name="tipoId" id="tipoId" class="form-select" style="height: 50px;">
                                                    <option value="">SELECCIONAR</option>
                                                    <option value="30">CEDULA CIUDADANIA</option>
                                                    <option value="32">PASAPORTE</option>
                                                    <option value="31">NIT</option>
                                                </select>


                                            </td>



                                            <td><input type="text" class="form-control" name="N_identificacion" value="<?php echo $row['N_identificacion']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Razon_social" value="<?php echo $row['Razon_social']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Nombres" value="<?php echo $row['Nombres']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Apellidos" value="<?php echo $row['Apellidos']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Direccion" value="<?php echo $row['Direccion']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Numero" value="<?php echo $row['Numero']; ?>"></td>
                                            <td><input type="text" class="form-control" name="Correo" value="<?php echo $row['Correo']; ?>"></td>
                                            <td>
                                                <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="ActualizarProveedor" class="btn btn-outline-succes">Confirmar</button>

                                                <a href="dashboard.php?proveedores=true" class="btn btn-outline-danger" style="border-radius: 30px;">
                                                    Cerrar
                                                </a>

                                            </td>

                                        </form>




                                    </tr>

                                <?php } else { ?>

                                    <tr>
                                        <td>
                                            <?php
                                            $Ident = $row['PK_codigo_pro'];
                                            echo $row['PK_codigo_pro'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $codigo = $row['Tipo_id'];
                                            $Search = $link->query("SELECT Nombre FROM tbl_detallesparametro where PK_codigo_dp =$codigo");
                                            $filas = mysqli_fetch_assoc($Search);
                                            $nombre = $filas['Nombre'];
                                            echo $nombre;

                                            ?></td>
                                        <td><?php echo $row['N_identificacion']; ?></td>
                                        <td><?php echo $row['Razon_social']; ?></td>
                                        <td><?php echo $row['Nombres']; ?></td>
                                        <td><?php echo $row['Apellidos']; ?></td>
                                        <td><?php echo $row['Direccion']; ?></td>
                                        <td><?php echo $row['Numero']; ?></td>
                                        <td><?php echo $row['Correo']; ?></td>
                                        <td>
                                            <a href="dashboard.php?ActualizarPr=true&id=<?php echo $Ident ?>&empleados=false&Prov=true" class="btn btn-outline-info" style="border-radius: 100%;">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $Ident ?>&accion=Eliminar&entidad=Proveedores&entidad2=Prov" class="btn btn-outline-danger" style="border-radius: 100%;"> <i class="fa-solid fa-trash"></i></a>


                                        </td>

                                    </tr>
                                <?php }   ?>


                            <?php  } ?>
                        </table>
                    </div>
                    <div class="Content-seccion-mobile ">

                        <?php


                        $iterador = 1;
                        $Consultar = $link->query("SELECT * FROM tbl_proveedor");

                        while ($row = mysqli_fetch_assoc($Consultar)) {

                            $Ident = $row['PK_codigo_pro'];
                            $codigo = $row['Tipo_id'];
                            $Search = $link->query("SELECT Nombre FROM tbl_detallesparametro where PK_codigo_dp =$codigo");
                            $filas = mysqli_fetch_assoc($Search);
                            $nombre = $filas['Nombre'];
                        ?>

                            <button class="btn btn-outline-dark button-mobile mt-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObject<?php echo $iterador ?>" aria-expanded="false" aria-controls="collapseObject<?php echo $iterador ?>">
                                <?php echo $row['Razon_social'] . " / " . $row['Nombres'] . " " . $row['Apellidos']  ?>
                            </button>
                            </p>
                            <div class="collapse container-fluid" id="collapseObject<?php echo $iterador ?>" style="border: none;">
                                <div class="row Datos-looks" id="Datos<?php echo $iterador; ?>">

                                    <div class="col-6 mb-3">Tipo de identificacion</div>
                                    <div class="col-6 "><?php echo $nombre ?></div>
                                    <div class="col-6 mb-3">Identificacion</div>
                                    <div class="col-6 "><?php echo $row['N_identificacion'] ?></div>
                                    <div class="col-6 mb-3">Especialidad</div>
                                    <div class="col-6 "><?php echo $row['Razon_social']; ?></div>
                                    <div class="col-6 mb-3">Correo electrónico</div>
                                    <div class="col-6 "><?php echo $row['Correo']; ?></div>

                                    <div class="col-6 mb-3">Direccion</div>
                                    <div class="col-6 "><?php echo $row['Direccion']; ?></div>
                                    <div class="col-6 mb-3">Numero</div>
                                    <div class="col-6 "><?php echo $row['Numero']; ?></div>

                                    <div class="col-4">
                                        <button id="FormOpen<?php echo $iterador ?>" class="btn btn-outline-info mb-2" style="border-radius: 100%;" onclick="UpdateRe('<?php echo $iterador ?>')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $Ident ?>&accion=Eliminar&entidad=Proveedores&entidad2=Prov" class="btn btn-outline-danger" style="border-radius: 100%;"> <i class="fa-solid fa-trash"></i></a>

                                    </div>

                                </div>
                                <form action="Proveedores.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="row  Form-looks" id="Form<?php echo $iterador; ?>">

                                        <input type="hidden" name="id" value="  <?php echo $row['PK_codigo_pro']; ?>">

                                        <div class="col-5 mb-3">Nombres</div>
                                        <div class="col-6 mb-3"><input type="text" name="Nombres" class="form-control" value="<?php echo $row['Nombres']; ?>"></div>
                                        <div class="col-5 mb-3">Apellidos</div>
                                        <div class="col-6 mb-3"><input type="text" name="Apellidos" class="form-control" value="<?php echo $row['Apellidos']; ?>"></div>
                                        <div class="col-5 mb-3">Tipo de identificacion</div>
                                        <div class="col-6 mb-3"> <select name="tipoId" id="tipoId" class="form-select" style="height: 50px;">
                                                <option value="">SELECCIONAR</option>
                                                <option value="30">CEDULA CIUDADANIA</option>
                                                <option value="32">PASAPORTE</option>
                                                <option value="31">NIT</option>
                                            </select></div>

                                        <div class="col-5 mb-3">Identificacion</div>
                                        <div class="col-6 mb-3"><input type="text" name="N_identificacion" class="form-control" readonly value="<?php echo $row['N_identificacion'] ?>"></div>
                                        <div class="col-5 mb-3">Razon social</div>
                                        <div class="col-6 mb-3"><input type="text" name="Razon_social" class="form-control" value="<?php echo $row['Razon_social']; ?>"></div>
                                        <div class="col-5 mb-3">Correo electrónico</div>
                                        <div class="col-6 mb-3"><input type="text" name="Correo" class="form-control" value="<?php echo $row['Correo']; ?>"></div>

                                        <div class="col-5 mb-3">Direccion</div>
                                        <div class="col-6 mb-3"><input type="text" name="Direccion" class="form-control" value="<?php echo $row['Direccion']; ?>"></div>
                                        <div class="col-5 mb-3">Numero</div>
                                        <div class="col-6 mb-3"><input type="text" name="Numero" class="form-control" value="<?php echo $row['Numero']; ?>"></div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="ActualizarProveedor" class="btn btn-outline-succes">Confirmar</button>

                                            <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="UpdateRe('<?php echo $iterador ?>')" style="border-radius: 30px;"> Cerrar</a>

                                        </div>



                                    </div>
                                </form>





                            </div>



                        <?php $iterador++;
                        }  ?>


                    </div>

                <?php } elseif ($cita) { ?>
                    <?php if ($TipoUser == "Admin") { ?>
                        <button class="btn btn-outline-dark mt-4" onclick="Cita()">Agregar cita</button>
                    <?php } ?>
                    <!-- Agregar cita -->
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <td>Numero de cita</td>
                                    <td>Servicio</td>
                                    <td>Precio</td>
                                    <td>Nombre Del Cliente</td>
                                    <td>Nombre Del Empleado</td>
                                    <td>Fecha y hora</td>
                                    <td>Estado de la cita</td>
                                </tr>
                            </thead>

                            <?php
                            if ($TipoUser != "Admin") {
                                $consultaCitas = $link->query("SELECT TC.PK_codigo_ci, TS.Descripcion, TS.valor_servicio, TU.Nombres AS Nombres_us, TP.Nombres, TC.Fecha_Hora, TE.nombre_estado
                                FROM tbl_cita AS TC
                                JOIN tbl_servicio AS TS ON TC.FK_codigo_se = TS.PK_codigo_se
                                JOIN tbl_usuario AS TU ON TC.N_identificacion = TU.N_identificacion
                                JOIN tbl_personal AS TP ON TC.FK_codigo_pe = TP.PK_codigo_pe
                                JOIN tbl_estado AS TE ON TC.Estado_Cita = TE.PK_estado
                                WHERE TC.FK_codigo_pe = '$PrimaryUser'");




                                while ($row = mysqli_fetch_assoc($consultaCitas)) {
                                    $id = $row['PK_codigo_ci'];
                                    if (isset($_GET['ActualizarCi']) && $_GET['ActualizarCi'] == "true" && isset($_GET['id']) && $_GET['id'] == $id) {
                            ?>
                                        <tr>
                                            <form action="Citas.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <td><input type="text" name="PK_codigo_ci" class="form-control" readonly value="<?php echo $row['PK_codigo_ci'] ?>"></td>
                                                <td><input type="text" name="Servicio" class="form-control" readonly value="<?php echo $row['Descripcion']; ?>"></td>
                                                <td><input type="text" name="Precio" class="form-control" readonly value="<?php echo $row['valor_servicio']; ?>"></td>
                                                <td><input type="text" name="Nombres_Usuario" class="form-control" readonly value="<?php echo $row['Nombres_us']; ?>"></td>
                                                <td><input type="text" name="Nombre_Empleado" class="form-control" readonly value="<?php echo $row['Nombres']; ?>"></td>
                                                <td><input type="datetime-local" name="Fecha_Hora" class="form-control" value="<?php echo $row['Fecha_Hora']; ?>"></td>
                                                <td>
                                                    <select name="PK_estado" id="FK_codigo_se" class="form-select" style="height: 50px;">


                                                        <?php

                                                        $Consultar_estado = $link->query("SELECT * FROM tbl_estado WHERE PK_estado > 2 AND PK_estado < 7");

                                                        while ($row = mysqli_fetch_assoc($Consultar_estado)) {

                                                        ?>
                                                            <option value="<?php echo $row['PK_estado'] ?>">
                                                                <?php
                                                                if (!empty($row['nombre_estado'])) {
                                                                    echo $row['nombre_estado'];
                                                                }
                                                                ?>

                                                            </option>

                                                        <?php  } ?>


                                                    </select>
                                                </td>

                                                <td>
                                                    <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="Confirmar" class="btn btn-outline-succes">Confirmar</button>
                                                    <a href="dashboard.php?citas=true" class="btn btn-outline-danger" style="border-radius: 30px;">Cerrar</a>
                                                </td>


                                            </form>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><?php echo $row['PK_codigo_ci']; ?></td>
                                            <td><?php echo $row['Descripcion']; ?></td>
                                            <td><?php echo $row['valor_servicio']; ?></td>
                                            <td><?php echo $row['Nombres_us']; ?></td>
                                            <td><?php echo $row['Nombres']; ?></td>
                                            <td><?php echo $row['Fecha_Hora']; ?></td>
                                            <td><?php echo $row['nombre_estado']; ?></td>

                                            <td>
                                                <a href="dashboard.php?ActualizarCi=true&id=<?php echo $id ?>&empleados=false&citas=true" class="btn btn-outline-info" style="border-radius: 100%;">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <?php if ($TipoUser == "Admin") { ?>
                                                    <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_ci'] ?>&accion=Eliminar&entidad=citas" class="btn btn-outline-danger" style="border-radius: 100%;">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php } ?>

                                    <?php }
                            } else {
                                $consultaCitas = $link->query("SELECT TC.PK_codigo_ci ,TS.Descripcion, TS.valor_servicio, TU.Nombres AS Nombres_us, TP.Nombres, TC.Fecha_Hora, TE.nombre_estado
                                FROM tbl_cita AS TC
                                JOIN tbl_servicio AS TS ON TC.FK_codigo_se = TS.PK_codigo_se
                                JOIN tbl_usuario AS TU ON TC.N_identificacion = TU.N_identificacion
                                JOIN tbl_personal AS TP ON TC.FK_codigo_pe = TP.PK_codigo_pe
                                JOIN tbl_estado AS TE ON TC.Estado_Cita = TE.PK_estado;");

                                while ($row = mysqli_fetch_assoc($consultaCitas)) {
                                    $id = $row['PK_codigo_ci'];
                                    if (isset($_GET['ActualizarCi']) && $_GET['ActualizarCi'] == "true" && isset($_GET['id']) && $_GET['id'] == $id) {



                                    ?>
                                        <tr>
                                            <form action="Citas.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <td><input type="text" name="PK_codigo_ci" class="form-control" readonly value="<?php echo $row['PK_codigo_ci'] ?>"></td>
                                                <td><input type="text" name="Servicio" class="form-control" readonly value="<?php echo $row['Descripcion']; ?>"></td>
                                                <td><input type="text" name="Precio" class="form-control" readonly value="<?php echo $row['valor_servicio']; ?>"></td>
                                                <td><input type="text" name="Nombres_Usuario" class="form-control" readonly value="<?php echo $row['Nombres_us']; ?>"></td>
                                                <td><input type="text" name="Nombre_Empleado" class="form-control" readonly value="<?php echo $row['Nombres']; ?>"></td>
                                                <td><input type="datetime-local" name="Fecha_Hora" class="form-control" value="<?php echo $row['Fecha_Hora']; ?>"></td>
                                                <td>
                                                    <select name="PK_estado" id="FK_codigo_se" class="form-select" style="height: 50px;">


                                                        <?php

                                                        $Consultar_estado = $link->query("SELECT * FROM tbl_estado WHERE PK_estado > 2 AND PK_estado < 7");

                                                        while ($row = mysqli_fetch_assoc($Consultar_estado)) {

                                                        ?>
                                                            <option value="<?php echo $row['PK_estado'] ?>">
                                                                <?php
                                                                if (!empty($row['nombre_estado'])) {
                                                                    echo $row['nombre_estado'];
                                                                }
                                                                ?>

                                                            </option>

                                                        <?php  } ?>


                                                    </select>
                                                </td>

                                                <td>
                                                    <button type="submit" class="btn btn-outline-success mb-2" style="border-radius: 30px;" name="Confirmar" class="btn btn-outline-succes">Confirmar</button>
                                                    <a href="dashboard.php?citas=true" class="btn btn-outline-danger" style="border-radius: 30px;">Cerrar</a>
                                                </td>


                                            </form>
                                        </tr>

                                    <?php } else { ?>
                                        <tr>
                                            <td><?php echo $row['PK_codigo_ci']; ?></td>
                                            <td><?php echo $row['Descripcion']; ?></td>
                                            <td><?php echo $row['valor_servicio']; ?></td>
                                            <td><?php echo $row['Nombres_us']; ?></td>
                                            <td><?php echo $row['Nombres']; ?></td>
                                            <td><?php echo $row['Fecha_Hora']; ?></td>
                                            <td><?php echo $row['nombre_estado']; ?></td>

                                            <td>
                                                <a href="dashboard.php?ActualizarCi=true&id=<?php echo $id ?>&empleados=false&citas=true" class="btn btn-outline-info" style="border-radius: 100%;">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <?php if ($TipoUser == "Admin") { ?>
                                                    <a href="Confirmaciones.php?Confirmacion=true&id=<?php echo $row['PK_codigo_ci'] ?>&accion=Eliminar&entidad=citas" class="btn btn-outline-danger" style="border-radius: 100%;">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>

                                        </tr>
                                    <?php } ?>

                            <?php }
                            }  ?>
                        </table>
                    </div>

                <?php } ?>

            </div>

        </div>
    </div>


    <div id="ModalCita" class="modal">
        <div class="modal-content">
            <div class="FormCita Form">

                <div class="formulario">


                    <form action="Citas.php" method="POST">
                        <h4 class="display-5">Agregar Cita</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">

                                    <label for="Servicio" class="form-label">Servicio</label>
                                    <select name="FK_codigo_se" id="FK_codigo_se" class="form-select" style="height: 50px;">


                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_servicio");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_codigo_se'] ?>">
                                                <?php
                                                if (!empty($row['Descripcion'])) {
                                                    echo $row['Descripcion'];
                                                }
                                                ?>

                                            </option>

                                        <?php  } ?>


                                    </select>

                                    <label for="identificacion" class="form-label">No. Documento del Usario</label>
                                    <input type="text" name="N_identificacion" id="N_identificacion" class="form-control" required>

                                    <button type="submit" name="RegistrarCita" class="btn btn-outline-dark mt-5">Agregar Cita</button>
                                    <button onclick="cerrarCita()" class="btn btn-outline-danger" style="position: relative; top: 23px; left: 10px; height: 40px;">Cerrar</button>


                                </div>
                                <div class="col-6">
                                    <label for="proveedores">Empleados</label>
                                    <select name="FK_codigo_pe" id="FK_codigo_pe" class="form-select" style="height: 50px;">


                                        <?php

                                        $Consultar = $link->query("SELECT tp.* FROM tbl_personal as tp
                                        JOIN empleados as E ON PK_codigo_pe = FK_personal
                                        WHERE E.FK_Estado = 1 AND E.FK_rol = 34");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_codigo_pe'] ?>">
                                                <?php
                                                if (!empty($row['Nombres'])) {
                                                    echo $row['Nombres'];
                                                }
                                                ?>

                                            </option>

                                        <?php  } ?>


                                    </select>



                                    <label for="Genero" class="form-label">Fecha</label>
                                    <input type="datetime-local" name="Fecha_Hora" id="Fecha_Hora" class="form-control" required>



                                </div>

                            </div>

                        </div>


                    </form>
                </div>



            </div>
        </div>

    </div>

    <div id="ModalEmpleados" class="modal">
        <div class="modal-content">
            <div class="FormEmpleados Form">

                <div class="formulario">


                    <form action="Empleados.php" method="POST">
                        <h4 class="display-5">Registrar Empleados</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">

                                    <label for="Razon_social" class="form-label">Especialidad</label>
                                    <input type="text" name="Razon_social" id="Razon_social" class="form-control" required>

                                    <label for="Nombres" class="form-label">Nombres</label>
                                    <input type="text" name="Nombres" id="Nombres" class="form-control" required>

                                    <label for="Apellidos" class="form-label">Apellidos</label>
                                    <input type="text" name="Apellidos" id="Apellidos" class="form-control" required>

                                    <label for="Genero" class="form-label">Genero</label>
                                    <select name="Genero" id="Genero" class="form-select" style="height: 50px;">
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                        <option value="NONE">Prefiero no decirlo</option>
                                    </select>
                                    <label for="Direccion" class="form-label">Direccion</label>
                                    <input type="text" name="Direccion" id="Direccion" class="form-control" required>



                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="Numero" class="form-label">Telefono</label>
                                    <input type="number" name="Numero" id="Numero" class="form-control" required>

                                    <label for="identificacion" class="form-label">Identificacion</label>
                                    <input type="number" name="identificacion" id="identificacion" class="form-control" required>


                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" required>

                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>

                                    <label for="roles" class="form-label input">Rol</label>
                                    <select id="roles" class="form-select" name="roles" required style="height: 50px;">
                                        <option value="33">Administrador</option>
                                        <option value="34">Empleado</option>
                                    </select><br><br>


                                </div>
                                <div class="col-sm-12 col-lg-12 col-xl-6">
                                    <button type="submit" name="RegistrarEmpleado" class="btn btn-outline-dark ml-2 ">Registrar Usuario</button>
                                    <button onclick="cerrarEmpleado()" class="btn btn-outline-danger ml-2 " style="position: relative; height: 40px;">Cerrar</button>

                                </div>

                            </div>

                        </div>


                    </form>
                </div>



            </div>
        </div>

    </div>

    <div id="ModalServicios" class="modal">
        <div class="modal-content">
            <div class="FormServices Form">

                <div class="formulario">

                    <form action="Servicios.php" method="post" enctype="multipart/form-data">
                        <h4 class="display-5">Agregar Servicios</h4>
                        <div class="container-flui">
                            <div class="row">
                                <div class="col-4">
                                    <label for="TipoSer" class="form-label">Tipo de servicio</label>
                                    <select name="Categoria" id="Categoria" class="form-select" style="height: 50px;">
                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_detallesparametro WHERE FK_Codigo_pa=1");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_Codigo_dp'] ?>">
                                                <?php
                                                echo $row['Nombre'];
                                                ?>

                                            </option>

                                        <?php  } ?>


                                    </select>

                                    <label for="DescripcionSer" class="form-label">Nombre del servicio</label>
                                    <input type="text" id="DescripcionSer" name="DescripcionSer" class="form-control" required>
                                    <label for="ValorSer" class="form-label">Valor del servicio</label>


                                    <input type="number" id="ValorSer" name="ValorSer" class="form-control" style="width: 60%;" required>


                                    <label for="FotoSer" class="form-label">Imagen</label>
                                    <input type="file" name="FotoSer" id="FotoSer" class="form-control" required>
                                    <br>

                                </div>
                                <div class="col-8">
                                    <div class="justify-content-end">
                                        <a href='javascript:void(0);' onclick=" MiniProductos()" class='btn btn-outline-dark btn-sm borrarProducto'>Lista De Productos</a>

                                    </div>
                                    <div class="detalles" style="margin-top: 100px;">
                                        <table>
                                            <thead>
                                                <th>Nombre</th>

                                            </thead>
                                            <td id="Productos-Servicios">

                                            </td>

                                        </table>


                                    </div>


                                </div>
                            </div>
                        </div>

                        <button type="submit" name="AgregarServicio" class="btn btn-outline-dark">Agregar</button>
                        <button onclick="cerrarServicios()" class="btn btn-outline-danger" style="position: relative; left: 10px; height: 40px;">Cerrar</button>

                    </form>

                </div>

            </div>

        </div>
    </div>




    <div id="ModalProductos" class="modal">
        <div class="modal-content">
            <div class="FormProductos Form">

                <div class="formulario">


                    <form action="GuardarProducto.php" method="POST" enctype="multipart/form-data">
                        <h4 class="display-5">Registrar Productos</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">

                                    <label for="Nombre" class="form-label">Nombre</label>
                                    <input type="text" name="Nombre" id="Nombre" class="form-control" required>
                                    <label for="Precio" class="form-label">Precio</label>
                                    <input type="text" name="Precio" id="Precio" class="form-control" required>
                                    <label for="Existencia" class="form-label">Existencias</label>
                                    <input type="number" name="Existencia" id="Existencia" class="form-control" required>
                                    <label for="UnidadMedida" class="form-label">Unidad de medida</label>
                                    <input type="text" name="UnidadMedida" id="UnidadMedida" class="form-control" required>
                                    <label for="StockMinimo" class="form-label">Stock minimo</label>
                                    <input type="number" name="StockMinimo" id="StockMinimo" class="form-control" required>


                                </div>
                                <div class="col-6">
                                    <label for="StockMaximo" class="form-label">Stock maximo</label>
                                    <input type="number" name="StockMaximo" id="StockMaximo" class="form-control" required>

                                    <label for="Categoria">Categoria</label>
                                    <select name="Categoria" id="Categoria" class="form-select" style="height: 50px;">
                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_detallesparametro WHERE FK_Codigo_pa=2");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_Codigo_dp'] ?>">
                                                <?php
                                                echo $row['Nombre'];
                                                ?>

                                            </option>

                                        <?php  } ?>


                                    </select>
                                    <label for="FotoPro" class="form-label">Imagen</label>
                                    <input type="file" name="FotoPro" class="form-control" id="FotoPro" class="form-control">

                                    <label for="proveedores">Proveedores</label>
                                    <select name="proveedores" id="proveedores" class="form-select" style="height: 50px;">


                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_proveedor");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_codigo_pro'] ?>">
                                                <?php
                                                if (!empty($row['Razon_social'])) {
                                                    echo $row['Razon_social'];
                                                } else {
                                                    echo  $row['Nombres'];
                                                }
                                                ?>

                                            </option>

                                        <?php  } ?>


                                    </select>


                                </div>

                            </div>
                            <button type="submit" name="GuardarProducto" class="btn btn-outline-dark mt-4">Guardar producto</button>
                            <button onclick="CerrarProductos()" class="btn btn-outline-danger" style="position: relative; top: 12px; left: 10px; height: 38px;">Cerrar</button>

                        </div>





                    </form>
                </div>


            </div>
        </div>
    </div>

    <div id="ModalProveedor" class="modal">
        <div class="modal-content">
            <div class="FormProveedores Form">

                <div class="formulario">


                    <form action="Proveedores.php" method="POST">
                        <h4 class="display-5">Registrar Proveedores</h4>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">

                                    <label for="Id" class="form-label">Tipo de identificacion</label>
                                    <select name="tipoId" id="tipoId" class="form-select" style="height: 50px;">

                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_detallesparametro WHERE FK_Codigo_pa=3");

                                        while ($row = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row['PK_Codigo_dp'] ?>">
                                                <?php
                                                echo $row['Nombre'];
                                                ?>

                                            </option>

                                        <?php  } ?>




                                    </select>
                                    <label for="identificacionProveedor" class="form-label">N° identificacion</label>
                                    <input type="number" name="identificacionProveedor" id="identificacionProveedor" class="form-control" required>


                                    <label for="Razon_Proveedores" class="form-label">Razon social</label>
                                    <input type="text" name="Razon_Proveedores" id="Razon_Proveedores" class="form-control" required>


                                    <label for="NombresProveedor" class="form-label">Nombres</label>
                                    <input type="text" name="NombresProveedor" id="NombresProveedor" class="form-control">

                                    <button type="submit" name="RegistrarProveedor" class="btn btn-outline-dark mt-5">Registrar Proveedor</button>
                                    <button onclick="cerrarProveedor()" class="btn btn-outline-danger" style="position: relative; top: 24px; left: 10px; height: 38px;">Cerrar</button>


                                </div>
                                <div class="col-6">
                                    <label for="ApellidosProovedor" class="form-label">Apellidos</label>
                                    <input type="text" name="ApellidosProovedor" id="ApellidosProovedor" class="form-control">

                                    <label for="DireccionProovedor" class="form-label">Direccion</label>
                                    <input type="text" name="DireccionProovedor" id="DireccionProovedor" class="form-control" required>



                                    <label for="TelefonoProveedor" class="form-label">Telefono</label>
                                    <input type="number" name="TelefonoProveedor" id="TelefonoProveedor" class="form-control" required>

                                    <label for="emailProveedor" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="emailProveedor" name="emailProveedor" required>


                                </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <div id="DetallesProd" class="modal">
        <div class="modal-content">

            <div class="Form">
                <div class="formulario">

                    <h4 class="display-5"><?php echo $NombrePR ?></h4>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="Nom" class="form-label">Nombres</label>
                                <input type="text" name="Nom" value="<?php echo $NombrePR  ?>" class="form-control" disabled>
                                <label for="Prec" class="form-label">Precio</label>
                                <input type="text" name="Prec" value="<?php echo $PrecioPR  ?>" class="form-control" disabled>
                                <label for="Dis" class="form-label">Disponibles</label>
                                <input type="text" name="Dis" value="<?php echo $Existencia  ?>" class="form-control" disabled>
                                <label for="Uni" class="form-label"> Unidad minima</label>
                                <input type="number" name="Uni" value="<?php echo $StockMin  ?>" class="form-control" disabled>

                                <a href="dashboard.php?ProductSucces=true" class="btn btn-outline-danger" style="position: relative; top: 10px; left: 0; height: 35px;">Cerrar</a>

                            </div>
                            <div class="col-6">
                                <label for="Stmi" class="form-label">Unidad maxima</label>
                                <input type="number" name="Stmi" value="<?php echo $StockMax  ?>" class="form-control" disabled>
                                <label for="Stmx" class="form-label">Categoria</label>
                                <input type="text" name="Stmx" value="<?php echo $nameCategoria  ?>" class="form-control" disabled>
                                <label for="Cat" class="form-label">Proveedor</label>
                                <input type="text" name="Cat" value="<?php echo $nameProveedor  ?>" class="form-control" disabled>

                            </div>

                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>
    <div id="ActProd" class="modal">
        <div class="modal-content">

            <div class="Form">
                <div class="formulario" id="FormProductosAc">


                    <form action="EditarProd.php?id=<?php echo $_GET['Codigo']; ?> " method="POST" enctype="multipart/form-data">
                        <h4 class="display-5">Actualizar datos</h4>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-5">

                                    <label for="Nombre" class="form-label">Nombre:</label>
                                    <input type="text" name="Nombre" class="form-control" value="<?php echo $nombre; ?>" autofocus placeholder="Nombre">


                                    <label for="Existencia" class="form-label">Precio</label>
                                    <input type="text" name="Precio" class="form-control" value="<?php echo $precio; ?>" placeholder="Precio">


                                    <label for="Existencia" class="form-label">Existencia</label>
                                    <input type="text" name="existencia" class="form-control" value="<?php echo $existencia; ?>" placeholder="Existencia">


                                    <label for="UnidadMedida" class="form-label">Unidad de Medida</label>
                                    <input type="text" name="UnidadMedida" class="form-control" value="<?php echo $unidadMedida; ?>" placeholder="Unidad de medida">


                                    <label for="StockMinimo" class="form-label">Stock Minimo</label>
                                    <input type="number" name="StockMinimo" class="form-control" value="<?php echo $stockMinimo; ?>" placeholder="Stock minimo">

                                    <label for="StockMaximo" class="form-label">Stock Maximo</label>
                                    <input type="number" name="StockMaximo" class="form-control" value="<?php echo $stockMaximo; ?>" placeholder="Stock maximo">


                                    <label for="Categoria">Categoria</label>
                                    <select name="Categoria" id="Categoria" class="form-select" style="height: 50px;" value="<?php echo $categoria; ?>">
                                        <?php

                                        $Consultar = $link->query("SELECT * FROM tbl_detallesparametro WHERE FK_Codigo_pa=2");


                                        while ($row1 = mysqli_fetch_assoc($Consultar)) {

                                        ?>
                                            <option value="<?php echo $row1['PK_Codigo_dp'] ?>">
                                                <?php
                                                echo $row1['Nombre'];
                                                ?>

                                            </option>

                                        <?php  } ?>

                                    </select>

                                    <label for="FotoPro" class="form-label">Imagen</label>
                                    <input type="file" name="FotoPro" class="form-control" value="" placeholder="Imagen">

                                    <button class="btn btn-outline-dark mt-4" name="Actualizar">
                                        Actualizar
                                    </button>

                                    <a href="dashboard.php?productos=true" class="btn btn-outline-danger" style="position: relative; top: 12px; left: 10px; height: 38px;">Cerrar</a>

                                </div>
                                <div class="col-7">
                                    <?php echo ' <img class="Vista-prod" src="data:image/jpeg;base64, ' . base64_encode($row2['Imagen']) . '" />';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    </div>

    <div id="Confirmacion" class="modal">
        <div class="modal-content">
            <?php
            $entidad = $_GET['entidad'];
            $entidad2 = $_GET['entidad2'];
            $id =  $_GET['id'];
            $accion = $_GET['accion'];

            ?>

            <h5 class="display-5">Advertencia</h5>
            <p>¿ Estas seguro que deseas <?php echo $_GET['accion']; ?> estos datos ?</p>
            <span>
                <a href="<?php echo $entidad ?>.php?id=<?php echo $id ?>&<?php echo $accion ?>=true" class="btn btn-outline-danger mr-4">
                    Confirmar
                </a>
                <a href="dashboard.php?<?php echo $entidad . "&" . $entidad2 ?>" class="btn btn-outline-dark ml-4">
                    Cerrar
                </a>
            </span>



        </div>

    </div>
    <div id="AgregarUsuarios" class="modal">
        <div class="modal-content">
            <div class="Form">
                <div class="formulario">
                    <form action="usuarios.php" method="POST">
                        <h4 class="display-5">Agregar Usuario</h4>
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="Nombre" id="Nombre" required>
                        <label for="tp_documento">Tipo documento</label>
                        <select name="tp_documento" id="tp_documento" class="form-select" style="height: 50px;width: 200px;">
                            <option value="CC">Cedula Ciudadania</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                        <label for="N_identificacion" class="form-label">N_identificacion</label>
                        <input type="number" class="form-control" name="N_identificacion" id="identificacion" required>
                        <label for="Genero">Genero</label>
                        <select name="Genero" id="Genero" class="form-select" style="height: 50px;width: 200px;">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="N">Prefiero no decirlo</option>
                        </select>
                        <label for="Numero" class="form-label">Telefono</label>
                        <input type="number" class="form-control" name="Numero" id="Numero" required>

                        <label for="" class="form-label"></label>

                        <label for="Username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" name="Username" id="Username" required>
                        <label for="email" class="form-label">Correo electronico</label>
                        <input type="text" class="form-control" name="Email" id="Email" required>
                        <label for="Password" class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="Password" id="Password" required>
                        <button type="submit" class="btn btn-outline-dark mt-3" name="AgregarUsuarios">Agregar</button>
                        <a href="dashboard.php?usuarios=true" class="btn btn-outline-danger mt-3 ml-3">Cerrar</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="ServiciosProd" class="modal">
        <div class="modal-content">
            <button class="btn btn-outline-danger" onclick="MiniProductosClose()" style="width: 40px;border-radius: 50%; position: absolute; top: 5px">X</button>

            <div class="For">
                <?php
                $ConsultaProductos = $link->query("SELECT * FROM tbl_productos");
                $cont = 1;
                while ($productos = mysqli_fetch_assoc($ConsultaProductos)) {
                    $Nombre = $productos['Nombre'];
                    $Codigo = $productos['PK_codigo_pr'];

                ?>
                    <div id="MiniVista">

                        <?php echo ' <img class="Servicios-prod" src="data:image/jpeg;base64, ' . base64_encode($productos['Imagen']) . '" />';
                        echo  '<input type="hidden" id="Nombre' . $cont . '"   value="' . $Nombre . '">';
                        echo  '<input type="hidden" id="Producto' . $cont . '" name="Producto' . $cont . '"  value="' . $Codigo . '">';
                        ?> <h6 class="ml-4"><?php echo $Nombre ?><button id='AgregarProductoSe<?php echo $cont ?>' class="btn btn-outline-info mt-2" style="border-radius: 30px">Agregar</button></h6>

                    </div>

                <?php $cont++;
                } ?>
            </div>
        </div>
    </div>

    <div id="ServiciosLook" class="modal">
        <div class="modal-content">

            <div class="row">
                <div class="col-12">
                    <h1 class="display-5">Nombre</h1>
                    <div class="descripcion">
                        <h5> Descripcion:</h5>
                        <p>
                            <?php echo $DescripcionSer; ?>

                        </p>
                    </div>
                    <div class="valor">
                        <h5> Valor Servicio: </h5>
                        <p>
                            <?php echo $ValorSer; ?>

                        </p>
                    </div>
                    <div class="productos">
                        <h5>Productos:</h5>

                        <p style="border: 1px solid gray; border-radius: 20px;padding: 20px; box-shadow: 1px 1px 1px 0px gray">

                            <?php
                            $CodigoSer = $_GET["id"];
                            $DetallesS = $link->prepare("SELECT * FROM tbl_detalleservicio WHERE FK_Servicio = ?");
                            $DetallesS->bind_param("i", $CodigoSer);
                            $DetallesS->execute();
                            $result = $DetallesS->get_result();


                            while ($DatosS = mysqli_fetch_assoc($result)) {
                                $PKprod = $DatosS['FK_producto'];
                                $productoDato = $link->query("SELECT * FROM tbl_productos where PK_codigo_pr = $PKprod");
                                $array = mysqli_fetch_assoc($productoDato);
                                $Nombre = $array['Nombre'];

                                echo $Nombre . "<br>";
                            }
                            ?>




                        </p>
                        <a href="dashboard.php?servicios=true" class="btn btn-outline-danger">Cerrar</a>
                    </div>
                </div>


            </div>
        </div>



    </div>
    <div id="Changes" class="modal">
        <div class="modal-content">
            <button class="btn btn-outline-danger" onclick="" style="width: 40px;border-radius: 50%; position: absolute; top: 5px">X</button>
            <?php
            $Modificaciones = $link->query("SELECT * FROM tareas");
            while ($Changes = mysqli_fetch_assoc($Modificaciones)) {
            ?>
                <input type="text" value="t_titulo">


            <?php } ?>

        </div>
    </div>



    <script>
        $(function() {



            // Objeto para mantener un registro de los productos agregados
            var productosAgregados = {};
            var contadorProductos = 1; // Inicializar la variable iteradora

            $("button[id^='AgregarProductoSe']").click(function() {
                var uniqueId = $(this).attr("id").replace("AgregarProductoSe", "");
                var codigo = $("#Producto" + uniqueId).val();
                var nombre = $("#Nombre" + uniqueId).val();

                // Verificar si el producto ya ha sido agregado
                if (productosAgregados[codigo]) {
                    return; // No agregar el producto nuevamente
                }

                // Agregar el producto al registro
                productosAgregados[codigo] = contadorProductos;
                contadorProductos++; // Aumentar la variable iteradora

                // Crear un nuevo elemento con el nombre y el botón de borrar
                var nuevoElemento = "<div class='row'><div class='col-5 mt-2'>" + nombre + "</div><div class='col-auto mt-2'> <a href='javascript:void(0);' class='btn btn-outline-danger btn-sm borrarProducto' style='border-radius: 30px;' data-codigo='" + codigo + "'>Borrar</a></div></div><input type='hidden' value='" + codigo + "' name='Producto" + productosAgregados[codigo] + "'>";

                // Agregar el nuevo elemento al contenedor "Productos-Servicios"
                $("#Productos-Servicios").append(nuevoElemento);
            });

            // Función para borrar un producto del registro y del DOM
            $(document).on('click', '.borrarProducto', function() {
                var codigo = $(this).data('codigo');
                var iterador = productosAgregados[codigo];

                delete productosAgregados[codigo];

                // Remover el elemento del DOM usando el iterador
                $("input[name='Producto" + iterador + "']").prev().remove(); // Remover el nombre
                $("input[name='Producto" + iterador + "']").remove(); // Remover el input
            });
        });
    </script>



    <script src="js/plugins.js"></script>



    <script>
        function UpdateRe(iterador) {
            var form = document.getElementById("Form" + iterador);
            var datos = document.getElementById("Datos" + iterador);

            if (form.style.display === "none") {
                form.style.display = "flex";
                datos.style.display = "none";
            } else {
                form.style.display = "none";
                datos.style.display = "flex";
            }
        }


        function Modificaciones() {
            var modal = document.getElementById("Changes");
            modal.style.display = "block";
        }

        function Empleado() {
            var modal = document.getElementById("ModalEmpleados");
            modal.style.display = "block";
        }


        function Servicios() {
            var modal2 = document.getElementById("ModalServicios");
            modal2.style.display = "block";
        }

        function Productos() {
            var modal3 = document.getElementById("ModalProductos");
            modal3.style.display = "block";
        }

        function Proveedor() {
            var modal4 = document.getElementById("ModalProveedor");
            modal4.style.display = "block";
        }


        function EditarProveedor() {
            var modal7 = document.getElementById("ModalProveedor");
            modal4.style.display = "block";
        }

        function Detalles() {
            var modal8 = document.getElementById("DetallesProd");
            modal8.style.display = "block";
        }

        function CerrarDetalles() {
            var modal8 = document.getElementById("DetallesProd");
            modal8.style.display = "none";


        }

        function AgregarUsuarios() {
            var modal12 = document.getElementById("AgregarUsuarios");
            modal12.style.display = "block";
        }

        function CerrarAgregarUsuarios() {
            var modal12 = document.getElementById("AgregarUsuarios");
            modal12.style.display = "none";
        }

        function Confirmacion() {
            var modal9 = document.getElementById("Confirmacion");
            modal9.style.display = "block";

        }

        function VentanaUpdateProducto() {
            var modal12 = document.getElementById("ActProd");
            modal12.style.display = "block";

        }

        function MiniProductos() {
            var modal14 = document.getElementById("ServiciosProd");
            modal14.style.display = "block";
        }

        function MiniProductosClose() {
            var modal14 = document.getElementById("ServiciosProd");
            modal14.style.display = "none";
        }

        function ServiciosRead() {
            var modal = document.getElementById("ServiciosLook");
            modal.style.display = "block";
        }


        function CerrarConfirmacion() {
            var modal9 = document.getElementById("Confirmacion");
            modal9.style.display = "none";

        }

        function Cita() {
            var modal15 = document.getElementById("ModalCita");
            modal15.style.display = "block";
        }




        //funcion para cerrar ventana Empleados
        function cerrarEmpleado() {
            var modal = document.getElementById("ModalEmpleados");
            modal.style.display = "none";
        }

        //funcion para cerrar ventana Servicios
        function cerrarServicios() {
            var modal2 = document.getElementById("ModalServicios");
            modal2.style.display = "none";
        }

        //funcion para cerrar ventana Productos
        function CerrarProductos() {
            var modal3 = document.getElementById("ModalProductos");
            modal3.style.display = "none";
        }

        function cerrarProveedor() {
            var modal4 = document.getElementById("ModalProveedor");
            modal4.style.display = "none";
        }

        function CerrarUsuarios() {
            var modal5 = document.getElementById("ModalUsuarios");
            modal5.style.display = "none";
        }

        function cerrarCita() {
            var modal15 = document.getElementById("ModalCita");
            modal15.style.display = "none";
        }

        function EditarEmpleados() {
            var modal6 = document.getElementById("ModalUsuarios");
            modal5.style.display = "none";
        }

        function EditarProveedor() {
            var modal7 = document.getElementById("ModalProveedor");
            modal6.style.display = "none";
        }
    </script>
    <script>
        <?php if ($botonPresionado) { ?>
            window.onload = function() {
                Detalles();
            }
        <?php } else if ($Confirmar) {  ?>
            window.onload = function() {
                Confirmacion();
            }
        <?php } ?>
    </script>
    <script>
        <?php if ($VentanaActiva) {  ?>
            window.onload = function() {
                VentanaUpdateProducto();
            }
        <?php } ?>
    </script>
    <script>
        <?php
        if ($ServiciosPanel) { ?>
            window.onload = function() {
                ServiciosRead();
            }
        <?php } ?>
    </script>


</body>

</html>