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
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
// asigna a lista productos todos los datos recuperados  con fetchAll
$listaServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- aqui comienza la magia TODO -->


<!-- card 1 -->
<?php foreach ($listaServicios as $servicio) { ?>

<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $servicio['Imagen']; ?>" alt="">
        <div class="card-body">
            <h3 class="card-title"> <?php echo $servicio['Nombre']; ?></h3>
            <p class="card-text"><?php echo $servicio['Descripcion']; ?></p>
            <p class="card-text">Precio: <?php echo $servicio['Precio']; ?></p>
            <p class="card-text">Duracion: <?php echo $servicio['Duracion']; ?></p>

        </div>
    </div>
</div>
<?php  } ?>

<?php include("template/footer.php");
?>