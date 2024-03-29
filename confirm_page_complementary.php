<!-- PHP INCLUDES -->

<?php

include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
require 'config/conexion.php';
//include "Includes/templates/navbar.php";


$query = mysqli_query($conexion, "SELECT * from  tempory_appoinments")
or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$appointment_id = $data_appoinment['appoinments_id'];

$service_id = $data_appoinment['service_id'];


//$appointment_id = $_GET['id'];


$la_cita = $data_appoinment['appoinments_id'];


?>
<!-- Appointment Page Stylesheet -->
<link rel="stylesheet" href="Design/css/appointment-page-style.css">

<style>
    .panel-default {
        background-color: #EBEBEB;
    }

    .panel-primary {
        background-color: #ABBAEA;
    }

    .items_tab {
        background-color: #CCCCCC;
    }

    .items_tab1 {
        background-color: #EBEBEB;
    }
</style>

<!-- BOOKING APPOINTMENT SECTION -->

<section class="booking_section">
    <div class="container">

        <?php

        if (isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Selected SERVICES

            $selected_services = $_POST['selected_services'];

            // Selected EMPLOYEE

            $selected_employee = $_POST['selected_employee'];

            // Selected DATE+TIME

            $selected_date_time = explode(' ', $_POST['desired_date_time']);

            $date_selected = $selected_date_time[0];
            $start_time = $date_selected . " " . $selected_date_time[1];
            $end_time = $date_selected . " " . $selected_date_time[2];


            //Client Details

            $client_first_name = test_input($_POST['client_first_name']);
            $client_last_name = test_input($_POST['client_last_name']);
            $client_phone_number = test_input($_POST['client_phone_number']);
            $client_email = test_input($_POST['client_email']);




            $result = mysqli_query($conexion, "SELECT * FROM clients WHERE client_email='$client_email'")
                or die('error: ' . mysqli_error($conexion));

            $data = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) > 0) {

                $client_id = $data['client_id'];
            } else {

                $query = mysqli_query($conexion, "INSERT INTO clients(first_name,last_name,phone_number,client_email)
					VALUES('$client_first_name','$client_last_name','$client_phone_number','$client_email')")
                    or die('error: ' . mysqli_error($conexion));

                $query_id = mysqli_query($conexion, "SELECT MAX(client_id) AS id FROM clients")
                    or die('error ' . mysqli_error($conexion));

                $data_id = mysqli_fetch_assoc($query_id);
                $client_id = $data_id['id'];
            }


            $query = mysqli_query($conexion, "INSERT INTO appointments(date_created, client_id, employee_id, start_time, end_time_expected )
				VALUES(Date('Y-m-d H:i'),'$client_id','$selected_employee','$start_time','$end_time')")
                or die('error: ' . mysqli_error($conexion));

            $query = mysqli_query($conexion, "SELECT MAX(appointment_id) AS id FROM appointments")
                or die('error: ' . mysqli_error($conexion));

            $data_appoinment = mysqli_fetch_assoc($query);

            $appointment_id = $data_appoinment['id'];



            foreach ($selected_services as $service) {

                $query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id)
					VALUES('$appointment_id','$service')")
                    or die('error: ' . mysqli_error($conexion));
            }

            echo "<div class = 'alert alert-success'>";
            echo "¡Excelente! Su cita ha sido creada con éxito.";
            echo "</div>";
        }

        ?>

        <!-- RESERVATION FORM -->

        <form method="post" id="appointment_form" action="index.php">

            <!-- SELECT SERVICE -->

            <div class="select_services_div tab_reservation" id="services_tab">

                <!-- ALERT MESSAGE -->

                <div class="alert alert-danger" role="alert" style="display: none">
                    Por Favor, Seleccione al Menos un Servicio!
                </div>

                <div class="text_header">

                </div>

                <!-- SERVICES TAB -->


                <div class="container">
                    <div class="row">
                        <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <?php
                                    $stmt = $con->prepare("SELECT c.first_name as Profesional , c.last_name as Profesionales , c.email as email , c.phone_number as phonep , a.start_time as start_time , a.end_time_expected as end_time_expected , b.first_name as cliente , b.last_name as clientel , b.client_email  as client_email  from appointments as a  INNER JOIN clients as b ON a.client_id=b.client_id INNER JOIN employees as c ON a.employee_id=c.employee_id WHERE a.appointment_id ='$la_cita'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                    ?>
                                        <address>
                                            <strong>Dia y Hora Agendamiento : <?php echo $row['start_time'] ?></strong>
                                            <br>
                                            Profesional:
                                            <?php echo $row['Profesional'] ?> <?php echo $row['Profesionales'] ?>
                                            <br>
                                            <?php echo $row['email'] ?>
                                            <br>
                                            <abbr title="Phone">Telefono:</abbr> <?php echo $row['phonep'] ?>
                                        </address>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <p>
                                        <em>Hora Inicio : <?php echo $row['start_time'] ?></em>
                                    </p>
                                    <p>
                                        <em>Hora Finalizacion : <?php echo $row['end_time_expected'] ?></em>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <h1><?php echo $row['cliente'] ?> <?php echo $row['clientel'] ?></h1>
                                    <strong><?php echo $row['client_email'] ?></strong>
                                </div>
                            <?php
                                    }
                            ?>
                            </span>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Servicios Solicitados</th>
                                        <th></th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $con->prepare("SELECT * from services as a INNER JOIN services_booked as b ON a.service_id=b.service_id WHERE b.appointment_id ='$la_cita'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="col-md-9"><em><?php echo $row['service_name'] ?></em></h4>
                                            </td>
                                            <td class="col-md-1" style="text-align: center"> <?php echo $row['service_duration'] ?> min </td>
                                            <td class="col-md-1 text-center"><?php echo $row['service_price'] ?></td>
                                            <td class="col-md-1 text-center">$ <?php echo $row['service_price'] ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $stmt = $con->prepare("SELECT sum(service_price) as total
													from services s, services_booked sb
													where s.service_id = sb.service_id
													and appointment_id ='$la_cita'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                                    ?>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right">
                                            <p>
                                                <?php
                                                foreach ($rows as $row) {
                                                ?>
                                                    <strong>Subtotal: </strong>

                                            </p>
                                            <p>
                                                <strong>Reserva: </strong>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                <strong>$<?php echo $row['total'] ?></strong>
                                            </p>
                                            <p>
                                                <strong>10%</strong>
                                            </p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right">
                                            <h4><strong>SubTotal: </strong></h4>
                                        </td>
                                        <td class="text-center text-danger">
                                            <h4><strong>$<?php echo $row['total'] ?></strong></h4>
                                        </td>
                                    </tr>
                                <?php
                                                }
                                ?>
                                </tbody>

                            </table>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                            <div class="row">
                                <div class="text-center">
                                    <h1>Servicios Complementarios</h1>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <?php
                                    $stmt = $con->prepare("SELECT c.first_name as Profesional , c.last_name as Profesionales , c.email as email , c.phone_number as phonep , a.start_time as start_time , a.end_time_expected as end_time_expected , b.first_name as cliente , b.last_name as clientel , b.client_email  as client_email  from appointments as a  INNER JOIN clients as b ON a.client_id=b.client_id INNER JOIN employees as c ON a.employee_id=c.employee_id WHERE a.appointment_id ='$appointment_id'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                    ?>
                                        <address>
                                            <strong>Dia y Hora Agendamiento : <?php echo $row['start_time'] ?></strong>
                                            <br>
                                            Profesional:
                                            <?php echo $row['Profesional'] ?> <?php echo $row['Profesionales'] ?>
                                            <br>
                                            <?php echo $row['email'] ?>
                                            <br>
                                            <abbr title="Phone">Telefono:</abbr> <?php echo $row['phonep'] ?>
                                        </address>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                    <p>
                                        <em>Hora Inicio : <?php echo $row['start_time'] ?></em>
                                    </p>
                                    <p>
                                        <em>Hora Finalizacion : <?php echo $row['end_time_expected'] ?></em>
                                    </p>
                                </div>
                            </div>
                            <div class="row">

                            <?php
                                    }
                            ?>
                            </span>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Servicios Complementarios</th>
                                        <th></th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $con->prepare("SELECT * from services as a INNER JOIN services_booked as b ON a.service_id=b.service_id WHERE b.appointment_id ='$appointment_id'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();

                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="col-md-9"><em><?php echo $row['service_name'] ?></em></h4>
                                            </td>
                                            <td class="col-md-1" style="text-align: center"> <?php echo $row['service_duration'] ?> min </td>
                                            <td class="col-md-1 text-center"><?php echo $row['service_price'] ?></td>
                                            <td class="col-md-1 text-center">$ <?php echo $row['service_price'] ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $stmt = $con->prepare("SELECT sum(service_price) as total
													from services s, services_booked sb
													where s.service_id = sb.service_id
													and appointment_id ='$appointment_id'");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                                    ?>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right">
                                            <p>
                                                <?php
                                                foreach ($rows as $row) {
                                                ?>
                                                    <strong>Subtotal: </strong>

                                            </p>
                                            <p>
                                                <strong>Reserva: </strong>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                <strong>$<?php echo $row['total'] ?></strong>
                                            </p>
                                            <p>
                                                <strong>10%</strong>
                                            </p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>   </td>
                                        <td class="text-right">
                                            <h4><strong>SubTotal: </strong></h4>
                                        </td>
                                        <td class="text-center text-danger">
                                            <h4><strong>$<?php echo $row['total'] ?></strong></h4>
                                        </td>
                                    </tr>
                                <?php
                                                }
                                ?>
                                <tr>
                                    <td>   </td>
                                    <td>   </td>
                                    <td class="text-right">
                                        <h4><strong>TotalAgendamiento: </strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <?php
                                        $stmt = $con->prepare("SELECT sum(service_price) as total from services s, services_booked sb where s.service_id = sb.service_id and `appointment_id` BETWEEN '$la_cita' and '$appointment_id';");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                        ?>
                                        <?php
                                        foreach ($rows as $row) {
                                        ?>
                                            <h4><strong>$<?php echo $row['total'] ?></strong></h4>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                            <button type="button" class="btn btn-success btn-lg btn-block">
                                Procesar Pago Reserva <span class="glyphicon glyphicon-chevron-right"></span>
                            </button></td>

                            <a href="https://www.espacioteodora.cl" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">Cancelar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </div>

    </form>
    </div>
</section>



<!-- FOOTER BOTTOM -->

<?php include "Includes/templates/footer.php"; ?>