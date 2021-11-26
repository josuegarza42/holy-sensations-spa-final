<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR HSS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- css boostrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

</head>

<body>
<!-- url guarda la ruta para poder usar esta variable mas adelante -->
    <?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/holy%20sensations%20spa";
    ?>
    <!-- NAVBAR ADMINISTRADOR -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href=" <?php echo $url ?>/administrador/inicio.php" class="navbar-brand">
                <span class="fw-bold text-secondary">
                    <i class="fas fa-spa"></i>
                    Holy Sensations Spa
                </span>
            </a>
            <!-- mobile app -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- navbar links -->
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
<!-- ESTAMOS EN ESO -->
                    <li class="nav-item">
                        <a href="<?php echo $url ?>/administrador/seccion/productos.php" class="nav-link">ADM Productos</a>
                    </li>

                    <!-- TODO aun no jala -->
                    <li class="nav-item">
                        <a href="#" class="nav-link"> ADM Servicios</a>
                    </li>
                    <!-- TODO aun no jala -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">ADM Promociones</a>
                    </li>
                    <!-- TODO aun no jala -->
                    <li class="nav-item">
                        <a href="#.php" class="nav-link">ADM compras</a>
                    </li>
                    <!-- TODO aun no jala -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">ADM reviews</a>
                    </li>
<!-- ADMINISTRADOR PUEDE REGRESAR A LA PAGINA EN CUESTION -->
                    <li class="nav-item">
                        <a href=" <?php echo $url ?> " class="nav-link">Ver sitio web</a>
                    </li>
<!-- ESTAMOS EN ESO -->
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="<?php echo $url ?>/administrador/seccion/logout.php" class="btn btn-secondary">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <div class="row">