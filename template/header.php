
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal(home page)</title>
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- css boostrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- carrusel css -->
    <link href="carousel.css" rel="stylesheet">
</head>

<style>
    .carousel-inner img {
        width: 100%;
        height: 100%;
    }
</style>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="index.php" class="navbar-brand">
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
                    <li class="nav-item">
                        <a href="productos.php" class="nav-link">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a href="servicios.php" class="nav-link">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="promociones.php" class="nav-link">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a href="nosotros.php" class="nav-link">Nosotros</a>
                    </li>

                    <li class="nav-item d-md">
                        <a href="#" class="nav-link"><i class="bi bi-cart2"></i></a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="#" class="btn btn-secondary">Login</a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="#" class="btn btn-secondary">Registrate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <div class="row">