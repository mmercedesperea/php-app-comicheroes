<?php

// IMPORTAMOS LAS LIBRERIAS
require_once "libs/Comic.php";
require_once "libs/DatabasePDO.php";
require_once "libs/Sesion.php";

// Traemos el navbar
$paginaES = "PRO";
require_once "libs/Nav.php";

// comprobar si hay una sesión activa
if (!$ses->checkActiveSession()) {
	$ses->redirect("nologin.php");
};

// hacemos la conexion
$db = Database::getInstance();

if (isset($_POST['form'])) {

	switch ($_POST['form']) {
		case "A":
			$ses->deleteUser($usr);
			$ses->close();
			$ses->redirect("index.php");
			break;

		case "B":
			if (!empty($_POST)) {

				// capturamos los datos del formulario
				$email =  !empty($_POST["email"]) ? $_POST["email"] : $usr->getEmail();
				$nombre =  !empty($_POST["nombre"]) ? $_POST["nombre"] : $usr->getNombre();
				$apellido = !empty($_POST["apellidos"]) ? $_POST["apellidos"] : $usr->getApellidos();
				$pass =  !empty($_POST["pass"]) ? hash("md5", $_POST["pass"]) : $usr->getPass();
				$pass2 =  !empty($_POST["conf"]) ? hash("md5", $_POST["conf"]) : $usr->getPass();
				$fecha_nac = !empty($_POST["fnac"]) ? $_POST["fnac"] : $usr->getFec_nacimiento();

				// comprobamos que las contraseñas son iguales
				if ($pass == $pass2) {
					$usr->setEmail($email);
					$usr->setNombre($nombre);
					$usr->setApellidos($apellido);
					$usr->setPass($pass);
					$usr->setPass($pass2);
					$usr->setFec_nacimiento($fecha_nac);
					$ses->updateUser($usr);
				} else {
					$error = "Passwords do not match";
				};
			}
			// Comprobamos que se manda un archivo (Para cambiar la imagen de perfil) 
			if (!empty($_FILES)) {
				$path_ini = $_FILES["img"]["tmp_name"];
				$path_fin = "assets/images/profile/" . time() . ".jpg";

				if (!move_uploaded_file($path_ini, $path_fin)) { } else {
					$usr->setFoto($path_fin);
					$ses->updateUser($usr);
				}
			}
			break;
	}
}

?>
	<div class="infocom row mt-4  p-4 bg-light borde ">
		<div class="col-md-6 pt-5 ">
			<div>
				<!-- foto -->
				<img class="p-3 d-block bg-dark photo" src="<?= $usr->getFoto() ?>" alt="..."><br>
				<form method="post" enctype="multipart/form-data">
					<div class="col ">
						<button type="submit" name="form" value="A" class="btn btn-danger">DELETE PROFILE</button>
					</div>
				</form>
			</div>
		</div>
		<!-- INFO USUARIO -->
		<div class="col-md-6 mx-auto">
			<h2 class="text-center"><?= $usr->getNombre() ?></h2>
			<hr>
			<span class="text-success des"> EMAIL: </span><span><?= $usr->getEmail() ?> </span><br>
			<span class="text-success des"> SURNAME: </span><span> <?= $usr->getApellidos() ?> </span><br>
			<span class="text-success des"> BIRTH DATE: </span><span> <?= $usr->getFec_nacimiento() ?> </span><br>
			<hr>
			<!-- ACTUALIZAR EL PERFIL -->
			<div class="updateProfile ">
				<h3 class="text-center pb-2">UPDATE PROFILE </h3>
				<form method="post" enctype="multipart/form-data">
					<!-- EMAIL -->
					<div class="form-group row">
						<label for="email" class="col-sm-4 col-form-label">EMAIL</label>
						<div class="col-sm-8">
							<input type="email" class="form-control" name="email">
						</div>
					</div>
					<!-- NOMBRE -->
					<div class="form-group row">
						<label for="nombre" class="col-sm-4 col-form-label">NAME</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nombre">
						</div>
					</div>
					<!-- APELLIDOS -->
					<div class="form-group row">
						<label for="apellidos" class="col-sm-4 col-form-label">SURNAME</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="apellidos">
						</div>
					</div>
					<!-- FECHA NACIMIENTO -->
					<div class="form-group row">
						<label for="fnac" class="col-sm-4 col-form-label">BIRTH DATE</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" name="fnac">
						</div>
					</div>
					<!-- CONTRSEÑA -->
					<div class="form-group row">
						<label for="pass" class="col-sm-4 col-form-label">PASSWORD</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="pass">
						</div>
					</div>
					<!-- CONTRSEÑA 2-->
					<div class="form-group row">
						<label for="conf" class="col-sm-4 col-form-label">CONFIRM PASSWORD</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="conf">
						</div>
					</div>
					<div class="form-group row">
						<div class="col form-group">
							<label for="img">LOAD PROFILE IMAGEN</label>
							<input type="file" class="form-control-file" id="img" name="img" accept="image/jpg, image/png" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col ">
							<button type="submit" name="form" value="B" class="btn btn-primary">UPDATE</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
	// Traemos el footer
	require_once "libs/Footer.php";
	?>