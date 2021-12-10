<?php
session_start();
include("funciones.php");

//espacio para recuperación de datos
if (!isset($_GET['correo']) ||
    !isset($_GET['curso'])){

    header("location:" . $ruta . "cursos.php?err=1");
}

if ( $_GET['correo'] == "" ||
    $_GET['curso']=="") {
    header("location:" . $ruta . "cursos.php?err=2");
}



extract($_GET); //crea las varibales txtnombre,txtUsuario,etc...
$conn = conectaBD();





$consulta = "insert into 
informacion (idCurso,correo) value ('$curso','$correo')";
$rs = mysqli_query($conn,$consulta);


mysqli_close($conn);

header("location:" .$ruta. "cursos.php?err=3");
?>