<!-- PHP INCLUDES -->

<?php

include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
require 'config/conexion.php';
//include "Includes/templates/navbar.php";

//$radio_value = $_POST["radios"];
//echo $radio_value;

$query = mysqli_query($conexion, "SELECT * FROM  tempory_complementary")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$complementary_id = $data_appoinment['complementary_id'];

$appoinment_id = $data_appoinment['appoinments_id'];

//echo $category_name;

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

		<form method="post" id="appointment_form" action="proses_category_complementary.php">

			<!-- SELECT SERVICE -->

			<div class="select_services_div tab_reservation" id="services_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Por Favor, Seleccione al Menos un Servicio!
				</div>

				<div class="text_header">
					<span>
						1. Seleccione Los Servicios Complementarios
					</span>
				</div>

				<!-- SERVICES TAB -->

				<div class="items_tab">
					<div class="panel panel-default">
						<div class="panel-body"><b style="color:#0033FF" ;></b>
							<div class="items_tab">
								<?php
								$stmt = $con->prepare("SELECT * from services WHERE category_id = '$complementary_id'");
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
												<input type="checkbox" name="selected_services" value="<?php echo $row['service_id'] ?>" autocomplete="off">Agendar
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

		


			<!-- NEXT AND PREVIOUS BUTTONS -->

			<div style="overflow:auto;padding: 30px 0px;">
				<div style="float:right;">
				<input type="hidden" name="submit_book_appointment_form">
                    <input class="next_prev_buttons" type="submit" value="Siguiente">
				</div>
				<a href="categorias.php" class="next_prev_buttons" type="submit"  role="button" style="background-color: #bbbbbb;" aria-pressed="true">Retorna Categorias</a>
			</div>

		</form>
	</div>
</section>



<!-- FOOTER BOTTOM -->

<?php include "Includes/templates/footer.php"; ?>