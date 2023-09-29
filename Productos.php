<?php


include 'conexion/conexion.php';
include "includes/header.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>

  <title>Servicios</title>
  <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
  <link rel="stylesheet" href="CSS/index.css" />
  <link rel="stylesheet" href="CSS/Services.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootsrtrap -->
  <link rel="stylesheet" href="Boostrap/CSS/bootstrap.min.css">
  <!-- Iconos Boxicon -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Script -->
  <script src="https://kit.fontawesome.com/38e49ed3f9.js" crossorigin="anonymous"></script>
  <!-- CSS TABLA -->
  <link rel="stylesheet" href="CSS/tabla.css">
  <!-- JAVASCRIPT CALENDARIO -->
  <script src="js/calendario.js" defer></script>
  <!-- Google fonts link for icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


  <!-- Iconos Boxicon -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Script -->
  <script src="https://kit.fontawesome.com/ddcfba4d85.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    .header {
      background: url('CSS/Spa.jpg');
      display: flex;
      justify-content: center;
      align-items: center;

    }

    .decrementar-cantidad {
      border-radius: 50px;
      margin-right: 20px;
    }

    .incrementar-cantidad {
      border-radius: 50px;
      margin-left: 20px;
    }

    @media screen and (max-width: 991.98px) {

      .header {
        background: none;
      }

      .header {
        background-color: white;
        display: flex;
        justify-content: center;
        text-align: center;

      }

      .nav-item {
        margin-top: 3%;
      }

      .navbar-nav,
      .header {
        display: inline-flex;
        justify-content: center;
        align-items: center;
      }

      #Servicios-content {
        display: inline-flex;
        justify-content: center;
        align-items: center;
      }
    }

    #ventana {

      position: fixed;
      left: 10%;
      top: 80px;
      width: 100%;
      height: 90%;
      background-color: #f2f2f2;
      border-radius: 40px;
      padding: 20px;

    }

    .content {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      padding: 20px;
      justify-content: center;
      align-items: center;
      transition: transform 0.5s ease-in-out;


    }

    #content1 {

      transform: translateX(0);
    }

    #content2 {

      transform: translateX(150%);
    }

    .scrollable-div {
      width: 100%;
      /* Ancho del div */
      height: 40%;
      /* Altura del div */
      overflow: auto;
      /* Añadir desplazamiento cuando el contenido excede el tamaño del div */

      /* Añadir un borde para mayor claridad */
    }
  </style>
</head>

