<?php



include "includes/header.php";

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos Para El Cuidado Facial</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.min.css" />
    <link rel="stylesheet" href="CSS/Productos.css" />
   
  </head>
  <body>
  
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
      
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link nav-link-1 "
                aria-current="page"
                href="Productos.php"
                >Catalogo</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-4" href="contacto.php">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div
      class="tm-spa d-flex justify-content-center align-items-center"
      data-parallax="scroll"
      data-image-src="img/spa-fondo.jpg"
    >
      <form class="d-flex tm-search-form">
        <input
          class="form-control tm-search-input"
          type="search"
          placeholder="Buscar"
          aria-label="Search"
        />
        <button class="btn btn-outline-success tm-search-btn" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
      <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">Productos Para El Cuidado Facial</h2>
      </div>
      <div class="row tm-mb-90">
        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
          <img src="img/cuidado_facial.jpg" alt="Image" class="img-fluid" />
        </div>
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
          <div class="tm-bg-gray tm-video-details">
            <p class="mb-4">
              Los productos para el cuidado facial son aquellos diseñados
              específicamente para mantener y mejorar la salud y apariencia de
              la piel del rostro. Estos productos están formulados con
              ingredientes cuidadosamente seleccionados y se utilizan para
              limpiar, hidratar, tratar y proteger la piel facial.
            </p>
            <div class="text-center mb-5"></div>
            <div class="mb-4 d-flex flex-wrap">
              <div class="mr-4 mb-2"></div>
              <div class="mr-4 mb-2">
                <span class="tm-text-gray-dark"> </span
                ><span class="tm-text-primary"></span>
              </div>
            </div>
            <div class="mb-4">
              <h3 class="tm-text-gray-dark mb-3">Uso</h3>
              <p><a href="#" >Casa</a> <br>
                <a href="#" >PROFESIONAL</a></p>
            </div>
            <div>
              <h3 class="tm-text-gray-dark mb-3">Etiquetas  </h3>
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Limpieza facial</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Hidratación</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Tratamientos faciales</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Antiarrugas</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Antimanchas</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Tonificación facial</a
              >
              <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                >Protección solar</a
              >
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">Productos De Cuidado Facial</h2>
      </div>
      <div class="row mb-3 tm-gallery">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/limpiador_facial.webp"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Limpiador Facial</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 19.900</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/tonico-facial.jpg"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Tonico Facial</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 15.500 </span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/suero_facial.jpg"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Suero facial</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 73,200</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/crema_hidratante.png"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Crema Hidratante</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 43,900</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/mascarilla_facial.jpg"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Mascarilla Facail</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 29.800</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/mascarilla_exfoliante.jpg"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Exfoliante facial</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 90.000</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/contorno_ojos.jpg"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Contorno de ojos</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 70.000</span>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
          <figure class="effect-ming tm-video-item">
            <img
              src="img/protector_solar_facial.webp"
              alt="Image"
              class="img-fluid"
              style="width: 100%; height: 250px"
            />
            <figcaption
              class="d-flex align-items-center justify-content-center"
            >
              <h2>Protector solar facial</h2>
              <a href="#">Ver Mas</a>
            </figcaption>
          </figure>
          <div class="d-flex justify-content-between tm-text-gray">
            <span class="tm-text-gray-light">Precio:</span>
            <span>$ 24.150</span>
          </div>
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container-fluid, tm-container-content -->

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
      <div class="container-fluid tm-container-small">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
            <h3 class="tm-text-primary mb-4 tm-footer-title">SPA-PARADISE</h3>
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
      
      // $(window).on("load", function () {
      //   $("body").addClass("loaded");
      // });
    </script>
  </body>
</html>
