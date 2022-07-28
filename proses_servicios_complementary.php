<?php
require 'config/conexion.php';

if (isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	// Selected SERVICES

	$selected_services = $_POST['selected_services'];


	$appointment_id = $_POST['appoinment_id'];

	// Selected EMPLOYEE

	$selected_employee = $_POST['selected_employee'];

	// Selected DATE+TIME


	$query = mysqli_query($conexion, "SELECT * FROM appointments where appointment_id='$appointment_id'")
	or die('error: ' . mysqli_error($conexion));

	$data_appoinment = mysqli_fetch_assoc($query);

	$client_id = $data_appoinment['client_id'];
	$start_time = $data_appoinment['start_time'];
	$end_time = $data_appoinment['end_time_expected'];

	echo $start_time;

	//$query = mysqli_query($conexion, "UPDATE  tempory_appoinments SET complementary_id  = '$selected_services'")
    //or die('error: ' . mysqli_error($conexion));

	$query = mysqli_query($conexion, "INSERT INTO appointments(client_id, employee_id, start_time, end_time_expected )
				VALUES('$client_id','$selected_employee','$start_time','$end_time')")
		or die('error: ' . mysqli_error($conexion));

	$query = mysqli_query($conexion, "SELECT MAX(appointment_id) AS id FROM appointments")
    	or die('error: ' . mysqli_error($conexion));

	$data_newappoinment = mysqli_fetch_assoc($query);

	$appointment_newid = $data_newappoinment['id'];


    foreach ($selected_services as $service) {

		$query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id,employed_id)
					VALUES('$appointment_newid','$service','$selected_employee')")
			or die('error: ' . mysqli_error($conexion));
	}
		

	
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
