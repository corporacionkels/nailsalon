<?php
require 'config/conexion.php';

if (isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	// Selected SERVICES

	$selected_services = $_POST['selected_services'];


	$appointment_id = $_POST['appoinment_id'];

	// Selected EMPLOYEE

	$selected_employee = $_POST['selected_employee'];

	// Selected DATE+TIME


	
	//$query = mysqli_query($conexion, "UPDATE  tempory_appoinments SET complementary_id  = '$selected_services'")
    //or die('error: ' . mysqli_error($conexion));


	
	foreach ($selected_services as $service) {

		$query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id,employed_id)
					VALUES('$appointment_id','$service','$selected_employee')")
			or die('error: ' . mysqli_error($conexion));
	}

//	echo "<div class = 'alert alert-success'>";
//	echo "¡Excelente! Su cita ha sido creada con éxito.";
//	echo "</div>";

	//echo $servicio_complementario;


		echo '<script type="text/javascript">
				  
				window.location.assign("confirm_page_next_complementary.php?id=' . $appointment_id . '");
				</script>';
	
}
