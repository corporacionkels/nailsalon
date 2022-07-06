<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sweetalert</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php

require 'config/conexion.php';


// Selected SERVICES

$selected_services = $_POST['selected_services'];

echo $selected_services;



if ($selected_services == '13') {

    $servicio_complementario = $servicio_complementario + 1;


    echo '<script type="text/javascript">
                
			  window.location.assign("categorias_servicios_complementarios.php?id=' . $servicio_complementario . '&cliente=' . $client_id . '&cita=' . $appointment_id . '");
			  </script>';
}

if ($selected_services == '14') {

    echo '<script type="text/javascript">
				  
				window.location.assign("confirm_page.php?id=' . $appointment_id . '");
				</script>';
}

if ($selected_services != '11') {
?>
    <script type="text/javascript">
	swal({
    title: "Desea que Seleccionemos el Profesional por Usted?",
    text: "Seleccione un Profesional para Continuar!",
    icon: "info",
    buttons: true,
    dangerMode: true,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "redirectURL";
    } else {
           window.location = "redirectURL";
    }
});
</script>


<?php
}

?>