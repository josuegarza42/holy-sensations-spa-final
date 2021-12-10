<?php
function conectaBD()
{
    return mysqli_connect("localhost", "root", "", "spa");
}

$ruta = "http://localhost/holy%20sensations%20spa/";
$rutaADM = "http://localhost/holy%20sensations%20spa/administrador/seccion/";
$itemsCarrito = 0;
function recuperaRol($c)
{
    //el usuario debe estar autenticado por medio de $_SESSION["idU"]
    $qry = "select R.Nombre from roles as R inner join usuarios as U on R.idRol=U.idRol where U.idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($c, $qry);
    $filaNombre = mysqli_fetch_object($rs);
    return $filaNombre->Nombre;
}

function recuperaCantidad($c)
{
    $total = 0;
    $qry = "select Cantidad from carrito where idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($c, $qry);

    if (mysqli_num_rows($rs)) {
        while ($Cantidades = mysqli_fetch_array($rs)) {

            $total = $total + $Cantidades['Cantidad'];
        }
    }
    return $total;
}

function recuperaNombre($c)
{
    //el usuario debe estar autenticado por medio de $_SESSION["idU"]
    $qry = "select Nombre from usuarios where idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($c, $qry);
    $filaNombre = mysqli_fetch_object($rs);
    return $filaNombre->Nombre;
}

function recuperaContra($c)
{
    //el usuario debe estar autenticado por medio de $_SESSION["idU"]
    $qry = "select Pwd from usuarios where idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($c, $qry);
    $filaNombre = mysqli_fetch_object($rs);
    return $filaNombre->Pwd;
}
function recuperaId($c)
{
    //el usuario debe estar autenticado por medio de $_SESSION["idU"]
    $qry = "select idUsuario from usuarios where idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($c, $qry);
    $filaNombre = mysqli_fetch_object($rs);
    return $filaNombre->idUsuario;
}

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
                        <a href="cursos.php" class="nav-link">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="nosotros.php" class="nav-link">Nosotros</a>
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
function navbarAth()
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
                        <a href="cursos.php" class="nav-link">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="nosotros.php" class="nav-link">Nosotros</a>
                    </li>
                    <!-- carrito -->
                    <li class="nav-item d-md">
                        <?php
                        $conn = conectaBD();
                        $itemsCarrito = recuperaCantidad($conn);
                        ?>
                        <a href="verCarrito.php" class="nav-link"><i class="bi bi-cart2"></i> <?php echo $itemsCarrito; ?> </a>

                    </li>

                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="cuenta.php" class="btn btn-secondary">Cuenta</a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="logout.php" class="btn btn-secondary">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php
}
?>



<?php
function menuAdmin()
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
                        <a href="cursos.php" class="nav-link">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a href="nosotros.php" class="nav-link">Nosotros</a>
                    </li>
                    <!-- carrito -->
                    <li class="nav-item d-md">
                        <?php
                        $conn = conectaBD();
                        $itemsCarrito = recuperaCantidad($conn);
                        ?>
                        <a href="verCarrito.php" class="nav-link"><i class="bi bi-cart2"></i> <?php echo $itemsCarrito; ?> </a>

                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="http://localhost/holy%20sensations%20spa/administrador/inicio.php" class="btn btn-secondary">Administrar</a>
                    </li>

                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="cuenta.php" class="btn btn-secondary">Cuenta</a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a href="logout.php" class="btn btn-secondary">Salir</a>
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

<?php
function estructuraPrincipalIndex()
{
?>
    <!-- Carousel -->

    <section id="Carousel">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/3.png" class="img-fluid" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="img/1.png" class="img-fluid" alt="...">

                </div>
                <div class="carousel-item">
                    <img src="img/2.png" class="img-fluid" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section id="reviews" class=" my-5">
        <div class="container-lg">
            <div class="text-center">
                <h2><i class="bi bi-stars"></i>Reviews</h2>
                <p class="lead">En esta seccion colocamos las reviews de diferentes clientes que nos han dado el honor de probar nuestros servicios.</p>
            </div>

            <div class="row justify-content-center my-5">
                <div class="col-lg-8">
                    <div class="list-group">
                        <div class="bg-light list-group-item py-3">
                            <div class="pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-1">
                                <p> Me ayudo a bajar de peso.</p>
                            </h5>
                            <p class="mb-1">Gracias a la dieta, ejercicio y masajes reductivos puedo tener el cuerpo que hoy tengo, un servicio muy recomendado.</p>
                            <small>Review by: Maria Villanueva.</small>
                        </div>
                        <!--  -->
                        <div class="bg-light list-group-item py-3">
                            <div class="pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-1">
                                Reduje mi estres con estos masajes.
                            </h5>
                            <p class="mb-1">Antes tenia que acudir a remedios medicados para dormir, pero ahora puedo descansar de mejor manera, muchas gracias</p>
                            <small>Review by: Samara Castillo.</small>
                        </div>
                        <!--  -->
                        <div class="bg-light list-group-item py-3">
                            <div class="pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-1">
                                Nos ayudo mucho, gran terapeuta.
                            </h5>
                            <p class="mb-1">Con sus cursos de masaje pude conseguir un buen trabajo en un spa.</p>
                            <small>Review by: Sarahi Esquivel.</small>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>


<?php
function despliegaDatos($dUsr)
{
?>
    <div class="container-fluid">
        <br>
        <h3 class="h3 mx-auto" style="text-align:center">Tú Perfil</h3>
        <br>
        <div class="card mb-4 mx-auto" style="max-width: 320px;">
            <div class="col">
                <div class="card-body">
                    <h5 class="card-title"><b>Nombre:</b> <?php echo $_SESSION['nombre'] ?></h5>
                    <p class="card-text">
                    <p class="card-text"><small class="text-muted">Información de usuario:</small></p>
                    <b>Email: </b> <?php echo $dUsr->Email ?><br>
                    <b>Rol: </b> <?php echo $dUsr->NombreRol ?><br>
                    <b>Direccion: </b> <?php echo $dUsr->Direccion ?><br>

                    </p>

                    <a name="" id="" class="btn btn-danger" href="eliminarCuenta.php" role="button">Eliminar cuenta</a>
                </div>
            </div>

        </div>
    </div>
<?php
}
?>