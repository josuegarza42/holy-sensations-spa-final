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

<?php
$qry = "select u.Nombre,u.Email,u.Direccion,r.Nombre as NombreRol from usuarios as u inner join roles as r on u.idRol=r.idRol where u.idUsuario =" . $_SESSION['idU'];
$rs = mysqli_query($conn, $qry);
$dUsr = mysqli_fetch_object($rs); //datos del usuario

if ($rolUsr == "General") {

    despliegaDatos($dUsr);
}

if ($rolUsr == "Administrador") {

    despliegaDatos($dUsr);
}

?>

