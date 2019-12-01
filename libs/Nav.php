<?php

// Obtenemos la instancia de la sesión
$ses = Sesion::getInstance();

// Para controlar a los usuarios
$admin=0;

// Comprobar si hay una sesión activa
if ($ses->checkActiveSession()) {
    // obtenemos los elementos de nuestra sesion
    $datosSes = $ses->getSesion();
    // Obtenemos la id de nuestro usuario de sesion
    $idSes = $datosSes->getIdUsu();
    $admin = $datosSes->getAdmin();
    // cogemos los datos de nuestro usuario que se ha logueado
    $usr = $ses->userLoged($idSes);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Comic Heroes</title>
    <meta charset="utf8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <!-- IMPORTAMOS BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- IMPORTAMOS JQUERY -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- IMPORTAMOS FONT AWESOME ICON LIBRARY -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navHead navbar-expand-lg navbar-light sticky-top bordeT bordeB">
            <a class="navbar-brand " href="index.php">
                <img src="assets/images/logo_comic.png" width="100" alt="">
            </a>
            <div class="vl"></div>
            <!-- NOMBRE DEL USUARIO CONECTADO -->
            <div class="Nom">
                <p> <?php
                    if ($ses->checkActiveSession()) {
                        echo  'Welcome ' . $usr->getNombre();
                    }
                   
                    ?>
                </p>
            </div>
            <!-- MENU HAMBURGUESA -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- BARRA DE NAVEGACION -->
            <div class="collapse navbar-collapse navl" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php if ( $paginaES === "HOME"){ echo "active";}; ?>"  href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ( $paginaES === "SEAR"){ echo "active";}; ?>" href="search.php">SEARCH</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ( $paginaES === "LIB"){ echo "active";}; ?>" href="library.php">LIBRARY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ( $paginaES === "PRO"){ echo "active";}; ?>" href="profile.php">PROFILE</a>
                    </li>
                    <?php
                    // si el usuario es administrador muestra su panel
                    if($admin==1){
                        ?>
                        <li class="nav-item">
                        <a class="nav-link <?php if ( $paginaES === "ADM"){ echo "active";}; ?>" href="admin.php">ADMIN</a>
                    </li>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <?php
                        // SI EL USUARIO ESTA CONECTADO MUESTRA EL BOTON LOGOUT PARA DESCONECTARTE
                        if ($ses->checkActiveSession()) {
                            ?> <a class="nav-link <?php if ( $paginaES === "LOG"){ echo "active";}; ?>" href="logout.php">LOGOUT</a>
                        <?php
                        } else {
                            ?> <a class="nav-link <?php if ( $paginaES === "LOG"){ echo "active";}; ?>" href="login.php">LOGIN</a>
                        <?php
                        }
                        ?>

                    </li>
                </ul>
            </div>
        </nav>
</body>

</html>