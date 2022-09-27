<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

require 'config/conexion.php';



$appointment_date = date('Y-m-d');
//echo $appointment_date;

$id = $_GET["id"];

$query = mysqli_query($conexion, "UPDATE appointments SET  reserva = '1'
WHERE appointment_id = '$id'")
or die('error: '.mysqli_error($conexion));

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
    $mail->Subject = 'Cancelacion de Agendamiento Sr '.$cliente_appoinment;  // Asunto del mensaje
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
                                        <h2>Se Realizo la Cancelacion de su Cita</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='content-block'>
                                        <table class='invoice'>
                                            <tbody><tr>
                                                <td></td>
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


echo '<script type="text/javascript">
window.location.assign("admin/index.php?");
</script>';

?>
