<?php

require_once "libs/Sesion.php";

// Traemos el navbar
require_once "libs/Nav.php";

?>
<div class="contenedor text-success nologin">
    <img class="d-block mx-auto sad mt-5" src="assets/images/sadBatman.png" alt="..."><br>
    <h3>This page is under development! If you have any questions please get in touch:</h3>
    <div class="row mb-5 mt-5">
        <div class="col-md-12 text-center">
            <a href="contact.php" class="btn bg-success w-25">CONTACT</a>
        </div>
    </div>
</div>

<!-- // Traemos el footer -->
<?php
require_once "libs/Footer.php";
?>