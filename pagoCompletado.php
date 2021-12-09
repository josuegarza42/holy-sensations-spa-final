<?php
session_start(); //haga uso del arreglo de sessión
include("funciones.php");
$nuevoStock = 0;
//espacio para recuperación de datos
if (
    !isset($_GET['card']) ||
    !isset($_GET['month']) ||
    !isset($_GET['year']) ||
    !isset($_GET['cvv']) ||
    !isset($_GET['name'])
) {
    header("location:" . $ruta . "comprarAhora.php?err=1");
}
if (
    $_GET['card'] == "" ||
    $_GET['month'] == "" ||
    $_GET['year'] == "" ||
    $_GET['cvv'] == "" ||
    $_GET['name'] == ""
) {
    header("location:" . $ruta . "comprarAhora.php?err=2");
}
$conn = conectaBD();
extract($_GET); //crea las varibales txtnombre,txtUsuario,etc...

$consulta = "select idProducto,Cantidad from carrito where idUsuario =" . $_SESSION['idU'];
$rs = mysqli_query($conn, $consulta);

if (mysqli_num_rows($rs)) {
    while ($idCarrito = mysqli_fetch_array($rs)) {
        $qry2 = "select Cantidad from producto where idProducto=" . $idCarrito["idProducto"];
        $rs2 = mysqli_query($conn, $qry2);
        if (mysqli_num_rows($rs2)) {
            $prod = mysqli_fetch_object($rs2);
            $Cantidad1 = $prod->Cantidad;
            $Cantidad2 = $idCarrito['Cantidad'];
            settype($Cantidad1, 'int');
            var_dump($Cantidad1);
            settype($Cantidad2, 'int');
            var_dump($Cantidad2);

            $nuevoStock = $Cantidad1 - $Cantidad2;

            $consulta2 = "update producto set Cantidad='$nuevoStock' where idProducto=" . $idCarrito["idProducto"];
            $rs3 = mysqli_query($conn, $consulta2);

            $consulta3 = "delete from carrito where idProducto=" . $idCarrito["idProducto"] . " and idUsuario=" . $_SESSION['idU'] . "";
            $rs4 = mysqli_query($conn, $consulta3);
            // $nuevoStock = 0;
        }
    }
}





mysqli_close($conn);

header("location:" . $ruta . "verCarrito.php?err=4");
?>
