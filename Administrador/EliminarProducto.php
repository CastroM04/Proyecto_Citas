<?php
include("../conexion/conexion.php");

if (isset($_GET['id']) && $_GET['Eliminar'] =="true") {
  $id = $_GET['id'];

  $deleteProducto = $link->query("DELETE FROM tbl_productos WHERE PK_codigo_pr =$id");

  if ($deleteProducto) {
    $_SESSION['message'] = 'Datos Eliminados Satisfactoriamente';
    $_SESSION['message_type'] =  'danger';
    header("location: dashboard.php?ProductSucces=truemessage=El producto ha sido eliminado exitosamente&message_type=danger");

  } else {
    die("Consulta fallida");
  }
}

