<?php

// Importamos las librerias
require_once "libs/Comic.php";
require_once "libs/Usu_comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

// creamos instancia de la BD
$db = Database::getInstance();

$paginaES = "HOME";

// Traemos el navbar
require_once "libs/nav.php";

?>

<div class="contenedor">
	<div class="con1 row no-gutters">
		<div class="col-md-4 ">
			<?php
			// Realizamos la consulta para traernos el comic con mas nota
			$sql = $db->query("SELECT u.idCom, imagen, puntuacion,nombre, sum(puntuacion) / count(u.idCom) as Notamax FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom GROUP by u.idCom order by Notamax desc, nombre asc LIMIT 1");
			// guardamos el objeto
			$item = $db->getObject("Comic");
			?>
			<div class="cardA bordeB bordeR">
				<img src=" <?= $item->getPortada() ?>" class="crop" alt="...">
				<img src="assets/images/burbuja.png" class="burbuja">
				<a class="Tcentrado" href="info.php?id=<?= $item->getIdCom() ?> ">
					<p>HIGHEST SCORE</p>
				</a>
			</div>
		</div>
		<div class="col-md-8">
			<?php
			// Realizamos la consulta para traer los comics con la fecha de publicacion menor a la fecha actual
			$sql = $db->query("SELECT * FROM comic WHERE fec_publi <= CURRENT_TIMESTAMP() ORDER BY fec_publi DESC LIMIT 1;");
			$item = $db->getObject("Comic");
			?>
			<div class="row no-gutters bordeB RR">
				<div class="releaseI">
					<a class="tipo1" href="info.php?id=<?= $item->getIdCom() ?> ">LAST RELEASE</a>
					<img src=" <?= $item->getPortada() ?>" class=" bordeAmarillo float-right" alt="...">
				</div>
			</div>
			<?php
			// Realizamos la consulta para traernos el comic más seguido
			$sql = $db->query("SELECT u.idCom, imagen,nombre, count(u.idCom) as TOTAL FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom GROUP by u.idCom order by TOTAL desc, nombre asc LIMIT 1");
			// guardamos el objeto
			$item = $db->getObject("Comic");
			?>
			<div class="row no-gutters bordeB RR">
				<div class="followedI">
					<a class="tipo2" href="info.php?id=<?= $item->getIdCom() ?> ">MOST FOLLOWED</a>
					<img src=" <?= $item->getPortada() ?>" class=" bordeVerde " alt="...">
				</div>
			</div>
		</div>
		<!-- LAST RELEASE -->
		<div class="novedades borde pt-2 pb-2">
			<h1> <img class="icon" src="https://img.icons8.com/office/30/000000/captain-america.png">
				LAST RELEASE
				<img class="icon" src="https://img.icons8.com/office/30/000000/captain-america.png">
			</h1>
			<div class="row pt-3">
				<?php
				//Realizamos la consulta
				$sql = $db->query("SELECT * FROM comic WHERE fec_publi <= CURRENT_TIMESTAMP() ORDER BY fec_publi DESC LIMIT 6;");
				// si la consulta se ha realizado correctamente:
				if ($sql) {
					while ($item = $db->getObject("Comic")) {
						?>
						<div class="col-md-2 pb-2">
							<div>
								<img src=" <?= $item->getPortada() ?>" class="porataList" alt="...">
								<a href="info.php?id=<?= $item->getIdCom() ?> "><?= $item->getNombre() ?></a>
							</div>
						</div>
				<?php
					}
				} else {
					echo "THE CONSULTATION HAS FAILED";
				};
				?>
			</div>
		</div>

		<div class="proximos borde pt-2 pb-2">
			<h1> <img class="icon" src="https://img.icons8.com/officel/30/000000/spiderman-head--v1.png">
				NEXT RELEASE
				<img class="icon " src="https://img.icons8.com/officel/30/000000/spiderman-head--v1.png">
			</h1>
			<div class="row pt-3">
				<?php
				// Realizamos la consulta
				$sql = $db->query("SELECT * FROM comic WHERE fec_publi > CURRENT_TIMESTAMP() ORDER BY fec_publi DESC LIMIT 6;");

				// si la consulta se ha realizado correctamente:
				if ($sql) {
					while ($item = $db->getObject("Comic")) {
						?>
						<div class="col-md-2 pb-2">
							<div>
								<img src=" <?= $item->getPortada() ?>" class="porataList" alt="...">
								<a href="info.php?id=<?= $item->getIdCom() ?> "><?= $item->getNombre() ?></a>

							</div>
						</div>
				<?php
					}
				} else {
					echo "THE CONSULTATION HAS FAILED";
				};
				?>
			</div>
		</div>
		<div class="hall pt-2 pb-2">
			<h1> <img class="icon" src="https://img.icons8.com/color/48/000000/batman-old.png">
				HALL OF FAME
				<img class="icon" src="https://img.icons8.com/color/48/000000/batman-old.png">
			</h1>
			<div class="row pt-3 ml-4 mr-4">
				<?php
				// REALIZAMOS LA CONSULTA
				$sql = $db->query("SELECT u.idCom, imagen, puntuacion,nombre, sum(puntuacion) / count(u.idCom) as Notamax FROM comic c INNER JOIN usu_comic u ON c.idCom=u.idCom GROUP by u.idCom order by Notamax desc, nombre asc LIMIT 6;");

				// si la consulta se ha realizado correctamente:
				if ($sql) {
					while ($item = $db->getObject("Comic")) {
						?>
						<div class="col-md-2 pb-4 ">
							<div class="card ">
								<img src=" <?= $item->getPortada() ?>" class="card-img-top portadas" alt="...">
								<div class="card-body">
									<a href="info.php?id=<?= $item->getIdCom() ?> "><?= $item->getNombre() ?></a>
								</div>
							</div>
						</div>
				<?php
					}
				} else {
					echo "THE CONSULTATION HAS FAILED";
				};

				?>
			</div>
		</div>
	</div>
</div>

<?php
// Traemos el footer
require_once "libs/Footer.php";
?>