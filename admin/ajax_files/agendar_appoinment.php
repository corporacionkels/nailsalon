

<?php
session_start();


require '../../config/conexion.php';




    if (isset($_GET['id'])) {
        $id = $_GET['id'];



        $query = mysqli_query($conexion, "UPDATE appointments SET reserva = 1
        
            WHERE appointment_id 	= '$id'")
            or die('error: '.mysqli_error($conexion));


        if ($query) {

            //header("location: arquero.php?module=arquero&alert=4");


            echo '<script type="text/javascript">
						window.location.assign("../config_agendamientos.php?");
						</script>';
        }
    }


?>