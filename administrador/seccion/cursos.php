<?php
include('../template/header.php');
?>

<?php

// si hay algo en txtCUALSEA ASIGNALO, si no ponlo vacio
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtDuracion = (isset($_POST['txtDuracion'])) ? $_POST['txtDuracion'] : "";
$txtFecha = (isset($_POST['txtFecha'])) ? $_POST['txtFecha'] : "";
$txtCupo = (isset($_POST['txtCupo'])) ? $_POST['txtCupo'] : "";

// imagen PARA PRUEBAS
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
// accion 
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

// conexion a la BASE DE DATOS
include('../config/bd.php');
switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO curso (Nombre,Descripcion,Duracion,Fecha,Cupo,Imagen) VALUES (:Nombre,:Descripcion,:Duracion,:Fecha,:Cupo,:Imagen);");
        // INSERT INTO `curso` (`idCurso`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas');
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':Fecha', $txtFecha);
        $sentenciaSQL->bindParam(':Cupo', $txtCupo);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL->execute();
        header("Location:cursos.php");
        // echo "Presionado boton agregar";
        break;

    case "Modificar":
        // echo "Presionado boton Modificar";
        // SE MODIFICAN LOS TEXTOS, EN ESTE CASO SOLO EL NOMBRE, PUES NECESITAMOS PROBAR
        $sentenciaSQL = $conexion->prepare("UPDATE curso SET Nombre=:Nombre WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE curso SET Descripcion=:Descripcion WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE curso SET Duracion=:Duracion WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE curso SET Fecha=:Fecha WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':Fecha', $txtFecha);
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE curso SET Cupo=:Cupo WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':Cupo', $txtCupo);
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();


        // CUANDO LLEGUE A LA IMAGEN
        if ($txtImagen != "") {
            // SE CARGA EL ARCHIVO IMAGEN 
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // SELECCIONAMOS LA IMAGEN POR MODIFICAR
            $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM curso WHERE idCurso=:idCurso");
            $sentenciaSQL->bindParam(':idCurso', $txtID);
            $sentenciaSQL->execute();

            $Curso = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
            // BORRAMOS "ARCHIVO POR ACTUALIZAR"
            if (isset($Curso["Imagen"]) && ($Curso["Imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $Curso["Imagen"])) {
                    unlink("../../img/" . $Curso["Imagen"]);
                }
            }
            // HACEMOS EL UPDATE DE LA IMAGEN
            $sentenciaSQL = $conexion->prepare("UPDATE curso SET Imagen=:Imagen WHERE idCurso=:idCurso");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':idCurso', $txtID);
            $sentenciaSQL->execute();
        }
        // header("Location:cursos.php");
        break;

    case "Cancelar":
        header("Location:cursos.php");

        // echo "Presionado boton Cancelar";
        break;
    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM curso WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista curso UNO A UNO CON LAZY
        $Curso = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtID = $Curso['idCurso'];
        $txtNombre = $Curso['Nombre'];
        $txtDescripcion = $Curso['Descripcion'];
        $txtDuracion = $Curso['Duracion'];
        $txtFecha = $Curso['Fecha'];
        $txtCupo = $Curso['Cupo'];
        $txtImagen = $Curso['Imagen'];
        // echo "Presionado boton seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT Imagen FROM curso WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();
        // asigna a lista curso UNO A UNO CON LAZY
        $Curso = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($Curso["Imagen"]) && ($Curso["Imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $Curso["Imagen"])) {
                unlink("../../img/" . $Curso["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM curso WHERE idCurso=:idCurso");
        $sentenciaSQL->bindParam(':idCurso', $txtID);
        $sentenciaSQL->execute();
        // echo "Presionado boton borrar";
        header("Location:cursos.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM curso");
$sentenciaSQL->execute();
// asigna a lista curso todos los datos recuperados  con fetchAll
$listaCursos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">
    <H1>Formulario: Agregar Cursos</H1>
    <br>
    <div class="card">
        <div class="card-header">
            <h5> <i class="fas fa-id-card"></i> Datos de la Curso:</h5>
        </div>
        <div class="card-body">
            <!-- INSERT INTO `curso` (`idCurso`, `Nombre`, `Descripcion`, `Precio`, `Duracion`, `Categoria`) VALUES ('1', 'crema', 'crema para barros', '299', '3', 'cremas'); -->
            <form method="POST" enctype="multipart/form-data">
                <!-- id -->
                <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" value="<?php echo $txtID; ?>" required readonly class="form-control" name="txtID" id="txtID">
                </div>
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-card-text"></i> Nombre del curso:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del curso">
                </div>
                <!-- descripcion -->
                <div class="form-group mb-3">
                    <label class="txtDescripcion"><i class="bi bi-tags-fill"></i> Descripcion del curso:</label>
                    <input required type="text" class="form-control" value=" <?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Inserta la descripcion del curso">
                </div>

                <!-- Duracion -->
                <div class="form-group mb-3">
                    <label class="txtDuracion"><i class="bi bi-bag-plus"></i> Duracion del curso:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtDuracion; ?>" name="txtDuracion" id="txtDuracion" placeholder="Inserta la cantidad que tienes del curso">
                </div>
                <!-- Fecha -->
                <div class="form-group mb-3">
                    <label class="txtFecha"><i class="bi bi-currency-dollar"></i> Fecha del curso:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha" placeholder="Inserta el precio del curso">
                </div>
                <!-- cupo -->
                <div class="form-group mb-3">
                    <label class="txtCupo"><i class="bi bi-currency-dollar"></i> Cupo del curso:</label>
                    <input type="text" required class="form-control" value=" <?php echo $txtCupo; ?>" name="txtCupo" id="txtCupo" placeholder="Inserta el precio del curso">
                </div>
                <!-- imagen -->
                <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen del curso:</label>

                    <?php
                    if ($txtImagen != "") {  ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen ?>" width="50" alt="">
                    <?php } ?>

                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen de la curso">
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
    <h1>Tabla de Cursos</h1> <small>Aqui puedes agregar, borrar, actualizar cursos</small>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del curso</th>
                <th>Descripcion</th>
                <th>Duracion</th>
                <th>Fecha</th>
                <th>Cupo</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaCursos as $curso) { ?>
                <tr>
                    <td><?php echo $curso['idCurso']; ?></td>
                    <td><?php echo $curso['Nombre']; ?></td>
                    <td><?php echo $curso['Descripcion']; ?></td>
                    <td><?php echo $curso['Duracion']; ?></td>
                    <td><?php echo $curso['Fecha']; ?></td>
                    <td><?php echo $curso['Cupo']; ?></td>

                    <!-- imagen -->
                    <td>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $curso['Imagen']; ?>" width="50" alt="">
                    </td>

                    <td>
                        <!-- borrar -->
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $curso['idCurso']; ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" /> <br> <br> <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php
include('../template/footer.php');
?>