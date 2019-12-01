<?php

// importamos librerias
require_once "libs/Sesion.php";

// Traemos el navbar
$paginaES = "LOG";
require_once "libs/Nav.php";

// comprobar si hemos recibido información mediante la variable global $_POST
if (!empty($_POST)) :
    // variable para almacenar lo recibido y cifrar contraseña
    $email = $_POST["email"];
    $pass =  hash("md5", $_POST["pass"]); // Ciframos la contraseña

    // intentamos loguearnos
    $conexion  = $ses->login($email, $pass);

    // si el login se ha hecho con éxito redirigimos al index
    if ($conexion) $ses->redirect("index.php");

endif;

?>
<div class="contenedor ">
    <div class="container text-success login  borde  mb-5 mt-5">
        <h1 class="mt-2">LOGIN</h1>
        <!-- formulario de login -->
        <form method="post" class=" mb-5 ">

            <!-- email -->
            <div class="row mt-2 form-group">
                <div class="col-md-12">
                    <label class="col-form-label" for="nombre">EMAIL</label>
                    <input class="form-control w-25 mx-auto" type="text" name="email" placeholder="email@comicheroes.com" required />
                </div>
            </div>

            <!-- contraseña -->
            <div class="row mb-5 form-group">
                <div class="col-md-12">
                    <label class="col-form-label" for="nombre">PASS</label>
                    <input class="form-control w-25 mx-auto" type="password" name="pass" required />
                </div>
            </div>

            <?php

            // si conexion no contiene datos o es false
            if ((isset($conexion )) && (!$conexion )) :
                ?>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="alert alert-danger w-50 mx-auto" role="alert">
                        Incorrect username or password.
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>

            <!-- botón LOGIN -->
            <div class="row form-group">
                <div class="col-md-12 text-center">
                    <button class="btn bg-success w-25" type="submit">ENTER</button>
                </div>
            </div>

        </form>

        <!-- acceso REGSISTRO -->
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <a href="register.php" class="btn bg-info  w-25">REGISTER</a>
            </div>
        </div>
    </div>
</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>