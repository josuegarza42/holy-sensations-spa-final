<?php
include('../template/header.php');
?>

<?php

// si hay algo en txtCUALSEA ASIGNALO, si no ponlo vacio
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
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

// conexion a la BASE DE DATOS
include('../config/bd.php');
switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (Nombre,Descripcion,Precio,Cantidad,Categoria,Imagen) VALUES (:Nombre,:Descripcion,:Precio,:Cantidad,:Categoria,:Imagen);");
        // INSERT INTO `producto` (`idProducto`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas');
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->bindParam(':Cantidad', $txtCantidad);
        $sentenciaSQL->bindParam(':Categoria', $txtCategoria);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:productos.php");
        // echo "Presionado boton agregar";
        break;
  
    case "Modificar":
        // echo "Presionado boton Modificar";
        // SE MODIFICAN LOS TEXTOS, EN ESTE CASO SOLO EL NOMBRE, PUES NECESITAMOS PROBAR
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Nombre=:Nombre WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Descripcion=:Descripcion WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Precio=:Precio WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Cantidad=:Cantidad WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':Cantidad', $txtCantidad);
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE producto SET Categoria=:Categoria WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':Categoria', $txtCategoria);
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();

        // CUANDO LLEGUE A LA IMAGEN
        if ($txtImagen != "") {
            // SE CARGA EL ARCHIVO IMAGEN 
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // SELECCIONAMOS LA IMAGEN POR MODIFICAR
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM producto WHERE idProducto=:idProducto");
            $sentenciaSQL->bindParam(':idProducto', $txtID);
            $sentenciaSQL->execute();

            $Producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            // BORRAMOS "ARCHIVO POR ACTUALIZAR"
            if (isset($Producto["Imagen"]) && ($Producto["Imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $Producto["Imagen"])) {
                    unlink("../../img/" . $Producto["Imagen"]);
                }
            }
            // HACEMOS EL UPDATE DE LA IMAGEN
            $sentenciaSQL = $conexion->prepare("UPDATE producto SET Imagen=:Imagen WHERE idProducto=:idProducto");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':idProducto', $txtID);
            $sentenciaSQL->execute();
        }
        // header("Location:productos.php");
        break;

    case "Cancelar":
        header("Location:productos.php");

        // echo "Presionado boton Cancelar";
        break;
    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista productos UNO A UNO CON LAZY
        $Producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtID = $Producto['idProducto'];
        $txtNombre = $Producto['Nombre'];
        $txtDescripcion = $Producto['Descripcion'];
        $txtPrecio = $Producto['Precio'];
        $txtCantidad = $Producto['Cantidad'];
        $txtCategoria = $Producto['Categoria'];
        $txtImagen = $Producto['Imagen'];
        // echo "Presionado boton seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM producto WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista productos UNO A UNO CON LAZY
        $Producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($Producto["Imagen"]) && ($Producto["Imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $Producto["Imagen"])) {
                unlink("../../img/" . $Producto["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM producto WHERE idProducto=:idProducto");
        $sentenciaSQL->bindParam(':idProducto', $txtID);
        $sentenciaSQL->execute();
        // echo "Presionado boton borrar";
        header("Location:productos.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
// asigna a lista productos todos los datos recuperados  con fetchAll
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
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
                <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" value="<?php echo $txtID; ?>" required readonly class="form-control" name="txtID" id="txtID">
                </div>
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-card-text"></i> Nombre del producto:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del producto">
                </div>
                <!-- descripcion -->
                <div class="form-group mb-3">
                    <label class="txtDescripcion"><i class="bi bi-tags-fill"></i> Descripcion del producto:</label>
                    <input required type="text" class="form-control" value=" <?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Inserta la descripcion del producto">
                </div>
                <!-- precio -->
                <div class="form-group mb-3">
                    <label class="txtPrecio"><i class="bi bi-currency-dollar"></i> Precio del producto:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Inserta el precio del producto">
                </div>
                <!-- cantidad -->
                <div class="form-group mb-3">
                    <label class="txtCantidad"><i class="bi bi-bag-plus"></i> Cantidad en stock del producto:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtCantidad; ?>" name="txtCantidad" id="txtCantidad" placeholder="Inserta la cantidad que tienes del producto">
                </div>
                <!-- categoria -->
                <div class="form-group mb-3">
                    <label class="txtCategoria"><i class="bi bi-tags-fill"></i> Categoria del producto:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtCategoria; ?>" name="txtCategoria" id="txtCategoria" placeholder="Inserta la categoria del producto">
                </div>

                <!-- imagen -->
                <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen del producto:</label>

                    <?php
                    if ($txtImagen != "") {  ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen ?>" width="50" alt="">

                    <?php } ?>

                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen del producto">
                </div>

                <div class="btn-group " role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> class="btn btn-success mx-2">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?>class="btn btn-warning mx-2">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?>class="btn btn-danger mx-2">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <h1>Tabla de productos</h1> <small>Aqui puedes agregar, borrar, actualizar productos</small>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Producto</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Categoria</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['idProducto']; ?></td>
                    <td><?php echo $producto['Nombre']; ?></td>
                    <td><?php echo $producto['Descripcion']; ?></td>
                    <td><?php echo $producto['Precio']; ?></td>
                    <td><?php echo $producto['Cantidad']; ?></td>
                    <td><?php echo $producto['Categoria']; ?></td>

                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $producto['Imagen']; ?>" width="50" alt="">
                    </td>

                    <td>
                        <!-- borrar -->
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['idProducto']; ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" /> <br> <br> <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php
include('../template/footer.php');
?>