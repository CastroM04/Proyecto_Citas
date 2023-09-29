<?php



include "includes/header.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
 
    <title>Acerca</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/Productos.css" />
    <!-- Bootsrtrap -->
    <link rel="stylesheet" href="Boostrap/CSS/bootstrap.min.css">
    <!-- Iconos Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        #one,
        #two,
        #three {
            border: 1px solid gray;
            background-color: #f0f8ffa4;
            border-radius: 30px;
            padding: 20px;
            transition: all 0.2s ease;
        }

        #one:hover,
        #two:hover,
        #three:hover {
            border: 1px solid gray;
            background: none;
            color: black;
            box-shadow: 1px 1px 5px 1px gray;

        }
    </style>
</head>

<body>
    <!-- NAVBAR CREATION -->


    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-3 ">
                <h2 style="text-align: center;"><br>
                    <i class='bx bxl-xing'></i>SPA PARADISE
                </h2>
                <div style=" margin-top: 20px;" id="one">
                    <h6 class="display-5">
                        Quienes Somos
                    </h6>

                    <p>Somos Paradise Spa, un centro de bienestar dedicado a proporcionar servicios de spa y peluquería
                        de alta calidad. Nuestro objetivo principal es ofrecer a nuestros clientes una experiencia
                        completa de relajación, belleza y cuidado personal en un entorno excepcional. <br> <br>

                        En Paradise Spa, nos enorgullece ofrecer una amplia gama de servicios diseñados para rejuvenecer
                        y revitalizar tanto el cuerpo como la mente. Desde masajes terapéuticos y faciales relajantes
                        hasta tratamientos corporales revitalizantes, nuestro equipo de profesionales altamente
                        capacitados está comprometido en brindar un servicio excepcional y personalizado para satisfacer
                        las necesidades individuales de cada cliente.

                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xxl-9 mt-4">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">

                        <div style="margin-top: 70px;" id="two">

                            <h6 class="display-5">
                                Mision
                            </h6>
                            <p>¡En Spa Paradise, nuestra misión es ser el refugio de bienestar y relajación preferido de
                                nuestros clientes, ofreciendo servicios de alta calidad y un ambiente acogedor. Nos
                                comprometemos a proporcionar experiencias rejuvenecedoras y personalizadas que promuevan la
                                salud y el equilibrio mental, físico y espiritual. A través de nuestro enfoque holístico y la
                                atención individualizada a cada cliente, buscamos ser líderes en el sector del cuidado personal,
                                brindando un servicio excepcional que inspire una sensación de serenidad y renovación. </p>

                        </div>



                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                    <div id="three">
                        <h6 class="display-5">
                            Vision
                        </h6>

                        <p>Nuestra visión en Spa Paradise es convertirnos en un destino de referencia en el ámbito del
                            bienestar y la relajación, reconocidos por nuestra excelencia en servicios y nuestra dedicación
                            a la satisfacción total del cliente. Buscamos ser líderes en innovación, introduciendo
                            constantemente nuevos tratamientos y terapias que se alineen con las últimas tendencias y
                            avances en el cuidado personal. Queremos ser conocidos por nuestro enfoque cálido y amable, por
                            el ambiente tranquilo y rejuvenecedor que ofrecemos, y por nuestros profesionales altamente
                            capacitados y comprometidos. Nuestra visión es ser un lugar donde los clientes puedan escapar
                            del estrés diario y experimentar un oasis de paz y bienestar, mejorando su calidad de vida en
                            general.


                    </div>
                </div>
            </div>
        </div>



    </div>
    <?php include 'includes/footer.php'  ?>


</body>

</html>