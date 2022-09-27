

<?php
session_start();


require '../../config/conexion.php';




    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($conexion, "DELETE FROM clients WHERE client_id='$id'")
            or die('error ' . mysqli_error($conexion));
        //$query = mysqli_query($conexion, "DELETE FROM medicamentos WHERE codigo='$codigo'")


        if ($query) {

            //header("location: arquero.php?module=arquero&alert=4");


            echo '<script type="text/javascript">
						window.location.assign("../clients.php?");
						</script>';
        }
    }


?>