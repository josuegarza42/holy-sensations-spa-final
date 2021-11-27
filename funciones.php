<?php
function conectaBD()
{
    return mysqli_connect("localhost", "root", "", "spa");
}

$ruta = "http://localhost/holy%20sensations%20spa/";

function menuNormal()
{
?>

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
                        <a href="login.php" class="btn btn-secondary">Login</a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="registrate.php" class="btn btn-secondary">Registrate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php
}
?>








<?php
function menuRegistrate()
{
?>
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
            <li class="nav-item ms-2 d-none d-md-inline">
                <a href="login.php" class="btn btn-secondary">Login</a>
            </li>
        </div>
    </nav>

<?php
}
?>

<?php
function menuLogin()
{
?>
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
            <li class="nav-item ms-2 d-none d-md-inline">
                <a href="registrate.php" class="btn btn-secondary">Registrate</a>
            </li>
        </div>
    </nav>

<?php
}
?>