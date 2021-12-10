<?php
session_start();
include("funciones.php");

if (isset($_SESSION['idU']) == "" && isset($_SESSION['nombre']) == "")    //el usuario no se autenticó
{
    header("location:" . $ruta . "index.php");
}

//espacio para recuperación de datos
if (
    !isset($_GET['Cantidad']) ||
    !isset($_GET['idP'])
) {
    header("location:" . $ruta . "visualizarProducto.php?err=1");
}
if (
    $_GET['Cantidad'] == "" ||
    $_GET['idP'] == ""
) {
    header("location:" . $ruta . "visualizarProducto.php?err=2");
}

$Cantidad =  $_GET['Cantidad'];
extract($_GET); //crea las varibales txtnombre,txtUsuario,etc...
$conn = conectaBD();
settype($Cantidad, 'int');
var_dump($Cantidad);

$idUsuario = $_SESSION['idU'];

$consulta = "insert into 
carrito (idUsuario,Cantidad,idProducto) value ('$idUsuario','$Cantidad','$idP')";
$rs = mysqli_query($conn, $consulta);

mysqli_close($conn);

header("location:" . $ruta . "visualizarProducto.php?idP=$idP");
?>