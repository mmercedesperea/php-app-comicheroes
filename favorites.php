<?php

// Importamos las librerias
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

// hacemos la conexion a la BD
$db = Database::getInstance();

?>
<div class="contenedor">
    <div class="row no-gutters">
        <div class="col-md-5 bordeR bordeB">
            <!-- Nos traemos el calendario -->
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

            <div class="followingList">
                <?php
                // buscamos los comics que pertenecen a esta pagina
                if (!$db->query("SELECT u.idCom, imagen,nombre FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom WHERE idUsu LIKE ? AND favorito = 1;", [$usr->getIdUsu()])) {
                    echo "You have no comics in favorites";
                } else {
                    // Obtenemos el numero de columanas que nos trae la consulta para sacar el total de comics
                    $total  = $db->getNumRows();
                    ?> <h3 class="mb-5">FAVORITES: <?php echo $total ?> </h3>

                    <?php
                        //  Mientras haya elementos , que se vaya repitiendo la accion
                        do {
                            ?>
                        <div class="row mb-2">
                            <?php
                                    // Mientras tengamos objetos comics
                                    while (($item = $db->getObject("Comic"))) :
                                        ?>
                                <div class="col-md-3 pb-2">
                                    <img class="portadas" src="<?= $item->getPortada() ?>" class="card-img-top" />
                                    <a href="info.php?id=<?= $item->getIdCom() ?>">
                                        <h6 class="card-title"><?= $item->getNombre() ?></h6>
                                    </a>
                                </div>
                            <?php
                                    endwhile;
                                    ?>
                            <div>
                        <?php
                            } while ($item);
                        }
                        ?>
                            </div>
                        </div>
            </div>
        </div>
    </div>

    <?php
    // Traemos el footer
    require_once "libs/footer.php";
    ?>