<!DOCTYPE html>
<html lang="es">

<head>
	<title> Comic Heroes</title>
	<meta charset="utf8" />
</head>

<body>

	<?php

	// realizamos la solicitud, para buscar los proximos comcis
	$datos  = file_get_contents("https://api.shortboxed.com/comics/v1/future");

	// si tengo información
	if ($datos) :
		// Tratamos de conectarnos a la BD
		try {
			$pdo = new PDO("mysql:host=localhost; dbname=comicheroes", "root", "");
		} catch (PDOException $excpt) { // Si no nos cocectamos mandamos el error
			die("**ERROR: " . $excpt->getMessage());
		}

		// convertimos a JSON un formato manejable para PHP
		$info = json_decode($datos);

		// Recorremos el json que hemos creado mediante un foreach
		foreach ($info->comics as $item) :
			// guardamos los datos necesarios
			$nombre    = $item->title;
			$autor     = (!empty($item->creators)) ? $item->creators : null;
			$editorial = (!empty($item->publisher)) ? $item->publisher : null;
			$fec_publi = (!empty($item->release_date)) ? $item->release_date : null;
			$descripcion = (!empty($item->description)) ? $item->description : null;

			// Definir consulta SQL
			$sql = "INSERT INTO comic (nombre,autor,editorial,fec_publi,descripcion)";
			$sql .= 'VALUES (:nombre, :autor,:editorial, :fec_publi, :descripcion)';

			//Preparamos la consulta
			$sqlp = $pdo->prepare($sql);

			//vinculado los parámetros a la consulta SQL
			$sqlp->bindValue(":nombre", $nombre, PDO::PARAM_STR);
			$sqlp->bindValue(":autor", $autor, PDO::PARAM_STR);
			$sqlp->bindValue(":editorial", $editorial, PDO::PARAM_STR);
			$sqlp->bindValue(":fec_publi", $fec_publi, PDO::PARAM_STR);
			$sqlp->bindValue(":descripcion", $descripcion, PDO::PARAM_STR);

			// Ejecutamos la sentencia
			if (!$sqlp->execute())  // si se ha producido un error 
				$error = " se ha producido un error en la creacion del comic"; // Informamos de ello
		endforeach;

		$pdo = null;

	endif;
	?>

</body>

</html>