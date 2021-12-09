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
<div class="text-center">
    <h1>Servicios</h1>
</div>

<!-- card 1 -->
<?php foreach ($listaServicios as $servicio) { ?>

    <div class="col-md-4 mt-3">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $servicio['Imagen']; ?>" alt="">
            <div class="card-body">
                <h3 class="card-title"> <?php echo $servicio['Nombre']; ?></h3>
                <p class="card-text"><?php echo $servicio['Descripcion']; ?></p>
                <p class="card-text">Precio: <i class="bi bi-currency-dollar"></i><?php echo $servicio['Precio']; ?></p>
                <p class="card-text"><i class="bi bi-alarm"></i> Duracion: <?php echo $servicio['Duracion']; ?></p>
                <p>Unicamente por Whatsapp</p>
            </div>
            <a class="btn btn-primary" target="_blank" href="https://wa.me/c/5214446588106">
                <p>Whatsapp <i class="bi bi-whatsapp"></i></p>
            </a>
        </div>
    </div>
<?php  } ?>

<?php include("template/footer.php");
?>