<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cita || Espacio Teodora</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php
require 'config/conexion.php';

if (isset($_POST['submit_book_appointment_form']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	// Selected SERVICES

	$selected_services = $_POST['selected_services'];


   if(isset($_POST['selected_services_child']) ){
    $selected_services_child = $_POST['selected_services_child'];

   }


	$servicio_complementario = $_POST['servicio_complementario'];

	// Selected EMPLOYEE

	$selected_employee = $_POST['selected_employee'];

	

	// Selected DATE+TIME

	$selected_date_time = explode(' ', $_POST['desired_date_time']);

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

		$query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id,employed_id)
					VALUES('$appointment_id','$service','$selected_employee')")
			or die('error: ' . mysqli_error($conexion));
	}

	if (isset($_POST['selected_services_child'])) {
		foreach ($selected_services_child as $service_child) {

			$query = mysqli_query($conexion, "INSERT INTO services_booked(appointment_id, service_id,employed_id)
					VALUES('$appointment_id','$service_child','$selected_employee')")
			or die('error: ' . mysqli_error($conexion));
		}
	}

	$query = mysqli_query($conexion, "INSERT INTO tempory_complementary(appoinments_id,clients_id,complementary_id)
					VALUES('$appointment_id','$client_id','$servicio_complementario')")
			or die('error: ' . mysqli_error($conexion));

}


?>
<?php
if($servicio_complementario>0){
?>

  <script type="text/javascript">
	swal({
    title: "Deseas un Servicio Complementario?",
    text: "Servicios Complementarios!",
    icon: "info",
    buttons: ["No lo Quiero", "Si lo Quiero"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "loading_complementary.php?id=<?php echo $appointment_id ?>";
    } else {
        
           window.location = "confirm_page_next.php?id=<?php echo $appointment_id ?>";

    }
});
</script>
<?php
}else{
	echo '<script type="text/javascript">
				  
	window.location.assign("confirm_page_next.php?id='.$appointment_id.'");
	</script>';
}
?>
