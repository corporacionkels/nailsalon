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

if (isset($_POST['selected_services']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

// Selected SERVICES

$selected_services = $_POST['selected_services'];

$query = mysqli_query($conexion, "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'nailsalon' AND TABLE_NAME = 'appointments'")
or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$appointment_id = $data_appoinment['AUTO_INCREMENT'];

//echo $appointment_id;
//echo 'servicio selecccionado';
//echo $selected_services;





if ($selected_services == '13') {

    $servicio_complementario = '13';


    echo '<script type="text/javascript">
                
			  window.location.assign("complementary_services.php?id=' . $selected_services . '&complement=' . $servicio_complementario . '&cita=' . $appointment_id . '");
			  </script>';
}

if ($selected_services == '14') {

	$servicio_complementario = '13';

    echo '<script type="text/javascript">
				  
	window.location.assign("complementary_services.php?id=' . $selected_services . '&complement=' . $servicio_complementario . '&cita=' . $appointment_id . '");
	</script>';
}

if ($selected_services != '11') {

	$query = mysqli_query($conexion, "INSERT INTO tempory_appoinments(appoinments_id,services_id)
				VALUES('$appointment_id','$selected_services')")
		or die('error: ' . mysqli_error($conexion));
?>
    <script type="text/javascript">
	swal({
    title: "Desea que Seleccionemos el Profesional por Usted?",
    text: "Seleccione un Profesional para Continuar!",
    icon: "info",
    buttons: ["No yo lo Selecciono", "Si Seleccionalo por mi"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "profesional_services_rand.php";
    } else {
        
           window.location = "profesional_services.php";

    }
});
</script>


<?php
}

}else{
?>	
	<script type="text/javascript">
	swal({
    title: "No has Seleccionado Ningun Servicio",
    text: "Agendar Servicios!",
    icon: "warning",
    buttons: ["Deseas Salir?", "Deseas Seleccionarlo?"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "javascript:history.back()";
    } else {
        
           window.location = "categorias.php";

    }
});
	
	</script>
<?php	
}
?>