<?php

// traemos las librerias
require_once "libs/Comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

?>
<div class="followingList">
    <?php
    // conectamos con la base de datos
    $db = Database::getInstance();

    // buscamos los comics que esta siguiendo el usuario
    if (!$db->query("SELECT u.idCom, imagen,nombre FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom WHERE idUsu LIKE ?;", [$usr->getIdUsu()])) {
        echo "No comic is being followed";
    } else {
        // Obtenemos el numero de columanas
        $total  = $db->getNumRows();
        ?> <h3 class="mb-5">FOLLOWING: <?php echo $total ?> </h3>
        <?php
            do {
                ?>
            <!-- vamos generando filas mientras tengamos elementos  -->
            <div class="row mb-2">
                <?php
                        // obtenemos el comic con su informacion
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
            </div>
        <?php
            } while ($item);
            ?>
    <?php
    }
    ?>
</div>