<!-- TODO NO FUNCIONA Correctamente  -->
<?php
session_start();
include("funciones.php");
// si no hay datos
if (
    !isset($_GET['Pwd']) ||
    !isset($_GET['rePwd'])
) {
    header("location:" . $ruta . "eliminarCuenta.php?err=1");
}
// si hay datos
if (isset($_GET['Pwd']) && isset($_GET['rePwd'])) {
    $conn = conectaBD();
    $rolUsr = recuperaRol($conn);
    // si pwd es igual a vacio
    if ($_GET['Pwd'] == "") {
        header("location:" . $ruta . "eliminarCuenta.php?err=2");
    }
       // si repwd es igual a vacio
    if ($_GET['rePwd'] == "") {
        header("location:" . $ruta . "eliminarCuenta.php?err=3");
    }
       // si pwd no es igual a repwd
    if ($_GET['Pwd'] !== $_GET['rePwd']) {
        header("location:" . $ruta . "eliminarCuenta.php?err=4");
    }
    $qry = "DELETE FROM `usuarios` WHERE `usuarios`.`idUsuario`=" . $_SESSION['idU'];
    mysqli_query($conn, $qry);
    session_destroy();
    header("location:" . $ruta . "index.php");
}
?>