<?php
include("../conexion/conexion.php");

if (isset($_POST['GuardarProducto'])) {
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $existencia = $_POST['Existencia'];
    $unidadMedida = $_POST['UnidadMedida'];
    $stockMinimo = $_POST['StockMinimo'];
    $stockMaximo = $_POST['StockMaximo'];
    $categoria = $_POST['Categoria'];
    $proveedor = $_POST['proveedores'];
    // file_get_contents para leer el contenido binario de un archivo
    $imagen = file_get_contents($_FILES['FotoPro']['tmp_name']);
    //para verificar que los datos se almacenen correctamente
    $imagen = $link->real_escape_string($imagen);





    if (empty($nombre) || empty($precio) || empty($existencia) || empty($unidadMedida) || empty($stockMinimo) || empty($stockMaximo) || empty($categoria)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $query = $link->query("INSERT INTO tbl_productos (Nombre, Precio, existencia, unidad_de_medida, stock_minimo, stock_maximo, Categoria,FK_proveedor,Imagen ) 
              VALUES ('$nombre', '$precio', '$existencia', '$unidadMedida', '$stockMinimo', '$stockMaximo', '$categoria',$proveedor,'$imagen')");

        if ($query == true) {
            //   $_SESSION['message'] = 'Producto Guardado exitosamente';
            //   $_SESSION['message_type'] = 'success';

            header("location: dashboard.php?empleados=false&ProductSucces=true&message=El producto ha sido registrado exitosamente&message_type=succes");
        } else {
            echo "Error al insertar el producto: " . mysqli_error($link);
        }
    }
}

