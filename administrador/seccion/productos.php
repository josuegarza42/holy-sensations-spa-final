<?php
include('../template/header.php');
?>

<?php


// si hay algo en txtCUALSEA ASIGNALO, si no ponlo vacio
// $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$txtCantidad = (isset($_POST['txtCantidad'])) ? $_POST['txtCantidad'] : "";
$txtCategoria = (isset($_POST['txtCategoria'])) ? $_POST['txtCategoria'] : "";
// imagen PARA PRUEBAS
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
// accion 
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
// PRUEBAS
// echo $txtID . "<br/>";
// echo $txtNombre . "<br/>";
// echo $txtDescripcion . "<br/>";
// echo $txtPrecio . "<br/>";
// echo $txtCantidad . "<br/>";
// echo $txtCategoria . "<br/>";
// // imagen
// echo $txtImagen . "<br/>";
// echo $accion . "<br/>";

// 
// conexion a la BASE DE DATOS
include('../config/bd.php');
switch ($accion) {
    case "Agregar":
        $sentenciaSQL=$conexion->prepare("INSERT INTO producto (Nombre,Descripcion,Precio,Cantidad,Categoria) VALUES (:Nombre,:Descripcion,:Precio,:Cantidad,:Categoria);");
        // INSERT INTO `producto` (`idProducto`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas');
        $sentenciaSQL->bindParam(':Nombre',$txtNombre);
        $sentenciaSQL->bindParam(':Descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':Precio',$txtPrecio);
        $sentenciaSQL->bindParam(':Cantidad',$txtCantidad);
        $sentenciaSQL->bindParam(':Categoria',$txtCategoria);

        $sentenciaSQL->execute();
        echo "Presionado boton agregar";
        break;
    case "Modificar":
        echo "Presionado boton Modificar";
        break;
    case "Cancelar":
        echo "Presionado boton Cancelar";
        break;
}

?>

<div class="col-md-5">
    <H1>Formulario: Agregar productos</H1>
    <br>
    <div class="card">
        <div class="card-header">
            <h5> <i class="fas fa-id-card"></i> Datos del producto</h5>
        </div>
        <div class="card-body">
            <!-- INSERT INTO `producto` (`idProducto`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas'); -->
            <form method="POST" enctype="multipart/form-data">
                <!-- id -->
                <!-- <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="Inserta el id del producto">
                </div> -->
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-card-text"></i> Nombre del producto:</label>
                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del producto">
                </div>
                <!-- descripcion -->
                <div class="form-group mb-3">
                    <label class="txtDescripcion"><i class="bi bi-tags-fill"></i> Descripcion del producto:</label>
                    <input type="text" class="form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Inserta la descripcion del producto">
                </div>
                <!-- precio -->
                <div class="form-group mb-3">
                    <label class="txtPrecio"><i class="bi bi-currency-dollar"></i> Precio del producto:</label>
                    <input type="text" class="form-control" name="txtPrecio" id="txtPrecio" placeholder="Inserta el precio del producto">
                </div>
                <!-- cantidad -->
                <div class="form-group mb-3">
                    <label class="txtCantidad"><i class="bi bi-bag-plus"></i> Cantidad en stock del producto:</label>
                    <input type="text" class="form-control" name="txtCantidad" id="txtCantidad" placeholder="Inserta la cantidad que tienes del producto">
                </div>
                <!-- categoria -->
                <div class="form-group mb-3">
                    <label class="txtCategoria"><i class="bi bi-tags-fill"></i> Categoria del producto:</label>
                    <input type="text" class="form-control" name="txtCategoria" id="txtCategoria" placeholder="Inserta la categoria del producto">
                </div>

                <!-- imagen -->
                <!-- <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen del producto:</label>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen del producto">
                </div> -->



                <div class="btn-group " role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success mx-2">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning mx-2">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-danger mx-2">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- aun no importa -->

<div class="col-md-7">
    <h1>Tabla de productos</h1> <small>Aqui puedes agregar, borrar, actualizar productos</small>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del libro</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>masajes</td>
                <td>imagen.jpg</td>
                <td>Seleccionar | Borrar</td>
            </tr>

        </tbody>
    </table>

</div>

<?php
include('../template/footer.php');
?>