<?php
session_start();
$msg = "";
include("funciones.php");
include("template/header.php");
if (isset($_GET['err']) && $_GET['err'] != "") {
    //err1
    if ($_GET['err'] == "1") {
        $msg = "No se recibieron datos del formulario";
    }
    if ($_GET['err'] == "2") {
        $msg = "Se necesita la contraseña";
    }
    if ($_GET['err'] == "3") {
        $msg = "Se necesita la repetición de contraseña";
    }
    if ($_GET['err'] == "4") {
        $msg = "Las contraseñas no coinciden";
    }
}
if (!isset($_SESSION['idU']) && !isset($_SESSION['nombre']))    //el usuario no se ha autenticó
{
    header("location:" . $ruta . "index.php");
}
?>

<script type="text/javascript">
    function verificaForm(n) {

        if (document.getElementById("Pwd").value == "" ||
            document.getElementById("rePwd").value == "") {
            alert("Todos los datos del formulario son requeridos");
            return false;
        } else if (document.getElementById("Pwd").value !== document.getElementById("rePwd").value) {
            alert("Las contraseñas no coinciden");
            return false;
        } else {
            return confirmaEliminacion(n);
        }
    }

    function confirmaEliminacion(n) {
        if (window.confirm("Estas por cerrar tu cuenta " + n + ", ¿Seguro que deseas hacerlo?")) {
            if (window.confirm("¿CONFIRMAS que deseas eliminar tu cuenta " + n + "?")) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>


<?php
if (isset($_SESSION['idU']) && isset($_SESSION['nombre']))    //el usuario se autenticó
{
    $conn = conectaBD();
    $NombreUsr = recuperaNombre($conn);
    $rolUsr = recuperaRol($conn);
    $contra = recuperaContra($conn);

    if ($rolUsr == "General") {
        navbarAth();
    }

    if ($rolUsr == "Administrador") {
        menuAdmin($NombreUsr);
        echo "<h1>Hola " . $_SESSION['nombre'] . "</h1>";
    }
}
?>
<div class="container-fluid"  style="text-align:center">
    <br>
    <h3 class="h2 mx-auto" style="text-align:center">No te vayas, te vamos a extrañar</h3>
    <br>
    <?php if ($msg != "") echo "<div id='msgErr'>$msg</div>"; ?>
    <br>
    <form method="get" action="elimina.php" class="mx-auto" onsubmit="return verificaForm('<?php echo $NombreUsr; ?>')">
        <div class="container mx-auto">

            <div class="mb-3 tx">
                Contraseña :<input type="password" id="Pwd" name="Pwd"><br>
            </div>
            <div class="mb-3 tx">
                Repite tu Contraseña: <input type="password" id="rePwd" name="rePwd"> <br>
            </div>
            <div class="mb-3 tx">
                <button type="submit" value="Eliminar" class="btn btn-danger">
                    Eliminar
                </button> &nbsp;&nbsp;&nbsp;
                <button type="reset" value="Cancelar" class="btn btn-info">
                    Cancelar
                </button>
          
            </div>
        </div>
    </form>
</div>