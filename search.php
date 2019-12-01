<?php

// Importamos librerias
require_once "libs/Comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

// variable para definir el numero maximo de comics por pagina
$comicPagina = 24;

// importamos el nav
$paginaES = "SEAR";
require_once "libs/Nav.php";

?>
<div class="contenedor">
    <div class="buscador">
        <!-- BARRA BUSCADOR -->
        <div class="NavBuscador ">
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="busqueda">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <br>
        <?php
        // conectamos con la base de datos
        $db = Database::getInstance();
        $busqueda = "";

        // PARA COGER EL ELEMENTO DEL POST
        if (!empty($_GET["busqueda"])) :
            $busqueda =  $_GET["busqueda"];
        endif;

        // seleccionamos todos los comics que se encuentren segun nuestro parametro
        $db->query("SELECT *  FROM comic  WHERE  nombre  LIKE ?;", ["%$busqueda%"]);

        // Obtenemos el numero de comics
        $total  = $db->getNumRows();
        ?> <h3 class="mb-5"> TOTAL: <?php echo $total ?> </h3>
        <?php

        // Para saber el numero de la pagina, si no se pasa ninguna ponemos de base 1 
        // iset (si una variable está definida y no es NULL)
        if (isset($_GET["p"])) {
            $pag = $_GET["p"];
        } else {
            $pag = 1;
        };

        // Definimos por donde va a empezar a traer elementos ( inicialmente la pagina es 0 y le decimos el maximo de elementos que queremos por pagina en este caso 24)
        $inicial = ($pag - 1) * $comicPagina;

        // Traemos los comics que va buscando el usuario
        if (!$db->query("SELECT * FROM comic WHERE  nombre  LIKE ?  LIMIT $inicial, $comicPagina  ;", ["%$busqueda%"])) {
            echo "No comics found with that name";
        } else {
            do { ?>
                <div class="row mb-2\">
                    <?php
                            // $columna ira añadiendo columnas por cada comics hasta llegar a 6 comics por fila
                            $columna = 0;
                            while (($columna < 6) && ($item = $db->getObject("Comic"))) {
                                ?>
                        <div class="col-md-2 pb-2">
                            <img class="portadas" src="<?= $item->getPortada() ?>" class="card-img-top" />
                            <a href="info.php?id=<?= $item->getIdCom() ?>">
                                <h6 class="card-title"><?= $item->getNombre() ?></h6>
                            </a>
                        </div>
                    <?php
                                $columna++;
                            }
                            ?>
                </div>
            <?php
                } while ($item);

                // Paginacion, $ anterior sera true si pag es igual a 1
                $anterior = false;
                if($pag == 1){
                    $anterior=true;
                }
                // siguiente sera pulsable (true) si la pagina * la cantidad maxima de comics que nos puede traer la pagina es menor al total de comics que trae la busqueda
                $siguiente = false;
                if(($pag * $comicPagina) >= $total){
                    $siguiente=true;
                }
                ?>

            <nav aria-label="Page navigation ">
                <ul class="pagination justify-content-center">
                    <!-- PREVIOUS -->
                    <!-- Si la pagina anterior no existe lo marcamos como disable si no la dejamos normal -->
                    <li class="page-item <?php if($anterior){echo "disabled";}else{ echo ""; } ?>">
                        <!-- si anterior es true no se pasara de pagina, si es false podremos seguir restando paginas  -->
                        <a class="page-link" href="<?php if($anterior){echo "#";}else{ echo "search.php?busqueda=" . ($busqueda) ."&p=" .($pag - 1); }; ?>">PREVIOUS</a>
                    </li>
                    <!-- NEXT -->
                    <li class="page-item <?php if($siguiente){echo "disabled";}else{ echo ""; } ?>">
                        <!-- si siguiente es true no se pasara de pagina, si es false podremos seguir sumando paginas  -->
                    <a class="page-link" href="<?php if($siguiente){echo "#";}else{ echo "search.php?busqueda=" . ($busqueda) ."&p=" .($pag + 1); }; ?>">NEXT</a>
                    </li>
                </ul>
            </nav>
        <?php
        }
        ?>
    </div>
</div>
<?php

// Traemos el footer
require_once "libs/Footer.php";
?>