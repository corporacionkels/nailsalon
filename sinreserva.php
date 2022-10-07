<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

require 'config/conexion.php';

$query = mysqli_query($conexion, "DELETE FROM  tempory_appoinments")
    or die('error: ' . mysqli_error($conexion));

$query = mysqli_query($conexion, "DELETE FROM tempory_complementary")
    or die('error: ' . mysqli_error($conexion));

$appointment_date = date('Y-m-d');
//echo $appointment_date;

$id = $_GET["id"];

//$query = mysqli_query($conexion, "UPDATE appointments SET  reserva = '1'
//WHERE appointment_id = '$id'")
//or die('error: '.mysqli_error($conexion));

$query = mysqli_query($conexion, "SELECT * , b.first_name as Nomcli , b.last_name as Apecli , c.first_name as NomPro , c.last_name as ApePro , a.appointment_id  as id ,  DATE_FORMAT(a.start_time,'%d/%m/%Y') as start_day , date_format(a.start_time, '%H %i %s') as start_time , date_format(a.end_time_expected, '%H %i %s') as end_time_expected FROM appointments as a inner join clients as b on a.client_id=b.client_id inner join employees as c on a.employee_id = c.employee_id WHERE a.appointment_id = '$id'")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);


$correo_electronico =  $data_appoinment['client_email'];
$correo_profesional = $data_appoinment['email'];
$cliente_appoinment =  $data_appoinment['Nomcli'].' '.$data_appoinment['Apecli'];
$profesional_appoinment = $data_appoinment['NomPro'].' '.$data_appoinment['ApePro'];
$numero = $data_appoinment['id'];
$eldia = $data_appoinment['start_day'];
$hora_inicio = $data_appoinment['start_time'];
$hora_final =  $data_appoinment['end_time_expected'];


$query_details = mysqli_query($conexion, "SELECT * FROM services_booked as a inner join services as b on b.service_id=a.service_id WHERE a.appointment_id = '$id'")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment_details = mysqli_fetch_assoc($query_details);

$servicio = $data_appoinment_details['service_name'];
$servicio_precio = $data_appoinment_details['service_price'];



// multiple recipients



 
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'mail.espacioteodora.cl';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'agenda@espacioteodora.cl';                 // Usuario SMTP
    $mail->Password = 'c1bt74kpfz';                           // Password SMTP
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
 
    $mail->setFrom('agenda@espacioteodora.cl');		// Mail del remitente
    $mail->addAddress($correo_electronico);  
    //$mail->addAddress();   
    $mail->addBcc($correo_profesional); // Mail del destinatario
 
    $mail->isHTML(true);
    $mail->Subject = 'Confirmacion de Agendamiento Sr '.$cliente_appoinment;  // Asunto del mensaje
    $mail->Body = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>simple invoice receipt email template - Bootdey.com</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	<script src='https://code.jquery.com/jquery-1.10.2.min.js'></script>
    <link href='https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet'>
	<script src='https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</head>
<body>
<table class='body-wrap'>
    <tbody><tr>
        <td></td>
        <td class='container' width='600'>
            <div class='content'>
                <table class='main' width='100%' cellpadding='0' cellspacing='0'>
                    <tbody><tr>
                        <td class='content-wrap aligncenter'>
                            <table width='100%' cellpadding='0' cellspacing='0'>
                                <tbody><tr>
                                    <td class='content-block'>
                                        <h2>Gracias por Agendar con Nosotros</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='content-block'>
                                        <table class='invoice'>
                                            <tbody><tr>
                                                <td>Sera Atendido por el Profesional $profesional_appoinment<br><br> El dia $eldia a las $hora_inicio hasta las $hora_final </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class='invoice-items' cellpadding='0' cellspacing='0'>
                                                        <tbody><tr>
                                                            <td>$servicio</td>
                                                            <td class='alignright'>$ $servicio_precio</td>
                                                        </tr>
                                                        
                                                        <tr class='total'>
                                                            <td class='alignright' width='80%'>Total</td>
                                                            <td class='alignright'>$ $servicio_precio</td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                             
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <div class='footer'>
                    <table width='100%'>
                        <tbody><tr>
                            <td class='aligncenter content-block'>Email <a href='mailto:'>agenda@espacioteodora.cl</a></td>
                        </tr>
                    </tbody></table>
                </div></div>
        </td>
        <td></td>
    </tr>
</tbody></table>

<style type='text/css'>
/* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
* {
    margin: 0;
    padding: 0;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
}

img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}

/* Let's make sure all tables have defaults */
table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
    padding: 20px;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
    margin-bottom: 10px;
    font-weight: normal;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: right;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

/* -------------------------------------
    ALERTS
    Change the class depending on warning email, good email or bad email
------------------------------------- */
.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #1ab394;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}

</style>

<script type='text/javascript'>

</script>
</body>
</html>";
$mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)

$mail->send();
//echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
//echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
}


?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cita</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {
            letter-spacing: 0.7px;
            background-color: #eee;
        }

        .container {
            margin-top: 100px;
            margin-bottom: 100px;
        }

        p {
            font-size: 14px;
        }

        .btn-primary {
            background-color: #42A5F5 !important;
            border-color: #42A5F5 !important;
        }

        .cursor-pointer {
            cursor: pointer;
            color: #42A5F5;
        }

        .pic {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .card-block {
            width: 200px;
            border: 1px solid lightgrey;
            border-radius: 5px !important;
            background-color: #FAFAFA;
            margin-bottom: 30px;
        }

        .card-body.show {
            display: block;
        }

        .card {
            padding-bottom: 20px;
            box-shadow: 2px 2px 6px 0px rgb(200, 167, 216);
        }

        .radio {
            display: inline-block;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            color: #000;
            font-weight: 500;
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            filter: grayscale(100%);
        }


        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .radio.selected {
            box-shadow: 0px 8px 16px 0px #EEEEEE;
            -webkit-filter: grayscale(0%);
            -moz-filter: grayscale(0%);
            -o-filter: grayscale(0%);
            -ms-filter: grayscale(0%);
            filter: grayscale(0%);
        }

        .selected {
            background-color: #E0F2F1;
        }

        .a {
            justify-content: center !important;
        }


        .btn {
            border-radius: 0px;
        }

        .btn,
        .btn:focus,
        .btn:active {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body className='snippet-body'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card text-center justify-content-center shaodw-lg  card-1 border-0 bg-white px-sm-2">
                    <div class="card-body show  ">

                        <form id="form" name="login-form" method="POST" action="loading_services.php">
                            <div class="radio-group row justify-content-between px-3 text-center a" style="display:none;">
                                <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected ">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid" src="https://www.instaphotos.cl/wp-content/uploads/2018/11/reserva.png" width="600" height="600"> </div>
                                            <p></p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <img src="https://www.instaphotos.cl/wp-content/uploads/2018/11/reserva.png" class="rounded" alt="..." width="300" height="300">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col">
                                    <p class="text-muted"></p>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="categorias.php" class="btn btn-primary btn-block">Retornar</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('.radio-group .radio').click(function() {
                $('.selected .fa').removeClass('fa-check');
                $('.radio').removeClass('selected');
                $(this).addClass('selected');
            });
        });
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>

</body>

</html>