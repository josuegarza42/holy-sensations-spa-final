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
$qry = "select * from producto where idProducto=" . $_GET['idP'];
$rs = mysqli_query($conn, $qry);
$producto = mysqli_fetch_array($rs);
?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card text-black">
                    <!-- <i class="fas fa-spa ml-3"></i> -->
                    <img class="card-img-top" src="./img/<?php echo $producto['Imagen']; ?>">
                    <div class="card-body">
                        <h3 class="card-title"> <?php echo $producto['Nombre']; ?></h3>
                        <p class="card-text"><?php echo $producto['Descripcion']; ?></p>
                        <p class="card-text"> Precio:<i class="bi bi-currency-dollar"></i><?php echo $producto['Precio']; ?></p>
                        <form method="get" action="agregarCarrito.php">
                            <p class="card-text"><b>Cantidad:</b></p>
                            <select name="Cantidad">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <br>
                            <br>
                            <input type="submit" value="Añadir al carrito">
                            <input type="hidden" name="idP" value="<?php echo $producto['idProducto']; ?>">
                            <br>
                        </form>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("template/footer.php");
?>