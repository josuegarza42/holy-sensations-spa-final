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
<!-- conexion bd desde adm -->
<?php
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
// asigna a lista productos todos los datos recuperados  con fetchAll
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- comienzo de la pagina html -->
<h1>Productos</h1>
<!-- card 1 -->
<?php foreach ($listaProductos as $producto) { ?>

    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $producto['Imagen']; ?>" alt="">
            <div class="card-body">
                <h4 class="card-title"> <?php echo $producto['Nombre']; ?></h4>
                <p class="card-text">Text</p>
            </div>
        </div>
    </div>
<?php  } ?>





<!-- card 2
<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Title</h4>
            <p class="card-text">Text</p>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Title</h4>
            <p class="card-text">Text</p>
        </div>
    </div>
</div> -->




<?php include("template/footer.php")
?>