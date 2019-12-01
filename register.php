<?php

// Importamos librerias
require_once "libs/Sesion.php";

// Traemos el navbar
require_once "libs/Nav.php";
require_once "libs/DatabasePDO.php";

// Comprobamos que hemos recibido informacion
if (!empty($_POST)) {

    // capturamos los datos del formulario
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = !empty($_POST["apellidos"]) ? $_POST["apellidos"] : null;
    $pass = hash("md5", $_POST["pass"]);
    $pass2 =  hash("md5", $_POST["conf"]);
    $fecha_nac = !empty($_POST["fnac"]) ? $_POST["fnac"] : null;

    // comprobamos que las contraseñas son iguales
    if ($pass == $pass2) {

        // intentamos registrarnos
        // hacemos la conexion
        $db = Database::getInstance();

        // construimos la sentecia
        if ($db->query(
            "INSERT INTO usuario (email,pass,nombre,apellidos,fec_nacimiento)  VALUES (?, ?, ?, ?, ?); ",
            [$email, $pass, $nombre, $apellido, $fecha_nac]
        )) $ses->redirect("login.php");
    } else {
        $error = "Passwords do not match";
    };
}
?>
<div class="contenedor ">
    <div class="container text-success register  borde  mb-5 mt-5">
        <h1 class="mt-2">REGISTER</h1>
        <!-- formulario de registro -->
        <form method="post">
            <!-- Email -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="email">EMAIL</label>
                    <input class="form-control" type="email" name="email" placeholder="email@comicheroes.com" required />
                </div>
            </div>
            <!-- nombre -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="nombre">NAME</label>
                    <input class="form-control" type="text" name="nombre" required />
                </div>
            </div>
            <!-- apellidos -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="apellidos">SURNAME</label>
                    <input class="form-control" type="text" name="apellidos" />
                </div>
            </div>
            <!-- contraseña -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="pass">PASSWORD</label>
                    <input class="form-control" type="password" name="pass" required />
                </div>
            </div>
            <!-- confirma contraseña -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="conf">REPEAT PASSWORD</label>
                    <input class="form-control" type="password" name="conf" required />
                </div>
            </div>

            <!-- fecha de nacimiento -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <label class="col-form-label" for="fnac">BIRTH DATE</label>
                    <input class="form-control" type="date" name="fnac" />
                </div>
            </div>

            <!-- SI se ha producido un error avisalo -->
            <?php
            if (isset($error)) {
                ?><div class="alert alert-danger  w-50  mx-auto">
                    <?php
                        echo $error;
                        ?>
                </div>
            <?php
            }
            ?>
            <!-- registro -->
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <button class="btn  bg-success  w-50" type="submit">REGISTER</button>
                </div>
            </div>
        </form>
        <br />
    </div> 
</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>