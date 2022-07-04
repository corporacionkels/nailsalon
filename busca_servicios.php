<?php

require 'config/conexion.php';
/*other variables*/
$radio_value = $_POST["radios"];
//echo $radio_value;

$query = mysqli_query($conexion, "SELECT * FROM service_categories WHERE category_id = '$radio_value'")
or die('error: '.mysqli_error($conexion));

$data_appoinment = mysqli_fetch_assoc($query);

$appointment_id = $data_appoinment['category_name'];

//echo $appointment_id;

echo '<script type="text/javascript">
                
window.location.assign("servicios.php?id='.$radio_value.'");
</script>';


?>