<?php
if ($_POST) {
    header('location:inicio.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login ADM</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- css boostrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<!-- TODO IDK si esto jala -->
<body>

    <?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/holy%20sensations%20spa";
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <br><br><br>
                <div class="card">
                    <div class="card-header">
                        <p><i class="bi bi-door-open"></i> Login Administrador</p>
                    </div>
                    <div class="card-body">
                        <!-- se envian los datos por el metodo post -->
                        <!-- LOGIN FORM -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label"> <i class="bi bi-person-circle"></i> Usuario</label>
                                <input type="email" class="form-control" name="Nombre" id="Nombre" placeholder="Ingresa tu usuario">
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> <i class="bi bi-shield-lock"></i> Contrase??a</label>
                                <input type="password" class="form-control" name="Pwd" id="Pwd" placeholder="Ingresa tu contrase??a">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-person-check"></i> Sign in </button> <a href=" <?php echo $url ?> " class="btn btn-danger">Regresar al sitio web</a>


                        </form>
                    </div>
                </div>
            </div>


            <?php
            include('template/footer.php');
            ?>