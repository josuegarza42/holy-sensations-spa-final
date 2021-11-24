<?php
include('../template/header.php');
?>

<?php
// si hay algo en txtCUALSEA ASIGNALO, si no ponlo vacio
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
// PRUEBAS
echo $txtID . "<br/>";
echo $txtNombre . "<br/>";
echo $txtImagen . "<br/>";
echo $accion . "<br/>";

switch ($accion) {
    case "Agregar":
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
            <form method="POST" enctype="multipart/form-data">
                <!-- id -->
                <div class="form-group mb-3">
                    <label class="txtID"> <i class="bi bi-fingerprint"></i> ID:</label>
                    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="Inserta el id del producto">
                </div>
                <!-- nombre -->
                <div class="form-group mb-3">
                    <label class="txtNombre"><i class="bi bi-tags-fill"></i> Nombre del producto:</label>
                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Inserta el nombre del producto">
                </div>
                <!-- imagen -->
                <div class="form-group mb-3">
                    <label for="txtImagen"><i class="bi bi-card-image"></i> Imagen del producto:</label>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Inserta la imagen del producto">
                </div>

                <!-- TODO DESCRIPCION PRECIO -->

                <div class="btn-group " role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success mx-2">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning mx-2">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-danger mx-2">Cancelar</button>
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