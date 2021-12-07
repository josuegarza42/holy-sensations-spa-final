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
        menuAdmin($NombreUsr);
        echo "<h1>Hola " . $_SESSION['nombre'] . "</h1>";
    }
}
?>

<div class="jumbotron text-center">
    <h1 class="display-3">Nosotros</h1>
    <p class="lead">Somos una empresa que ofrece a mujeres un excelente servicio de masajes, faciales, depilaciones, cursos y venta de diversos productos.</p>
    <img src="img/Portada de Facebook de cumpleaños de agosto floral marrón y verde oliva.png" alt="" width="100%" height="80%">
</div>

<div class="container marketing">
    <br>
    <!-- Three columns of text below the carousel -->
    <div class="text-center row">
        <div class="col-lg-12">
            <img class="bd-placeholder-img rounded-circle" src="img/imagenmama.jpeg" width="200" height="200">
            <h2>Leticia Garza Galvan</h2>
            <p>Especialista en terapias SPA y tratamientos holisticos.</p>
            <p><a class="btn btn-secondary" href="https://wa.me/c/5214446588106">Contactala &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.col-lg-4 -->
</div><!-- /.row -->

<?php include("template/footer.php")
?>