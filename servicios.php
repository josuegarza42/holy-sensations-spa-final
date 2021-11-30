<?php
session_start(); //haga uso del arreglo de sessión
include("funciones.php");

//conexión a la base de datos
$conn = conectaBD();
if (isset($_SESSION['idU']) && isset($_SESSION['nombre']))    //el usuario se autenticó
{
    $rolUsr = recuperaRol($conn);
    $NombreUsr = recuperaNombre($conn);
}
?>

<!-- Template header -->
<?php include("template/header.php");
// decidimos que haremos si el usuario es autenticado, no autenticado o admin
if (isset($_SESSION['idU']) == "" && isset($_SESSION['nombre']) == "")    //el usuario no se autenticó
{
    menuNormal();

}
if (isset($_SESSION['idU']) && isset($_SESSION['nombre']))    //el usuario se autenticó
{
    if ($rolUsr == "General") {
        navbarAth();
        echo "<h1>Hola " . $_SESSION['nombre'] . "</h1>";

    }
    if ($rolUsr == "Administrador") {
        // encabezado();
        // menuAdmin($NombreUsr);
    }
}
?>

<h1>Servicios</h1>
<!-- TODO LA IMAGEN ESTA DE PRUEBA a espera de ADM -->
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="img/masajes.png" alt="">
        <div class="card-body">
            <h4 class="card-title">Masajes</h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button"> <i class="bi bi-cart-plus"></i> </a>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">

        <img class="card-img-top" src="img/masajes.png" alt="">
        <div class="card-body">
            <h4 class="card-title">Masajes</h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button"> <i class="bi bi-cart-plus"></i> </a>
        </div>
    </div>
</div>



<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="img/masajes.png" alt="">
        <div class="card-body">
            <h4 class="card-title">Masajes</h4>
            <a name="" id="" class="btn btn-primary" href="#" role="button"> <i class="bi bi-cart-plus"></i> </a>
        </div>
    </div>
</div>










<?php include("template/footer.php")
?>