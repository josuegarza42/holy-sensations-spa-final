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
$sentenciaSQL = $conexion->prepare("SELECT * FROM curso");
$sentenciaSQL->execute();
// asigna a lista productos todos los datos recuperados  con fetchAll
$listaCursos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- aqui comienza la magia TODO -->
<!-- comienzo de la pagina html -->
<div class="text-center">
    <h1>Cursos</h1>
</div>
<!-- card 1 -->
<?php foreach ($listaCursos as $curso) { ?>

    <div class="col-md-6 mt-3">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $curso['Imagen']; ?>" alt="">
            <div class="card-body">
                <h3 class="card-title"> <?php echo $curso['Nombre']; ?></h3>
                <p class="card-text"><?php echo $curso['Descripcion']; ?></p>
                <p class="card-text"><i class="bi bi-alarm"></i> Duracion del curso:<?php echo $curso['Duracion']; ?></p>
                <p class="card-text"><i class="bi bi-calendar2-week"></i> Fecha:<?php echo $curso['Fecha']; ?></p>
                <p class="card-text"><i class="bi bi-people-fill"></i> Cupo:<?php echo $curso['Cupo']; ?></p>

                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Aun puedes inscribirte a este curso:</label>
                        <p>Coloca tu email y nosotros nos contactamos contigo.</p>
                        <input type="email" class="form-control" id="" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Suscribirse</button>
                </form>
            </div>
        </div>
    </div>
<?php  } ?>
<?php include("template/footer.php");
?>