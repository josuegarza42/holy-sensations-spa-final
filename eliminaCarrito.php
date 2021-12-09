<?php
include("funciones.php");
session_start();

if (isset($_SESSION['idU']) && isset($_SESSION['nombre']))    //el usuario se autenticó
{
    $conn = conectaBD();
    $qry = "DELETE * FROM carrito WHERE idProducto=" . $_GET['idP'];
    mysqli_query($conn, $qry);
    header("location:" . $ruta . "verCarrito.php");
}

?>