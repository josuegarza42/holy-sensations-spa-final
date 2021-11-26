<?php


// 
// conexion a la BASE DE DATOS
$host = "localhost";
$bd = "spa";
$usuario = "root";
$contrasenia = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    if ($conexion) {
        // echo "Conectado a la base de datos :)";
    }
} catch (Exception $ex) {
    //throw $th;
    echo $ex->getMessage();
}
?>