<?php

// importamos librerias
require_once "libs/Sesion.php";

// Traemos el navbar
$paginaES = "ADM";
require_once "libs/Nav.php";

// Conexion con la BD
$db = Database::getInstance();


// seleccionamos todos los usuarios de la web
$db->query("SELECT idUsu  FROM usuario ");
// Obtenemos el numero de usuarios
$totalUsu  = $db->getNumRows();

// seleccionamos todos los comics de la web
$db->query("SELECT idCom  FROM comic ");
// Obtenemos el numero de comics
$totalCom  = $db->getNumRows();

// seleccionamos todos los seguimientos que se estan haciendo 
$db->query("SELECT idUsu,idCom  FROM usu_comic ");
// Obtenemos el numero de seguimientos
$totalSeg  = $db->getNumRows();


?>
<div class="contenedor text-success adminPanel">
    <div class="panel m-5">

        <h1 class="display-4">This is the admin panel</h1>
        <p class="lead">This is the web administration panel where you can see different elements that make it easier to keep track of the web.</p>
        <hr class="my-4">
        <h1 class=" text-center mb-5">STATISTICS</h1>

        <div class="row  justify-content-center justify">
            <div class="col-md-3 text-center TUsers">
                <div class="card">
                    <div class="card-header  bg-success">
                        <img src="https://img.icons8.com/color/48/000000/hulk.png">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">TOTAL USERS</h5>
                        <h3 class="card-text"> <?php echo $totalUsu ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-3 text-center TComic">
                <div class="card">
                    <div class="card-header  bg-success">
                    <img src="https://img.icons8.com/color/48/000000/comic-book.png">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">TOTAL COMICS</h5>
                        <h3 class="card-text"> <?php echo $totalCom ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 text-center TUsers">
                <div class="card">
                    <div class="card-header  bg-success">
                    <img src="https://img.icons8.com/doodle/48/000000/follow--v3.png">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">COMICS FOLLOWED</h5>
                        <h3 class="card-text"> <?php echo $totalSeg ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>