<body>
  <!-- NAVBAR CREATION -->


  <!-- Cargador de página -->
  <!-- 
    <div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>

 -->

  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link nav-link-1 active" aria-current="page" href="Productos.php">Catalogo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-4" href="contacto.php">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <h1 style="margin-top: 20px;text-align: center;" class="display-5">Nuestros Productos</h1>
  <center>
    <hr style="width: 75%;" class="mb-5">
  </center>



  <div class="container-fluid">
    <div class="row">
      <?php
      $query = "SELECT * FROM tbl_productos";
      $resultado = mysqli_query($link, $query);

      while ($mostrar = mysqli_fetch_array($resultado)) {
      ?>


        <div class="col-sm-12 col-md-4 col-xl-3 col-xxl-3 mt-5 " id="Servicios-content" style="margin-bottom: 55px;">
          <div class=" card" style="width: 18rem;">
            <?php echo ' <img class="imagen" src="data:image/jpeg;base64, ' . base64_encode($mostrar['Imagen']) . '" style="width: 220px; height: 190px; margin-left: 32px; padding-top: 10px; border-radius: 20px;" />'; ?>

            <div class="card-body">
              <center>
                <h3 class="titulo-item mb-4"> <?php echo $mostrar['Nombre'] ?> </h3>
              </center>
              <input type="hidden" id="Nombre<?php echo $mostrar['PK_codigo_pr'] ?>" value="<?php echo $mostrar['Nombre'] ?>">
              <div class="valor">
                <center>
                  <span class="titulo-item"> $<?php echo $mostrar['Precio'] ?></span>
                </center>

                <input type="hidden" id="Valor<?php echo $mostrar['PK_codigo_pr'] ?>" value="<?php echo $mostrar['Precio'] ?>">
              </div>
              <br>


              <center><button class="btn btn-primary botones Agregar" id="AddToshop<?php echo $mostrar['PK_codigo_pr'] ?>" data-imagen="<?php echo 'data:image/jpeg;base64, ' . base64_encode($mostrar['Imagen']); ?>">Agregar</button></center>



            </div>
          </div>

        </div>

      <?php

      }
      ?>

      <?php include 'includes/footer.php'  ?>

      <div id="editarModal" class="modal">
        <div class="modal-content">

          <div id="ventana" class="container">

            <div class="container" id="ventana">
              <button onclick="cerrarModal()" class="btn btn-primary" style="position: absolute;z-index: 1000; border-radius: 20px;"><i class="fa-solid fa-left-long"></i> Continuar comprando</button>
              <br><br>
              <center>
                <h2>Carrito de compras</h2>
              </center>

              <!-- ... Tu código HTML previo ... -->

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody id="carrito-body">
                  <!-- Aquí se generan las filas del carrito dinámicamente -->
                </tbody>
              </table>
              <p>Total: <span id="total">0</span></p>
              <div id="paypal-button-container"></div>


              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  const agregarBotones = document.querySelectorAll(".Agregar");
                  const carritoBody = document.getElementById("carrito-body");
                  const totalSpan = document.getElementById("total");

                  let carrito = [];

                  agregarBotones.forEach((boton) => {
                    boton.addEventListener("click", function() {
                      const codigo = boton.id.replace("AddToshop", "");
                      const imagen = boton.getAttribute("data-imagen");
                      const nombre = document.getElementById("Nombre" + codigo).value;
                      const precio = parseFloat(document.getElementById("Valor" + codigo).value);
                      const cantidad = 1; // Por defecto, agregar 1 unidad
                      const total = precio * cantidad;

                      // Verificar si el producto ya existe en el carrito
                      const productoExistente = carrito.find((producto) => producto.codigo === codigo);

                      if (productoExistente) {
                        productoExistente.cantidad += cantidad;
                        productoExistente.total += total;
                      } else {
                        carrito.push({
                          codigo,
                          imagen,
                          nombre,
                          precio,
                          cantidad,
                          total
                        });
                      }

                      // Actualizar vista del carrito
                      actualizarCarrito();
                    });
                  });

                  function actualizarCarrito() {
                    carritoBody.innerHTML = "";
                    let totalCarrito = 0;

                    carrito.forEach((producto) => {
                      totalCarrito += producto.total;

                      const fila = document.createElement("tr");
                      fila.innerHTML = `
        <td > <img src="${producto.imagen}"> </td>
        <td >${producto.nombre}</td>
        <td >$${producto.precio}</td>
        <td>
       
          <button class="btn btn-outline-danger decrementar-cantidad" data-codigo="${producto.codigo}">-</button>
          ${producto.cantidad}
          <button class="btn btn-outline-success incrementar-cantidad" data-codigo="${producto.codigo}">+</button>
          
        </td>
        <td >$${producto.total}</td>
        <td ><button class="btn btn-danger delete-product" data-codigo="${producto.codigo}"><i class="fa-solid fa-trash-can"></i></button></td>

        
      `;

                      carritoBody.appendChild(fila);
                    });

                    totalSpan.textContent = "$" + totalCarrito.toFixed(2);

                    // Agregar evento de eliminación a los botones de eliminar
                    const eliminarBotones = document.querySelectorAll(".delete-product");
                    eliminarBotones.forEach((eliminarBoton) => {
                      eliminarBoton.addEventListener("click", function() {
                        const codigo = eliminarBoton.getAttribute("data-codigo");
                        eliminarProducto(codigo);
                      });
                    });

                    // Agregar evento de incremento de cantidad
                    const incrementarBotones = document.querySelectorAll(".incrementar-cantidad");
                    incrementarBotones.forEach((incrementarBoton) => {
                      incrementarBoton.addEventListener("click", function() {
                        const codigo = incrementarBoton.getAttribute("data-codigo");
                        incrementarCantidad(codigo);
                      });
                    });

                    // Agregar evento de decremento de cantidad
                    const decrementarBotones = document.querySelectorAll(".decrementar-cantidad");
                    decrementarBotones.forEach((decrementarBoton) => {
                      decrementarBoton.addEventListener("click", function() {
                        const codigo = decrementarBoton.getAttribute("data-codigo");
                        decrementarCantidad(codigo);
                      });
                    });
                  }

                  function eliminarProducto(codigo) {
                    // Encuentra el índice del producto en el carrito
                    const indiceProducto = carrito.findIndex((producto) => producto.codigo === codigo);

                    // Si se encuentra el producto en el carrito, elimínalo
                    if (indiceProducto !== -1) {
                      const productoEliminado = carrito.splice(indiceProducto, 1)[0];

                      // Actualizar vista del carrito
                      actualizarCarrito();
                    }
                  }

                  function incrementarCantidad(codigo) {
                    const producto = carrito.find((producto) => producto.codigo === codigo);
                    if (producto) {
                      producto.cantidad++;
                      producto.total = producto.cantidad * producto.precio;
                      actualizarCarrito();
                    }
                  }

                  function decrementarCantidad(codigo) {
                    const producto = carrito.find((producto) => producto.codigo === codigo);
                    if (producto && producto.cantidad > 1) {
                      producto.cantidad--;
                      producto.total = producto.cantidad * producto.precio;
                      actualizarCarrito();
                    }
                  }
                });
              </script>



              <script>
                // Inicializar el SDK de PayPal
                paypal
                  .Buttons({
                    createOrder: function(data, actions) {
                      // Crear una orden de PayPal cuando se haga clic en el botón de pago
                      return actions.order.create({
                        purchase_units: [{
                          amount: {
                            currency_code: 'USD', // Cambia la moneda según tus necesidades
                            value: calcularTotal() // Calcula el total del carrito
                          }
                        }]
                      });
                    },
                    onApprove: function(data, actions) {
                      // Capturar el pago cuando se apruebe la orden
                      return actions.order.capture().then(function(details) {
                        // Puedes guardar los detalles de la transacción en tu base de datos aquí
                        alert('Pago completado con éxito. ID de transacción: ' + details.id);
                      });
                    }
                  })
                  .render('#paypal-button-container');

                // Manejar la sumisión del formulario de carrito
                document.getElementById('carrito-form').addEventListener('submit', function(event) {
                  event.preventDefault();

                  // Recuperar los valores del formulario
                  var producto = document.getElementById('producto').value;
                  var precio = parseFloat(document.getElementById('precio').value);
                  var cantidad = 1; // Por defecto, agregar 1 unidad
                  var total = precio * cantidad;

                  // Agregar el producto al carrito
                  agregarProductoAlCarrito(producto, precio, cantidad, total);

                  // Limpiar el formulario
                  document.getElementById('producto').value = '';
                  document.getElementById('precio').value = '';
                });

                // Función para agregar un producto al carrito
                function agregarProductoAlCarrito(producto, precio, cantidad, total) {
                  var carritoList = document.getElementById('carrito-body');
                  var fila = document.createElement('tr');
                  fila.innerHTML = `
                <td>${producto}</td>
                <td>$${precio.toFixed(2)}</td>
                <td>${cantidad}</td>
                <td>$${total.toFixed(2)}</td>
                <td><button class="eliminar-producto">Eliminar</button></td>
            `;
                  carritoList.appendChild(fila);

                  // Actualizar el total del carrito
                  actualizarTotal();

                  // Agregar evento para eliminar productos
                  var eliminarBotones = document.querySelectorAll('.eliminar-producto');
                  eliminarBotones.forEach(function(boton) {
                    boton.addEventListener('click', function() {
                      var fila = boton.parentNode.parentNode;
                      fila.parentNode.removeChild(fila);
                      actualizarTotal();
                    });
                  });
                }

                // Función para calcular el total del carrito
                function calcularTotal() {
                  var total = 0;
                  var filas = document.querySelectorAll('#carrito-body tr');
                  filas.forEach(function(fila) {
                    var precio = parseFloat(fila.children[1].textContent.replace('$', ''));
                    var cantidad = parseInt(fila.children[2].textContent);
                    total += precio * cantidad;
                  });
                  return total;
                }

                // Función para actualizar el total del carrito
                function actualizarTotal() {
                  var total = calcularTotal();
                  document.getElementById('total').textContent = total.toFixed(2);
                }
              </script>







              <div id="content2" class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12 col-lg-7 col-lg-7 col-xl-7 col-xxl-7">
                      <div id="cita">
                        <h6 class="display-6" style="text-align: center;">Selecciona la fecha</h6>
                        <center>
                          <hr style="width: 75%;">
                          <div class="wrapper">
                            <header style="background: none;">
                              <p class="current-date">
                              </p>
                              <div class="icons">
                                <span id="prev" class="material-symbols-outlined">
                                  chevron_left
                                </span>
                                <span id="next" class="material-symbols-outlined">
                                  chevron_right
                                </span>
                              </div>
                            </header>
                            <div class="calendar">
                              <ul class="weeks">
                                <li class="text-truncate">Domingo</li>
                                <li class="text-truncate">Lunes</li>
                                <li class="text-truncate">Martes</li>
                                <li class="text-truncate">Miercoles</li>
                                <li class="text-truncate">Jueves</li>
                                <li class="text-truncate">Viernes</li>
                                <li class="text-truncate">Sabado</li>
                              </ul>
                              <ul class="days">

                              </ul>
                            </div>
                          </div>

                        </center>

                      </div>
                      <button onclick="reverseTransition()">Seleccionar</button>

                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 col-xxl-5" style="margin-top: 10px;">
                      <div class="scrollable-div">

                        <table>
                          <tr>
                            <th class="borde1" style="border-top: none;">Hora</th>
                            <th class="borde2" style="border-top: none;">Contenido</th>
                          </tr>
                          <tr>
                            <td class="borde1">6:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">7:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">8:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">9:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">10:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>

                          <tr>
                            <td class="borde1">11:00 AM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>

                          <tr>
                            <td class="borde1">12:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>

                          <tr>
                            <td class="borde1">1:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">2:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">3:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">4:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">5:00 PM</td>
                            <td><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1">6:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>


                          <tr>
                            <td class="borde1">7:00 PM</td>
                            <td class="borde2"><span class="Selecciona">Seleccionar Hora</span></td>
                          </tr>
                          <tr>
                            <td class="borde1" style="border-bottom: none;">8:00 PM</td>
                            <td class="borde2" style="border-bottom: none;"><span class="Selecciona">Seleccionar Hora</span>
                            </td>
                          </tr>
                        </table>

                      </div>

                    </div>



                  </div>


                </div>

              </div>



            </div>

          </div>

        </div>



      </div>

      <script>
        function transition() {
          var content1 = document.getElementById("content1");
          var content2 = document.getElementById("content2");

          content1.style.transform = "translateX(-120%)";
          content2.style.transform = "translateX(0)";
        }

        function reverseTransition() {
          var content1 = document.getElementById("content1");
          var content2 = document.getElementById("content2");

          content1.style.transform = "translateX(0)";
          content2.style.transform = "translateX(150%)";
        }
      </script>
      <script>
        // Función para mostrar la ventana emergente
        function mostrarVentanaEmergente() {
          var modal = document.getElementById("editarModal");
          modal.style.display = "block";
        }
        //funcion para cerrar ventana emergente
        function cerrarModal() {
          var modal = document.getElementById("editarModal");
          modal.style.display = "none";
        }
      </script>






      <script src="js/plugins.js"></script>
      <script>
        // $(window).on("load", function () {
        //   $("body").addClass("loaded");
        // });
      </script>
</body>

</html>