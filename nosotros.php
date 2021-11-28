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

<div class="jumbotron">
    <h1 class="display-3">Nosotros</h1>
    <p class="lead">Somos una empresa que ofrece a mujeres un excelente servicio de masajes, faciales, depilaciones, cursos y venta de diversos productos.</p>
    <img src="img/Portada de Facebook de cumpleaños de agosto floral marrón y verde oliva.png" alt="" width="100%" height="80%">
</div>

<?php include("template/footer.php")
?>