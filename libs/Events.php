<?php

// PARA EL USO DE LA LIBRERIA EVENTS

require_once "../libs/Comic.php";
require_once "../libs/DatabasePDO.php";

$db = Database::getInstance();

$db->query("SELECT *  FROM comic ");

$eventos =[]; // array para almacenar los eventos

while ($item = $db->getObject("Comic")) :
    $id =$item-> getIdCom();
    $nombre = $item->getNombre();
    $fecha = $item-> getFec_publi();
// vamos rellenando nuestro array con los datos de nuestra BD
    $eventos[]=['id'=>$id,'title'=>$nombre,'date'=>$fecha];
endwhile;
// Transformamos el resultado en Json
echo json_encode($eventos);
