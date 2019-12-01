<?php

// LIBRERIAS
require_once "libs/Comic.php";
require_once "libs/Usu_comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

// Traemos el navbar
$paginaES = "INFO";
require_once "libs/Nav.php";

//selecciono la id de la url para tener la id del comic
$id = $_GET["id"];

//variable para saber si tenemos el comic en la lista de ese usuario
$listado = false;

// Comprobamos que hay un usuario logueado
if ($ses->checkActiveSession()) {
	// si esta logueado pilla la id del usuario
	$idUsu = $usr->getIdUsu();
	// comprobamos que en la BD existe nuestro usuario con este comic
	if ($ses->Usu_comic($idUsu, $id)) {
		$listado = TRUE;
		// Almacenamos los datos del usu_comic
		$com_usu = $ses->getUsu_com();
	}
}

// hacemos la conexion a la BD
$db = Database::getInstance();

// para coger la puntuacion media del comic
$sql = $db->query("SELECT u.idCom, puntuacion,  CAST(( sum(puntuacion) / count(u.idCom) ) AS INT) as totalPuntuacion FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom  where u.idCom LIKE ? LIMIt 1;", [$id]);
if ($sql) {
	// guardamos el objeto
	$itempuntuacion = $db->getObject("Comic");
}

// post para la votacion
if (isset($_POST['submitRatingStar'])) {
	//procesar el rating
	$rate = $_POST["rate"];
	$ses->voteCom($idUsu, $id, $rate);
	header("Refresh:0");
}

//post con schitch estado coment favorite
if (isset($_POST['form'])) {

	switch ($_POST['form']) {
		case "READ":
			$ses->comSTATUS($idUsu, $id, "READ");
			header("Refresh:0");
			break;
		case "FOLLOW":
			$ses->comSTATUS($idUsu, $id, "FOLLOW");
			header("Refresh:0");
			break;
		case "NOT FOLLOWING":
			$ses->deleteUsuCom($idUsu, $id);
			header("Refresh:0");
			break;
		case "coment":
			if (!empty($_POST)) {
				$comentario = $_POST["comentario"];
				$ses->comentCom($idUsu, $id, $comentario);
				header("Refresh:0");
			}
			break;
		case "favorite":
			$ses->addFavorite($idUsu, $id);
			header("Refresh:0");
			break;
		case "delfavorite":
			$ses->delfavorite($idUsu, $id);
			header("Refresh:0");
			break;
	}
}

?>

	<div class="infocom row mt-4  p-4 bg-light borde ">
		<?php

		if (!$db->query("SELECT * FROM comic WHERE idCom=?;", [$id])) {
			echo "THE CONSULTATION HAS FAILED";
		} else {
			$item = $db->getObject("Comic");
			?>
			<div class="col-md-6 pt-5 ">
				<div>
					<img class="p-3 mx-auto d-block bg-dark borde" src="<?= $item->getPortada() ?>" alt="..."><br>

					<!-- SI hay un usuario logueado muestra lo siguiente -->
					<?php if ($ses->checkActiveSession()) { ?>

						<!-- FORM PARA EL ESTADO -->
						<form method="post">
							<div class="form-row align-items-center">
								<div class="col-auto my-1">
									<select name="form" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
										<option selected>
											<?php if ($listado === TRUE) {
														echo $com_usu->getEstado();
													} else {
														echo "NOT FOLLOWING";
													} ?>
										</option>
										<option value="NOT FOLLOWING">NOT FOLLOWING</option>
										<option value="FOLLOW">FOLLOW</option>
										<option value="READ">READ</option>
									</select>
								</div>
								<div class="col-auto my-1">
									<button type="submit" class="btn btn-success">UPDATE</button>
								</div>
							</div>
						</form>
						<?php
								if (($listado === TRUE) && ($com_usu->getEstado())) {
									?>
							<!-- AÑADIR A FAVORITOS -->
							<form method="post">
								<?php if ($com_usu->getFavorito() == 1) { ?>
									<button type="submit" name="form" value="delfavorite" class="btn btn-danger mt-5">DELETE FROM FAVORITES</button>
								<?php } else { ?>
									<button type="submit" name="form" value="favorite" class="btn btn-success mt-5">ADD TO FAVORITES</button>
								<?php } ?>
							</form>

							<!-- VOTACION DEL COMIC -->
							<form method="post">
								<div class=" mt-5">
									<span>YOUR RATING :<b> <?= $com_usu->getPuntuacion() ?></b></span><br>
									<div class="starts ">
										<input type="radio" id="es1" name="rate" value="5" />
										<label for="es1" class="fas fa-heart"></label>
										<input type="radio" id="es2" name="rate" value="4" />
										<label for="es2" class="fas fa-heart"></label>
										<input type="radio" id="es3" name="rate" value="3" />
										<label for="es3" class="fas fa-heart"></label>
										<input type="radio" id="es4" name="rate" value="2" />
										<label for="es4" class="fas fa-heart"></label>
										<input type="radio" id="es5" name="rate" value="1" />
										<label for="es5" class="fas fa-heart"></label>
									</div>
								</div>
								<button type="submit" name="submitRatingStar" class="btn btn-success btn-sm">VOTE</button>
							</form>
							<!-- COMENTAR EL COMIC -->
							<form method="post">
								<div class="form-group mt-5">
									<label for="exampleFormControlTextarea1">YOUR COMMENT:</label>
									<textarea class="form-control" id="comentario" name="comentario" placeholder="<?= $com_usu->getComentario() ?>" rows="3"></textarea>
								</div>
								<div class="form-group row  ">
									<div class="col ">
										<button type="submit" name="form" value="coment" class="btn btn-success">COMMENT</button>
									</div>
								</div>
							</form>
						<?php }; ?>
					<?php	}	?>
				</div>
			</div>
			<!-- PARA LA INFORMACION ESPECIFICA DEL COMIC -->
			<div class="col-md-6 mx-auto">
				<h2 ><?= $item->getNombre() ?></h2>
				<hr>
				<span class="text-success des"><b> Author: </span><span><?= $item->getNombre() ?></b> </span><br>
				<span class="text-success des"> Publisher: </span><span> <?= $item->getEditorial() ?> </span><br>
				<span class="text-success des"> Release date: </span><span> <?= $item->getFec_publi() ?> </span><br>
				<span class="text-success des"> ISBN: </span><span> <?= $item->getIsbn() ?></span><br>
				<span class="text-success des"> Pages: </span><span> <?= $item->getPaginas() ?></span><br>
				<span class="text-success des"> Average score: </span><span> <?= $itempuntuacion->getTotalpuntuation() ?></span><br><br>

				<?php
					// PARA COMPROBAR SI TENEMOS LINK DE COMPRA O NO
					if ($item->getCompra() == null) {
						?>
					<span class="text-success des"> </span><a class="btn btn-secondary  disabled" href="<?= $item->getCompra() ?> " target="_blank">Buy it!</a><br><br>
				<?php } else { ?>
					<span class="text-success des"> </span><a class="btn btn-info" href="<?= $item->getCompra() ?> " target="_blank">Buy it!</a><br><br><?php																															} ?>
				<span class="text-success des"> Description: </span><br>
				<p> <?= $item->getDescripcion() ?></p>
			</div>
	</div>
<?php
}

// Traemos el footer
require_once "libs/Footer.php";
?>