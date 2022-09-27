<?php
require 'config/conexion.php';

if (isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	// Selected SERVICES

	$selected_services = $_POST['selected_services'];


	$servicio_complementario = $_POST['servicio_complementario'];

	// Selected EMPLOYEE

	$selected_employee = $_POST['selected_employee'];

	// Selected DATE+TIME

	$selected_date_time = explode(' ', $_POST['desired_date_time']);

	echo $selected_date_time;

	$date_selected = $selected_date_time[0];
	$start_time = $date_selected . " " . $selected_date_time[1];
	$end_time = $date_selected . " " . $selected_date_time[2];


	//Client Details

	$client_first_name = $_POST['client_first_name'];
	$client_last_name = $_POST['client_last_name'];
	$client_phone_number = $_POST['client_phone_numbers'];
	$client_email = $_POST['client_email'];




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


	$query = mysqli_query($conexion, "INSERT INTO appointments(client_id, employee_id, start_time, end_time_expected )
				VALUES('$client_id','$selected_employee','$start_time','$end_time')")
		or die('error: ' . mysqli_error($conexion));

	$query = mysqli_query($conexion, "SELECT MAX(appointment_id) AS id FROM appointments")
		or die('error: ' . mysqli_error($conexion));

	$data_appoinment = mysqli_fetch_assoc($query);

	$appointment_id = $data_appoinment['id'];

	
	foreach ($selected_services as $service) {

		$query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id , employed_id)
					VALUES('$appointment_id','$service','$selected_employee')")
			or die('error: ' . mysqli_error($conexion));
	}

//	echo "<div class = 'alert alert-success'>";
//	echo "¡Excelente! Su cita ha sido creada con éxito.";
//	echo "</div>";

	//echo $servicio_complementario;

	
	if ($servicio_complementario == '11') {

		$servicio_complementario = $servicio_complementario + 1 ;


		echo '<script type="text/javascript">
                
			  window.location.assign("categorias_servicios_complementarios.php?id=' . $servicio_complementario . '&cliente='. $client_id . '&cita=' . $appointment_id .'");
			  </script>';
	}

	if ($servicio_complementario != '11') {

		echo '<script type="text/javascript">
				  
				window.location.assign("confirm_page.php?id=' . $appointment_id . '");
				</script>';
	}
}
