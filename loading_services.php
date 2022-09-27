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


// Chequeo de Servicios Existentes//

$query_id = mysqli_query($conexion, "SELECT * FROM `services`")
or die('Error : ' . mysqli_error($conexion));

$count = mysqli_num_rows($query_id);

echo $count;

if ($count == 0) {

    echo '<script type="text/javascript">
                        
    window.location.assign("loading_services_fail.php");
    </script>';
   
}



$query_id = mysqli_query($conexion, "SELECT * FROM `employees`")
or die('Error : ' . mysqli_error($conexion));

$count = mysqli_num_rows($query_id);

echo $count;

if ($count == 0) {

    echo '<script type="text/javascript">
                        
    window.location.assign("loading_services_fail.php");
    </script>';
   
}



$query_id = mysqli_query($conexion, "SELECT * FROM `employees_schedule`")
or die('Error : ' . mysqli_error($conexion));

$count = mysqli_num_rows($query_id);

echo $count;

if ($count == 0) {

    echo '<script type="text/javascript">
                        
    window.location.assign("loading_services_fail.php");
    </script>';
   
}



//


$radio_value = $_POST["radios"];

$fecha_appoinment = $_POST["birthday"];

$time_appoinment = $_POST["time"];

$date = $fecha_appoinment;
$eldia = date('l', strtotime($date));
$lafecha =  $fecha_appoinment.' '.$time_appoinment;
//echo 'Fecha de la Cita ';
//echo $fecha_appoinment;
//echo 'La Fecha Actual ';
$fechaActual = date('Y-m-d');
   
//echo 'El radio es ';
//echo $radio_value;
//echo $fechaActual;
//echo ' Hora de la Cita';
//echo $time_appoinment;
// El dia de la semana
//$dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
//echo "Buenos días, hoy es ".$dias[date("w")];

//$date = $fecha_appoinment;
//echo date('l', strtotime($date));
//echo $lafecha;


date_default_timezone_set('America/Caracas');

  $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
  //$fecha_entrada = strtotime($time_appoinment);
  //$fecha_media = strtotime($hora_inicio);

  $horaInicial=$time_appoinment;
  $minutoAnadir=-30;
   
  $segundos_horaInicial=strtotime($horaInicial);
   
  $segundos_minutoAnadir=$minutoAnadir*60;
   
  $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
   
  //echo "<br>".$nuevaHora;
  $fecha_entrada = strtotime($nuevaHora);

//echo $time = date("m/d/Y h:i:s A T",$fecha_entrada);
//echo 'La hora actual es ';
//echo $time = date("m/d/Y h:i:s A T",$fecha_actual);

if ($fechaActual == $fecha_appoinment){
   // echo "El dia es Igual";
        if ($fecha_actual < $fecha_entrada ) {
//echo "Dentro del Rango Horario.";
            $rango_horario = 1;
        } else {
//echo "Fuera del Rango Horario";
            $rango_horario = 0;
            echo '<script type="text/javascript">
                        
            window.location.assign("alertas.php?act=update");
            </script>';
        }

} else {
   // echo "El dia es Diferente";
        
}




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
 

    echo '<script type="text/javascript">
				  
    window.location.assign("alertas.php?act=delete");
    </script>';
    
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
        
           window.location = "categorias.php";

    }
});
	
	</script>
<?php	
       
        
    } else {
        
      //  echo 'NO hay ' ;
      //  echo $row['first_name'] . " " . $row['last_name'];

        $atiende = $atiende + 1;

        echo '<script type="text/javascript">
				  
        window.location.assign("select_services.php?radios=' . $radio_value . '&birthday='.$fecha_appoinment.'&time='.$time_appoinment.'");
        </script>';

    }


}

//echo 'Los Empleados que pueden atenderme ';
//echo $hola;
//echo 'Los Empleados que estan ocupados ';
//echo $hola - $atiende;
//echo 'Los Empleados que estan disponibles ';
//echo $atiende;
