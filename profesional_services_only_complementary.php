<!-- PHP INCLUDES -->

<?php

include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
require 'config/conexion.php';
//include "Includes/templates/navbar.php";

//$radio_value = $_POST["radios"];
//echo $radio_value;

$query = mysqli_query($conexion, "SELECT * FROM   tempory_appoinments")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$service_id = $data_appoinment['complementary_id'];

$appoinment_id = $data_appoinment['appoinments_id'];


$query = mysqli_query($conexion, "SELECT * FROM  appointments where appointment_id ='$appoinment_id'")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment_employeed = mysqli_fetch_assoc($query);

$employeed_id = $data_appoinment_employeed['employee_id'];

$query = mysqli_query($conexion, "SELECT * FROM date_appoinment")
	or die('error: ' . mysqli_error($conexion));

$data_dateappoinment = mysqli_fetch_assoc($query);

$fecha_appoinment = $data_dateappoinment['fecha'];

$time_appoinment = $data_dateappoinment['time'];

$lafecha =  $fecha_appoinment.' '.$time_appoinment;

$orgDate = $fecha_appoinment;  
$newDate = date("d-m-Y", strtotime($orgDate));  

$date=$fecha_appoinment;
$eldia = date('l', strtotime($date));

//echo $fecha_appoinment;
//echo $time_appoinment;
//echo 'El Empleado es ';
//echo $employeed_id;
//echo 'La Consulta es con ';
//echo $lafecha;



if ($eldia== 'Monday'){
	//echo 'Es el numero 1';
	$elnumero = 1;
	
	}

if ($eldia== 'Tuesday'){
//echo 'Es el numero 2';
$elnumero = 2;

}

if ($eldia== 'Wednesday'){
//	echo 'Es el numero 3';
	$elnumero = 3;
	
}

if ($eldia== 'Thursday'){
//	echo 'Es el numero 4';
	$elnumero = 4;
	
}

if ($eldia== 'Friday'){
//	echo 'Es el numero 5';
	$elnumero = 5;
	
}

if ($eldia== 'Saturday'){
//	echo 'Es el numero 6';
	$elnumero = 6;
	
}

if ($eldia== 'Sunday'){
//	echo 'Es el numero 7';
	$elnumero = 7;
	
}


//echo $service_id;
//echo ' id del profesional';
//echo $employed_id;

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



		<!-- RESERVATION FORM -->

		<form method="post" id="appointment_form" action="proses_servicios_complementary.php">

			<!-- SELECT SERVICE -->

			<div class="select_services_div tab_reservation" id="services_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Por Favor, Seleccione al Menos un Servicio!
				</div>

				<div class="text_header">
					<span>
						1. El Servicio Seleccionado es :
					</span>
				</div>

				<!-- SERVICES TAB -->

				<div class="items_tab">
					<div class="panel panel-default">
						<div class="panel-body"><b style="color:#0033FF" ;></b>
							<div class="items_tab">
								<?php
								$stmt = $con->prepare("SELECT * from services WHERE service_id = '$service_id'");
								//$stmt = $con->prepare("Select * from services where category_id = '11' order by category_id");
								$stmt->execute();
								$rows = $stmt->fetchAll();

								foreach ($rows as $row) {


										echo "<div class='itemListElement'>";
										echo "<div class = 'item_details'>";
										echo "<div>";
										echo $row['service_name'];
										echo "</div>";
										echo "<div class = 'item_select_part'>";
										echo "<span class = 'service_duration_field'>";
										echo $row['service_duration'] . " min";
										echo "</span>";
										echo "<div class = 'service_price_field'>";
										echo "<span style = 'font-weight: bold;'>";
										echo $row['service_price'] . "$";
										echo "</span>";
										echo "</div>";
									?>
										<div class="select_item_bttn">
											<div class="btn-group-toggle" data-toggle="buttons">
												<label class="service_label item_label btn btn-secondary">
													<input type="checkbox" name="selected_services[]" value="<?php echo $row['service_id'] ?>" autocomplete="off" readonly checked>Agendado
													<input type="hidden" name="appoinment_id" value="<?php echo $appoinment_id ?>">
												</label>
											</div>
										</div>
									<?php
										echo "</div>";
										echo "</div>";
										echo "</div>";
									
								}
								?>
							</div>

						</div>
					</div>

				</div>
			</div>

			<!-- SELECT EMPLOYEE -->

			<div class="select_employee_div tab_reservation" id="employees_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Por Favor, Selecione un Profesional!
				</div>

				<div class="text_header">
					<span>
						2. Seleccione el Profesional
					</span>
				</div>

				<!-- EMPLOYEES TAB -->

				<div class="btn-group-toggle" data-toggle="buttons">
					<div class="items_tab3">
						<?php
						//$stmt = $con->prepare("SELECT * from employees where employee_id<>'$employeed_id'");
						$stmt = $con->prepare("SELECT * FROM `employees_schedule` as a inner JOIN employees as b on a.employee_id = b.employee_id WHERE `day_id` = '$elnumero' and `to_hour` > '$time_appoinment' and a.employee_id<>'$employeed_id';");
						$stmt->execute();
						$rows = $stmt->fetchAll();

						foreach ($rows as $row) {

							//$query_id = mysqli_query($conexion, "SELECT * FROM `appointments` WHERE `employee_id` = '$row[employee_id]' and `start_time` = '$lafecha'")
							$query_id = mysqli_query($conexion, "SELECT * FROM appointments WHERE `employee_id` = '$row[employee_id]' and '$lafecha' BETWEEN `start_time` AND `end_time_expected`;")
								or die('Error : ' . mysqli_error($conexion));
						
							$count = mysqli_num_rows($query_id);
						
							if ($count <> 0) {
						
							
								
							} else {



									echo "<div class='itemListElement'>";
									echo "<div class = 'item_details'>";
									echo "<div>";
									echo $row['first_name'] . " " . $row['last_name'];
									echo "</div>";
									echo "<div class = 'item_select_part'>";
								?>
									<div class="select_item_bttn">
										<label class="item_label btn btn-secondary active">
											<input type="radio" class="radio_employee_select" name="selected_employee" value="<?php echo $row['employee_id'] ?>"  >Agendar
										</label>
									</div>
								<?php
									echo "</div>";
									echo "</div>";
									echo "</div>";
							}

						}
						?>
					</div>
				</div>
			</div>


			<!-- NEXT AND PREVIOUS BUTTONS -->

			<div style="overflow:auto;padding: 30px 0px;">
				<div style="float:right;">
					<input type="hidden" name="submit_book_appointment_form">
					<button type="button" id="prevBtn" class="next_prev_buttons" style="background-color: #bbbbbb;" onclick="nextPrev(-1)">Anterior</button>
					<button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)">Siguiente</button>
				</div>
				<a href="back_categorias.php" class="next_prev_buttons" role="button" style="background-color: #bbbbbb;" aria-pressed="true">Retorna Categorias</a>
			</div>

			<!-- Circles which indicates the steps of the form: -->

			<div style="text-align:center;margin-top:40px;">
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
			</div>

		</form>
	</div>
</section>



<!-- FOOTER BOTTOM -->

<?php include "Includes/templates/footer.php"; ?>