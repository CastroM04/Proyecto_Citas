<?php


include "includes/header.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog-Z Contact page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/Productos.css">
    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

 
    <!-- Cargador de página -->
    <!-- <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div> -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1" href="Productos.php">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-4 active" aria-current="page" href="contacto.php">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg"></div>

    <div class="container-fluid tm-mt-60">
        <div class="row tm-mb-50">
            <div class="col-lg-4 col-12 mb-5">
                <h2 class="tm-text-primary mb-5">Pagina de contacto</h2>
                <form id="contact-form" action="" method="POST" class="tm-contact-form mx-auto">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control rounded-0" placeholder="Nombre" required />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control rounded-0" placeholder="Correo" required />
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="contact-select" name="inquiry">
                            <option value="-">Subjeto</option>
                            <option value="sales">Ventas &amp; Marketing</option>
                            <option value="creative">Diseño creativo</option>
                            <option value="uiux">UI / EU</option> <!-- UI = Diseño de Interfaz de Usuario,UE = Experiencia de Usuario -->
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea rows="8" name="message" class="form-control rounded-0" placeholder="Mesage" required=></textarea>
                    </div>

                    <div class="form-group tm-text-right">
                        <button type="submit" class="btn btn-primary">Enviar    </button>
                    </div>
                </form>                
            </div>
            <div class="col-lg-4 col-12 mb-5">
                <div class="tm-address-col">
                    <h2 class="tm-text-primary mb-5">Contactos</h2>
                    <p class="tm-mb-50"></p>
                    <p class="tm-mb-50"></p>
                    <address class="tm-text-gray tm-mb-50">
                        
                    </address>
                    <ul class="tm-contacts">
                        <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fas fa-envelope"></i>
                                Correo: spa_paradise@gmail.com
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fas fa-phone"></i>
                                Tel: 3757384
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tm-text-gray">
                                <i class="fas fa-globe"></i>
                                URL: www.spa-paradise.com
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>
            <div class="col-lg-4 col-12">
                <h2 class="tm-text-primary mb-5">Estamos ubicados</h2>
                <!-- Mapa -->
                <div class="mapouter mb-4">
                    <div class="gmap-canvas">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d979.5778430452847!2d-74.77685566329836!3d10.863905152360712!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef5ce0109398cab%3A0x9cbcd54ee91fdbc8!2sSENA%20-%20Centro%20Nacional%20Colombo%20Alem%C3%A1n%20Sede%20Caribe%20Real!5e0!3m2!1ses-419!2sus!4v1687797336366!5m2!1ses-419!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>               
            </div>
        </div>
        <div class="row tm-mb-74 tm-people-row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-5">
                <img src="img/people-1.jpg" alt="Image" class="mb-4 img-fluid">
                <h2 class="tm-text-primary mb-4">Ryan White</h2>
                <h3 class="tm-text-secondary h5 mb-4">Terapeuta de spa</h3>
                <p class="mb-4">
                    profesional encargados de realizar tratamientos y terapias de spa, como masajes, tratamientos faciales, exfoliaciones corporales, envolturas corporales y terapias de agua.
                </p>
                <ul class="tm-social pl-0 mb-0">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-5">
                <img src="img/people-2.jpg" alt="Image" class="mb-4 img-fluid">
                <h2 class="tm-text-primary mb-4">Catherine Pinky</h2>
                <h3 class="tm-text-secondary h5 mb-4">Especialista en uñas</h3>
                <p class="mb-4">
                    realizar tratamientos de manicura y pedicura, incluyendo el cuidado de las uñas, esmaltado, decoración y masajes de manos y pies.
                </p>
                <ul class="tm-social pl-0 mb-0">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-5">
                <img src="img/people-3.jpg" alt="Image" class="mb-4 img-fluid">
                <h2 class="tm-text-primary mb-4">Johnny Brief</h2>
                <h3 class="tm-text-secondary h5 mb-4">Masajista</h3>
                <p class="mb-4">
                    experto en realizar masajes terapéuticos y relajantes, utilizando técnicas específicas para aliviar el estrés, reducir la tensión muscular y mejorar el bienestar general de los clientes.
                </p>
                <ul class="tm-social pl-0 mb-0">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-5">
                <img src="img/people-4.jpg" alt="Image" class="mb-4 img-fluid">
                <h2 class="tm-text-primary mb-4">George Nelson</h2>
                <h3 class="tm-text-secondary h5 mb-4">Esteticista</h3>
                <p class="mb-4">
                    Se encargan de realizar tratamientos de belleza y cuidado de la piel, como limpiezas faciales, exfoliaciones, mascarillas, tratamientos de aromaterapia y otros tratamientos específicos para la piel.
                </p>
                <ul class="tm-social pl-0 mb-0">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div> <!-- contenedor-líquido, tm-contenedor-contenido -->

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
              <h3 class="tm-text-primary mb-4 tm-footer-title"><i class='bx bxl-xing'></i>SPA-PARADISE</h3>
              <p>
                Spa Paradise es tu refugio de bienestar y relajación. Nuestro
                compromiso es ofrecerte una experiencia inigualable en el cuidado
                personal y la revitalización del cuerpo y la mente. Disfruta de
                una amplia gama de tratamientos y servicios de spa, desde masajes
                terapéuticos hasta tratamientos faciales y corporales
                personalizados. Nuestro equipo de profesionales altamente
                capacitados se dedica a brindarte un servicio excepcional y
                garantizar tu máximo confort. Descubre un oasis de tranquilidad y
                renueva tu energía en Spa Paradise. ¡Bienvenido al paraíso del
                bienestar!
              </p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
              <h3 class="tm-text-primary mb-4 tm-footer-title"></h3>
              <ul class="tm-footer-links pl-0">
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
              <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                <li class="mb-2">
                  <a href="https://facebook.com"
                    ><i class="fab fa-facebook"></i
                  ></a>
                </li>
                <li class="mb-2">
                  <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="mb-2">
                  <a href="https://instagram.com"
                    ><i class="fab fa-instagram"></i
                  ></a>
                </li>
                <li class="mb-2">
                  <a href="https://pinterest.com"
                    ><i class="fab fa-pinterest"></i
                  ></a>
                </li>
              </ul>
              <a href="#" class="tm-text-gray text-right d-block mb-2"
                >Condiciones De Uso</a
              >
              <a href="#" class="tm-text-gray text-right d-block"
                >Politica De Privacidad</a
              >
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
              SPA-PARADISE. Reservados todos los derechos.
            </div>
            <div class="col-lg-4 col-md-5 col-12 px-5 text-right">
              Diseñado Por:
              <a
                href="#   "
                class="tm-text-gray"
                rel="sponsored"
                target="_parent"
                >RYS</a
              >
            </div>
          </div>
        </div>
      </footer>
    
    <script src="js/plugins.js"></script>
    <script>
        // $(window).on("load", function() {
        //     $('body').addClass('loaded');
        // });
    </script>
</body>
</html>