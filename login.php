<?php
session_start();
include("template/header.php");
include("funciones.php");
menuLogin();

$msg = "";

if (isset($_GET['Nombre']) && isset($_GET['Pwd'])) {
    if ($_GET['Nombre'] != "" && $_GET['Pwd'] != "") {
        //si estoy pasando los datos del formulario
        $conn = conectaBD();
        // checar este qry
        $qry = "select idUsuario, Nombre from usuarios where Nombre ='" . $_GET['Nombre'] . "' and Pwd='" . $_GET['Pwd'] . "'";
        $rs = mysqli_query($conn, $qry);

        if (mysqli_num_rows($rs) > 0) {
            //usuario existe
            $datosUsuario = mysqli_fetch_array($rs);
            //indicarle usuario autenticado sesiones()
            $_SESSION['idU'] = $datosUsuario["idUsuario"];
            $_SESSION['nombre'] = $datosUsuario["Nombre"];
            header("location:" . $ruta . "index.php?idU=" . $idU);
        } else //los datos son incorrectos
        {
            $msg = "El usuario o contraseña no son correctos";
        }
    }
}

?>

<script type="text/javascript">
    function verificaForm() {
        if (document.getElementById("Nombre").value == "" ||
            document.getElementById("Pwd").value == "") {
            alert("Todos los datos del formulario son requeridos");
            return false;
        } else {
            return true;
        }
    }
</script>

<!-- formulario -->
<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <div>
                <?php
                if ($msg != "") {
                    echo $msg;
                }
                ?>
            </div>

            <br><br><br>
            <div class="card">
                <div class="card-header">
                    <p><i class="bi bi-door-open"></i> Login</p>
                </div>
                <div class="card-body">
                    <!-- se envian los datos por el metodo post -->
                    <!-- LOGIN FORM -->
                    <form action="login.php" method="get" onsubmit="return verificaForm()" class="mx-auto">
                        <div class="mb-3">
                            <label class="form-label"> <i class="bi bi-person-circle"></i> Usuario</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Ingresa tu usuario">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> <i class="bi bi-shield-lock"></i> Contraseña</label>
                            <input type="password" class="form-control" name="Pwd" id="Pwd" placeholder="Ingresa tu contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-person-check"></i> Iniciar sesion </button>
                    </form>
                </div>
            </div>
        </div>