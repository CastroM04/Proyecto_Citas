<?php
  $ID = "";
  $accion = "";
  $entidad = "";

if(isset($_GET['Confirmacion']) && $_GET['Confirmacion'] == "true"){
    $ID = $_GET['id'];
    $accion = $_GET['accion'];
    $entidad = $_GET['entidad'];
    $entidad2= $_GET['entidad2'];
    header("location: dashboard.php?id=$ID&Confirmar=true&accion=$accion&entidad=$entidad&entidad2=$entidad2&$entidad=true&$entidad2=true");
}else{
  header("location: dashboard.php?");
}


?>