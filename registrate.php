<!-- formulario de registro y comprobacion en JS Y PHP -->
<?php include("template/header.php");
include("funciones.php");
menuRegistrate();
$msg = "";
if (isset($_GET['err']) && $_GET['err'] != "") {
    //err1
    if ($_GET['err'] == "1") {
        $msg = "No se recibieron datos del formulario";
    }
    //err2
    if ($_GET['err'] == "2") {
        $msg = "No pueden existir campos vacíos, todos los campos son requeridos";
    }

    //err3
    if ($_GET['err'] == "3") {
        $msg = "No coinciden las contraseñas";
    }

    //err4
    if ($_GET['err'] == "4") {
        $msg = "Usuario registrado correctamente!";
    }
}

?>

<script type="text/javascript">
    function verificaForm() {

        if (document.getElementById("Nombre").value == "" ||
            document.getElementById("Pwd").value == "" ||
            document.getElementById("rePwd").value == "" ||
            document.getElementById("Email").value == "" ||
            document.getElementById("Direccion").value == "" ||
            document.getElementById("idRol").value == "") {
            alert("Todos los datos del formulario son requeridos");
            return false;
        } else if (document.getElementById("Pwd").value != document.getElementById("rePwd").value) {

            // document.getElementById("msgErr").innerHTML = "Las contraseñas deben de ser iguales";
            document.getElementById("Pwd").value == "";
            document.getElementById("rePwd").value == "";
            alert("Las contraseñas no coinciden");
            return false;
        } else {
            return true;
        }
        //detener el submit
    }
</script>

<div class="container">
    <div class="row">
        <h1 class="h2 text-center">Hola ingresa tus datos</h1>
        <?php if ($msg != "") echo "<div id='msgErr'>$msg</div>"; ?>
        <div class="col-md-6">

        </div>
        <div class="col-md-12">
            <br><br><br>
            <div class="card">
                <div class="card-header text-center">
                    <p><i class="bi bi-door-open"></i> Registrate</p>
                </div>
                <div class="card-body">
                    <!-- se envian los datos por el metodo post -->
                    <!-- LOGIN FORM -->
                    <form action="registraUsuario.php" method="get" onsubmit="return verificaForm()">
                        <div class="mb-3 text-center">
                            <label class="form-label"> <i class="bi bi-person-circle"></i> Nombre</label>
                            <input type="text" class="form-control" name="Nombre" id="Nombre" placeholder="Ingresa tu nombre">
                        </div>
                        <div class="mb-3  text-center">
                            <label class="form-label"> <i class="bi bi-shield-lock"></i> Contraseña</label>
                            <input type="password" class="form-control" name="Pwd" id="Pwd" placeholder="Ingresa tu Contraseña">
                        </div>
                        <div class="mb-3 text-center">
                            <label class="form-label"> <i class="bi bi-shield-lock"></i> Repite contraseña</label>
                            <input type="password" class="form-control" name="rePwd" id="rePwd" placeholder="Reingresa tu Contraseña">
                        </div>
                        <div class="mb-3 text-center">
                            <label class="form-label"> <i class="bi bi-envelope"></i> Email</label>
                            <input type="email" class="form-control" name="Email" id="Email" placeholder="Ingresa tu Email">
                        </div>
                        <div class="mb-3  text-center">
                            <label class="form-label"> <i class="bi bi-geo-alt"></i> Dirección</label>
                            <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder="Ingresa tu Direccion">
                        </div>

                        <input type="hidden" id="idRol" name="idRol" value="1">
                        <div class=" text-center">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus"></i> Registrate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("template/footer.php");
        ?>