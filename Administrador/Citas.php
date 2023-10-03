<?php
$link = new mysqli('localhost', 'root', '', 'procita');
include("../includes/session.php");

if (isset($_POST['RegistrarCita'])) {
    $FK_codigo_se = $_POST['FK_codigo_se'];
    $N_identificacion = $_POST['N_identificacion'];
    $FK_codigo_pe = $_POST['FK_codigo_pe'];
    $Fecha_Hora = $_POST['Fecha_Hora'];
    $Estado_Cita = '3';

    $fechaHoraActual = date('Y-m-d H:i:s'); // Obtener la hora actual
    if (strtotime($Fecha_Hora) < strtotime($fechaHoraActual)) {
        header("location: dashboard.php?citas=true&message=Ingrese una fecha valida.&message_type=danger");
        exit; // Para que no se siga ejecutando el script
    }

    $verificarUsuario = $link->query("SELECT * FROM tbl_usuario WHERE N_identificacion = $N_identificacion");

    if ($verificarUsuario->num_rows > 0) {
        if (!empty($FK_codigo_se) && !empty($N_identificacion) && !empty($FK_codigo_pe) && !empty($Fecha_Hora) && !empty($Estado_Cita)) {
            $Insertar = $link->query("INSERT INTO tbl_cita (FK_codigo_se, N_identificacion, FK_codigo_pe, Fecha_Hora, Estado_Cita) 
            VALUES ($FK_codigo_se, $N_identificacion, $FK_codigo_pe, '$Fecha_Hora', '$Estado_Cita')");

            if ($Insertar) {
                header("location: dashboard.php?citas=true&message=La cita ha sido guardada exitosamente&message_type=success");
            } else {
                echo "Error al agregar la cita: " . $link->error;
            }
        }
    } else {
        header("location: dashboard.php?citas=true&message=El usuario con la identificacion: $N_identificacion no existe. No se puede guardar la cita.&message_type=danger");
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
