<?php

// importamos las librerias
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

            <div class="followingList">
                <?php

                // buscamos los comics correspondientes
                if (!$db->query("SELECT u.idCom,fec_publi,imagen,nombre FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom WHERE idUsu LIKE ? AND fec_publi > CURRENT_TIMESTAMP() ORDER BY fec_publi;", [$usr->getIdUsu()])) {
                    echo "No se han encontrado comics con ese nombre";

                }else {
                    // Obtenemos el numero de columanas
                    $total  = $db->getNumRows();
                    ?> <h3 class="mb-5">NEXT RELEASE: <?php echo $total ?> </h3>
                    <?php
                        do {
                            ?>
                        <div class="row mb-2">
                            <?php
                                    while (($item = $db->getObject("Comic"))) :
                                        ?>
                                <div class="col-md-3 pb-2">
                                    <img class="portadas" src="<?= $item->getPortada() ?>" class="card-img-top" />
                                    <a href="info.php?id=<?= $item->getIdCom() ?>">
                                        <h6 class="card-title"><?= $item->getNombre() ?></h6>
                                    </a>
                                </div>
                            <?php
                                    endwhile; ?>
                        </div>
                    <?php
                        } while ($item);
                        ?>
                <?php
                }    
                ?>
            </div>
        </div>
    </div>
</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>