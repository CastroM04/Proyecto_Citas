<?php
$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");

$nombre = "";
$precio = "";
$existencia = "";
$unidadMedida = "";
$stockMinimo = "";
$stockMaximo = "";
$categoria = "";
$imagen = "";




if (isset($_POST['Actualizar'])) {
    $codigo = $_GET['id'];

    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $existencia = $_POST['existencia'];
    $unidadMedida = $_POST['UnidadMedida'];
    $stockMinimo = $_POST['StockMinimo'];
    $stockMaximo = $_POST['StockMaximo'];


    if (!empty($_FILES['FotoPro']['name'])) {
        $imagen = file_get_contents($_FILES['FotoPro']['tmp_name']);
        //para verificar que los datos se almacenen correctamente
        $imagen = $link->real_escape_string($imagen);
    }
    if (!empty($_POST['Categoria'])) {
        $categoria = $_POST['Categoria'];
    } else {
        $categoria = "";
    }

    if (!empty($codigo)) {
        if (!empty($imagen)) {
            if (!empty($categoria)) {
                $update = $link->query("UPDATE tbl_productos SET Nombre='$nombre', Precio='$precio', existencia='$existencia',
                Unidad_de_medida='$unidadMedida', stock_minimo='$stockMinimo', stock_maximo='$stockMaximo',
                Categoria='$categoria', Imagen='$imagen' WHERE PK_codigo_pr=$codigo");
            } else {
                $update = $link->query("UPDATE tbl_productos SET Nombre='$nombre', Precio='$precio', existencia='$existencia',
                Unidad_de_medida='$unidadMedida', stock_minimo='$stockMinimo', stock_maximo='$stockMaximo',
                Imagen='$imagen' WHERE PK_codigo_pr=$codigo");
            }
        } else {
            if (!empty($categoria)) {
                $update = $link->query("UPDATE tbl_productos SET Nombre='$nombre', Precio='$precio', existencia='$existencia',
                Unidad_de_medida='$unidadMedida', stock_minimo='$stockMinimo', stock_maximo='$stockMaximo',
                Categoria='$categoria' WHERE PK_codigo_pr=$codigo");
            } else {
                $update = $link->query("UPDATE tbl_productos SET Nombre='$nombre', Precio='$precio', existencia='$existencia',
                Unidad_de_medida='$unidadMedida', stock_minimo='$stockMinimo', stock_maximo='$stockMaximo'
               WHERE PK_codigo_pr=$codigo");
            }
        }


        if ($update) {
            //  $_SESSION['message'] = "Datos actualizados exitosamente";
            //  $_SESSION['message_type'] =  'warning';
            $imagen = "";
            $_GET['id'] = "";
            header("location: dashboard.php?empleados=false&ProductSucces=true&message=El producto se ha actualizado exitosamente&message_type=warning");
        }
    } else {
        header("location: dashboard.php");
    }
}

if (isset($_GET['Detalles'])) {
    $key = $_GET['Cod'];
    header("location: dashboard.php?ProductSucces=true&DetallesProducto=true&llave=$key");
}
if (isset($_GET['VentanaActualizar']) && $_GET['VentanaActualizar'] == 'true') {
    $Primary = $_GET['id'];
    header("location: dashboard.php?modalProductosUP=true&productos=true&Codigo=$Primary");
}

