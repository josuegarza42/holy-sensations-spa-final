<?php
session_start(); //haga uso del arreglo de sessión
include("funciones.php");
$total = 0;
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
        //   boton para ir a adm y boton para regresar
        menuAdmin($NombreUsr);
        echo "<h1>Hola " . $_SESSION['nombre'] . "</h1>";
    }
}
?>




<div class="container-fluid">
    <div class="card mb-4">
        <div class="row g-0">
            <?php
            $qry = "select * from carrito where idUsuario=" . $_SESSION['idU'];
            $rs = mysqli_query($conn, $qry);
            if (mysqli_num_rows($rs)) {
                while ($idCarrito = mysqli_fetch_array($rs)) {
                    $qry2 = "select * from producto where idProducto=" . $idCarrito["idProducto"];
                    $rs2 = mysqli_query($conn, $qry2);
                    if (mysqli_num_rows($rs2)) {

                        while ($idProducto = mysqli_fetch_array($rs2)) {
            ?>
                            <?php
                            $precio = $idProducto["Precio"];
                            $CantidadCarrito = $idCarrito["Cantidad"];
                            $total = $total + ($CantidadCarrito * $precio);
                            ?>
                            <div class="col">
                                <img src="./img/<?php echo $idProducto['Imagen']; ?>" class="img-fluid rounded-start" alt="...">
                            </div>

                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $idProducto['Nombre']; ?></h5>
                                    <p class="card-text">
                                        Precio: $ <?php echo $idProducto['Precio']; ?>
                                        <br>
                                        Cantidad de productos: <?php echo $idCarrito['Cantidad']; ?>
                                    </p>
                                    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                </div>
                            </div>
        </div>
    </div>
</div>

<?php
                        }
                    }
                }
            } else {
?>
<br>
<h3 class="h3 mx-auto" style="text-align:center">No tienes productos en tu carrito</h3>
<br>
<?php
            }
?>

<h3>El total de tu compra es de: $<?php echo $total ?></h3>

<?php include("template/footer.php");
?>