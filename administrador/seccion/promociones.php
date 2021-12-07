<?php
include('../template/header.php');
?>

<?php

// si hay algo en txtCUALSEA ASIGNALO, si no ponlo vacio
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPrecio = (isset($_POST['txtPrecio'])) ? $_POST['txtPrecio'] : "";
$txtDuracion = (isset($_POST['txtDuracion'])) ? $_POST['txtDuracion'] : "";

// imagen PARA PRUEBAS
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
// accion 
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

// conexion a la BASE DE DATOS
include('../config/bd.php');
switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO promocion (Nombre,Descripcion,Precio,Duracion,Imagen) VALUES (:Nombre,:Descripcion,:Precio,:Duracion,:Imagen);");
        // INSERT INTO `promocion` (`idPromocion`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas');
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:promociones.php");
        // echo "Presionado boton agregar";
        break;

    case "Modificar":
        // echo "Presionado boton Modificar";
        // SE MODIFICAN LOS TEXTOS, EN ESTE CASO SOLO EL NOMBRE, PUES NECESITAMOS PROBAR
        $sentenciaSQL = $conexion->prepare("UPDATE promocion SET Nombre=:Nombre WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE promocion SET Descripcion=:Descripcion WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE promocion SET Precio=:Precio WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE promocion SET Duracion=:Duracion WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();

        // CUANDO LLEGUE A LA IMAGEN
        if ($txtImagen != "") {
            // SE CARGA EL ARCHIVO IMAGEN 
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // SELECCIONAMOS LA IMAGEN POR MODIFICAR
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM promocion WHERE idPromocion=:idPromocion");
            $sentenciaSQL->bindParam(':idPromocion', $txtID);
            $sentenciaSQL->execute();

            $Promocion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            // BORRAMOS "ARCHIVO POR ACTUALIZAR"
            if (isset($Promocion["Imagen"]) && ($Promocion["Imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $Promocion["Imagen"])) {
                    unlink("../../img/" . $Promocion["Imagen"]);
                }
            }
            // HACEMOS EL UPDATE DE LA IMAGEN
            $sentenciaSQL = $conexion->prepare("UPDATE promocion SET Imagen=:Imagen WHERE idPromocion=:idPromocion");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':idPromocion', $txtID);
            $sentenciaSQL->execute();
        }
        // header("Location:promociones.php");
        break;

    case "Cancelar":
        header("Location:promociones.php");

        // echo "Presionado boton Cancelar";
        break;
    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM promocion WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista promociones UNO A UNO CON LAZY
        $Promocion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtID = $Promocion['idPromocion'];
        $txtNombre = $Promocion['Nombre'];
        $txtDescripcion = $Promocion['Descripcion'];
        $txtPrecio = $Promocion['Precio'];
        $txtDuracion = $Promocion['Duracion'];
        $txtImagen = $Promocion['Imagen'];
        // echo "Presionado boton seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM promocion WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista promociones UNO A UNO CON LAZY
        $Promocion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($Promocion["Imagen"]) && ($Promocion["Imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $Promocion["Imagen"])) {
                unlink("../../img/" . $Promocion["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM promocion WHERE idPromocion=:idPromocion");
        $sentenciaSQL->bindParam(':idPromocion', $txtID);
        $sentenciaSQL->execute();
        // echo "Presionado boton borrar";
        header("Location:promociones.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM promocion");
$sentenciaSQL->execute();
// asigna a lista promociones todos los datos recuperados  con fetchAll
$listaPromociones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    <H1>Formulario: Agregar Promociones</H1>
    <br>
    <div class="card">
        <div class="card-header">
            <h5> <i class="fas fa-id-card"></i> Datos de la Promocion:</h5>
        </div>
        <div class="card-body">
            <!-- INSERT INTO `promocion` (`idPromocion`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas'); -->
            <form method="POST" enctype="multipart/form-data">
                <!-- id -->
                <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" value="<?php echo $txtID; ?>" required readonly class="form-control" name="txtID" id="txtID">
                </div>
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-card-text"></i> Nombre de la promocion:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del promocion">
                </div>
                <!-- descripcion -->
                <div class="form-group mb-3">
                    <label class="txtDescripcion"><i class="bi bi-tags-fill"></i> Descripcion de la promocion:</label>
                    <input required type="text" class="form-control" value=" <?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Inserta la descripcion del promocion">
                </div>
                <!-- precio -->
                <div class="form-group mb-3">
                    <label class="txtPrecio"><i class="bi bi-currency-dollar"></i> Precio de la promocion:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Inserta el precio del promocion">
                </div>
                <!-- Duracion -->
                <div class="form-group mb-3">
                    <label class="txtDuracion"><i class="bi bi-alarm"></i> Duracion de la promocion:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtDuracion; ?>" name="txtDuracion" id="txtDuracion" placeholder="Inserta la cantidad que tienes del promocion">
                </div>
                <!-- imagen -->
                <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen de la promocion:</label>

                    <?php
                    if ($txtImagen != "") {  ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen ?>" width="50" alt="">
                    <?php } ?>

                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen de la promocion">
                </div>
                <!-- botones -->
                <div class="btn-group " role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> class="btn btn-success mx-2">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?>class="btn btn-warning mx-2">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?>class="btn btn-danger mx-2">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tabla -->
<div class="col-md-7">
    <h1>Tabla de Promociones</h1> <small>Aqui puedes agregar, borrar, actualizar promociones</small>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la promocion</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaPromociones as $promocion) { ?>
                <tr>
                    <td><?php echo $promocion['idPromocion']; ?></td>
                    <td><?php echo $promocion['Nombre']; ?></td>
                    <td><?php echo $promocion['Descripcion']; ?></td>
                    <td><?php echo $promocion['Precio']; ?></td>
                    <td><?php echo $promocion['Duracion']; ?></td>
                    <!-- imagen -->
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $promocion['Imagen']; ?>" width="50" alt="">
                    </td>

                    <td>
                        <!-- borrar -->
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $promocion['idPromocion']; ?>" />
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