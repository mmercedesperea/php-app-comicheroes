<?php

 // importamos librerias
require_once "libs/Sesion.php";

// Traemos el navbar
require_once "libs/Nav.php";

?>
<div class="contenedor text-success nologin">
    <img class="d-block mx-auto sad mt-5" src="assets/images/sad.png" alt="..."><br>
    <h3> YOU DON'T HAVE PERMISSION TO ACCESS. IF YOU WANT TO ACCESS, PLEASE LOGIN OR REGISTER.</h3>
    <div class="row mb-5 mt-5">
        <div class="col-md-6 text-center">
            <a href="login.php" class="btn bg-success  w-25">LOGIN</a>
        </div>
        <div class="col-md-6 text-center">
            <a href="register.php" class="btn bg-info  w-25">REGISTER</a>
        </div>
    </div>

</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>