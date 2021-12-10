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

<script type="text/javascript">
    function confirmaEliminacion() {
        if (window.confirm("Estas por eliminar un producto de tú carrito ¿Seguro que deseas hacerlo?")) {
            if (window.confirm("¿CONFIRMAS que deseas eliminar?")) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>

<div class="container-fluid ">
    <?php
    $qry = "select * from carrito where idUsuario=" . $_SESSION['idU'];
    $rs = mysqli_query($conn, $qry);
    if (mysqli_num_rows($rs)) {
        while ($idCarrito = mysqli_fetch_array($rs)) {
            $qry2 = "select * from producto where idProducto=" . $idCarrito["idProducto"];
            $rs2 = mysqli_query($conn, $qry2);
            if (mysqli_num_rows($rs2)) {

                while ($idProducto = mysqli_fetch_array($rs2)) {
                    $precio = $idProducto["Precio"];
                    $CantidadCarrito = $idCarrito["Cantidad"];
                    $total = $total + ($CantidadCarrito * $precio);
    ?>
                    <!--  -->
                    <div class="card mb-4 mx-auto align-content-center" style="width: 42rem;">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="./img/<?php echo $idProducto['Imagen']; ?>" class="img-fluid rounded-start" width="200px" height="200px" alt="...">
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
                        <a href="eliminaCarrito.php?idP=<?php echo $idCarrito['idProducto']; ?>" class="btn btn-danger">Borrar</a>

                    </div>
                    <div class="card mb-4 mx-auto align-content-center" style="width: 42rem;">
                        <a href="comprarAhora.php" class="btn btn-primary align-content-center">Comprar ahora</a>
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

</div>

<h3 class="mx-auto text-center">El total de tu compra es de: $<?php echo $total ?></h3>

<?php include("template/footer.php");
?>