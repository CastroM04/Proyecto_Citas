<?php
$link = new mysqli('localhost', 'root', '', 'procita');
$descripcionSer = "";
$Categoria = "";
if (isset($_POST['AgregarServicio'])) {

    $consultaPRO = $link->query("select * from tbl_productos");

    $Categoria = $_POST['Categoria'];
    $descripcionSer = $_POST['DescripcionSer'];
    $ValorTotal = $_POST['ValorSer'];

    $imagen = file_get_contents($_FILES['FotoSer']['tmp_name']);
    //para verificar que los datos se almacenen correctamente
    $imagen = $link->real_escape_string($imagen);


    $consultaServicio = $link->query("SELECT * from tbl_servicio where Descripcion='$descripcionSer'");
    if ($consultaServicio->num_rows) {
    } else {
        $InsertarServicio = $link->query("INSERT INTO tbl_servicio (FK_TipoServicio,Descripcion,valor_servicio,Imagen) VALUES ($Categoria,'$descripcionSer',$ValorTotal,'$imagen')");
        if ($InsertarServicio) {

            $consultaServicio = $link->query("SELECT * from tbl_servicio where Descripcion='$descripcionSer'");
            $datos = mysqli_fetch_assoc($consultaServicio);
            $Servicio = $datos['PK_codigo_se'];
            if ($consultaServicio) {
                $i = 1;



                $BuscaProductos = $link->query("SELECT * FROM tbl_productos");

                while ($Recibido = mysqli_fetch_assoc($BuscaProductos)) {
                    $Codigo = $_POST['Producto' . $i . ''];
                    if (!empty($Codigo)) {
                        echo $Codigo;
                        $InsertarDetalles = $link->query("INSERT INTO tbl_detalleservicio (FK_Servicio,FK_producto) VALUES ($Servicio,$Codigo)");
                        if (!$InsertarDetalles) {
                            header("location:dashboard.php?empleados=false&servicios=true&message=Error al registrar el servicio&message_type=danger");
                            break;
                        }
                    }

                    $i++;
                }
                header("location:dashboard.php?empleados=false&servicios=true&message=Servicio Registrado Con Exito&message_type=success");
            }
        }
    }
}

if (isset($_GET['Eliminar']) && $_GET['Eliminar'] == true) {
    $codigo = $_GET['id'];
    $DeleteDetalles = $link->query("DELETE FROM tbl_detalleservicio where FK_Servicio=$codigo");
    if ($DeleteDetalles) {
        $DeleteServicio = $link->query("DELETE  FROM tbl_servicio where PK_codigo_Se = $codigo");
        if ($DeleteServicio) {
            header("location:dashboard.php?empleados=false&servicios=true&message=El servicio ha sido eliminado exitosamente&message_type=danger");
        }
    }
}


if (isset($_GET['VerServicios'])) {
    $id = $_GET['id'];
    header("location: dashboard.php?servicios=true&id=$id&VerServicio=true");
}

