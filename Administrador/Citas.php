<?php
$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");

if (isset($_POST['RegistrarCita'])) {
    $FK_codigo_se = $_POST['FK_codigo_se'];
    $FK_codigo_us = $_POST['FK_codigo_us'];
    $FK_codigo_pe = $_POST['FK_codigo_pe'];
    $Fecha_Hora = $_POST['Fecha_Hora'];
    $Estado_Cita = '3';

    
    $verificarUsuario = $link->query("SELECT * FROM tbl_usuario WHERE PK_codigo_us = $FK_codigo_us");

    if ($verificarUsuario->num_rows > 0) { 
        if (!empty($FK_codigo_se) && !empty($FK_codigo_us) && !empty($FK_codigo_pe) && !empty($Fecha_Hora) && !empty($Estado_Cita)) {
            $Insertar = $link->query("INSERT INTO tbl_cita (FK_codigo_se, FK_codigo_us, FK_codigo_pe, Fecha_Hora, Estado_Cita) 
            VALUES ($FK_codigo_se, $FK_codigo_us, $FK_codigo_pe, '$Fecha_Hora', '$Estado_Cita')");

        if ($Insertar) {
            header("location: dashboard.php?citas=true&message=La cita ha sido guardada exitosamente&message_type=success");
        } else {
            
            echo "Error al agregar la cita: " . $link->error;

        }
        }
    } else {
        header("location: dashboard.php?citas=true&message=El usuario con el código $FK_codigo_us no existe. No se puede guardar la cita.&message_type=danger");
    }
}


/* Eliminar Cita */
if (isset($_GET['id']) && isset($_GET['Eliminar']) && $_GET['Eliminar'] == "true") {
    $id = $_GET['id'];

    $stmt = $link->prepare("DELETE FROM tbl_cita WHERE PK_codigo_ci = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("location: dashboard.php?citas=true&message=Cita eliminada exitosamente&message_type=danger");
    } else {
        // Manejo de errores si la eliminación falla.
        echo "Error al eliminar la cita: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_POST['Confirmar'])) {
    $id = $_POST['id'];
    $Fecha_Hora = $_POST['Fecha_Hora'];
    $PK_estado = $_POST['PK_estado']; 

    $consultaCita = $link->query("SELECT * FROM tbl_cita WHERE PK_codigo_ci = $id");
    $citaActual = mysqli_fetch_assoc($consultaCita);

    
    if ($Fecha_Hora != $citaActual['Fecha_Hora'] || $PK_estado != $citaActual['PK_estado']) {
        
        $update = $link->query("UPDATE tbl_cita SET Fecha_Hora = '$Fecha_Hora', Estado_Cita = $PK_estado WHERE PK_codigo_ci = $id");

        if ($update) {
            header("location: dashboard.php?citas=false&citas=true&message=La cita se ha actualizado exitosamente&message_type=warning");
        } else {
            echo "Error al actualizar la cita: " . $link->error;
        }
    } else {
        header("location: dashboard.php?citas=false&citas=true");
    }
}
