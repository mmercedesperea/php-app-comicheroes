<?php

// traemos las librerias
require_once "libs/Comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

// Traemos el navbar
$paginaES = "LIB";
require_once "libs/Nav.php";

// comprobar si hay una sesión activa
if (!$ses->checkActiveSession()) {
	$ses->redirect("nologin.php");
};

// hacemos la conexion
$db = Database::getInstance();

?>

<div class="contenedor">
    <div class="row no-gutters">
        <div class="col-md-5 bordeR  bordeB">
            <?php
            require_once "calendar.php";
            ?>
        </div>
        <div class="col-md-7 bordeB ">
            <nav class="navbar navUsu navbar-expand-lg bordeB">
                <div class="navbar-nav mx-auto">
                    <a class="nav-item nav-link" href="library.php" class="inf">FOLLOWING </a>
                    <a class="nav-item nav-link" href="favorites.php" class="inf">FAVORITES</a>
                    <a class="nav-item nav-link" href="nextRelease.php">NEXT-RELEASE</a>
                    <a class="nav-item nav-link" href="read.php">READ</a>
                </div>
            </nav>
            <?php
            // Traemos el archivo following
            require_once "following.php";
            ?>
        </div>
    </div>

</div> 

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>
