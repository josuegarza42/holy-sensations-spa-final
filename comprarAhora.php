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

<form class="credit-card-div" method="get" action="pagoCompletado.php">
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="row mb-3 mt-2">
                <div class="col-md-12">
                    <input type="text" class="form-control"  name="card" placeholder="Enter Card Number" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <span class="help-block text-muted small-font"> Expiry Month</span>
                    <input type="text" name="month" class="form-control" placeholder="MM" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <span class="help-block text-muted small-font"> Expiry Year</span>
                    <input type="text" name="year" class="form-control" placeholder="YY" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <span class="help-block text-muted small-font"> CCV</span>
                    <input type="text" name="ccv" class="form-control" placeholder="CCV" />
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <img src="./img/tarjetas.jfif" class="img-rounded" width="300px" height="80px" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 pad-adjust">

                    <input type="text" name="name" class="form-control" placeholder="Name On The Card" />
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12 pad-adjust">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked class="text-muted"> Deseas que te enviemos promociones a tu correo
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                    <a href="verCarrito.php" class="btn btn-danger ">Cancelar</a>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                    <input type="submit" value="Pagar ahora">
                </div>
            </div>

        </div>
    </div>
</form>

<?php include("template/footer.php");
?>