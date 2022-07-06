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

$query = mysqli_query($conexion, "UPDATE  tempory_appoinments SET complementary_id = '$selected_services'
")
or die('error : ' . mysqli_error($conexion));

//echo 'servicio selecccionado';
//echo $selected_services;

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
           window.location = "profesional_services_rand_complementary.php";
    } else {
        
           window.location = "profesional_services_only_complementary.php";

    }
});
</script>


<?php


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