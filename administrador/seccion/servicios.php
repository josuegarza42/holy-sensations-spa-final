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
        $sentenciaSQL = $conexion->prepare("INSERT INTO servicios (Nombre,Descripcion,Precio,Duracion,Imagen) VALUES (:Nombre,:Descripcion,:Precio,:Duracion,:Imagen);");
        // INSERT INTO `servicios` (`idServicio`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas');
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
        header("Location:servicios.php");
        // echo "Presionado boton agregar";
        break;

    case "Modificar":
        // echo "Presionado boton Modificar";
        // SE MODIFICAN LOS TEXTOS, EN ESTE CASO SOLO EL NOMBRE, PUES NECESITAMOS PROBAR
        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Nombre=:Nombre WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Descripcion=:Descripcion WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Precio=:Precio WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':Precio', $txtPrecio);
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Duracion=:Duracion WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();

        // CUANDO LLEGUE A LA IMAGEN
        if ($txtImagen != "") {
            // SE CARGA EL ARCHIVO IMAGEN 
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // SELECCIONAMOS LA IMAGEN POR MODIFICAR
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM servicios WHERE idServicio=:idServicio");
            $sentenciaSQL->bindParam(':idServicio', $txtID);
            $sentenciaSQL->execute();

            $Servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            // BORRAMOS "ARCHIVO POR ACTUALIZAR"
            if (isset($Servicio["Imagen"]) && ($Servicio["Imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $Servicio["Imagen"])) {
                    unlink("../../img/" . $Servicio["Imagen"]);
                }
            }
            // HACEMOS EL UPDATE DE LA IMAGEN
            $sentenciaSQL = $conexion->prepare("UPDATE servicios SET Imagen=:Imagen WHERE idServicio=:idServicio");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':idServicio', $txtID);
            $sentenciaSQL->execute();
        }
        // header("Location:productos.php");
        break;

    case "Cancelar":
        header("Location:productos.php");

        // echo "Presionado boton Cancelar";
        break;
    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM servicios WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista productos UNO A UNO CON LAZY
        $Servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtID = $Servicio['idServicio'];
        $txtNombre = $Servicio['Nombre'];
        $txtDescripcion = $Servicio['Descripcion'];
        $txtPrecio = $Servicio['Precio'];
        $txtDuracion = $Servicio['Duracion'];
        $txtImagen = $Servicio['Imagen'];
        // echo "Presionado boton seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM servicios WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista productos UNO A UNO CON LAZY
        $Servicio = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($Servicio["Imagen"]) && ($Servicio["Imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $Servicio["Imagen"])) {
                unlink("../../img/" . $Servicio["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM servicios WHERE idServicio=:idServicio");
        $sentenciaSQL->bindParam(':idServicio', $txtID);
        $sentenciaSQL->execute();
        // echo "Presionado boton borrar";
        header("Location:servicios.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
// asigna a lista productos todos los datos recuperados  con fetchAll
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    <H1>Formulario: Agregar servicios</H1>
    <br>
    <div class="card">
        <div class="card-header">
            <h5> <i class="fas fa-id-card"></i> Datos del servicio</h5>
        </div>
        <div class="card-body">
            <!-- INSERT INTO `servicio` (`idServicio`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas'); -->
            <form method="POST" enctype="multipart/form-data">
                <!-- id -->
                <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" value="<?php echo $txtID; ?>" required readonly class="form-control" name="txtID" id="txtID">
                </div>
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-card-text"></i> Nombre del servicio:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del servicio">
                </div>
                <!-- descripcion -->
                <div class="form-group mb-3">
                    <label class="txtDescripcion"><i class="bi bi-tags-fill"></i> Descripcion del servicio:</label>
                    <input required type="text" class="form-control" value=" <?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Inserta la descripcion del servicio">
                </div>
                <!-- precio -->
                <div class="form-group mb-3">
                    <label class="txtPrecio"><i class="bi bi-currency-dollar"></i> Precio del servicio:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Inserta el precio del servicio">
                </div>
                <!-- Duracion -->
                <div class="form-group mb-3">
                    <label class="txtDuracion"><i class="bi bi-alarm"></i> Duracion del servicio:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtDuracion; ?>" name="txtDuracion" id="txtDuracion" placeholder="Inserta la cantidad que tienes del servicio">
                </div>
                <!-- imagen -->
                <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen del servicio:</label>

                    <?php
                    if ($txtImagen != "") {  ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen ?>" width="50" alt="">
                    <?php } ?>

                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen del servicio">
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
    <h1>Tabla de Servicios</h1> <small>Aqui puedes agregar, borrar, actualizar Servicios</small>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Servicio</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $servicios) { ?>
                <tr>
                    <td><?php echo $servicios['idServicio']; ?></td>
                    <td><?php echo $servicios['Nombre']; ?></td>
                    <td><?php echo $servicios['Descripcion']; ?></td>
                    <td><?php echo $servicios['Precio']; ?></td>
                    <td><?php echo $servicios['Duracion']; ?></td>
                    <!-- imagen -->
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $servicios['Imagen']; ?>" width="50" alt="">
                    </td>

                    <td>
                        <!-- borrar -->
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $servicios['idServicio']; ?>" />
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