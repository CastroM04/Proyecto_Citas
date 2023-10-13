<?php
if ($seccion == 'Inicio') {
    $Accion = 2; /*Eliminar o desactivar*/
    $Class_button = 'danger';
    $Class_icon = 'fa-solid fa-xmark';
    $message_conirm = '¿ Estas seguro que deseas eliminar estos datos ?';
    $Reload="Servicios";
} else
    if ($seccion == 'Eliminados') {
    $Accion = 1; /*Activar*/
    $Class_button = 'success';
    $Class_icon = 'fa-solid fa-check';
    $message_conirm = '¿ Estas seguro que deseas activar estos datos ?';
    $Reload="Servicios_eliminados";
}



?>

<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<div class="button-actions">


    <?php if ($seccion == 'Eliminados') { ?>
        <a href="<?php echo base_url('Servicios') ?>" class="btn btn-outline-dark mt-4 ml-4 button-add">Volver</a>
    <?php } else { ?>
        <button class="btn btn-outline-dark mt-4 ml-4 button-add" onclick="Servicios()">Agregar Servicios</button>
        <a href="<?php echo base_url('Servicios_eliminados') ?>" class="btn btn-outline-danger mt-4 ml-4 button-add">Eliminados</a>
    <?php } ?>
</div>
<section class="Servicios-content" id="Servicios-content">


    <?php
    foreach ($servicios as $dato) {
        echo '<div class="contenedor-pro" >';
        echo '<div class="contenedor" >';
        echo '<h3 class="titulo" >' . $dato['Descripcion'] . '</h3>';
        echo ' <img class="img-item" src="' . base_url() . 'img/servicios/' . $dato['Imagen'] . '" />';


    ?>
        <div class="container-input">


            <a class="btn btn-outline-dark mr-4" style="border-radius: 100%;" href=""><i class=" fa-solid fa-eye"></i></a>
            <a href="javascript:void(0)" onclick="Confirmacion(<?php echo $dato['PK_codigo_se'] ?>)" class="btn btn-outline-<?php echo $Class_button; ?> button-group" style="border-radius: 100%;"><i class="<?php echo $Class_icon; ?>"></i></a>

        </div>
        <?= '</div>' ?>
        <?= '</div>' ?>
    <?php } ?>
    </div>
</section>
<section id="Reload-seccion" style="height: 100%;display: none;">
    <center>
        <a href="<?php echo base_url($Reload); ?>" class="display-5 mt-5" style="color: gray;text-decoration: none;">
            <i class="fa-solid fa-rotate fa-2xl"></i>
            <h1 class="mt-5">Recargar</h1>
        </a>
    </center>
</section>


<!-- Modales -->
<div id="ModalServicios" class="modal">
    <div class="modal-content">
        <div class="FormServices Form">

            <div class="formulario">

                <form action="<?php echo base_url() ?>insertar_servicio" method="post" enctype="multipart/form-data">
                    <h4 class="display-5">Agregar Servicios</h4>
                    <div class="container-flui">
                        <div class="row">
                            <div class="col-4">
                                <label for="TipoSer" class="form-label">Tipo de servicio</label>
                                <select name="Categoria" id="Categoria" class="form-select" style="height: 50px;">



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
<div id="Confirmacion" class="modal">
    <div class="modal-content">

        <h5 class="display-5">Advertencia</h5>
        <p>
            <?php echo $message_conirm; ?>
        </p>
        <span>
            <input type="hidden" id="id_servicio" value="">
            <input type="hidden" id="Accion_estado" value="<?php echo $Accion; ?>">
            <button onclick="EstadoServicio()" class="btn btn-outline-<?php echo $Class_button; ?> mr-4">
                Confirmar
            </button>
            <a href="javascript:void(0)" onclick="Confirmacion()" class="btn btn-outline-dark ml-4">
                Cerrar
            </a>
        </span>

    </div>

</div>


<script src="<?php echo base_url() ?>/js/servicios.js"></script>


<script>
    function EstadoServicio() {

        var id_servicio = $("#id_servicio").val();
        var Accion = $("#Accion_estado").val();
        var dataURL = "<?php echo base_url('Estados_Servicios') ?>" + "/" + id_servicio + "/" + Accion;
        $.ajax({
            type: "POST",
            url: dataURL,
            dataType: "json",
            success: function(rs) {
                alert(e['responseText']);

            },
            error: function(s) {
                modal = document.getElementById('Confirmacion');
                modal.style.display = "none";
                Reload = document.getElementById('Reload-seccion');
                Reload.style.display = "flex";
                Reload.style.justifyContent = "center";
                Reload.style.height = "100%";
                Servicios = document.getElementById('Servicios-content');
                Servicios.style.display = "none";
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: s['responseText'],
                    showConfirmButton: false,
                    timer: 2000
                });


            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>