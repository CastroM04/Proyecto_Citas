function Servicios() {
    var modal = document.getElementById("ModalServicios");
    modal.style.display = "block";
}

function cerrarServicios() {
    var modal2 = document.getElementById("ModalServicios");
    modal2.style.display = "none";
}
function Confirmacion(id) {
    var modal9 = document.getElementById("Confirmacion");
    $("#id_servicio").val(id);
    if (modal9.style.display == "block") {
        modal9.style.display = "none"
    } else {
        modal9.style.display = "block"
    }
 
}
