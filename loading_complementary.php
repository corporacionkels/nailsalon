<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cita || Espacio Teodora</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
require 'config/conexion.php';
//include "Includes/templates/navbar.php";

$appoinment_id = $_GET['id'];

echo $appoinment_id;

$query = mysqli_query($conexion, "SELECT * FROM services_booked as a inner join services as b on a.service_id=b.service_id inner join service_categories as c on b.category_id=c.category_id WHERE a.appointment_id = '$appoinment_id'")
	or die('error: ' . mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$service_id = $data_appoinment['complementary_id'];

//$appoinment_id = $data_appoinment['appoinments_id'];

echo $service_id;


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

//echo $fecha_appoinment;
//echo ' Hora de la Cita';
//echo $time_appoinment;
// El dia de la semana
//$dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
//echo "Buenos días, hoy es ".$dias[date("w")];

//$date = $fecha_appoinment;
$date=$fecha_appoinment;
$eldia = date('l', strtotime($date));
//echo date('l', strtotime($date));
//echo $lafecha;



if ($eldia == 'Monday') {
   // echo 'Es el numero 1';
    $elnumero = 1;
}

if ($eldia == 'Tuesday') {
   // echo 'Es el numero 2';
    $elnumero = 2;
}

if ($eldia == 'Wednesday') {
   // echo 'Es el numero 3';
    $elnumero = 3;
}

if ($eldia == 'Thursday') {
   // echo 'Es el numero 4';
    $elnumero = 4;
}

if ($eldia == 'Friday') {
   // echo 'Es el numero 5';
    $elnumero = 5;
}

if ($eldia == 'Saturday') {
   // echo 'Es el numero 6';
    $elnumero = 6;
}

if ($eldia == 'Sunday') {
   // echo 'Es el numero 7';
    $elnumero = 7;
}

$hola = 0;
$atiende = 0;


$stmt = $con->prepare("SELECT * FROM `employees_schedule` as a inner JOIN employees as b on a.employee_id = b.employee_id WHERE `day_id` = '$elnumero' and `to_hour` > '$time_appoinment';");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $row) {

    $hola = $hola + 1;




    $query_id = mysqli_query($conexion, "SELECT * FROM `appointments` WHERE `employee_id` = '$row[employee_id]' and `start_time` = '$lafecha'")
        or die('Error : ' . mysqli_error($conexion));

    $count = mysqli_num_rows($query_id);

    if ($count <> 0) {

        ?>	
	<script type="text/javascript">
	swal({
    title: "No has Profesionales Disponibles para su Seleccion de Horario",
    text: "Agendar Servicios!",
    icon: "warning",
    buttons: ["Deseas Salir?", "Deseas Seleccionarlo otro Horario?"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
           window.location = "javascript:history.back()";
    } else {
        
           window.location = "confirm_page_next.php?id=<?php echo $appointment_id ?>";

    }
});
	
	</script>
<?php	
       
        
    } else {
        
      //  echo 'NO hay ' ;
      //  echo $row['first_name'] . " " . $row['last_name'];

        $atiende = $atiende + 1;

        echo '<script type="text/javascript">
				  
        window.location.assign("select_complementary.php?id='.$appoinment_id.'");
        </script>';

    }


}

//echo 'Los Empleados que pueden atenderme ';
//echo $hola;
//echo 'Los Empleados que estan ocupados ';
//echo $hola - $atiende;
//echo 'Los Empleados que estan disponibles ';
//echo $atiende;
