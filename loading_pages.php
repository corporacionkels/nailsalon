<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cita || Espacio Teodora</title>
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include "connect.php";
    include "Includes/functions/functions.php";
    include "Includes/templates/header.php";
    require 'config/conexion.php';
    //include "Includes/templates/navbar.php";

    $radio_value = $_GET["id"];

   // echo $radio_value;
    ?>
    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">

                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="pic"> <img class="irc_mut img-fluid" src="https://static.vecteezy.com/system/resources/previews/001/963/066/non_2x/mobile-payment-via-smartphone-pos-terminal-hand-holding-smartphone-payment-free-vector.jpg" width="600" height="600"> </div>
                        <p></p>
                    </div>

                    </span>

                    <a class="btn btn-success btn-lg btn-block" href="mail.php?id=<?php echo $radio_value ?>" role="button">Pago Confirmado</a>
                    <a href="pago_fallido.php?id=<?php echo $radio_value ?>" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">Pago Rechazado</a>
                </div>
            </div>
        </div>



    </div>