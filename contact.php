<?php

// importamos librerias
require_once "libs/Sesion.php";

// Traemos el navbar
require_once "libs/Nav.php";

?>
<div class="contenedor text-success contact">
    <!-- <img class="m-5" src="https://img.icons8.com/bubbles/100/000000/email.png"> -->

    <div class="row">
        <div class=" col-md-6 col-sm-6 mx-auto contactForm borde  mb-5 mt-5">
            <h1 class="mt-2">CONTACT</h1>
            <h3> Hello! With this form you can contact me for any question!</h3>
            <!--CONTACTO-->
            <div class="contact-block ">
                <div class="contact-form">

                    <form class=" p-5" method="POST" action="mailto:m.mercedes.perea@gmail.com?subject=comicheros">
                        <div class="form-group mr-5 ml-5">
                            <label for="exampleInputText1">NAME</label>
                            <input type="text" name="nombre" class="form-control" aria-describedby="emailHelp" placeholder="NAME">
                        </div>

                        <div class="form-group mr-5 ml-5">
                            <label for="exampleInputEmail1">EMAIL</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="comicheros@gmail.com">
                        </div>

                        <div class="form-group mr-5 ml-5">
                            <label for="exampleFormControlTextarea1">INFO</label>
                            <textarea type="text" name="mensaje" class="form-control" placeholder="text" rows="3"></textarea>
                        </div>

                        <div class="form-group mr-5 ml-5">
                            <label for="exampleFormControlSelect1">What is your favorite category of comics? </label>
                            <select class="form-control" name="category">
                                <option value="0">--Choose an option</option>
                                <option value="ACTION">ACTION</option>
                                <option value="ADVENTURE">ADVENTURE</option>
                                <option value="FANTASY">FANTASY</option>
                                <option value="HUMOR">HUMOR</option>
                                <option value="HORROR">HORROR</option>
                                <option value="SPY">SPY</option>
                                <option value="ADULT">ADULT</option>
                                <option value="MYSTERY">MYSTERY</option>
                                <option value="DRAMA">DRAMA</option>
                            </select>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="Information">
                            <label class="form-check-label" for="exampleCheck1">Do you want to receive information about the web?</label>
                        </div>
                        <button type="submit" class="btn bg-success w-25" value="Send">SEND</button>
                    </form>
                    <!-- // include ("send.php");  NO FUNCIONAL AUN -->

                </div>
                <!--Cierra el formulario-->

            </div>
        </div>
    </div>
</div>




<?php
// Traemos el footer
require_once "libs/Footer.php";
?>