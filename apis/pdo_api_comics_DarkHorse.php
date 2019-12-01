<!DOCTYPE html>
<html lang="es">

<head>
	<title> Comic Heroes</title>
	<meta charset="utf8" />
</head>

<body>

	<?php
	// API KEY
	define('API_KEY', '****');

	// realizamos la solicitud, para buscar los comics de Dark horse
	$datos  = file_get_contents("https://www.googleapis.com/books/v1/volumes?" . API_KEY . "&startIndex=0&maxResults=40&q=inpublisher:Dark%20Horse%20Comics");

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
		foreach ($info->items as $item) :

			// guardamos los datos necesarios
			$nombre  = $item->volumeInfo->title;
			$autor   = (!empty($item->volumeInfo->authors[0])) ? $item->volumeInfo->authors[0] : null;
			$imagen  = (!empty($item->volumeInfo->imageLinks->thumbnail)) ? $item->volumeInfo->imageLinks->thumbnail : null;
			$categoria = (!empty($item->volumeInfo->categories[0])) ? $item->volumeInfo->categories[0] : null;
			$compra = (!empty($item->saleInfo->buyLink)) ? $item->saleInfo->buyLink : null;
			$isbn = $item->volumeInfo->industryIdentifiers[0]->identifier;
			$editorial = (!empty($item->volumeInfo->publisher)) ? $item->volumeInfo->publisher : null;
			$fec_publi = (!empty($item->volumeInfo->publishedDate)) ? $item->volumeInfo->publishedDate : null;
			$descripcion = (!empty($item->volumeInfo->description)) ? $item->volumeInfo->description : null;
			$paginas = (!empty($item->volumeInfo->pageCount)) ? $item->volumeInfo->pageCount : null;

			// Definir consulta SQL
			$sql = "INSERT INTO comic (nombre,autor,imagen,categoria,compra,isbn,editorial,fec_publi,descripcion,paginas)";
			$sql .= 'VALUES (:nombre, :autor, :imagen, :categoria, :compra, :isbn, :editorial, :fec_publi, :descripcion, :paginas)';

			//Preparamos la consulta
			$sqlp = $pdo->prepare($sql);

			//vinculado los parámetros a la consulta SQL
			$sqlp->bindValue(":nombre", $nombre, PDO::PARAM_STR);
			$sqlp->bindValue(":autor", $autor, PDO::PARAM_STR);
			$sqlp->bindValue(":imagen", $imagen, PDO::PARAM_STR);
			$sqlp->bindValue(":categoria", $categoria, PDO::PARAM_STR);
			$sqlp->bindValue(":compra", $compra, PDO::PARAM_STR);
			$sqlp->bindValue(":isbn", $isbn, PDO::PARAM_STR);
			$sqlp->bindValue(":editorial", $editorial, PDO::PARAM_STR);
			$sqlp->bindValue(":fec_publi", $fec_publi, PDO::PARAM_STR);
			$sqlp->bindValue(":descripcion", $descripcion, PDO::PARAM_STR);
			$sqlp->bindValue(":paginas", $paginas, PDO::PARAM_INT);

			// Ejecutamos la sentencia
			if (!$sqlp->execute())  // si se ha producido un error 
				$error = "Se ha producido un error en la creacion del comic";
		endforeach;

		$pdo = null;
	endif;
	?>

</body>

</html>
